<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
function Age($dob) {
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    } else {
        return 0;
    }
}
?>