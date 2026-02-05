@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">Job List</h3>
        <div>
            <a href="{{ url('new-job') }}" class="btn btn-primary me-3"><i class="fas fa-plus me-2"></i>Add New Job</a>
            <a href="javascript:void(0);" class="icon-btn me-3"> <i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table class="table display mb-4 dataTablesCard job-table table-responsive-xl card-table"
                    id="example5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Posted Date</th>
                            <th>Last Date To Apply</th>
                            <th>Close Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Network Engineer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>12-01-2023</td>
                            <td>24-01-2023</td>
                            <td>25-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Entry Level Software Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>13-01-2023</td>
                            <td>25-01-2023</td>
                            <td>26-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Java Developer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>13-01-2023</td>
                            <td>26-01-2023</td>
                            <td>27-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>IOS Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>15-01-2023</td>
                            <td>27-01-2023</td>
                            <td>28-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Junior Web Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>18-01-2023</td>
                            <td>30-01-2023</td>
                            <td>31-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>SQL Developer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>12-01-2023</td>
                            <td>24-01-2023</td>
                            <td>25-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Junior Developer</td>
                            <td class="wspace-no">part-Time</td>
                            <td>15-01-2023</td>
                            <td>30-01-2023</td>
                            <td>24-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>Network Engineer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>12-01-2023</td>
                            <td>24-01-2023</td>
                            <td>25-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Entry Level Software Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>13-01-2023</td>
                            <td>25-01-2023</td>
                            <td>26-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Java Developer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>13-01-2023</td>
                            <td>26-01-2023</td>
                            <td>27-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>IOS Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>15-01-2023</td>
                            <td>27-01-2023</td>
                            <td>28-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Junior Web Developer</td>
                            <td class="wspace-no">Part-Time</td>
                            <td>18-01-2023</td>
                            <td>30-01-2023</td>
                            <td>31-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>SQL Developer</td>
                            <td class="wspace-no">Full-Time</td>
                            <td>12-01-2023</td>
                            <td>24-01-2023</td>
                            <td>25-01-2023</td>
                            <td><span class="badge badge-success badge-lg light">Active</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Junior Developer</td>
                            <td class="wspace-no">part-Time</td>
                            <td>15-01-2023</td>
                            <td>30-01-2023</td>
                            <td>24-01-2023</td>
                            <td><span class="badge badge-danger badge-lg light">InActive</span></td>
                            <td>
                                <div class="action-buttons d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-success light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-main-icon" width="24px"
                                            height="24px" viewBox="0 0 32 32" x="0px" y="0px">
                                            <g data-name="Layer 21">
                                                <path
                                                    d="M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <circle cx="16" cy="16" r="3" fill="#000000"
                                                    fill-rule="nonzero"></circle>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-secondary light mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                    height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger light">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
@push('scripts')
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
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
                    </div>
                    <div class="col-xl-6  col-md-6 mb-4">
                        <label class="form-label required">Position</label>
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
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
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name">
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
                        <input type="text" class="form-control solid" placeholder="City" aria-label="name">
                    </div>
                    <div class="col-xl-6  col-md-6 mb-4">
                        <label class="form-label required">Enter State:</label>
                        <input type="text" class="form-control solid" placeholder="State" aria-label="name">
                    </div>
                    <div class="col-xl-6  col-md-6 mb-4">
                        <label class="form-label required">Enter Counter:</label>
                        <input type="text" class="form-control solid" placeholder="State" aria-label="name">
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
@endpush

