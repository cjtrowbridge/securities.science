<?php

function UserEditQueryPostHandler(){
  global $ASTRIA;
  $Results = Query("
    SELECT COUNT(*) as 'Count' 
    FROM Query 
    WHERE
      UserID        = ".$ASTRIA['Session']['User']['UserID']." AND
      QueryID       = ".intval($_POST['QueryID'])."
  ");
  if($Results[0]['Count']==0){
    //TODO
    die("Create fork of query owned by current user");
  }
  
  $Name             = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$_POST['name']);
  $Description      = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$_POST['description']);
  $Code             = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$_POST['code']);
  
  $SQL="
    UPDATE `Query` SET 
      `Name`        = '".$Name."', 
      `Description` = '".$Description."', 
      `Code`        = '".$Code."',
      `CodeSHA2`    = '".sha256($Code)."'
    WHERE 
      UserID        = ".$ASTRIA['Session']['User']['UserID']." AND
      QueryID       = ".intval($_POST['QueryID'])."
  ";
  Query($SQL);
  header('Location: /edit-query/'.intval($_POST['QueryID']));
  exit;
}

function UserEditQueryBodyCallback(){
  if(path(1)==false){
    echo 'Query Not Found.';
    return;
  }
  $Query=Query("SELECT * FROM Query WHERE QueryID = ".intval(path(1)));
  if(!(isset($Query[0]))){
    echo 'Query Not Found.';
    return;
  }
  $Query=$Query[0];
  ?>
<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      <h1>Edit Query</h1>
      <form action="/edit-query" method="post" class="form">
        <input type="hidden" name="QueryID" value="<?php echo $Query['QueryID']; ?>">
        <div class="row no-gutters">
          <div class="query">
            
            <div class="options">
              <i class="material-icons" title="Delete Query">clear</i>
              <i class="material-icons" title="Edit Query">edit</i>
              <i class="material-icons" title="Run Now">flight_takeoff</i>
            </div>
            
            <div class="name">
              <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $Query['Name']; ?>">
              </div>
            </div>
            
            <div class="form-group">
              <p><b>Description:</b></p>
              <textarea class="AstriaEditor ready" id="description" name="description"><?php echo $Query['Description']; ?></textarea>
            </div>
            
            <div class="form-group">
              <?php
                //TODO this should eventually become a selector what which engine to use, but for now it is only MySQL
              ?>
              <p><b>MySQL Code:</b></p>
              <textarea class="AstriaEditor ready" id="code" name="code"><?php echo $Query['Code']; ?></textarea>
            </div>
            
            <script>
              AstriaEditor();
              $('#code').focus();
            </script>
            
            <div class="form-group">
              <input type="submit" class="btn btn-success" value="Save Changes">
            </div>
          </div>  
        </div>
      </form>
    </div>      
  </div>
</div>

  <?php
}
