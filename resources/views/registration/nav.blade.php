<ul class="nav nav-pills navbar-dark ">
    <li class="nav-item">
        <a href="#" class="nav-link {{Route::currentRouteName() =='student.personal'?'active':''}} p-3">
            <span class="rounded-circle bg-primary p-3 text-light mr-2">01</span>
            Personal <i class="fas fa-angle-double-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link p-3 {{Route::currentRouteName()=='student.address'?'active':''}} " >
            <span class="rounded-circle bg-primary p-3 text-light mr-2">02</span>
            <span>Address <i class="fas fa-angle-double-right"></i></span>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link p-3 {{Route::currentRouteName()=='student.education'?'active':''}} " >
            <span class="rounded-circle bg-primary p-3 text-light mr-2">03</span>
            Educational Qualifications  <i class="fas fa-angle-double-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link p-3 {{Route::currentRouteName()=='student.citizenship'?'active':''}} ">
            <span class="rounded-circle bg-primary p-3 text-light mr-2">04</span>
            Citizenship  <i class="fas fa-angle-double-right"></i>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link p-3 {{Route::currentRouteName()=='student.parents'?'active':''}} ">
            <span class="rounded-circle bg-primary p-3 text-light mr-2">05</span>
            Parents/Guardian  <i class="fas fa-angle-double-right"></i>
        </a>
    </li>
</ul>
