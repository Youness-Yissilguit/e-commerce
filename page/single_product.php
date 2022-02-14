<?php
    session_start() ;
    if (!isset($_SESSION['panier']))
         $_SESSION['panier'] = array();

    include '../includes/connect.php' ;

    if (isset($_GET['pid'])) {
        $id = mysqli_real_escape_string($conn, $_GET['pid']);
        $sql = "SELECT * FROM produit WHERE prod_id = $id" ;
        $output = mysqli_query($conn, $sql);
        $details = mysqli_fetch_assoc($output);
        mysqli_free_result($output);
        $cat = $details['categorie'] ;

        $SQL = "SELECT prod_id,nom,prix,src FROM produit WHERE categorie = '$cat' AND prod_id != $id LIMIT 2" ;
        $result = mysqli_query($conn, $SQL);
        $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else if (isset($_POST['add_to_panier'])){
        if (!isset($_SESSION['username'])){
            header('location: account.php');
        }
        else{
        //afficher prd
        $id =  $_POST['idp'] ;
        $sql = "SELECT * FROM produit WHERE prod_id = $id" ;
        $output = mysqli_query($conn, $sql);
        $details = mysqli_fetch_assoc($output);
        
        $cat = $details['categorie'] ;
        $SQL = "SELECT prod_id,nom,prix,src FROM produit WHERE categorie = '$cat' AND prod_id != $id LIMIT 2" ;
        $result = mysqli_query($conn, $SQL);
        $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    

        //ajouter au panier
        $qte = $_POST['quantite'];
        $id = $_POST['idp'] ;
        $id = strval($id) ;
        $arr = array( "'".  "$id" ."'" => $qte) ;
        if (array_key_exists("'".  "$id" ."'",$_SESSION['panier'])){
            $_SESSION['panier']["'".  "$id" ."'"] = $_SESSION['panier']["'".  "$id" ."'"] + $qte ;
        } else
            $_SESSION['panier'] = array_merge($_SESSION['panier'] , $arr) ;}
    }
    else{
        header('location: index.php') ;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TechShop</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/single_product.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png" />
    </head>
    <body>
    <?php include '../includes/navbar.php' ?>

        <section id="product_details">
            <div class="container">
                <div class="p_wrapper">
                    <div class="product_img">
                        <img src="../assets/<?php echo $details['src'] ;?>.png" alt="">
                    </div>
                    <div class="product_desc">
                        <h1 class="p_title"><?php echo $details['nom']; ?></h1>
                        <h2 class="p_price"><?php echo $details['prix']; ?>Dh</h2>
                        <img src="../assets/rate<?php echo $details['note'];?>.png" alt="">
                        <h4>Description</h4>
                        <p class="p_desc"><?php echo $details['libelle']; ?></p>
                        <form class="add" action="single_product.php" method="POST" >
                            <input type="number" name="quantite" value="1" min="1" max="<?php echo $details['stock'];?> ">
                            <input type="submit" name="add_to_panier" value="ajouter au panier">
                            <input type="text" name="idp" id="id_none" value = "<?php echo $details['prod_id']; ?>">
                        </form>
                        <div class="p_similair">
                            <p>produit similaires</p>
                        </div>
                        <div class="similar_product">
                            <?php foreach($prod as $sim) { ?>
                            <div class="s_p">
                                <div class="s_img">
                                   <a href="single_product.php?pid=<?php echo $sim['prod_id']; ?>"> <img src="../assets/<?php echo $sim['src'];?>.png" alt="">  </a>
                                </div>
                                <div>
                                    <h4><?php echo $sim['nom']; ?></h4>
                                    <p><?php echo $sim['prix']; ?> DH</p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src='./js/index.js'></script>
    </body>
</html>
