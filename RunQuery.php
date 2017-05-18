<?php

function ReadOnlyQuery($QueryID){
  global $ASTRIA;
  
  //TODO check user quota or public quota
  
  $Results = Query("SELECT Code,RunCounter FROM Query WHERE QueryID = ".intval($QueryID));
  if(count($Results)==0){
    die('Invalid Query ID');
  }
  
  
  $Engine          = Query($Results[0]['Code'],'stockhistory-readonly');
  $Parser          = ArrTabler($Engine);
  
  $EngineSanitized = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],serialize($Engine));
  $ParserSanitized = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$Parser);

  Query("
    UPDATE Query SET
      LastRun          = NOW(),
      EngineLastOutput = '".$EngineSanitized."',
      ParserLastOutput = '".$ParserSanitized."',
      RunCounter       = ".($Results['RunCounter']+1)."
    WHERE QueryID = ".intval($QueryID)
  );
  
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
  
  ace('ReadOnlyQuery('.$Query['QueryID'].');');
}
