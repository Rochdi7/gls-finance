@extends('layouts.default')
@php
    $page_title = 'Create Centers';
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <h3 class="mb-0 me-auto">Create Center</h3>
        <div>
            <a href="javascript:void(0);" class="icon-btn me-3"> <i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form method="POST" action="{{ route('finance.centers.store') }}">
                    @csrf

                    <div class="card-body">
                        @include('finance.centers._form')
                    </div>

                    <div class="card-footer text-end">
                        <div>
                            <a href="{{ route('finance.centers.index') }}" class="btn btn-danger light me-3">Close</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
