@extends('layouts.app')

@section('title', 'Menu' .' - '. $product->name)

@section('content')
    <div class="container ps-3 p-md-4 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home-page') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category-menu-page', $category) }}">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-start mt-4">
            <div class="col-12 col-lg-10">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img
                                src="{{ $product->file->show_file }}"
                                class="img-fluid rounded-start"
                                alt="image-product"
                                style="object-fit: cover; height: 100%;"
                            >
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><small class="text-muted">Rp. {{ $product->price }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
