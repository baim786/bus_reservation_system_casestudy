<?php

// Bus has 30 seats
// Bus has 3 seats in each row
// 30/3 = 10 rows
session_start();
if(isset($_SESSION['bus'])){
    $bus = $_SESSION['bus'];
} else {
    $bus = array(
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
        array("", "", ""),
    );
}

function redirectPage($bus){
    $_SESSION["bus"] = $bus;

    header('Location: index.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    $seatType = $_POST['seatType'];
    $busRow = $_POST['busRow'];
    $doubleSeatSide = $_POST['doubleSeatSide'];
    $name = $_POST['name'];

    if($name == ""){
        $_SESSION['error'] = "Please insert your name";
        redirectPage($bus);
    } else if($busRow > 10 || $busRow <= 0){
        $_SESSION['error'] = "Please choose a number between 1 and 10";
        redirectPage($bus);
    } else if($seatType != "single" && $seatType != "double"){

        $_SESSION['error'] = "Please choose either a single seat or a double seat";
        redirectPage($bus);
    } else {
        if($seatType == "single"){
            $busColumn = 0;
            $cost = 10;
        } else if ($seatType == "double"){
            if($doubleSeatSide == "aisle"){
                $busColumn = 1;
            } else if ($doubleSeatSide == "window"){
                $busColumn = 2;
            } else {
                $_SESSION['error'] = "Please choose either a window seat or an aisle seat";
                redirectPage($bus);
            }
            $cost = 18;
        }

        if($bus[$busRow-1][$busColumn] != ""){
            $_SESSION['error'] = "The seat has already been taken";
            redirectPage($bus);
        } else {
            $bus[$busRow-1][$busColumn] = $name;
            $_SESSION['success'] = "You have successfully booked seat number ".($busRow)."-".($busColumn+1).". Your total cost is ".$cost;
        }
    }

    $_SESSION["bus"] = $bus;

    header('Location: index.php');
}
?>