<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';
   $i = 1;

 //variables
  $txn_id = sanitize((int)$_GET['txn_id']);
  $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$txn_id}'");
  $txn = mysqli_fetch_assoc($txnQuery);
  $user_id = $txn['full_name'];
  $uQuery = $db->query("SELECT * FROM userlogin WHERE receiver = '{$user_id}'");
  $u = mysqli_fetch_assoc($uQuery);
  $cart_id = $txn['cart_id'];
  $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
  $cart = mysqli_fetch_assoc($cartQ);
  $items = json_decode($cart['items'], true);
  $idArray = array();
  $products = array();
  foreach($items as $item){
    $idArray[] = $item['id'];

  }
  $ids = implode(',', $idArray);
  $productQ = $db->query("SELECT i.id as 'id', i.title as 'title', c.id as 'cid', c.category as 'child', p.category as 'parent'
                          FROM products i
                          LEFT JOIN categories c ON i.categories = c.id
                          LEFT JOIN categories p ON c.parent = p.id
                          WHERE i.id IN ({$ids})");
  while ($p = mysqli_fetch_assoc($productQ)) {

    foreach($items as $item){
      if($item['id'] == $p['id']){
        $x = $item;
        continue;
      }
    }
    $products[] = array_merge($x, $p);
  }
?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
          <li><i class="fa fa-laptop"></i>Dashboard</li>
        </ol>
      </div>
    </div>
    <!-- page start-->
    <!-- Order To Fill-->
    <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
              Items Ordered
              </header>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Quantity</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Size</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($products as $product): ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $product['quantity']; ?></td>
                    <td><?= $product['title']; ?></td>
                    <td><?= $product['parent']. ' ~ '. $product['child']; ?></td>
                    <td><?= $product['size']; ?></td>
                  </tr>
                  <?php $i++; endforeach; ?>
                </tbody>
              </table>
            </section>
          </div>

      <!-- Order Details -->
      <div class="col-lg-6">
              <section class="panel">
                <header class="panel-heading">
                Order Details
                </header>
                <table class="table table-striped table-bordered">
                  <tbody>
                    <tr>
                      <td>Order Date</td>
                      <td><?= pretty_date($txn['txn_date']); ?></td>
                    </tr>
                    <tr>
                      <td>Total</td>
                      <td><?= money($txn['total']); ?></td>
                    </tr>
                    <tr>
                      <td>Tax</td>
                      <td><?= money($txn['tax']); ?></td>
                    </tr>
                    <tr>
                      <td>Grand Total</td>
                      <td><?= money($txn['sub_total']); ?></td>
                    </tr>
                  </tbody>
                </table>
              </section>
            </div>

            <div class="col-lg-6">
                    <section class="panel">
                      <header class="panel-heading">
                      Shipping Address
                      </header>
                      <address>
                        <?= $txn['full_name']; ?><br>
                        <?= $txn['street']; ?><br>
                        <?= $u['number']; ?><br>
                        <?= $txn['city']. ', '. $txn['lga']. ', '. $txn['state']; ?><br>
                        <?= $u['directions']; ?><br>

                      </address>
                    </section>
                  </div>

                  <div class="pull-right">
                    <a href="index.php" class="btn ntm-large btn -default">Cancel</a>
                    <a href="orders.php?complete=1&cart_id=<? $car_id; ;?>" class="btn btn-success btn-large">Complete Order</a>
                  </div>
    <!-- page end-->
  </section>
</section>
<!--main content end-->





<?php
      include 'includes/footer.php';
?>
