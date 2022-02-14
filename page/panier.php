<?php
    session_start() ;
    include '../includes/connect.php' ;
    $prixTotal = 0 ;
    $nbrPiece = 0 ;
    if (!isset(  $_SESSION['username'] ) )
    {
        header('location: account.php') ;
    }
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM client WHERE clientID = '$id' ";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result) ;

    $msg ="votre panier est vide" ;
    if (isset($_POST['buy'] ))
    {
        if ( empty($_SESSION["panier"]) ){
            $msg ="Votre panier est vide " ;
        }
        else {
            foreach ($_SESSION["panier"] as $key => $value){
                $sql = "INSERT INTO commandde (clientRef , produitRef , quantite_D ) values ('$id',$key,$value)" ;
                if  ( !mysqli_query($conn, $sql) )
                {
                    echo 'commande error: ' . mysqli_error($conn);
                    $msg = 'commande error: ' .  mysqli_error($conn);
                }
                $sql = "SELECT stock FROM produit WHERE prod_id = $key ";
                $result = mysqli_query($conn, $sql);
                $stk = mysqli_fetch_assoc($result) ;
                $stok = $stk['stock'] - $value ;
                $sql = "UPDATE produit SET stock = $stok WHERE prod_id = $key " ;
                $result = mysqli_query($conn, $sql);

                if  ( !mysqli_query($conn, $sql) ){
                    echo 'commande error: ' . mysqli_error($conn);
                    $msg = 'commande error: ' .  mysqli_error($conn);
                }
            }
            unset($_SESSION["panier"]);
            header('location: panier.php');
    }
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
    <link rel="stylesheet" href="../css/panier.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png">
</head>

<body>
<?php include '../includes/navbar.php' ?>

        <section id="panier">
            <div class="container">
                <h1 class="heading"> Votre panier :</h1>

                <div class="rect">

                  <div class="product">
                    <?php
                    if (! isset ($_SESSION["panier"]))
                        echo "<p class='alert success'>" . $msg . "</p>";
                    else  {
                    foreach ($_SESSION["panier"] as $key => $value)
                    {
                        $sql = "SELECT * FROM produit WHERE prod_id = $key ";
                        $result = mysqli_query($conn, $sql);
                        $prod = mysqli_fetch_assoc($result) ;
                        $nbrPiece += $value ;
                        $prixTotal = $prixTotal + ( $value * $prod['prix'] ) ;
                    ?>
                      <div class="produit">
                              <img src="../assets/<?php echo $prod['src'] ;?>.png">
                              <h3><?php echo $prod['nom'] ;?></h3>
                              <p><?php echo $prod['prix'] ;?>dh</p>
                              <div class="nbr"> <?php echo $value ;?></div>
                      </div>
                    <?php }} ?>

                    </div>
                    <div class="fiche">
                        <h4>Nom:</h4>
                        <p><?php echo $user['nom'] ;?></p>
                        <h4>E-mail:</h4>
                        <p><?php echo $user['email'] ;?></p>
                        <h4>Adresse:</h4>
                        <p><?php echo $user['address'] ;?></p>
                        <h4>Prix total:</h4>
                        <p class="price_t"><?php echo $prixTotal ;?> DH </p>
                        <h4>Nombre de piece:</h4>
                        <p><?php echo $nbrPiece ;?></p>
                        <form method="POST" action="panier.php">
                            <input type="submit" value="Acheter" class="btn" name="buy">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src='../js/index.js'></script>
      </body>
</html>
