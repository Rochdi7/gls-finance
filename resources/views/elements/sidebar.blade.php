<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    <img src="{{ asset('assets/images/logo/default.jpg') }}" alt="">
                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <small class="text-end font-w400">
                                {{ method_exists(auth()->user(), 'getRoleNames') ? auth()->user()->getRoleNames()->first() ?? 'Admin' : 'Admin' }}
                            </small>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('admin.dashboard') }}" class="dropdown-item ai-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 3h18v18H3z"></path>
                        <path d="M3 9h18"></path>
                        <path d="M9 21V9"></path>
                    </svg>
                    <span class="ms-2">Dashboard</span>
                </a>

                <a href="{{ route('finance.yearly') }}" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 3v18h18"></path>
                        <path d="M7 14l3-3 4 4 6-6"></path>
                    </svg>
                    <span class="ms-2">Finance (Yearly)</span>
                </a>

                {{-- ✅ NEW: Center Monthly quick access --}}
                @if (Route::has('finance.center-monthly-collections.index'))
                    <a href="{{ route('finance.center-monthly-collections.index') }}" class="dropdown-item ai-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-info" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1v22"></path>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span class="ms-2">Center Monthly</span>
                    </a>
                @endif

                {{-- ✅ Logout POST --}}
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="dropdown-item ai-icon border-0 bg-transparent w-100 text-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <ul class="metismenu" id="menu">

            {{-- ✅ ADMIN Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" class="" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            {{-- ✅ GLS FINANCE --}}
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Finance</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('finance.yearly') }}">Yearly</a></li>
                    <li><a href="{{ route('finance.centers.index') }}">Centers</a></li>
                    <li><a href="{{ route('finance.professors.index') }}">Professors</a></li>
                    <li><a href="{{ route('finance.groups.index') }}">Groups</a></li>
                    <li><a href="{{ route('finance.monthly-financials.index') }}">Monthly Financials</a></li>

                    {{-- ✅ NEW: Center Monthly Payments --}}
                    @if (Route::has('finance.center-monthly-collections.index'))
                        <li><a href="{{ route('finance.center-monthly-collections.index') }}">Center Monthly
                                (Payments)</a></li>
                    @endif

                    {{-- ✅ NEW: Center Comparison --}}
                    @if (Route::has('finance.center-comparison.index'))
                        <li><a
                                href="{{ route('finance.center-comparison.index', ['type' => 'monthly_year', 'year' => now()->year]) }}">Comparaison
                                Centres</a></li>
                    @endif
                </ul>
            </li>

            {{-- (Optionnel) tu peux garder les menus demo si tu veux,
                 sinon tu peux les supprimer pour un backoffice clean. --}}

        </ul>

        <div class="plus-box">
            <p class="fs-14 font-w600 mb-2">GLS Finance<br>Management System<br></p>
            <p class="plus-box-p">Numeric-only, multi-centers, performance control</p>
        </div>

        <div class="copyright">
            <p><strong>GLS Finance Admin</strong> © {{ date('Y') }} All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by GLS Team</p>
        </div>
    </div>
</div>
