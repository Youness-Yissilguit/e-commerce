<?php

    session_start();
    if (!( isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) ){
        header('location: ../page/index.php');
    }
    if (!isset ($_GET["id_produit"] ) )
       header('location: admin_produit.php');

    include '../includes/connect.php' ;
    if ( isset($_POST['mod']) ) {
        $nom =  $_POST['nom'] ;
        $prix = $_POST['prix'] ;
        $des = $_POST['description'] ;
        $stk = $_POST['stock'] ;
        $id = $_POST['id'] ;
        $sql = "UPDATE produit SET stock = '$stk' , prix = '$prix' , nom = '$nom'  WHERE prod_id = $id ";
        $result = mysqli_query($conn,$sql);
        header('location: admin_produit.php') ;
        // update description doesn't work
    }
    if( isset($_POST['sup']) ){
        $id = $_POST['id'] ;
        $sql = "DELETE FROM produit WHERE prod_id = $id" ;
        $result = mysqli_query($conn,$sql);
        header('location: admin_produit.php');
    }

    $id = $_GET["id_produit"]  ;
    $sql = "SELECT * FROM produit WHERE prod_id = $id ";
    $output = mysqli_query($conn, $sql);
    $prod = mysqli_fetch_assoc($output);

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
    <title><?php echo $prod['nom']; ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_mod_pro.css">
    <link rel="stylesheet" href="../css/admin.css">
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

  <section id="modifier">
      <h1> Modifier le produit</h1>
      <div class="mod_from">
          <form method="POST" action="admin_mod_pro.php">
              <input type="text" name="id" class="hide" value="<?php echo $prod['prod_id']; ?>">
              <label>Nom</label>
              <input type="text" name="nom"  value="<?php echo $prod['nom']; ?>"required>
              <div class="form_grp">
                <div>
                  <label >Prix en DH</label>
                  <input type="number" min="0" name="prix" value="<?php echo $prod['prix']; ?>" required>
                </div>
                <div class="">
                  <label>Stock</label>
                  <input type="number" name="stock" min="0" value="<?php echo $prod['stock']; ?>" required>
                </div>
              </div>
              <label>Description</label>
              <textarea name = "description" required> <?php echo $prod['libelle']; ?></textarea>
              <div class="btn" >
                  <input type="submit" name="mod" class="modi" value="Modifier">
                  <input type="submit" name="sup" class="sup" value="Supprimer">
              </div>
          </form>
      </div>
  </section>

  <script>
  document.getElementById("open_nav_btn").addEventListener("click", () =>{
      document.getElementById("left_nav").classList.toggle("open_left_nav");
  })
  </script>
</body>
</html>
