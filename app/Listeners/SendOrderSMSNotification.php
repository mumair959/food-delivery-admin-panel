<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\UserFCMToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderSMSNotification
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
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        
        $url = 'http://csms.dotklick.com/api_sms/api.php';
        $this->sendPushNotificationToAdmin($event);
        
        // SMS content for Admin
            $data = [
                'key' => '3e8bba81fa9efd8d0743cdb401f93a08',
                'receiver' => '03152736413',
                'sender' => 'POHNCHA DOO',
                'msgdata' => 'New order received by Customer: '
                .$event->user->first_name.' '.$event->user->last_name.
                ', with order number '.$event->order->order_num.
                ', Contact: '.$event->user->customer->phone_num.', Please check your app for details'
            ];

        // SMS content for Customer
            $dataForCustomer = [
                'key' => '3e8bba81fa9efd8d0743cdb401f93a08',
                'receiver' => $event->user->customer->phone_num,
                'sender' => 'POHNCHA DOO',
                'msgdata' => 'Hi, '
                .$event->user->first_name.' '.$event->user->last_name.
                '!, Your order '.$event->order->order_num.' is in process, will be at your door step in next 45 minutes, You can track your order by call or WhatsApp on 03152736413'
            ];

        // Sending SMS to Admin
                
            $params = '';
            foreach($data as $key=>$value){
                $params .= $key.'='.$value.'&';                
            }
                 
            $params = trim($params, '&');

            $complete_url = $url.'?'.$params;

            $complete_url = str_replace(" ", "%20", $complete_url);

            $response = file_get_contents($complete_url);
        
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

    public function sendPushNotificationToAdmin($event)
    {
        $fcmToken = UserFCMToken::where('user_id',7)->first();
        
        if($fcmToken){
            $json_data = [
                "notification" => [
                  "title" => "New Order Recieved",
                  "body" => "New order received by Customer: ".$event->user->first_name." ".$event->user->last_name,
                  "sound" => "default",
                  "click_action" => "FCM_PLUGIN_ACTIVITY",
                  "icon" => "fcm_push_icon"
                ],
                "data" => [
                  "landing_page" => "new_orders"
                ],
                  "to" => $fcmToken->fcm_tokens,
                  "priority" => "high",
                  "restricted_package_name" => ""
            ];
    
            $data = json_encode($json_data);
            //FCM API end-point
            $url = 'https://fcm.googleapis.com/fcm/send';
            //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
            $server_key = 'AAAAILb9iRY:APA91bF0h_xAPSbC4vBozDBZ8x3BiKcEhTNaNXNRp9ZpaWb2ly4-BiWd0Yo70onBX6ZDurNK83VncUIrMAp32CQ1__j8LtlrBzbyf9YqIqT5C_jQY5aak-rjs0sz3-FYZEbetwy96I0x';
            //header with content_type api key
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$server_key
            );
            //CURL request to route notification to FCM connection server (provided by Google)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
    
            curl_close($ch);
        }
    }
}
