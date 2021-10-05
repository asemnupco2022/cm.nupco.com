<?php


namespace rifrocket\LaravelCms\Http\Livewire\AuthControllers;

use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use Livewire\Component;
use TorMorten\Eventy\Facades\Eventy;

class LoginComponent extends Component
{
    public $email = 'developer@gmail.com';
    public $password = '123456789';
    public $rememberMe = '';

    //props
    public $redirect = '';
    public $guard = '';
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

    public function onLogin()
    {

        $this->validate();
        Eventy::action('my.hook', 'menu_to_set');
    return LaravelCmsFacade::lbs_login(
            $this->model,
            [
                'email' => $this->email,
                'password' => $this->password,
                'rememberMe' => $this->rememberMe
            ]
            , $this->redirect, $this->guard
        );


    }

    public function render()
    {
        return view('LbsViews::livewire.AuthComponent.loginComponent');
    }
}
