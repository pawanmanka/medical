<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Wallet;
use App\Models\WalletTrans;
use Illuminate\Console\Command;

class PatientWalletTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commend:patient_wallet_transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give payment to Booking Owner (doctor,lab,hospital)';

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

        $appointments = Appointment::where('payment_transfer_status',Appointment::$PAYMENT_TRANSFER_STATUS_PENDING)
        ->where('status',Appointment::$STATUS_CANCEL)
        ->where('patient_id','=','cancel_by_user')
        ->get();

        foreach ($appointments as $key => $appointment) {

                  $walletObj = Wallet::firstOrCreate([
                      'user_id'=>$appointment->patient_id
                  ]);
                  $before_total = !empty($walletObj->amount)?$walletObj->amount:0;
                  $walletObj->amount = $walletObj->amount + $appointment->merchant_amount;
                  $walletObj->save();

                     //create for wallet trans
                    $walletTransObj = new WalletTrans();
                    $walletTransObj->user_id = $appointment->patient_id;
                    $walletTransObj->action_user_id = $appointment->patient_id;
                    $walletTransObj->wallet_id = $walletObj->id; 
                    $walletTransObj->before_total = $before_total; 
                    $walletTransObj->amount =$appointment->merchant_amount;
                    $walletTransObj->after_total = $walletObj->amount ;
                    $walletTransObj->description = "Cancel Appointment id $appointment->id";
                    $walletTransObj->save();

                    $appointment->payment_transfer_status  = Appointment::$PAYMENT_TRANSFER_STATUS_DONE;
                    $appointment->save();
        }
    }
}
