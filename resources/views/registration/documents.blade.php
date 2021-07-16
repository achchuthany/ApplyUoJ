<div class="card">
    <div class="card-header font-size-16 bg-dark text-light">
        Upload your documents
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
                    <div class="card">
                        <div class="card-header">
                            <div class="text-dark">
                                <div>Each image must be a file of type of jpeg, jpg and may not be greater than 5120 kilobytes (5MB).
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Selection Letter sent by the UGC <span class="text-danger font-size-16">*</span></label>
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
                                    <label>Paid Bank Voucher <span class="text-danger font-size-16">*</span></label>
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
                                    <label>Student Record Sheet (School Leaving Certificate)  <span class="text-danger font-size-16">*</span></label>
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
                                    <label>National Identity Card(NIC) / Passport  <span class="text-danger font-size-16">*</span></label>
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
{{--                                <div class="col-md-12" id="progress-data">--}}
{{--                                     <div class="progress p-3">--}}
{{--                                        <div class="bar"></div >--}}
{{--                                        <div class="percent">0%</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="mdi mdi-upload-multiple"></i> Bulk Upload</button>
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
                                <div class="row">
                                    @foreach($enroll->student->student_docs()->get() as $doc)
                                        @if(Storage::disk('docs')->exists($doc->name))
                                            <div class="col-md-12">
                                                <div class="font-size-12">{{$doc->name}}</div>
                                                <a href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->type}}" class="img-thumbnail img-fluid" width="200"></a>
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

    <div class="card-footer">
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
