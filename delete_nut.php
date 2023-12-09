<?php

    require_once('database.php');
    // get the ids
    $db = getDB();
    $nut_ID = filter_input(INPUT_POST, "nut_ID", FILTER_VALIDATE_INT);
    $nutCategoryID = filter_input(INPUT_POST, "nutCategoryID", FILTER_VALIDATE_INT);

    if($nut_ID != FALSE && $nutCategoryID != FALSE){
        // delete product from database
        $query = 'DELETE FROM nuts WHERE nutID = :nut_ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':nut_ID', $nut_ID);
        $statement->execute();
        $statement->closeCursor();
    }
?>

<html>

<title>Nut Stand</title>
    <link rel='stylesheet' href="nutStyle.css"/>
    <link rel="icon" type="image/png" href="images/nut.png">

    <body>
        <h1>Nutty Time <img class="logo" src="/at857/nutStand/images/nut.png" alt="nutLogo"/></h1>
        <?php 
        session_start();
        if (isset($_SESSION['is_valid_admin'])) { 
    ?>

        <form action="createNuts_form.php">
            <input class="createNutsButton" type="submit" value="Create Nuts"/>
        </form>

        <form action='shipping.php'>
            <input class='shipButton' type='submit' value='Shipping'/>
        </form>

        <form action='home.php'>
            <input class='homeButton1' type="submit" value="Home"/>
        </form>
        
        <form action='nut.php'>
            <input class='nutButton1' type='submit' value='Nut Page'/>
        </form>

        <span class='headerLine'></span>

        <p> <a class='loginStyle' href="logout.php">Logout</a> </p>

        <p class='welcomeMess'><?php echo ("Hello ". $_SESSION['firstN'] . " " . $_SESSION['lastN'] . "! : " . $_SESSION['email']); ?></p>

     <?php } else { ?>

        <p> <a class='loginStyle' href="login.php">Login</a> </p>

        <form action='home.php'>
            <input class='homeButton2' type="submit" value="Home"/>
        </form>

        <form action='nut.php'>
            <input class='nutButton2' type='submit' value='Nut Page'/>
        </form>

        <span class='headerLine2'></span>

     <?php } ?>

     <span class="deletedNut">Nut with ID <?php echo $nut_ID;?> has been deleted.</span>
    </body>

</html>