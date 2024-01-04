<?php include('db_connect.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            border: 2px solid #ccc;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
        }

        h1 {
            color: #333;
        }
    </style>
</head>

<body>
    <center>

        <div class="message-box">
            <h1>Already Voted</h1>
            <p>You have already cast your vote. Thank you!</p>
            <!-- <button id="okButton"><b>Ok</b></button> -->
            <a href="ajax.php?action=logout" class="adlogout"><?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : ''; ?> Ok</a>

            <div>
                <br>
                <a href="view_vote.php">view vote</a>
            </div>
        </div>



    </center>
</body>

</html>