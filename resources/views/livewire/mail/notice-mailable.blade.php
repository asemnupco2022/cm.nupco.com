<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <title></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

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

    </style>
</head>

<body>

    <h2> {{\App\Helpers\PoHelper::NormalizeColString($msg_subject )}}</h2>
    <br>
    <p class="text-main"> {!!  $msg_content !!}</p>
    <div class="footer">
        <p>Sent by &#8226; <a
                href="{{LaravelCms::lbs_object_key_exists('app_url',Session::get('_LbsAppSession'))}}">{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</a>
        </p>
    </div>

</body>

</html>
