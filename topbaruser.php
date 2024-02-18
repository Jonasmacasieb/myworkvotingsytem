<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">

    <style>
        .logo img {
            width: 80px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
        }

        .perps {
            font-family: Arial, sans-serif;
            color: #fff;
            font-size: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 10px;
        }

        .adlogout {
            font-family: Arial, sans-serif;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 10px;
        }

        .adlogout:hover {
            color: #000;
        }

        .float-right img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;

        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .logo img {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            .perps {
                font-size: 16px;
                margin-top: 15px;
            }

            .adlogout {
                font-size: 16px;
                margin-top: 15px;
            }

            .float-right img {
                width: 40px;
                height: 40px;
                margin-top: 15px;
                margin-right: 10px;
            }

            .navbar {
                padding: 10px;
            }

            .float-left,
            .float-right {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }

            .float-right {
                margin-top: 15px;
            }
        }
    </style>
</head>
<nav class="navbar navbar-dark fixed-top" style="padding: 0; margin:0; background: linear-gradient(to left, #3498db, #87ceeb); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="float-left">
                <div class="logo">
                    <img src="perps logo.png" alt="Logo Image">
                </div>

            </div>
            <label class="perps mt-3 ">PERPETUAL HELP COLLEGE OF PANGASINAN</label>
            <div class="float-right">
                <div class="float-right">
                    <img src="<?php echo isset($_SESSION['login_picture_path']) ? $_SESSION['login_picture_path'] : 'default_image.jpg'; ?>" alt="User Image">
                    <a href="ajax.php?action=logout" class="adlogout"><?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : ''; ?> <i class="fa fa-power-off"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>