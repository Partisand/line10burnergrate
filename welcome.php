<?php

	session_start();
	
	if (!isset($_SESSION['newUser']))
	{
		header('Location: Index.php');
		exit();								// w innym przypadku wykona się cały kod tego pliku zanim nastąpi przekierowanie...
	}
	else
	{
		unset($_SESSION['newUser']);
	};

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Welcome</title>

	<!-- przykładowy komentarz -->
	
	


</head>

<body>
	
	Dziękujemy, rejetracja przebiegła pomyślnie, Witamy !!! <br />
	
	
	<a href="index.php">Teraz możesz zalogować się na swoje konto!</a>
	
<?php	// nie wiem czy jest mi to tutaj potrzebne ?????
	
	
	if(isset($_SESSION['error']))		// isset sprawdza istnienie SESSION error...
	{
	echo $_SESSION['error'];
	unset($_SESSION['error']);			// unset wyłącza zmienną SESSION error...
	};
?>


</body>
</html>
