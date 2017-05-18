<?php

function UserEditQueryBodyCallback(){
  if(path(1)==false){
    echo 'Query Not Found.';
    return;
  }
  $Query=Query("SELECT * FROM Queries WHERE QueryID = ".intval(path(1)));
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
              <textarea class="AstriaEditor ready" id="description" name="description" value="<?php echo $Query['Description']; ?>"></textarea>
            </div>
            
            <div class="form-group">
              <?php
                //TODO this should eventually become a selector what which engine to use, but for now it is only MySQL
              ?>
              <p><b>MySQL Code:</b></p>
              <textarea class="AstriaEditor ready" id="query" name="code"><?php echo $Query['Code']; ?></textarea>
            </div>
            
            <script>
              AstriaEditor();
              $('#code').focus();
            </script>
            
            <div class="form-group">
              <button type="button" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>

  <?php
}
