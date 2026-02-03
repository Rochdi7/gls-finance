@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-titles">
                <h4 class="mb-0">Dashboard — GLS Finance</h4>
                <p class="text-muted mb-0">Bienvenue {{ auth()->user()->name }}</p>
            </div>
        </div>

        {{-- Cards (exemple) --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2">Total Revenue</h6>
                    <h4 class="mb-0">—</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2">Owner (50%)</h6>
                    <h4 class="mb-0">—</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2">Professors (35%)</h6>
                    <h4 class="mb-0">—</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2">Other Costs (15%)</h6>
                    <h4 class="mb-0">—</h4>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
