<?php

include('db_connect.php');

$user_id = $_SESSION['login_id'];

// Check if the user has already voted in the current session
if (isset($_SESSION['has_voted']) && $_SESSION['has_voted'] == 1) {
	header('Location: view_vote.php');
	exit(); // Ensure that the script stops execution after the redirection
}



// Update the 'has_voted' status for the user in the database
$conn->query("UPDATE users SET has_voted = 1 WHERE id = $user_id");

// Set a session variable indicating that the user has voted
$_SESSION['has_voted'] = 1;

// Continue with the rest of your code for voting	


?>


<?php


$voting = $conn->query("SELECT * FROM voting_list where  is_default = 1 ");
foreach ($voting->fetch_array() as $key => $value) {
	$$key = $value;
}

$vote = $conn->query("SELECT * FROM voting_list where id=" . $id);
foreach ($vote->fetch_array() as $key => $value) {
	$$key = $value;
}
$opts = $conn->query("SELECT * FROM voting_opt where voting_id=" . $id);
$opt_arr = array();
$set_arr = array();

while ($row = $opts->fetch_assoc()) {
	$opt_arr[$row['category_id']][] = $row;
	$set_arr[$row['category_id']] = array('id' => '', 'max_selection' => 1);
}

$settings = $conn->query("SELECT * FROM voting_cat_settings where voting_id=" . $id);
while ($row = $settings->fetch_assoc()) {
	$set_arr[$row['category_id']] = $row;
}


?>

<style>
	.candidate {
		margin: auto;
		width: 16vw;
		padding: 10px;
		cursor: pointer;
		border-radius: 3px;
		margin-bottom: 1em
	}

	.candidate:hover {
		background-color: #80808030;
		box-shadow: 2.5px 3px #00000063;
	}

	.candidate img {
		height: 14vh;
		width: 8vw;
		margin: auto;
	}

	span.rem_btn {
		position: absolute;
		right: 0;
		top: -1em;
		z-index: 10;
		display: none
	}

	span.rem_btn.active {
		display: block
	}

	.gradient-background {
		background: linear-gradient(to bottom, #ff7e5f, #feb47b);
		color: white;
		padding: 10px;
		border-radius: 20px;
	}

	.serif-font {
		font-family: serif;
		font-size: 40px;
	}

	.serif-description {
		font-family: sans-serif;
		font-size: 15px;
		color: #000;
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="" id="manage-vote">
					<input type="hidden" name="voting_id" value="<?php echo $id ?>">
					<div class="col-lg-12">

						<div class="text-center gradient-background">
							<h3 class="serif-font"><b><?php echo $title ?></b></h3>
							<small class="serif-description"><b><?php echo $description; ?></b></small>
							<br>
							<small class="serif-description"><b><?php echo $time_duration; ?></b></small>
						</div>


						<?php
						$cats = $conn->query("SELECT * FROM category_list where id in (SELECT category_id from voting_opt where voting_id = '" . $id . "' )");
						while ($row = $cats->fetch_assoc()) :
						?>
							<hr>
							<div class="row mb-4">
								<div class="col-md-12">
									<div class="text-center">
										<h3><b><?php echo $row['category'] ?></b></h3>
										<small>Max Selection : <b><?php echo $set_arr[$row['id']]['max_selection']; ?></b></small>

									</div>
								</div>
							</div>
							<div class="row mt-3">
								<?php foreach ($opt_arr[$row['id']] as $candidate) {
								?>
									<div class="candidate" style="position: relative;" data-cid='<?php echo $row['id'] ?>' data-max="<?php echo $set_arr[$row['id']]['max_selection'] ?>" data-name="<?php echo $row['category'] ?>">
										<input type="radio" name="opt_id[<?php echo $row['id'] ?>][]" value="<?php echo $candidate['id'] ?>" style="display: none">
										<span class="rem_btn">
											<label for="" class="btn btn-primary"><span class="fa fa-circle"></span></label>
										</span>
										<div class="item" data-id="<?php echo $candidate['id'] ?>">
											<div style="display: flex">
												<img src="assets/img/<?php echo $candidate['image_path'] ?>" alt="">
											</div>
											<br>
											<div class="text-center">
												<large class="text-center"><b><?php echo ucwords($candidate['opt_txt']) ?></b></large>

											</div>
										</div>
									</div>

								<?php }
								?>
							</div>

						<?php endwhile; ?>
					</div>
					<hr>

					<center><button class="btn btn-primary" style="width: 400px;; ">Sumbit</button></center>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$('.candidate').click(function() {
		var chk = $(this).find('input[type="radio"]').prop("checked");

		if (chk == true) {
			$(this).find('input[type="radio"]').prop("checked", false)
		} else {
			var arr_chk = $("input[name='opt_id[" + $(this).attr('data-cid') + "][]']:checked").length
			if ($(this).attr('data-max') == 1) {
				$("input[name='opt_id[" + $(this).attr('data-cid') + "][]']").prop("checked", false)
				$(this).find('input[type="radio"]').prop("checked", true)
			} else {
				if (arr_chk >= $(this).attr('data-max')) {
					alert_toast("Choose only " + $(this).attr('data-max') + " for " + $(this).attr('data-name') + " category", "warning")
					return false;
				}
			}
			$(this).find('input[type="radio"]').prop("checked", true)
		}
		$('.candidate').each(function() {
			if ($(this).find('input[type="radio"]').prop("checked") == true) {
				$(this).find('.rem_btn').addClass('active')
			} else {
				$(this).find('.rem_btn').removeClass('active')
			}
		})


	})
	$('#manage-vote').submit(function(e) {
		e.preventDefault()
		start_load();
		$.ajax({
			url: 'ajax.php?action=submit_vote',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Vote success fully submitted");
					setTimeout(function() {
						// location.reload()
						window.location.href = 'already_voted.php';
					}, 1500);

				}
			}
		})
	})
</script>