<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Foodiees</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #111;
            color: #fff;
            line-height: 1.6;
            padding: 40px;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            z-index: 100;
        }

        .navbar h1 {
            font-size: 24px;
            font-weight: bold;
            margin-left: 20px;
            color: #FF9F0D;
        }

        .navbar h1 span {
            color: white;
        }

        .navbar nav {
            display: flex;
            gap: 20px;
        }

        .navbar nav a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            margin-right: 20px;
        }

        .navbar nav a:hover {
            color: #FF9F0D;
        }

        /* Header Section */
        .header-section {
            text-align: center;
            padding-bottom: 40px;
            margin-top: 100px;
        }

        .header-section h1 {
            font-size: 2.5rem;
            color: #FF9F0D;
            margin-bottom: 20px;
        }

        .header-section p {
            color: #B0B0B0;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Content Section */
        .content-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0px;
            margin-top: 60px;
            margin-left: 40px;
        }

        .text-content {
            flex: 1;
            color: #fff;
            line-height: 1.6;
        }

        .text-content h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FF9F0D;
            margin-bottom: 20px;
        }

        .text-content p {
            color: #B0B0B0;
            margin-bottom: 20px;
        }

        .text-content ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .text-content ul li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .text-content ul li::before {
            content: "✔";
            color: #FF9F0D;
            margin-right: 10px;
        }

        .button {
            display: inline-block;
            background-color: #FF9F0D;
            color: #111;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #e68900;
        }

        /* Image Section */
        .image-section {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-end;
            margin-right: 40px;
        }

        .image-section img {
            width: calc(45% - 10px);
            border-radius: 10px;
        }

        .image-section .large-img {
            width: 90%;
        }

        /* WCS Section */
        .why-choose-us-wcs {
            display: flex;
            padding: 50px 0;
            background-color: #111;
            color: #fff;
            margin-top: 80px;
        }

        .container-wcs {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            gap: 20px;
        }

        .image-section-wcs {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 50%;
            margin-left: 0px;
            box-sizing: border-box;
            align-items: center;
        }

        .image-row-wcs {
            display: flex;
            gap: 15px;
            width: 50%
        }

        .large-img-wcs {
            width: 100%;
            border-radius: 10px;
        }

        .small-img-wcs {
            width: calc(50% - 7.5px);
            border-radius: 10px;
        }

        /* Content Section in WCS */
        .content-section-wcs {
            flex: 1;
            padding-left: 30px;
            margin-right: 40px;;
        }

        .content-section-wcs h4 {
            color: #FF9F0D;
            font-style: italic;
        }

        .content-section-wcs h2 {
            font-size: 36px;
            font-weight: bold;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .features-wcs {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 10px;
        }

        .feature-item-wcs {
            text-align: center;
            flex: 1;
        }

        .experience-wcs {
            background-color: #ffffff;
            color: #FF9F0D;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }

        /* Content Images in WCS Section */
        .content-images-wcs {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .content-images-wcs img {
            width: 70%;
            border-radius: 5px;
        }




        /* More Images Section */
        .image-text {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 0;
            margin-top: 80px;
        }

        .image-text h1 {
            font-size: 48px;
            font-weight: bold;
            margin-top: 8px;
        }

        .image-text h2 {
            color: #FF9F0D;
            font-size: 28px;
            font-family: 'Great Vibes';
            font-style: italic;
        }

        .more-images-section {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            justify-content: center;
        }

        .more-images-section img {
            width: calc(20% - 10px);
            border-radius: 8px;
            object-fit: cover;
        }

        /* Stats Section */
        .stats-section {
            display: flex;
            justify-content: space-around;
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            margin-top: 120px;
            background: url('{{ asset('images/Clients.png') }}') no-repeat center center/cover;
        }

        .stats-section img {
            width: 80px;
        }

        .stat {
            text-align: center;
        }

        .stat h3 {
            font-size: 24px;
            color: #ffffff;
        }

        .stat p {
            font-size: 20px;
            color: #ffffff;
        }

        h4 {
            font-size: 28px;
            font-family: 'Great Vibes', cursive;
            color: #FF9F0D;
            margin-bottom: 10px;
        }

        /* Icon Styles */
        .icon {
            margin-right: 8px;
            color: #ff9800;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <!-- Logo -->
        <h1>Food<span>iees</span></h1>

        <!-- Navigation links -->
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('menu') }}">Menu</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
    </div>

    <!-- Section 1: Content Section -->
    <div class="content-section">
        <div class="text-content">
            <h4>About Us</h4>
            <h2>We Create the Best Foody Product</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque diam pellentesque bibendum non dui volutpat fringilla bibendum.</p>
            <ul>
                <li>Lacus nisi, et ac dapibus sit eu velit in consequat.</li>
                <li>Quisque diam pellentesque bibendum non dui volutpat fringilla.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
            </ul>
            <a href="#" class="button">Read More</a>
        </div>
        <div class="image-section">
            <img src="{{ asset('images/about/dish1.png') }}" alt="Food Image 1" class="large-img">
            <img src="{{ asset('images/about/dish2.png') }}" alt="Food Image 2">
            <img src="{{ asset('images/about/dish3.png') }}" alt="Food Image 3">
        </div>
    </div>    

    <!--Section 2 : WCS-->
    <section class="why-choose-us-wcs">
        <div class="container-wcs">
            <!-- Image Section -->
            <div class="image-section-wcs">
                <div class="image-row-wcs">
                    <img src="{{ asset('images/about/dish8.png') }}" class="large-img-wcs" alt="Image 1">
                    <img src="{{ asset('images/about/dish11.png') }}" class="small-img-wcs" alt="Image 2">
                </div>
                <div class="image-row-wcs">
                    <img src="{{ asset('images/about/dish10.png') }}" class="small-img-wcs" alt="Image 3">
                    <img src="{{ asset('images/about/dish9.png') }}" class="small-img-wcs" alt="Image 4">
                    <img src="{{ asset('images/about/dish12.png') }}" class="small-img-wcs" alt="Image 5">
                </div>
            </div>
    
            <!-- Content Section -->
            <div class="content-section-wcs">
                <h4>Why Choose Us</h4>
                <h2>Extraordinary Taste <br> And Experience</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque diam pellentesque bibendum non dui fringilla bibendum.</p>
                
                <div class="content-images-wcs">
                    <img src="{{ asset('images/IconBox.png') }}" alt="Feature Image">
                </div>
    
                <div class="experience-wcs">
                    <h3>30+ <span>Years of Experience</span></h3>
                </div>
            </div>
        </div>
    </section>    
    
    <!-- Section 3: More Images Section -->
    <div>
        <div class="image-text">
            <h2>Fast & Fun Vibes!</h2>
            <h1>Next-Level <span>Food Quality</span></h1>
        </div>
        <div class="more-images-section">
            <img src="{{ asset('images/about/dish4.png') }}" alt="Food Image 3">
            <img src="{{ asset('images/about/dish5.png') }}" alt="Food Image 4">
            <img src="{{ asset('images/about/dish6.png') }}" alt="Food Image 5">
            <img src="{{ asset('images/about/dish7.png') }}" alt="Food Image 6">
        </div>
    </div>

    <!-- Section 4: Stats Section -->
    <div class="stats-section">
        <div class="stat">
            <img src="{{ asset('images/chef.png') }}" alt="chef">
            <h3>420</h3>
            <p>Professional Chefs</p>
        </div>
        <div class="stat">
            <img src="{{ asset('images/food.png') }}" alt="food">
            <h3>320</h3>
            <p>Items of Food</p>
        </div>
        <div class="stat">
            <img src="{{ asset('images/nyam.png') }}" alt="nyam">
            <h3>30+</h3>
            <p>Years of Experience</p>
        </div>
        <div class="stat">
            <img src="{{ asset('images/cust.png') }}" alt="cust">
            <h3>220</h3>
            <p>Happy Customers</p>
        </div>
    </div>
</body>

</html>
