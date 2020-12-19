@extends('layouts.master-topbar')
@section('title')
    Personal Data of Students
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Registration @endslot
        @slot('title')
            Personal Data of Students
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4 bg-light">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-12">
                                    @include('registration.nav')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="p-4 border-top">
                        <div class="row mb-4">
                            <div class="col-md-12 bg-soft-info rounded">
                                <p class="pt-2">
                                    Please provide some introductory details about yourself below. Once you have finished entering your details, use the <b>'Proceed with Registration'</b> button provided at the bottom of the page to continue with your registration.
                                    <span class="text-info">*Mandatory fields</span>
                                </p>

                            </div>
                        </div>

                        @if(Route::currentRouteName()=='student.personal')
                            @include('registration.personal')
                        @endif
                        @if(Route::currentRouteName()=='student.address')
                            @include('registration.address')
                        @endif
                        @if(Route::currentRouteName()=='student.education')
                            @include('registration.education')
                        @endif
                        @if(Route::currentRouteName()=='student.citizenship')
                            @include('registration.citizenship')
                        @endif
                        @if(Route::currentRouteName()=='student.parents')
                            @include('registration.parents')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
    @if(Route::currentRouteName()=='student.citizenship')
        <script>
            if(!$('#RaceOthers').is(':checked')){
                document.getElementById('RaceSpecifyShow').style.visibility='hidden';
            }
            @if(strlen($student->race)>1)
                document.getElementById('RaceSpecifyShow').style.visibility='visible';
                $('#RaceOthers').prop("checked", true);
            @endif

            if(!$('#religionOthers').is(':checked')){
                document.getElementById('religionSpecifyShow').style.visibility='hidden';
            }
            @if(strlen($student->religion)>1)
            document.getElementById('religionSpecifyShow').style.visibility='visible';
            $('#religionOthers').prop("checked", true);
            @endif


            function raceHandleShow() {
                document.getElementById('RaceSpecifyShow').style.visibility='visible';
            }
            function raceHandleHide() {
                document.getElementById('RaceSpecifyShow').style.visibility='hidden';
            }
            function religionHandleShow() {
                document.getElementById('religionSpecifyShow').style.visibility='visible';
            }
            function religionHandleHide() {
                document.getElementById('religionSpecifyShow').style.visibility='hidden';
            }

            function calculateAge() {
                var birthday = new Date(document.getElementById('date_of_birth').value);
                var ageDifMs = Date.now() - birthday.getTime();
                var ageDate = new Date(ageDifMs); // miliseconds from epoch

                document.getElementById('age').value = Math.abs(ageDate.getUTCFullYear() - 1970) +' years';
            }
            calculateAge();


            //countr
            document.getElementById('IfSriLankan').style.visibility='hidden';
            $('#citizenship').on('change', function() {
                if(this.value=='Sri Lanka'){
                    document.getElementById('IfSriLankan').style.visibility='visible';
                }else{
                    document.getElementById('IfSriLankan').style.visibility='hidden';
                    $('#Descent').prop("checked", false);
                    $('#Registration').prop("checked", false);
                }

            })

            @if($student->citizenship=="Sri Lanka")
            document.getElementById('IfSriLankan').style.visibility='visible';
            @endif
        </script>
    @endif
@endsection
