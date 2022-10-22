<aside class="sidebar">
    <a href="#" class="sidebar-logo">
        <div class="d-flex justify-content-start align-items-center">
            <img src="{{ asset('backend/images/icons/logo.svg') }}" alt="icon">
            <span>AdminPanel</span>
        </div>

        <button id="toggle-navbar" onclick="toggleNavbar()">
            <img src="{{ asset('backend/images/icons/navbar-times.svg') }}" alt="icon">
        </button>
    </a>

    <h5 class="sidebar-title">General</h5>

    <a href="{{ route('admin.dashboard') }}" class="sidebar-item @yield('dashboardPage')">
        <img src="{{ asset('backend/images/icons/grid.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <span>Dashboard</span>
    </a>

    <a href="./employees.html" class="sidebar-item">
        <!-- <img src="./assets/img/global/users.svg" alt=""> -->

        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        <span>Employees</span>
    </a>

    <a href="#" class="sidebar-item" onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        <span>My Team</span>
    </a>

    <a href="#" class="sidebar-item" onclick="toggleActive(this)">
        <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 1V23" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 5H9.5C8.57174 5 7.6815 5.36875 7.02513 6.02513C6.36875 6.6815 6 7.57174 6 8.5C6 9.42826 6.36875 10.3185 7.02513 10.9749C7.6815 11.6313 8.57174 12 9.5 12H14.5C15.4283 12 16.3185 12.3687 16.9749 13.0251C17.6313 13.6815 18 14.5717 18 15.5C18 16.4283 17.6313 17.3185 16.9749 17.9749C16.3185 18.6313 15.4283 19 14.5 19H6" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        <span>Payroll</span>
    </a>

    <a href="#" class="sidebar-item">
        <img src="{{ asset('backend/images/icons/log-out.svg') }}" alt="icon" width="18" height="18" class="me-3" >
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf

            <button type="submit" class="p-0 btn btn-sm btn-link hover-off">Logout</button>
        </form>
    </a>

</aside>
