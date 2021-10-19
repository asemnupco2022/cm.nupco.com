@extends('LbsViews::admin_views.layouts.masterLayout')
{{--define title here--}}
@section('title_','media manager')

{{--main body content--}}
@section('content')



    <div class="card chat_div_section">
        <div class="card-header">
            <h3 class="card-title">Ticket Conversation</h3>

            <div class="card-tools">
                {{-- add something--}}
            </div>
        </div>
        <div class="card-body">
            @livewire('tickets.ticket-chat-component', ['mail_ticket_hash'=>$mail_ticket_hash])
        </div>
        <!-- /.card-body -->
    </div>



@endsection
