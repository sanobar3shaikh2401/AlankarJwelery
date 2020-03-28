

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	    $server = "localhost";
		$user = "root";
		$pass = "";
		$database = "registration";
		$conn = mysqli_connect($server, $user, $pass, $database);
		
		if(mysqli_connect_error())
		{
			echo "<p>Error occurred..while database connecting</p>";
			echo "<p>Exiting...</p>";
			exit();
		}
		



	$username = $password = $number = "";

	$usernameErr =$passwordErr = $numberErr = "";

	if(empty($_POST["username"]))
	{
		$usernameErr = "unique username is required";
	}
	else
	{
		$username = $_POST["username"];
			
		$username=test_input($username);
		
		if(!preg_match("/^[a-zA-Z ]*$/",$username))
		{
			$usernameErr="Only letters and white space are allowed";
		}
		
	}
	
	if(empty($_POST["password"]))
	{
		$passwordErr = "Password is required";
	}
	
	else
	{
		$password=$_POST["password"];
		
		$password=test_input($password);
		
	}
		
		
	if(empty($_POST["number"]))		
	{
		$numberErr="enter number";
	}
	else
	{
		$number=$_POST["number"];
		
		$number=test_input($number);
		
	}

	
}		


function test_input($data)
{
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}
?>


<html>
	<head>

<body background="C:\Users\Aslam-pc\Desktop\alankar-master\project images\wed.jpg">

	<link href="Registration.css" rel="stylesheet" type="text/css">
	
		<title>Registration Page</title>
		
		<script>

function checkBeforeSubmit()
{
	if(document.registerForm.username.value=="")
	{
		alert("create your user name.");
		
		document.registerForm.username.focus();
		return false;
	}
	
	if(document.registerForm.password.value=="")
	{
		alert("create password");
		
		document.registerForm.password.focus();
		return false;
	}

	if(document.registerForm.number.value=="")
	{
		alert("Enter number");
		
		document.registerForm.number.focus();
		return false;
	}
	
	return true;
}
</script>


		
	</head>
	
	<font color="#b30000">
<marquee behaviour="alternate" direction="left" scrollamount="12" width="1350px"><h2><i><b>Alankar jewellers<b></i></h2></marquee>
</font>

	<header>
<font size="5px">
<ul>
<li><b><i><a href="login.php">LOGIN</a></i></b></li>
<li><b><i><a href="Registration.php">REGISTRATION</a></i></b></li>


</ul>
</font>
</header>

		<br><br>

	
	<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!empty($usernameErr) || !empty($passwordErr) || !empty($numberErr)  )
	{
		if(!empty($usernameErr))
		{
			echo "<b>Username Error Message: </b>";
			echo $usernameErr;
			echo "<br/>";
		}
		
		
		
		if(!empty($passwordErr))
		{
			echo "<b>Passowrd Error Message: </b>";
			echo $passwordErr;
			echo "<br/>";
		}
		
		if(!empty($numberErr))
		{
			echo "<b>number Error Message: </b>";
			echo $numberErr;
			echo "<br/>";
		}
		
		
		echo "<p>Kindly try again</p>";
	}
	
	
	else 
	{
		$qry = "select * from rgst where username='$username'";
		$rsl = $conn->query($qry);
		
		if(mysqli_num_rows($rsl)>0)
		{
			echo "<p>Username already existed in the database.</p>";
			echo "<p>Kindly try with different one.</p>";
			exit();
		}
		
		else 
		{
			$qry = "insert into rgst(username,password,number)
					values('$username', '$password', '$number');";
			$res = $conn->query($qry);
			
			header('location:index.php');

			
			/*if($res)
			{
				echo "<p>You are successfully registered to </p>";
				echo "<p>Your Username: <b>".$username."</b></p>";
				echo "<p>Your Password: <b>".$password."</b></p>";
				exit();
			}*/
		}
	}
}
?>

	
		<center><h1>Registration</h1><center>
		<form class="mr" name="registerForm" method="post" onsubmit="return checkBeforeSubmit()">
		<div class="container">
			Username &nbsp <input type="Text"  name="username"><br><br>
			Password &nbsp <input type="password"  name="password"><br><br>
			Mobile &nbsp <input type="Text"  name="number"><br><br>
			<button class="btn">Register</button>
			<button class="btn1">Cancel</button>
			</div>
		</form>
		<footer>
<h2>Contact us</h2>
</footer>
	</body>
</html>
