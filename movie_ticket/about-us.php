<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Phoenix Hall</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #f4f4f4, #eaeaea);
            color: #333;
            overflow-x: hidden;
        }

        /* Container */
        .about-us-container {
            max-width: 960px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.8s ease-out forwards;
            text-align: center; /* Center text content */
        }

        /* Heading */
        h1 {
            color: #5A2D82;
            font-size: 28px;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeIn 0.6s ease-out forwards 0.3s;
        }

        /* Content */
        .about-us-content {
            line-height: 1.8;
            font-size: 16px;
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards 0.5s;
        }

        /* Centered Image */
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .about-us-image {
            max-width: 80%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .about-us-image:hover {
            transform: scale(1.05);
        }

        /* List Box Container */
        .feature-boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .feature-box {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 45%;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards 0.6s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .feature-box strong {
            display: block;
            font-size: 18px;
            color: #5A2D82;
            margin-bottom: 5px;
        }

        /* Button */
        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            padding: 12px 25px;
            background: #5A2D82;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards 0.8s;
        }

        .back-link:hover {
            background: #7D3C98;
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about-us-container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .feature-box {
                width: 100%;
            }

            .about-us-image {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="about-us-container">
        <h1>About Us</h1>

        <div class="image-container">
            <img src="uploads/movie.jpeg" alt="About Us Image" class="about-us-image">
        </div>

        <div class="about-us-content">
            <p>Welcome to <strong>Phoenix Hall</strong>, your premier destination for entertainment and events! Whether you're catching the latest blockbuster, celebrating a special occasion, or attending a corporate event, we are here to create unforgettable experiences.</p>

            <p>At Phoenix Hall, we believe in delivering world-class service with comfort and innovation. Our modern facilities, plush seating, and immersive sound systems ensure that every visit is a delight.</p>

            <p>What sets Phoenix Hall apart:</p>

            <div class="feature-boxes">
                <div class="feature-box">
                    <strong>🎥 State-of-the-art Technology</strong>
                    Experience the best in projection and sound.
                </div>

                <div class="feature-box">
                    <strong>💺 Comfortable Seating</strong>
                    Relax and enjoy the show in ultimate comfort.
                </div>

                <div class="feature-box">
                    <strong>🎭 Versatile Event Spaces</strong>
                    From movie premieres to weddings, we host it all.
                </div>

                <div class="feature-box">
                    <strong>🌟 Exceptional Service</strong>
                    Our friendly staff is here to assist you.
                </div>

                <div class="feature-box">
                    <strong>📍 Convenient Location</strong>
                    Easily accessible with ample parking.
                </div>
            </div>

            <p>We are committed to innovation and excellence, constantly improving to offer you the best entertainment experience.</p>

            <p><em>Thank you for choosing Phoenix Hall. We look forward to welcoming you soon!</em></p>
        </div>

        <a href="index.php" class="back-link">Back to Home</a>
    </div>

</body>
</html>
