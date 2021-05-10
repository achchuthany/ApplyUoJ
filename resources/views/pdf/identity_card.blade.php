@extends('layouts.pdf')
@section('header')
   <p>Reference Number: {{$enroll->getRefNo()}} <span style="float: right">Office Use Reg.No: .....................................</span></p>
@endsection

@section('footer')
    <div class="page-number" style=" margin:0 50px;text-align:left;font-size: 10px">  | {{\Carbon\Carbon::now('Asia/Colombo')->toFormattedDateString().' '. \Carbon\Carbon::now('Asia/Colombo')->toTimeString()}} <span style="font-size: 10px;float: right">Application for Student’s Identity Card | University of Jaffna</span></div>

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
                <h3 style="text-transform: uppercase;">Application for Student’s Identity Card</h3>
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
            <td class="p-2">Permanent Address </td>
            <td class="p-2 dotted">{{$permanentAddress}}</td>
        </tr>
        <tr>
            <td class="p-2">Course of Study</td>
            <td class="p-2 pl-3 py-3 dotted">{{$enroll->programme->name}}</td>
        </tr>

        <tr>
            <td class="p-2">National Identity Card No</td>
            <td class="p-2 pl-3 py-3 dotted">{{$student->nic}}</td>
        </tr>
        <tr>
            <td class="p-2">Specimen Signature</td>
            <td class="p-2 pl-3 py-3" style="border: 1px solid black;padding:40px 0px;margin-top: 15px;"></td>
        </tr>
    </table>
    <p class="text-justify">
        Duplicate of an  Identity  Card will not be issued  under normal circumstances. Hence utmost care should be taken of this Identity Card. However, under circumstances duplicate of an Identity Card may  be  issued  on  the  payment  of  Rs 1000/=  with  a  police  entry,  if  the  loss  or  damaged  the Student’s Identity Card is justified.
    </p>

    <p style="font-weight: bolder;">The above details are true and correct</p>
    <p style="margin: auto"></p>

    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td style="width: 50%">....../....../............</td>
            <td style="width: 50%; text-align: right;">................................................</td>
        </tr>
        <tr>
            <td class="p-2">Date</td>
            <td class="p-2" style="text-align: right;">Signature of the Student</td>
        </tr>
    </table>

    <p style="border-bottom: 2px solid black;"></p>
    <p style="margin: 0; text-transform: uppercase;font-weight: bolder;">Office use only </p>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;margin-top: 0">
        <tr>
            <td class="p-2" style="width: 25%">Checked by Name</td>
            <td class="p-2 pl-3 py-3 dotted" style="width: 25%;"></td>
            <td class="p-2 pl-3 " style="width: 25%">Signature</td>
            <td class="p-2 pl-3 py-3 dotted" style="width: 25%;"></td>
        </tr>
        <tr>
            <td class="p-2">Date of issue</td>
            <td class="p-2" style="border-bottom: 1px dotted black;"></td>
            <td class="p-2">Date of Expiry</td>
            <td class="p-2" style="border-bottom: 1px dotted black;"></td>
        </tr>


        <tr>
            <td class="p-2" style="font-weight: bolder;">Approved </td>
            <td class="p-2 pl-3 py-3" style="border-bottom: 1px dotted black;" colspan="3">Assistant Registrar :  </td>
        </tr>
    </table>
    <p style="border-bottom: 2px solid black;"></p>
    <p>I have received the student’s Identity card</p>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
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

