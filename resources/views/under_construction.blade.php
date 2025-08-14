<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Discover the latest in digital appliances and electronics at Digi. Shop our wide range of products including TVs, washing machines, refrigerators, and more. Enjoy unbeatable prices and quality service.">
    <meta name="keywords" content="Digi, digital appliances, electronics, UHD Smart TV, washing machines, refrigerators, gas cookers, air conditioners, online shopping">
    <meta property="og:description" content="Discover the latest in digital appliances and electronics at Digi. Shop our wide range of products including TVs, washing machines, refrigerators, and more. Enjoy unbeatable prices and quality service.">
    <meta property="og:keywords" content="digi, digital appliances, umejipata, tv za bei rahisi, electronics, UHD Smart TV, washing machines, refrigerators, gas cookers, air conditioners, online shopping">
    <meta property="og:image" content="{{ asset('img/favicon.png') }}">
    <title>Digi Appliances - Under Construction</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F2F0EC;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(0, 255, 204, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 20%;
            animation-delay: 1s;
            background: rgba(255, 107, 107, 0.6);
        }

        .particle:nth-child(3) {
            left: 30%;
            animation-delay: 2s;
        }

        .particle:nth-child(4) {
            left: 40%;
            animation-delay: 3s;
            background: rgba(78, 205, 196, 0.6);
        }

        .particle:nth-child(5) {
            left: 50%;
            animation-delay: 4s;
        }

        .particle:nth-child(6) {
            left: 60%;
            animation-delay: 0.5s;
            background: rgba(255, 107, 107, 0.6);
        }

        .particle:nth-child(7) {
            left: 70%;
            animation-delay: 1.5s;
        }

        .particle:nth-child(8) {
            left: 80%;
            animation-delay: 2.5s;
            background: rgba(78, 205, 196, 0.6);
        }

        .particle:nth-child(9) {
            left: 90%;
            animation-delay: 3.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            50% {
                transform: translateY(-10vh) rotate(180deg);
                opacity: 1;
            }
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .logo {
            margin-bottom: 3rem;
            margin-top: 4em;
            animation: fadeInUp 1s ease-out;
        }

        .logo img {
            font-size: 3.5rem;
            font-weight: 700;
        }

        .logo .tagline {
            font-size: 1.1rem;
            color: #a0a0a0;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .main-content {
            max-width: 600px;
            margin-bottom: 4rem;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .coming-soon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: #1B1917;
            background-clip: text;
            line-height: 1.1;
        }

        .description {
            font-size: 1.3rem;
            color: #b0b0b0;
            margin-bottom: 3rem;
            font-weight: 300;
            line-height: 1.6;
        }

        .notify-form {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .email-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 2px solid #ffc197;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .email-input:focus {
            outline: none;
            border-color: #EA6911;
            box-shadow: 0 0 20px #ea681153;
        }

        .email-input::placeholder {
            color: #888;
        }

        .notify-btn {
            padding: 1rem 2rem;
            background: #EA6911;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 400;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .notify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 255, 204, 0.4);
        }

        .social-links {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 3rem;
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .social-links a {
            color: #EA6911;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        .social-link {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .social-link:hover {
            transform: translateY(-3px);
            background: rgba(0, 255, 204, 0.1);
            border-color: #00ffcc;
            box-shadow: 0 10px 30px rgba(0, 255, 204, 0.2);
        }

        .back-link {
            color: #a0a0a0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 1.2s both;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-link:hover {
            color: #00ffcc;
            border-color: #00ffcc;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .logo h1 {
                font-size: 2.5rem;
            }

            .coming-soon {
                font-size: 2.5rem;
            }

            .description {
                font-size: 1.1rem;
            }

            .notify-form {
                flex-direction: column;
                gap: 1rem;
            }

            .notify-btn {
                padding: 1rem;
            }

            .container {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 2rem;
            }

            .coming-soon {
                font-size: 2rem;
            }

            .social-links {
                gap: 1rem;
            }

            .social-link {
                width: 45px;
                height: 45px;
            }
        }
    </style>
</head>

<body>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    <div class="container">
        <div class="logo">
            <img src="./img/digi-logo.svg" width="180" alt="">
        </div>
        <div class="main-content">
            <h2 class="coming-soon">Coming Soon!</h2>
            <p class="description"> We're refreshing our website and working on something extraordinary. Stay tuned for the launch date.
            </p>
            <div class="notify-form">
                <input type="email" class="email-input" placeholder="Enter your email address" id="emailInput">
                <button class="notify-btn" onclick="handleNotify()">Notify Me</button>
            </div>
        </div>
        <div class="social-links">
            <a href="https://www.instagram.com/digi_tanzania/" target="_blank" class="social-link" title="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.facebook.com/people/DIGI-Tanzania/61573040064155/?_rdr" target="_blank" class="social-link" title="Twitter">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="social-link" title="LinkedIn">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>
    </div>
    <script>
        function handleNotify() {
            const email = document.getElementById('emailInput').value;
            if (email && email.includes('@')) {
                alert('Thank you! We\'ll notify you when we launch.');
                document.getElementById('emailInput').value = '';
            } else {
                alert('Please enter a valid email address.');
            }
        }

        // Handle Enter key in email input
        document.getElementById('emailInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                handleNotify();
            }
        });

        // Add some interactive particle effects
        document.addEventListener('mousemove', function (e) {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            particles.forEach((particle, index) => {
                const rect = particle.getBoundingClientRect();
                const particleX = rect.left + rect.width / 2;
                const particleY = rect.top + rect.height / 2;

                const distance = Math.sqrt(Math.pow(mouseX - particleX, 2) + Math.pow(mouseY - particleY, 2));

                if (distance < 100) {
                    particle.style.transform = `scale(${1.5 - distance / 100})`;
                    particle.style.opacity = `${1 - distance / 200}`;
                } else {
                    particle.style.transform = 'scale(1)';
                    particle.style.opacity = '0.6';
                }
            });
        });
    </script>
</body>

</html>
