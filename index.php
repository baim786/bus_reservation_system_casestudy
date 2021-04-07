<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bus Seat Reservation System</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="card bg-lightgray">
            <h2>Welcome to the Bus Seat Reservation System!</h2>
            <h3>You can reserve a bus seat by choosing from the options below.</h3>
        </div>

        <?php session_start(); ?>

        <?php 
        if(isset($_SESSION['error'])){
            echo '
                <div class="card error">
                    '.$_SESSION["error"].'
                </div>
            ';
        }

        if(isset($_SESSION['success'])){
            echo '
                <div class="card success">
                    '.$_SESSION["success"].'
                </div>
            ';
        }
        
        
        ?>

        <div class="card">
            <p>We have 30 seats, ranging from single seats to double seats, window seats to aisle seats.</p>
            <p>Prices vary based on the type of seat, whether single or double. A single seat costs 10RM. A double seat costs 18RM.</p>

            <form action="bus.php" method="POST" class="form-input">
                <div>
                    <div>
                        <label for="busRow">Bus Row</label>
                        <select name="busRow" id="busRow">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>

                <br>

                <div>
                    <div>
                        <label for="seatType">Seat Type</label>
                        <select name="seatType" id="seatType">
                            <option value="single">Single Seat</option>
                            <option value="double">Double Seat</option>
                        </select>
                    </div>
                </div>

                <br>

                <div>
                    <div>
                        <label for="doubleSeatSide">Preferred Seat (for double)</label>
                        <select name="doubleSeatSide" id="doubleSeatSide">
                            <option value="window">Window Seat</option>
                            <option value="aisle">Aisle Seat</option>
                        </select>
                    </div>
                </div>

                <br>

                <div>
                    <div>
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name">
                    </div>
                </div>

                <br>

                <div>
                    <button type="submit" class="button">Submit</button>
                </div>

            </form>

            <div class="main-bus">
                <?php 
            if(isset($_SESSION['bus'])){
                $bus = $_SESSION['bus'];
                for ($i=0; $i <= 9; $i++) { 
                    echo '<div class="space-between">';
                    for ($j=0; $j <= 2; $j++) {
                        if($bus[$i][$j] != ""){
                            echo "<span>".$bus[$i][$j]."</span>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        } else {
                            echo "Seat-".($i+1)."-".$j+1;
                            echo "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                        }
                    }
                    echo "</div>";
                    echo "<br>";
                }
            } else {
                for ($i=1; $i <= 10; $i++) { 
                    echo '<div class="space-between">';
                    for ($j=0; $j <= 2; $j++) { 
                        echo "<span>Seat-".$i."-".($j+1)."</span>";
                        echo "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                    }
                    echo "</div>";
                    echo "<br>";
                }
            }
            
            ?>
            </div>

        </div>
    </body>
</html>