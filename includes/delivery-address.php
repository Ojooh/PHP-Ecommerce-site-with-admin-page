<?php
        $useraddress2 =  $db->query("SELECT * FROM userlogin WHERE id = '$customer_id'");
        $address = mysqli_fetch_assoc($useraddress2);
        $stateQuery = $db->query("SELECT * FROM states WHERE parent = 0 ORDER BY states");
        $state_id2 = $address['state'];
        $statesql = $db->query("SELECT * FROM states WHERE id ='$state_id2'");
        $addstate = mysqli_fetch_assoc($statesql);
        $lga_id2 = $address['lga'];
        $lgasql = $db->query("SELECT * FROM states WHERE id ='$lga_id2'");
        $addlga = mysqli_fetch_assoc($lgasql);
        $a1 = $address['city'];
        $a2 = $addstate['states'];
        $a3 = $addlga['states'];
        $a4 = $address['address'];
        $a5 = $address['directions'];
        $a6 = $address['number'];
        $a7 = $address['receiver'];

        $home = $a1. " ". $a2. " ".$a3. " ".$a4. " ".$a5. " ";
        $receiver = ((isset($_POST['receiver']) && $_POST['receiver'] != '' )?sanitize($_POST['receiver']):'');
        $number = ((isset($_POST['number']) && $_POST['number'] != '' )?sanitize($_POST['number']):'');
        $state = ((isset($_POST['state']) && $_POST['state'] != '' )?sanitize($_POST['state']):'');
        $city = ((isset($_POST['city']) && $_POST['city'] != '' )?sanitize($_POST['city']):'');
        $lga = ((isset($_POST['lga']) && $_POST['lga'] != '' )?sanitize($_POST['lga']):'');
        $address = ((isset($_POST['address']) && $_POST['address'] != '' )?sanitize($_POST['address']):'');
        $directions = ((isset($_POST['directions']) && $_POST['directions'] != '' )?sanitize($_POST['directions']):'');

        if(isset($_GET['add'])){

          $receiver = ((isset($_POST['receiver']) && $_POST['receiver'] != '' )?sanitize($_POST['receiver']):'');
          $number = ((isset($_POST['number']) && $_POST['number'] != '' )?sanitize($_POST['number']):'');
          $state = ((isset($_POST['state']) && $_POST['state'] != '' )?sanitize($_POST['state']):'');
          $city = ((isset($_POST['city']) && $_POST['city'] != '' )?sanitize($_POST['city']):'');
          $lga = ((isset($_POST['lga']) && $_POST['lga'] != '' )?sanitize($_POST['lga']):'');
          $address = ((isset($_POST['address']) && $_POST['address'] != '' )?sanitize($_POST['address']):'');
          $directions = ((isset($_POST['directions']) && $_POST['directions'] != '' )?sanitize($_POST['directions']):'');
          $errors = array();
          $required = array('receiver','number','state','lga','city','address');
          foreach($required as $f){
            if(empty($_POST[$f])){
              $errors[] = 'Must fill out all fields.';
              break;
            }
          }

          //too lazy to do other checks
          if(empty($errors)){
            $insertsql28 = "UPDATE userlogin SET `number` ='$number', city = '$city', state = '$state', lga = '$lga', address = '$address',  directions = '$directions', receiver = '$receiver' WHERE id = '$customer_id'";
            $db->query($insertsql28);
          }

          echo '<script>location.replace("account.php")</script>';


        }

    ?>
        <?php if($a1 == '' || $a2 == '' || $a3 == '' || $a4 == '' ): ?>
          <div id="delivery-address" class="tab-pane">
            <ul class="nav">
              <li class="active">
                <a data-toggle="tab" href="#change-address" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-t-9 m-b-15">
                  Add Address
                </a>
              </li>
            </ul>
            <hr>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Address</h4><hr>
                  <h4 class="mtext-109 cl2 m-t-9 m-b-15 p-t-20">
                    No Address has been set
                  </h4>
                </div>
              </div>
            </div>
          </div>


        <?php else: ?>
          <div id="delivery-address" class="tab-pane">
            <ul class="nav">
              <li class="active">
                <a data-toggle="tab" href="#change-address" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-t-9 m-b-15">
                  Change Address
                </a>
              </li>
            </ul>
            <hr>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Address</h4><hr>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-account-circle m-r-10"></i>      <?= $a7; ?></p>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-home m-r-10"></i>
                     <?= $home; ?>
                  </p>
                  <p class="page-header m-t-9 m-b-15 p-t-20"><i class="zmdi zmdi-phone-in-talk m-r-10"></i>   <?= $a6; ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if(isset($_GET['add'])): ?>
          <div id="change-address" class="tab-pane active">
        <?php else: ?>
          <div id="change-address" class="tab-pane">
        <?php endif; ?>

            <a data-toggle="tab" href="account.php?add=1" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-t-9 m-b-15" onclick="reload()">
              Cancel
            </a>
            <hr>
            <div class="col-md-12">
                  <h4 class="card-title">Address</h4><hr>
                  <span id="modal_errors" class="text-danger p-t-24 col-lg-12"><?php if(!empty($errors)){echo display_errors2($errors);}?></span>
                  <form class="container" action="account.php?add=1" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="receiver"> Receivers Name: </label>
                      <input type="text" name="receiver" id="receiver" class="form-control" value="<?= $receiver; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="number"> Number: </label>
                      <input type="text" name="number" id="number" class="form-control" value="<?= $number; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="state"> State: </label>
                      <select class="form-control" id="state" name="state">
                                              <option value="<?= (($state == '')?' selected':''); ?>">- Choose A State -</option>
                                            <?php while($s = mysqli_fetch_assoc($stateQuery)): ?>
                                              <option value="<?= $s['id']; ?>"<?= (($state == $s['id'])?' selected':''); ?>><?= $s['states']; ?></option>
                                            <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lga"> LGA: </label>
                      <select name="lga" id="lga" class="form-control">
                      </select>

                    </div>
                    <div class="form-group col-md-6">
                      <label for="city"> City: </label>
                      <input type="text" name="city" id="city" class="form-control" value="<?= $city; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address"> Street Address: </label>
                      <input type="text" name="address" id="address" class="form-control" value="<?= $address; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="directions">Directions:</label>
                      <textarea id="directions" name="directions" class="form-control" rows="6"><?= $directions; ?></textarea>
                    </div>
                    <div class="form-group col-md-6 text-right vida" >
                    </div>
                  </div>
                  <div class="form-group move">
                    <input class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer" type="submit" value="Save">
                  </div>
                  <!-- <a href="account.php?add=1" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">Save</a> -->
                  </form>

          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  function reload(){
    location.replace("account.php");
  }


</script>
