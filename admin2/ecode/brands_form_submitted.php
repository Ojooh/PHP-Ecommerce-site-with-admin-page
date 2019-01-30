<?php
    if(isset($_POST['add_submit'])){
      $brand = sanitize($_POST['brand']);
      //check if input is blank
      if($_POST['brand'] == ''){
        $errors[] .= 'Please enter a brand!';
      }

      //check if brand exists in Database
      $SQL = "SELECT * FROM brand WHERE brand = '$brand'";
      if(isset($_GET['edit'])){
        $sql = "SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id'";
      }
      $result2 = $db->query($SQL);
      $count = mysqli_num_rows($result2);
      if($count > 0){
        $errors[] .=$brand.' alraedy exists. Please choose another brand name';
          }

      //display errors
      if(empty($errors)){
        //Add to Database
        $sql = "INSERT INTO brand (brand) values ('$brand')";
        if(isset($_GET['edit'])){
          $sql = "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id'";
        }
        $db->query($sql);
        header('Location: brands.php');

      }
    }
?>
