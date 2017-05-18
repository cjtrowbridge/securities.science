<?php

function UserHomepageBodyCallback(){
  global $ASTRIA; 
?>

  <div class="row no-gutters">
    <div class="col-md-12">
      <h1>Welcome to securities.science</h1>
      <p>Check us out on <a href="https://github.com/cjtrowbridge/securities.science" target="_blank">Github</a> and please <a href="mailto:chris.j.trowbridge@gmail.com">send me an email</a> if you have any comments of suggestions about how to imrpove this tool!</p>
    
      <h1>My Queries</h1>
      <p><a href="/create-query">Create New Query</a></p>
      <p>This page shows all the queries you are working on and lets you run or edit them.</p>
      <p>You can <a href="/create-query">create a new query now</a> or check out some queries <a href="/explore">other people are working on</a>.</p>
      
      <?php
        $Queries = Query("SELECT * FROM Query WHERE Trash=0 AND UserID = ".$ASTRIA['Session']['User']['UserID']);
        foreach($Queries as $Query){
          $NiceURLTitle=strtolower($Query['Name']);
          $NiceURLTitle=urlencode($NiceURLTitle);
          $NiceURLTitle=str_replace('%20','+',$NiceURLTitle);
          
      ?>
      
      <div class="row no-gutters">
        <div class="query">
          <div class="options">
            <a href="/delete-query/<?php echo $Query['QueryID']; ?>"><i class="material-icons" title="Delete Query">clear</i></a>
            <a href="/edit-query/<?php echo $Query['QueryID']; ?>"><i class="material-icons" title="Edit Query">edit</i></a>
          </div>
          <div class="name"><a href="/run-query/<?php echo $Query['QueryID']; ?>/<?php echo $NiceURLTitle; ?>"><?php echo $Query['Name']; ?></a></div>
          <div class="lastRun"><?php echo ago($Query['LastRun']); ?></div>
          <div class="description"><?php echo $Query['Description']; ?></div>
        </div>
      </div>
      
      <?php
        }
      
      $Queries = Query("SELECT * FROM Query WHERE Trash=1 AND UserID = ".$ASTRIA['Session']['User']['UserID']);
      if(count($Queries)>0{
          
      ?>
      
      <p class="text-center"><button type="button" class="btn btn-success" onclick="$('#trash').slideToggle('fast');">Show Deleted Queries</button></p>
      
      <div id="trash" class="hidden">
          <?php            
          
          foreach($Queries as $Query){
            $NiceURLTitle=strtolower($Query['Name']);
            $NiceURLTitle=urlencode($NiceURLTitle);
            $NiceURLTitle=str_replace('%20','+',$NiceURLTitle);

        ?>

        <div class="row no-gutters">
          <div class="query">
            <div class="options">
              <a href="/undelete-query/<?php echo $Query['QueryID']; ?>"><i class="material-icons" title="Undelete Query">add</i></a>
              <a href="/edit-query/<?php echo $Query['QueryID']; ?>"><i class="material-icons" title="Edit Query">edit</i></a>
            </div>
            <div class="name"><a href="/run-query/<?php echo $Query['QueryID']; ?>/<?php echo $NiceURLTitle; ?>"><?php echo $Query['Name']; ?></a></div>
            <div class="lastRun"><?php echo ago($Query['LastRun']); ?></div>
            <div class="description"><?php echo $Query['Description']; ?></div>
          </div>
        </div>

        <?php
          }
        ?>
      </div>
      <?php
      }
      ?>
      
    </div>
  </div>

  <?php
}
