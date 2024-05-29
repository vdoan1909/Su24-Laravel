<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .right-side {
            padding: 20px;
        }

        .title h3 {
            margin-bottom: 20px;
            font-size: 1.75rem;
            color: #ffffff;
        }

        #table {
            width: 100%;
            margin-bottom: 30px;
            background: #ffffff;
            color: #333333;
            border-radius: 10px;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        #table th,
        #table td {
            vertical-align: middle;
            padding: 15px;
            border: 1px solid #dddddd;
        }

        #table th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-align: left;
            color: #333333;
            border-bottom: 2px solid #dddddd;
        }

        #table tbody tr:nth-child(odd) {
            background-color: #fafafa;
        }

        #table td img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 5px;
        }

        #table th,
        #table td {
            text-align: left;
        }

        #table td span {
            color: #999999;
            font-style: italic;
        }

        #table caption {
            caption-side: top;
            text-align: left;
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333333;
        }


        .btn-success {
            height: 40px;
            background-color: #000000;
            border-color: #ffffff;
        }

        .btn-success:hover {
            background-color: #0a0707;
            border-color: #eeeded;
        }

        @media (max-width: 768px) {
            .left-side {
                min-height: auto;
                border-right: none;
                border-bottom: 2px solid #000000;
            }

            .left-side a {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div id="fui-toast"></div>
