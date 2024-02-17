    <?php
    include('db_connect.php');

    if (isset($_GET['id'])) {
        $user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
        foreach ($user->fetch_array() as $k => $v) {
            $meta[$k] = $v;
        }
    }
    ?>
    <style>
        .face {
            position: absolute;
            top: 90px;
        }

        #black-space.gray-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.5;
            z-index: 9999;
            /* Adjust z-index as needed */
            display: none;
            /* Initially hide the black space */
        }
    </style>
    <div class="container-fluid">

        <form action="" id="manage-user" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">

            <div class="form-group">
                <label for="picture">Profile Picture</label>
                <input type="file" name="picture" id="picture" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="username">School ID</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required>
            </div>

            <div class="form-group" id="department-group">
                <label for="department">Department</label>
                <select name="department" id="department" class="form-control" required>
                    <option value="">Select Department</option>
                    <option value="BS Information Technology">BS Information Technology</option>
                    <option value="CRIMINOLOGY">BS Criminology</option>
                    <option value="Accountancy">BS Accountancy</option>
                    <!-- Add other department options here -->
                </select>
            </div>

            <div class="form-group" id="course-group">
                <label for="course">Course</label>
                <select name="course" id="course" class="form-control" required>
                    <option value="">Select Course</option>
                    <!-- Course options will be dynamically populated based on the selected department -->
                </select>
            </div>

            <div class="form-group" id="section-group">
                <label for="section">Section and Year</label>
                <select name="section" id="section" class="form-control" required>
                    <option value="">Select Section</option>
                    <!-- Section options will be dynamically populated based on the selected department -->
                </select>
            </div>

            <div class="form-group">
                <label for="type">User Type</label>
                <select name="type" id="type" class="custom-select">
                    <option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected' : '' ?>>Students</option>
                    <!-- Add other user type options here -->
                </select>
            </div>
        </form>


        <script>
            $(document).ready(function() {
                // Function to populate course options based on selected department
                $('#department').change(function() {
                    var department = $(this).val();
                    $('#course').empty();
                    // Populate course options based on the selected department
                    switch (department) {
                        case 'BS Information Technology':
                            $('#course').append('<option value="IT">Information Technology</option>');
                            $('#course').append('<option value="CS">Computer Science</option>');
                            break;
                        case 'CRIMINOLOGY':
                            $('#course').append('<option value="Criminology">Criminology</option>');
                            break;
                        case 'Accountancy':
                            $('#course').append('<option value="Accounting">Accounting</option>');
                            break;
                            // Add cases for other departments as needed
                        default:
                            $('#course').append('<option value="">Select Course</option>');
                    }
                });

                // Function to populate section options based on selected department
                $('#department').change(function() {
                    var department = $(this).val();
                    $('#section').empty();
                    // Populate section options based on the selected department
                    switch (department) {
                        case 'BS Information Technology':
                            $('#section').append('<option value="4-1">4-1</option>');
                            $('#section').append('<option value="4-2">4-2</option>');
                            break;
                        case 'CRIMINOLOGY':
                            $('#section').append('<option value="4-1">4-1</option>');
                            $('#section').append('<option value="4-2">4-2</option>');
                            break;
                        case 'Accountancy':
                            $('#section').append('<option value="4-1">4-1</option>');
                            $('#section').append('<option value="4-2">4-2</option>');
                            break;
                            // Add cases for other departments as needed
                        default:
                            $('#section').append('<option value="">Select Section</option>');
                    }
                });
            });

            // Form submission code remains unchanged
            $('#manage-user').submit(function(e) {
                e.preventDefault();
                start_load()
                var formData = new FormData(this);

                $.ajax({
                    url: 'ajax.php?action=save_user',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        if (resp == 1) {
                            alert_toast("Data successfully saved", 'success')
                            setTimeout(function() {
                                location.reload()
                            }, 1500)
                        }
                    }
                });
            });
        </script>

    </div>