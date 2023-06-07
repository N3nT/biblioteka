<?php
    require("../dbconnection.php");
    $url = $_POST['url'];   
    if ($url == "/biblioteka/admin/book.php"){
        if (@$_POST['check_id'] == NULL){
            header("Location: book.php");
        }
        else{
            $delete_id = @$_POST['check_id'];
            for($i=0;$i<count($delete_id);$i++){
            $sql = mysqli_query($db_conn, 'DELETE FROM ksiazki WHERE book_id = '.$delete_id[$i].';');
            header("Location: book.php");
                }
            }   
    }
    elseif($url == "/biblioteka/admin/employer.php"){
        if (@$_POST['check_id'] == NULL){
            header("Location: employer.php");
    }
        else{
            $delete_id = @$_POST['check_id'];
                for($i=0;$i<count($delete_id);$i++){
                $sql = mysqli_query($db_conn, 'DELETE FROM pracownicy WHERE worker_id = '.$delete_id[$i].';');
                header("Location: employer.php");
                    }
            }
    }
    elseif($url == "/biblioteka/admin/reader.php"){
        if (@$_POST['check_id'] == NULL){
            header("Location: reader.php");
    }
        else{
            $delete_id = @$_POST['check_id'];
                for($i=0;$i<count($delete_id);$i++){
                $sql = mysqli_query($db_conn, 'DELETE FROM uzytkownicy WHERE user_id = '.$delete_id[$i].';');
                header("Location: reader.php");
                    }
            }
        }
    elseif($url == "/biblioteka/admin/rental.php"){
        if (@$_POST['check_id'] == NULL){
            header("Location: rental.php");
    }
        else{
            $delete_id = @$_POST['check_id'];
                for($i=0;$i<count($delete_id);$i++){
                $sql = mysqli_query($db_conn, 'DELETE FROM wypozyczenia WHERE reservation_id = '.$delete_id[$i].';');
                header("Location: rental.php");
                    }
            }
        }
    mysqli_close($db_conn);
?>