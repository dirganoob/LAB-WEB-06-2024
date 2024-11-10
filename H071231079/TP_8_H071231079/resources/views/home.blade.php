<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodiees</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: black;
            color: white;
            margin: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(0, 0, 0); 
            z-index: 100;
        }

        .navbar h1 {
            font-size: 24px;
            font-weight: bold;
            color: #FF9F0D;
            margin-left: 20px; 
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

        section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset('images/bg.png') }}') no-repeat center center/cover;
            padding-top: 80px; /* Adjust for fixed navbar */
        }

        .overlay {
            position: absolute;
            inset: 0;
            background-color: black;
            opacity: 0.2;
            z-index: 10;
        }

        .hero-content {
            text-align: center;
            position: relative;
            z-index: 15;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-content h2 {
            color: #FF9F0D;
            font-size: 28px;
            font-family: Great Vibes;
            font-style: italic;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: bold;
            margin-top: 8px;
        }

        .hero-content h1 span {
            color: #FF9F0D;
        }

        .hero-content p {
            color: #B0B0B0;
            margin-top: 16px;
        }

        .hero-content button {
            background-color: #FF9F0D;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 4px;
            margin-top: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .hero-content button:hover {
            background-color: #FF9F0D;
        }

        .testimonial-section {
            text-align: center;
            max-width: 800px;
            padding: 40px 20px;
            margin: 0 auto;
            margin-top: 80px;
        }

        .testimonial-section h2 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .testimonial-container {
            position: relative;
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .testimonial {
            display: none;
            text-align: center;
            padding: 30px;
            background: #222;
            border-radius: 8px;
            position: relative;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .testimonial.active {
            display: block;
        }

        .testimonial img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid #222;
        }

        .testimonial p {
            font-size: 1rem;
            color: #B0B0B0;
            margin-top: 20px;
        }

        .testimonial h3 {
            color: #fff;
            margin: 15px 0 5px;
        }

        .testimonial .rating {
            color: #FF9F0D;
            margin-top: 10px;
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .carousel-indicators div {
            width: 10px;
            height: 10px;
            background: #555;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .carousel-indicators .active {
            background: #FF9F0D;
        }

        /* Process Section Styles */
        .process-section {
            position: relative;
            background: url('{{ asset('images/process.png') }}') no-repeat center center/cover;
            padding: 100px 20px;
            color: white;
            text-align: right;
            height:auto;
            margin-top: 50px;
            margin-bottom: 70px;
        }

        .process-section img {
            height: 180px;
        }

        .process-section .overlay {
            position: absolute;
            inset: 0;
        }

        .process-section .content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin: auto;
            margin-right: 40px;
            margin-left: 280px;
        }

        .process-section .title {
            font-size: 24px;
            font-family: 'Great Vibes', cursive;
            color: #FF9F0D;
            margin-bottom: 10px;
        }

        .process-section h2 {
            font-size: 38px;
            font-weight: bold;
            line-height: 1.2;
        }

        .process-section h2 span {
            color: #FF9F0D;
        }

        .process-section p {
            color: #D3D3D3;
            margin-top: 20px;
        }

        .process-section .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }

        .process-section a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            border: 1px solid #FF9F0D;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .process-section a:hover {
            background-color: #FF9F0D;
            color: black;
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

    <!-- Hero Section -->
    <section>
        <div class="overlay"></div>

        <div class="hero-content">
            <h2>Fast & Fun Vibes!</h2>
            <h1>Next-Level <span>Food Quality</span></h1>
            <p>Foodiees is here to keep you satisfied with mouth-watering dishes, served quick but never compromising on flavor. Top-tier meals, zero wait time, and pure happiness. Check out the menu now!</p>
            <button>See Menu</button>
        </div>
    </section>

    <!-- Testimonial Section -->
    <div class="testimonial-section">
        <h2>What the Squad's Saying</h2>
        <div class="testimonial-container">
        
            <div class="testimonial active">
                <img src="{{ asset('images/profile.png') }}" alt="Client Photo">
                <p>"Yo, this food is next-level! Fast and absolutely fire – didn’t expect this level of flavor at all. Highly recommend!"</p>
                <div class="rating">★★★★☆</div>
                <h3>Alamin Hasan</h3>
                <p>Foodie Expert</p>
            </div>
    
            <div class="testimonial">
                <img src="{{ asset('images/profile.png') }}" alt="Client Photo">
                <p>"Real talk, these dishes hit different! Love how fresh and tasty everything is. 10/10 would eat again." </p>
                <div class="rating">★★★★★</div>
                <h3>Jane Doe</h3>
                <p>Nutrition Boss</p>
            </div>
    
            <div class="testimonial">
                <img src="{{ asset('images/profile.png') }}" alt="Client Photo">
                <p>"The speed is unbelievable, and the taste is out of this world. Definitely my go-to place now!"</p>
                <div class="rating">★★★★☆</div>
                <h3>John Smith</h3>
                <p>Frequent Diner</p>
            </div>
        </div>

        <div class="carousel-indicators">
            <div class="active"></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Process Section -->
    <section class="process-section">
        <div class="overlay"></div>
        <div class="content">
            <div class="title">Simple and Smooth Process</div>
            <h2>Your Delicious Meal, <span>Ready in Minutes!</span></h2>
            <p>We keep it easy, fast, and flavorful. Here's how it works:</p>
            <div class="btn-container">
                <a href="#">Learn More</a>
                <a href="#">Order Now</a>
            </div>
        </div>
    </section>

    <script>
        // Testimonial carousel functionality
        let currentTestimonial = 0;
        const testimonials = document.querySelectorAll('.testimonial');
        const indicators = document.querySelectorAll('.carousel-indicators div');

        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                testimonial.classList.remove('active');
                indicators[i].classList.remove('active');
            });

            testimonials[index].classList.add('active');
            indicators[index].classList.add('active');
            currentTestimonial = index;
        }

        // Auto slide testimonial
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }, 5000); // Change every 5 seconds
    </script>
    
</body>
</html>
