<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Main Section Styles */
        .contact-page {
            max-width: 1000px;
            margin: 120px auto 40px;
            padding: 20px;
            color: #ddd;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            margin-top: 80px;
        }

        .contact-page h1 {
            color: #ff9800;
            text-align: center;
            font-size: 28px;
        }

        .contact-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section {
            flex: 1;
            min-width: 300px;
            padding: 15px;
            border: 1px solid #444;
            border-radius: 8px;
        }

        .section h2 {
            color: #ff9800;
            font-size: 20px;
            text-align: center;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: #222;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 12px 20px;
            background-color: #ff9800;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e68900;
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
        <h1>Food<span>iees</span></h1>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('menu') }}">Menu</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
    </div>
    
    <div class="contact-page">
        <h1>Contact Us</h1>

        <!-- Contact Form and Info Side by Side -->
        <div class="contact-section">
            <div class="section">
                <h2>Get in Touch</h2>
                <form>
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>

            <div class="section">
                <h2>Contact Information</h2>
                <p><i class="fas fa-phone icon"></i><strong>Phone:</strong> +123 456 7890</p>
                <p><i class="fas fa-envelope icon"></i><strong>Email:</strong> support@example.com</p>
                <p><i class="fas fa-map-marker-alt icon"></i><strong>Address:</strong> 123 Main Street, Anytown, USA</p>
                <p><i class="fas fa-clock icon"></i><strong>Operating Hours:</strong> Mon - Sat: 8:00 AM - 6:00 PM, Sun: Closed</p>
            </div>
        </div>
    </div>
    
</body>
</html>
