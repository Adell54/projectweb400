@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Edit Product Form -->
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Edit Product</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.updateproduct', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="productImage">Product Image</label>
                            <input type="file" id="productImage" name="image" class="form-control" onchange="previewImage()">
                            <small id="fileHelp" class="form-text text-muted">Keeps current image if no file is selected.</small>
                        </div>
                        
                        <div class="form-group">
                            <div id="imagePreview" class="d-flex flex-wrap">
                                @if($product->image)
                                    <img src="data:image/jpeg;base64,{{ $product->image }}" class="img-thumbnail" style="width: 150px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" id="productQuantity" name="quantity" class="form-control" value="{{ $product->quantity }}" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" id="productPrice" name="price" class="form-control" value="{{ $product->price }}" step="0.01" min="0" required>
                        </div>


                        <div class="form-group">
                            <label for="productCost">Cost</label>
                            <input type="number" id="productCost" name="cost" class="form-control" value="{{ $product->cost }}" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <select id="productCategory" name="category" class="form-control">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea id="productDescription" name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="productStatus">Status</label>
                            <select id="productStatus" name="enabled" class="form-control">
                                <option value="1" {{ $product->enabled == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ $product->enabled == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-warning btn-lg">Update Product</button>
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        </div>
                    </form>

                    <script>
                        function previewImage() {
                            const preview = document.getElementById('imagePreview');
                            const file = document.getElementById('productImage').files[0];
                            const fileHelp = document.getElementById('fileHelp');
                            
                            preview.innerHTML = '';

                            if (file) {
                                const reader = new FileReader();
                                
                                reader.onload = (e) => {
                                    const imgElement = document.createElement('img');
                                    imgElement.src = e.target.result;
                                    imgElement.className = 'img-thumbnail';
                                    imgElement.style.width = '150px';
                                    preview.appendChild(imgElement);
                                    fileHelp.innerHTML = 'New image selected.';
                                };
                                
                                reader.readAsDataURL(file);
                            } else {
                                fileHelp.innerHTML = 'Keep current image if no file is selected.';
                            }
                        }
                    </script>
                    
                    <!-- Bootstrap and jQuery dependencies -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
