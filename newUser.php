<?php

	session_start();
	
	if(isset($_POST['email']))				//upewniamy się czy ktoś już nacisnął przycisk Zarejestruj się...
	{
											//weryfikujemy / walidujemy poprawność danych...

		// udana walidacja? zakładamy że tak!
		$all_ok = true;
		
		// sprawdź poprawność nickname'a...
		$nick = $_POST['nick']; 

		// sprawdzenie długości nick'a ...  od 3 do 20 znaków...
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$all_ok = false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		};
		// sprawdzenie poprawności znakowej nick'a ...  bez polskich i bez znaków specjalnych...
		if (ctype_alnum($nick) == false)
		{
			$all_ok = false;
			$_SESSION['e_nick']="Nick zawiera niedozwolone znaki!";
		};
		
		
		// sprawdzanie poprawności adresu email...
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);   	// usunięcie niedozwolonych znaków w email...
		
		// 'filter_var($emailB,FILTER_VALIDATE_EMAIL) == false' - stosujemy w momencie pojawienia się błędu...
		
		if ((filter_var($emailB,FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email))
		{
			$all_ok = false;
			$_SESSION['e_email']="Błędny adres email!";
		};
		
		// sprawdzamy poprawność hasła...
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		// spradzenie długości hasła (od 8 do 20)...
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$all_ok = false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		};
		// sprawdzenie czy wpisano dwa razy to samo hasło...
		if ($haslo1 != $haslo2)
		{
			$all_ok = false;
			$_SESSION['e_haslo']="Hasła się różnią!";	
		};


		// checkbox - czy zaakceptowano regulamin...?
		
		if (isset($_POST['regulamin']) == false)
		{
			$all_ok = false;
			$_SESSION['e_regulamin']="Potwierdź akaceptację regulaminu!";			
		};

		// Captcha - bot or not bot ???
		$sekret = '6LclDLYUAAAAABRLfB0IWage8Y5YZTuB6l_fYEHG';	// sekretny kod recaptcha...
		$test = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		$response = json_decode($test);
		
		if ($response->success == false)
		{
			$all_ok = false;
			$_SESSION['e_bot']="Potwierdź że nie jesteś botem!";			
		};


		// porównanie z bazą danych adresu email i loginu...
		// kamuflowanie błędów za TRY i CATCH...
		
		require_once "dbconnect.php";			// pojedyncze połącznie z bazą wg danych w pliku db connect.php
		
		mysqli_report(MYSQLI_REPORT_STRICT);	// raportowanie błędów ma być oparte o wyjątki!!!...
		
		try										// podejrzane funkcje w klamrach 'try'...
		{
		
			$connection1 = new mysqli($host, $db_user, $db_password, $db_name);		
			if($connection1->connect_errno!=0)		// sprawdzanie połączenia z bazą danych...
			{
				throw new Exception(mysqli_connect_errno());			// rzuć nowym wyjątkiem...
			}
			else									// przy poprawnym połączeniu z bazą, wykonaj:
			{
			// teraz zapytanie / qwerenda do bazy danych...o email...:
			$rezult = $connection1->query("SELECT id FROM users WHERE email='$email'");
			if (!$rezult) throw new Exception($connection1->error);		// rzucamy wyjątkiem...
			$how_much_email = $rezult->num_rows;						// pobranie 'ile takich meili' jest w bazie...
			if ($how_much_email > 0)				// gdy jest przynajmniej jeden...
			{
			$all_ok = false;
			$_SESSION['e_email']="Istnieje już konto z takim adresem email!";	
			};	

			// teraz zapytanie / qwerenda do bazy danych...o login...:
			$rezult = $connection1->query("SELECT id FROM users WHERE user='$nick'");
			if (!$rezult) throw new Exception($connection1->error);		// rzucamy wyjątkiem...
			$how_much_nick = $rezult->num_rows;						// pobranie 'ile takich nicków' jest w bazie...
			if ($how_much_nick > 0)				// gdy jest przynajmniej jeden...
			{
			$all_ok = false;
			$_SESSION['e_nick']="Istnieje już konto z takim loginem / nick'iem!";	
			};	

			// wstawiamy tutaj, przed zamknięciem połączenia z bazą danych...
			if ($all_ok == true)
			{
			// hashujemu hasło (kodujemy)... lepiej tutaj umieścić, bo po co hashować błędne hasło...
			$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
			
			// przykładowo 'qwerty123' to '$2y$10$SFByJDjda7mhCCv64Ycdz.ujlbD/GOpII8ayJxwzAwsGSnQss5ZJu' ...
			// echo $haslo_hash;			
						
			// wszystko ok. ;-)
			
			// wymagane jest wypełnienie całego wiersza w bazie danych !!!!!!!!
			if($connection1->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash', '$email',0,0,0,0)"))
			{
				$_SESSION['newUser']=true;
				header('Location: welcome.php');
			}
			else
			{
				throw new Exception($connection1->error); 
			};
			
			};




			
			$connection1->close();					// zamknięcie połączenia z bazą...
			};
		}
		catch(Exception $e)						// złap wyjątek...i wykonaj:
		{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności. Spróbuj ponownie później.</span>';

		echo "<br/>Informacje deweloperskie: ".$e;			// dokładny opis problemu...

		
		};




	};
	
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rejestracja</title>

	<!-- komentarz w HTML -->
	
	

	<script src='https://www.google.com/recaptcha/api.js'> </script>

		<style>
			.error
			{
				color: red;
				margin-top: 10px;
				margin-botton: 10px;
			};
		</style>
</head>

<body>
	
	<form method="post">
	
		Nickname: </br><input type="text" name="nick" /><br/>
		
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			};
		?>
			
		
		E-mail: <br/><input type="text" name="email" /><br/>

		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			};
		?>

		Twoje hasło: <br/><input type="password" name="haslo1" /><br/>
		Powtórz hasło: <br/><input type="password" name="haslo2" /><br/>

		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			};
		?>
		
		<label>
			<input type="checkbox" name="regulamin" />Akceptuję regulamin<br/>
		</label>
		<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class = "error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			};
		?>

		<br/>

		<div class="g-recaptcha" data-sitekey="6LclDLYUAAAAACrgcRugt8vFVzEcZDdmO87ZPTiH"></div>

		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class = "error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			};
		?>
		
		<br/>

		<input type="submit" value="Zarejestruj się" />
		

	
	</form>
	
	
	
</body>
</html>
