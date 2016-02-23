<?php

/*------- Instagram API Keys ----------*/
ini_set('error_reporting', E_ALL);


define("CLIENT_ID", 'b69bfade718b4bc69298621666deea6c');
define("CLIENT_SECRET", '10a53e1f78ce419e9e6b41b013c7da65');
define("REDIRECT_URL", 'http://www.test.dev/inst.php');


function connectToInstagram($url){
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function getUserID($userName) {
    $url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.CLIENT_ID;
    $instagramInfo = connectToInstagram($url);
    $results = json_decode($instagramInfo, true);
    return $results['data'][0]['id'];
}

function printImages($userID){
    $url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id'.CLIENT_ID.'&count=-1';
    $instagramInfo = connectToInstagram($url);
    $results = json_decode($instagramInfo, true);
    foreach($results['data'] as $items){
        $image_url = $items['images']['low_resolution']['url'];
        echo '<img src=" ' . $image_url . ' "/><br/>';
    }
}

if(isset($_GET['code'])) {
    $code = $_GET['code'];
    $url = "https://api.instagram.com/oauth/access_token";
    $access_token_settings = array (
        'client_id' => CLIENT_ID,
        'client_secret '    => CLIENT_SECRET,
        'grant_type'    => 'authorization_code',
        'redirect_uri' => REDIRECT_URL,
        'code' => $code
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_PORT, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($curl);
    curl_close($curl);

    $results = json_decode($result, true);
    echo '<pre>';
    print_r($results);
    $userName  = $results['user']['username'];
    $userID = getUserID($userName);
    printImages($userID);

} else { ?>
    <html>
    <body>
        <a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo CLIENT_ID; ?>&redirect_uri=<?php echo REDIRECT_URL; ?>&response_type=code">Login</a>
    </body>
    </html>
<?php } ?>