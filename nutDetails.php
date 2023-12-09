<?php


    require_once('database.php');
    $db = getDB();

    $nut_ID = $_GET["nutID"];
    // Get values for selected nutID
    $queryProducts = 'SELECT * FROM nuts WHERE nutID = :nut_ID';
    $statement = $db->prepare($queryProducts);
    $statement->bindValue(':nut_ID', $nut_ID);
    $statement->execute();
    $nuts = $statement->fetch();
    $statement->closeCursor(); 

?>

<html>
    <title>Nut Stand</title>
    <link rel='stylesheet' href="details.css"/>
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
    </body>
    
    <main>

        <div class="values">
            <p class="nutName">Name: <?php echo $nuts['nutName']; ?></p>
            <p class="nutCat">Category ID: <?php echo $nuts['nutCategoryID']; ?></p>
            <p class="nutID">Nut ID: <?php echo $nuts['nutID']; ?> <p>
            <p class="nutCode"> Nut Code: <?php echo $nuts['nutCode']; ?> <p>
            <p class="desc"> Nut Description: <?php echo $nuts['description']; ?> <p>
            <p class="price"> Nut Price: <?php echo $nuts['price']; ?> <p>
            <p class="date"> Date Added: <?php echo $nuts['dateAdded']; ?> <p>
        </div>
        
        <img id="nutPictures" src="/at857/nutStand/images/<?php echo $nut_ID?>.jpg" alt=" <?php echo $nut_ID?>Picture"/>
 

            <script>
                const img = document.getElementById('nutPictures');

                const orgImg = "/at857/nutStand/images/<?php echo $nut_ID?>.jpg";

                const newImg = "/at857/nutStand/images/<?php echo $nut_ID?>blur.jpg"

                function mouseOver(){
                    img.setAttribute('src', newImg);
                }

                function mouseOut(){
                    img.setAttribute('src', orgImg);
                }

                img.addEventListener('mouseover', mouseOver);
                img.addEventListener('mouseout', mouseOut);

            </script>

    </main>
</html>
