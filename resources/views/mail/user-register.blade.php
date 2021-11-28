@component('mail::message')
# Wellcome To {{ config('app.name') }}

Your Login Credencials are:

Login ID: {{$email}}
Login Password: {{$password}}

@component('mail::button', ['url' =>  config('app.url') ])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
