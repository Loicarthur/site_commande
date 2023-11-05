<?php
require 'admin/database.php';
if(!empty($_GET['id'])){
    $id=checkInput($_GET['id']);
}
$db=Database::connect();
$statement=$db->prepare('select items.id, items.name,items.description,items.price,items.image,categories.name AS category 
FROM  items left join categories on items.category = categories.id
where items.id=?');
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();




function checkInput($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    
<body>


<div class="container">
    <div class="row">
        
        <div class="col-sm-8 col-md-offset-2 site">
                                <div class="thumbnail">
                                    <img src="<?php echo'./images/'.$item['image'];?>" alt="...">
                                    <div class="price"><?php echo number_format((float)$item['price'],2,'.','') . ' €'; ?></div>
                                    <div class="caption">
                                        <h4><?php echo''.$item['name']; ?></h4>
                                        <p><?php echo''.$item['description']; ?></p>
                                        <?php echo'<div class="row">
                                <div class="col-sm-8">
                                    <a class="btn btn-primary btn-lg" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                                  </div>
                                <div class="col-sm-4">
                                    <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                                </div>
                          </div>'; ?>
                                    </div>
                                </div>
                            </div>

        
    </div>





</body>



</html>