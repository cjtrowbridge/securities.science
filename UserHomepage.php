<?php

function UserHomepageBodyCallback(){
  ?>

<div class="container">
  <div class="row no-gutters">
    <div class="col-md-12">
      <h4>Welcome to securities.science</h4>
      <p>Check us out on <a href="https://github.com/cjtrowbridge/securities.science" target="_blank">Github</a> and please <a href="mailto:chris.j.trowbridge@gmail.com">send me an email</a> if you have any comments of suggestions about how to imrpove this tool!</p>
    
      <h1>My Queries <a href="/create-query"><i class="material-icons">add</i></a></h1>
      <p>This page shows all the queries you are working on and lets you run or edit them.</p>
      <p>You can <a href="/create-query">create a new query now</a> or check out some queries <a href="/explore">other people are working on</a>.</p>
      
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

  <?php
}
