<?php

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

}
