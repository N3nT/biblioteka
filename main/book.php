<!DOCTYPE html>
<html lang="pl">
<head>
<?php
    session_start();
        if (isset($_SESSION["current_user"])){
            if ($_SESSION['current_user'] == "root@root.pl"){
                header ("Location: ../admin/book.php");
            }
         } 
        else {
            header ("Location: ../log.php");
         }
        require("../dbconnection.php") 
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="main_style/main_pages.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;600&display=swap" rel="stylesheet">
    <title>Zarządzanie Pracownikami | Biblioteka Kraków</title>
</head>
<body>
<nav class="lib_nav">
        <a href="https://www.funduszeeuropejskie.gov.pl/" class="nav_links" target="_blank"><img src="../img/www_logo.png" alt="Logo Funduszy Europejskich" style="height: 150px; width: 269px; margin: 25px 0 0 20px"></a>
        <a href="https://www.malopolska.pl/" class="nav_links" target="_blank"><img src="../img/logo-malopolska.png" alt="Logo Małopolski" style="width: 200px"></a>
        <a href="https://www.facebook.com/profile.php?id=100069172504817" class="nav_links" target="_blank"><img src="../img/nagroda.png" alt="Logo Nagrody Żółtej Ciżemki"></a>
        <div style="float:right; align-items: center; align-text: center; justify-content: center;">
        <div style="max-width: 230px; margin-right: 20px"><p>Zalogowano jako: <br><?php echo $_SESSION['current_user'] ?><br>
        <form action="../log_out.php" method="post">
            <input type="submit" value="Wyloguj się">
        </form>
        </p></div>
        <div style="clear:both;"></div>
    </nav>
    <main>
        <div class="wrap">
        <div class="table_wrap">      
        <table>
            <?php
                $sql = mysqli_query($db_conn, 'SELECT * FROM ksiazki;');
                echo "<th>Id książki</th><th>Tytuł</th><th>Autor</th><th>Rok wydania</th><th>Język</th><th>Wydawnictwo</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo ("<tr><td style='width: 90px;'>".$wiersz['book_id']."</td>
                    <td>".$wiersz['tytul']."</td>
                    <td>".$wiersz['autor']."</td>
                    <td>".$wiersz['rok_wydania']."</td>
                    <td>".$wiersz['jezyk']."</td>
                    <td>".$wiersz['wydawnictwo']."</td></tr>");}       
            ?> 
            </table>
            </div>
            <div class="line"></div>
            <h2>
                Wypożycz książke
            </h2>
            <form action="add.php" method="post" class="add_form" autocomplete="off">
                <div style="width: 80%; display: flex; justify-content: space-around; height: 40px">
                <input class="add_input" type="number" name="book_id" placeholder="ID Książki" require>
                <input class="add_input" type="email" name="email" value="<?php 
                    $mail = $_SESSION['current_user'];
                    $wynik = mysqli_query($db_conn, "SELECT * FROM uzytkownicy WHERE email = '$mail';"); 
                    $wiersz = mysqli_fetch_assoc($wynik);
                    echo $wiersz['email'];
                    ?>" readonly>
                <input class="add_input" type="text" name="rental_date" value="<?php echo date("Y.m.d"); ?>" readonly>
                <input class="add_input" type="text" name="return_date" value="<?php 
                    
                    $date = date('Y.m.d', strtotime("+7 day"));
                    echo ($date);
                    ?>" readonly >
                <input type="submit" value="Wypożycz" class="add_button">
                </div>
            </form>
        </div>
            <button class="back"><a href="../main.php">Wróć</a></button>      
        </div>
    </main>
</body>
</html>