<!DOCTYPE html>
<html lang="pl">
<head>
<?php
    session_start();
        if (isset($_SESSION["current_user"])){
            if ($_SESSION['current_user'] != "root@root.pl"){
                header ("Location: ../main/reader.php");
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
        <form action="delete.php" method="POST">
        <div class="table_wrap">    
        <table id="table">
            <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <?php
                $sql = mysqli_query($db_conn, 'SELECT * FROM uzytkownicy;');
                echo "<th></th><th>Id uzytkownika</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Numer Telefonu</th>";
                while($wiersz = mysqli_fetch_assoc($sql)){
                    if ($wiersz['user_id'] === '1'){
                        echo "<tr><td class='checkbox'><input type='checkbox' name='check_id[]' value='".$wiersz['user_id']."' disabled></td>";
                    }
                    else{
                        echo "<tr><td class='checkbox'><input type='checkbox' name='check_id[]' value='".$wiersz['user_id']."'></td>";
                    }
                    echo ("<td style='width: 90px;'>".$wiersz['user_id']."</td>
                        <td>".$wiersz['imie']."</td>
                        <td>".$wiersz['nazwisko']."</td>
                        <td>".$wiersz['email']."</td>
                        <td>".$wiersz['numer_telefonu']."</td></tr>");
                }
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
                <input class="add_input" type="text" name="name" placeholder="Imię" require maxlength="50">
                <input class="add_input" type="text" name="surname" placeholder="Nazwisko" require maxlength="50">
                <input class="add_input" type="email" name="email" placeholder="Email" require maxlength="90">
                <input class="add_input" type="tel" name="tel_num" placeholder="Numer Telefonu" maxlength="9" minlenght="9" require>
                <input class="add_input" type="password" name="password" placeholder="Haslo" require minlenght="5">
                <input type="submit" value="Dodaj" class="add_button">
                </div>
            </form>
            <h2>Edytuj</h2>
            <form action="modify.php" method="post" class="add_form">
                <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div style="width: 80%; display: flex; justify-content: space-around; height: 40px">
                <input class="add_input" type="hidden" id="m_user_id" name="m_user_id">
                <input class="add_input" type="text" id="m_name" name="m_name" placeholder="Imię" require maxlength="50">
                <input class="add_input" type="text" id="m_surname" name="m_surname" placeholder="Nazwisko" require maxlength="50">
                <input class="add_input" type="email" id="m_email" name="m_email" placeholder="Email" disabled >
                <input class="add_input" type="tel" id="m_tel_num" name="m_tel_num"  placeholder="Numer Telefonu" maxlength="9" minlength="9" disabled>
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

                    document.getElementById("m_user_id").value = this.cells[1].innerHTML;
                    document.getElementById("m_name").value = this.cells[2].innerHTML;
                    document.getElementById("m_surname").value = this.cells[3].innerHTML;
                    document.getElementById("m_email").value = this.cells[4].innerHTML;
                    document.getElementById("m_tel_num").value = this.cells[5].innerHTML;
                };
            }
    </script>
</body>
</html>