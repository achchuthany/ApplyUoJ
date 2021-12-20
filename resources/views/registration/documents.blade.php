<div class="card">
    <div class="card-header font-size-16 bg-dark text-light">
        7. Upload your documents
    </div>
{{--    <div class="card-body">--}}
{{--        <div class="row mt-3">--}}
{{--            <div class="col-md-12">--}}
{{--                Payment voucher of registration (Ignore this download if you download on the instruction page)--}}

{{--                <a href="{{URL::asset('/assets/images/download/PAYING_IN_VOUCHER.pdf')}}" download="PAYING_IN_VOUCHER.pdf" target="_blank" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card-body">
        <form action="{{ route('student.registration.image.upload') }}" method="POST" enctype="multipart/form-data" id="document-upload">
            @csrf
            <div class="row">
                <div class="col-md-8" >
                    <div class="card shadow-none bg-transparent">
                        <div class="card-header bg-white">
                            <div class="text-dark">
                                <div>
                                    <p>Each image must be a file of type of jpeg, jpg and may not be greater than 5120 kilobytes (5MB).</p>
                                    <p class="text-primary">Select the images and click the <b>"Bulk Upload"</b> button to upload the scan documents</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>i. Selection Letter sent by the UGC <span class="text-danger font-size-16">*</span></label>
                                    <input type="hidden" name="student_id"  id="document_student_id" value="{{Auth::user()->students()->latest()->first()->id}}">
                                    <input type="file" name="ugc" class="form-control  @error('ugc') is-invalid @enderror">
                                    @error('ugc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

{{--                        <div class="card-body bg-light">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label>Your recent photograph (Identity Card Image) <span class="text-danger font-size-16">*</span></label>--}}
{{--                                    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="profileImage">--}}
{{--                                    <div class="alert  p-3">--}}
{{--                                        <div class="h6 text-primary"><i class="mdi mdi-information"></i> Identity Card Image should be: </div>--}}
{{--                                        <div>Required photo size: Passport Size</div>--}}
{{--                                        <div>The submitted photos must be in color</div>--}}
{{--                                        <div> Head position: straight</div>--}}
{{--                                        <div>Background: Blue/Light Blue</div>--}}
{{--                                        <div>Recency: taken no more than 6 months ago</div>--}}
{{--                                    </div>--}}
{{--                                    @error('image')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>ii. Paid Bank Voucher <span class="text-danger font-size-16">*</span></label>
                                    <input type="file" name="bank" class="form-control  @error('bank') is-invalid @enderror">
                                    @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>iii. Student Record Sheet (School Leaving Certificate)  <span class="text-danger font-size-16">*</span></label>
                                </div>
                                <div class="col-md-6">
                                    <label>Front Side</label>
                                    <input type="file" name="lc_f" class="form-control  @error('lc_f') is-invalid @enderror">
                                    @error('lc_f')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Back side </label>
                                    <input type="file" name="lc_b" class="form-control  @error('lc_b') is-invalid @enderror">
                                    @error('lc_b')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>iv. National Identity Card(NIC) / Passport  <span class="text-danger font-size-16">*</span></label>
                                </div>

                                <div class="col-md-6">
                                    <label>Front side</label>
                                    <input type="file" name="nic_f" class="form-control  @error('nic_f') is-invalid @enderror">
                                    @error('nic_f')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Back side</label>
                                    <input type="file" name="nic_b" class="form-control  @error('nic_b') is-invalid @enderror">
                                    @error('nic_b')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>v. Signature of the Student  <span class="text-danger font-size-16">*</span></label>
                                </div>

                                <div class="col-md-12">

                                    <input type="file" name="signature" class="form-control  @error('signature') is-invalid @enderror">
                                    @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span class="text-muted">Sign on a clean paper using a blue pen</span>
                                </div>
                            </div>
                        </div>


{{--                        <div class="card-body bg-light">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label>v. Birth Certificate (Original)<span class="text-danger font-size-16">*</span></label>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Front side</label>--}}
{{--                                    <input type="file" name="bc_f" class="form-control  @error('bc_f') is-invalid @enderror">--}}
{{--                                    @error('bc_f')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Back side</label>--}}
{{--                                    <input type="file" name="bc_b" class="form-control  @error('bc_b') is-invalid @enderror">--}}
{{--                                    @error('bc_b')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label>vi. G.C.E. (A/L) Certificate<span class="text-danger font-size-16">*</span></label>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Front side</label>--}}
{{--                                    <input type="file" name="al_f" class="form-control  @error('al_f') is-invalid @enderror">--}}
{{--                                    @error('al_f')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Back side</label>--}}
{{--                                    <input type="file" name="al_b" class="form-control  @error('al_b') is-invalid @enderror">--}}
{{--                                    @error('al_b')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="card-body bg-light">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label>vii. G.C.E. (O/L) Certificate<span class="text-danger font-size-16">*</span></label>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Front side</label>--}}
{{--                                    <input type="file" name="ol_f" class="form-control  @error('ol_f') is-invalid @enderror">--}}
{{--                                    @error('ol_f')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label>Back side</label>--}}
{{--                                    <input type="file" name="ol_b" class="form-control  @error('ol_b') is-invalid @enderror">--}}
{{--                                    @error('ol_b')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-3 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-upload-multiple"></i> Bulk Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($enroll->student->student_docs()->count()>0)
                <div class="col-md-4" >
                    <div class="card">
                        <div class="card-header bg-light"><i class="mdi mdi-image-album"></i>Uploaded Documents</div>
                        <div class="card-body">
                            <div class="zoom-gallery">
                                <div class="row justify-content-center">
                                    @foreach($enroll->student->student_docs()->get() as $doc)
                                        @if(Storage::disk('docs')->exists($doc->name))
                                            <div class="col-md-5 bg-light m-2">
                                                <a href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->name}}" class="img-thumbnail img-fluid"></a>
                                                <div class="font-size-10 text-center">{{$doc->name}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
        </form>
    </div>

    <div class="card-footer text-center">
        If you documents were successfully uploaded, click "Next" to navigate the next step.
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <a href="{{route('student.photograph')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
    </div>
    <div class="col text-right">
        <a href="{{route('student.registration.complete')}}" class="btn btn-primary">Next <i class="mdi mdi-arrow-right mr-1"></i></a>
    </div> <!-- end col -->
</div> <!-- end row-->
