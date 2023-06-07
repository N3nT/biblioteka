<?php
    require("../dbconnection.php");
    @$reservation_id = $_POST['reservation_id'];
    @$status = $_POST['status'];
    @$data = date("Y-m-d");
    if ($reservation_id == null or $status == null){
        header("Location: rental.php");
    }
    else{
        for($i=0;$i<count($reservation_id);$i++){
            if(mysqli_query($db_conn, "UPDATE wypozyczenia SET rental_status = 0, data_zwrotu = '$data' WHERE reservation_id = ".$reservation_id[$i].";")){
                $_POST = Null;
                header("Location: rental.php");
                exit();
            }
            else{
                $_POST = Null;
                header("Location: rental.php");
                exit();
            }
                }
   }
?>