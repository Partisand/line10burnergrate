<?php

	session_start();
	
	if ((!isset($_SESSION['userOnline'])))
	{
		header('Location: Index.php');
		exit();								// w innym przypadku wykona się cały kod tego pliku zanim nastąpi przekierowanie...
		
	};
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Search 0</title>
</head>

<body>
<?php

	echo "Jesteś w Search0.php <br />";
	
	
	echo "<p>Witaj ".$_SESSION['user'].' [<a href="LogoutUsers.php"> Wyloguj się!</a>]</p>';
	echo "Twój email: ".$_SESSION['email']." <br />";
	
	
	
?>
	<h1>Wyszukiwanie ON-LINE</h1>
	

	<form action="Search.php" method="post">
	Kod kuchni (6 ostatnich cyfr)
	<br /><br />
	<input type="text" name="code"/>
	
	<br /><br />
	<input type="submit" />
	<br />
	</form>


	<br />	<br />
</body>
</html>