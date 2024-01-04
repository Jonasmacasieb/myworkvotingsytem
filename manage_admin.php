<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">

    <form action="" id="manage-user" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">

        <!-- Add a new input for picture upload -->
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

        <div class="form-group" id="password-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password'] : '' ?>" required>
        </div>

        <div class="form-group" id="department-group">
            <label for="department">Department</label>
            <select name="department" id="department" class="form-control" required>
                <option value="CCS" <?php echo (isset($meta['department']) && $meta['department'] === 'CCS') ? 'selected' : ''; ?>>CCS Deparment</option>
                <option value="CRIMINOLOGY" <?php echo (isset($meta['department']) && $meta['department'] === 'CRIMINOLOGY') ? 'selected' : ''; ?>>Criminilogy Department</option>

            </select>
        </div>

        <div class="form-group">
            <label for="type">User Type</label>
            <select name="type" id="type" class="custom-select">

                <option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected' : '' ?>>Admin</option>

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
    });
</script>
<!-- 
$(document).ready(function () {
        // Hide the password and department fields initially
        $('#password-group, #department-group').hide();
      
        // Show/hide password and department fields based on the selected user type
        $('#type').change(function () {
            if ($(this).val() == 1) { // Admin
                $('#password-group').show();
                $('#department-group').hide(); // Assuming you want to hide the department field for Admin
            } else if ($(this).val() == 2) { // User
                $('#password-group').hide();
                $('#department-group').show();
            } else {
                $('#password-group, #department-group').hide();
            }
        });

        // Form submission code remains unchanged
        $('#manage-user').submit(function (e) {
            e.preventDefault();
            start_load()
            var formData = new FormData(this);

            $.ajax({
                url: 'ajax.php?action=save_user',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully saved", 'success')
                        setTimeout(function () {
                            location.reload()
                        }, 1500)
                    }
                }
            })
        });
    }); -->