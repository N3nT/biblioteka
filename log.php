<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się! | Biblioteka Kraków</title>
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
    <form action="#" method="post" id="log_form" autocomplete="off">
        <img src="img/Logo-BK.png" alt="" srcset="" class="logo" require>
        <input type="email" name="email" class="log_input" placeholder="Email" require><br>
        <input type="password" name="password" class="log_input" placeholder="Hasło" require><br>
        <input type="submit" id="log_in"value="Zaloguj się">
    </form>
    <?php
        session_start();
        @$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
        @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
        @$query_login = mysqli_query($db_conn, "SELECT * FROM uzytkownicy WHERE email ='$user_email'");
        if(mysqli_num_rows($query_login) > 0) {
           $record = mysqli_fetch_assoc($query_login);
           $hash = $record["haslo"];
           if (password_verify($user_password, $hash)) {
                $_SESSION["current_user"] = htmlspecialchars($user_email);
                if ($user_email == "root@root.pl"){
                    header('Location: admin.php');
                }
                else{
                    header('Location: main.php');
                }
           }
           else{
                echo "Logowanie nie powiodło się";
                $_POST = null;
           }
        }
        mysqli_close($db_conn);
    ?>
    <div id="change_form">
        <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
    </div>
</body>
<script>

</script>
</html>