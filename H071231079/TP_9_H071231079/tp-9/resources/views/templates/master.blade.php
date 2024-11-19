<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Poppins;
            background-image: url('/images/bg.jpg'); 
            background-size: cover; 
            background-position: center; 
            padding-top: 70px;
        }

        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #133E87;
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffffff;
            gap:40px;
        }

        .nav-link {
            font-weight: 500;
            color: #ffffff; 
        }

        .nav-link:hover {
            color: #F2E8C6; 
        }

        .header-button {
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 1200px;
        }
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Productiq</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item me-4">
                            <a class="nav-link" href="{{ route('category.index') }}">Category</a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link" href="{{ route('product.index') }}">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventory-log.index') }}">Inventory Log</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    @include('components/message')

    <!-- Content Section -->
    <div class="header-button">
        @yield('header-button')
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
