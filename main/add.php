<?php
     require("../dbconnection.php");
        @$book_id = mysqli_real_escape_string($db_conn, $_POST["book_id"]);
        @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
        @$rental_date = strval($_POST["rental_date"]);
        @$return_date = strval($_POST["return_date"]);

        if ($book_id == null or $user_email == null or $rental_date == null or $return_date == null){
            mysqli_close($db_conn);
            header("Location: book.php");
            exit();
        }
        else{
            $email = mysqli_query($db_conn, "SELECT * FROM uzytkownicy WHERE email = '$user_email';");
            $wiersz = mysqli_fetch_assoc($email);
            $user_id = $wiersz['user_id'];
            if(mysqli_query($db_conn, "INSERT INTO wypozyczenia (ksiazka_id, czytelnik_id, data_wypozyczenia, data_zwrotu) VALUES ('$book_id', '$user_id', '$rental_date', '$return_date');")){
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: book.php");
                exit();
             } 
             else{
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: book.php");
                exit();
             }
        }
?>
