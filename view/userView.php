<?php foreach($datos["users"] as $user) {?>
    <?php echo $user["id"]; ?> -
    <?php echo $user["wallet_id"]; ?> -
    <?php echo $user["transaction"]; ?> -
    <?php echo $user["img_path"]; ?>
    <hr/>
<?php } ?>