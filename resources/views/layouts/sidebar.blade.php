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

                <li class="{{ request()->is('tickets-fares*') ? 'active' : '' }}">
                    <a href="{{ route('tickets.fares.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-industry"></i>
                        </span>
                        <span class="pcoded-mtext">Tickets Fares</span>
                    </a>
                </li>

                <li class="{{ request()->is('ticket-bookings*') ? 'active' : '' }}">
                    <a href="{{ route('tickets.bookings.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-calendar"></i>
                        </span>
                        <span class="pcoded-mtext">Ticket Bookings</span>
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

                <li class="{{ Str::endsWith(request()->path(), 'users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                </li>

                <li class="{{ Str::endsWith(request()->path(), 'payments') ? 'active' : '' }}">
                    <a href="{{ route('users.index.payments') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                        <span class="pcoded-mtext">Users Payments</span>
                    </a>
                </li>

                <li class="{{ request()->is('packages*') ? 'active' : '' }}">
                    <a href="{{ route('packages.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-gift"></i>
                        </span>
                        <span class="pcoded-mtext">Pakcages</span>
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

                <li class="{{ Str::endsWith(request()->path(), 'terms-policies') ? 'active' : '' }}">
                    <a href="{{ route('terms.policies') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-balance-scale"></i>
                        </span>
                        <span class="pcoded-mtext">Terms & Policies</span>
                    </a>
                </li>


            </ul>

        </div>
    </div>
</nav>
