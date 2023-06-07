<!DOCTYPE html>
<html lang="pl">
<head>
<?php
    session_start();
        if (isset($_SESSION["current_user"])){
            if ($_SESSION['current_user'] != "root@root.pl"){
                header ("Location: ../main/rental.php");
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
    <link rel="stylesheet" href="style_admin/admin_pages.css">
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
        <table style="margin-bottom: 15px; border: 2px solid black; border-left: none; border-top: none;">
        <?php
                $sql = mysqli_query($db_conn, 'SELECT * FROM ksiazki;');
                echo "<th>Id książki</th><th>Tytuł</th><th>Autor</th><th>Rok wydania</th><th>Język</th><th>Wydawnictwo</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo ("<tr><td style='width: 90px;'>".$wiersz['book_id']."</td>
                        <td>".$wiersz['tytul']."</td>
                        <td>".$wiersz['autor']."</td>
                        <td>".$wiersz['rok_wydania']."</td>
                        <td>".$wiersz['jezyk']."</td>
                        <td>".$wiersz['wydawnictwo']."</td></tr>");
                }
            ?>
        </table>
        </div>
        <div class="table_wrap">
        <table style="margin-bottom: 15px; border: 2px solid black; border-left: none;">
        <?php
                $sql = mysqli_query($db_conn, 'SELECT * FROM uzytkownicy;');
                echo "<th>Id uzytkownika</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Numer Telefonu</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo ("<tr><td style='width: 90px;'>".$wiersz['user_id']."</td>
                        <td>".$wiersz['imie']."</td>
                        <td>".$wiersz['nazwisko']."</td>
                        <td>".$wiersz['email']."</td>
                        <td>".$wiersz['numer_telefonu']."</td></tr>");
                }
            ?>
        </table>
        </div>
        <form action="delete.php" method="POST">
        <div class="table_wrap">
        <table id="table" style="border: 2px solid black; border-left: none; border-bottom: none;">
            <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <?php
                $sql = mysqli_query($db_conn, 'SELECT * FROM wypozyczenia;');
                echo "<th></th><th>Id rezerwacji</th><th>Id książki</th><th>Id czytelnika</th><th>Data wypożyczenia</th><th>Data zwrotu</th><th>Status</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    echo "<tr><td class='checkbox'><input type='checkbox' name='check_id[]'value='".$wiersz['reservation_id']."'></td>
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
            <input class="delete" type="submit" value="Usuń" style="float: right;">
            </form>
        <div class="line"></div>
            <h2 style="margin-left: 115px;">Dodaj</h2>
            <form action="add.php" method="post" class="add_form">
                <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div style="width: 80%; display: flex; justify-content: space-around; height: 40px">
                <input class="add_input" type="number" name="book_id" placeholder="ID Książki" require>
                <input class="add_input" type="number" name="user_id" placeholder="ID Użytkownika" require>
                <input class="add_input" type="date" name="data_wypozyczenia" placeholder="Data wypożyczenia" require >
                <input class="add_input" type="date" name="data_zwrotu" placeholder="Data zwrotu" require>
                <input type="submit" value="Dodaj" class="add_button">
                </div>
            </form>
            <h2>Edytuj</h2>
            <form action="modify.php" method="post" class="add_form">
                <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div style="width: 80%; display: flex; justify-content: space-around; height: 40px">
                <input class="add_input" type="hidden" id="m_reservation_id" name="m_reservation_id">
                <input class="add_input" type="number" id="m_book_id" name="m_book_id" placeholder="ID Książki" require>
                <input class="add_input" type="number" id="m_user_id" name="m_user_id" placeholder="ID Użytkownika" require>
                <input class="add_input" type="date" id="m_data_wypozyczenia" name="m_data_wypozyczenia" placeholder="Data wypożyczenia" require >
                <input class="add_input" type="date" id="m_data_zwrotu" name="m_data_zwrotu" placeholder="Data zwrotu" require>
                <input type="submit" value="Edytuj" class="modify">
                </div>
            </form>
        </div>
            <button class="back"><a href="../admin.php">Wróć</a></button>      
        </div>
    </main>
    <script>
                var table = document.getElementById("table"),rIndex;

                for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                    rIndex = this.rowIndex;

                    document.getElementById("m_reservation_id").value = this.cells[1].innerHTML;
                    document.getElementById("m_book_id").value = this.cells[2].innerHTML;
                    document.getElementById("m_user_id").value = this.cells[3].innerHTML;
                    document.getElementById("m_data_wypozyczenia").value = this.cells[4].innerHTML;
                    document.getElementById("m_data_zwrotu").value = this.cells[5].innerHTML;
                };
            }
    </script>
</body>
</html>