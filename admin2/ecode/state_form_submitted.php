
<?php
//process form
  if(isset($_POST) && !empty($_POST)){
    $post_state = sanitize($_POST['parent']);
    $state = sanitize($_POST['state']);
    $sqlform = "SELECT * FROM states WHERE states = '$state' AND parent = '$post_state'";
    if(isset($_GET['edit'])){
      $id = $edit_category['id'];
      $sqlform = "SELECT * FROM states WHERE state = '$state' AND parent = '$post_state' AND id != '$id'";
    }
    $fresult = $db->query($sqlform);
    $count = mysqli_num_rows($fresult);


    //if category is blank
    if($state == ''){
      $errors[] .= 'The LGA field cannot be left blank.';
    }


    //if input exists in Database
    if($count > 0){
      $errors[] .= $state. ' already exists. Please choose a new category';
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
      $updatesql = "INSERT INTO states (states, parent ) VALUES ('$state','$post_state')";
      if(isset($_GET['edit'])){
        $updatesql = "UPDATE states SET states = '$state', parent = '$post_state' WHERE id = '$edit_id'";
      }
      $db->query($updatesql);
      // header('Location: categorie.php');
      echo '<script>location.replace("states.php");</script>';
    }

  }


  $state_value = '';
  $parent_value = 0;
  if(isset($_GET['edit'])){
    $state_value = $edit_state['states'];
    $parent_value = $edit_category['parent'];
  }
  else{
    if(isset($_POST)){
      $state_value = $state;
      $parent_value = $post_state;
    }
  }
?>
