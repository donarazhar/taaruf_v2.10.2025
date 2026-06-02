<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Title -->
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />
    <title>Ta'aruf Jodohku v.2.0 | YPI Al Azhar</title>

    <!-- Meta Tags -->
    <meta name="description" content="Aplikasi Ta'aruf Karyawan YPI Al Azhar - Temukan pasangan hidup yang tepat">
    <meta name="keywords" content="taaruf, jodoh, al azhar, ypi, pernikahan">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('apk/assets/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('apk/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/bootstrap-icons.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('apk/assets/css/owl.carousel.min.css') }}">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('apk/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/magnific-popup.css') }}">

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <style>
        /* ===== MODERN DASHBOARD STYLES ===== */
        :root {
            --black: #000000;
            --gray-900: #1A1A1A;
            --gray-800: #2D2D2D;
            --gray-700: #404040;
            --gray-600: #666666;
            --gray-500: #808080;
            --gray-400: #999999;
            --gray-300: #CCCCCC;
            --gray-200: #E5E5E5;
            --gray-100: #F5F5F5;
            --gray-50: #FAFAFA;
            --white: #FFFFFF;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --shadow-xl: 0 12px 32px rgba(0, 0, 0, 0.2);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --header-height: 70px;
            --footer-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            padding-bottom: var(--footer-height);
        }

        /* ===== PRELOADER ===== */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--white);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease-out;
        }

        .preloader.hide {
            opacity: 0;
            pointer-events: none;
        }

        .spinner-modern {
            width: 50px;
            height: 50px;
            border: 4px solid var(--gray-200);
            border-top-color: var(--black);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ===== INTERNET STATUS ===== */
        .internet-connection-status {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 12px 20px;
            background: #ef4444;
            color: white;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 9998;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .internet-connection-status.show {
            transform: translateY(0);
        }

        .internet-connection-status.online {
            background: #22c55e;
        }

        /* ===== HEADER AREA ===== */
        .header-area {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: var(--white);
            border-bottom: 2px solid var(--gray-200);
            z-index: 999;
            box-shadow: var(--shadow-sm);
        }

        .header-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid var(--gray-200);
            object-fit: cover;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-avatar:hover {
            border-color: var(--black);
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-greeting {
            font-size: 0.8rem;
            color: var(--gray-600);
            font-weight: 500;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--black);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gray-100);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--gray-700);
        }

        .header-btn:hover {
            background: var(--black);
            color: var(--white);
            transform: scale(1.05);
        }

        .header-btn i {
            font-size: 1.1rem;
        }

        /* ===== PAGE CONTENT ===== */
        .page-content-wrapper {
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
            padding-top: calc(var(--header-height) + 20px);
            padding-bottom: 20px;
        }

        /* ===== CONTAINER ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .user-info {
                display: none;
            }

            .header-content {
                padding: 0 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 12px;
            }
        }

        /* ===== UTILITIES ===== */
        .section {
            margin-bottom: 32px;
        }

        .bg-overlay {
            position: relative;
            background: var(--black);
            color: var(--white);
        }

        .text-light {
            color: var(--white) !important;
        }

        .text-center {
            text-align: center;
        }

        /* ===== SMOOTH SCROLL ===== */
        html {
            scroll-behavior: smooth;
        }

        /* ===== FOCUS STYLES ===== */
        *:focus {
            outline: 2px solid var(--black);
            outline-offset: 2px;
        }

        button:focus,
        a:focus {
            outline-offset: 4px;
        }
    </style>
</head>

<body>
