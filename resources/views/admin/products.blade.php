@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Products</h3>
                <a href="{{ url('/admin/addproduct') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>

            <!-- Total Items -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Total Products: {{ $totalProducts }}</span>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Search products by name..." id="searchProducts">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th> <!-- Sequence number -->
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
                            @foreach ($products as $index => $product)
                            <tr id="product-row-{{ $product->id }}">
                                <td>{{ $index + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td> <!-- Sequence number adjusted for pagination -->
                                <td>
                                    @if ($product->image)
                                        <img src="data:image/jpeg;base64,{{ $product->image }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 150px; height: 150px;">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="No image" class="img-thumbnail" style="width: 150px; height: 150px;">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $categoryMap[$product->category_id] ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $product->enabled ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->enabled ? 'Enabled' : 'Disabled' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.editproduct', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="" id="delete-form-{{ $product->id }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $product->id }},  )">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="btn d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .description-cell {
        max-width: 300px;
        word-wrap: break-word;
        padding: 10px;
    }
    .img-thumbnail {
        width: 150px;
        height: 150px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa; /* Light background on hover */
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2; /* Light gray background for striped rows */
    }
    .table td, .table th {
        vertical-align: middle; /* Center align text vertically */
    }
    .table .btn {
        margin: 2px; /* Add some space between buttons */
    }
</style>

<script>
    function confirmDelete(productId) {
        if (confirm("Do you really want to delete this product?")) {
            document.getElementById(`delete-form-${productId}`).submit();
        }
    }
</script>
@endsection
