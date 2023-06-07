<!DOCTYPE html>
<html lang="pl">
<head>
<?php
    session_start();
    if (isset($_SESSION["current_user"])){
        if ($_SESSION['current_user'] != "root@root.pl"){
            header ("Location: main.php");
        }
     } 
    else {
        header ("Location: log.php");
     }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;600&display=swap" rel="stylesheet">
    <title>Witaj <?php echo $_SESSION["current_user"];?> | Biblioteka Kraków</title>
</head>
<body>
    <nav class="lib_nav">
        <a href="https://www.funduszeeuropejskie.gov.pl/" class="nav_links" target="_blank"><img src="img/www_logo.png" alt="Logo Funduszy Europejskich" style="height: 150px; width: 269px; margin: 25px 0 0 20px"></a>
        <a href="https://www.malopolska.pl/" class="nav_links" target="_blank"><img src="img/logo-malopolska.png" alt="Logo Małopolski" style="width: 200px"></a>
        <a href="https://www.facebook.com/profile.php?id=100069172504817" class="nav_links" target="_blank"><img src="img/nagroda.png" alt="Logo Nagrody Żółtej Ciżemki"></a>
        <div style="float:right; align-items: center; align-text: center; justify-content: center;">
        <div style="max-width: 230px; margin-right: 20px"><p>Zalogowano jako: <br><?php echo $_SESSION['current_user'] ?><br>
        <form action="log_out.php" method="post">
            <input type="submit" value="Wyloguj się">
        </form>
        </p></div>
        <div style="clear:both;"></div>
    </nav>
    <main>
        <div class="wrap_content">
            <a href="admin/book.php">
            <div class="div_option">
                <h2>Zarządzaj Książkami</h2><br> 
                <img src="img/open-book.png" alt="Obraz książka">
            </div>
            </a>
            <a href="admin/reader.php">
            <div class="div_option">
                <h2>Zarządzaj Czytelnikami</h2><br>
                <img src="img/reader.png" alt="Obraz czytelnik">
            </div>
            </a>
            <a href="admin/rental.php">
            <div class="div_option">
                <h2>Zarządzaj Wypożyczeniami</h2>
                <img src="img/reading-book.png" alt="Obraz książka z zegarkiem">
            </div>
            </a>
            <a href="admin/employer.php">
            <div class="div_option">
                <h2>Zarządzaj Pracownikami</h2>
                <img src="img/employee.png" alt="Obraz pracownicy">
            </div>
            </a>
        </div>
    </main>
</body>
</html>