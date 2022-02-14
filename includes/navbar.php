
      <nav>
            <div class="container">
                <div class="logo">
                    <a href="index.php"><img src="../assets/logo.png" alt=""></a>
                </div>
                <ul class="navbar_links">
                    <li class="link"><a href="index.php">Accueil</a></li>
                    <li class="link"><a href="produit.php">Produit</a></li>
                    <li class="link"><a href="account.php">Profil</a></li>
                </ul>
                <div class="icons">

                    <div class="icon_circle">
                    <?php if(!isset($_SESSION["username"])) { ?>
                        <a href="account.php"><img src="../assets/account_circle.png" alt=""></a>
                        <?php }else{ ?>
                            <a href="logout.php"><img src="../assets/logout.svg" alt=""></a>
                        <?php } ?>
                    </div>
                    <div class="icon_circle">
                        <a href="panier.php"><img src="../assets/shopping.svg" alt=""></a>
                        <?php if(isset($_SESSION['panier']) && $_SESSION['panier'] != array()): ?>
                        <span class="nmbr_panier"><?php echo count($_SESSION['panier']); ?></span>
                      <?php endif; ?>
                    </div>
                    <img id="nav_open" src="../assets/menu_open.png" alt="">
                </div>
            </div>
        </nav>
