<?php

function ReadOnlyQuery($QueryID){
  
  //TODO check user quota or public quota
  
  $Results = Query("SELECT Code FROM Query WHERE QueryID = ".intval($QueryID));
  if(count($Results)==0){
    die('Invalid Query ID');
  }
  
  $Table=Query($Results[0]['Code'],'stockhistory-readonly');
  echo ArrTabler($Table);
}

function RunQueryBodyCallback(){
  global $ThisQuery;
  if(count($ThisQuery)==0){
    ?>
  <h1>Query Not Found!</h1>
    <?php
  }
  
  $Query=$ThisQuery[0];
  
  ?>
  <h1><?php echo $Query['Name']; ?></h1>
  <p><?php echo nl2br($Query['Name']); ?></p>
<?php
  
  ace('ReadOnlyQuery('.$ThisQuery['QueryID'].');');
}
