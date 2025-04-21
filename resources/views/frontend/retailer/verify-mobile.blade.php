
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Select Retailer - {{ ucfirst(session('salesperson_name')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/admin/css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }
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

        .password-wrapper {
            position: relative;
            display: none; 
        }

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

        .forgot-password {
            text-align: right;
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }

        .radio-buttons {
            display: flex;
            gap: 20px;
            font-size: 14px;
            margin-top: 10px;
        }

        .radio-buttons label {
            cursor: pointer;
        }

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
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }
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
        .forgot-password {
            text-align: right;
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }
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
</head>
<body> 
    <div class="welcome-section">
        <div class="login-container text-start" id="login-container">
            <form id="verify-mobile-form" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Enter Retailer's 10 digit mobile" required>
                    <span id="mobile-error" style="color: red; display: none;">Invalid mobile number or already exists!</span>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Verify</button>
            </form>

            <form id="retailer-form" style="display: none;" method="POST">
                @csrf
                <div>
                    <label for="name">Retailer's Name</label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Retailer's Name" required>
                </div>

                <div>
                    <label for="mobile">Mobile Number</label>
                    <input type="text" id="new_mobile" class="form-control" name="mobile" value="${mobileNumber}" required>
                </div>

                <div class="radio-buttons">
                    <label>
                        <input type="radio" name="id_type" value="pan" id="pan_radio" checked> PAN Number
                    </label>
                    <label>
                        <input type="radio" name="id_type" value="gstin" id="gstin_radio"> GSTIN Number
                    </label>
                </div>

                
                <div class="form-group" id="pan_div">
                    <label for="pan_no">PAN Number</label>
                    <input type="text" id="pan_no" class="form-control" name="pan_no" placeholder="Enter Retailer's PAN Number" required>
                </div>

               
                <div class="form-group" id="gstin_div" style="display: none;">
                    <label for="gstin">GSTIN Number</label>
                    <input type="text" id="gstin" class="form-control" name="gstin" placeholder="Enter Retailer's GSTIN Number" required>
                </div>

                
                <div class="password-wrapper">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" value="123456" required>
                    <button type="button" class="password-toggle" id="toggle-password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>

               
                <button type="button" class="btn btn-primary mt-3 creteretail">Create Retailer</button>
            </form>
        </div> 
    </div>

    <script>
    $(document).ready(function() {
        $('#verify-mobile-form').submit(function(e) {
            e.preventDefault();
            var mobileNumber = $('#mobile').val();

            if (!/^\d{10}$/.test(mobileNumber)) {
                $('#mobile-error').show().text('Please enter a valid 10-digit mobile number!');
                return false;
            } else {
                $('#mobile-error').hide();
            }

            $.ajax({
                url: '/check-mobile-number',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    mobile: mobileNumber
                },
                success: function(response) {
                    if (response.exists) {
                        window.location.href = '/retailer-shop';
                    } else {
                        $('#mobile-error').hide();
                        $('#login-container').html(`
                            <form id="retailer-form" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Retailer's Name</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Retailer's Name" required>
                                    <span id="name-error" style="color: red; display: none;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" id="new_mobile" class="form-control" name="mobile" value="${mobileNumber}" required>
                                    <span id="mobile-error" style="color: red; display: none;"></span>
                                </div>
                                <div class="radio-buttons mb-3">
                                    <label>
                                        <input type="radio" name="id_type" value="pan" class="fw-bold" id="pan_radio" checked> PAN Number
                                    </label>
                                    <label>
                                        <input type="radio" name="id_type" value="gstin" class="fw-bold" id="gstin_radio"> GSTIN Number
                                    </label>
                                </div>
                                <div class="form-group" id="pan_div">
                                    <input type="text" id="pan_no" class="form-control" name="pan_no" placeholder="PAN Number" required>
                                    <span id="pan-error" style="color: red; display: none;"></span>
                                </div>
                                <div class="form-group" id="gstin_div" style="display: none;">
                                    <input type="text" id="gstin" class="form-control" name="gstin" placeholder="GSTIN Number" required>
                                    <span id="gstin-error" style="color: red; display: none;"></span>
                                </div>
                                <div class="password-wrapper">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password" value="123456" required>
                                    <span id="password-error" style="color: red; display: none;"></span>
                                    <button type="button" class="password-toggle" id="toggle-password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-primary mt-3 creteretail">Create Retailer</button>
                            </form>
                        `);
                        handleRadioChange();
                        initializeRadioDisplay();
                    }
                },
                error: function(err) {
                    console.error('Error:', err);
                }
            });
        });

        function handleRadioChange() {
            $('input[name="id_type"]').change(function() {
                if ($('#pan_radio').is(':checked')) {
                    $('#pan_div').show();
                    $('#gstin_div').hide();
                } else if ($('#gstin_radio').is(':checked')) {
                    $('#gstin_div').show();
                    $('#pan_div').hide();
                }
            });
        }

        function initializeRadioDisplay() {
            if ($('#pan_radio').is(':checked')) {
                $('#pan_div').show();
                $('#gstin_div').hide();
            } else {
                $('#gstin_div').show();
                $('#pan_div').hide();
            }
        }

        handleRadioChange();
        initializeRadioDisplay();

        $(document).on('click', '.creteretail', function(e) {
            e.preventDefault();

            var name = $('#name').val().trim();
            var mobile = $('#new_mobile').val().trim();
            var password = $('#password').val().trim();
            var idType = $('input[name="id_type"]:checked').val();
            var idNumber = (idType == 'pan') ? $('#pan_no').val().trim() : $('#gstin').val().trim();

            var formIsValid = true;

            $('.form-control').removeClass('is-invalid');
            $('.error-message').hide();

            if (name == '') {
                $('#name-error').show().text('Retailer\'s name is required!');
                $('#name').addClass('is-invalid');
                formIsValid = false;
            }

            if (!/^\d{10}$/.test(mobile)) {
                $('#mobile-error').show().text('Please enter a valid 10-digit mobile number!');
                $('#new_mobile').addClass('is-invalid');
                formIsValid = false;
            }

            if (password.length < 6) {
                $('#password-error').show().text('Password must be at least 6 characters long!');
                $('#password').addClass('is-invalid');
                formIsValid = false;
            }

            if (idType == 'pan' && idNumber == '') {
                $('#pan-error').show().text('Please enter PAN number!');
                $('#pan_no').addClass('is-invalid');
                formIsValid = false;
            } else if (idType == 'gstin' && idNumber == '') {
                $('#gstin-error').show().text('Please enter GSTIN number!');
                $('#gstin').addClass('is-invalid');
                formIsValid = false;
            }

            if (!formIsValid) {
                return false;
            }

            var formData = $('#retailer-form').serialize();
            $.ajax({
                url: '/create-retailer',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        if (response.redirect) {
                            window.location.href = '/retailer-shop';
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error response:', xhr.responseText);
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

</body>
</html>




