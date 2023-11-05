<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style2.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    
    <body>
        <div class="container site">
           
            <?php
                require 'admin/database.php';
                echo ' <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="text-logo" href="logout.php"><span class="bi-shop"></span>BurgerCode<span class="bi-shop"></span></a>
                        </div>
                       <ul class="nav navbar-nav navbar-right">';

                $db = Database::connect();
                $statement=$db->query('select * FROM categories');
                $categories=$statement->fetchAll();
                foreach($categories as $category){
                    if($category['id']=='1')
                        echo'<li role="presentation" class="active"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['name'] . '</a></li>';
                    else
                        echo'<li role="presentation"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['name'] . '</a></li>';
                    
                }
                echo'</ul>
                </div>
                        </nav>';

                echo '<div class="tab-content">';
                foreach($categories as $category){
                    if($category['id']=='1')
                    echo'<div class="tab-pane active" id="'.$category['id'].'">';
                else
                    echo'<div class="tab-pane" id="' .$category['id'].'">';
                echo '<div class="row">';
                $statement= $db->prepare('select * FROM items WHERE items.category=?');
                $statement->execute(array($category['id']));
                while($item = $statement->fetch()){
                    echo '<div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="images/'.$item['image']. '" alt="...">
                        <div class="price">'.number_format((float) $item['price'],2,'.','').' €</div>
                        <div class="caption">
                            <h4>'. $item['name'] .'</h4>
                            <p>'.$item['description'].'</p>
                            <a href="view.php?id='.$item['id'].'" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Voir le détail</a>
                        </div>
                    </div>
                </div>

                ';
                
                }
                echo '</div>
                        </div>';
            }
                Database::disconnect();
                echo '</div>';
                ?>


            <script type="text/javascript">

// Get the modal
var modal = document.getElementById('popup');

// Get the button that opens the modal
var btn = document.getElementById("ajouter");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

</script>




    </body>
</html>

