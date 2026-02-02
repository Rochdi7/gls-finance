<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    <img src="{{ asset('images/profile/pic1.jpg') }}" alt="">
                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">Franklin Jr</span>
                            <small class="text-end font-w400">Superadmin</small>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ url('app-profile') }}" class="dropdown-item ai-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ms-2">Profile </span>
                </a>
                <a href="{{ url('email-inbox') }}" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <span class="ms-2">Inbox </span>
                </a>
                <a href="{{  url('page-register')}}" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="ms-2">Logout </span>
                </a>
            </div>
        </div>
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('index')}}">Dashboard Light</a></li>
					<li><a href="{{url('index-2') }}">Dashboard Dark</a></li>
                    <li><a href="{{ url('jobs-page') }}">Jobs</a></li>
                    <li><a href="{{ url('application-page') }}">Application</a></li>
                    <li><a href="{{ url('my-profile') }}">Profile</a></li>
                    <li><a href="{{ url('statistics-page') }}">Statistics</a></li>
                    <li><a href="{{ url('companies') }}">Companies</a></li>
                </ul>

            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-093-waving"></i>
                    <span class="nav-text">Jobs</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('job-list') }}">Job Lists</a></li>
                    <li><a href="{{ url('job-view') }}">Job View</a></li>
                    <li><a href="{{ url('job-application') }}">Job Application</a></li>
                    <li><a href="{{ url('apply-job') }}">Apply Job</a></li>
                    <li><a href="{{ url('new-job') }}">New Job</a></li>
                    <li><a href="{{ url('user-profile') }}">User Profile</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                    <span class="nav-text">CMS</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('content') }}">Content</a></li>
                    <li><a href="{{ url('content-add') }}">Add Content</a></li>
                    <li><a href="{{ url('menu') }}">Menus</a></li>
                    <li><a href="{{ url('email-template') }}">Email Template</a></li>
                    <li><a href="{{ url('add-email') }}">Add Email</a></li>
                    <li><a href="{{ url('blog') }}">Blog</a></li>
                    <li><a href="{{ url('add-blog') }}">Add Blog</a></li>
                    <li><a href="{{ url('blog-category') }}">Blog Category</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <ul aria-expanded="false">
					<li><a href="{{ url('app-profile') }}">Profile</a></li>
					<li><a href="{{ url('edit-profile') }}">Edit Profile</a></li>
					<li><a href="{{ url('post-details') }}">Post Details</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('email-compose') }}">Compose</a></li>
							<li><a href="{{ url('email-inbox') }}">Inbox</a></li>
							<li><a href="{{ url('email-read') }}">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('app-calender') }}">Calendar</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('ecom-product-grid')}}">Product Grid</a></li>
							<li><a href="{{url('ecom-product-list')}}">Product List</a></li>
							<li><a href="{{url('ecom-product-detail')}}">Product Details</a></li>
							<li><a href="{{url('ecom-product-order')}}">Order</a></li>
							<li><a href="{{url('ecom-checkout')}}">Checkout</a></li>
							<li><a href="{{url('ecom-invoice')}}">Invoice</a></li>
							<li><a href="{{url('ecom-customers')}}">Customers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('chart-flot')}}">Flot</a></li>
					<li><a href="{{url('chart-morris')}}">Morris</a></li>
					<li><a href="{{url('chart-chartjs')}}">Chartjs</a></li>
					<li><a href="{{url('chart-chartist')}}">Chartist</a></li>
					<li><a href="{{url('chart-sparkline')}}">Sparkline</a></li>
					<li><a href="{{url('chart-peity')}}">Peity</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-086-star"></i>
                    <span class="nav-text">Bootstrap</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('ui-accordion')}}">Accordion</a></li>
					<li><a href="{{url('ui-alert')}}">Alert</a></li>
					<li><a href="{{url('ui-badge')}}">Badge</a></li>
					<li><a href="{{url('ui-button')}}">Button</a></li>
					<li><a href="{{url('ui-modal')}}">Modal</a></li>
					<li><a href="{{url('ui-button-group')}}">Button Group</a></li>
					<li><a href="{{url('ui-list-group')}}">List Group</a></li>
					<li><a href="{{url('ui-card')}}">Cards</a></li>
					<li><a href="{{url('ui-carousel')}}">Carousel</a></li>
					<li><a href="{{url('ui-dropdown')}}">Dropdown</a></li>
					<li><a href="{{url('ui-popover')}}">Popover</a></li>
					<li><a href="{{url('ui-progressbar')}}">Progressbar</a></li>
					<li><a href="{{url('ui-tab')}}">Tab</a></li>
					<li><a href="{{url('ui-typography')}}">Typography</a></li>
					<li><a href="{{url('ui-pagination')}}">Pagination</a></li>
					<li><a href="{{url('ui-grid')}}">Grid</a></li>

                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-045-heart"></i>
                    <span class="nav-text">Plugins</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('uc-select2')}}">Select 2</a></li>
					<li><a href="{{url('uc-nestable')}}">Nestedable</a></li>
					<li><a href="{{url('uc-noui-slider')}}">Noui Slider</a></li>
					<li><a href="{{url('uc-sweetalert')}}">Sweet Alert</a></li>
					<li><a href="{{url('uc-toastr')}}">Toastr</a></li>
					<li><a href="{{url('map-jqvmap')}}">Jqv Map</a></li>
					<li><a href="{{url('uc-lightgallery')}}">Light Gallery</a></li>
                </ul>
            </li>
            <li><a href="{{ url('widget-basic') }}" class="" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Widget</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-072-printer"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('form-element')}}">Form Elements</a></li>
					<li><a href="{{url('form-wizard')}}">Wizard</a></li>
					<li><a href="{{ url('form-ckeditor') }}">CkEditor</a></li>
					<li><a href="{{url('form-pickers')}}">Pickers</a></li>
					<li><a href="{{ url('form-validation') }}">Form Validate</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-043-menu"></i>
                    <span class="nav-text">Table</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ url('table-bootstrap-basic')}}">Bootstrap</a></li>
                    <li><a href="{{ url('table-datatable-basic')}}">Datatable</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-022-copy"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
					<li><a href="{{ url('page-login') }}">Login</a></li>
					<li><a href="{{ url('page-register') }}">Register</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="{{url('page-error-400')}}">Error 400</a></li>
							<li><a href="{{url('page-error-403')}}">Error 403</a></li>
							<li><a href="{{url('page-error-404')}}">Error 404</a></li>
							<li><a href="{{url('page-error-500')}}">Error 500</a></li>
							<li><a href="{{url('page-error-503')}}">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('page-lock-screen')}}">Lock Screen</a></li>
					<li><a href="{{ url('empty-page') }}">Empty Page</a></li>
                </ul>
            </li>
        </ul>
        <div class="plus-box">
            <p class="fs-14 font-w600 mb-2">Let Jobick Managed<br>Your Resume Easily<br></p>
            <p class="plus-box-p">Lorem ipsum dolor sit amet</p>
        </div>
        <div class="copyright">
            <p><strong>Laravel Jobick Job Admin</strong> © 2023 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by DexignLab</p>
        </div>
    </div>
</div>
