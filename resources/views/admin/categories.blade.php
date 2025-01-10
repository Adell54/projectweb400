@extends('admin.layout') @section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12"> <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-primary">Categories</h3> <a href="{{ url('/admin/addcategories') }}"
                        class="btn btn-success"> <i class="fas fa-plus"></i> Add Category </a>
                </div> <!-- Search Bar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <form>
                            <div class="input-group"> <input type="text" class="form-control"
                                    placeholder="Search categories by name..." id="searchCategories">
                                <div class="input-group-append"> <button type="button" class="btn btn-primary"> <i
                                            class="fas fa-search"></i> </button> </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- Categories Table -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTable"> <!-- Dummy Data -->
                                <tr>
                                    <td>1</td>
                                    <td> <img src="https://via.placeholder.com/50" alt="Category Image"
                                            class="img-thumbnail" style="width: 50px;"> </td>
                                    <td>Electronics</td>
                                    <td>Devices, gadgets, and electronics.</td>
                                    <td><span class="badge badge-success">Enabled</span></td>
                                    <td> <a href="{{ url('/admin/editcategories/1') }}" class="btn btn-warning btn-sm"> <i
                                                class="fas fa-edit"></i> Edit </a> <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('Electronics')"> <i class="fas fa-trash"></i> Delete
                                        </button> </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td> <img src="https://via.placeholder.com/50" alt="Category Image"
                                            class="img-thumbnail" style="width: 50px;"> </td>
                                    <td>Clothing</td>
                                    <td>Men's, women's, and kids' fashion.</td>
                                    <td><span class="badge badge-danger">Disabled</span></td>
                                    <td> <a href="{{ url('/admin/editcategories/2') }}" class="btn btn-warning btn-sm"> <i
                                                class="fas fa-edit"></i> Edit </a> <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('Clothing')"> <i class="fas fa-trash"></i> Delete
                                        </button> </td>
                                </tr> <!-- Add more rows as necessary -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5> <button type="button"
                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> Are you sure you want to delete this category? This action cannot be undone. Please
                    type the category name to confirm. <input type="text" id="confirmCategoryName"
                        class="form-control mt-2"> <input type="hidden" id="categoryNameToDelete"> </div>
                <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button> <button type="button" class="btn btn-danger"
                        onclick="deleteCategory()">Delete</button> </div>
            </div>
        </div>
    </div> <!-- Bootstrap and jQuery dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete(categoryName) {
            document.getElementById('confirmCategoryName').value = '';
            document.getElementById('categoryNameToDelete').value = categoryName;
            $('#confirmDeleteModal').modal('show');
        }

        function deleteCategory() {
            const confirmCategoryName = document.getElementById('confirmCategoryName').value;
            const categoryNameToDelete = document.getElementById('categoryNameToDelete').value;
            if (confirmCategoryName ===
                categoryNameToDelete) { // Perform the delete action 
                alert('Category ' + categoryNameToDelete + ' deleted successfully.');
                $('#confirmDeleteModal').modal('hide');
            } else {
                alert('Category name does not match. Deletion cancelled.');
            }
        }
    </script>
@endsection
