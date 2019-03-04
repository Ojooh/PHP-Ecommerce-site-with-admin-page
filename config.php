<?php
  define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/Baine/');
  define('CART_COOKIE','qwertyuiopasdfgh5678fghjk');
  define('WISH_COOKIE','asdfghjklzxcvbnm2345ertui');
  define('CART_COOKIE_EXPIRE',time() + (86400 * 30));
  define('WISH_COOKIE_EXPIRE',time() + (86400 * 365));
  define('TAXRATE', 1150.00);

  define('CURRENCY', 'NGN');
  define('CHECKOUTMODE', 'TEST'); //Change test to live when you are ready to go live

  if(CHECKOUTMODE == 'TEST'){
    define('STRIPE_PRIVATE', 'sk_test_Go26tWCRPemjTlTD46TsthdG
');
    define('STRIPE_PUBLIC', 'pk_test_fngYd0JyLp0vjfz3TEdj334q
');
  }

  // if(CHECKOUTMODE == 'LIVE'){
  //   define('STRIPE_PRIVATE', '');
  //   define('STRIPE_PUBLIC', '');
  // }
 ?>
