@extends('layouts.admin')

@section('title', 'Product')
@section('productPage', 'active')

@section('content')
    <div class="nav">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
            <div class="d-flex justify-content-start align-items-center">
                <button id="toggle-navbar" onclick="toggleNavbar()">
                    <img src="{{ asset('backend/images/icons/burger.svg') }}" class="mb-2" alt="icon">
                </button>
                <h2 class="nav-title">
                    <a href="{{ route('admin.products.index') }}">Product</a>
                </h2>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center nav-input-container">
            <form action="" method="GET" class="w-100">
                <div class="nav-input-group">
                    <input type="text" name="name" value="{{ request('name') }}" class="nav-input" placeholder="Search name">
                    <button class="btn-nav-input"><img src="{{ asset('backend/images/icons/search.svg') }}" alt="icon"></button>
                </div>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h2 class="content-title mb-4">List Products</h2>
                <div class="btn mb-2 mb-md-0">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                        Add new product
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @error('errors')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="col-12">
                <div class="statistics-card">
                    <div class="table-responsive h-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td width="10%">
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-outline-primary dropdown-toggle"
                                                    type="button"
                                                    id="dropdownMenu"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                ></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <li>
                                                        <a
                                                            href="{{ route('admin.products.edit', $product) }}"
                                                            class="btn btn-sm btn-link w-100 text-start"
                                                        >Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.products.change-status', $product) }}" method="POST">
                                                            @method('PATCH')
                                                            @csrf

                                                            <button type="submit" class="btn btn-sm btn-link w-100 text-start">
                                                                @if ($product->status == 'available')
                                                                    Not Available
                                                                @else
                                                                    Available
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.products.delete', $product) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit" class="btn btn-sm btn-link w-100 text-start">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex mt-4 justify-content-end">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
