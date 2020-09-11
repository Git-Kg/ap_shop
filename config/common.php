<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST')
      {
          if( !hash_equals($_SESSION['token'], $_POST['token'])){
              echo 'Invalid CSRF token';
              die();
          }else{
              unset($_SESSION['token']);
          }
      }

    if(empty($_SESSION['token']))
    {
        if(function_exists('random_bytes')){
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }else if(function_exists('mcrypt_create_iv')){
            $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        }else{
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    } 

    function xss($html)
    {
        return htmlspecialchars($html, INT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function xss_Clean($string)
	{
		return  htmlentities(htmlspecialchars(stripslashes(trim($string))));
	}
?>