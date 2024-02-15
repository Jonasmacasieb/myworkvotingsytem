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

            <!-- Add a new input for picture upload -->
            <div class="form-group">
                <label for="picture">Profile Picture</label>
                <input type="file" name="picture" id="picture" class="form-control-file">
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <div class="face">
                    <input type="button" value="Face Registration" id="faceRegistrationButton">

                </div>  

            </div>


            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="username">School ID</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required>
            </div>

            <div class="form-group" id="section">
                <label for="department">Section and Year</label>
                <select name="section" id="section" class="form-control" required>
                    <option value="4-1" <?php echo (isset($meta['department']) && $meta['department'] === 'CCS') ? 'selected' : ''; ?>> 4-1</option>
                    <option value="4-2" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>4-2</option>
                    <option value="Acountancy" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>4-3</option>
                    <option value="Human Resources" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Marketing" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Tourism" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Alied Health" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Midwifery" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>2-1 </option>

                </select>
            </div>
            <div class="form-group" id="course">
                <label for="department">Course </label>
                <select name="course" id="course" class="form-control" required>
                    <option value="CCS" <?php echo (isset($meta['department']) && $meta['department'] === 'CCS') ? 'selected' : ''; ?>> CSS</option>
                    <option value="CRIMINOLOGY" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>CRIM</option>
                    <option value="Acountancy" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Accountacy</option>
                    <option value="Human Resources" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Marketing" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Tourism" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Alied Health" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>3-1</option>
                    <option value="Midwifery" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>2-1 </option>

                </select>
            </div>
            <div class="form-group" id="department-group">
                <label for="department">Department</label>
                <select name="department" id="department" class="form-control" required>
                    <option value="BS Information Technology" <?php echo (isset($meta['department']) && $meta['department'] === 'CCS') ? 'selected' : ''; ?>> BS Information Technology </option>
                    <option value="CRIMINOLOGY" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>BS Criminilogy</option>
                    <option value="Acountancy" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>BS Accountancy</option>
                    <option value="Human Resources" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Human Resources</option>
                    <option value="Marketing" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Marketing</option>
                    <option value="Tourism" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Tourism</option>
                    <option value="Alied Health" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Alied Health Department</option>
                    <option value="Midwifery" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>College of Midwifery </option>

                </select>
            </div>

            <div class="form-group">
                <label for="type">user</label>
                <select name="type" id="type" class="custom-select">
                    <option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected' : '' ?>>Students</option>


                </select>
        </form>
    </div>



    <script>
        $(document).ready(function() {
            // Hide the password field initially
            $('#password-group').hide();

            // Show/hide password and department fields based on the selected user type
            function toggleFields() {
                if ($('#type').val() == 1) { // Admin
                    $('#password-group').show();
                    $('#department-group').hide();
                } else if ($('#type').val() == 2) { // User
                    $('#password-group').hide();
                    $('#department-group').show();
                } else {
                    $('#password-group, #department-group').hide();
                }
            }

            // Call the function on page load
            toggleFields();

            // Show/hide fields when the user type changes
            $('#type').change(function() {
                toggleFields();
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

            $('#faceRegistrationButton').click(function() {
                var userName = $('input[name="username"]').val(); // Correctly select the school ID input field
                $('#black-space').addClass('gray-background');

                $.ajax({
                    url: 'ajax.php',
                    method: 'POST',
                    data: {
                        action: 'face_registration',
                        userName: userName // Send the school ID to the Python script
                    },
                    success: function(resp) {
                        console.log(resp);
                        $('#black-space').removeClass('gray-background');
                    }
                });

                // Add any additional logic you need after initiating face registration
            });

            // Hide the Face Registration button initially
            $('.face').hide();

            // Show/hide the Face Registration button based on School ID input
            $('#username').on('input', function() {
                var schoolID = $(this).val().trim(); // Trim any leading or trailing spaces
                if (schoolID.length > 0) {
                    $('.face').show();
                } else {
                    $('.face').hide();
                }
            });
        });
    </script>