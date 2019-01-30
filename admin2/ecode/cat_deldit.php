<?php
//Edit category
if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $edit_id = sanitize($edit_id);
  $edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
  $edit_result = $db->query($edit_sql);
  $edit_category = mysqli_fetch_assoc($edit_result);

}



  //delete CATEGORY
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "SELECT * FROM categories WHERE id = '$delete_id'";
    $result = $db->query($sql);
    $del_category = mysqli_fetch_assoc($result);
    if($del_category['parent'] == 0){
      $delsql1 = "DELETE FROM categories WHERE id = '$delete_id'";
      $db->query($delsql1);
    }
    $delsql2 = "DELETE FROM categories WHERE id = '$delete_id'";
    $db->query($delsql2);
    header('Location: categories.php');
  }
?>
