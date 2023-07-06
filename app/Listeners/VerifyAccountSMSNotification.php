<?php

namespace App\Listeners;

use App\Events\VerifyAccount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyAccountSMSNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VerifyAccount  $event
     * @return void
     */
    public function handle(VerifyAccount $event)
    {
        $url = 'http://csms.dotklick.com/api_sms/api.php';
        
                // SMS content for Customer
                    $dataForCustomer = [
                        'key' => '3e8bba81fa9efd8d0743cdb401f93a08',
                        'receiver' => $event->user->customer->phone_num,
                        'sender' => 'POHNCHA DOO',
                        'msgdata' => 'Hi, '
                        .$event->user->first_name.' '.$event->user->last_name.
                        '!, Your account login detail at PohnchaDoo is: ('.$event->user->verification_code.')'
                    ];
                
                // Sending SMS to Customer
        
                    $paramsCustomer = '';
                    foreach($dataForCustomer as $key=>$value){
                        $paramsCustomer .= $key.'='.$value.'&';                
                    }
                        
                    $paramsCustomer = trim($paramsCustomer, '&');
        
                    $complete_url_customer = $url.'?'.$paramsCustomer;
        
                    $complete_url_customer = str_replace(" ", "%20", $complete_url_customer);
        
                    $response = file_get_contents($complete_url_customer);
    }
}
