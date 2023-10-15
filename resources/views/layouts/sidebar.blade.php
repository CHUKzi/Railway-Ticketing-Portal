<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Menu</div>

            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('train-stations*') ? 'active' : '' }}">
                    <a href="{{ route('stations.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-train"></i>
                        </span>
                        <span class="pcoded-mtext">Train Stations</span>
                    </a>
                </li>

                <li class="{{ request()->is('trains*') ? 'active' : '' }}">
                    <a href="{{ route('trains.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-train"></i>
                        </span>
                        <span class="pcoded-mtext">Trains</span>
                    </a>
                </li>

                <li class="{{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                </li>

                <li class="{{ request()->is('staff*') ? 'active' : '' }}">
                    <a href="{{ route('staff.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-sitemap"></i>
                        </span>
                        <span class="pcoded-mtext">Staff</span>
                    </a>
                </li>


            </ul>

        </div>
    </div>
</nav>
