<?php

function UserCreateQueryPostHandler(){
  
  $Name = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$_POST['name']);
  
  Query("
    INSERT INTO `Queries`(
      `UserID`, 
      `Name`, 
      `Description`, 
      `EngineID`, 
      `ParserID`, 
      `EngineLastOutput`, 
      `ParserLatstOutput`, 
      `LastRun`, 
      `Code`, 
      `CodeSHA2`
    )VALUES(
      '".$ASTRIA['Session']['User']['UserID']."',
      '".$Name."',
      '',
      '1',
      '1',
      NULL,
      NULL,
      0,
      NULL,
      NULL
    );
  ");
  header('Location: /edit-query/'.mysqli_insert_id($ASTRIA['databases']['astria']['resource']));
  exit;
  
}
function UserCreateQueryBodyCallback(){
  ?>
<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      
      <h1>Create Query</h1>
      
      <div class="row no-gutters">
        <div class="query">
          <form class="form" action="/create-query" method="post">
            <p>First, name your query...</p>

            <div class="name">
              <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-success" value="Create">
            </div>
            <script>
              $('#name').focus();
            </script>
          </form>
        </div>
      </div>
        
    </div>      
  </div>
</div>

  <?php
}
