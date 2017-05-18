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
            <div class="name">
              <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="usr">
              </div>
            </div>
            <div class="lastRun">Last Run</div>
            
            <p><b>Description:</b></p>
            <textarea class="AstriaEditor ready" id="description" name="description" onmouseup="$(this).css('border-color','red');"></textarea>
            
            <p><b>MySQL Code:</b></p>
            <textarea class="AstriaEditor ready" id="query" name="query" onmouseup="$(this).css('border-color','red');"></textarea>
            
            <script>
              AstriaEditor();
              $('#query').focus();
            </script>
            
            <div>
              <button type="button" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

  <?php
}
