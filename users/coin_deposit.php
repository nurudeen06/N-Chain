<?php
    session_start();
    if(isset($_POST['amount'])){
    $_SESSION['amount'] = $_POST['amount'];
    }

	// Change path to your files
	// --------------------------------------
	DEFINE("CRYPTOBOX_PHP_FILES_PATH", "../lib/");        	// path to directory with files: cryptobox.class.php         
                                                        
	DEFINE("CRYPTOBOX_IMG_FILES_PATH", "../images/");      // path to directory with coin image files (directory 'images' by default)
	DEFINE("CRYPTOBOX_JS_FILES_PATH", "../js/");			// path to directory with files: ajax.min.js/support.min.js
	
	
	// Change values below
	// --------------------------------------
	DEFINE("CRYPTOBOX_LANGUAGE_HTMLID", "alang");	// any value; customize - language selection list html id; change it to any other - for example 'aa';	default 'alang'
	//DEFINE("CRYPTOBOX_COINS_HTMLID", "acoin");		// any value;  customize - coins selection list html id; change it to any other - for example 'bb';	default 'acoin'
	DEFINE("CRYPTOBOX_PREFIX_HTMLID", "acrypto_");	// any value; prefix for all html elements; change it to any other - for example 'cc';	default 'acrypto_'
	
	
	// Open Source Bitcoin Payment Library
	// ---------------------------------------------------------------
	require_once(CRYPTOBOX_PHP_FILES_PATH . "cryptobox.class.php" );
	
	
	
	/*********************************************************/
	/****  PAYMENT BOX CONFIGURATION VARIABLES  ****/
	/*********************************************************/
	$userID 			= $_SESSION['id'];        // place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
	$userFormat		= "SESSION";       // save userID in cookies (or you can use IPADDRESS, SESSION, MANUAL)
	$amountUSD		= (isset($_POST['amount'])?(intval($_POST['amount']) >= 50 ) ?intval($_POST['amount']): "": $_SESSION['amount']);			  // invoice amount - 0.10 USD; or you can use - $amountUSD = convert_currency_live("EUR", "USD", 22.37); // convert 22.37EUR to USD
	
	$period			= "NOEXPIRY";	  // one time payment, not expiry
	$def_language	= "en";			  // default Language in payment box
	$def_coin		= (isset($_POST['currency'])?$_POST['currency'] : "bitcoin");      // default Coin in payment box
	
	
	
	// List of coins that you accept for payments
$coins = array('bitcoin', 'bitcoincash', 'litecoin'/*, 'dogecoin'*/);  // for example, accept payments in bitcoin, bitcoincash, litecoin, 'dogecoin', dash, speedcoin 
	
	// Create record for each your coin - https://gourl.io/editrecord/coin_boxes/0 ; and get free gourl keys
	// It is not bitcoin wallet private keys! Place GoUrl Public/Private keys below for all coins which you accept
	
	
	
	$all_keys = array(	"bitcoin"   => array("public_key" => "65039AAUmmdIBitcoin77BTCPUBnRjD2un6Z65qe4tbtwzh8hV",  
										    "private_key" => "65039AAUmmdIBitcoin77BTCPRVxU2VgRTSy7T0myvxtcF8vC0"),
					  "bitcoincash" => array("public_key" => "65052AAPM3LWBitcoincash77BCHPUBt9PqZdNOX8BjrIvC3S4", 
					  					    "private_key" => "65052AAPM3LWBitcoincash77BCHPRV0YzKAt0qKN4tNMMd7sJ"),
					  "litecoin"   => array("public_key"  => "65051AAayF5bLitecoin77LTCPUB6EMZqO5COVrCaTsFKSiqbf", 
					  					    "private_key" => "65051AAayF5bLitecoin77LTCPRVb0FOuUCszcfwx5fwQ8I88K"),
					  /*"dogecoin"   => array("public_key"  => "25678AACxnGODogecoin77DOGEPUBZEaJlR9W48LUYagmT9LU8",
					  					    "private_key" => "25678AACxnGODogecoin77DOGEPRVFvl6IDdisuWHVJLo5m4eq")*/
				);
			   
	
	
	    
	
	// Re-test - all gourl public/private keys
	$def_coin = strtolower($def_coin);
	if (!in_array($def_coin, $coins)) $coins[] = $def_coin;  
	foreach($coins as $v)
	{
		if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])) die("Please add your public/private keys for '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["public_key"], "PUB"))  die("Invalid public key for '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["private_key"], "PRV")) die("Invalid private key for '$v' in \$all_keys variable");
		elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false) 
				die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file /lib/cryptobox.config.php.");
	}
	
	
	
	
	
	// Current selected coin by user
	$coinName = cryptobox_selcoin($coins, $def_coin);
	
	
	// Current Coin public/private keys
	$public_key  = $all_keys[$coinName]["public_key"];
	$private_key = $all_keys[$coinName]["private_key"];
	
	
	
	
	
	
	/** PAYMENT BOX **/
	$options = array(
	    "public_key"  	=> $public_key,	    // your public key from gourl.io
	    "private_key" 	=> $private_key,	// your private key from gourl.io
	    "webdev_key"  	=> "", 			    // optional, gourl affiliate key
	    "orderID"     	=> time(), 		// order id or product name
	    "userID"      		=> $userID, 	// unique identifier for every user
	    "userFormat"  	=> $userFormat, 	// save userID in COOKIE, IPADDRESS, SESSION  or MANUAL
	    "amount"   	  	=> 0,			    // product price in btc/bch/bsv/ltc/doge/etc OR setup price in USD below
	    "amountUSD"   	=> $amountUSD,	    // we use product price in USD
	    "period"      		=> $period, 	// payment valid period
	    "language"	  	=> $def_language    // text on EN - english, FR - french, etc
	);
	
	// Initialise Payment Class
	$box = new Cryptobox ($options);
	
	// coin name
	$coinName = $box->coin_name();
	

        $page  = "//".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; // Current page url
        $page .= (strpos($page, "?")) ? "&" : "?";

        
        
        // Reset Settings
        // ---------------------
        if (isset($_GET["reset"]))
        {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
            
            header("Location: //".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]); 
            echo "<script> window.location.href = '//".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."'</script>";
            die();
        }
        
        
        
        // Theme Selection
        // ---------------------
        if (isset($_GET["theme"])) 
        {
            $theme = $_GET["theme"];
            setcookie("dtheme", $theme);
        }
        else $theme = (isset($_COOKIE["dtheme"])) ? $_COOKIE["dtheme"] : "default"; 
      
        if ($theme == "black")          $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "greyred")    $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "greygreen")  $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "whiteblue")  $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "whitered")   $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "whitegreen") $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "whiteblack") $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "whitepurple")$css =  '<link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "litera")     $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "minty")      $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "sandstone")  $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.css" crossorigin="anonymous">';
        elseif ($theme == "sketchy")    $css =  '<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.css" crossorigin="anonymous">';
        else                            $css =  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">';

        // If your website not use Bootstrap4 as main style, please use custom css style below.
        // It isolate Bootstrap CSS to a particular class 'bootstrapiso' to avoid css conflicts with your site main css style
        if ($theme == "black")          $css2 =  '<link rel="stylesheet" href="../css/darkly.min.css" crossorigin="anonymous">';
        elseif ($theme == "greyred")    $css2 =  '<link rel="stylesheet" href="../css/superhero.min.css" crossorigin="anonymous">';
        elseif ($theme == "greygreen")  $css2 =  '<link rel="stylesheet" href="../css/solar.min.css" crossorigin="anonymous">';
        elseif ($theme == "whiteblue")  $css2 =  '<link rel="stylesheet" href="../css/cerulean.min.css" crossorigin="anonymous">';
        elseif ($theme == "whitered")   $css2 =  '<link rel="stylesheet" href="../css/united.min.css" crossorigin="anonymous">';
        elseif ($theme == "whitegreen") $css2 =  '<link rel="stylesheet" href="../css/flatly.min.css" crossorigin="anonymous">';
        elseif ($theme == "whiteblack") $css2 =  '<link rel="stylesheet" href="../css/lux.min.css" crossorigin="anonymous">';
        elseif ($theme == "whitepurple")$css2 =  '<link rel="stylesheet" href="../css/pulse.min.css" crossorigin="anonymous">';
        elseif ($theme == "litera")     $css2 =  '<link rel="stylesheet" href="../css/litera.min.css" crossorigin="anonymous">';
        elseif ($theme == "minty")      $css2 =  '<link rel="stylesheet" href="../css/minty.min.css" crossorigin="anonymous">';
        elseif ($theme == "sandstone")  $css2 =  '<link rel="stylesheet" href="../css/sandstone.min.css" crossorigin="anonymous">';
        elseif ($theme == "sketchy")    $css2 =  '<link rel="stylesheet" href="../css/sketchy.min.css" crossorigin="anonymous">';
        else                            $css2 =  '<link rel="stylesheet" href="../css/bootstrapcustom.min.css" crossorigin="anonymous">';

        // -- End Theme ---------------------
        
        
        
        // Box Type
        // ---------------------
        if (isset($_GET["boxtype"]))
        {
            $boxtype = $_GET["boxtype"];
            setcookie("dboxtype", $boxtype);
        }
        else $boxtype = (isset($_COOKIE["dboxtype"])) ? $_COOKIE["dboxtype"] : "1";
        $boxtype = intval($boxtype);
        
        // payment received
        if ($boxtype == "2" && !$box->is_paid())
        {
            
            $options = array(
                "public_key"  => "20AAvZCcgBitcoin77BTCPUB0xyyeKkxMUmeTJRWj7IZrbJ0oL",        // your public key from gourl.io
                "private_key" => "20AAvZCcgBitcoin77BTCPRVkW3K4eNMfYTIQGiYG1QYpOOP1n",       // your private key from gourl.io
                "webdev_key"  => "",                 // optional, gourl affiliate key
                "orderID"     => "invoice1",         // order id or product name
                "userID"      => "demo",             // unique identifier for every user
                "userFormat"  => "MANUAL",           // save userID in COOKIE, IPADDRESS or SESSION
                "amount"   	  => 0,                  // product price in coins OR in USD below
                "amountUSD"   => 0.1,                // we use product price in USD
                "period"      => "NOEXPIRY",         // payment valid period
                "language"	  => $def_language       // text on EN - english, FR - french, etc
            );
            
            // Re-Initialise Payment Class
            $box = new Cryptobox ($options);
        }
        // -- End boxtype ---------------------
        
        
        
        // Logo Selection
        // ---------------------
        if (isset($_GET["logo"]))
        {
            $logo = $_GET["logo"];
            setcookie("dlogo", $logo);
        }
        else $logo = (isset($_COOKIE["dlogo"])) ? $_COOKIE["dlogo"] : "custom";
        
        if ($logo == "custom")         $logoimg_path =  '../public/assets/images/logo-dark.png';
        elseif ($logo == "no")         $logoimg_path =  '';
        else                           $logoimg_path =  'default';
        // -- End logo ---------------------

        
        
        // Logo Selection
        // ---------------------
        if (isset($_GET["lan"]))
        {
            $lan = $_GET["lan"];
            setcookie("dlan", $lan);
        }
        else $lan = (isset($_COOKIE["dlan"])) ? $_COOKIE["dlan"] : "yes";
        
        if ($lan == "yes")            $show_languages =  true;
        else                          $show_languages =  false;
        // -- End lan ---------------------

        
        
        // Coins Menu
        // ---------------------
        if (isset($_GET["numcoin"]))
        {
            $numcoin = $_GET["numcoin"];
            setcookie("dnumcoin", $numcoin);
        }
        else $numcoin = (isset($_COOKIE["dnumcoin"])) ? $_COOKIE["dnumcoin"] : 6;
        $numcoin = intval($numcoin);
        
        if ($numcoin > 15) $numcoin = 6;
        $coins = array_slice($coins, 0, $numcoin);
        // -- End numcoin ---------------------
        
        
        
        // Coin Images Size Menu
        // ---------------------
        if (isset($_GET["coinImageSize"]))
        {
            $coinImageSize = $_GET["coinImageSize"];
            setcookie("dcoinImageSize", $coinImageSize);
        }
        else $coinImageSize = (isset($_COOKIE["dcoinImageSize"])) ? $_COOKIE["dcoinImageSize"] : 70;
        $coinImageSize = intval($coinImageSize);
        
        if ($coinImageSize > 200) $coinImageSize = 70;
        if ($coinImageSize == 70 && in_array($theme, array("black", "greyred", "greygreen"))) $coinImageSize = 71;
        
        // -- End coinImageSize ---------------------

        
        
        // Coin Images Size Menu
        // ---------------------
        if (isset($_GET["qrcodeSize"]))
        {
            $qrcodeSize = $_GET["qrcodeSize"];
            setcookie("dqrcodeSize", $qrcodeSize);
        }
        else $qrcodeSize = (isset($_COOKIE["dqrcodeSize"])) ? $_COOKIE["dqrcodeSize"] : 100;
        $qrcodeSize = intval($qrcodeSize);
        
        if ($qrcodeSize > 500) $qrcodeSize = 100;
        
        // -- End qrcodeSize ---------------------
        
        
        
        // Image on Result Page
        // ---------------------
        if (isset($_GET["resimage"]))
        {
            $resimage = $_GET["resimage"];
            setcookie("dresimage", $resimage);
        }
        else $resimage = (isset($_COOKIE["dresimage"])) ? $_COOKIE["dresimage"] : "default";
        
        if ($resimage == "image2")          $resultimg_path = "images/paid2.png";
        else if ($resimage == "image3")     $resultimg_path = "images/paid3.png";
        else if ($resimage == "custom")     $resultimg_path = "images/your_logo_res.jpg";
        else                                $resultimg_path = "default";
        
        // -- End resimage ---------------------
        
        
        
        
        // Image Size on Result Page
        // ---------------------
        if (isset($_GET["resultimgSize"]))
        {
            $resultimgSize = $_GET["resultimgSize"];
            setcookie("dresultimgSize", $resultimgSize);
        }
        else $resultimgSize = (isset($_COOKIE["dresultimgSize"])) ? $_COOKIE["dresultimgSize"] : 150;
        $resultimgSize = intval($resultimgSize);
        
        if ($resultimgSize > 500) $resultimgSize = 150;
        
        // -- End resultimgSize ---------------------
        
        
        
        
        // Data Method (ajax or curl)
        // ---------------------
        if (isset($_GET["method"]))
        {
            $method = $_GET["method"];
            setcookie("dmethod", $method);
        }
        else $method = (isset($_COOKIE["dmethod"])) ? $_COOKIE["dmethod"] : "curl";
        
        if (!in_array($method, array("ajax", "curl"))) $method = "curl";
        
        // -- End data method ---------------------        
        
        
        
        // Debug
        // ---------------------
        if (isset($_GET["deb"]))
        {
            $deb = $_GET["deb"];
            setcookie("ddeb", $deb);
        }
        else $deb = (isset($_COOKIE["ddeb"])) ? $_COOKIE["ddeb"] : "yes";
        
        if ($deb == "yes")            $debug =  false;
        else                          $debug =  false;
        // -- End debug ---------------------
       
        
    ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Velzon Deposit Page</title>


    <!-- Bootstrap CSS - -->
    <?php echo $css; ?>


    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" crossorigin="anonymous"></script>
    <script src="<?php echo CRYPTOBOX_JS_FILES_PATH; ?>support.min.js" crossorigin="anonymous"></script> 

    <!-- Custom styles for crypto payment box, copy it to your file also -->
    <style>
            html { font-size: 14px; }
            @media (min-width: 768px) { html { font-size: 16px; } .tooltip-inner { max-width: 350px; } }
            .mncrpt .container { max-width: 980px; }
            .mncrpt .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
            img.radioimage-select { padding: 7px; border: solid 2px #ffffff; margin: 7px 1px; cursor: pointer; box-shadow: none; }
            img.radioimage-select:hover { border: solid 2px #a5c1e5; }
            img.radioimage-select.radioimage-checked { border: solid 2px #7db8d9; background-color: #f4f8fb; }
            .acrypto_coins_list { display: none;}
    </style>
  </head>

  <body>


	<div class='mncrpt'>
  
    </div>


  <?php 
    
  
  
        // PAYMENT BOX 
        // --------------------------------------------------------
  
        $custom_text = "";
        $custom_text .= "";
        
        // use function display_cryptobox_bootstrap ($coins = array(), $def_coin = "", $def_language = "en", $custom_text = "", $coinImageSize = 70, $qrcodeSize = 200, $show_languages = true, $logoimg_path = "default", $resultimg_path = "default", $resultimgSize = 250, $redirect = "", $method = "curl", $debug = false)
        echo $box->display_cryptobox_bootstrap($coins, $def_coin, $def_language, $custom_text, $coinImageSize, $qrcodeSize, $show_languages, $logoimg_path, $resultimg_path, $resultimgSize, "", $method, $debug);
        
        // End --------------------------------------------------------
        
        

  
        
        
  ?>
  
  

  </body>

</html>
