<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f85032, #e73827);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            padding: 20px;
        }

        .error-container h1 {
            font-size: 8rem;
            margin: 0;
        }

        .error-container h2 {
            font-size: 2rem;
            margin: 10px 0;
        }

        .error-container p {
            font-size: 1rem;
            margin: 20px 0;
        }

        .error-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: #fff;
            color: #e73827;
            text-decoration: none;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .error-container a:hover {
            background: #e73827;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .error-container h1 {
                font-size: 5rem;
            }

            .error-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>500</h1>
        <h2>Internal Server Error</h2>
        <p>Something went wrong on our end. <br> Please try refreshing the page or come back later.</p>
        <a href="/">Go to Homepage</a>
    </div>
</body>

</html>