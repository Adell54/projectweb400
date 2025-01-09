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
            background-color: #f8f9fa;
        }

        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        #sidebar-wrapper {
            width: 250px;
            background-color: #343a40;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        #sidebar-wrapper.collapsed {
            width: 70px;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 20px;
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            cursor: pointer;
        }

        #sidebar-wrapper .list-group {
            width: 100%;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #adb5bd;
            border: none;
        }

        #sidebar-wrapper .list-group-item:hover, #sidebar-wrapper .list-group-item.active {
            background-color: #495057;
            color: #ffffff;
        }

        #sidebar-wrapper .list-group-item i {
            margin-right: 10px;
        }

        #sidebar-wrapper.collapsed .list-group-item {
            text-align: center;
            padding: 10px 0;
        }

        #sidebar-wrapper.collapsed .list-group-item i {
            margin-right: 0;
        }

        #sidebar-wrapper.collapsed .list-group-item span {
            display: none;
        }

        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        #wrapper.collapsed #page-content-wrapper {
            margin-left: 70px;
        }

        #menu-toggle {
            position: absolute;
            top: 15px;
            left: 250px;
            background-color: #343a40;
            border: none;
            color: white;
            cursor: pointer;
            transition: left 0.3s;
        }

        #wrapper.collapsed #menu-toggle {
            left: 70px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="bg-dark">
            <div class="sidebar-heading" onclick="toggleMenu()">
                Admin Panel
            </div>
            <div class="list-group list-group-flush">
                <a href="/admin/dashboard" class="list-group-item list-group-item-action {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> <span>Dashboard</span>
                </a>
                <a href="/admin/products" class="list-group-item list-group-item-action {{ request()->is('admin/products') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> <span>Products</span>
                </a>
                <a href="/admin/categories" class="list-group-item list-group-item-action {{ request()->is('admin/categories') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> <span>Categories</span>
                </a>
                <a href="/admin/orders" class="list-group-item list-group-item-action {{ request()->is('admin/orders') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> <span>Orders</span>
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
          
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function toggleMenu() {
            document.getElementById('wrapper').classList.toggle('collapsed');
            document.getElementById('sidebar-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
