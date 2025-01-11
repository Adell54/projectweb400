@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Edit Category Form -->
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="categoryName">Category Name</label>
                            <input type="text" id="categoryName" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="categoryImage">Category Image</label>
                            <input type="file" id="categoryImage" name="image" class="form-control" onchange="previewImage()">
                        </div>

                        <div class="form-group mb-3">
                            <div id="imagePreview" class="mt-3">
                                @if ($category->image)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($category->image) }}" alt="Current Image" class="img-thumbnail" style="width: 150px;">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="Current Image" class="img-thumbnail" style="width: 150px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="categoryDescription">Description</label>
                            <textarea id="categoryDescription" name="description" class="form-control" rows="4">{{ $category->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="categoryStatus">Status</label>
                            <select id="categoryStatus" name="enabled" class="form-control">
                                <option value="1" {{ $category->enabled ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ !$category->enabled ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-warning btn-lg">Update Category</button>
                            <a href="{{ url('/admin/categories') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const preview = document.getElementById('imagePreview');
        const file = document.getElementById('categoryImage').files[0];

        preview.innerHTML = '';

        if (file) {
            const reader = new FileReader();

            reader.onload = (e) => {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.className = 'img-thumbnail';
                imgElement.style.width = '150px';
                preview.appendChild(imgElement);
            };

            reader.readAsDataURL(file);
        }
    }
</script>

<!-- Bootstrap dependencies (without jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection
