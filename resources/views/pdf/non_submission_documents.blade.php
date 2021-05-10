@extends('layouts.pdf')
@section('header')
   <p>Reference Number: {{$enroll->getRefNo()}} <span style="float: right">Office Use Reg.No: .....................................</span></p>
@endsection

@section('footer')
    <div class="page-number" style=" margin:0 50px;text-align:left;font-size: 10px">  | {{\Carbon\Carbon::now('Asia/Colombo')->toFormattedDateString().' '. \Carbon\Carbon::now('Asia/Colombo')->toTimeString()}} <span style="font-size: 10px;float: right">Non–Submission of Documents | University of Jaffna</span></div>

@endsection
@section('content')
    <table width="100%" style="margin-bottom: 10px">
        <tr>
            <td style="width: 15%" >

                <div style="width: 35mm;height: 45mm;border: 5px solid #cccccc;">
                    @if(Storage::disk('docs')->exists($profileImage))
                        <img style="width: 35mm;height: 45mm;" src="{{storage_path('app/docs/'.$profileImage)}}">
                    @else
                        <div style="text-align: center" ><p>Photo</p></div>
                    @endif

                </div>
            </td>
            <td  style="width: 85%;text-align: center">
                <img src="{{public_path("/assets/images/logo-sm.png")}}" style="height: 30mm">
                <div >University of Jaffna, Sri Lanka.</div>
                <h3 style="text-transform: uppercase;">Non–Submission of Documents</h3>
            </td>
        </tr>
    </table>


    <table style="table-layout: fixed; border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <td class="p-2" width="30%">A/L Index Number </td>
            <td class="p-2 pl-3 py-3 dotted">{{$student->al_index_number}}</td>
        </tr>
        <tr>
            <td class="p-2">Faculty</td>
            <td class="p-2 dotted">{{$enroll->programme->faculty->name}}</td>
        </tr>
        <tr>
            <td class="p-2">Full Name</td>
            <td class="p-2 dotted">{{$student->full_name}}</td>
        </tr>
        <tr>
            <td class="p-2">Course of Study</td>
            <td class="p-2 pl-3 py-3 dotted">{{$enroll->programme->name}}</td>
        </tr>

        <tr>
            <td class="p-2">National Identity Card No</td>
            <td class="p-2 pl-3 py-3 dotted">{{$student->nic}}</td>
        </tr>
    </table>

    <p style="font-weight: bolder;">I regret to inform you that I am unable tosubmit the following documents</p>
    <p style="margin: auto"></p>

    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;margin-top: 0; ">
        <tr style="background-color: #cccccc;">
            <td class="p-2" style="width: 5%;border: 1px solid black;padding: 10px;">No</td>
            <td class="p-2" style="width: 35%;border: 1px solid black;padding: 10px;">Documents</td>
            <td class="p-2" style="width: 50%;border: 1px solid black;padding: 10px;">Reason for not submitting documents</td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">01</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">02</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>

        <tr>
            <td style="border: 1px solid black;padding: 10px;">03</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">04</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">05</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">06</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">07</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">08</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">09</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;padding: 10px;">10</td>
            <td style="border: 1px solid black;padding: 10px;"></td>
            <td style="border: 1px solid black;padding: 10px;"></td>
        </tr>
    </table>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;margin-top: 25px;">
        <tr>
            <td style="width: 50%">....../....../............</td>
            <td style="width: 50%; text-align: right;">................................................</td>
        </tr>
        <tr>
            <td class="p-2">Date</td>
            <td class="p-2" style="text-align: right;">Signature of the Student</td>
        </tr>
    </table>
@endsection

