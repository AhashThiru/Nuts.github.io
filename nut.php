<!-- Ahash Thirukumaran, 10/20/2023, IT 202-005, Unit 3 HW, at857@njit.edu --> 

<?php
require_once('database.php');
$db = getDB();
// Get all categories 
$query = 'SELECT * FROM nutCategories ORDER BY nutCategoryID';
$statement = $db->prepare($query);
$statement->execute();
$allCategories = $statement->fetchAll();
$statement->closeCursor();

// Get category ID
if(!isset($_GET['nutCategoryID'])){
    $nutCategory_ID = 1;
} else{
    $nutCategory_ID = $_GET['nutCategoryID'];
if($nutCategory_ID == NULL || $nutCategory_ID == FALSE){
    $nutCategory_ID = 1;
}
}

// Get name for selected category
$queryCategory = 'SELECT * FROM nutCategories WHERE nutCategoryID = :nutCategory_ID';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':nutCategory_ID', $nutCategory_ID);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['nutCategoryName']; 
$statement1->closeCursor();


// Get nuts for selected category 
$queryProducts = 'SELECT * FROM nuts WHERE nutCategoryID = :nutCategory_ID ORDER BY nutID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':nutCategory_ID', $nutCategory_ID);
$statement3->execute();
$nuts = $statement3->fetchAll();
$statement3->closeCursor(); 


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
    </body>
    <h2>Nut Category </h2>
            <ul>
                <?php foreach ($allCategories as $category) : ?>
                    
                        <br>
                        <a href="?nutCategoryID=<?php 
                            echo $category['nutCategoryID'];?>">
                        <?php echo $category['nutCategoryName'] ?></a>
                   
                    <br>
                <?php endforeach; ?>
            </ul>
            <section>
                <h3><?php echo $category_name; ?></h3>
                <table>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Date Added</th>
                    </tr>
                    <?php foreach($nuts as $nut) : ?>
                        <tr>
                            <td> <a href="nutDetails.php?nutID=<?php echo $nut['nutID'];?>"> <?php echo $nut['nutCode' ]?> <a></td>
                            <td> <?php echo $nut['nutName']?></td>
                            <td> <?php echo $nut['description']?></td>
                            <td> <?php echo '$'. $nut['price']?></td>
                            <td> <?php echo $nut['dateAdded']?></td>
                            <td>
                            <?php 
                                //session_start();
                                if (isset($_SESSION['is_valid_admin'])) { 
                                ?>
                                <form action="delete_nut.php" method="post" id="deleteNut">
                                    <input type="hidden" name="nut_ID"
                                    value="<?php echo $nut['nutID']; ?>"/>

                                    <input type="hidden" name="nutCategoryID" 
                                    value="<?php echo $nut['nutCategoryID']; ?>" />
                                    <input id="sub" type="submit" value="DELETE"/>
                                </form>
                                <?php }?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <script>

                        function deletion(){
                            alert("Nut was not deleted.");
                        }

                        document.querySelectorAll("#deleteNut").forEach(function(form){
                            form.addEventListener("submit", function(event){
                                const confirmDelete = confirm("Are you sure you want to delete this nut?");
                                if(!confirmDelete){
                                    event.preventDefault();
                                    deletion();
                                }
                            });
                        });

                    </script>

                </table>
            </section>
    
</html>





