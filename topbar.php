<style>

    .logo img {
        width: 80px;
        height: 70px;
       
        object-fit: cover;
        border-radius: 50%; /* Ensure the image inside is also a circle */
    }
    .perps{
        font-family: Arial, sans-serif;
        color:#fff;
        font-size:20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .adlogout{
        font-family: Arial, sans-serif;
        color:#fff;
        font-size:20px;
        text-decoration: none; 
        transition: background-color 0.3s, color 0.3s;
    
    }
    .adlogout:hover {
       
        color: #000;
    }
</style>

<nav class="navbar navbar-dark fixed-top" style="padding: 0; background: linear-gradient(to left, #3498db, #87ceeb); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display: flex;">
            <div class="logo mr-4">
                    <img src="perps logo.png" alt="Logo Image">
                </div>
            </div>
           
            <label class="perps mt-3" >PERPETUAL HELP COLLEGE OF PANGASINAN</label>
          
         
<div class="logo mr-4 float-right">
                    <!-- Display user picture -->
                    <img src="<?php echo isset($_SESSION['login_picture_path']) ? $_SESSION['login_picture_path'] : 'default_image.jpg'; ?>" alt="User Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">

                    <div class=" float-right text-white mt-3">
                
                <a href="ajax.php?action=logout" class="adlogout"><?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : ''; ?> <i class="fa fa-power-off"></i></a>
            </div>
                </div>
        </div>
    </div>
</nav>
