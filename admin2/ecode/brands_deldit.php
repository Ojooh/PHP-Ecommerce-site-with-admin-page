<?php
    //Edit Brand
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $edit_id = sanitize($edit_id);
      $sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
      $edit_result = $db->query($sql2);
      $ebrand = mysqli_fetch_assoc($edit_result);
      echo '<script>location.replace("brands.php");</script>';
    }


    //Delete brands
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
      $delete_id = (int)$_GET['delete'];
      $delete_id = sanitize($delete_id);
      $sql2 = "DELETE FROM brand WHERE id = '$delete_id'";
      $db->query($sql2);
      echo '<script>location.replace("brands.php");</script>';
}
?>
