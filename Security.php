<?php

function SecurityBodyCallback(){
  global $ASTRIA;
  $Title = 'Securities';
  if(!(path(1)==false)){
    $Symbol = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],path(1));
    $Symbol=strtoupper($Symbol);
    $Symbol=Query("SELECT Symbol FROM Security WHERE upper(Symbol) LIKE '".$Symbol."'");
    if(isset($Symbol[0])){
      $Title=$Symbol[0]['Symbol'];
    }
  }
 ?>
 <h1><?php echo $Title; ?></h1>
 <?php
}
