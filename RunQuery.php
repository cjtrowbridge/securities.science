<?php

function ReadOnlyQuery($QueryID){
  global $ASTRIA;
  
  //TODO check user quota or public quota
  
  $Results = Query("SELECT Code,RunCounter FROM Query WHERE QueryID = ".intval($QueryID));
  if(count($Results)==0){
    die('Invalid Query ID');
  }
  $Results=$Results[0];
  
  $Engine          = Query($Results['Code'],'stockhistory-readonly');
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
  
  echo $Parser;
  exit;
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
  <h1>
    <?php echo $Query['Name']; ?>
    <div style="float: right;">
      <a href="/edit-query/<?php echo $Query['QueryID']; ?>"><i class="material-icons" title="Edit Query">edit</i></a>
    </div>
  </h1>
  <p><?php echo nl2br($Query['Description']); ?></p>
<?php
  
  $Preview=' Running query now. While you wait, take a look at the results from last time it was run...<br><br>'.$Query['ParserLastOutput'];
  ace('ReadOnlyQuery('.$Query['QueryID'].');','','',$Preview);
}
