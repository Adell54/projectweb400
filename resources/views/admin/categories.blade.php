@extends('admin.layout')
@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Categories</h3>
                <a href="{{ url('/admin/categories/addcategory') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>

            <!-- Search Bar -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search categories by name..." id="searchCategories">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                        
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTable">
                            @foreach ($categories as $index => $item)
                            <tr id="category-row-{{ $item->id }}">
                                <td>{{ $index + 1 }}</td> <!-- Display sequence number -->
                                
                                <td>
                                    @if ($item->image)
                                        <img src="data:image/jpeg;base64,{{ $item->image }}" alt="{{ $item->name }}" class="img-thumbnail">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td class="description-cell">{{ $item->description }}</td>
                                <td><span class="badge {{ $item->enabled ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->enabled ? 'Enabled' : 'Disabled' }}
                                </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.editcategory', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $item->id) }}" id="delete-form-{{ $item->id }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        width: 150px; /* Increased width */
        height: 150px; /* Increased height */
    }
</style>

<script>
    function confirmDelete(categoryId) {
        if (confirm("Do you really want to delete this category?")) {
            document.getElementById(`delete-form-${categoryId}`).submit();
        }
    }
</script>
@endsection
