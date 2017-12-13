<?php

namespace App\Console\Commands;

use App\AdminBalance;
use App\BasicSetting;
use App\RebeatLog;
use App\Repeat;
use App\User;
use App\UserBalance;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Repeat History';

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
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::parse();
        $rep = Repeat::whereStatus(0)->get();
        $basic = BasicSetting::first();
        foreach ($rep as $r){
            if ($r->repeat_time < $now){
                $user = User::findOrFail($r->user_id);
                $ra = Repeat::findOrFail($r->id);
                if ($ra->rebeat != $r->deposit->time){
                    $us['user_id'] = $user->id;
                    $us['balance_type'] = 3;
                    $us['balance'] = ($r->deposit->amount * $r->deposit->percent) / 100;
                    $us['old_balance'] = $user->amount;
                    $us['new_balance'] = $user->amount + $us['balance'];
                    $us['details'] = "Invest ID: # ".$r->deposit->deposit_number.' '."Invest Plan : ".$r->deposit->plan->name;
                    $user->amount = $us['new_balance'];
                    UserBalance::create($us);
                    $user->save();
                    $log['user_id'] = $user->id;
                    $log['deposit_id'] = $r->deposit->id;
                    $log['balance'] = $us['balance'];
                    $log['made_time'] = Carbon::now();
                    RebeatLog::create($log);
                    $ra->made_time = Carbon::now();
                    $ra->repeat_time = Carbon::parse()->addHours($r->deposit->compound->compound);
                    $ra->rebeat = $ra->rebeat + 1;
                    $ra->save();

                    $ad1['user_id'] = $user->id;
                    $ad1['balance_type'] = 3;
                    $ad1['balance'] = $us['balance'];
                    $ad1['old_balance'] = $basic->admin_total;
                    $ad1['new_balance'] = $basic->admin_total - $us['balance'];
                    $ad1['details'] = "Invest ID: # ".$r->deposit->deposit_number.'; '."Invest Plan : ".$r->deposit->plan->name;
                    AdminBalance::create($ad1);
                    $basic->admin_total = $ad1['new_balance'];
                    $basic->save();

                }else{
                    $ra->status = 1;
                    $ra->save();
                }

            }
        }
        $this->info("Repeat table Action Start.");
    }
}
