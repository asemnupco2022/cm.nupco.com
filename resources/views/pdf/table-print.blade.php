<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>

    <style>


        table {
            border: 1px solid #ccc !important;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd !important;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* general styling */
        body {

            line-height: 1.25;
            font-size: 12px !important;
        }

        /*html { margin: 1px}*/
    </style>

</head>
<body>
<!-- partial:index.partial.html -->
<table>
    <caption>Document #{{$title}}</caption>
    <thead>
    <tr>
        @if($cols)
            @foreach($cols as $colKey => $column)
                <th>{{ \App\Helpers\PoHelper::NormalizeColString($column)  }}</th>
            @endforeach
        @endif
    </tr>
    </thead>
    <tbody>
    @if($collections and $cols)
        @foreach($collections as $key => $collection)

            <tr>
                @foreach($collection->getAttributes() as $attrKey => $attributes)
                    <td>{!! $collection->{ $attrKey}  !!}   </td>
                @endforeach
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<!-- partial -->

</body>
</html>


