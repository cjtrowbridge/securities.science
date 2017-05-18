<?php

function UserEditQueryBodyCallback(){
  ?>

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
                <input type="text" class="form-control" id="usr">
              </div>
            </div>
            
            <div class="form-group">
              <p><b>Description:</b></p>
              <textarea class="AstriaEditor ready" id="description" name="description"></textarea>
            </div>
            
            <div class="form-group">
              <p><b>MySQL Code:</b></p>
              <textarea class="AstriaEditor ready" id="query" name="query"></textarea>
            </div>
            
            <script>
              AstriaEditor();
              $('#query').focus();
            </script>
            
            <div class="form-group">
              <button type="button" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>

  <?php
}
