<?php
if (isset($_POST['signup'])) {
	$screenName = $_POST['screenName'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if (empty($screenName) || empty($password) || empty($email)) {
		$error = 'All fields are required';
	} else {
		$email = $getFromU->checkInput($email);
		$screenName = $getFromU->checkInput($screenName);
		$password = $getFromU->checkInput($password);
		if (!filter_var($email)) {
			$error = 'Invalid email format';
		} elseif (strlen($screenName) > 20) {
			$error = 'Length of Name must be between in 6-20 characters';
		} elseif (strlen($password) < 5) {
			$error = 'Password is too short';
		} else {
			if ($getFromU->checkEmail($email)) {
				$error = 'This email is already used';
			}else{
				// $getFromU->register($email, $screenName, $password);
				$user_id = $getFromU->create('users', array('email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'screenName' => $screenName, 'profileImage' => 'assets/images/defaultProfileImage.png', 'profileCover' => 'assets/images/defaultCoverImage.png'));
				$_SESSION['user_id'] = $user_id;
				$username = mb_strstr($email, '@', true).$user_id;
				$user = $getFromU->userData($user_id);
				$getFromU->update('users', $user_id, array('username' => $username));
				// header("Location: includes/signup.php?step=1");
				header('Location: '.BASE_URL.'home.php');
				
			}
		}
	}
}
?>
<form method="post">
	<div class="signup-div">
		<h3>Sign up </h3>
		<ul>
			<li>
				<input type="text" name="screenName" placeholder="Full Name" />
			</li>
			<li>
				<input type="email" name="email" placeholder="Email" />
			</li>
			<li>
				<input type="password" name="password" placeholder="Password" />
			</li>
			<li>
				<input type="submit" name="signup" Value="Signup for Twitter">
			</li>
			<?php
			if (isset($error)) {
				echo '<li class="error-li">
						<div class="span-fp-error">' . $error . '</div>
					</li>';
			}
			?>
		</ul>
	</div>
</form>