<?php

    session_start();
    if (!( isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) ){
        header('location: ../page/index.php');
    }

    include '../includes/connect.php' ;
    $errors = "";
    $success = "";
    if(isset($_POST['ajouter'])){
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'] ;
      $adress = $_POST['adress'] ;
      $mail = $_POST['mail'] ;
      $mdp = $_POST['password'] ;

      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          $errors = "les donnes sont errone" ;
       }
       $sql = "SELECT email FROM client WHERE email = '$mail' " ;
       $result = mysqli_query($conn, $sql);
       if(mysqli_num_rows($result) > 0 ){
           $errors = "email deja existant" ;
       }
      if (!preg_match('/^[a-zA-Z\s]+$/', $nom) || !preg_match('/^[a-zA-Z\s]+$/', $prenom) ) {
          $errors = "les donees sont errone" ;
       }
       if  ($errors == "")
       {
          $sql = "INSERT INTO client(nom, prenom, address , email , mdp) VALUES('$nom', '$prenom', '$adress' , '$mail' ,'$mdp')";
          if (mysqli_query($conn, $sql)) {
            $success  = 'votre compte a ete creer.';
          }
       }
    }

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

  <section id="add_user">
    <h1>Ajouter un utilisateurs</h1>
    <?php if($errors != ''){ ?>
    <p class="alert danger">  <?php echo $errors ;  ?> </p>
    <?php } ?>
    <?php if($success != ''){ ?>
    <p class="alert success">  <?php echo $success ;  ?> </p>
    <?php } ?>
    <form class="" action="./admin_ajout_user.php" method="post">
      <input type="text" name="nom" placeholder="nom" required>
      <input type="text" name="prenom" placeholder="prenom" required>
      <input type="text" name="adress" placeholder="Adress" required>
      <input type="text" name="mail" placeholder="e-mail" required>
      <input type="password" name="password" placeholder="mot de passe" required>
      <button type="submit" name="ajouter">Ajouter</button>
    </form>
  </section>

  <script>
  document.getElementById("open_nav_btn").addEventListener("click", () =>{
      document.getElementById("left_nav").classList.toggle("open_left_nav");
  })
  </script>
</body>
</html>
