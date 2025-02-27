{{-- <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-5 fw-bold">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                Clients
            </a>
        </li>
        <li>
            <a href="{{ route('leads.index') }}" class="nav-link {{ request()->routeIs('leads.index') ? 'active' : '' }}">
                Leads
            </a>
        </li>
        <li>
            <a href="{{ route('sales_activities.index', ['bdm_lead_id' => 1]) }}" class="nav-link {{ request()->routeIs('sales_activities.index') ? 'active' : '' }}">
                Sales Activities
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="{{ route('bdm.profile.edit') }}">Profile</a></li>
            <li>
                <form action="{{ route('bdm.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div> --}}
