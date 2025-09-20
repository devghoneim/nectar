<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\RestPassword;
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
        return $this->success(__('messages.successfully_register_please_verify'),$this->authService->register($r->validated()));    
            
        } catch (\Exception $e) {
            return $this->fail();
        }     
    }


    public function verifyPhone(VerifyRequest $r)
    {
        return $this->success(__('messages.verified'),$this->authService->verifyPhone($r->validated()));
    }


    public function restPassword(RestPassword $r)
    {
         return $this->authService->restPassword($r->validated());

    }

    public function isValide(VerifyRequest $r) {
        try {
        return $this->success(__('messages.verified'),$this->authService->isValide($r->validated()));
            
        } catch (\Throwable $th) {
            return $this->fail();

        }
    }

   
    public function sendCode(SendCodeRequest $r)
    {
        
     return $this->success(__('messages.successfully_register_please_verify'),$this->authService->sendCode($r->validated()));    

    }

    public function login(LoginRequest $r)
    {
        
      
     return $this->success(__('messages.successfully_register_please_verify'),$this->authService->login($r->validated()));    

    }

    public function logout(Request $r)
    {
         
         return $this->success(__('messages.logout'),$this->authService->logout($r));

    }


















}
