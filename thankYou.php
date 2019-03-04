<?php
  require_once 'core/init.php';

    //set your secret key: remember to change this to your live secret key in production
    //see your keys here https://dashboard.stripe.com/account/apikeys
    //\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

    //Get the credit card details submitted by the form
    //$token = $_POST['stripeToken'];
    $full_name = sanitize($_POST['receiver']);
    $email = sanitize($_POST['email']);
    $city = sanitize($_POST['city']);
    $state = sanitize($_POST['state']);
    $lga = sanitize($_POST['lga']);
    $address = sanitize($_POST['address']);
    $directions = sanitize($_POST['directions']);
    $number = sanitize($_POST['number']);
    $receiver = sanitize($_POST['receiver']);
    $tax = sanitize($_POST['tax']);
    $total = sanitize($_POST['total']);
    $description = sanitize($_POST['description']);
    $sub_total = sanitize($_POST['sub_total']);
    $cart_id = sanitize($_POST['cart_id']);
    $charge_amount = $sub_total * 100;
    $street = $address ." ". $directions;
    $metadata = array(
      "cart_id"   => $cart_id,
      "tax"       => $tax,
      "sub_total" => $sub_total,
    );


    //create the charge on stripe's servers - this will charge the user's Card
    // try{
      // $charge = \Stripe\Charge::create([
      //   "ammount" => $charge_amount,//amount in cents,
      //   "currency" => CURRENCY,
      //   "source" => $token,
      //   "description" => $description,
      //   "receipt_email" => $email,
      //   "metadata" => $metadata
      // ]);


      //Adjust Invemrtory
      $itemQ = $db->query("SELECT * FROM cart  WHERE id = '{$cart_id}'");
      $iresults = mysqli_fetch_assoc($itemQ);
      $items = json_decode($iresults['items'], true);
      foreach($items as  $item){
        $newSizes = array();
        $item_id = $item['id'];
        $productQ = $db->query("SELECT sizes FROM products WHERE id = '{$item_id}'");
        $product = mysqli_fetch_assoc($productQ);
        $sizes = sizesToArray($product['sizes']);
        foreach($sizes as $size){
          if($size['size'] == $item['size']){
            $q = $size['quantity'] - $item['quantity'];
            $newSizes[] = array('size' => $size['size'], 'quantity' => $q);
          }
          else{
            $newSizes[] = array("size" => $size['size'], "quantity" => $size['quantity']);
          }
        }

        $sizeString = sizesToString($newSizes);
        $db->query("UPDATE products SET sizes = '{$sizeString}' WHERE id = '{$item_id}'");

      }


      //UPDATE Cart
      $db-> query("UPDATE cart SET paid = 1 WHERE id = '{$cart_id}'");
      $db-> query("INSERT INTO transactions (charge_id, cart_id, full_name, email, street, city, state, lga, total, tax, sub_total, description, txn_type ) VALUES
      ('', '$cart_id', '$full_name', '$email', '$street', '$city', '$state', '$lga', '$total', '$tax', '$sub_total', '$description', '')");

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP-HOST']:false;
      setcookie(CART_COOKIE,'',1,"/",$domain,false);

      include 'includes/head.php';
      include 'includes/navbar.php';
?>

<div class="container-fluid padding mb-5">
  <div class="row padding">
   <div class="col-lg-3"></div>
    <div class="border border-dark rounded col-lg-6 p-lr-70 p-t-55 p-b-70 p-lr-15-lg txt-center">
          <h4 class="mtext-105 cl2 txt-center p-b-30">
            Thank You!
          </h4>

          <p> Transaction was successful</p><br>

          <div class="m-b-20 how-pos4-parent">
            <p> Thank you for using Baine, You have been emailed a receipt, Please check your spam folder if it is not in your inbox. Additionally you can print this page as receipt. </p><br>
          </div>


          <div class="m-b-20 how-pos4-parent">
            <p> Receipt Number: <strong><?= $cart_id; ?></strong></p>
          </div>


          <div class="m-b-20 how-pos4-parent">
            <p> Order will be delivered to the address below. </p><br>
          </div>


          <div class="m-b-30">
            <address>
              Reciever :<?= $full_name; ?><br>
              street : <?= $street ." ". $city; ?>,<br>
              state: <?= $state ." ". $lga; ?>
            </address>
          </div>
        </div>
        <div class="col-lg-3"></div>
        </div>
        </div>


<?php
    // }
    // catch(\Stripe\Error\Card $e) {
    //   // The card has been declined
    //   echo $e;
    // }
    //
include 'includes/footer.php';


 ?>
