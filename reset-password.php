<?php
	require_once 'session.php';
	require_once 'locale.php';
	require_once 'header.php';
	require_once 'controller/User.Controller.php';

	$userid		= $_GET['user_id'];
	$user_set	= $uc->getUser($userid);

	if(isset($_POST['save'])) {
		$password = $_POST['password'];
		$uc->updatePassword($userid, $password);
		header("Location: reset-password.php?user_id=$userid&f=1");
	}
?>
<style>
#dbguide { display: none; }
.generate {
	cursor: default;
	background: lightgray;
	padding: 3px 7px;
	border-radius: 5px;
	margin-left: 2px;
}
.generate:hover { background: rgb(188, 188, 188); }
table td { width: 40% !important; }
</style>
<div id="container">
<a class="link" href="phpgrid/manage-students.php">&laquo; <?php echo _("Go Back"); ?></a>
<br><br>
<form method="post" action="" id="change-pw">
	<center>
		<table>
			<?php if(isset($_GET['f']) && $_GET['f'] == 1) : ?>
				<tr>
					<td colspan="3">
						<center><span class='green'><?php echo _("You have updated the account."); ?></span></center>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<td colspan="3">
					<strong><center><?php echo _("Reset Password"); ?></center></strong>
				</td>
			</tr>
			<tr>
				<td>
					<label><?php echo _("New Password"); ?>:</label>
				</td>
				<td>
					<input type="text" name="password" id="password" class="editable" placeholder="Enter new password" minlength="6" required>
				</td>
				<td><a onclick="generatPass();" name="generate" class="generate" >Generate</a></td>
			</tr>
			<tr>
				<td colspan="3">
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

function generatPass(){
	$( "#password" ).val(Math.random().toString(36).slice(-8));
}
</script>
<?php require_once "footer.php"; ?>