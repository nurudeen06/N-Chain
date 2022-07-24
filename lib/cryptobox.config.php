<?php
/**
 *  ... Please MODIFY this file ...
 *
 *
 *  YOUR MYSQL DATABASE DETAILS
 *
 */

 define("DB_HOST", 	"localhost");				// hostname
 define("DB_USER", 	"root");		// database username
 define("DB_PASSWORD", 	"");		// database password
 define("DB_NAME", 	"nitvel");	// database name




/**
 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional)", "etc...");
 */

 $cryptobox_private_keys = array("65039AAUmmdIBitcoin77BTCPRVxU2VgRTSy7T0myvxtcF8vC0","65051AAayF5bLitecoin77LTCPRVb0FOuUCszcfwx5fwQ8I88K","65052AAPM3LWBitcoincash77BCHPRV0YzKAt0qKN4tNMMd7sJ");




 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys);
         
?>
