<?php

    session_start();
    if (!( isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) ){
        header('location: ../page/index.php');
    }
    include '../includes/connect.php' ;
    $sql = " SELECT * FROM produit  " ;
    $result = mysqli_query($conn, $sql);
    $prod = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //admin info
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM client WHERE clientID = '$id' ";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_pro.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png">

</head>
<body>
  <nav id="left_nav">
    <img class="logo" src="../assets/logo.svg" alt="">
    <div class="admin_inf">
      <img src="../assets/avatar3.jpg" alt="">
      <h4><?php echo $admin['nom'] . " " . $admin['prenom']; ?></h4>
        <p><?php echo $admin['email']; ?></p>
    </div>
    <ul class="dash_links">
        <li><a href="./home.php">Accueil</a></li>
        <li><a class="active" href="./admin_produit.php">Produits</a></li>
        <li><a href="./admin_users.php">membres</a></li>
        <li><a href="admin_cmd.php">commandes et statistique</a></li>
        <li><a href="../page/logout.php">logout</a></li>
    </ul>
  </nav>
  <div id="top_nav">
    <div class="">
      <h2>welcom back <?php echo $admin['prenom'] ?></h2>
      <p>TechShop > tableau de bord</p>
    </div>
    <img id="open_nav_btn" src="../assets/nav_open.svg" alt="">
  </div>
  <section id="produit">
      <div class="containe">
         <div class="box">
              <h1>Produit</h1>
              <div class="bare">
                  <p>#</p>
                  <p>nom</p>
                  <p>prix</p>
                  <p>description</p>
                  <p>quantite</p>
                  <p></p>
              </div>
              <?php foreach($prod as $pro) { $pro['libelle'] = substr ($pro['libelle'],0,100) ; ?>
              <div class="onePro">
                  <img src="../assets/<?php echo $pro['src'] ;?>.png">
                  <h2><?php echo $pro['nom'] ;?></h2>
                  <h3><?php echo $pro['prix'] ;?> </h3>
                  <p><?php echo $pro['libelle']  ;?>...</p>
                  <div class="nbr"><?php echo $pro['stock'] ;?></div>
                  <a href="admin_mod_pro.php?id_produit=<?php echo $pro['prod_id'] ; ?>">
                      modifier
                      <img src="../assets/mod_icon.svg">
                  </a>
                  </div>
              <?php } ?>
          </div>
      </div>
  </section>
  <script>
  document.getElementById("open_nav_btn").addEventListener("click", () =>{
      document.getElementById("left_nav").classList.toggle("open_left_nav");
  })
  </script>
</body>
</html>
