@extends('LbsViews::auth_views.layouts.masterLayout')


@section('content')

    @push('styles')
        <style>
            body {
                background: URL('background.jpg');
            }
        </style>
    @endpush

    <livewire:livewire.AuthComponent.loginComponent redirect="lbs.admin.dashboard" guard="admin" model="lbs_admin"/>

@endsection
