<!-- Ahash Thirukumaran, 10/20/2023, IT 202-005, Unit 3 HW, at857@njit.edu --> 

<?php

    function getDB(){
        $njit_dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=at857';
        $njit_username = 'at857';
        $njit_password = 'ToastedIce123321$$$$';

        $dsn = $njit_dsn;
        $username = $njit_username;
        $password = $njit_password;

        try{
            $db = new PDO($dsn, $username, $password);
            //echo '<p>You are connected the the database</p>';
        } catch(PDOException $exception){
            $error_message = $exception->getMessage();
            include('database_error.php');
            exit();
        }
        // NEW LINES
        return $db;
    }
?>