<?php 

    /*
        Followed Youtube Tutorial from YouTube
        https://www.youtube.com/watch?v=lAqOZ3nXG7o
    */

    //Autoload the files from google (vendor/autoload)
    require ("vendor/autoload.php");
    //Configuration Setup for Google Client
    require ("gplus-config.php");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Create authentication url and redirect to Google Account Chooser when button is clicked
    $auth_url = $g_client->createAuthUrl();
    echo "<a href='$auth_url'><img src='signin_button' alt='Login Through Google'/></a>";

    //Get the token
    $code = isset($_GET['code']) ? $_GET['code'] : NULL;
    //$facilityUser = "true";

    //If token is set route to gplus-authenticate.php, else login to get a new token
    if(isset($code)) {
        //API Url
        $url = 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/kevinapi.php?table=reservation';
        
        //Initiate cURL.
        $ch = curl_init($url);
        
        //The JSON data.
        $jsonData = array(
            'LotID' => '1',
            'token' => $code,
            'StartTime' => '1524362641',
            'EndTime' => '1524362651'
        );
        
        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);
        
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
        
        //Execute the request
        $result = curl_exec($ch);
        
        header("Location: gplus-authenticate.php?token=$code");
        //header("Location: gplus-authenticate.php?token=$code&facilityUser=$facilityUser");
        //exit();
    }

?>