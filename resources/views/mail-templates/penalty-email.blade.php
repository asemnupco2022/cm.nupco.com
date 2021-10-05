<p>Greetings,</p>
<div><br></div>

@if($mail_data and !empty($mail_data) and $mail_data != '[]')

    <p></p>
    <p>
        <b>Purchasing Document</b> # {{$mail_data['purchasing_code']}}</p>
    <b>Customer Name</b> # {{$mail_data['customer_name']}}</p>
    <p><b> Vendor Code</b>: {{$mail_data['vendor_code']}}&nbsp; | {{$mail_data['vendor_name']}}</p>
    <p></p>

    @if($mail_data['po_items'] and !empty($mail_data['po_items']) and $mail_data['po_items'] !='[]')
        <b>PO Items</b>:

        <ul>
            @foreach($mail_data['po_items'] as $key=>  $poitem)
                <li>{{$key}}</li>
            @endforeach
        </ul>
    @endif
@endif

<p>Your Shipment has exceeded the warning time period. You were unable to deliver us the product in time after our multiple mails of time exceeding warnings. With reference to the last mail we sent you.</p>
<p>Regards,</p>
<div>{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</div>
