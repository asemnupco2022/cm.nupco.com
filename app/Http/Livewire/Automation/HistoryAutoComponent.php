<?php

namespace App\Http\Livewire\Automation;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\SchedulerNotificationHistory;
use App\Models\StaffColumnSet;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use PDF;

class HistoryAutoComponent extends Component
{

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

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


    public $broadcast_type=[];
    public $mail_type=[];
    public $table_type=[];
    public $sender_name=[];
    public $recipient_name=[];
    public $recipient_email=[];
    public $msg_subject=[];
    public $last_executed_at=[];

    public function hitSearchInt($query)
    {

        if (Arr::has($this->broadcast_type, ['from','to'])){
            $query=$query->whereBetween('broadcast_type',[$this->broadcast_type['from'],$this->broadcast_type['to']]);
        }elseif (Arr::has($this->broadcast_type, ['from'])){
            $query=$query->where('broadcast_type',$this->broadcast_type['from']);
        }

        if (Arr::has($this->mail_type, ['from','to'])){
            $query=$query->whereBetween('mail_type',[$this->mail_type['from'],$this->mail_type['to']]);
        }elseif (Arr::has($this->mail_type, ['from'])){
            $query=$query->where('mail_type',$this->mail_type['from']);
        }

        if (Arr::has($this->table_type, ['from','to'])){
            $query=$query->whereBetween('table_type',[$this->table_type['from'],$this->table_type['to']]);
        }elseif (Arr::has($this->table_type, ['from'])){
            $query=$query->where('table_type',$this->table_type['from']);
        }

        if (Arr::has($this->sender_name, ['from','to'])){
            $query=$query->whereBetween('sender_name',[$this->sender_name['from'],$this->sender_name['to']]);
        }elseif (Arr::has($this->sender_name, ['from'])){
            $query=$query->where('sender_name',$this->sender_name['from']);
        }


        if (Arr::has($this->recipient_name, ['from','to'])){
            $query=$query->whereBetween('recipient_name',[$this->recipient_name['from'],$this->recipient_name['to']]);
        }elseif (Arr::has($this->recipient_name, ['from'])){
            $query=$query->where('recipient_name',$this->recipient_name['from']);
        }

        if (Arr::has($this->recipient_email, ['from','to'])){
            $query=$query->whereBetween('recipient_email',[$this->recipient_email['from'],$this->recipient_email['to']]);
        }elseif (Arr::has($this->recipient_email, ['from'])){
            $query=$query->where('recipient_email',$this->recipient_email['from']);
        }

        if (Arr::has($this->msg_subject, ['from','to'])){
            $query=$query->whereBetween('msg_subject',[$this->msg_subject['from'],$this->msg_subject['to']]);
        }elseif (Arr::has($this->msg_subject, ['from'])){
            $query=$query->where('msg_subject',$this->msg_subject['from']);
        }


        if (Arr::has($this->last_executed_at, ['from','to'])){
            $query=$query->whereBetween('last_executed_at',[$this->last_executed_at['from'],$this->last_executed_at['to']]);
        }elseif (Arr::has($this->last_executed_at, ['from'])){
            $query=$query->whereDate('last_executed_at',$this->last_executed_at['from']);
        }

        return $query;
    }
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

        $StaffColumnSet = StaffColumnSet::where('table_type', $this->tableType)->where('user_id',auth()->user()->id)->first();
        if ( $StaffColumnSet) {
            $this->columns = json_decode($StaffColumnSet->columns, true);
        }
    }

    public function save_staff_col_set()
    {
        $uniue_line=$this->tableType.'_'.auth()->user()->id;
        $attributes=[
            'unique_line'=>$this->tableType.'_'.auth()->user()->id,
            'user_id'=>auth()->user()->id,
            'table_type'=>$this->tableType,
            'columns'=>json_encode($this->columns),
        ];

        if (StaffColumnSet::where('unique_line',$uniue_line)->exists()) {
            $result = StaffColumnSet::where('unique_line',$uniue_line)->first()->update($attributes);
        }else{
            $result = StaffColumnSet::create($attributes);
        }

        // dd($result);
        if($result){
            return $this->emitNotifications('colunm set saved' ,'success');
        }
        return $this->emitNotifications('There is Something Wrong','error');

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

    public function search_filter_submit()
    {
        $this->searchEngine();
    }


    public function searchEngineForAll()
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
