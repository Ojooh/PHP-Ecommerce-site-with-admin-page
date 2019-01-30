<?php
$number =' 0908765432123455';
if ((!is_numeric($number)) || (strlen((string)$number) < 11)){
  echo 'Invalid Phone Number entered, Phone Number must be at least 11 characters Long.';
}
else {
  echo '<script> swal("THANK YOU", "Your Account has been created, Proceed to your email for the verification Link !", "success");</script>';
}


?>
