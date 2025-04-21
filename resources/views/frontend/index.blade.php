<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <title>Ordering System</title>

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
        }

        .card-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .card-container h2 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 15px;
        }

        .card-container p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-order {
            background: #28a745;
            color: white;
            margin-bottom: 10px;
        }

        .btn-order:hover {
            background: #218838;
        }

        .btn-admin {
            background: #007bff;
            color: white;
        }

        .btn-admin:hover {
            background: #0056b3;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <h2>🍽 Welcome to Our Ordering System</h2>
        <p>Place your order with ease or manage the system as an admin.</p>
        
        <a href="/admin/login" class="btn btn-custom btn-admin">🔑 Admin Login</a>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
