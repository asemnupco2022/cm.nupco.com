<?php

namespace App\Http\Livewire\Automation;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\SchedulerNotificationHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use PDF;

class HistoryAutoComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['update-users-filter-template' => 'fetchBaseInfo'];
    public $tableType=LbsUserSearchSet::TEMPLATE_NOTIFICATION_HISTORY;

    //Search Params
    public $searchable_col='table_type';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $selected_staff='';


    public $columns=SchedulerNotificationHistory::CONS_COLUMNS;   //table columns for this table
    public $templateArray=LbsUserSearchSet::TEMPLATE_ARRAY;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;


    public $userFilterTemplates=[];
    public $getFilterTemplate='';
    public $json_data=null;
    public $json_data_to_string='';

    public $staffs=[];


    public $selectedPo=[];
    public $selectAll=false;

    public $showEmailStructure=null;


    public function updatedSelectAll($value)
    {
        if ($value)
        {
            $this->selectedPo = $this->searchEngine()->pluck('id')->toArray();
            $this->selectedPo =   array_fill_keys($this->selectedPo, true);
        }
        else
        {
            // $this->selectedPo =   array_fill_keys($this->selectedPo, false);
            $this->selectedPo = [];
        }
    }

    public function search_reset()
    {
        $this->selected_bulk_action='';
        $this->searchable_col='id';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
        $this->number_of_rows=10;
    }

    public function mount()
    {
        $this->fetchBaseInfo();
    }


    public function fetchBaseInfo()
    {
        $this->userFilterTemplates = LbsUserSearchSet::NotDel()->where('user_id',auth()->user()->id)->where('template_for_table',$this->tableType)->get();
    }

    public function export_data($type)
    {

        $ColKeys = array_keys(array_filter($this->columns));
        $selectedRows = array_keys(array_filter($this->selectedPo));
        $collection = SchedulerNotificationHistory::whereIn('id',$selectedRows)->select($ColKeys)->get();
        $dateTime=Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');

        if ($type=='PDF'){
            $fileName='notification_history'.'-'.$dateTime.'.pdf';
            PoHelper::export_pdf($ColKeys,$collection,$fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        if ($type=='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $ColKeys);
            $collection=collect(array_merge([$ColKeys],$collection->toArray()));
            $fileName='notification_history'.'-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }

    }

    public function view_email($id)
    {
        $this->showEmailStructure=SchedulerNotificationHistory::find($id)->msg_body;
        $this->dispatchBrowserEvent('open-mail-views');
    }

    public function download_email($id)
    {
        $data=SchedulerNotificationHistory::find($id)->msg_body;
        $path = storage_path('app/export');
        $filename='invoice.pdf';

//        $pdf->loadHTML($data);
//        $pdf->save($path . '/' . $filename);
//        return Storage::disk('local')->download('export/'.$filename);

      $pdf =  PDF::loadView('pdf.email-print',['data'=>$data], [], [
          'mode'                     => '',
          'format'                   => 'A4',
          'default_font_size'        => '5',
          'default_font'             => 'sans-serif',
          'margin_left'              => 10,
          'margin_right'             => 10,
          'margin_top'               => 10,
          'margin_bottom'            => 10,
          'margin_header'            => 0,
          'margin_footer'            => 0,
          'orientation'              => 'P',
          'title'                    => 'Laravel mPDF',
          'author'                   => '',
          'watermark'                => 'arif',
          'show_watermark'           => false,
          'watermark_font'           => 'sans-serif',
          'display_mode'             => 'fullpage',
          'watermark_text_alpha'     => 0.1,
          'custom_font_dir'          => '',
          'custom_font_data' 	       => [],
          'auto_language_detection'  => false,
          'temp_dir'                 => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
          'pdfa' 			               => false,
          'pdfaauto' 		             => false,
          'use_active_forms'         => false,
      ])->save($path . '/' . $filename);

        return Storage::disk('local')->download('export/'.$filename);


    }


    public function searchEngine()
    {
        $query=SchedulerNotificationHistory::NotDel();
        if (!empty($this->selected_staff)){
            $query= $query->where('user_id',$this->selected_staff);
        }

        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
                return  $query->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }
        if ($this->searchable_operator=='LIKE'){
            return    $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return $query= $query->where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }else{
                return  $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }
        }
    }

    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.automation.history-auto-component')->with('collections', $collections);
    }
}
