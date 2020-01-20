<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label pcoded-navigation-main-label" data-toggle="tooltip" data-placement="right" data-trigger="hover" title="" data-original-title="Property currently managing">
                {{ $property->name }}
            </div>

            {{-- DASHBOARD --}}
            <div class="pcoded-navigation-label">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu @if ($pageSlug == 'dashboard') active pcoded-trigger @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li @if ($pageSlug == 'dashboard') class="active" @endif>
                                <a href="/" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Default</span>
                                 </a>
                            </li>
                            <li @if ($pageSlug == 'analytics') class="active" @endif>
                                <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Analytics</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            {{-- PROPERTY --}}
            <div class="pcoded-navigation-label">Property Management</div>
                <ul class="pcoded-item pcoded-left-item">
                    @can('List Property')
                        <li @if ($pageSlug == 'property-index') class="active" @endif>
                            <a href="{{ route('property.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                                </span>
                                <span class="pcoded-mtext">Properties</span>
                            </a>
                        </li>
                    @endcan
                    @can('List Unit')
                        <li @if ($pageSlug == 'unit.index') class="active" @endif>
                            <a href="{{ route('unit.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                <i class="feather icon-edit-1"></i>
                                </span>
                                <span class="pcoded-mtext">Units</span>
                            </a>
                        </li>
                    @endcan
                </ul>

            {{-- TENANT --}}
            <div class="pcoded-navigation-label">Tenant Management</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu @if ($pageSlug == 'tenant-index' || $pageSlug == 'tenant-create') active pcoded-trigger @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span>
                            <span class="pcoded-mtext">Tenants</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li @if ($pageSlug == 'tenant-index') class="active" @endif>
                                <a href="{{ route('tenant.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List All Tenants</span>
                                 </a>
                            </li>
                            <li @if ($pageSlug == 'tenant-create') class="active" @endif>
                                <a href="{{ route('tenant.create') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Add Tenant</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu @if ($pageSlug == 'lease-index' || $pageSlug == 'lease-create') active pcoded-trigger @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                            <span class="pcoded-mtext">Contracts</span>
                        </a>
                            <ul class="pcoded-submenu">
                                <li @if ($pageSlug == 'lease-index') class="active" @endif>
                                    <a href="{{ route('lease.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Leasing Agreements</span>
                                    </a>
                                </li>
                                <li @if ($pageSlug == 'lease-create') class="active" @endif>
                                    <a href="{{ route('lease.create') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Create New Agreement</span>
                                    </a>
                                </li>
                            </ul>
                    </li>
                    <li @if ($pageSlug == 'payment-index') class="active" @endif>
                        <a href="{{ route('payment.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                            <i class="feather icon-edit-1"></i>
                            </span>
                            <span class="pcoded-mtext">Payments</span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu
                    @if (
                        $pageSlug == 'billing-index' ||
                        $pageSlug == 'utility-bill-index' ||
                        $pageSlug == 'utilities-index' ||
                        $pageSlug == 'service-index' ||
                        $pageSlug == 'service-create' ||
                        $pageSlug == 'service-type-index' ||
                        $pageSlug == 'otherincome-index' ||
                        $pageSlug == 'otherincome-type-index' ||
                        $pageSlug == 'order-index' ||
                        $pageSlug == 'order-create' ||
                        $pageSlug == 'order-type-index'
                    ) active pcoded-trigger
                    @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-tag"></i></span>
                            <span class="pcoded-mtext">Billing</span>
                        </a>
                            <ul class="pcoded-submenu">
                                <li @if ($pageSlug == 'billing-index') class="active" @endif>
                                    <a href="{{ route('billing.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Published Billing Invoice</span>
                                    </a>
                                </li>
                                <!-- UTILITY -->
                                <li class="pcoded-hasmenu @if ($pageSlug == 'utility-bill-index' || $pageSlug == 'utilities-index') active pcoded-trigger @endif">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Utility</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li @if ($pageSlug == 'utility-bill-index') class="active" @endif>
                                            <a href="{{ route('utility-bill.index') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Published Utility Billing</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'utilities-index') class="active" @endif>
                                            <a href="{{ route('utilities.index') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Utility Meters</span>
                                             </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- SERVICE -->
                                <li class="pcoded-hasmenu @if ($pageSlug == 'service-index' || $pageSlug == 'service-create' || $pageSlug == 'service-type-index') active pcoded-trigger @endif">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Services</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li @if ($pageSlug == 'service-index') class="active" @endif>
                                            <a href="{{ route('services.index') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Published Service Billing</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'service-create') class="active" @endif>
                                            <a href="{{ route('services.create') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Create New Service Agreement</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'service-type-index') class="active" @endif>
                                            <a href="{{ route('service-type.index') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Service Types</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- OTHER INCOME -->
                                <li class="pcoded-hasmenu @if ($pageSlug == 'otherincome-index' || $pageSlug == 'otherincome-type-index') active pcoded-trigger @endif"">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Other Income</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li @if ($pageSlug == 'otherincome-index') class="active" @endif>
                                            <a href="#" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Published Other Income Billing</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'otherincome-create') class="active" @endif>
                                            <a href="#" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Create New Other Income</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'otherincome-type-index') class="active" @endif>
                                            <a href="#" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Other Income Types</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- ORDERS -->
                                <li class="pcoded-hasmenu @if ($pageSlug == 'order-index' || $pageSlug == 'order-create' || $pageSlug == 'order-type-index') active pcoded-trigger @endif">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                                        <span class="pcoded-mtext">Job Order</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li @if ($pageSlug == 'order-index') class="active" @endif>
                                            <a href="{{ route('orders.index') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Published Orders</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'order-create') class="active" @endif>
                                            <a href="{{ route('orders.create') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Create A New Order</span>
                                            </a>
                                        </li>
                                        <li @if ($pageSlug == 'order-type-index') class="active" @endif>
                                            <a href="#" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Order Types</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                    </li>
                </ul>

            {{-- INVENTORY --}}
            <div class="pcoded-navigation-label">Inventory Management</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li @if ($pageSlug == 'inventory-index') class="active" @endif>
                        <a href="{{ route('inventory.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                            <i class="feather icon-package"></i>
                            </span>
                            <span class="pcoded-mtext">Inventory</span>
                        </a>
                    </li>
                </ul>

            {{-- FORMS --}}
            <div class="pcoded-navigation-label">Documents</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li @if ($pageSlug == 'forms-index') class="active" @endif>
                        <a href="#" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                            <i class="feather icon-package"></i>
                            </span>
                            <span class="pcoded-mtext">Forms</span>
                        </a>
                    </li>
                </ul>

            {{-- REPORTS --}}
            <div class="pcoded-navigation-label">Reports</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li @if ($pageSlug == 'reports-index') class="active" @endif>
                        <a href="#" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                            <i class="feather icon-package"></i>
                            </span>
                            <span class="pcoded-mtext">Reports</span>
                        </a>
                    </li>
                </ul>

            {{-- ADMIN --}}
            @role('Super Admin')
            <div class="pcoded-navigation-label">Administrator Settings</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu @if ($pageSlug == 'user-index' || $pageSlug == 'user-create') active pcoded-trigger @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-at-sign"></i></span>
                            <span class="pcoded-mtext">Users</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li @if ($pageSlug == 'user-index') class="active" @endif>
                                <a href="{{ route('user.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">List All Users</span>
                                 </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <li class=" pcoded-hasmenu @if ($pageSlug == 'user-create') active pcoded-trigger @endif">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Manage Users</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li @if ($pageSlug == 'user-create') class="active" @endif>
                                        <a href="{{ route('user.create') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Add User</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu @if ($pageSlug == 'roles-index') active pcoded-trigger @endif">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                            <span class="pcoded-mtext">Roles</span>
                        </a>
                            <ul class="pcoded-submenu">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Manage Roles</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="menu-static.html" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">List All Roles</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="menu-header-fixed.html" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Add Roles</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                    </li>
                    <li @if ($pageSlug == 'activity-index') class="active" @endif>
                        <a href="#" class="waves-effect waves-dark">
                            <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">Activity Log</span>
                        </a>
                    </li>
                </ul>
                {{-- <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Basic</span>
                    </a>
                    <ul class="pcoded-submenu">
                    <li class="">
                    <a href="alert.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Alert</span>
                    </a>
                    </li>
                    <li class="">
                    <a href="breadcrumb.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Breadcrumbs</span>
                    </a>
                    </li>
                    <li class="">
                    <a href="button.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Button</span>
                    </a>
                    </li>
                    <li class="">
                    <a href="box-shadow.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Box-Shadow</span>
                    </a>
                    </li>
                    <li class="">
                    <a href="accordion.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Accordion</span>
                    </a>
                    </li>
                    <li class="">
                    <a href="generic-class.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Generic Class</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="tabs.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Tabs</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="color.html" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Color</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="label-badge.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Label Badge</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="progress-bar.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Progress Bar</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="list.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">List</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="tooltip.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Tooltip And Popover</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="typography.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Typography</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="other.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Other</span>
                    </a>
                    </li>
                    </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-gitlab"></i>
                    </span>
                    <span class="pcoded-mtext">Advance</span>
                    </a>
                    <ul class="pcoded-submenu">
                    <li class=" ">
                    <a href="draggable.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Draggable</span>
                    </a>
                    </li>
                    </li>
                    <li class=" ">
                    <a href="modal.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Modal</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="notification.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Notifications</span>
                    </a>
                     </li>
                    <li class=" ">
                    <a href="rating.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Rating</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="range-slider.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Range Slider</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="slider.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Slider</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="syntax-highlighter.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Syntax Highlighter</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="tour.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Tour</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="treeview.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Tree View</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="nestable.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Nestable</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="toolbar.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Toolbar</span>
                    </a>
                    </li>
                    </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-package"></i>
                    </span>
                    <span class="pcoded-mtext">Extra</span>
                    </a>
                    <ul class="pcoded-submenu">
                    <li class=" ">
                    <a href="session-timeout.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Session Timeout</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="session-idle-timeout.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Session Idle Timeout</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="offline.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Offline</span>
                    </a>
                    </li>
                    </ul>
                    </li>
                    <li class=" ">
                    <a href="animation.html" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-aperture rotate-refresh"></i>
                    </span>
                    <span class="pcoded-mtext">Animations</span>
                    </a>
                    </li>
                    <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="feather icon-command"></i>
                    </span>
                    <span class="pcoded-mtext">Icons</span>
                    </a>
                    <ul class="pcoded-submenu">
                    <li class=" ">
                    <a href="icon-font-awesome.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Font Awesome</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="icon-themify.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Themify</span>
                    </a>
                    </li>
                    <li class=" ">
                    <a href="icon-simple-line.html" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Simple Line Icon</span>
                    </a>
                    </li>
                    </ul>
                    </li>
                </ul> --}}
            @endrole
        </div>
    </div>
</nav>