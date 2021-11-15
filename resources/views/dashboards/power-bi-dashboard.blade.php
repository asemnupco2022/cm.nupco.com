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
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiYjk5ODZkM2YtMjIyYy00ZDkyLWE1YmItNTlmOTlkYjk5YzQ3IiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif

@if(isset($suppliers_performance))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiMTg0YWJiN2EtZGFiMy00ODMxLThjNDUtNGZkY2M3ZWZiOWVlIiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif


@if(isset($tenders))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiMzdlMGYzYjctYzZlNS00MmRmLWJkMjQtODg4ZTQ3OTU1M2IxIiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif


@if(isset($progress))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiNTJiZGQxZjEtMTE2OS00NjU2LThmOGEtMDU1YjJmYTg1MThhIiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif


@if(isset($over_due))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiODgyNWVjNWEtMzgwMi00NzIwLThmNTEtY2MwZWZmODlmM2ZkIiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif


@if(isset($contracts_expediting))
<iframe id="inlineFrameExample"
        title="Inline Frame Example"
        width="100%"
        height="500px"
        src="https://app.powerbi.com/view?r=eyJrIjoiOWExMmE0ZGYtYTNjYy00YjNmLThkNzItYTI2MDk0MjA3YWVkIiwidCI6IjE3OTU5ZDQzLWVlNjAtNGI5NC1hNTQ5LWJlMzIzZWIwZjQzNiIsImMiOjl9">
</iframe>
@endif


