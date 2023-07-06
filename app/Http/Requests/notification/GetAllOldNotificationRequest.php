<?php

namespace App\Http\Requests\notification;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PushNotification;
use Illuminate\Support\Facades\Auth;

class GetAllOldNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function process(){
        $push_notifications = PushNotification::paginate(10);

        return $push_notifications;
    }
}
