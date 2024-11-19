<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'My Portfolio') - Personal Website</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .navbar {
        background-color: #800000;
        box-shadow: 0 2px 4px #0000001a;
    }

    .hero-section {
        display: flex;
        align-items: center;          
        justify-content: center;      
        min-height: 100vh;             
        margin: 0;                    
        overflow: hidden;            
        background: linear-gradient(135deg, #800000, #FAF7F0);
        color: #ecf0f1;
    }

    .footer {
        background-color: #800000;
        color: #ecf0f1;
        padding: 2rem 0;
        margin-top: auto;
    }

    .social-icons a {
        color: #ecf0f1;
        margin: 0 10px;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #3498db;
    }
</style>