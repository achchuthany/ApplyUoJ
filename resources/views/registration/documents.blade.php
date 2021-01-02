<div class="card">
    <div class="card-header font-size-16 bg-dark text-light">
        Upload your documents to conform your registration
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-12">
                Payment voucher of registration fee and other fees of  Rs.2350 made by Peoples’ Bank (If you already download in instruction page ignore this download)

                <a href="{{URL::asset('/assets/images/download/PAYING_IN_VOUCHER.pdf')}}" download="PAYING_IN_VOUCHER.pdf" target="_blank" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('student.registration.image.upload') }}" method="POST" enctype="multipart/form-data" id="document-upload">
            @csrf
            <div class="row">
                <div class="col-md-8" >
                    <div class="card">
                        <div class="card-header bg-soft-info">
                            <div class="text-primary">
                                <div>Each image must be a file of type of jpeg, jpg and may not be greater than 2048 kilobytes (2MB).
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Identity Card Image <span class="text-danger font-size-16">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                    <div class="alert  p-3">
                                        <div class="h6 text-primary"><i class="mdi mdi-information"></i> Identity Card Image should be: </div>
                                        <div>Required photo size: 45mm in height and 35mm in width (Passport Size)</div>
                                        <div>The submitted photos must be in color</div>
                                        <div> Head position: straight</div>
                                        <div>Background: Blue/Light Blue</div>
                                        <div>Recency: taken no more than 6 months ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Paid Bank Voucher <span class="text-danger font-size-16">*</span></label>
                                    <input type="file" name="bank" class="form-control">
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
                                    <input type="file" name="lc_f" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Back side </label>
                                    <input type="file" name="lc_b" class="form-control">
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
                                    <input type="file" name="nic_f" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Back side</label>
                                    <input type="file" name="nic_b" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="progress-data">
                                     <div class="progress p-3">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-file-upload"></i> Upload</button>
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
                                            <div class="col-md-6 text-center">
                                                <div class="font-size-12">{{$doc->name}}</div>
                                                <a href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->type}}" class="img-thumbnail"></a>
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
        <a href="{{route('student.registration.complete')}}" class="btn btn-primary">Next <i class="mdi mdi-arrow-right mr-1"></i></a>
    </div> <!-- end col -->
</div> <!-- end row-->
