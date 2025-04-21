<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Retailer - {{ ucfirst(session('salesperson_name')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/admin/css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    <style>
        /* ✅ Prevent Scroll Issues */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* ✅ Background with Floating Animated Circles */
        .welcome-section {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: #ff7518;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .welcome-section::before,
        .welcome-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 3s ease-in-out infinite;
        }

        .welcome-section::before { top: -50px; left: -50px; }
        .welcome-section::after { bottom: -50px; right: -50px; width: 300px; height: 300px; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        /* ✅ Login Form Styling */
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 350px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .logo {
            font-size: 36px;
            font-weight: bold;
            color: #ff7518;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #ff7518;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #ff5c00;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* ✅ Input Field Styling */
        .password-wrapper {
            position: relative;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
            font-size: 15px;
            width: 100%;
        }

        .form-control:focus {
            border-color: #ff7518;
            box-shadow: 0px 0px 5px rgba(255, 117, 24, 0.5);
        }

        /* ✅ Password Toggle Eye Icon */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #666;
            transition: 0.3s;
        }

        .password-toggle:hover {
            color: #ff7518;
        }

        /* ✅ Forgot Password Link */
        .forgot-password {
            text-align: right;
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }

        /* ✅ Back Button */
        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .back-button:hover {
            background: white;
            color: #ff7518;
        }
    </style>
    <script>
        function togglePassword(id, iconId) {
            let passwordField = document.getElementById(id);
            let icon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function goBack() {
            window.history.back();
        }

        $(document).ready(function () {
            // Validate reCAPTCHA on form submit
            $('#loginForm').on('submit', function (e) {
                if (grecaptcha.getResponse() === "") {
                    e.preventDefault();
                    alert("Please check the reCAPTCHA box.");
                }
            });
        });
    </script>
</head>
<body> 
    <div class="welcome-section">
       
        <div class="login-container">
           <h3 class="mb-3">Welcome Back! {{ ucfirst(session('salesperson_name')) }} </h3>
            <form id="loginForm" action="{{ route('retailer.get') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select class="form-select" name="retailer" required>
                        <option >Select Retailer</option>
                        @foreach($retailers as $retailer)
                            <!-- <option value="{{ $retailer->id }}">{{ $retailer->mobile }}</option> -->
                            <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-custom w-100 mt-2">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
