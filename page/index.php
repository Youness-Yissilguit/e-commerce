<?php
     session_start() ;
    include '../includes/connect.php' ;
    // recuperer les produit de la bd
    $sql = "SELECT prod_id,nom,prix,src FROM produit LIMIT 4 ";
    $result = mysqli_query($conn, $sql);
    $produit = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);
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
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png" />
    </head>
    <body>
    <?php include '../includes/navbar.php' ?>

        <header>
            <div class="container">
                <div class="contetn_wrapper">
                    <div class="content">
                        <h1>BIENVENU DANS TECHSHOP</h1>
                        <p>Les spécialistes de TECHSHOP ont sélectionné pour vous un large choix d'accessoires indispensables à votre ordinateur portable. </p>
                        <a href="produit.php">Achetter mantenent !</a>
                        <span>solde 15% jusqu’a 27 mai.</span>
                    </div>
                    <div class="content_img">
                        <img src="../assets/bg11.jpg" alt="">
                        <img src="../assets/bg22.jpg" alt="">
                    </div>
                </div>
            </div>
        </header>

        <section id="categorie">
            <div class="container">
                <div class="categirie_container">
                    <div class="cat_box casque">
                        <a href=" produit.php?catname=casque">
                            Achetez maintenant
                            <img src="../assets/arrow.svg" alt="">
                        </a>
                    </div>
                    <div class="cat_box kyeboard">
                        <a href=" produit.php?catname=clavier" >
                            Achetez maintenant
                            <img src="..//assets/arrow.svg" alt="">
                        </a>
                    </div>
                    <div class="cat_box camera">
                        <a href=" produit.php?catname=camera">
                            Achetez maintenant
                            <img src="../assets/arrow.svg" alt="">
                        </a>
                    </div>
                    <div class="cat_box mouse">
                        <a href=" produit.php?catname=souris">
                            Achetez maintenant
                            <img src="../assets/arrow.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="bestSales">
            <div class="container">
                <h2>Produit recent</h2>

                <div class="product">
                    <?php foreach($produit as $pro) { ?>

                    <div class="card">
                        <img src="../assets/<?php echo $pro['src'] ;?>.png" alt="">
                        <p><?php echo $pro['nom'] ;?></p>
                        <h3 class="bold"><?php echo $pro['prix'] ;?> DH</h3>
                        <div class="twoBtn">
                            <a href="single_product.php?pid=<?php echo $pro['prod_id']?> " class="buy" > Achetter</a>

                        </div>
                    </div>
                    <?php } ?>



                </div>
            </div>
        </section>

        <section id="promotion">
            <div class="">
                <div class="promo">
                    <a href="produit.php"> <img src="../assets/promo1.png  " ></a>
                    <a href="produit.php"> <img src="../assets/promo.png"> </a>
                </div>
            </div>
        </section>

        <section id="sponsor">
            <div class="">
                <div class="spons">
                    <img src="../assets/Group.png">
                    <img src="../assets/paypal.png">
                    <img src="../assets/visa.png">
                    <img class="bye" src="../assets/Group.png" >
                    <img class="bye" src="../assets/paypal.png">
                    <img class="bye" src="../assets/visa.png">
            </div>

            </div>
        </section>

        <footer>
            <div class="container">
                <div class="foot">
                    <img src="../assets/logo2.png">
                    <div class="links">
                        <a href="index.php">Accueil</a>
                        <a href="produit.php">Produits</a>
                        <a href="panier.php">Panier</a>
                    </div>
                    <p>copyright2021 All right reserved | made by youness and el ghali</p>
                </div>
                </div>

            </div>
        </footer>
        <script src='../js/index.js'></script>
    </body>
</html>
