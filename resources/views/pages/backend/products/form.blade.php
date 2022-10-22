<div class="form-group mb-3">
    <label for="name" class="mb-2">
        Name
        <span class="required">*</span>
    </label>
    <input
        type="text"
        class="form-control @error('name')
            is-invalid
        @enderror"
        id="name"
        name="name"
        value="{{ old('name', $product->name) }}"
    >
    @error('name')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="description" class="mb-2">
        Description
    </label>
    <textarea
        class="form-control @error('description')
            is-invalid
        @enderror"
        name="description"
        id="description"
        cols="30"
        rows="10"
    >{{ old('description', $product->description) }}</textarea>
    @error('description')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group mb-3">
            <label for="name" class="mb-2">
                Price
                <span class="required">*</span>
            </label>
            <input
                type="number"
                class="form-control @error('price')
                    is-invalid
                @enderror"
                id="price"
                name="price"
                value="{{ old('price', $product->price) }}"
            >
            @error('price')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-6">
        <div class="form-group mb-3">
            <label for="name" class="mb-2">
                Category
                <span class="required">*</span>
            </label>
            <select
                class="form-select @error('category_id')
                    is-invalid
                @enderror"
                name="category_id"
                id="category_id"
            >
                <option selected disabled>Select category</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @if (old('category_id', $product->category_id) == $category->id)
                            selected
                        @endif
                    >{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label for="file" class="mb-2">
        Picture
        @if (empty($product->file_id))
            <span class="required">*</span>
        @endif
    </label>

    @if (!empty($product->file_id))
        <img
            src="{{ $product->file->show_file }}"
            class="d-flex mb-3 rounded"
            alt="image"
            style="width: 120px; height: 120px; object-fit: cover;"
        >
    @endif

    <input
        type="file"
        name="file"
        id="file"
        class="form-control @error('file')
            is-invalid
        @enderror"
    >
    @error('file')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-sm btn-success">Save</button>
</div>
