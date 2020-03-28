

<?php

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

	// you have already learned about session
	session_start();
	
	    $server = "localhost";
		$user = "root";
		$pass = "";
		$database = "registration";
		
		$conn = mysqli_connect($server, $user, $pass, $database);

	
	if(mysqli_connect_error())
	{
		echo "<p>Error in connection to database.</p>";
		exit();
	}
	
		// checks whether logout button is clicked or not
		if(isset($_POST["logout"]))
		{
			// below code is used to destroy all the session
			session_destroy();
			// below code is used to redirect users to CompleteLoginPage.php page
			header("location: Index.php");
			// below code is used to skip executing the remaining code
			// after this
			exit();
		}
		$username = $password = "";
		
		$username = $_POST["username"];
		$username = filter_login_input($username);
		
		$password = $_POST["password"];
		$password = filter_login_input($password);
		
		$qry = "select * from rgst where username='$username' and password='$password'";
		$res = $conn->query($qry);
		
		if(mysqli_num_rows($res)>0)
		{
			$_SESSION['login'] = $username;
		}
		else 
		{
			$loginCheck = "No";
		}
	}
	function filter_login_input($loginData)
	{
		$loginData = trim($loginData);
		$loginData = stripslashes($loginData);
		$loginData = htmlspecialchars($loginData);
		return $loginData;
	}
?>


<html>
	<head>
<body background="C:\Users\Aslam-pc\Desktop\alankar-master\project images\wed.jpg">
	<link href="log1.css" rel="stylesheet" type="text/css">
	<link href="home1.css" rel="stylesheet" type="text/css">
	
	<script>
	function checkBeforeLogin()
	{
		if(document.loginForm.username.value=="")
		{
			alert("Enter Username");
			document.loginForm.username.focus();
			return false;
		}
		if(document.loginForm.password.value=="")
		{
			alert("Enter Your Password");
			document.loginForm.password.focus();
			return false;
		} 
		return true;
	}
	</script>

	
		<title>LoginPage</title>
	</head>
	<body background="img1\th(1).jpg">
	<font color="#fff">
<marquee behaviour="alternate" direction="left" scrollamount="12" width="1350px"><h2><i>Alankar jewellers</i></h2></marquee>
</font>

	<header>
<font size="5px">
<ul>
<li><b><i><a href="login.php">LOGIN</a></i></b></li>
<li><b><i><a href="Registration.php">REGISTRATION</a></i></b></li>
<li><b><i><a href="#">HOME</a></i></b></li>

</ul>
</font>
</header>

		<br><br>

	
	<?php
	if(isset($_SESSION['login']))
	{
		header('location: index.php');
		/*echo "<p>You are successfully logged in.</p>";
		echo "<p>Now you can access the admin page.</p>";
		echo "<form method=\"post\">";
		echo "<input type=\"submit\" name=\"logout\" value=\"LogOut\">";
		echo "</form>";*/
		exit();
	}
?>

	
		<center><h1>Login</h1></center>
		<form class="mr" name="loginForm" method="post" onSubmit="return checkBeforeLogin()">
		<div class="container">
		
		UserName &nbsp <input type="text"  name="username"><br><br>
		Password &nbsp <input type="password"  name="password"><br><br>
		
		
		<?php
		if(isset($loginCheck))
		{
			echo "Invalid data<br/>";
		}
	?>
		<button class="btn">Login</button>
		
		<h5><a href="#">Forgotten Your details?</a></h5>
		</div>
		</form>
		<footer>
<h2>Contact us</h2>
</footer>
	</body>
</html>