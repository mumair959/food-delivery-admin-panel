<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFCMToken;
use App\Models\PushNotification;
use App\Http\Requests\notification\GetAllOldNotificationRequest;

class NotificationController extends Controller
{
    public function index($id = null)
    {
        $notification = PushNotification::find($id);
        return view('notification.notification',['id'  => $id]);
    }

    public function getNotification($id)
    {
        $response = PushNotification::select('id','title','message')->where('id',$id)->first();
        return response()->json($response);
    }

    public function notifications_list()
    {
        return view('notification.old_notifications_list');
    }

    public function getOldNotifications(GetAllOldNotificationRequest $request)
    {
        $response = $request->process();
        return response()->json($response);
    }

    public function sendNotification(Request $request){
        $fcmTokens = UserFCMToken::get();

        PushNotification::updateOrCreate(['id' => $request->id],$request->all());

        foreach ($fcmTokens as $key => $token) {
            $this->pushNotificationRequest($token,$request);
        }

        return response()->json(['success' => 'Notification has been sent to all users']);
    }

    public function pushNotificationRequest($fcmToken,$fcmData)
    {
        $json_data = [
            "notification" => [
              "title" => $fcmData->title,
              "body" => $fcmData->message,
              "sound" => "default",
              "click_action" => "FCM_PLUGIN_ACTIVITY",
              "icon" => "fcm_push_icon"
            ],
            "data" => [
              "landing_page" => "dashboard"
            ],
              "to" => $fcmToken->fcm_tokens,
              "priority" => "high",
              "restricted_package_name" => ""
        ];

        $data = json_encode($json_data);
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAs9_zTG4:APA91bFw-hMEehbvXjL7_Vp-QszpSN7R9ABV0z2aVJi2_xKQ5IFRIgIUWg-tHlNupHPH_c87MliPWarlWxu-rZBr3C4w1amsRWJIjEAGrp2yBX21c3LxF1GAKMEykcq9S9SrXSxMLHdU';
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
