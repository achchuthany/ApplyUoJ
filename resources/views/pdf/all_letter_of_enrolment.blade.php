@extends('layouts.pdf')
@section('footer')
    <div style=" margin:0 50px;text-align:left;font-size: 10px"> <span style="font-size: 10px;float: right">Letter of Enrolment | University of Jaffna</span></div>

@endsection
@section('content')
    @foreach($data as $x)
    <table width="100%" style="margin-bottom: 5px; background: #efefef;">
        <tr>
            <td style="width: 40mm" >
                <div style="width: 35mm;height: 45mm;border: 1px solid #cccccc;">
                    @if(Storage::disk('docs')->exists($x['profileImage']))
                        <img style="width: 35mm;height: 45mm;" src="{{storage_path('app/docs/'.$x['profileImage'])}}">
                    @else
                        <div style="text-align: center" ><p>Photo</p></div>
                    @endif

                </div>
            </td>
            <td  style="text-align: center">
                <img src="{{public_path("/assets/images/logo-sm.png")}}" style="height: 20mm;margin: 0px;">
                <p style="text-transform: uppercase; font-size: 20px; margin: 2px;">University of Jaffna, Sri Lanka</p>
                <p style="text-transform: uppercase;font-size: 18px;margin: 2px;">ADMISSIONS BRANCH</p>
            </td>
        </tr>
    </table>
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <td class="p-1" style="font-size: 16px;font-weight: bold;">Letter of Enrolment</td>
            <td class="p-1" style="font-size: 14px;text-align: right;">Academic Year {{$x['enroll']->academic_year->name}}</td>
        </tr>
    </table>
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <td class="p-1">Full Name</td>
            <td class="p-1 dotted" colspan="3">{{strtoupper($x['student']->full_name)}}</td>
        </tr>
        <tr>
            <td class="p-1" width="18%">NIC No</td>
            <td class="p-1 dotted" width="48%">{{$x['student']->nic}}</td>
            <td class="p-1" width="18%">A/L Index Number </td>
            <td class="p-1 dotted" width="16%">{{$x['student']->al_index_number}}</td>
        </tr>
        <tr>
            <td class="p-1" width="18%">Course of Study</td>
            <td class="p-1 dotted" width="49%" colspan="3">{{strtoupper($x['enroll']->programme->name)}}</td>
               </tr>
        <tr>
            <td class="p-1" width="18%">Registration No.</td>
            <td class="p-1 dotted" width="49%">{{strtoupper($x['enroll']->reg_no)}}</td>
            <td class="p-1" width="18%">Date of Enrolment</td>
            <td class="p-1 dotted" width="16%">{{($x['enroll']->registration_date)?(\Carbon\Carbon::create($x['enroll']->registration_date)->toFormattedDateString()):''}}</td>
        </tr>
    </table>
    <p class="text-justify">
        I hereby acknowledge the receipt of the following documents submitted by you in respect of your registration as an internal student of this University for the above course of study effective from the above Academic Year.
    </p>
    <p style="margin: auto"></p>

    <table class="border" style="table-layout: fixed; border-collapse: collapse; width: 100%; border: 1px solid #3F3F3F;text-align: center;">
        <tr style="background: #cccccc;">
            <th class="p-1" style="width: 5%; text-align: center;">No</th>
            <th class="p-1" style="border:1px solid #3F3F3F;">Title</th>
            <th class="p-1" style="width: 8%;text-align: center;">Original</th>
            <th class="p-1" style="width: 5%;text-align: center;">Y/N</th>
            <th class="p-1" style="width: 8%;text-align: center;">Copy</th>
            <th class="p-1" style="width: 5%;text-align: center;">Y/N</th>
        </tr>

        <tr>
            <td class="p-1">01</td>
            <td class="p-1" style="text-align: left;">Selection Letter sent by the UGC</td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>

        <tr>
            <td class="p-1">02</td>
            <td class="p-1" style="text-align: left;">Duly completed Application  Form for Registration</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
        </tr>


        <tr>
            <td class="p-1">03</td>
            <td class="p-1" style="text-align: left;">Payment voucher of registration fee and other fees of  Rs.2350 made by Peoples’ Bank</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>

        </tr>


        <tr>
            <td class="p-1">04</td>
            <td class="p-1" style="text-align: left;">NIC Photocopy</td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>

        <tr>
            <td class="p-1">05</td>
            <td class="p-1" style="text-align: left;">Photocopy of the G.C.E. (A/L) Certificate </td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>
        <tr>
            <td class="p-1">06</td>
            <td class="p-1" style="text-align: left;">Photocopy of the G.C.E. (O/L) Certificate </td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>
        <tr>
            <td class="p-1">07</td>
            <td class="p-1" style="text-align: left;">School Leaving Certificate </td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>

        </tr>
        <tr>
            <td class="p-1">08</td>
            <td class="p-1" style="text-align: left;">Duly completed declaration form on Prohibition of Ragging and other forms of violence</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
        </tr>
        <tr>
            <td class="p-1">09</td>
            <td class="p-1" style="text-align: left;">Medical Form</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>

        </tr>
        <tr>
            <td class="p-1">10</td>
            <td class="p-1" style="text-align: left;">10 copies of Passport(35mmX45mm) size colour Photograph of the applicant </td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>

        </tr>
        <tr>
            <td class="p-1">11</td>
            <td class="p-1" style="text-align: left;">Birth Certificate </td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>
        <tr>
            <td class="p-1">12</td>
            <td class="p-1" style="text-align: left;">English translation of the birth certificate</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
        </tr>
        <tr>
            <td class="p-1">13</td>
            <td class="p-1" style="text-align: left;">Affidavit / Marriage certificate, if there is a difference in the name</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>
        </tr>
        <tr>
            <td class="p-1">14</td>
            <td class="p-1" style="text-align: left;">Student Identity Card Form</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>

        </tr>
        <tr>
            <td class="p-1">15</td>
            <td class="p-1" style="text-align: left;">Declaration for  Degree Certificate</td>
            <td class="p-1">Yes</td>
            <td class="p-1"></td>
            <td class="p-1" style="background:#888888"></td>
            <td class="p-1" style="background:#888888"></td>

        </tr>

    </table>

    <p>This Letter is issued to you for temporary identification until the University Identity Card is issued.</p>

    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;margin-top: 0">
        <tr>
            <td class="p-1" style="width: 25%"></td>
            <td class="p-1" style="width: 25%;"></td>
            <td class="p-1" style="width: 25%;text-align: right;">Prepared  by</td>
            <td class="p-1 dotted" style="width: 25%;"></td>
        </tr>
        <tr>
            <td class="p-1 dotted" colspan="2"></td>
            <td class="p-1" style="text-align: right;">Checked by</td>
            <td class="p-1 dotted"></td>
        </tr>
        <tr>
            <td class="p-1" colspan="2">AR/SAR/DR, Admissions Branch</td>
            <td class="p-1" style="text-align: right;">Date of Issue</td>
            <td class="p-1 dotted"></td>
        </tr>
    </table>
    <div class="page-break"></div>
    @endforeach
@endsection

