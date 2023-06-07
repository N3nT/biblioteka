<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się! | Biblioteka Kraków</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/log.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        require("dbconnection.php");
    ?>
    <form action="#" method="post" id="reg_form" style="top: 50%;" autocomplete="off">
        <img src="img/Logo-BK.png" alt="" srcset="" class="logo">
        <input type="text" name="name" class="log_input" placeholder="Imie" maxlength="50" require><br>
        <input type="text" name="surname" class="log_input" placeholder="Nazwisko" maxlength="50" require><br>
        <input type="email" name="email" class="log_input" placeholder="Email" maxlength="50" require><br>
        <input type="tel" name="tel" class="log_input" placeholder="Numer Telefonu" maxlength="9" require><br>
        <input type="password" name="password" class="log_input" placeholder="Hasło" maxlength="255" require><br>
        <input type="submit" id="log_in"value="Zarejestruj się">
    </form>
    <?php
        @$user_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
        @$user_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
        @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
        @$user_tel = mysqli_real_escape_string($db_conn, $_POST["tel"]);
        @$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

        
        if ($user_name == null or $user_surname == null or $user_email == null or $user_tel == null or $user_password == null){
            echo(
                ""
            );
        }
        else{
            if (mysqli_num_rows(mysqli_query($db_conn, "SELECT email FROM uzytkownicy WHERE email = '".$user_email."';")) != 0 or mysqli_num_rows(mysqli_query($db_conn, "SELECT numer_telefonu FROM uzytkownicy WHERE numer_telefonu = '".$user_tel."';")) != 0)
        {
            echo "Podany email lub numer telefonu jest już użyty.";
            $_POST = Null;
        }
        else {
        
        if (mysqli_query($db_conn, "INSERT INTO uzytkownicy (imie, nazwisko, email, numer_telefonu, haslo) VALUES ('$user_name', '$user_surname', '$user_email', '$user_tel', '$user_password_hash')")){
            echo "Rejestracja przebiegła poprawnie";
            $_POST = Null;
         } 
         else{
            echo "Nieoczekiwany błąd - użytkownik już istnieje lub błąd serwera MySQL.";
            $_POST = Null;
         }
        }
        }
        mysqli_close($db_conn);
    ?>
    <div id="change_form" style="top: 80%">
        <p>Posiadasz konto? <a href="log.php">Zaloguj się</a></p>
    </div>
</body>
</html>