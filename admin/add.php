<?php
     require("../dbconnection.php");
     $url = $_POST['url'];
     if ($url == "/biblioteka/admin/book.php"){
        @$book_title = mysqli_real_escape_string($db_conn, $_POST["title"]);
        @$book_autor = mysqli_real_escape_string($db_conn, $_POST["autor"]);
        @$book_year = mysqli_real_escape_string($db_conn, $_POST["year"]);
        @$book_lang = mysqli_real_escape_string($db_conn, $_POST["lang"]);
        @$book_publisher = mysqli_real_escape_string($db_conn, $_POST["publisher"]);

        if ($book_title == null or $book_autor == null or $book_year == null or $book_lang == null or $book_publisher == null){
            mysqli_close($db_conn);
            header("Location: book.php");
            exit();
        }
        else{
            if(mysqli_query($db_conn, "INSERT INTO ksiazki (tytul, autor, rok_wydania, jezyk, wydawnictwo) VALUES ('$book_title', '$book_autor', '$book_year', '$book_lang', '$book_publisher');")){
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
     }
     elseif($url == "/biblioteka/admin/employer.php"){
        @$employer_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
        @$employer_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
        @$employer_position = mysqli_real_escape_string($db_conn, $_POST["position"]);
        @$employer_salary = mysqli_real_escape_string($db_conn, $_POST["salary"]);

        if ($employer_name == null or $employer_surname == null or $employer_position == null or $employer_salary == null){
            mysqli_close($db_conn);
            header("Location: employer.php");
            exit();
        }
        else{
            if(mysqli_query($db_conn, "INSERT INTO pracownicy (imie, nazwisko, stanowisko, pensja) VALUES ('$employer_name', '$employer_surname', '$employer_position', '$employer_salary');")){
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: employer.php");
                exit();
             } 
             else{
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: employer.php");
                exit();
             }
        }
     }
     elseif($url == "/biblioteka/admin/reader.php"){
      @$user_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
      @$user_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
      @$user_email = mysqli_real_escape_string($db_conn, $_POST["email"]);
      @$user_tel = mysqli_real_escape_string($db_conn, $_POST["tel_num"]);
      @$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
      $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

      if ($user_name == null or $user_surname == null or $user_email == null or $user_tel == null or $user_password_hash == null){
            mysqli_close($db_conn);
            header("Location: reader.php");
            exit();
      }
      else{
        if (mysqli_num_rows(mysqli_query($db_conn, "SELECT email FROM uzytkownicy WHERE email = '".$user_email."';")) != 0 or mysqli_num_rows(mysqli_query($db_conn, "SELECT numer_telefonu FROM uzytkownicy WHERE numer_telefonu = '".$user_tel."';")) != 0){
            mysqli_close($db_conn);
            header("Location: reader.php");
            exit();
        }
        else{ 
            if(mysqli_query($db_conn, "INSERT INTO uzytkownicy (imie, nazwisko, email, numer_telefonu, haslo) VALUES ('$user_name', '$user_surname', '$user_email', '$user_tel', '$user_password_hash');")){
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: reader.php");
                exit();
             } 
             else{
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: reader.php");
                exit();
             }
        }
      }
     }
     elseif($url == "/biblioteka/admin/rental.php"){
         @$book_id = mysqli_real_escape_string($db_conn, $_POST['book_id']);
         @$user_id = mysqli_real_escape_string($db_conn, $_POST['user_id']);
         @$rental_date = mysqli_real_escape_string($db_conn, $_POST['data_wypozyczenia']);
         @$return_date = mysqli_real_escape_string($db_conn, $_POST['data_zwrotu']);

         if($book_id == null or $user_id == null or $rental_date == null or $return_date == null){
            $_POST = Null;
            mysqli_close($db_conn);
            header("Location: rental.php");
            exit();
         }
         elseif ($book_id != null and $user_id != null and $rental_date != null and $return_date != null){
            if (mysqli_num_rows(mysqli_query($db_conn, "SELECT email FROM uzytkownicy WHERE email = '".$user_email."';")) != 0 or mysqli_num_rows(mysqli_query($db_conn, "SELECT numer_telefonu FROM uzytkownicy WHERE numer_telefonu = '".$user_tel."';")) != 0)
            {
                echo "Podany email lub numer telefonu jest już użyty.";
                $_POST = Null;
                mysqli_close($db_conn);
                exit();
            }
            else{
                if(mysqli_query($db_conn, "INSERT INTO wypozyczenia (ksiazka_id, czytelnik_id, data_wypozyczenia, data_zwrotu) VALUES ('$book_id', '$user_id', '$rental_date', '$return_date');")){
                    $_POST = Null;
                    mysqli_close($db_conn);
                    header("Location: rental.php");
                    exit();
            }}
            }
            else{
                $_POST = Null;
                mysqli_close($db_conn);
                header("Location: rental.php");
                exit();
            }
        }
 ?>
