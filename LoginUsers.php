
<?php

	session_start();														// pozwala dokumentowi korzystać z SESSION...

	echo "Jesteś w LoginUser.php <br />";
	
	require_once "dbconnect.php";

	echo "host = "." $host, $db_user, $db_password, $db_name <br />";
	
	$connection1 = @new mysqli($host, $db_user, $db_password, $db_name); 	// znak @ ukrywa błędy, nie wyświetla ich ;-)...
	
	if($connection1->connect_errno!=0)										// sprawdzanie połączenia z bazą danych...
	{
		echo "<br /> Error: ".$connection1->connect_errno;					//." Opis: ".$connection1->connect_error;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		// zabepieczenie przed wstrzykiwaniem zapytań SQL...
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		echo "<br />".$login." ".$haslo."<br />";
		
				
		if ($rezult = @$connection1->query(
		sprintf("SELECT * FROM users WHERE user='%s'",
		mysqli_real_escape_string($connection1,$login))))
		{
			$records = $rezult->num_rows;
			echo $records." <br />";
			if ($records > 0)
			{
				$row = $rezult->fetch_assoc();		// pobieranie wiersza bazy danych wg tablicy asocjacyjnej...
				if (password_verify($haslo, $row['pass']))
				{

				
				$_SESSION['userOnline'] = true;
				

				$_SESSION['user'] = $row['user'];	// globalna tablica asosjacyjna '_SESSION'
				$_SESSION['email'] = $row['email'];
				
				$rezult->close();					// to są te same funkcje: close() free() free_result(), pozbywanie się z pamięci rezultatów zapytania...
				
				header('Location: search0.php'); 	// przekierowanie do pliku
				}
				else
				{
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');					
				};
				
				
				
			}
			else
			{
				
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
				
			};
		
			
			
		}
		
		
		$connection1->close();												// zamknięcie połączenia z bazą danych...
		
		
		echo "It works";
	}


?>

