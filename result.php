<?php
/**
 * Name:  Abhay Panchal 
 * Student Number : 000813104
 * Date : 2020-10-26
 */

 //Connect the php file with the wumpus database with PDO
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=000813104",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>

<?php
// getting row and column number
$row = filter_input(INPUT_GET, "row" , FILTER_VALIDATE_INT);
$col = filter_input(INPUT_GET, "col" ,FILTER_VALIDATE_INT);

//finding if the combination of the row and column has wumpus or not
$command = "SELECT * FROM wumpuses WHERE wrow = ? AND wcol = ?";
$stmt = $dbh -> prepare($command);
$params = [$row , $col];
$success = $stmt -> execute($params);
$b = $stmt->fetch();
$result = true;

if($success && $b )
    $result =true;
else
    $result = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type="text/css" href ="css/wumpus.css">
    <title>RESULT</title>
</head>
<body>
    <?php
    //Displaying picture that shows that player find a wumpus or not
    if($result){
        echo "<img class='img' src = 'img/win.png'> <br><br> You found a Wumpus!!! <br>";
    }else{
        echo "<img class='img' src = 'img/lose.jpg'><br><br> Its not a Wumpus! try again!!! <br>";
    }
    
    ?>

    <!-- form for getting email and the result of th egame from user -->
    <form method="post" action = "save.php">
        <br>
        YOUR EMAIL : <input type="email" name="email" required>
        <input type="hidden" name="result" value="<?php echo "$result";?>">
        <input type="submit" value="save">
    </form>
</body>
</html>