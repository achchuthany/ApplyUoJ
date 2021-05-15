<ul class="nav nav-pills">
    <li class="nav-item">
        <a href="{{route('student.personal')}}" class="nav-link {{Route::currentRouteName() =='student.personal'?'active':''}}">
            <span class="rounded-circle bg-primary p-2 text-light">01</span>
            Personal
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.address')}}" class="nav-link {{Route::currentRouteName()=='student.address'?'active':''}} " >
            <span class="rounded-circle bg-primary p-2 text-light">02</span>
            <span>Address</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('student.education')}}" class="nav-link {{Route::currentRouteName()=='student.education'?'active':''}} " >
            <span class="rounded-circle bg-primary p-2 text-light">03</span>
            Education
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.citizenship')}}" class="nav-link {{Route::currentRouteName()=='student.citizenship'?'active':''}} ">
            <span class="rounded-circle bg-primary p-2 text-light">04</span>
            Citizenship
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.parents')}}" class="nav-link {{Route::currentRouteName()=='student.parents'?'active':''}} ">
            <span class="rounded-circle bg-primary p-2 text-light">05</span>
            Parents/Guardian
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.photograph')}}" class="nav-link {{Route::currentRouteName()=='student.photograph'?'active':''}} ">
            <span class="rounded-circle bg-primary p-2 text-light">06</span>
            Photograph
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.documents')}}" class="nav-link {{Route::currentRouteName()=='student.documents'?'active':''}} ">
            <span class="rounded-circle bg-primary p-2 text-light">07</span>
            Documents
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('student.registration.complete')}}" class="nav-link {{Route::currentRouteName()=='student.registration.complete'?'active':''}} ">
            <span class="rounded-circle bg-primary p-2 text-light">08</span>
            Complete
        </a>
    </li>
</ul>
