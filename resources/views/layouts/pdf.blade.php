<html>
<head>
{{--    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />--}}

    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @page {
            margin: 0cm 0cm;
        }
        *{
            font-family:  Helvetica, sans-serif;
        }
        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
        table{
            width: 100%;
        }
        th{
            text-align: left;
        }
        .p-2{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .mt-5{
            margin-top: 15px;
            /*border: 1px solid #dddddd;*/
            background-color: #f6f6f6;
            padding: 10px;
        }
        .b{font-weight: bolder;}
        .text-info{
            color: #1d68a7;
        }
        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            min-height: 10cm;
            margin-left: 2cm;
            margin-right: 2cm;
            /* text-align: center; */
            /* line-height: 1cm; */
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            text-align: center;
            /* line-height: 1cm; */
        }
        .page-break {
            page-break-after: always;
        }
        .text-wrap{
            word-break:break-all; word-wrap:break-word;
        }
        .page-number:before {
            content: "Page " counter(page);
        }
        .dotted{
            border-bottom: 1px dotted #555b6d;
        }
        .text-justify{
            text-align: justify;
        }
    </style>
</head>
<body class="bg-transparent">
<!-- Define header and footer blocks before your content -->
<header>
    @yield('header')
</header>
<footer>
    @yield('footer')
</footer>
<!-- Wrap the content of your PDF inside a main tag -->
<main>
    @yield('content')
</main>
</body>
</html>
