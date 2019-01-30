<?php
$name = ((isset($_POST['name']))?sanitize($_POST['name']):$user_data['full_name']);
$email = ((isset($_POST['email']))?sanitize($_POST['email']):$user_data['email']);
$occ = ((isset($_POST['occ']))?sanitize($_POST['occ']):$user_data['Occupation']);
$number = ((isset($_POST['number']))?sanitize($_POST['number']):$user_data['number']);
$errors = array();
if($_POST){
      //make sure every field is filled
      $required = array('name', 'email', 'occ', 'number', 'occ');
      foreach($required as $f){
        if(empty($_POST[$f])){
          $errors[] = 'Must fill out all fields.';
          break;
        }
      }

      //validate email
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Plase enter a Valid Email address';
      }

      //to display errors
      if(empty($errors)){
        //Add user to database
        $updatesql3 = "UPDATE users SET full_name = '$name', email = '$email', Occupation = '$occ', number = '$number', WHERE id = '$user_id'";
      $db->query($updatesql3);
      $_SESSION['success_flash'] = 'Profile has been edited';
      //header('Location: profile.php');
    }
}

?>
<!-- edit-profile -->
<div id="edit-profile" class="tab-pane">
  <section class="panel">
    <div class="panel-body bio-graph-info">
      <h1> Profile Info</h1>
      <form class="container" action="profile.php" method="POST">
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name"> Full Name: </label>
          <input type="text" name="name" id="name" class="form-control" value="<?= $name; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="email"> Emai Address: </label>
          <input type="email" name="email" id="email" class="form-control" value="<?= $email; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="number"> Phone Number: </label>
          <input type="text" name="number" id="number" class="form-control" value="<?= $number; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="occ"> Occupation: </label>
          <select class="form-control" name="occ">
            <option value=""<?= (($occ == '')?' selected': ''); ?>></option>
            <option value="Web Designer"<?= (($occ == 'Web Designer')?' selected': ''); ?>>Web Designer</option>
            <option value="Front-End Developer"<?= (($occ == 'Front-End Developer')?' selected': ''); ?>>Front-End Developer</option>
            <option value="UI Designer"<?= (($occ == 'UI Designer')?' selected': ''); ?>>UI Designer</option>
            <option value="UX Designer"<?= (($occ == 'UX Designer')?' selected': ''); ?>>UX Designer</option>
            <option value="Interaction Designer"<?= (($occ == 'Interaction Designer')?' selected': ''); ?>>Interaction Designer</option>
            <option value="Art Director"<?= (($occ == 'Art Director')?' selected': ''); ?>>Art Director</option>
            <option value="Web Developer"<?= (($occ == 'Web Developer')?' selected': ''); ?>>Web Developer</option>
            <option value="Full stack Developer"<?= (($occ == 'Full stack Developer')?' selected': ''); ?>>Full stack Developer</option>
            <option value="Web Adminstrator"<?= (($occ == 'Web Adminstrator')?' selected': ''); ?>>Web Adminstrator</option>
          </select>
        </div>
        <div class="form-group col-md-6 text-right vida" >
          <a href="profile.php" class="btn btn-default">Cancel</a>
          <input type="submit" value="Edit Profile" class="btn btn-primary">
        </div>
      </div>
      </form>
    </div>
  </section>
</div>
</div>
</div>
</section>
</div>
</div>

<!-- page end-->
</section>
</section>
