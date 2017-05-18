<?php

function ExploreTableBodyCallback(){
  global $ASTRIA;

  if(path(1)==false){
    echo '<h1>No Table Specified</h1>';
    return;
  }
  
  $Name = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],path(1));
  
  $Description = Query("SELECT * FROM Tables WHERE Name LIKE '".$Name."'",'stockhistory');
  if(!(isset($Description[0]))){
    echo '<h1>Invalid Table Specified</h1>';
    return;
  }
  $Description = $Description[0];
  ?>
  
  <h1><?php echo $Description['Name']; ?></h1>
  <p><?php echo $Description['Description']; ?></p>
  
  <h2>Table Description</h2>
  <?php
  
  $Describe = Query('describe '.$Description['Name'],'stockhistory');
  echo ArrTabler($Describe);
  
  ?>
  
  <h2>Table Contents (Top 100 Rows)</h2>
  <?php
  
  $Describe = Query('SELECT * FROM '.$Description['Name'].' LIMIT 100','stockhistory');
  echo ArrTabler($Describe);
  
  
}
