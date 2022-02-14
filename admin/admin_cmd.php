<?php
    session_start();
    include '../includes/connect.php' ;
    if (!( isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) )
    {
        header('location: ../page/index.php') ;
    }

    //admin info
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM client WHERE clientID = '$id' ";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result) ;

    // commande
    $sql = "SELECT produit.nom AS pro, client.nom AS cli , commandde.quantite_D AS qte , produit.prix FROM produit,commandde,client WHERE (client.clientID = commandde.clientRef AND produit.prod_id = commandde.produitRef) ";
    $result = mysqli_query($conn, $sql);
    $comd = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $i = 0 ;
    // graph rond
    $sql ="SELECT produit.categorie AS cat, SUM(commandde.quantite_D) AS quantite FROM commandde,produit WHERE commandde.produitRef = produit.prod_id GROUP BY (produit.categorie)";
    $result = mysqli_query($conn, $sql);
    $rond = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cat = "" ;
    $qt = "" ;
    foreach ($rond as $ron)
    {
        $cat = $cat . "'" . $ron['cat'] . "'," ;
        $qt = $qt . "'" . $ron['quantite'] . "'," ;
    }
    $cat = trim($cat , ",");
    $qt = trim($qt , ",");

    //graph line
    $sql = "SELECT produit.nom AS nom , SUM(commandde.quantite_D) AS quantite FROM commandde,produit WHERE commandde.produitRef = produit.prod_id GROUP BY (`produitRef`)" ;
    $result = mysqli_query($conn, $sql);
    $lines = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nom = "" ;
    $qte = "" ;

    foreach ($lines as $line)
    {
        $line['nom'] =  substr ($line['nom'],0,12);
        $nom = $nom . "'" . $line['nom'] . "'," ;
        $qte = $qte . "'" . $line['quantite'] . "'," ;
    }
    $nom = trim($nom , ",");
    $qte = trim($qte , ",");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventes</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_ventes.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="shortcut icon" type="image/pmg" href="../assets/usb 1.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <li><a href="./admin_users.php">membres</a></li>
        <li><a class="active" href="admin_cmd.php">commandes et statistique</a></li>
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

  <section id="graph">
      <div class="box">
          <div class="name">
              <canvas id="venteProduit"> </canvas>
          </div>
          <div class="cate">
              <canvas id="venteCategorie"> </canvas>
          </div>
      </div>
      <script>
          let line = document.getElementById('venteProduit').getContext('2d') ;
          let catGraphOne = new Chart (line , {
              type : 'line',
              data: {
                  labels:[<?php echo $nom ;?> ] ,
                  datasets: [{
                  label: 'Nombre de ventes' ,
                  data: [<?php echo $qte ;?>],
                  backgroundColor: ['#1DD795'],
                  pointBackgroundColor : "#3394ED",
                  tension: 0.5,
                    fill: {
                		target: 'origin',
                		above:  'rgba(83,51,237,0.6)',   
                		below: 'rgb(0, 0, 255)'    
              			} 
                    
                  }] 
              } ,
              option: {
                   responsive: true ,
                   
              }
          });

          let rond = document.getElementById('venteCategorie').getContext('2d') ;
          let catGraph = new Chart (rond , {
               type : 'doughnut',
               data: {
               labels:[<?php echo $cat ;?>] ,
               datasets: [{
               label: 'Nombre de ventes' ,
               data: [<?php echo $qt ;?>],
               backgroundColor: ['#1DD795','#FFB526','#3394ED','#FF66D4'],
               
                          }]
                     } ,
               option: {
                   title: {
                       display: true ,
                       text: 'Ventes par categorie'
                   } ,
                   responsive: true
               }

              });
      </script>
  </section>

    <section id="commande" >
        <div class="box_">
                <h1>Commande</h1>
                <div class="bare">
                    <p>#</p>
                    <p>nom</p>
                    <p>produit</p>
                    <p>quantite</p>
                    <p>total en DH</p>
                </div>
        <?php foreach($comd as $com ) {  $i++ ; $total = $com['qte']* $com['prix'] ; ?>
        <div class="oneCom">
            <p><?php echo $i ;?></p>
            <p><?php echo $com['cli'] ;?></p>
            <p><?php echo $com['pro'] ;?></p>
            <p><?php echo $com['qte'] ;?></p>
            <p><?php echo $total ;?></p>
        </div>
        <?php } ?>
        </div>
    </section>

    <scrip src="graph.js"></scrip>
    <script>
    document.getElementById("open_nav_btn").addEventListener("click", () =>{
        document.getElementById("left_nav").classList.toggle("open_left_nav");
    })
    </script>
</body>
</html>
