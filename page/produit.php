<?php
    include '../includes/connect.php' ;
    session_start();
    if(isset( $_GET['catname'] ) )
    {
        $ctn = $_GET['catname'];
        $ctn = mysqli_real_escape_string($conn, $ctn);
        $sql = " SELECT * FROM produit WHERE categorie = '$ctn' " ;
        $result = mysqli_query($conn, $sql);
        $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else if (isset( $_POST['search']))
    {
        $cat = $_POST['Categorie'] ;
        $ord = $_POST['trie'] ;
        if ($cat == '*')
             $sql = " SELECT * FROM produit ORDER BY prix $ord LIMIT 8 " ;
        else
            $sql = " SELECT * FROM produit WHERE categorie = '$cat' ORDER BY prix $ord " ;
        $result = mysqli_query($conn, $sql);
        $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $sql = " SELECT * FROM produit LIMIT 8 " ;
        $result = mysqli_query($conn, $sql);
        $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="../css/produit.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png">
</head>
<body>
    <?php include '../includes/navbar.php' ?>

    <section id="bare" >
        <div class="container">
          <form method="POST" action="produit.php" id="formSearch">
                    <div>
                    <label>Trier par</label>
                    <select name="trie" >
                         <option value="ASC">Prix croissant</option>
                        <option value="DESC">Prix decroissant</option>
                    </select>
                    </div>
                    <div>
                    <label>Categorie</label>
                    <select name="Categorie" >
                        <option value="*">Tous</option>
                        <option value="Casque">Casque</option>
                        <option value="Souris">Souris</option>
                        <option value="Clavier">Clavier</option>
                        <option value="Camera">Camera</option>
                    </select>
                    </div>
                <input type="submit" value="search" name="search" class="btn-src">
         </form>
        </div>
    </section>
    <section id="prd" >
        <div class="container">
            <div class="produit">
               <?php foreach($prod as $pro) {?>
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
</body>
