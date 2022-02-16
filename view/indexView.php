<!DOCTYPE HTML>
<?php 
    require_once 'config/metamask.php';
?>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Example PHP+PDO+MetaMask</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link href="src/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
        <script>
            window.walletConfig = {
                id: '<?php echo WALLETID; ?>',
                gas: '<?php echo GAS; ?>',
                gasPrice: '<?php echo GASPRICE; ?>',
                amount: '<?php echo AMOUNT; ?>',
            };
        </script>
    </head>
    <body>
        <div class="error hide"></div>
        <header>
            <div class="header-container">
                <img src="img/metamask-500.png" height="75"/>
                <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </header>
        <main class="container">
            <div class="body-text">
                <div class="col-lg-5">
                    <form action="index.php?&action=add" method="post"id="save" data-check-user="/user">
                        <h3>Add user</h3>
                        <hr/>
                        wallet_id: <input id="walletId" type="text" name="wallet_id" class="form-control"/>
                        transaction: <input id="transaction" type="text" name="transaction" class="form-control"/>
                        <input type="submit" value="Send" style="display: none;"/>
                        <button type="button" id="connectButton">Connect Wallet!</button>
                        <button type="button" id="transactionButton" class="btn btn-success" style="display: none;">Pay</button>
                        <button type="button" id="checkButton">Check Wallet!</button>
                    </form>
                    <div class="list-of-images"> 
                        <?php foreach($datos["images"] as $image) {?>
                            <div class="images">
                                <img src="pictures/<?php echo $image; ?>" width="200" height="100"/>
                                <input type="radio" name="image" value="<?php echo $image; ?>" id="<?php echo $image; ?>"/>
                                <label for="<?php echo $image; ?>"><?php echo $image; ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h3>Users</h3>
                    <hr/>
                </div>
                <section class="col-lg-7 js-users" style="height:400px;overflow-y:scroll;">
                    <?php foreach($datos["users"] as $user) {?>
                        <?php echo $user["id"]; ?> -
                        <?php echo $user["wallet_id"]; ?> -
                        <?php echo $user["transaction"]; ?> -
                        <img src="pictures/<?php echo $user["img_path"]; ?>" width="50"/>
                        <hr/>
                    <?php } ?>
                </section>
            </div>
        </main>               
        <div class="footer-basic">
            <footer>
                <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Home</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">About</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                </ul>
                <p class="copyright">Company Name © 2022</p>
            </footer>
        </div>
        <script src="dist/main.js"></script>
    </body>
</html>