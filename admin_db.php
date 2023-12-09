<?php
    function is_valid_admin_login($email, $password){
        require_once('database.php');
        $db = getDB();
        $query = 'SELECT password FROM nutManagers WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if($row === false){
            return false;
        } else{
            $hash = $row['password'];
            return password_verify($password, $hash);
        }
    }

?>