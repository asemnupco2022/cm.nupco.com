<div>Greetings,</div>
<div><br></div>

@if($mail_data and !empty($mail_data) and $mail_data != '[]')

<p></p>

    <b>Customer Name</b> # {{$mail_data['customer_name']}}</p>
<p><b> Vendor Code</b>: {{$mail_data['vendor_code']}}&nbsp; | {{$mail_data['vendor_name']}}</p>
<p></p>

@if($mail_data['sap_object'] and !empty($mail_data['sap_object']) and $mail_data['sap_object'] !='[]')
<b>PO Items</b>:

<ul>

        <table>
            <thead>
            <tr>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('po_no')  }}</th>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('tender_no')  }}</th>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('po_qty')  }}</th>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('open_qty')  }}</th>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('net_order_value')  }}</th>
                <th>{{ \App\Helpers\PoHelper::NormalizeColString('delivery_date')  }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mail_data['sap_object'] as $key=> $sap_object)
                <tr>
                    <td>{{$sap_object->purchasing_document}}</td>
                    <td>{{$sap_object->tender_no}}</td>
                    <td>{{$sap_object->ordered_quantity}}</td>
                    <td>{{$sap_object->open_quantity}}</td>
                    <td>{{$sap_object->net_order_value}}</td>
                    <td>{{$sap_object->nupco_delivery_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

</ul>


<a href="{{route('web.route.ticket.manager.chat',[$mail_data['hash_token']])}}" class="btn-ghost btn-white btn-align">More Info</a>
@endif
@endif

<div>Please let us know about the status of the shipment. Some details that we want from your side are:</div>
<div>What is the status of the shipment?</div>
<div>On which date/month the order will arrive?</div>
<div>Regards,</div>
<div>{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</div>
