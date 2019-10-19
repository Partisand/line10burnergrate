<?php

	session_start();
	
	if ((!isset($_SESSION['userOnline'])) || (!isset($_POST['code'])))
	{
		header('Location: Index.php');
		exit();								// w innym przypadku wykona się cały kod tego pliku zanim nastąpi przekierowanie...
		
	};
?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Search 2</title>
</head>

<body>

<?php

	echo "Jesteś w Search2.php";
	
	$code = $_POST['code'];
	echo "<h2> Odczytany kod: $code ...</h2>";
	
	
?>


</body>
</html>