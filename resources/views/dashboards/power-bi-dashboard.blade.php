@push('styles')
    <style>
        iframe {
            width: 100%;
            min-height: 1000px !important;
        }
        .content-header {
            padding: 0px 0rem  !important;
        }

        .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
            width: 100%;
            padding-right: 0px;
            padding-left: 0px;
            margin-right: auto;
            margin-left: auto;
        }

        .content-wrapper>.content {
            padding: 0 0rem;
        }

    </style>
@endpush
@if(isset($summary))
@if(auth()->user()->hasAnyPermission(['access_summary_dashboard']))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        frameborder="0" allowfullscreen
        src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Summary%20Dashboard?rs:embed=true">
</iframe>
@endif
@endif

@if(isset($suppliers_performance))
@if(auth()->user()->hasAnyPermission(['access_suppliers_dashboard']))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Suppliers%20Performance?rs:embed=true">

</iframe>
@endif
@endif


@if(isset($tenders))
@if(auth()->user()->hasAnyPermission(['access_tenders_dashboard']))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Tenders?rs:embed=true">
</iframe>
@endif
@endif


@if(isset($progress))
@if(auth()->user()->hasAnyPermission(['access_progress_dashboard']))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Progress?rs:embed=true">
</iframe>
@endif
@endif


@if(isset($over_due))

@if(auth()->user()->hasAnyPermission(['access_over_due_dashboard']))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Over%20Due?rs:embed=true">
</iframe>
@endif
@endif


@if(isset($contracts_expediting))
    @if(auth()->user()->hasAnyPermission(['access_contracts_expediting_dashboard']))
    <iframe id="inlineFrameExample"
            title="Inline Frame Example"
            width="100%"
            height="500px"
            src="https://nupcobi.nupco.com/Reports/powerbi/Contract/Contracts%20Expediting%20Dashboard?rs:embed=true">
    </iframe>
    @endif
@endif

@if (isset($ces_dashboard))
    @if(auth()->user()->hasAnyPermission([ 'access_ces_dashboard']))
         @include('dashboards.notification-report-dashboard')
    @endif
@endif



<script type="text/javascript">
    var iframeURL = $ifram_url;
    var iframeID = 'power_bi_ifram';

    function loadIframe(){
        //pre-authenticate
        var req = new XMLHttpRequest();
        req.open("POST",this.iframeURL, false, "cmadmin@nupco.com", "Nup%8090c"); //use POST to safely send combination
        req.send(null); //here you can pass extra parameters through

        //setiFrame's SRC attribute
        var iFrameWin = document.getElementById(this.iframeID);
        iFrameWin.src = this.iframeURL + "?extraParameters=true";
    }

    //onload, call loadIframe() function
    loadIframe();
</script>

