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
//result and email variables that get the input from result.php file 
$result = filter_input(INPUT_POST ,"result", FILTER_VALIDATE_BOOLEAN);
$email = filter_input(INPUT_POST ,"email", FILTER_SANITIZE_EMAIL);


    //select a player who is playing the game 
    $command = "SELECT * FROM players Where email_add = ?";
    $stmt = $dbh -> prepare($command);
    $params = [$email];
    $success = $stmt -> execute($params);

    $b = $stmt->fetch();
   
    if($success && $b){
        //this condition update the existing record in the database 
        if($result){
            $update = "UPDATE players SET wins = wins + 1, played_date = ? where email_add = ?";

            $u_stmt = $dbh -> prepare($update);
            $params_u = [date("Y-M-d"),$email];
            $success_u = $u_stmt -> execute($params_u);
        }else{
            $update = "UPDATE players SET losses = losses + 1, played_date = ? where email_add = ?";

            $u_stmt = $dbh -> prepare($update);
            $params_u = [date("Y-M-d"),$email];
            $success_u = $u_stmt -> execute($params_u);
        }

        ///this insert every new record to the database but only when the record is new.
    }else{
        $insert = "INSERT into players (email_add,wins,losses,played_date) Values(?,?,?,?)";
        $i_stmt = $dbh -> prepare($insert);

        if($result = true){
            $params_i = [$email,'1','0',date("Y-M-d")];
        }else{
            $params_i = [$email,'0','1',date("Y-M-d")];
        }
        
        $success_i = $i_stmt -> execute($params_i);

    }

    
    $command_win = "SELECT * FROM players Where email_add = ?";
    $stmt_win = $dbh -> prepare($command_win);
    $params_win = [$email];
    $success_win = $stmt_win -> execute($params_win);

    $win = $stmt_win->fetch();

    //display all information of the player including his past history
    
    echo "<br> Email: ".$win["email_add"]."<br> Wins:".$win["wins"]."<br> Losses:".$win["losses"]."<br> Last Played :".date("Y-M-d")."<br>";
    
    //displaying top 10 players from the database
    echo "<br><br>TOP 10 Players!!<br>";

    $command_10 = "SELECT * from players ORDER by wins DESC LIMIT 10 ";
    $stmt_10 = $dbh -> prepare($command_10);
    
    $success_10 = $stmt_10 -> execute();

    $top_10 = $stmt_10 -> fetch();

    //printing top 10 players
    foreach($top_10 as $t){
        echo "<br>".$top_10['email_add']."<br> Wins:".$top_10['wins']."<br>";
    }
?>
<!-- Printing link for playing again -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/wumpus.css">
    <title>Result</title>
</head>
<body>
    
    <h2><a href="index.php">Wanna play again?? Click here</a></h2>
</body>
</html>