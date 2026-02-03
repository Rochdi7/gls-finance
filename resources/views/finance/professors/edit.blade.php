@extends('layouts.default')

@php
    $page_title = 'Modifier un professeur';
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <h3 class="mb-0 me-auto">Modifier : {{ $professor->name }}</h3>
        <div>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form method="POST" action="{{ route('finance.professors.update', $professor) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @include('finance.professors._form', ['professor' => $professor])
                    </div>

                    <div class="card-footer text-end">
                        <div>
                            <a href="{{ route('finance.professors.index') }}" class="btn btn-danger light me-3">
                                Fermer
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
