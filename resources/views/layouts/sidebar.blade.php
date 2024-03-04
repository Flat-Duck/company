<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" >
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="nav-link-title">
                                    ارئيسية
                                </span>
                            </a>
                        </li>
                            @can('view-any', App\Models\User::class)
                                <li class="nav-item {{ $page == 'users'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('users.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Users -->
                                            <!-- Users Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            المستخدمين
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Administration::class)
                                <li class="nav-item {{ $page == 'administrations'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('administrations.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Administrations -->
                                            <!-- Administrations Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            الادارات
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Department::class)
                                <li class="nav-item {{ $page == 'departments'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('departments.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Departments -->
                                            <!-- Departments Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            الاقسام
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\MainFolder::class)
                                <li class="nav-item {{ $page == 'main-folders'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('main-folders.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Main Folders -->
                                            <!-- Main Folders Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            المجلدات الرئيسية
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\SubFolder::class)
                                <li class="nav-item {{ $page == 'sub-folders'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('sub-folders.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Sub Folders -->
                                            <!-- Sub Folders Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            المجلدات الفرعية
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Office::class)
                                <li class="nav-item {{ $page == 'offices'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('offices.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Offices -->
                                            <!-- Offices Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            المكاتب
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Extoutbox::class)
                                <li class="nav-item {{ $page == 'extoutboxes'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('extoutboxes.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Extoutboxes -->
                                            <!-- Extoutboxes Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            صادر خارجي
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Inbox::class)
                                <li class="nav-item {{ $page == 'inboxes'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('inboxes.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Inboxes -->
                                            <!-- Inboxes Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            الوارد
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Intoutbox::class)
                                <li class="nav-item {{ $page == 'intoutboxes'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('intoutboxes.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Intoutboxes -->
                                            <!-- Intoutboxes Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            صادر داخلي
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Memo::class)
                                <li class="nav-item {{ $page == 'memos'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('memos.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Memos -->
                                            <!-- Memos Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            معاملات اخرى
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Attachment::class)
                                <li class="nav-item {{ $page == 'attachments'? 'active':''  }}">
                                    <a class="nav-link" href="{{ route('attachments.index') }}" >
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/Attachments -->
                                            <!-- Attachments Icon -->
                                        </span>
                                        <span class="nav-link-title">
                                            المرفقات
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                            Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-access" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <i class="ti ti-lock-access"></i>
                                        </span>
                                        <span class="nav-link-title">
                                            Access Management
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        @can('view-any', Spatie\Permission\Models\Role::class)
                                            <a class="dropdown-item" href="{{ route('roles.index') }}" rel="noopener">
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    <i class="ti ti-user-check"></i>       
                                                </span>
                                                <span class="nav-link-title">
                                                    Roles
                                                </span>
                                            </a>
                                        @endcan
                                        @can('view-any', Spatie\Permission\Models\Permission::class)
                                            <a class="dropdown-item" href="{{ route('permissions.index') }}">
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    <i class="ti ti-key"></i>
                                                </span>
                                                <span class="nav-link-title">
                                                    Permissions
                                                </span>
                                            </a>
                                        @endcan
                                    </div>
                                </li>
                            @endif
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>