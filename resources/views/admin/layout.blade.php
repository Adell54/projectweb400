<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Custom CSS -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        #sidebar a {
            color: #fff;
            text-decoration: none;
        }

        #sidebar a:hover {
            background-color: #495057;
        }

        #sidebar .active {
            background-color: #007bff;
        }

        #content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <div class="sidebar-heading text-white text-center py-3 fs-4">
                        Admin Panel
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="/admin/products" class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}">
                                <i class="fas fa-box me-2"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/categories" class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                                <i class="fas fa-tags me-2"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/orders" class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                                <i class="fas fa-shopping-cart me-2"></i> Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            <main id="content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
                    <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                        Toggle Sidebar
                    </button>
                    <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
                </nav>

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
