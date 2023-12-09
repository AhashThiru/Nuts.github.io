<?php
    // Getting values from creatNuts form
    $nutCategory_ID = filter_input(INPUT_POST, 'nutCategory_ID', FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $desc = filter_input(INPUT_POST, 'desc');
    $price = filter_input(INPUT_POST, 'price');
    $date = date('Y-m-d H:i:s');

    // Field validations
    $error_message;

    function doubleCheck($code){
        include('database.php');
        $db = getDB();
        $nutCode = $code;
        $query = 'SELECT COUNT(*) as count FROM nuts WHERE nutCode = :nutCode';
        $statement = $db->prepare($query);
        $statement->bindValue(':nutCode', $nutCode);
        $statement->execute();
        $nut = $statement->fetch();
        $statement->closeCursor();
    
        if($nut['count'] > 0){
            $error_message="This nut is already in the system.";
        } else{
            echo "";
        }
    }

    
    doubleCheck($code); 

    if($nutCategory_ID == null || $nutCategory_ID == false || $code == null || $name == null || $desc == null || $price == null){
        $error_message = 'Invalid field inputs. Try again.'; 
        //echo $error_message;
    } else{
        // Add nut into database
        try{
            $db = getDB();
            $query = 'INSERT INTO nuts 
                (nutCategoryID, nutCode, nutName, description, price, dateAdded)
                VALUES
                (:nutCategory_ID, :code, :name, :desc, :price, :date)';
        
            $statement = $db->prepare($query);
            $statement->bindValue(':nutCategory_ID', $nutCategory_ID);
            $statement->bindValue(':code', $code);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':desc', $desc);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':date', $date);
            $statement->execute();
            $nuts = $statement->fetchAll();
            $statement->closeCursor();
        } catch(PDOException $exception){
            $error_message = "This nut is already in the system.";
        }
        
    }

?>

<html>
    <head>
        <title>Nut Stand</title>
        <link rel="stylesheet" href="add_nut_style.css">
        <link rel="icon" type="image/png" href="images/nut.png">
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

        <p class='welcomeMess'><?php echo("Welcome". $_SESSION['firstN'] . " " . $_SESSION['lastN'] . " !");?></p>

     <?php } ?>
    </head>

    <body>
        <h1><?php echo $name; ?> has been added!</h1>
    </body>
</html>