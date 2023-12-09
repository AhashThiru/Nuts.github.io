<html>
    <head>
        <title>Nut Stand</title>
        <link rel="stylesheet" href="logStyle.css">
        <link rel="icon" type="image/png" href="images/nut.png">

        <h1>Nutty Time <img class="logo" src="/at857/nutStand/images/nut.png" alt="nutLogo"/></h1>
        <?php 
        if(!isset($_SESSION)){
            session_start();
        }
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
    
        <?php
       function add_nut_manager($email, $password, $firstName, $lastName) {
            require_once("database.php");
            $db = getDB();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = 'INSERT INTO nutManagers (emailAddress, password, firstName, lastName)
                    VALUES (:email, :password, :firstName, :lastName)';
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $hash);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->execute();
            $statement->closeCursor();
        }

        //add_nut_manager("newE@gmail.com", "newPassword", "Ahash", "Thirukumaran")
        //add_nut_manager("someE@email.com", "password", "John", "Smith");
        //add_nut_manager("eminence@gmail.com", "shadow", "Cid", "Kag");
        ?>

        <form action="authenticate.php" method="post">
                <?php if (!empty($login_message)) { ?>
                    <p><?php echo $login_message; ?></p>
                <?php } ?>

                <label>Email Address:</label>
                <input type='text' name='email'/>
                <br>
                <label>Password</label>
                <input type='text' name='password'/>
                <br>
                <input type='submit' value='Login' class="submitButton">
        </form>
    </body>
</html>