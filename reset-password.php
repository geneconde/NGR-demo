<?php
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';
	require_once 'controller/Security.Controller.php';
	require_once 'php/auto-generate-trial.php';

	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);

	if(isset($_POST['save'])) {
		$password = $_POST['password'];
		if(empty($password)){ $password = $_POST['generated']; }

		$uc->updatePassword($userid, $password);
		header("Location: reset-password.php?user_id=$userid&f=1");
	}
?>
<style>
#dbguide { display: none; }
td:first-child {
    width: 500px !important;
}
</style>
<div id="container">
<a class="link" href="phpgrid/manage-students.php">&laquo; <?php echo _("Go Back"); ?></a>
<br><br>
<form method="post" action="" id="edit-account">
	<center>
		<table>
			<?php if(isset($_GET['f']) && $_GET['f'] == 1) : ?>
				<tr>
					<td colspan="2">
						<center><span class='green'><?php echo _("You have updated the account."); ?></span></center>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<td colspan="2">
					<strong><center><?php echo _("Reset Password"); ?></center></strong>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("Generated Password"); ?>:
				</td>
				<td>
					<!-- <label><?php echo generatePassword(); ?></label> -->
					<input type="text" name="generated" value="<?php echo generatePassword(); ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php echo _("New Password"); ?>:
				</td>
				<td>
					<input type="text" name="password" id="password" class="editable" placeholder="Enter new password">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<center>
					<div>
						<input id="save" class="button1" type="submit" name="save" value="<?php echo _("Save Changes"); ?>">
					</div>
					</center>
				</td>
			</tr>
		</table>
	</center>
</form>
</div>
<script>
var olduname = "<?php echo $user_set->getUsername(); ?>";
$(document).ready(function() {
	// $('#edit').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',false);
	// 	$(this).hide();
	// 	$('.hidden-btn').show();
	// });
	
	// $('#cancel').click(function(e) {
	// 	e.preventDefault();
	// 	$('.editable').prop('disabled',true);
	// 	$('.hidden-btn').hide();
	// 	$('#edit').show();
	// });
	
	$('#uname').focusout(function() {
		var uid = $(this).val();
		if(uid != olduname) {
			$.ajax({
				type	: "POST",
				url		: "validate-user.php",
				data	: {	userid: uid },
				success : function(data) {
					if(data == 1) { 
						$('#check').attr('src','images/accept.png');
						$('#save').prop('disabled',false);
					} else { 
						$('#check').attr('src','images/error.png'); 
						$('#save').prop('disabled',true);
					}
				}
			});
		} else {
			$('#check').attr('src','images/accept.png');
			$('#save').prop('disabled',false);
		}
	});
});

$.validate({
  form : '#edit-account'
});
</script>
<?php require_once "footer.php"; ?>