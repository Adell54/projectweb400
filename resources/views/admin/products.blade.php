@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Products</h3>
                <a href="{{ url('/admin/addproduct') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>

            <!-- Search Bar -->
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search products by name..." id="searchProducts">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            <!-- Dummy Data -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="https://via.placeholder.com/50" alt="Product Image" class="img-thumbnail" style="width: 50px;">
                                </td>
                                <td>Smartphone</td>
                                <td>$499.99</td>
                                <td>50</td>
                                <td>Electronics</td>
                                <td><span class="badge badge-success">Enabled</span></td>
                                <td>
                                    <a href="{{ url('/admin/editproduct') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit" hr></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <img src="https://via.placeholder.com/50" alt="Product Image" class="img-thumbnail" style="width: 50px;">
                                </td>
                                <td>Running Shoes</td>
                                <td>$79.99</td>
                                <td>120</td>
                                <td>Clothing</td>
                                <td><span class="badge badge-danger">Disabled</span></td>
                                <td>
                                    <a href="{{ url('/admin/edit-product/2') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
