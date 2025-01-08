@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Add Product Form -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Product</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="form-group">
                            <label for="productImage">Product Image</label>
                            <input type="file" id="productImage" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" id="productQuantity" class="form-control" placeholder="Enter quantity" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" id="productPrice" class="form-control" placeholder="Enter price" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <select id="productCategory" class="form-control">
                                <option value="">Select a category</option>
                                <option value="1">Electronics</option>
                                <option value="2">Clothing</option>
                                <option value="3">Books</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea id="productDescription" class="form-control" rows="4" placeholder="Enter product description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="productStatus">Enabled</label>
                            <select id="productStatus" class="form-control">
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
@endsection
