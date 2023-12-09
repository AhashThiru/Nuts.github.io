<!-- Ahash Thirukumaran, 10/20/2023, IT 202-005, Unit 3 HW, at857@njit.edu -->
<?php
// Filter data from shippin.php
$zipcode = filter_input(INPUT_POST, 'zipcode');
$length = filter_input(INPUT_POST, 'length', FILTER_VALIDATE_INT);
$width = filter_input(INPUT_POST, 'width', FILTER_VALIDATE_INT);
$weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_INT);  
$name = filter_input(INPUT_POST, 'name');
$street = filter_input(INPUT_POST, 'street');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$ship_date = filter_input(INPUT_POST, 'ship_date');
$order_number = filter_input(INPUT_POST, 'order_number');

// Error message declared 
$error_message = '';

if($weight >= 150){
    $error_message = 'Weight cannot exceed 150 lbs';
} else if($weight <= 0){
    $error_message = 'Weight has to be greater than 0';
} else if($width > 36){
    $error_message = 'Width cannot be longer than 36 inches';
} if($width <= 0){
    $error_message = 'Width has to be greater than 0';
} else if($length > 36){
    $error_message = 'Length cannot be longer than 36 inches';
} else if($length <= 0){
    $error_message = 'length has to be greater than 0';
} else if(!is_numeric($zipcode)){
    $error_message = 'Enter a proper zipcode.';
}

if($error_message != ''){
    include('shipping.php');
    exit();
}

?>


<html>
    <head>
        <title>Nut Stand</title>
        <link rel="stylesheet" href="shippingFStyle.css">
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
        <body>
            <fieldset>
                <br>
                <fieldset class="mailType">
                    <label>USPS: Priority Mail</label>
                </fieldset>
                <br>
                <br>
                <legend>Shipping Label</legend>
                <label style='color:white;font-weight:bold;'>Ship from:</label>
                <span> 120 McCaughty Ave, Edison, NJ, 07102</span>
                <br>
                <br>

                <label style='color:white;font-weight:bold;'>Ship to:</label>
                <span><?php echo $street . ", " . $city . ", " . $state; ?></span>
                <br>
                <br>

                <label style='color:white;font-weight:bold;'>Package Dimensions:</label>
                <span><?php echo $length . "\"" . " x " . $width . "\""; ?> </span>
                <br>
                <br>

                <label style='color:white;font-weight:bold;'>Package Weight:</label>
                <span><?php echo $weight . " lbs"; ?> </span>
                <br>
                <br>

                <label style='color:white;font-weight:bold;'>Order Number:</label>
                <span><?php echo $order_number; ?> </span>
                <br>
                <br>

                <label style='color:white;font-weight:bold;'>Ship Date:</label>
                <span><?php echo $ship_date;?> </span>
                <br>
                <br>

                <div class='tracking'>
                    <label>Tracking Number: </label>
                    <span>RH843992804CN</span>
                </div>

                <img class='barImage' src="/at857/nutStand/images/barcode-image.png" alt='barcode'>
            </fieldset>
        </body>

    </head>
</html>