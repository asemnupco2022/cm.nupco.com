<?php


namespace rifrocket\LaravelCms\Http\Livewire\AuthControllers;


use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class ForgetPasswordComponent
{
    public $email = '';
    public $model = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'Email Address cannot be empty.',
        'email.email' => 'Email Address format is not valid.',
        'password.required' => 'Password cannot be empty.',
    ];


    public function onForgetPassword()
    {

        $this->validate();

        return LaravelCmsFacade::lbs_forgetPassword(
            $this->model,$this->email
        );

    }
}
