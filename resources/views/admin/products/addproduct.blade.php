@extends('admin.layout')

@section('content')



<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Add Product Form -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Product</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.addproduct')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="form-group">
                            <label for="productImages">Product Images</label>
                            <input type="file" id="productImages" name="image" class="form-control"  onchange="previewImages()">
                        </div>

                        <div class="form-group">
                            <div id="imagePreview" class="d-flex flex-wrap"></div>
                        </div>

                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" id="productQuantity" name="quantity" class="form-control" placeholder="Enter quantity" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" id="productPrice" name="price" class="form-control" placeholder="Enter price" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <select id="productCategory" name="category" class="form-control">                             
                                <option value="">Select a category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{$item->name}}</option>
                                @endforeach
                                
                               
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea id="productDescription" name="description" class="form-control" rows="4" placeholder="Enter product description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="productStatus">Status</label>
                            <select id="productStatus" name="enabled" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">Add Product</button>
                            <a href="{{ url('/admin/products') }}" class="btn btn-secondary btn-lg">Cancel</a>
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
