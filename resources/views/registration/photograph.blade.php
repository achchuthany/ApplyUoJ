<div class="card">
    <div class="card-header font-size-16 bg-dark text-light">
        Upload your Identity Card Image
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
        <form action="#" method="POST" enctype="multipart/form-data" id="document-upload">
            @csrf
            <div class="row">
                <div class="col-md-8" >
                    <div class="card">
                        <div class="card-header">
                            <div class="text-dark">
                                <div>Image must be a file of type of jpeg, jpg and may not be greater than 5120 kilobytes (5MB).
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Your recent photograph (Identity Card Image) <span class="text-danger font-size-16">*</span></label>
                                    <input type="hidden" name="student_id"  id="document_student_id" value="{{Auth::user()->students()->latest()->first()->id}}">
                                    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="profileImage">
                                    <div class="alert  p-3">
                                        <div class="h6 text-primary"><i class="mdi mdi-information"></i> Identity Card Image should be: </div>
                                        <div>Required photo size: Passport Size</div>
                                        <div>The submitted photos must be in color</div>
                                        <div> Head position: straight</div>
                                        <div>Background: Blue/Light Blue</div>
                                        <div>Recency: taken no more than 6 months ago</div>
                                        <div>Eyes: must be clearly visible</div>
                                        <div>Blurred pictures will be rejected</div>
                                        <div>Dress code: the colors of your clothes must be in contrast with the background. Do not wear Blue/Light Blue tops</div>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($enroll->student->student_docs()->count()>0)
                <div class="col-md-4" >
                    <div class="card">
                        <div class="card-header bg-success text-light"><i class="mdi mdi-check-circle"></i> Files has been uploaded</div>
                        <div class="card-body">
                            <div class="zoom-gallery">
                                <div class="row">
                                    @foreach($enroll->student->student_docs()->get() as $doc)
                                        @if(Storage::disk('docs')->exists($doc->name))
                                            <div class="col-md-12 text-center">
                                                <div class="font-size-12">{{$doc->name}}</div>
                                                <a href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->type}}" class="img-thumbnail img-fluid" width="150"></a>
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
        <a href="{{route('student.parents')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
    </div>
    <div class="col text-right">
        <a href="{{route('student.documents')}}" class="btn btn-primary">Next <i class="mdi mdi-arrow-right mr-1"></i></a>
    </div> <!-- end col -->
</div> <!-- end row-->
