<?php 
    require("../dbconnection.php");
    $url = $_POST['url'];
    if ($url == "/biblioteka/admin/book.php"){
        @$book_title = mysqli_real_escape_string($db_conn, $_POST["m_title"]);
        @$book_autor = mysqli_real_escape_string($db_conn, $_POST["m_autor"]);
        @$book_year = mysqli_real_escape_string($db_conn, $_POST["m_year"]);
        @$book_lang = mysqli_real_escape_string($db_conn, $_POST["m_lang"]);
        @$book_publisher = mysqli_real_escape_string($db_conn, $_POST["m_publisher"]);
        @$book_id = mysqli_real_escape_string($db_conn, $_POST["m_id_book"]);

        if ($book_title == null or $book_autor == null or $book_year == null or $book_lang == null or $book_publisher == null){
            header("Location: book.php");
        }
        else{
            if(mysqli_query($db_conn, "UPDATE ksiazki SET tytul = '$book_title', autor = '$book_autor', rok_wydania= '$book_year', jezyk='$book_lang', wydawnictwo = '$book_publisher' WHERE book_id = '$book_id';")){
                $_POST = Null;
                header("Location: book.php");
             } 
             else{
                $_POST = Null;
                header("Location: book.php");
             }
        }
    }
    elseif($url == "/biblioteka/admin/employer.php"){
        @$employer_name = mysqli_real_escape_string($db_conn, $_POST["m_name"]);
        @$employer_surname = mysqli_real_escape_string($db_conn, $_POST["m_surname"]);
        @$employer_position = mysqli_real_escape_string($db_conn, $_POST["m_position"]);
        @$employer_salary = mysqli_real_escape_string($db_conn, $_POST["m_salary"]);
        @$worker_id = mysqli_real_escape_string($db_conn, $_POST['m_worker_id']);

        $employer_salary = preg_replace("/[^0-9]/", "", $employer_salary);
        
        if ($employer_name == null or $employer_surname == null or $employer_position == null){
            header("Location: employer.php");
        }
        else{
            if(mysqli_query($db_conn, "UPDATE pracownicy SET imie = '$employer_name', nazwisko = '$employer_surname', stanowisko= '$employer_position', pensja = '$employer_salary' WHERE worker_id = '$worker_id';")){
                $_POST = Null;
                header("Location: employer.php");
             } 
             else{
                $_POST = Null;
                header("Location: employer.php");
             }
        }
    }
    elseif($url == "/biblioteka/admin/reader.php"){
        @$user_name = mysqli_real_escape_string($db_conn, $_POST["m_name"]);
        @$user_surname = mysqli_real_escape_string($db_conn, $_POST["m_surname"]);
        @$user_id = mysqli_real_escape_string($db_conn, $_POST["m_user_id"]);

        echo $user_id."<br>";
        echo $user_name."<br>";
        echo $user_surname."<br>";
        if ($user_name == null or $user_surname == null){
            header("Location: reader.php");
        }
        else{
            if(mysqli_query($db_conn, "UPDATE uzytkownicy SET imie = '$user_name', nazwisko = '$user_surname' WHERE user_id = '$user_id';")){
                $_POST = Null;
                header("Location: reader.php");
             } 
             else{
                $_POST = Null;
                header("Location: reader.php");
             }
        }
    }
    elseif($url == "/biblioteka/admin/rental.php"){
        @$book_id = mysqli_real_escape_string($db_conn, $_POST['m_book_id']);
        @$user_id = mysqli_real_escape_string($db_conn, $_POST['m_user_id']);
        @$rental_date = mysqli_real_escape_string($db_conn, $_POST['m_data_wypozyczenia']);
        @$return_date = mysqli_real_escape_string($db_conn, $_POST['m_data_zwrotu']);
        @$reservation_id = mysqli_real_escape_string($db_conn, $_POST['m_reservation_id']);

        echo $rental_date."<br>";
        echo $return_date."<br>";
        echo $reservation_id."<br>";

        if ($book_id == null or $user_id == null or $rental_date == null or $return_date == null){
            header("Location: rental.php");
        }
        else{
            if(mysqli_query($db_conn, "UPDATE wypozyczenia SET ksiazka_id = '$book_id', czytelnik_id = '$user_id', data_wypozyczenia= '$rental_date', data_zwrotu='$return_date' WHERE reservation_id = '$reservation_id';")){
                $_POST = Null;
                header("Location: rental.php");
             } 
             else{
                $_POST = Null;
                header("Location: rental.php");
             }
        }
    }
    mysqli_close($db_conn);
?>