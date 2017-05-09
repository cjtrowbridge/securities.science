<?php

function SecuritiesScienceQueryEngine(){
  if(path(0)=='query'){
  
    //User is trying to run a query. Validate that there is an integer QueryID passed or provide feedback.
    if(intval(path(1))==0){
      OutputJSON(array("error"=>"Invalid QueryID: ".path(1).".\n Proper Syntax: /query/QueryID"));
    }
    
    //Record user activity and check whether they are running some crazy number of queries
    //Validate Query and Run, Return Results
    
    
    //QueryEngine should always exit if called.
    exit;
  }
}
