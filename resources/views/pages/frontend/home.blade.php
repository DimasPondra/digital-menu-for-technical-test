@extends('layouts.app')

@section('title', 'Home')
@section('homePage', 'active')

@section('content')
    <div class="container ps-3 p-md-4 mt-5">
        <div class="row d-flex justify-content-start">
            @forelse ($categories as $category)
                <div class="col-12 col-md-3 mb-4">
                    <a href="{{ route('category-menu-page', $category) }}">
                        <div class="card text-dark bg-info">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    {{ $category->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center">
                    No Data
                </div>
            @endforelse
        </div>
    </div>
@endsection
