<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakarni App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/retailer/css/style.css') }}?=<?php echo time();?>">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* body{
            background-color: #FF7518 !important;
        } */

        .search-container {
        position: relative;
        z-index: 1050; /* Ensure search box is above other elements */
        }

    .search-box {
        position: relative;
    }

    #search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-top: none;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1100; 
    }

    .list-group-item {
        cursor: pointer;
    }
    .list-group {
        border:none;
    }


    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    </style>
</head>

<body style="">


@include('frontend.retailer.common.header')

@yield('content') 

@include('frontend.retailer.common.footer')
<!-- @include('frontend.retailer.common.homefooter') -->

<script src="{{ asset('frontend/retailer/js/main.js') }}?=<?php echo time();?>"></script>

</body>
</html>
