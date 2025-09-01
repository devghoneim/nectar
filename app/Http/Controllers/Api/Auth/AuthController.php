<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\Http\Traits\Response;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use Response;

    public function __construct(private AuthService $authService)
    {
        
    }
    
    public function register(RegisterRequest $r)
    {   
        try {
            $this->authService->register($r->validated());
            return $this->success(__('messages.successfully_register_please_verify'));    
            
        } catch (\Throwable $th) {
            return $this->fail($th);
        }     
    }


    public function verify(VerifyRequest $r)
    {
        $data =  $this->authService->verify($r->validated());
        return $this->success(__('messages.verified'),$data['user'],201,[$data['token']]);
    }

    public function sendCode(SendCodeRequest $r)
    {
        $this->authService->sendCode($r->validated());
     return $this->success(__('messages.successfully_register_please_verify'));    

    }

    public function login(LoginRequest $r)
    {
        
      $user =   $this->authService->login($r->validated());
     return $this->success(__('messages.successfully_register_please_verify'),$user,200);    

    }

    public function logout(Request $r)
    {
         $this->authService->logout($r);
         return $this->success(__('messages.logout'));

    }


















}
