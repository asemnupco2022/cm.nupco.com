<?php

namespace App\Console\Commands\Developer;

use App\Models\TicketManager;
use App\Models\TicketMasterHeadr;
use Illuminate\Console\Command;

class updateTicketChat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:updateTicketChat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'convert json to string also update read property TicketManager and TicketManagerHeader';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tickets = TicketManager::select('unique_line')->groupBy('unique_line')->get()->toArray();
        $holder=[];
        foreach ($tickets as $key => $value) {
            $holder[]=$value['unique_line'];
        }
        $ticketHeader = TicketMasterHeadr::whereIn('unique_line', $holder)->get();
        foreach ($ticketHeader as $Hkey => $Hvalue) {
            TicketMasterHeadr::find( $Hvalue->id)->update(['meta'=>'new']);
        }

        // ===========
        $tickets = TicketManager::all();
        foreach ($tickets as $key => $value) {
            $jsonCheck = json_decode( $value->msg_body, true);

            if ($jsonCheck and is_array($jsonCheck)) {
                echo 'pass';
                TicketManager::find($value->id)->update(['msg_body'=>$jsonCheck[0]]);
             }else{
                 continue;
             }
        }

        return Command::SUCCESS;
    }
}
