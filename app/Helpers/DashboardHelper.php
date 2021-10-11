<?php


namespace App\Helpers;


use App\Models\NotificationHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class DashboardHelper
{

    protected static function monthGenerator($count=6,$name=null, $string=null){

        $months=[];
        if ($name){
            for ($i=0; $i<=$count; $i++){
                $mon=Carbon::now()->subMonths($count-$i)->format('F');
                $months[]= "'$mon'";
            }
        }else{
            for ($i=0; $i<=$count; $i++){
                $months[]=(int) Carbon::now()->subMonths($count-$i)->format('m');
            }
        }

        if ($string){
            $months= implode(',',$months);
        }

        return $months;

    }
    public static function historyCounter( $mail_type, $onlyTotal=null, $broadcastType=null, $year=null, $months=null)
    {

        $counts=0;

        if (!empty($onlyTotal)){
            $counts = DB::table('notification_histories')
                ->where('mail_type',$mail_type );
        }

        elseif ( $months and $year and $mail_type and !empty($year) and !empty($months)){
          $counts = DB::table('notification_histories')
                ->whereMonth('created_at', $months)
                ->whereYear('created_at', $year)
                ->where('mail_type',$mail_type );
        }

        if ($broadcastType){
            $counts= $counts->where('broadcast_type',$broadcastType);
        }

        $counts=$counts->get()->count();
        return $counts;
    }


    public static function lineChart($mail_type=null ,array $months=[],$onlyMonths=null, $year=null, $broadcastType=null )
    {
       $valueReturn=[];

        if ($onlyMonths ){
            if ($months){
                return $months;
            }
            return self::monthGenerator(7,true, true);
        }

        if (empty($months)){
            $months = self::monthGenerator(6);
        }

        foreach ($months as $month){
            if ( $month and $year and $mail_type and !empty($year) and !empty($month)){

                $valueReturn[] = self::historyCounter($mail_type,null,$broadcastType,$year,$month);
            }else{

                $valueReturn[] = self::historyCounter($mail_type,null,$broadcastType,date('Y'),$month);
            }

        }

        return implode(',',$valueReturn);




    }
}
