@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Add Category Form -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Category</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" id="categoryName" name="name" class="form-control" placeholder="Enter category name" required>
                        </div>

                        <div class="form-group">
                            <label for="categoryImage">Category Image</label>
                            <input type="file" id="categoryImage" name="image" class="form-control" onchange="previewImage()">
                        </div>

                        <div class="form-group">
                            <div id="imagePreview" class="mt-3"></div>
                        </div>

                        <div class="form-group">
                            <label for="categoryDescription">Description</label>
                            <textarea id="categoryDescription" name="description" class="form-control" rows="4" placeholder="Enter category description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="categoryStatus">Status</label>
                            <select id="categoryStatus" name="enabled" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">Add Category</button>
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

<!-- Bootstrap and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection
