<!--Ahash Thirukumaran, 10/20/2023, IT 202-005, Unit 3 HW, at857@njit.edu-->
<?php
    if(!isset($name)) {$name='';}
    if(!isset($street)) {$street='';}
    if(!isset($city)) {$city='';}
    if(!isset($state)) {$state='';}
    if(!isset($zipcode)) {$zipcode='';}
    if(!isset($ship_date)) {$ship_date='';}
    if(!isset($order_number)) {$order_number='';}
    if(!isset($width)) {$width='';}
    if(!isset($length)) {$length='';}
    if(!isset($weight)) {$weight='';}
?>

<html>
    <head>
        <title>Nut Stand</title>
        <link rel="stylesheet" href="shippingStyle.css">
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

     <?php } ?>
    </head>
    <body>
        <?php if(!empty($error_message)) { ?>
            <p class="error">
                <?php echo htmlspecialchars(($error_message)); ?>
            </p>
        <?php } ?>
        <!-- Creating all labels for text inputs -->
        <form action="shippingFinal.php" method="post">
            <fieldset>
                <legend>Shipping Details: </legend>
                <label>First and Last name:</label>
                <input type='text' name='name' id="name" value="<?php echo htmlspecialchars($name); ?>" />
                <br>
                <br>
                <label>Street Address:</label>
                <input type='text' name='street' id="street" value="<?php echo htmlspecialchars($street); ?>"/>
                <br>
                <br>
                <label>City:</label>
                <input type='text' name='city' id="city" value="<?php echo htmlspecialchars($city); ?>"/>
                <br>
                <br>
                <label>State:</label>
                <input type='text' name='state' id="state" value="<?php echo htmlspecialchars($street); ?>"/>
                <br>
                <br>
                <label>Zip Code:</label>
                <input type='text' name='zipcode' id="zipcode" value="<?php echo htmlspecialchars($zipcode); ?>"/>
                <br>
                <br>
                <label>Shipping Date (MM/DD/YYYY)</label>
                <input type='text' name='ship_date' id="ship_date" value="<?php echo htmlspecialchars($ship_date); ?>"/> 
                <br>
                
                <main class="packDetails">
                    <label>Order Numer:</label>
                    <input type='text' name='order_number' id="order_number" value="<?php echo htmlspecialchars($order_number); ?>"/>
                    <br>
                    <br>
                    <label>Package Weight:</label>
                    <input type='text' name='weight' id="weight" value="<?php echo htmlspecialchars($weight); ?>"/>
                    <br>
                    <br>
                    <label>Package Length:</label>
                    <input type='text' name='length' id='length' value="<?php echo htmlspecialchars($length); ?>"/>
                    <br>
                    <br>
                    <label>Package Width:</label>
                    <input type='text' name='width' id='width' value="<?php echo htmlspecialchars($width); ?>"/>
                    <br>
                    <br>
                </main>
                <input class='doneButton' type='submit' class='submit' value='Done'/>
            </fieldset>
        </form>
    </body>
</html>