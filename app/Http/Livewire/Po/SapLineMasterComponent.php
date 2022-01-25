<?php

namespace App\Http\Livewire\Po;

use App\Helpers\PoHelper;
use App\Jobs\Export\PdfExcelExportJob;
use App\Jobs\Export\pdfExportJob;
use App\Models\LbsUserSearchSet;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterTmp;
use App\Models\SapMasterView;
use App\Models\StaffColumnSet;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Monolog\Handler\IFTTTHandler;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class SapLineMasterComponent extends Component
{
    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component', $message, $msgType);
    }

    public $tableType = LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
    public  $counter = 0;
    public  $asnJson = [];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['update-users-filter-template' => 'fetchBaseInfo'];


    public $searchable_col = 'po_item';
    public $searchable_operator = 'LIKE';
    public $searchable_col_val = null;

    public $po_number;
    public $baseInfo = null;

    public $userFilterTemplates = [];
    public $getFilterTemplate = '';
    public $json_data = null;
    public $json_data_to_string = '';

    public $selectedPo = [];
    public $selectAll = false;
    public $selectAllTmp = [];
    public $selectAllCols = false;


    public $number_of_rows = 10;


    protected $queryString = ['searchable_col_val'];

    public $columns = PoSapMaster::CONS_COLUMNS;
    public $columnsNormalized = PoSapMaster::CONS_COLUMNS_NORMALIZED;
    public $operators = LbsConstants::CONST_OPERATOR;
    public $num_rows = LbsConstants::CONST_PAGE_NUMBERS;

    //initial PO search
    public $initSearch = false;
    protected $initiateSearch = true;
    public $tender_no = [];
    public $tender_desc = [];
    public $document_type = [];
    public $document_type_desc = [];  //string
    public $init_po_number = [];
    public $purchasing_group = [];
    public $purchasing_organization = [];
    public $customer_no = [];
    public $nupco_delivery_date = [];
    public $po_created_on = [];
    public $generic_mat_code = [];
    public $vendor_code = [];
    public $storage_location = [];
    public $plant = [];
    public $customer_name = [];
    public $delivery_address = [];
    public $supply_ratio = [];
    public $mat_description = [];
    public $cust_gen_code = [];
    public $vendor_name_en = [];
    public $supplier_comment = [];
    public $customer_po_no = [];
    public $customer_po_item = [];
    public $pur_grp_name = [];
    public $notified = [];
    public $asn = [];
    //    ========



    public function hitSearchInt($query)
    {
        if (Arr::has($this->tender_no, ['from'])) {
            $query = $query->whereIn('tender_no', $this->tender_no['from']);
        }
        if (Arr::has($this->tender_desc, ['from'])) {
            $query = $query->whereIn('tender_desc', $this->tender_desc['from']);
        }
        if (Arr::has($this->document_type, ['from'])) {

            $query = $query->whereIn('document_type', $this->document_type['from']);
        }
        if (Arr::has($this->document_type_desc, ['from'])) {
            $query = $query->whereIn('document_type_desc', $this->document_type_desc['from']);
        }
        if (Arr::has($this->init_po_number, ['from'])) {
            $query = $query->whereIn('po_number', $this->init_po_number['from']);
        }
        if (Arr::has($this->purchasing_group, ['from'])) {
            $query = $query->whereIn('purchasing_group', $this->purchasing_group['from']);
        }
        if (Arr::has($this->purchasing_organization, ['from'])) {
            $query = $query->whereIn('purchasing_organization', $this->purchasing_organization['from']);
        }
        if (Arr::has($this->customer_no, ['from'])) {
            $query = $query->whereIn('customer_no', $this->customer_no['from']);
        }
        if (Arr::has($this->generic_mat_code, ['from'])) {
            $query = $query->whereIn('generic_mat_code', $this->generic_mat_code['from']);
        }
        if (Arr::has($this->vendor_code, ['from'])) {
            $query = $query->whereIn('vendor_code', $this->vendor_code['from']);
        }
        if (Arr::has($this->storage_location, ['from'])) {
            $query = $query->whereIn('storage_location', $this->storage_location['from']);
        }
        if (Arr::has($this->plant, ['from'])) {
            $query = $query->whereIn('plant', $this->plant['from']);
        }
        if (Arr::has($this->customer_name, ['from'])) {
            $query = $query->whereIn('customer_name', $this->customer_name['from']);
        }
        if (Arr::has($this->supply_ratio, ['from']) and Arr::has($this->supply_ratio, ['to'])) {

            $query = $query->whereBetween('supply_ratio', [$this->supply_ratio['from'], $this->supply_ratio['to']]);
        }
        if (Arr::has($this->delivery_address, ['from'])) {
            $query = $query->whereIn('delivery_address', $this->delivery_address['from']);
        }
        if (Arr::has($this->mat_description, ['from'])) {
            $query = $query->whereIn('mat_description', $this->mat_description['from']);
        }
        if (Arr::has($this->cust_gen_code, ['from'])) {
            $query = $query->whereIn('cust_gen_code', $this->cust_gen_code['from']);
        }
        if (Arr::has($this->vendor_name_en, ['from'])) {
            $query = $query->whereIn('vendor_name_en', $this->vendor_name_en['from']);
        }
        if (Arr::has($this->supplier_comment, ['from']) and $this->supplier_comment['from'] != '0') {
            $query = $query->whereIn('supplier_comment', $this->supplier_comment['from']);
        }
        if (Arr::has($this->nupco_delivery_date, ['from']) and Arr::has($this->nupco_delivery_date, ['to'])) {
            $query = $query->whereBetween('nupco_delivery_date', [$this->nupco_delivery_date['from'], $this->nupco_delivery_date['to']]);
        }
        if (Arr::has($this->customer_po_no, ['from'])) {
            $query = $query->whereBetween('customer_po_no', [$this->customer_po_no['from'], $this->customer_po_no['to']]);
        }

        if (Arr::has($this->po_created_on, ['from'])) {
            $query = $query->whereIn('po_created_on', $this->po_created_on['from']);
        }
        if (Arr::has($this->customer_po_item, ['from'])) {
            $query = $query->whereIn('customer_po_item', $this->customer_po_item['from']);
        }
        if (Arr::has($this->pur_grp_name, ['from'])) {
            $query = $query->whereIn('pur_grp_name', $this->pur_grp_name['from']);
        }
        if (Arr::has($this->notified, ['from'])) {
            $query = $query->where('notified', $this->notified['from']);
        }
        if (Arr::has($this->asn, ['from'])) {
            $query = $query->where('asn', $this->asn['from']);
        }


        return $query;
    }

    public function initSearchFilter()
    {

        $this->initiateSearch = true;
        $this->initSearch = false;
    }

    public function checknewfilter()
    {
        $this->initiateSearch = rand(10, 10);
    }



    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedPo = $this->selectAllTmp;
            $this->selectedPo =   array_fill_keys($this->selectedPo, true);
        } else {
            $this->selectedPo = [];
        }
    }

    public function updatedSelectAllCols($value)
    {

        if ($value) {

            $this->columnsNormalized = array_keys($this->columnsNormalized);

            $this->columnsNormalized = array_fill_keys($this->columnsNormalized, true);
        } else {
            $this->columnsNormalized = array_keys($this->columnsNormalized);

            $this->columnsNormalized = array_fill_keys($this->columnsNormalized, false);
        }
    }


    public function export_data($type)
    {

        $ColKeys = array_keys(array_filter($this->columnsNormalized));

        $selectedRows = array_keys(array_filter($this->selectedPo));
        $collectionCount = PoSapMaster::whereIn('id', $selectedRows)->count();

        if ($collectionCount == 0  and count($this->selectedPo) == 0) {
            $collection =  $this->searchEngine();
            $queryString = $this->getEloquentSqlWithBindings($collection);

            if ($type == 'PDF') {

                return $this->emitNotifications('Please Select Line items not more Than 1000', 'error');

                dispatch(new PdfExcelExportJob($ColKeys, $queryString, 'PDF', auth()->user()->id, 'rifrocket\\LaravelCms\\Models\\LbsUserMeta', LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM));
            }
            if ($type == 'EXCEL') {
                dispatch(new PdfExcelExportJob($ColKeys, $queryString, 'EXCEL', auth()->user()->id, 'rifrocket\\LaravelCms\\Models\\LbsUserMeta', LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM));
            }

            return $this->emitNotifications('Export Job is in Progress...', 'success');
        }


        $dateTime = Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');
        $collection = PoSapMaster::orderBy('vendor_code', 'ASC')->whereIn('id', $selectedRows)->select(PoHelper::DeNormalizeColString(null, $ColKeys))->get();

        if ($type == 'PDF') {
            if ($collectionCount > 1000) {

                return $this->emitNotifications('Only 1000 line can be export as PDF at a time', 'error');
            }
            $fileName = $this->po_number . '-' . $dateTime . '.pdf';
            PoHelper::export_pdf($ColKeys, $collection, $fileName);
            return Storage::disk('local')->download('export/' . $fileName);
        }
        if ($type == 'EXCEL') {
            $ColKeys = $ColKeys;
            $collection = collect(array_merge([$ColKeys], $collection->toArray()));
            $fileName = $this->po_number . '-' . $dateTime . '.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/' . $fileName);
        }
        return 1;
    }

    public  function getEloquentSqlWithBindings($query)
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }

    public function emitMailComposerReq($reqType)
    {
        $vendorArray = PoSapMaster::whereIn('id', array_keys(array_filter($this->selectedPo)))->pluck('vendor_code')->toArray();
        $pgArray = PoSapMaster::whereIn('id', array_keys(array_filter($this->selectedPo)))->pluck('purchasing_group')->toArray();

        if (!$vendorArray or count(array_unique($vendorArray)) > 1) {
            return $this->dispatchBrowserEvent('jq-confirm-alert', ["message" => "Select only One Vendor's Line Items"]);
        }

        if (!$pgArray or count(array_unique($pgArray)) > 1) {
            return $this->dispatchBrowserEvent('jq-confirm-alert', ["message" => "Select only One Purchasign group Line Items"]);
        }

        $collections = PoSapMaster::whereIn('id', array_keys(array_filter($this->selectedPo)))->get();
        $this->baseInfo = PoSapMaster::find($collections[0]->id);

        if (!$this->baseInfo->vendorInfo) {
            return $this->dispatchBrowserEvent('jq-confirm-alert', ["message" => "Vendor's Info Not Found, for vendor Code: " . ltrim($this->baseInfo->vendor_code, "0")]);
        }

        $to = $this->baseInfo->vendorInfo->email;
        $sendData = [
            'purchasing_code' => $this->po_number,
            'vendor_code' => $this->baseInfo->vendor_code,
            'vendor_name_en' => $this->baseInfo->vendor_name_en,
            'vendor_name_er' => $this->baseInfo->vendor_name_er,
            'customer_name' => $this->baseInfo->customer_name,
            'po_items' => $this->selectedPo,
            'sap_object' => $collections
        ];

        $this->emit('event-show-compose-email', $reqType, $sendData, $this->tableType, $to);
    }


    public function open_comment_modal($poNo, $line_item, $tableType)
    {
        $this->emit('open-edit-internal-comment', $poNo, $line_item, $tableType);
    }

    public function show_asan_info_modal($poNo, $line_item)
    {
        $uniue_line = $poNo . '_' . $line_item;
        $sapMstrTmp = PoSapMasterTmp::where('unique_line', $uniue_line)->first();

        if ($sapMstrTmp and !empty($sapMstrTmp)) {
            $this->asnJson = $sapMstrTmp;
            $this->dispatchBrowserEvent('modal-asn-info-open');
        } else {
            return $this->emitNotifications('No ASN Fond From Po Number: ' . $poNo . ' and Po Item ' . $line_item, 'error');
        }
    }


    public function open_vendor_comment_modal($poNo, $line_item, $tableType, $hash = null)
    {
        if ($hash != 'null') {
            $this->emit('open-edit-vendor-comment', $poNo, $line_item, $tableType);
        } else {
            return $this->emitNotifications('No Comment Fond From vendor', 'error');
        }
    }



    public function UpdatedGetFilterTemplate($value)
    {
        $this->json_data_to_string = '';
        $selectedTemplate = LbsUserSearchSet::find($value);
        $this->json_data = $selectedTemplate->json_data;
        $this->json_data_to_string = $selectedTemplate->json_to_string;
    }


    public function search_reset()
    {
        return redirect()->route('web.route.po.SAPTableLineItems');

        $this->selectAll = false;
        $this->getFilterTemplate = '';
        $this->json_data = null;
        $this->json_data_to_string = '';
        $this->searchable_col = 'po_item';
        $this->searchable_operator = 'LIKE';
        $this->searchable_col_val = null;
        $this->number_of_rows = 10;
        $this->selectedPo = [];
        $this->tender_no = [];
        $this->tender_desc = [];
        $this->document_type = [];
        $this->document_type_desc = [];  //string
        $this->init_po_number = [];
        $this->purchasing_group = [];
        $this->purchasing_organization = [];
        $this->customer_no = [];
        $this->nupco_delivery_date = [];
        $this->po_created_on = [];
        $this->generic_mat_code = [];
        $this->vendor_code = [];
        $this->storage_location = [];
        $this->plant = [];
        $this->customer_name = [];
        $this->delivery_address = [];
        $this->supply_ratio = [];
        $this->mat_description = [];
        $this->cust_gen_code = [];
        $this->vendor_name_en = [];
        $this->supplier_comment = [];
        $this->asn = [];
    }



    public function mount()
    {

        $this->fetchBaseInfo();
    }


    public function fetchBaseInfo()
    {
        $this->userFilterTemplates = LbsUserSearchSet::NotDel()->where('user_id', auth()->user()->id)->where('template_for_table', $this->tableType)->get();
        $getFavFilter = LbsUserSearchSet::OnlyActive()->where('user_id', auth()->user()->id)->where('template_for_table', $this->tableType)->where('make_fav', '!=', null)->first();

        $StaffColumnSet = StaffColumnSet::where('table_type', $this->tableType)->where('user_id', auth()->user()->id)->first();
        if ($StaffColumnSet) {
            $this->columnsNormalized = json_decode($StaffColumnSet->columns, true);
        }
    }

    public function save_staff_col_set()
    {
        $uniue_line = $this->tableType . '_' . auth()->user()->id;
        $attributes = [
            'unique_line' => $this->tableType . '_' . auth()->user()->id,
            'user_id' => auth()->user()->id,
            'table_type' => $this->tableType,
            'columns' => json_encode($this->columnsNormalized),
        ];

        if (StaffColumnSet::where('unique_line', $uniue_line)->exists()) {
            $result = StaffColumnSet::where('unique_line', $uniue_line)->first()->update($attributes);
        } else {
            $result = StaffColumnSet::create($attributes);
        }

        // dd($result);
        if ($result) {
            return $this->emitNotifications('colunm set saved', 'success');
        }
        return $this->emitNotifications('There is Something Wrong', 'error');
    }

    public function search_enter()
    {
        $this->searchEngine();
    }


    public function searchEngine()
    {
        $this->dispatchBrowserEvent('close-edit-vendor-comment');
        $query = PoSapMaster::orderBy('vendor_code', 'ASC');

        if ($this->json_data and !empty($this->json_data)) {
            $searchableItems = json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)) {
                $query = PoSapMaster::orderBy('vendor_code', 'ASC');
                foreach ($searchableItems as $key => $searchableItem) {
                    $operator = $searchableItem['queryOpr'];
                    if ($operator == 'IN') {
                        $query = $query->whereIn(trim($searchableItem['queryCol']), ($searchableItem['queryVal']));
                    } else {
                        $query = $query->where(trim($searchableItem['queryCol']), trim("$operator"), trim($searchableItem['queryVal']));
                    }
                }
                return  $query;
            }
        }

        if (!empty($this->searchable_col) and !empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
            $query = $query->where(trim(PoHelper::DeNormalizeColString($this->searchable_col, null)), trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('vendor_code', 'ASC');
        }
        $query = $this->hitSearchInt($query);
        return $query;
    }


    public function render()
    {
        $collections = $this->searchEngine()->paginate($this->number_of_rows);
        $this->selectAllTmp = $collections->pluck('id')->toArray();


        return view('livewire.po.sap-line-master-component', compact(

            'collections'

        ));
    }
}
