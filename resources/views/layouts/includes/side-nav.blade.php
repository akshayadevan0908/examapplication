<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}  " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="javascript:;" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->slug }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin'))
        <li class="nav-item">
            <a href="{{ route('admin.student.index')}}" class="nav-link {{ (request()->is('admin/student/index')) ? 'active' : '' }}">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Student</p>
            </a>
        </li>
        @endif
        @if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin'))
        <li class="nav-item">
            <a href="{{ route('admin.teacher.index')}}" class="nav-link {{ (request()->is('admin/teacher/index')) ? 'active' : '' }}">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Teacher</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.exam.index')}}" class="nav-link {{ (request()->is('admin/exam/index')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-columns"></i>
            <p>Exam</p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ route('admin.question.index')}}" class="nav-link {{ (request()->is('admin/question/index')) ? 'active' : '' }}">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Question</p>
          </a>
      </li>
        @if(Auth::guard('admin')->user() && Auth::guard('admin')->user()->admin_type == config('examapp.user_role.teacher'))
        <li class="nav-item">
          <a href="{{ route('teacher.profile.view')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Profile&Changepassword</p>
          </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Student</p>
        </a>
    </li>
      @endif
        <li class="nav-item">
                <a class="nav-link" href="{{ route('logout')}}" onclick="javascript:return confirm('Are you sure you want to log out?');">
                    <i class="nav-icon far fa-circle text-danger"></i><p class="text">Sign Out</p></a>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  