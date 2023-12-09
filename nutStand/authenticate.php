<?php

    require_once('admin_db.php');
    require_once('database.php');

  
    session_start();

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');


    if(is_valid_admin_login($email, $password)){
        $_SESSION['is_valid_admin'] = true;
        $db = getDB();

        $query = 'SELECT * FROM nutManagers WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $names = $statement->fetch();
        $firstName = $names['firstName'];
        $lastName = $names['lastName'];
        $statement->closeCursor();

        $_SESSION['firstN'] = $firstName;
        $_SESSION['lastN'] = $lastName;
        $_SESSION['email'] = $email;
        
        include('home.php');

    } else{
        if($email == NULL && $password == NULL){
            $login_message = 'You must login to view this page.';
        } else {
            $login_message = 'Invalid Credentials.';
        }

        include('login.php');
    }


?>

<html>

    <head>
        <link rel="stylesheet" href="logStyle.css">
    </head>

</html>