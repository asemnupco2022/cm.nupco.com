<?php

namespace App\Http\Livewire\Reports;

use App\Helpers\PoHelper;
use App\Models\PoImportScheduler;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class PoImportRepoComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $dateRangePicker=null;
    public $startDate=null;
    public $endDate=null;

    public function updatedDateRangePicker($value)
    {
        $dates= explode(' - ',$value);
        $this->startDate=$dates[0];
        $this->endDate=$dates[1];
    }

    public $searchable_col='table_type';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;


    protected $queryString = ['searchable_col_val'];

    public $columns=PoImportScheduler::CONS_COLUMNS;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;

    public function mount()
    {
       $this->search_reset();
    }
    public function search_reset()
    {
        $this->dateRangePicker=null;
        $this->startDate=null;
        $this->endDate=null;
        $this->searchable_col='table_type';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
    }


    public function export_data($type)
    {
        $ColKeys = array_keys(array_filter($this->columns));
        // $selectedRows = array_keys(array_filter($this->selectedPo));
        // $collection = PoImportScheduler::whereIn('id',$selectedRows)->select($ColKeys)->get();
        $collection =$this->filterForExport($ColKeys);

        $dateTime=Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');
        if ($type=='PDF'){
            $fileName='delivery-status-reort-'.$dateTime.'.pdf';
            PoHelper::export_pdf($ColKeys,$collection,$fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        if ($type=='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $ColKeys);
            $collection=collect(array_merge([$ColKeys],$collection->toArray()));
            $fileName='delivery-status-reort-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        return 1;
    }


    protected function filterForExport($ColKeys){
        $query=PoImportScheduler::orderBy('id', 'DESC');

        if ($this->searchable_operator=='LIKE'){
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->select($ColKeys)->get();
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
                 $query=$query->where($this->searchable_col, trim("$this->searchable_operator"), $this->searchable_col_val)->select($ColKeys)->get();
            }else{
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->select($ColKeys)->get();
            }
        }
        return $query;
    }


    public function search_enter()
    {

        $this->searchEngine();
    }


    public function searchEngine()
    {
        $query=PoImportScheduler::orderBy('id', 'DESC');

        if ($this->searchable_operator=='LIKE'){
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->paginate(10);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
                 $query=$query->where($this->searchable_col, trim("$this->searchable_operator"), $this->searchable_col_val)->paginate(10);
            }else{
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->paginate(10);
            }
        }
        return $query;
    }




    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.reports.po-import-repo-component')->with('collections', $collections);
    }
}
