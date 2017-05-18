<?php

function PublicExploreBodyCallback(){
  ?>

<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      <h4>Explore securities.science</h4>
      <p>Check us out on <a href="https://github.com/cjtrowbridge/securities.science" target="_blank">Github</a> and please <a href="mailto:chris.j.trowbridge@gmail.com">send me an email</a> if you have any comments of suggestions about how to improve this tool!</p>
    
      <?php
        $Queries = Query("
          SELECT 
            FirstName,
            LastName,
            QueryID,
            Name,
            Description,
            LastUpdated
          FROM Query
          LEFT JOIN Users ON Query.UserID = Users.UserID
          ORDER BY LastUpdated DESC
        ");
        //TODO make this smarter
  
        foreach($Queries as $Query){
          $NiceURLTitle=strtolower($Query['Name']);
          $NiceURLTitle=urlencode($NiceURLTitle);
          $NiceURLTitle=str_replace('%20','+',$NiceURLTitle);
          
      ?>
      
      <div class="row no-gutters">
        <div class="query">
          <div class="options">
            <i class="material-icons" title="Edit Query">edit</i>
          </div>
          <div class="name"><a href="/run-query/<?php echo $Query['QueryID']; ?>/<?php echo $NiceURLTitle; ?>"><?php echo $Query['Name']; ?></a></div>
          <div class="lastUpdated"><?php echo ago($Query['LastUpdated']); ?> by <?php echo $Query['FirstName'].' '.$Query['LastName']; ?></div>
          <div class="description"><?php echo $Query['Description']; ?></div>
        </div>
      </div>
      
      <?php
        }
      ?>
      
      
    </div>
  </div>
</div>

  <?php
}
