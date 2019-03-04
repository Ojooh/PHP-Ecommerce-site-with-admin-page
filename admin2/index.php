<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
    header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/topbar.php';
  include 'includes/sidebar.php';

  $i = 1;

  $txnQuery = "SELECT t.id, t.cart_id, t.full_name, t.description, t.txn_date, t.sub_total, c.items, c.paid, c.shipped
                FROM transactions t LEFT JOIN cart c ON t.cart_id = c.id WHERE c.paid = 1 AND c.shipped = 0 ORDER BY t.txn_date";
  $txnResults = $db->query($txnQuery);
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
                  Orders To Ship
                  </header>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Total Paid</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($order = mysqli_fetch_assoc($txnResults)):
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><a href="orders.php?txn_id=<?= $order['id']; ?>" class="btn btn-xs btn-info">Details</a></td>
                        <td><?= $order['full_name']; ?></td>
                        <td><?= $order['description']; ?></td>
                        <td><?= money($order['sub_total']); ?></td>
                        <td><?= pretty_date($order['txn_date']); ?></td>
                      </tr>
                      <?php $i++; endwhile; ?>
                    </tbody>
                  </table>
                </section>
              </div>

<!--------------Sales By Month ------------------>
<?php
    $thisYr = date("Y");
    $lastYr = $thisYr -1;
    $thisYrQ = $db->query("SELECT sub_total, txn_date FROM transactions WHERE YEAR(txn_date) = '{$thisYr}'");
    $lastYrQ = $db->query("SELECT sub_total, txn_date FROM transactions WHERE YEAR(txn_date) = '{$lastYr}'");
    $current = array();
    $last = array();
    $currentTotal = 0;
    $lastTotal = 0;
    while($x = mysqli_fetch_assoc($thisYrQ)){
      $month = date("m", strtotime($x['txn_date']));
      if(!array_key_exists($month, $current)){
        $current[(int)$month] = $x['sub_total'];
      }else{
        $current[(int)$month] += $x['sub-total'];
      }
      $currentTotal += $x['sub_total'];
    }

    while($y = mysqli_fetch_assoc($lastYrQ)){
      $month = date("m", strtotime($y['txn_date']));
      if(!array_key_exists($month, $current)){
        $last[(int)$month] = $y['sub_total'];
      }else{
        $last[(int)$month] += $y['sub-total'];
      }
      $lastTotal += $x['sub_total'];
    }
?>
              <div class="col-md-4">
                      <section class="panel">
                        <header class="panel-heading">
                        Sales By Month
                        </header>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th></th>
                              <th><?= $lastYr; ?></th>
                              <th><?= $thisYr; ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              for($d = 1; $d <= 12; $d++):
                                $dt = DateTime::createFromFormat('!m', $d);
                            ?>
                            <tr <?= (date("m") == $d)?' class="thead-light"':'';?>>
                              <td <?= (date("m") == $d)?' class="table-primary"':'';?>><?=$dt->format("F"); ?> </td>
                              <td><?= (array_key_exists($d, $last))?money($last[$d]):"0.00"; ?></td>
                              <td><?= (array_key_exists($d, $current))?money($current[$d]):'0.00'; ?></td>
                            </tr>
                            <?php  endfor ?>
                            <tr>
                              <td>Total</td>
                              <td><?= money($lastTotal); ?></td>
                              <td><?= money($currentTotal); ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </section>
                    </div>


                  <!--------------Inventory ------------------>
            <?php
                  $iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
                  $lowItems = array();
                  while($product = mysqli_fetch_assoc($iQuery)){
                    $item = array();
                    $sizes = sizesToArray($product['sizes']);
                    foreach($sizes as $size){
                      if($size['quantity'] <= $size['threshold']){
                        $cat = get_category($product['categories']);
                        $item = array(
                          'title' => $product['title'],
                          'size' => $size['size'],
                          'quantity' => $size['quantity'],
                          'threshold' => $size['threshold'],
                          'category' => $cat['parent']. ' ~ '. $cat['child']
                        );
                        $lowItems[] = $item;
                      }

                    }
                  }

            ?>
                  <div class="col-md-8">
                          <section class="panel">
                            <header class="panel-heading">
                            Low Inventory
                            </header>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Product</th>
                                  <th>Category</th>
                                  <th>Size</th>
                                  <th>Quantity</th>
                                  <th>Threshold</th>
                                </tr>
                              </thead>
                              <tbody>
                            <?php foreach($lowItems as $item): ?>
                                <tr<?= ($item['quantity'] == 0)?' class="text-danger"':''; ?>>
                                  <td><?= $item['title']; ?></td>
                                  <td><?= $item['category']; ?></td>
                                  <td><?= $item['size']; ?></td>
                                  <td><?= $item['quantity']; ?></td>
                                  <td><?= $item['threshold']; ?></td>
                                </tr>
                              <?php  endforeach ?>
                              </tbody>
                            </table>
                          </section>
                        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->

<?php
      include 'includes/footer.php';
?>
