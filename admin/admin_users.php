<?php

    session_start();
    if (!( isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) ){
        header('location: ../page/index.php');
    }

    include '../includes/connect.php' ;

    if(isset($_GET['id_client'])){
      $clientToSup = $_GET['id_client'];
      $sql = " DELETE FROM client WHERE clientID = $clientToSup";
      if($result = mysqli_query($conn, $sql)){
        $sql = " DELETE FROM commandde WHERE clientRef = $clientToSup";
        if($result = mysqli_query($conn, $sql)){
          header('location: ./admin_users.php');
        }
      }
    }

    //get users
    $sql = " SELECT * FROM client WHERE autori != 1" ;
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //get admins
    $sql = " SELECT * FROM client WHERE autori = 1" ;
    $result = mysqli_query($conn, $sql);
    $admins = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //admin info
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM client WHERE clientID = '$id' ";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);




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
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin_user.css">
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
        <li><a href="./admin_produit.php">Produits</a></li>
        <li><a class="active" href="./admin_users.php">membres</a></li>
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

  <section id="users">
      <div class="containe">
         <div class="box">
              <div class="table_head">
                <h1>Utilisateurs</h1>
                <a href="./admin_ajout_user.php">Ajouter un utilisateur</a>
              </div>
              <div class="bare">
                  <p>#</p>
                  <p>prenom</p>
                  <p>nom</p>
                  <p>adress</p>
                  <p>email</p>
                  <p></p>
              </div>
              <?php
              $counter = 1;
              foreach($users as $user) {?>
              <div class="onePro">
                  <p class="text-center"><?php echo $counter++; ?></p>
                  <h2><?php echo $user['nom'] ;?></h2>
                  <h3><?php echo $user['prenom'] ;?> </h3>
                  <div class="text-center"><?php echo $user['address'];?></div>
                  <p><?php echo $user['email'] ;?></p>
                  <a class="supprim" href="admin_users.php?id_client=<?php echo $user['clientID'] ; ?>">
                      supprimer
                  </a>
                  </div>
              <?php } ?>
          </div>
          <div class="box">
               <div class="table_head">
                 <h1>Admin</h1>
               </div>
               <div class="bare">
                   <p>#</p>
                   <p>prenom</p>
                   <p>nom</p>
                   <p>adress</p>
                   <p>email</p>
                   <p></p>
               </div>
               <?php
               $counter = 1;
               foreach($admins as $admin) {?>
               <div class="onePro">
                   <p class="text-center"><?php echo $counter++; ?></p>
                   <h2><?php echo $admin['nom'] ;?></h2>
                   <h3><?php echo $admin['prenom'] ;?> </h3>
                   <div class="text-center"><?php echo $admin['address'];?></div>
                   <p><?php echo $admin['email'] ;?></p>
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
