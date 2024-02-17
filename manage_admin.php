<?php
include('db_connect.php');

$meta = array(); // Initialize $meta array

if (isset($_GET['id'])) {
    // Prevent SQL injection using prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user data and store it in $meta array
    if ($row = $result->fetch_assoc()) {
        $meta = $row;
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
            <input type="password" name="password" id="password" class="form-control" <?php if (!empty($_GET['id'])) echo 'placeholder="Leave blank to keep current password"'; ?> required>
        </div>

        <div class="form-group">
            <label for="type">User Type</label>
            <select name="type" id="type" class="custom-select">
                <option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

    </form>
</div>

<script>
    $(document).ready(function() {
        $('#manage-user').submit(function(e) {
            e.preventDefault();
            start_load()
            var formData = new FormData(this);

            $.ajax({
                url: 'ajax.php?action=save_admin',
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