<?php

function UserEditQueryBodyCallback(){
  ?>

<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      <h1>Edit Query</h1>
      <div class="container">
        <div class="row no-gutters">
          <div class="query">
            <div class="options">
              <i class="material-icons" title="Delete Query">clear</i>
              <i class="material-icons" title="Edit Query">edit</i>
              <i class="material-icons" title="Run Now">flight_takeoff</i>
            </div>
            <div class="name">Query Name</div>
            <div class="lastRun">Last Run</div>
            <div class="description">Query Description</div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

  <?php
}
