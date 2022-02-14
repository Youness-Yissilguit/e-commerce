<?php
    include '../includes/connect.php' ;
    session_start();
    $errors = '';
    $success  = '';
    $mail = false ;
    $user_name = false;

    if(isset($_POST['Connecter'])){
        $nom = $_POST["mail"];
        $mdp = $_POST["password"];

        if (filter_var($nom, FILTER_VALIDATE_EMAIL)) {
           $mail = true ;
        }
        else if (preg_match('/^[a-zA-Z\s]+$/', $nom)) {
            $user_name = true ;
        }

        if ($mail || $user_name)
        {
            if ($user_name)
                $sql = "SELECT * FROM client WHERE nom='$nom' AND mdp='$mdp' ";
            if ($mail)
                $sql = "SELECT * FROM client WHERE email='$nom' AND mdp='$mdp' ";

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
            $user_arr = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $user_arr['nom'];
            $_SESSION["id"] = $user_arr["clientID"];
            $_SESSION["admin"] = $user_arr['autori'] ;
            if (! $user_arr['autori'] )
                header('location: index.php');
            else
                header('location: ../admin/home.php');
            }else{
                $errors = "user does't exist";
            }
        }
        else {
            $errors = "l'identifiant est errone" ;
        }
      }
      else if ( isset($_POST['Creer']) )
      {
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
        if (!preg_match('/^[a-zA-Z\s]+$/', $nom) || !preg_match('/^[a-zA-Z\s]+$/', $prenom) || !preg_match('/^[a-zA-Z0-9\s]+$/', $adress) ) {
            $errors = "les donees sont errone" ;
         }
         if  ( $errors == "")
         {
            $sql = "INSERT INTO client(nom, prenom, address , email , mdp) VALUES('$nom', '$prenom', '$adress' , '$mail' ,'$mdp')";
            if (mysqli_query($conn, $sql)) {
              $success  = 'votre compte a ete creer.';
            }
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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/account.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png" />
    </head>
    <body>
        <?php
            include '../includes/navbar.php' ;
        ?>
        <?php if($errors != ''){ ?>
        <p class="alert danger">  <?php echo $errors ;  ?> </p>
        <?php } ?>
        <?php if($success != ''){ ?>
        <p class="alert success">  <?php echo $success ;  ?> </p>
        <?php } ?>
        <div class="outter" id="box">


            <div class="left" id="left">
                <div class="welcom_container">
                    <h1 id="oui"> Re Bonjour !</h1>
                    <p>pour pouvoir acceder a toutes les fonctionalite du site veuillez vous connecter</p>
                    <p id="connect">se connecter</p>
                </div>
            </div>

            <div class="right" id="right">
                <div class="form_container">
                    <h2>Creer un compte</h2>
                    <form method="post" action="account.php">
                        <input type="text" name="nom" placeholder="nom" class="to_remove" required>
                        <input type="text" name="prenom" placeholder="prenom" class="to_remove" required>
                        <input type="text" name="adress" placeholder="Adress" class="to_remove" required>
                        <input type="text" name="mail" placeholder="e-mail" required>
                        <input type="password" name="password" placeholder="mot de passe" required>
                        <button type="submit" name="Creer">Creer</button>
                    </form>
                </div>
            </div>
        </div>

        <script src='../js/index.js'></script>
    </body>
</html>
