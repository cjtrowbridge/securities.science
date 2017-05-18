<?php

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
