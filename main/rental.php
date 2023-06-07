<!DOCTYPE html>
<html lang="pl">
<head>
<?php
    session_start();
        if (isset($_SESSION["current_user"])){
            if ($_SESSION['current_user'] == "root@root.pl"){
                header ("Location: ../admin/rental.php");
            }
         } else {
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
        <form action="end_rental.php" method="post">
        <div class="table_wrap">
        <table id="table" style="border-top: 2px solid black;">
            <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <?php
                $mail = $_SESSION['current_user'];
                $wynik = mysqli_query($db_conn, "SELECT * FROM uzytkownicy WHERE email = '$mail';"); 
                $wiersz = mysqli_fetch_assoc($wynik);
                $sql = mysqli_query($db_conn, 'SELECT * FROM wypozyczenia WHERE czytelnik_id = '.$wiersz['user_id'].';');
                echo "<th></th><th>Id rezerwacji</th><th>Id książki</th><th>Id czytelnika</th><th>Data wypożyczenia</th><th>Data zwrotu</th><th style='width: 70px;'>Status</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo "<tr><td><input type='checkbox' name='reservation_id[]'";
                    if($wiersz['rental_status'] == 0){
                        echo "disabled ";
                    }
                    else{
                        echo "";
                    }
                    echo "value=".$wiersz['reservation_id'].">
                    
                    <td style='width: 90px;'>".$wiersz['reservation_id']."</td>
                    <td>".$wiersz['ksiazka_id']."</td>
                    <td>".$wiersz['czytelnik_id']."</td>
                    <td>".$wiersz['data_wypozyczenia']."</td>
                    <td>".$wiersz['data_zwrotu']."</td>
                    <td style='padding: 0; margin: 0;'>";
                    if ($wiersz['rental_status'] == 1) {
                        echo "<div class='status_true'><input type='hidden' name='status' value=".$wiersz['rental_status'].">Aktywne</div>";
                    } else {
                        echo "<div class='status_false'><input type='hidden' name='status' value=".$wiersz['rental_status'].">Oddano</div>";
                    }             
                   echo "</td></tr>";}       
            ?>
        </table>
        </div>
        <div class="line"></div>
        <input type="submit" value="Oddaj książkę" class="end_rental">
        <div style="clear: both;"></div>
        </form>
        </div>
            <button class="back"><a href="../main.php">Wróć</a></button>      
        </div>
    </main>
</body>
</html>