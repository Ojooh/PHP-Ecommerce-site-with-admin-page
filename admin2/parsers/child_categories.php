<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Baine/core/init.php';
  $parentID =(int)$_POST['parentID'];
  $selected = sanitize($_POST['selected']);
  $childQuery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category");
  ob_start();
?>

  <option value="">- Choose Child Category -</option>
  <?php while($child = mysqli_fetch_assoc($childQuery)): ?>
    <option value="<?= $child['id']; ?>"><?= $child['category']; ?></option>
  <?php endwhile; ?>
  <?php echo ob_get_clean(); ?>
