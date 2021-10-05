<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <title></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');


        table {
            width: 450px;
            border-collapse: collapse;
            margin:40px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td, th {
            padding: 5px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 14px;
        }

        /*
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        /*@media*/
        /*only screen and (max-width: 760px),*/
        /*(min-device-width: 768px) and (max-device-width: 1024px)  {*/

        /*    table {*/
        /*        width: 100%;*/
        /*    }*/

        /*    !* Force table to not be like tables anymore *!*/
        /*    table, thead, tbody, th, td, tr {*/
        /*        display: block;*/
        /*    }*/

        /*    !* Hide table headers (but not display: none;, for accessibility) *!*/
        /*    thead tr {*/
        /*        position: absolute;*/
        /*        top: -9999px;*/
        /*        left: -9999px;*/
        /*    }*/

        /*    tr { border: 1px solid #ccc; }*/

        /*    td {*/
        /*        !* Behave  like a "row" *!*/
        /*        border: none;*/
        /*        border-bottom: 1px solid #eee;*/
        /*        position: relative;*/
        /*        !* padding-left: 50%;  *!*/
        /*    }*/

        /*    td:before {*/
        /*        !* Now like a table header *!*/
        /*        position: absolute;*/
        /*        !* Top/left values mimic padding *!*/
        /*        top: 6px;*/
        /*        left: 6px;*/
        /*        !* width: 45%;  *!*/
        /*        !* padding-right: 10px;  *!*/
        /*        white-space: nowrap;*/
        /*        !* Label the data *!*/
        /*        content: attr(data-column);*/

        /*        color: #000;*/
        /*        font-weight: bold;*/
        /*    }*/

        /*}*/

        body {
            margin: 0;
            padding: 0;
            /* padding-top: 20px; */
            /* padding-bottom: 20px; */
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f2f2f2;
        }

        img {
            width: 100%;
            border: 0;
            outline: none;
        }

        h2 {
            padding: 50px 0 0 0;
            margin: 0;
            font-weight: 700;
            font-size: 25.31px;
            line-height: 29.8734177px;
        }

        p.text-main {
            margin: 0;
            padding-top: 16.7088608px;
            font-size: 15.1898734px;
        }

        .wrapper {
            max-width: auto;
            margin: 0 auto;
            height: 100%;
        }

        .container {
            background-color: #FAFAF9;
            height: inherit;
            -webkit-box-shadow: inset 0px 0px 0px 0.8px #E4E4E4;
            -moz-box-shadow: inset 0px 0px 0px 0.8px #E4E4E4;
            box-shadow: inset 0px 0px 0px 0.8px #E4E4E4;
            border-radius: 2px;
        }

        .header {
            position: relative;
            background: #201F2F;
            /*height: 80px;*/
            text-align: center;
            color: #FAFAF9;
            font-weight: 700;
            font-size: 17.72px;
            /*line-height: 80px;*/
            padding: 31px 11% 31px 11%;
            border-radius: 2px 2px 0 0;
        }

        .main-content {
            padding-top:10px;
            text-align: center;
            color: #201F2F;
        }

        .button {
            text-decoration: none;
            border-radius: 3px;
            font-size: 15.1898734px;
            font-weight: 700;
            color: #FAFAF9;
            outline: 0;
            outline-offset: 0;
            border: 0;
            background-color: #6484BC;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 40px;
            padding-right: 40px;
            display: inline-block;
            margin-top: 30.8860759px;
        }

        .footer {
            height: 90px;
            padding-top: 15.6962025px;
            padding-left: 11%;
            padding-right: 11%;
            font-size: 12.6582278px;
            line-height: 14.6835443px;
            text-align: center;
        }

        .footer p,
        .footer a {
            font-size: 10.6582278px;
            line-height: 12.6835443px;
            margin: 0;
            padding: 0;
            padding-bottom: 5.56962025px;
            color: #a9a9a9;
        }

        p.sub-text {
            margin: 0;
            padding-top: 100px;
            font-size: 15.1898734px;
            color: #62626d;
        }

        p.long-link {
            font-size: 10.1265823px;
            text-align: justify;
            overflow-wrap: anywhere;
            color: #62626d;
        }


        *, *:after, *:before {
            box-sizing: border-box;
        }

        html { font-size: 62.5%; }
        body { margin: 0; padding: 0; }

        /* buttons */

        .btn-align { position: relative; top: 45%; }
        .btn-ghost {
            display: block;
            width: 340px; width: 34rem;
            height: 66px; height: 6.6rem;
            font: 700 20px/66px "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif; font: 2.0rem/6.6rem;
            letter-spacing: 0.01rem;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            transition: all .16s ease;
            margin: 0 auto;
        }
        .btn-blue  { color: #06c; border: 2px solid #06c; }
        .btn-blue:hover, .btn-blue:active, .btn-blue:focus  {
            color: #fff;
            background-color: #06c;
            border: 2px solid #06c;
        }
        .btn-white { color: #df1e1e;
            border: 2px solid #7c0909;}
        .btn-white:hover, .btn-white:active, .btn-white:focus  {
            color: #df1e1e;
            background-color: #fff;
            border: 2px solid #fff;
        }

        @media screen and (max-width: 420px) { /* iPhone Landscape */
            .btn-ghost {
                width: 290px; width: 29.0rem;
                height: 50px; height: 5.0rem;
                font-size: 16px; font-size: 1.6rem;
                line-height: 50px; line-height: 5.0rem;
            }
        }

        /* Backgrounds */

        div#bg-blue { background-color: #06c; height: 50vh; }
        div#bg-gray { background-color: #eee; height: 50vh; }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="container">
        <div class="header">
            {{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}
        </div>
        <div class="main-content">
            <img src="{{URL(LaravelCms::lbs_object_key_exists('app_logo',Session::get('_LbsAppSession')))}}" alt="{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}" border="0">
            <h2> {!!  $msg_subject !!}</h2>

             {!!  $msg_content !!}

        </div>
        <div class="footer">
            <p>Sent by  &#8226; <a href="{{LaravelCms::lbs_object_key_exists('app_url',Session::get('_LbsAppSession'))}}">{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</a> </p>
        </div>
    </div>
</body>

</html>
