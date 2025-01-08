@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Edit Product</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" id="productName" class="form-control" value="Smartphone" required>
                        </div>

                        <div class="form-group">
                            <label for="productImage">Product Image</label>
                            <input type="file" id="productImage" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" id="productQuantity" class="form-control" value="50" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" id="productPrice" class="form-control" value="499.99" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <select id="productCategory" class="form-control">
                                <option value="1" selected>Electronics</option>
                                <option value="2">Clothing</option>
                                <option value="3">Books</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea id="productDescription" class="form-control" rows="4">High-quality smartphone with excellent features.</textarea>
                        </div>

                        <div class="form-group">
                            <label for="productStatus">Enabled</label>
                            <select id="productStatus" class="form-control">
                                <option value="1" selected>Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-warning btn-lg">Update Product</button>
                            <a href="{{ url('/admin/products') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
