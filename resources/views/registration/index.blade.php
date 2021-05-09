@extends('layouts.master-topbar')
@section('title')
    Personal Data of Students
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Lightbox css -->
    <link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/cropperjs/cropperjs.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #07B524; width:0%; height:30px; }
        .percent { position:absolute; display:inline-block; left:50%; color: #040608;}


        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 35mm;
            height: 45mm;
            margin: 10px;
            border: 1px solid red;
        }
        .modal-lg{
            max-width: 1000px !important;
        }

    </style>
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
                <div class="p-4 bg-white">
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
                            <div class="col-md-12">
                                <p class="pt-2">
                                    <span class="text-danger">*</span><b class="text-info">Mandatory fields</b> |
                                    Once you have finished entering your details, use the <b>'Next'</b> button provided at the bottom of the page to continue with your registration.
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
                        @if(Route::currentRouteName()=='student.photograph')
                            @include('registration.photograph')
                        @endif
                        @if(Route::currentRouteName()=='student.documents')
                            @include('registration.documents')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    //model--}}

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop"><i class="mdi mdi-crop"></i> Crop and Upload</button>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <!-- Magnific Popup-->
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
    <!-- lightbox init js-->
    <script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jquery-form/jquery-form.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/cropperjs/cropperjs.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/photograph.upload.js')}}"></script>

    <script>
        $(".select2").select2();
        var _token = "{{ csrf_token() }}";
    </script>
    @if(Route::currentRouteName()=='student.education')
        <script>


            $('#subject_2').on('change', function() {
                $("#subject_2 option:contains("+$('#subject_1').val()+")").attr("disabled","disabled");
            });
            $('#subject_3').on('change', function() {
                $("#subject_3 option:contains("+$('#subject_2').val()+")").attr("disabled","disabled");
                $("#subject_3 option:contains("+$('#subject_1').val()+")").attr("disabled","disabled");

            });

        </script>
    @endif

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

{{--    @if(Route::currentRouteName()=='student.documents')--}}
{{--    <script>--}}

{{--        function validate(formData, jqForm, options) {--}}
{{--            var form = jqForm[0];--}}
{{--            if (!form.image.value || !form.bank.value || !form.lc_f.value || !form.lc_b.value|| !form.nic_f.value||!form.nic_b.value) {--}}
{{--                Swal.fire("Warning", "Please select all required files", "warning");--}}
{{--                return false;--}}
{{--            }--}}
{{--        }--}}
{{--        (function() {--}}
{{--            var bar = $('.bar');--}}
{{--            var percent = $('.percent');--}}
{{--            var status = $('#upload_status');--}}
{{--            $('#document-upload').ajaxForm({--}}
{{--               // beforeSubmit: validate,--}}
{{--                beforeSend: function() {--}}
{{--                    status.empty();--}}
{{--                    $('#progress-data').show();--}}
{{--                    var percentVal = '0%';--}}
{{--                    var posterValue = $('input[name=nic_b]').fieldValue();--}}
{{--                    bar.width(percentVal)--}}
{{--                    percent.html(percentVal);--}}
{{--                },--}}
{{--                uploadProgress: function(event, position, total, percentComplete) {--}}
{{--                    var percentVal = percentComplete + '%';--}}
{{--                    bar.width(percentVal)--}}
{{--                    percent.html(percentVal);--}}
{{--                },--}}
{{--                success: function() {--}}
{{--                    var percentVal = 'Wait, Saving';--}}
{{--                    bar.width(percentVal)--}}
{{--                    percent.html(percentVal);--}}
{{--                },--}}
{{--                complete: function(xhr) {--}}
{{--                    status.html(xhr.responseText);--}}

{{--                    if(xhr.responseText==true){--}}
{{--                        Swal.fire("Success", "File has been uploaded", "success");--}}
{{--                        //window.location.href = "/registration/6";--}}
{{--                    }else{--}}
{{--                        var message = JSON.parse(xhr.responseText);--}}
{{--                        console.log(message["errors"]);--}}
{{--                        for (i in message["errors"]){--}}
{{--                            console.log(i);--}}
{{--                        }--}}
{{--                    }--}}


{{--                }--}}
{{--            });--}}
{{--        })();--}}
{{--    </script>--}}
{{--    @endif--}}



@endsection
