<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>
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

        .menu-section, .chef-section {
            text-align: center;
            margin: 40px auto;
            width: 80%;
            margin
        }

        .chef-section{
            margin-top:80px;
        }

        .menu-title {
            font-size: 28px;
            color: #FFA500;
            font-family: Great Vibes;
        }

        .menu-nav button {
            background: none;
            color: #FF9F0D;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            position: relative; 
            transition: color 0.3s ease;
        }

        .menu-nav button::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #ffffff;
            transition: width 0.3s ease;
        }

        .menu-nav button:hover {
            color: #ffffff;
        }

        .menu-nav button:hover::after {
            width: 100%; 
        }


        .menu-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .menu-item {
            width: 200px;
            background-color: #333;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
        }

        .menu-item img {
            width: 100%;
            border-radius: 8px;
        }

        .menu-info {
            margin-top: 10px;
        }

        .menu-info h3 {
            font-size: 20px;
            color: #FFA500;
        }

        .price {
            color: #EEE;
        }

        .chef-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            justify-items: center;
            margin-top:40px;
        }

        .chef-profile {
            width: 150px;
            text-align: center;
        }

        .chef-profile img {
            width: 100%;
            border-radius: 50%;
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

    <!-- Menu Section -->
    <div class="menu-section">
        <h2 class="menu-title">Classic & Fresh</h2>
        <h1>From Our Menu</h1>
        <nav class="menu-nav">
            <button onclick="filterMenu('breakfast')">Breakfast</button>
            <button onclick="filterMenu('lunch')">Lunch</button>
            <button onclick="filterMenu('dinner')">Dinner</button>
            <button onclick="filterMenu('dessert')">Dessert</button>
            <button onclick="filterMenu('drink')">Drink</button>
            <button onclick="filterMenu('snack')">Snack</button>
            <button onclick="filterMenu('soups')">Soups</button>
        </nav>
        
        <div class="menu-grid" id="menu-items">
            <!-- Breakfast Items -->
            <div class="menu-item" data-category="breakfast">
                <img src="{{ asset('images/menu/lettuce.jpg') }}" alt="Lettuce Leaf">
                <div class="menu-info">
                    <h3>Lettuce Leaf</h3>
                    <p>Fresh and healthy lettuce salad.</p>
                    <span class="price">$12.55</span>
                </div>
            </div>
            <div class="menu-item" data-category="breakfast">
                <img src="{{ asset('images/menu/breakfast.png') }}" alt="Fresh Breakfast">
                <div class="menu-info">
                    <h3>Fresh Breakfast</h3>
                    <p>A complete, hearty breakfast.</p>
                    <span class="price">$14.55</span>
                </div>
            </div>
            <div class="menu-item" data-category="breakfast">
                <img src="{{ asset('images/menu/pancake.jpg') }}" alt="Pancakes">
                <div class="menu-info">
                    <h3>Pancakes</h3>
                    <p>Fluffy pancakes with maple syrup.</p>
                    <span class="price">$10.00</span>
                </div>
            </div>

            <!-- Lunch Items -->
            <div class="menu-item" data-category="lunch">
                <img src="{{ asset('images/menu/sandwich.jpg') }}" alt="Sandwich">
                <div class="menu-info">
                    <h3>Sandwich</h3>
                    <p>Classic club sandwich with fries.</p>
                    <span class="price">$10.00</span>
                </div>
            </div>
            <div class="menu-item" data-category="lunch">
                <img src="{{ asset('images/menu/burger.png') }}" alt="Burger">
                <div class="menu-info">
                    <h3>Burger</h3>
                    <p>Juicy beef burger with cheese.</p>
                    <span class="price">$12.00</span>
                </div>
            </div>

            <!-- Dinner Items -->
            <div class="menu-item" data-category="dinner">
                <img src="{{ asset('images/menu/steak.jpg') }}" alt="Steak">
                <div class="menu-info">
                    <h3>Steak</h3>
                    <p>Grilled steak with side vegetables.</p>
                    <span class="price">$22.00</span>
                </div>
            </div>
            <div class="menu-item" data-category="dinner">
                <img src="{{ asset('images/menu/pasta.jpg') }}" alt="Pasta">
                <div class="menu-info">
                    <h3>Pasta</h3>
                    <p>Italian pasta with marinara sauce.</p>
                    <span class="price">$18.75</span>
                </div>
            </div>

            <!-- Dessert Items -->
            <div class="menu-item" data-category="dessert">
                <img src="{{ asset('images/menu/cake.jpg') }}" alt="Cake">
                <div class="menu-info">
                    <h3>Cake</h3>
                    <p>Chocolate lava cake with ice cream.</p>
                    <span class="price">$6.50</span>
                </div>
            </div>
            <div class="menu-item" data-category="dessert">
                <img src="{{ asset('images/menu/iceCream.png') }}" alt="Ice Cream">
                <div class="menu-info">
                    <h3>Ice Cream</h3>
                    <p>Vanilla ice cream with chocolate drizzle.</p>
                    <span class="price">$4.50</span>
                </div>
            </div>

            <!-- Drink Items -->
            <div class="menu-item" data-category="drink">
                <img src="{{ asset('images/menu/coffee.jpg') }}" alt="Coffee">
                <div class="menu-info">
                    <h3>Coffee</h3>
                    <p>Freshly brewed coffee.</p>
                    <span class="price">$3.00</span>
                </div>
            </div>
            <div class="menu-item" data-category="drink">
                <img src="{{ asset('images/menu/smoothie.png') }}" alt="Smoothie">
                <div class="menu-info">
                    <h3>Smoothie</h3>
                    <p>Mixed fruit smoothie.</p>
                    <span class="price">$5.00</span>
                </div>
            </div>

            <!-- Soups -->
            <div class="menu-item" data-category="soups">
                <img src="{{ asset('images/menu/tomatoSoup.jpg') }}" alt="Tomato Soup">
                <div class="menu-info">
                    <h3>Tomato Soup</h3>
                    <p>Warm tomato soup with herbs.</p>
                    <span class="price">$4.50</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chef Section -->
    <div class="chef-section">
        <h1>Meet Our Chef</h1>
        <div class="chef-grid" id="chef-list">
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef1.png') }}" alt="Chef D. Estwood">
                <h3>D. Estwood</h3>
                <p>Chief Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef2.png') }}" alt="Chef D. Scoriesh">
                <h3>D. Scoriesh</h3>
                <p>Assistant Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef3.png') }}" alt="Chef M. William">
                <h3>M. William</h3>
                <p>Advertising Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef4.png') }}" alt="Chef W. Readfroad">
                <h3>W. Readfroad</h3>
                <p>Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef5.jpg') }}" alt="Chef J. Doe">
                <h3>J. Doe</h3>
                <p>Sous Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef6.jpg') }}" alt="Chef L. Smith">
                <h3>L. Smith</h3>
                <p>Pastry Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef7.jpg') }}" alt="Chef K. Brown">
                <h3>K. Brown</h3>
                <p>Line Chef</p>
            </div>
            <div class="chef-profile">
                <img src="{{ asset('images/menu/chef8.jpg') }}" alt="Chef P. Black">
                <h3>P. Black</h3>
                <p>Prep Chef</p>
            </div>
        </div>
    </div>

    <script>
    // Filter Menu Items
    function filterMenu(category) {
        const items = document.querySelectorAll('.menu-item');
        items.forEach(item => {
            item.style.display = item.getAttribute('data-category') === category ? 'block' : 'none';
        });
    }
    </script>
</body>
</html>
