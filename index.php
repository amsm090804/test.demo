<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>WebCodo :: Get Your Images With Instagram API and PHP</title>

        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    </head>
 
    <body>
        
     <div class="webcodo-top" >
        <a href="http://www.webcodo.com/get-your-images-with-instagram-api-and-php">
            <div class="wcd wcd-tuto"> < Come back to the tuto page</div>
        </a>
        <a href="http://webcodo.com">
            <div class="wcd wcd-logo">WEBCODzxczxcxzcxzcxzcxczczxfdfsfcO</div>
        </a>
        <div class="wcd"></div>
        <p>vxvx</p>
    </div>
    <?php 
        $username = ''; // your username
        $access_token = ''; // put your access token here
        $count = 20; // number of images to show
        include 'instagram.php';   
    ?>
    <div class="tuto-cnt">
        <div class="follow-cnt">

            <a href="http://instagram.com/<?php echo $username; ?>">
                <div class="follow-btn">Follow me in Instagram</div>
            </a>
        </div>
        <?php
        $ins_media = $insta->userMedia(); 
        $i = 0; 
        foreach ($ins_media['data'] as $vm): 
            if($count == $i){ break;}
            $i++;
            $img = $vm['images']['low_resolution']['url'];
            $link = $vm["link"];
        ?>

            <a target="_blank" href="<?php echo $link ?>">
                <img src="<?php echo $img; ?>" width="175" style="float:left;" />
            </a>
        <?php endforeach ?>
    </div><!-- /tuto-cnt -->


     


</body>
</html>