<?php

function UserHomepageBodyCallback(){
  ?>

<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      <h4>Welcome to securities.science</h4>
      <p>Check us out on <a href="https://github.com/cjtrowbridge/securities.science" target="_blank">Github</a> and please <a href="mailto:chris.j.trowbridge@gmail.com">send me an email</a> if you have any comments of suggestions about how to imrpove this tool!</p>
    
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#MyData" role="tab">My Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Explore" role="tab">Explore</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="MyData" role="tabpanel">
          My Data
        </div>
        <div class="tab-pane" id="Explore" role="tabpanel">
          Explore
          
          <p>List people you follow here</p>
          <p>List new and suggested users here</p>
        </div>
      </div>
      
    </div>
  </div>
</div>

  <?php
}
