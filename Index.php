<?php

	session_start();
	
	if ((isset($_SESSION['userOnline'])) && ($_SESSION['userOnline'] == true))
	{
		header('Location: Search0.php');
		exit();								// w innym przypadku wykona się cały kod tego pliku zanim nastąpi przekierowanie...
		
	};

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Search</title>

	<!-- sprawdzenie czy User został już zalogowany -->
	
	


</head>

<body>
	
	<a href="newUser.php">Rejestracja - załóż darmowe konto</a>
	
	
	<form action="LoginUsers.php" method="post">
		<h1> Logowanie do wyszukiwarki </h1>
		Login: <br /><input type="text" name="login" /><br />
		Hasło: <br /><input type="password" name="haslo" /><br />
		<input type="submit" value="Zaloguj się" />
	</form>
	
	


<?php
	
	
	if(isset($_SESSION['error']))		// isset sprawdza istnienie SESSION error...
	{
	echo $_SESSION['error'];
	unset($_SESSION['error']);			// unset wyłącza zmienną SESSION error...
	};
?>


</body>
</html>
