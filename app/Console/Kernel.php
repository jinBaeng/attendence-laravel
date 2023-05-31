<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Models\Attendence;
use App\User\Domain\Entities\User;
use App\Models\Penalty;
use App\util\GetHoliday;
// use \App\Http\Controllers\API\HolidayController;



class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            // get date
            date_default_timezone_set('Asia/Seoul');
            $year = date('Y');
            $month = date('m');
            Log::info($year);
            //get holiday
            $holidays = (new GetHoliday)->getHoliday($year,$month);

            // after judgment if weekday -> add value to User table
            if(count($holidays)>0){
                for($i=0;$i<count($holidays);$i++){
                    if(date('Ymd')==$holidays[$i]){
                        return;
                    }else{
                        if($user->studentID!= 'professor'){
                            $attendence = new Attendence;
                            $attendence->user_id=$user->id;
                            $attendence->check='3';
                            $attendence->save();
                        }
                    }
                }
            }else{
                if($user->studentID!= 'professor'){
                    $attendence = new Attendence;
                    $attendence->user_id=$user->id;
                    $attendence->check='3';
                    $attendence->save();
                }
            }
 
        })->dailyAt('14:45')->timezone('Asia/Seoul');

    
       $schedule->call(function(){
            date_default_timezone_set('Asia/Seoul');
            $year = date('Y');
            $month = date('m');

            //get holiday
            $holidays = (new GetHoliday)->getHoliday($year,$month);
            foreach ( Attendence::where('created_at' , '>' , date("Y-m-d"))->where('check','>','1')->get() as $att){
                $penalty = new Penalty;
                $penalty->user_id=$att->user_id;
                $penalty->attendence_id=$att->id;
                $penalty->clear=false;
                $penalty->save();
            }
       })->dailyAt('14:46')->timezone('Asia/Seoul');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
