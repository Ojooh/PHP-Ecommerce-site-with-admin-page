<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  $parentID =(int)$_POST['parentID'];
  $selected = sanitize($_POST['selected']);
  $lgaQuery = $db->query("SELECT * FROM states WHERE parent = '$parentID' ORDER BY states");
  ob_start();
?>

  <option value="">- Choose Lga Category -</option>
  <?php while($lga = mysqli_fetch_assoc($lgaQuery)): ?>
    <option value="<?= $lga['id']; ?>"><?= $lga['states']; ?></option>
  <?php endwhile; ?>
  <?php echo ob_get_clean(); ?>
