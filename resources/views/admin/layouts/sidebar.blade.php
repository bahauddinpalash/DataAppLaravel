<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="{{ asset('logo/company.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="{{ route('admin.profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>  
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
  
          <!-- Clients Section -->
          @can('client-list')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Clients
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('bdm-clients.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i> 
                        <p>All Clients</p>
                    </a>
                </li>
                @can('client-create')
                <li class="nav-item">
                    <a href="{{ route('bdm-clients.create') }}" class="nav-link">
                        <i class="fas fa-user-plus nav-icon"></i> 
                        <p>Add Client</p>
                    </a>
                </li>
                @endcan
            </ul>
          </li>
          @endcan
  
          <!-- BDM Data Section -->
          @can('bdm-data-list')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i> 
                <p>
                   BDM Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin-bdm-leads.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i> 
                        <p>All Data</p>
                    </a>
                </li>
                @can('bdm-data-create')
                <li class="nav-item">
                    <a href="{{ route('admin-bdm-leads.create') }}" class="nav-link">
                        <i class="fas fa-user-plus nav-icon"></i> 
                        <p>Add Data</p>
                    </a>
                </li>
                @endcan
            </ul>
          </li>
          @endcan
  
          <!-- Candidates Section -->
          @can('candidate-list')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Candidates
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin-candidates.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>All Candidates</p>
                    </a>
                </li>
                @can('candidate-create')
                <li class="nav-item">
                    <a href="{{ route('admin-candidates.create') }}" class="nav-link">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Add Candidate</p>
                    </a>
                </li>
                @endcan
            </ul>
          </li>
          @endcan
  
          <!-- Recruit Data Section -->
          @can('recruiter-data-list')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i> 
                <p>
                   Recruit Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin-recruit-leads.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>All Data</p>
                    </a>
                </li>
                @can('recruiter-data-create')
                <li class="nav-item">
                    <a href="{{ route('admin-recruit-leads.create') }}" class="nav-link">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Add Data</p>
                    </a>
                </li>
                @endcan
            </ul>
          </li>
          @endcan
            <!-- Manage Users Section -->
            @canany(['admin-list', 'bdm-list', 'recruiter-list'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Manage Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('admin-list')
                    <li class="nav-item">
                        <a href="{{ route('admins.index') }}" class="nav-link">
                            <i class="fas fa-user-cog nav-icon"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    @endcan
                    @can('bdm-list')
                    <li class="nav-item">
                        <a href="{{ route('bdms.index') }}" class="nav-link">
                            <i class="fas fa-user-tie nav-icon"></i>
                            <p>BDM</p>
                        </a>
                    </li>
                    @endcan
                    @can('recruiter-list')
                    <li class="nav-item">
                        <a href="{{ route('recruiters.index') }}" class="nav-link">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>Recruiter</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

  
          <!-- Roles Section -->
          @can('role-list')
          <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>
                      Roles
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('roles.index') }}" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>All Roles</p>
                      </a>
                  </li>
                  @can('role-create')
                  <li class="nav-item">
                      <a href="{{ route('roles.create') }}" class="nav-link">
                          <i class="fas fa-user-plus nav-icon"></i>
                          <p>Add Role</p>
                      </a>
                  </li>
                  @endcan
              </ul>
          </li>
          @endcan
  
          <!-- Logout -->
          <li class="nav-item mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a href="{{ route('admin.logout') }}" class="nav-link"
                   onclick="event.preventDefault();
                            if (confirm('Are you sure you want to log out?')) {
                                this.closest('form').submit();
                            }">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  