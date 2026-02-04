@extends('layouts.default')
@php
    $page_title = 'Modifier un centre';
@endphp

@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center mb-4">
            <h3 class="mb-0 me-auto">Modifier le centre</h3>
            <div>
                <a href="javascript:void(0);" class="icon-btn me-3"> <i class="fas fa-envelope"></i></a>
                <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
                <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <form method="POST" action="{{ route('finance.centers.update', $center) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            @include('finance.centers._form', ['center' => $center])
                        </div>

                        <div class="card-footer text-end">
                            <div>
                                <a href="{{ route('finance.centers.index') }}" class="btn btn-danger light me-3">Annuler</a>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
