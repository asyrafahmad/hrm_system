
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div class="sidebar-menu">
                <ul>
                    <li><a href="{{ route('dashboard.admin') }}"><i class="la la-home"></i> <span>Back to Home</span></a></li>
                    <li class="menu-title">Settings</li>
                    <li class="{{ Route::currentRouteNamed('company.settings.page') ? 'active' : '' }}"><a href="{{ route('company.settings.page') }}" class="{{ Route::currentRouteNamed('company.settings.page') ? 'active' : '' }}"><i class="la la-building"></i><span>Company Settings</span></a></li>
                    <li class="{{ Route::currentRouteNamed('roles.permissions.page') ? 'active' : '' }}"><a href="{{ route('roles.permissions.page') }}" class="{{ Route::currentRouteNamed('roles.permissions.page') ? 'active' : '' }}"><i class="la la-key"></i><span>Roles & Permissions</span></a></li>
                    <li class="{{ Route::currentRouteNamed('change.password') ? 'active' : '' }}"><a href="{{ route('change.password') }}" class="{{ Route::currentRouteNamed('change.password') ? 'active' : '' }}"><i class="la la-lock"></i><span>Change Password</span></a></li>
                    <li><a href="#"><i class="la la-clock-o"></i><span>Localization</span></a></li>
                    <li><a href="#"><i class="la la-photo"></i><span>Theme Settings</span></a></li>
                    <li><a href="#"><i class="la la-at"></i><span>Email Settings</span></a></li>
                    <li><a href="#"><i class="la la-chart-bar"></i><span>Performance Settings</span></a></li>
                    <li><a href="#"><i class="la la-thumbs-up"></i><span>Approval Settings</span></a></li>
                    <li><a href="#"><i class="la la-pencil-square"></i><span>Invoice Settings</span></a></li>
                    <li><a href="#"><i class="la la-money"></i><span>Salary Settings</span></a></li>
                    <li><a href="#"><i class="la la-globe"></i><span>Notifications</span></a></li>
                    <li><a href="#"><i class="la la-cogs"></i><span>Leave Type</span></a></li>
                    <li><a href="#"><i class="la la-comment"></i><span>ToxBox Settings</span></a></li>
                    <li><a href="#"><i class="la la-rocket"></i><span>Cron Settings</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
