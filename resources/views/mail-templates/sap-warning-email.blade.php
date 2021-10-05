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

<p>Your Shipment has exceeded the time of arrival, please read this letter as a warning of penalty that can be commenced if you are unable to proceed with the order in time.</p>
<p>Please try to send the offer as soon as possible, otherwise penalties can be put.</p>
<p>Regards,</p>
<div>{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</div>
