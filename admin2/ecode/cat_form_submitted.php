
<?php
//process form
  if(isset($_POST) && !empty($_POST)){
    $post_parent = sanitize($_POST['parent']);
    $category = sanitize($_POST['category']);
    $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
    if(isset($_GET['edit'])){
      $id = $edit_category['id'];
      $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id != '$id'";
    }
    $fresult = $db->query($sqlform);
    $count = mysqli_num_rows($fresult);


    //if category is blank
    if($category == ''){
      $errors[] .= 'The category field cannot be left blank.';
    }


    //if input exists in Database
    if($count > 0){
      $errors[] .= $category. ' already exists. Please choose a new category';
    }

    //Display Eroors or update DATABASE
    if(!empty($errors)){
      //display $errors
      $display = display_errors($errors); ?>
      <script>
        jQuery('document').ready(function(){
          jQuery('#errors').html('<?= $display; ?>');
        });
      </script>
    <?php
   }else{
      //update database
      $updatesql = "INSERT INTO categories (category, parent ) VALUES ('$category','$post_parent')";
      if(isset($_GET['edit'])){
        $updatesql = "UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
      }
      $db->query($updatesql);
      header('Location: categories.php');
    }

  }


  $category_value = '';
  $parent_value = 0;
  if(isset($_GET['edit'])){
    $category_value = $edit_category['category'];
    $parent_value = $edit_category['parent'];
  }
  else{
    if(isset($_POST)){
      $category_value = $category;
      $parent_value = $post_parent;
    }
  }
?>
