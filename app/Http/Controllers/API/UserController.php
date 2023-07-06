<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\Customer;
use App\Models\Wallet;
use App\Models\UserFCMToken;
use App\Notifications\SendVerificationCode;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Events\VerifyAccount;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required|string|max:20', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);            
        }
        $user = $request->user();
        $tokenResult = $user->createToken('PohnchaDoSecretToken');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = \Carbon\Carbon::now()->addHours(1);
        $token->save();

        // event(new VerifyAccount($user));
        // if($user->is_verified == '0'){
        //     $user->notify(new SendVerificationCode($user));            
        // }
        $authUser = User::find($user->id);
        if (empty($authUser->user_code)) {
            $authUser->user_code = $this->generateUserCode($user->last_name);
            $authUser->save();
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => \Carbon\Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user_verified' => $user->is_verified,
            'user_wallet' =>  empty($user->wallet) ? 0 : $user->wallet->wallet_amount,
            'user_id' => $user->id,
            'user_referal_code' => $authUser->user_code,
            'user_name' => $user->first_name.' '.$user->last_name,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50', 
            'email' => 'required|email|unique:users', 
            'phone_num' => 'required|string|regex:/^[0-9]+$/',
            'password' => 'required|string|max:20', 
            'confirm_password' => 'required|same:password|string|max:20', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        
        $input = $request->all(); 
        
        $input['password'] = bcrypt($input['password']); 
        $input['user_type_id'] = 2;
        $input['first_name'] = ucfirst($input['first_name']);
        $input['last_name'] = ucfirst($input['last_name']);
        $input['referal_code'] = empty($input['referal_code']) ? null : $input['referal_code'];
        $input['user_code'] = $this->generateUserCode($input['last_name']);
        $input['email_verified_at'] = \Carbon\Carbon::now();
        $input['verification_code'] = $this->generateRandomString(6);
        $user = User::create($input); 

        // Creating customer
        $customer = new Customer();
        $customer->user_id = $user->id;                
        $customer->phone_num = $request->phone_num;
        $customer->city_id = 1;
        $customer->country_id = 1;
        $customer->save();

        //Creating wallet
        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->wallet_amount = empty($input['referal_code']) ? 0 : 50;        
        $wallet->save();

        // Add amount to refered by
        // if (!empty($input['referal_code'])) {
        //     $referedBy = User::where('user_code',$input['referal_code'])->first();
        //     $addToReferedBy = Wallet::where('user_id',$referedBy->id)->first();
        //     if (empty($addToReferedBy)) {
        //         $addToReferedBy = new Wallet();
        //         $addToReferedBy->user_id = $referedBy->id;
        //         $addToReferedBy->wallet_amount = 50;            
        //     }
        //     else{
        //         $addToReferedBy->wallet_amount = (int)$addToReferedBy->wallet_amount + 50;
        //     }
        //     $addToReferedBy->save();
        // }

        //Set Response
        $success['token'] =  $user->createToken('PohnchaDoSecretToken')->accessToken; 
        $success['name'] =  $user->first_name.' '.$user->last_name;
        $success['user_id'] =  $user->id;
        $success['user_code'] =  $user->user_code;
        $success['user_wallet'] =  empty($user->wallet) ? 0 : $user->wallet->wallet_amount;
        $success['user_verified'] = $user->is_verified;
        $success['msg'] = 'User registered successfully';
        return response()->json(['success'=>$success], 200);
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'verification_code' => 'required|string|max:10',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = User::find($request->user_id);
        if(!$user){
            return response()->json(['error'=>'User not found'], 401);
        }
        else{
            if ($request->verification_code === $user->verification_code) {
                $user->is_verified = '1';
                $user->email_verified_at = \Carbon\Carbon::now();
                $user->save();

                return response()->json(['success'=>'Your account has been verified'], 200); 
            }
            else{
                return response()->json(['error'=>'Wrong verification code entered'], 401); 
            }
        }
        
    }

    public function sendFcmToken(Request $request)
    {
        $user = UserFCMToken::where('user_id',$request->user_id)->first();
        if (!$user) {
            $userFcm = new UserFCMToken;
            $userFcm->user_id = $request->user_id;
            $userFcm->fcm_tokens = $request->fcm_token;
            $userFcm->save();   
        } else {
            $user->fcm_tokens = $request->fcm_token;
            $user->save();  
        } 
    }

    public function resendVerification(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        // $user->notify(new SendVerificationCode($user));
        event(new VerifyAccount($user));
        return response()->json(['success'=>'Verification code has been sent through email and sms again'], 200); 
    }

    public function forgot_password(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $verification_code = $this->generateRandomString(6);
        if ($user) {
            $user->verification_code = $verification_code;
            $user->save();
            // $user->notify(new SendVerificationCode($user));
            event(new VerifyAccount($user));
            return response()->json(['success' => 'Verification code has been sent to your email',
             'verify_user_id' => $user->id]);
        } else {
            return response()->json(['error' => 'Invalid Email Address']);
        }
        
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|string|max:20', 
            'verification_code' => 'required|string|max:6|min:6',             
            'confirm_password' => 'required|same:password|string|max:20', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $user = User::findOrFail($request->user_id);

        if ($request->verification_code === $user->verification_code) {
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['success'=>'Your password reset successfully'], 200); 
        }
        else{
            return response()->json(['error_msg'=>'Wrong verification code entered'], 401); 
        }

    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['success'=>'User logged out successfully'], 200);               
    }

    public function getUserInfo($user_id){
        $user_info = User::select('users.id','users.first_name','users.last_name','users.email')
        ->where('id',$user_id)->where('user_type_id',2)
        ->with(['customer' => function($query){
            $query->select('customers.id','customers.user_id','customers.phone_num');
        }])->first();
        
        if($user_info){
            return response()->json(['user_info'=>$user_info], 200);
        }
        else{
            return response()->json(['error'=>'User info not found'], 401);
        }
    }

    public function getUserWallet($user_id)
    {
        $user_wallet = Wallet::where('user_id',$user_id)->first();
        
        if($user_wallet){
            return response()->json(['wallet_amount' => $user_wallet->wallet_amount], 200);
        }
        else{
            return response()->json(['wallet_amount' => 0], 200);
        }
    }

    public function editUserInfo(Request $request)
    {
        $user = User::find($request->user_id);

        if(!$user){
            return response()->json(['msg'=>'User info cannot updated'], 200);            
        }
        else{
            $customer = Customer::where('user_id',$request->user_id)->first();

            $user->first_name = ucfirst($request->first_name);
            $user->last_name = ucfirst($request->last_name);
            $customer->phone_num = $request->phone_num;

            if($user->save() && $customer->save()){
                return response()->json(['success'=>'User info updated successfully'], 200);
            }
            else{
                return response()->json(['success'=>'User info cannot updated'], 200);                
            }
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateUserCode($name)
    {
        $timeStamp = time();
        $timePart1 = substr($timeStamp, 0, 2);
        $timePart2 = substr($timeStamp, 4, 2);
        $timePart3 = substr($timeStamp, 8, 2);        
        $userCode = strtoupper($name).$timePart1.$timePart2.$timePart3;

        return $userCode;
    }
}
