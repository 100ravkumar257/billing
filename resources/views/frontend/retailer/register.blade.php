<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Retailer Registration</h1>
    
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('retailer.register.submit') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" required>
        </div>

        <div>
            <label for="mobile_number">Mobile Number</label>
            <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" required>
        </div>

        <div>
            <label for="gst_no">GST Number</label>
            <input type="text" id="gst_no" name="gst_no" placeholder="Enter GST Number" required>
        </div>

        <div>
            <label for="pan_no">PAN Number</label>
            <input type="text" id="pan_no" name="pan_no" placeholder="Enter PAN Number" required>
        </div> 

        <button type="submit">Register</button>
    </form>
</body>
</html>
