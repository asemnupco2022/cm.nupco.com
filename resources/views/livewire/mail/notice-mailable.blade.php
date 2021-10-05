<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <title></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            padding-top: 20px;
            padding-bottom: 20px;
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
            max-width: 470px;
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
            padding: 28px 11% 20px 11%;
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

            <p class="text-main"> {!!  $msg_content !!}</p>

        </div>
        <div class="footer">
            <p>Sent by  &#8226; <a href="{{LaravelCms::lbs_object_key_exists('app_url',Session::get('_LbsAppSession'))}}">{{LaravelCms::lbs_object_key_exists('app_company',Session::get('_LbsAppSession'))}}</a> </p>
        </div>
    </div>
</body>

</html>
