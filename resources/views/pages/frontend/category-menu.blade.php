@extends('layouts.app')

@section('title', 'Menu' .' - '. $category->name)

@section('content')
    <div class="container ps-3 p-md-4 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home-page') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-start mt-4">
            @forelse ($products as $product)
                <div class="col-12 col-md-4 col-lg-3 mb-3">
                    <div class="card">
                        <img
                            src="{{ $product->file->show_file }}"
                            class="card-img-top"
                            alt="image-product"
                            style="height: 180px; object-fit: cover;"
                        >
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp. {{ $product->price }}</p>
                            <a href="{{ route('detail-menu-page', [$category, $product->slug]) }}" class="btn btn-primary mt-5">Show Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    No Data
                </div>
            @endforelse
        </div>
        <div class="d-flex mt-5 justify-content-end">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
