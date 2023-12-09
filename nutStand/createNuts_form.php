<?php
    require_once('database.php');
    $db = getDB();
    $query = 'SELECT * FROM nutCategories ORDER BY nutCategoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $allCategories = $statement->fetchAll();
    $statement->closeCursor();
?>




<html>
    <head>
        <title>Nut Stand</title>
        <link rel="stylesheet" href="createStyle.css">
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <form action='add_nut.php' method='post' id='validateThis'>
        <div class='selection'>
            <label class='catLabel'>Nut Category:</label>
            <select name="nutCategory_ID">
            <?php foreach($allCategories as $category) : ?>
                <option value="<?php echo $category['nutCategoryID']; ?>">
                    <?php echo $category['nutCategoryName'];?>
                </option>
            <?php endforeach ?>
        </select>
        </div>
        <br>
        <div class='inputs'>
        <label>Nut Code:</label>
        <input id='code' class='codeStyle' type='text' name='code'>
        <span id='codeError'></span>
        <br>
        <label>Nut Name:</label>
        <input id='name' class='nameStyle' type='text' name='name'>
        <span id='nameError'></span>
        <br>
        <label>Nut Description:</label>
        <input id='desc' class='descStyle' type='text' name='desc'>
        <span id='descError'></span>
        <br>
        <label>Nut Price:</label>
        <input id='price' class='priceStyle' type='text' name='price'>
        <span id='priceError'></span>
        <br>
        <input id="resetButton" type="button" value="Reset"/> 
        <input class='submitStyle' type='submit' value='Add Nut'>
        </div>

        
        </form>

        <script>
        
            $(document).ready(function() {
                $('#validateThis').submit(event => {
                    let isValid = true;
                
                    const name = $('#name').val();
                    const code = $('#code').val();
                    const desc = $('#desc').val();
                    const price = $('#price').val();
                    
                    if(name === ""){
                        $('#nameError').text("This field is required.");
                        isValid = false;
                    } else if(name.length < 10 || name.length > 100){
                        $('#nameError').text("Name should be within 10 to 100 characters");
                        isValid = false;
                    }else{
                        $('#nameError').text("");
                    }
                    
                    if(code === ""){
                        $('#codeError').text("This field is required.");
                        isValid = false;
                    } else if(code.length < 4 || code.length > 10){
                        $('#codeError').text("Code should be within 4 to 10 characters");
                        isValid = false;
                    }else{
                        $('#codeError').text("");
                    }

                    if(desc === ""){
                        $('#descError').text("This field is required.");
                        isValid = false;
                    } else if(desc.length < 10 || desc.length > 255){
                        $('#descError').text("Description should be within 10 to 255 characters");
                        isValid = false;
                    }else{
                        $('#descError').text("");
                    }

                    if(price === ""){
                        $('#priceError').text("This field is required.");
                        isValid = false;
                    } else if(isNaN(price)){
                        $('#priceError').text("The price should be a number value.");
                        isValid = false;
                    } else if(price <= 0 || price > 100000){
                        $('#priceError').text("The price cannot be 0 or lower and cannot exceed 100000.");
                        isValid = false;
                    } else{
                        $('#priceError').text("");
                    }
                
                    if(isValid == false){
                        event.preventDefault();
                    }
                });
            });
        
        $(document).ready(function(){
            $("#resetButton").click(event => {
                $('#name').val("");
                $('#code').val("");
                $('#desc').val("");
                $('#price').val("");

            })
        })
    </script>

    </body>
</html> 