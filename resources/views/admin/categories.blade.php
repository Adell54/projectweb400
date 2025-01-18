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

            <!-- Search Bar and Total Categories -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Total Categories: {{ $totalCategories }}</span>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Search categories by name..." id="searchCategories" onkeyup="searchCategories()">
                            <button type="button" class="btn btn-primary" onclick="searchCategories()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
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
                                <td><span class="badge {{ $item->enabled ? 'bg-success' : 'bg-danger' }}">{{ $item->enabled ? 'Enabled' : 'Disabled' }}</span></td>
                                <td>
                                    <a href="{{ route('admin.categories.editcategory', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirm({{ $item->id }}, '{{ $item->name }}')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    <form method="POST" action="{{ route('categories.destroy', $item->id) }}" id="delete-form-{{ $item->id }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please type the category name (<strong id="categoryNameToConfirm"></strong>) to confirm deletion:</p>
                <input type="text" id="confirmCategoryName" class="form-control">
                <input type="hidden" id="deleteCategoryId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function searchCategories() {
        const input = document.getElementById('searchCategories');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('categoryTable');
        const rows = table.getElementsByTagName('tr');

        Array.from(rows).forEach(function(row) {
            const td = row.getElementsByTagName('td')[2];
            if (td) {
                const txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }

    function showDeleteConfirm(categoryId, categoryName) {
        fetch(`{{ route('admin.categories.checkProducts', '') }}/${categoryId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.hasProducts) {
                alert(`Cannot delete category with associated products.`);
            } else {
                document.getElementById('confirmCategoryName').value = '';
                document.getElementById('categoryNameToConfirm').innerText = categoryName;
                document.getElementById('deleteCategoryId').value = categoryId;
                var myModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                myModal.show();
            }
        });
    }

    function confirmDelete() {
        const categoryId = document.getElementById('deleteCategoryId').value;
        const inputName = document.getElementById('confirmCategoryName').value;
        const actualName = document.getElementById('categoryNameToConfirm').innerText;

        if (inputName === actualName) {
            document.getElementById(`delete-form-${categoryId}`).submit();
        } else {
            alert('Category name does not match.');
        }
    }
</script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
