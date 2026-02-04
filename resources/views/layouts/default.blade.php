@php
    $controller = DzHelper::controller();
    $page = $action = DzHelper::action();
    $action = $controller . '_' . $action;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="GLS Team">
    <meta name="robots" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="admin dashboard, admin template, analytics, bootstrap, bootstrap 5, bootstrap 5 admin template, job board admin, job portal admin, modern, responsive admin dashboard, sales dashboard, sass, ui kit, web app, frontend">
    <meta name="description" content="@yield('page_description', $page_description ?? '')">
    <meta property="og:title" content="Jobick : Laravel Job Admin Dashboard Bootstrap 5 Template">
    <meta property="og:description" content="@yield('page_description', $page_description ?? '')">
    <meta property="og:image" content="https://jobick.GLS Team.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="Jobick : Laravel Job Admin Dashboard Bootstrap 5 Template">
    <meta name="twitter:description" content="@yield('page_description', $page_description ?? '')">
    <meta name="twitter:image" content="https://jobick.GLS Team.com/laravel/social-image.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    @if (!empty(config('dz.public.pagelevel.css.' . $action)))
        @foreach (config('dz.public.pagelevel.css.' . $action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
        @endforeach
    @endif

    {{-- Global Theme Styles (used by all pages) --}}
    @if (!empty(config('dz.public.global.css')))
        @foreach (config('dz.public.global.css') as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
        @endforeach
    @endif
    <link class="main-css" href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>

        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="{{ in_array($page, ['dashboard', 'dashboard_2']) ? 'wallet-open active' : '' }}">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ url('index') }}" class="brand-logo">
    <img 
        src="{{ asset('assets/images/logo/gls-noir.png') }}" 
        alt="GLS Finance"
        style="height: 45px; width: auto;"
    >
</a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        @include('elements.header')


        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('elements.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--****
  Wallet Sidebar
  ****-->
        <!--**********************************
            Content body start
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        @php
            $body_class = '';
            if ($page == 'ui_button') {
                $body_class = 'btn-page';
            }
            if ($page == 'ui_badge') {
                $body_class = 'badge-demo';
            }
        @endphp
        <div class="content-body {{ $body_class }}">
            @yield('content')
        </div>

        <!--**********************************
            Content body end
        ***********************************-->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Job Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Company Name</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Position</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Job Category</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>QA Analyst</option>
                                    <option>IT Manager</option>
                                    <option>Systems Analyst</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Job Type</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>Part-Time</option>
                                    <option>Full-Time</option>
                                    <option>Freelancer</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">No. of Vancancy</label>
                                <input type="text" class="form-control solid" placeholder="Name"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Select Experience</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>1 yr</option>
                                    <option>2 Yr</option>
                                    <option>3 Yr</option>
                                    <option>4 Yr</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Posted Date</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Last Date To Apply</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Close Date</label>
                                <div class="input-hasicon">
                                    <input name="datepicker" class="form-control solid bt-datepicker">
                                    <div class="icon"><i class="far fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Select Gender:</label>
                                <select class="default-select wide form-control solid">
                                    <option selected>Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Salary Form</label>
                                <input type="text" class="form-control solid" placeholder="$" aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Salary To</label>
                                <input type="text" class="form-control solid" placeholder="$" aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter City:</label>
                                <input type="text" class="form-control solid" placeholder="City"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter State:</label>
                                <input type="text" class="form-control solid" placeholder="State"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter Counter:</label>
                                <input type="text" class="form-control solid" placeholder="State"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label required">Enter Education Level:</label>
                                <input type="text" class="form-control solid" placeholder="Education Level"
                                    aria-label="name">
                            </div>
                            <div class="col-xl-12 mb-4">
                                <label class="form-label required">Description:</label>
                                <textarea class="form-control solid" rows="5" aria-label="With textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        @stack('modal')
        <!--**********************************
   Footer start
  ***********************************-->
        @if (!in_array($page, ['', '', '', '', '']))
            @include('elements.footer')
        @endif

    </div>
    <script>
        var asset_base_url = '{{ asset('/') }}';
    </script>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--***********************************-->



    <!--**********************************
  Modal
 ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->


    @if (!empty(config('dz.public.global.js.top')))
        @foreach (config('dz.public.global.js.top') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if (!empty(config('dz.public.pagelevel.js.' . $action)))
        @foreach (config('dz.public.pagelevel.js.' . $action) as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if (!empty(config('dz.public.global.js.bottom')))
        @foreach (config('dz.public.global.js.bottom') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif

    @stack('scripts')

    @include('elements.toast')
</body>

</html>
