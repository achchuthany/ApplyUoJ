<ul class="nav nav-pills navbar-dark font-size-13">
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName() =='student.personal'?'active':''}}">
            <span class="rounded bg-primary p-1 text-light">01</span>
            Personal <i class="fas fa-angle-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.address'?'active':''}} " >
            <span class="rounded bg-primary p-1 text-light">02</span>
            <span>Address <i class="fas fa-angle-right"></i></span>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.education'?'active':''}} " >
            <span class="rounded bg-primary p-1 text-light">03</span>
            Educational Qualifications  <i class="fas fa-angle-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.citizenship'?'active':''}} ">
            <span class="rounded bg-primary p-1 text-light">04</span>
            Citizenship  <i class="fas fa-angle-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.parents'?'active':''}} ">
            <span class="rounded bg-primary p-1 text-light">05</span>
            Parents/Guardian  <i class="fas fa-angle-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.documents'?'active':''}} ">
            <span class="rounded bg-primary p-1 text-light">06</span>
            Documents  <i class="fas fa-angle-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName()=='student.registration.complete'?'active':''}} ">
            <span class="rounded bg-primary p-1 text-light">07</span>
            Complete  <i class="fas fa-angle-right"></i>
        </a>
    </li>
</ul>
