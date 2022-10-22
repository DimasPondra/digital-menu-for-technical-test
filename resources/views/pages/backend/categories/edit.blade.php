@extends('layouts.admin')

@section('title', 'Edit Category')
@section('categoryPage', 'active')

@section('content')
    <div class="nav">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
            <div class="d-flex justify-content-start align-items-center">
                <button id="toggle-navbar" onclick="toggleNavbar()">
                    <img src="{{ asset('backend/images/icons/burger.svg') }}" class="mb-2" alt="icon">
                </button>
                <h2 class="nav-title">
                    <a href="{{ route('admin.categories.index') }}">Category</a>
                </h2>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title mb-4">Edit Category</h2>
            </div>

            @error('errors')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="col-12 statistics-card">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    @include('pages.backend.categories.form', $category)
                </form>
            </div>
        </div>
    </div>
@endsection
