<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/

include("includes.php"); // Contain all necessary include files 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
    Welcome Home
    </title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body style="background: rgb(190, 211, 190)">
    <div class="menu"> <?php include("nav_menu.php"); ?> </div>
    <div class="form">
       
        <p> <h2 style="text-align:center;"> Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>! </h2> </p>
            
            <?php if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") { ?>
                        <h3 style="text-align:center;">  Have a good day of work </h3>
            <?php } else { ?>
                         <h3 style="text-align:center;">  Happy Shopping </h3>
            <?php } ?>
            
            <br />
            <br />
            <br />
            <br />
    </div>
</body>

</html>