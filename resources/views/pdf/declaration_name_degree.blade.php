@extends('layouts.pdf')
@section('header')
   <p>Reference Number: {{$enroll->getRefNo()}} <span style="float: right">Office Use Reg.No: .....................................</span></p>
@endsection

@section('footer')
    <div class="page-number" style=" margin:0 50px;text-align:left;font-size: 10px">  | {{\Carbon\Carbon::now('Asia/Colombo')->toFormattedDateString().' '. \Carbon\Carbon::now('Asia/Colombo')->toTimeString()}} <span style="font-size: 10px;float: right">Declaration | University of Jaffna</span></div>

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
                <h3 style="text-transform: uppercase;">Declaration</h3>
            </td>
        </tr>
    </table>


    <table style="table-layout: fixed; border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <td class="p-2" width="30%">A/L Index Number </td>
            <td class="p-2 dotted">{{$student->al_index_number}}</td>
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
            <td class="p-2 dotted">{{$enroll->programme->name}}</td>
        </tr>

        <tr>
            <td class="p-2">National Identity Card No</td>
            <td class="p-2 dotted">{{$student->nic}}</td>
        </tr>
    </table>
    <p class="text-justify">
        I do hereby confirm that the full name written below is spelt correct and the correct order to appear in the degree certificate. I understand that there will not be any certificate issued to me again under any circumstances what so ever.
    </p>
    <p style="font-weight: bolder;">Name to appear in degree certificate in the following manner</p>
    <p style="margin: auto"></p>

    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
       <tr>
           <td rowspan="3" style="width: 15%">English</td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>
           <td  style="border: 1px solid black;padding: 13px;"></td>


       </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>
        <tr>
            <td colspan="17" class="p-2"></td>
        </tr>
        <tr>
            <td rowspan="3" style="width: 15%">Tamil</td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>


        </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>
        <tr>
            <td colspan="17" class="p-2"></td>
        </tr>
        <tr>
            <td rowspan="3" style="width: 15%">Sinhala</td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>


        </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>
        <tr>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
            <td  style="border: 1px solid black;padding: 13px;"></td>
        </tr>

    </table>

    <p>Copy of the National identity card should be attached.</p>
    <p class="text-justify">Evidence and Affidavit should be attached if there is any discrepancy between the name in the personal file at the  time  of registration and  the  name  indicated above  to confirm that both of the  names indicate one and the same person.</p>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td style="width: 50%">....../....../............</td>
            <td style="width: 50%; text-align: right;">.......................................</td>
        </tr>
        <tr>
            <td class="p-2">Date</td>
            <td class="p-2" style="text-align: right;">Signature of the Student</td>
        </tr>
    </table>
@endsection

