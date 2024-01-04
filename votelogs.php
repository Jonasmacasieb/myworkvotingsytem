<?php
include('db_connect.php');


?>

<?php
$voting = $conn->query("SELECT * FROM voting_list where is_default = 1 ");
foreach ($voting->fetch_array() as $key => $value) {
    $$key = $value;
}
$mvotes = $conn->query("SELECT * FROM votes where voting_id = $id and user_id = " . $_SESSION['login_id'] . " ");
$vote_arr = array();
while ($row = $mvotes->fetch_assoc()) {
    $vote_arr[$row['category_id']][] = $row;
}
$opts = $conn->query("SELECT * FROM voting_opt where voting_id=" . $id);
$opt_arr = array();
while ($row = $opts->fetch_assoc()) {
    $opt_arr[$row['id']] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Voting Logs</title>
    <style>
        /* Add any additional styles here */
        @media print {
            body * {
                visibility: hidden;

            }


            #printableTable,
            #printableTable * {
                visibility: visible;
            }

            #printableTable {
                position: absolute;
                left: 0;
                top: 0;
            }

            /* Logo and name styles for print view */


        }

        .printtb {

            background-color: blue;
        }




        /* CSS */
        .button-15 {
            background-image: linear-gradient(#42A1EC, #0070C9);
            border: 1px solid #0077CC;
            border-radius: 4px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            direction: ltr;
            display: block;
            font-family: "SF Pro Text", "SF Pro Icons", "AOS Icons", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 17px;
            font-weight: 400;
            letter-spacing: -.022em;
            line-height: 1.47059;
            min-width: 30px;
            overflow: visible;
            padding: 4px 15px;
            text-align: center;

            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
        }

        .button-15:disabled {
            cursor: default;
            opacity: .3;
        }

        .button-15:hover {
            background-image: linear-gradient(#51A9EE, #147BCD);
            border-color: #1482D0;
            text-decoration: none;
        }

        .button-15:active {
            background-image: linear-gradient(#3D94D9, #0067B9);
            border-color: #006DBC;
            outline: none;
        }

        .button-15:focus {
            box-shadow: rgba(131, 192, 253, 0.5) 0 0 0 3px;
            outline: none;
        }

        th {
            text-align: center;



            background-color: #ffcc80;
            color: #000;
            /* font-weight: bold; */
            border: 1px solid #ffcc80;
            font-size: 15px;
        }
    </style>
</head>

<body>


    <br>

    <!-- Add a print button -->
    <!-- <a href="design.php">view</a> -->
    <button class="float-right text-white mt-3 button-15" id="print"> <i class="fa fa-print  " style="color: black;"></i> Print</button>
    <br><br><br>

    <?php
    $cats = $conn->query("SELECT * FROM category_list WHERE id IN (SELECT category_id FROM voting_opt WHERE voting_id = '" . $id . "')");

    ?>

    <?php
    $mycats = $conn->query("SELECT username FROM users WHERE id IN (SELECT user_id FROM votes WHERE voting_id = '" . $id . "')");

    ?>
    <?php
    $myvotes = $conn->query("SELECT opt_txt FROM voting_opt WHERE id IN (SELECT voting_opt_id FROM votes WHERE voting_id = '" . $id . "')");

    ?>
    <table id="printableTable" border="1" class="table table-bordered table-hover">
        <h3>Voter's Logs</h3>
        <thead>
            <tr class="tr1">
                <th>School ID</th>
                <?php while ($row = $cats->fetch_assoc()) : ?>
                    <th><?php echo $row['category']; ?></th>
                <?php endwhile; ?>
            </tr>
        </thead>
        <tbody>

            <?php while ($rowUser = $mycats->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $rowUser['username']; ?></td>
                    <?php $rowVote = $myvotes->fetch_assoc(); ?>
                    <td><?php echo $rowVote['opt_txt']; ?></td>
                </tr>
            <?php endwhile; ?>




        </tbody>
    </table>

    <script>
        $('#print').click(function() {
            // start_load();
            var printableContent = $('#printableTable').html();
            // Make an AJAX request to fetch the content of design.php
            $.ajax({
                url: 'design.php',
                method: 'GET',
                success: function(data) {
                    // Create a new window and write the content to it
                    var nw = window.open("", "_blank", "width=800,height=600");
                    nw.document.write('<html><head><title>Voting Management System</title></head><body>');
                    nw.document.write(data); // Use the fetched content
                    nw.document.write(printableContent);
                    nw.document.write('</body></html>');
                    nw.document.close();

                    // Print the new window
                    nw.print();

                    // Close the new window after a delay
                    // setTimeout(function() {
                    //     nw.close();
                    //     end_load();
                    // }, 1000);
                },
                error: function() {
                    alert('Error fetching content from design.php');
                    end_load();
                }
            });
        });
    </script>


</body>

</html>