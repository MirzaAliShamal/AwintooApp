<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light"><b>{{ ($general->site_title) ? $general->site_title : 'Admin Panel' }}</b></span>
    </a>
    <div class="sidebar">
      <div class="form-inline mt-3 p-1">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ menuActive('admin.dashboard') }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.client.index') }}" class="nav-link {{ menuActive('admin.client.*') }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Client
              </p>
            </a>
          </li>
          @if(auth()->user()->role == 1)
          <li class="nav-item">
            <a href="{{ route('admin.eavaluation.index') }}" class="nav-link {{ menuActive('admin.eavaluation.*') }}">
              <i class="nav-icon fas fa-user-check"></i> 
              <p>
                Client Evaluation
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('admin.info.index') }}" class="nav-link {{ menuActive('admin.info.*') }}">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Rest Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.payment.index') }}" class="nav-link {{ menuActive('admin.payment.*') }}">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Payment
              </p>
            </a>
          </li>
          @if(auth()->user()->role == 1)
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ menuActive('admin.user.*') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Admin / Agent
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.job.index') }}" class="nav-link {{ menuActive('admin.job.*') }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Job
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.appointment.index') }}" class="nav-link {{ menuActive('admin.appointment.*') }}">
              <i class="nav-icon fas fa-calendar-day"></i>
              <p>
                Appointment
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.practice.index') }}" class="nav-link {{ menuActive('admin.practice.*') }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Training & Practice
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.student.index') }}" class="nav-link {{ menuActive('admin.student.*') }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Students In RO
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.agency.index') }}" class="nav-link {{ menuActive('admin.agency.*') }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Agency
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.report.index') }}" class="nav-link {{ menuActive('admin.report.*') }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Forms
              </p>
            </a>
          </li>
          <li class="nav-item {{ menuActive(['admin.setting.index'], 1) }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Setting
                  <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link {{ menuActive(['admin.setting.index']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>General Setting</p>
                    </a>
                </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </aside>