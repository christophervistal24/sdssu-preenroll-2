<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
        @page { margin: 100px 25px; }
        header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
        p { page-break-after: always; }
        p:last-child { page-break-after: never; }
        </style>
        <title></title>
        <style>
        table > thead  {
        border-top : 2px solid black;
        border-bottom : 2px solid black;
        text-align: center;
        }
        table > tbody {
        border-bottom : 2px solid black;
        }
        table > tbody > tr > td {
        text-align: center;
        }
        </style>
    </head>
    <body>
        <header>
            <img src="{{ asset('/storage/img/sdssu.png') }}" style="position:absolute; left :18.7% top :0%">
            <center><b>Republic of the Philippines</b></center>
            <center><b>SURIGAO DEL SUR STATE UNIVERSITY</b></center>
            <center><b>Tandag City , Surigao del Sur</b></center>
            <img src="{{ asset('/storage/img/sdssu-cecst-logo.png') }}" style="position:absolute; z-index: 2; top :0%; left :75%">
            <center><b>SY {{ $current_semester->school_year . ' - ' . ($current_semester->school_year+1) }} / {{ digitToWord($current_semester->id) }} SEMESTER</b></center>
        </header>
        <main>
            <div>{!!$grades!!}</div>
        </main>

    </body>
</html>