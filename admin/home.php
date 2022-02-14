<?php
  session_start();
  if(!isset($_SESSION["username"])){
    if($_SESSION['admin'] != 1){
      header('location: ../page/index.php');
    }
  }
  include '../includes/connect.php';
  $nmbUsers = 0;
  $nmbCommande = 0;
  $prixTotal = 0;
  //users
  $query = 'SELECT * FROM client WHERE autori != 1';
  $result = mysqli_query($conn, $query);
  $nmbUsers = mysqli_num_rows($result);
  //commandes
  $query = 'SELECT COUNT(clientRef) AS nmbCommande FROM commandde';
  $resultComd = mysqli_query($conn, $query);
  $nmbCommande =  mysqli_fetch_assoc($resultComd);
  $nmbCommande = $nmbCommande['nmbCommande'];
  //admin info
  $id = $_SESSION["id"];
  $sql = "SELECT * FROM client WHERE clientID = '$id' ";
  $result = mysqli_query($conn, $sql);
  $admin = mysqli_fetch_assoc($result) ;

  //revenue
  $query = 'SELECT * FROM commandde';
  $resultComd = mysqli_query($conn, $query);
  $comandes = mysqli_fetch_all($resultComd, MYSQLI_ASSOC);
  foreach ($comandes as $cmd) {
    $prodId=$cmd['produitRef'];
    $sql = "SELECT prix FROM produit WHERE prod_id='$prodId'";
    $result = mysqli_query($conn, $sql);
    $price = mysqli_fetch_assoc($result);
    $prixTotal += $price['prix'] * $cmd['quantite_D'];
  }
  //top seles
  $sql = 'SELECT SUM(quantite_D), produitRef
          FROM commandde GROUP BY produitRef
          ORDER BY SUM(quantite_D) DESC LIMIT 3 ';
  $result = mysqli_query($conn, $sql);
  $topSele = mysqli_fetch_all($result, MYSQLI_ASSOC);//

  //recent users
  $sql = "SELECT nom,prenom, email FROM client WHERE autori != 1 LIMIT 2";
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);//

  //recent commandes
  $sql = "SELECT * FROM commandde ORDER BY date_cmd LIMIT 2";
  $result = mysqli_query($conn, $sql);
  $cmds = mysqli_fetch_all($result, MYSQLI_ASSOC);//

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>admin</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png" />
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
          <li><a class="active" href="./home.php">Accueil</a></li>
            <li><a href="./admin_produit.php">Produits</a></li>
            <li><a href="./admin_users.php">membres</a></li>
            <li><a href="./admin_cmd.php">commandes et statistique</a></li>
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

      <section id="quick_info_container">
        <div class="q_info_box green">
          <img class="icon" src="../assets/user.svg" alt="">
          <div class="inf_text">
            <h2><?php echo $nmbUsers <10 ? "0" . $nmbUsers : $nmbUsers; ?></h2>
            <p>utilisateurs</p>
          </div>
        </div>
        <div class="q_info_box blue">
          <img class="icon" src="../assets/sale.svg" alt="">
          <div class="inf_text">
            <h2><?php echo $nmbCommande < 10 ? "0" . $nmbCommande : $nmbCommande; ?></h2>
            <p>comandes</p>
          </div>
        </div>
        <div class="q_info_box yellow">
          <img class="icon" src="../assets/surface.svg" alt="">
          <div class="inf_text">
            <h2><?php echo $prixTotal; ?> dh</h2>
            <p>revenu total</p>
          </div>
        </div>
      </section>

      <section id="recent_info_container">
        <div class="top_selling">
          <h2>top selling</h2>
          <div class="produit_container">
            <?php
            foreach ($topSele as $sele) {
              $prodId = $sele['produitRef'];
              $sql = "SELECT nom, prix, src FROM produit WHERE prod_id = '$prodId'";
              $result = mysqli_query($conn, $sql);
              $produit = mysqli_fetch_assoc($result);
             ?>
            <div class="top_p">
              <img src="../assets/<?php echo $produit['src'];?>.png" alt="">
              <h3><?php echo $produit['nom']; ?></h3>
              <h4><?php echo $produit['prix']; ?>dh</h4>
              <p class="quantité"><?php echo $sele['SUM(quantite_D)']; ?></p>
            </div>
          <?php } ?>
          </div>

        </div>
        <div class="last_user">
          <h3>recent users</h3>
          <?php foreach ($users as $user) {?>
          <div class="user">
            <h4><?php echo $user['nom']. " " . $user['prenom']?></h4>
            <p><?php echo $user['email'] ?></p>
          </div>
        <?php } ?>
        </div>
        <div class="last_commande">
          <h3>recent commandes</h3>
          <?php
          foreach ($cmds as $cmd) {
            $prod_id = $cmd['produitRef'];
            $user_id = $cmd['clientRef'];
            $sql = "SELECT nom, prix FROM produit WHERE prod_id = '$prod_id'";
            $result = mysqli_query($conn, $sql);
            $produit = mysqli_fetch_assoc($result);
            $sql = "SELECT nom FROM client WHERE clientID = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
           ?>
          <div class="commande">
            <div class="">
              <h4><?php echo $produit['nom']; ?></h4>
              <p>by <?php echo $user['nom']; ?></p>
            </div>
            <h3><?php echo $produit['prix']; ?>dh x <?php echo $cmd['quantite_D']; ?></h3>
          </div>
        <?php } ?>
        </div>
      </section>

      <script>
      document.getElementById("open_nav_btn").addEventListener("click", () =>{
          document.getElementById("left_nav").classList.toggle("open_left_nav");
      })
      </script>
    </body>
</html>
