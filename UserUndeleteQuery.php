<?php

function UserUndeleteQueryHandler(){
  global $ASTRIA;

  if(path(1)==false){
    die('No query specified.');
  }

  $Query = Query('
    SELECT QueryID 
    FROM Query 
    WHERE 
      UserID  = '.$ASTRIA['Session']['User']['UserID'].' AND
      QueryID = '.intval(path(1)).'
  ');
  
  if(!(isset($Query[0]))){
    //TODO this should probably be some kind of fork feature
    die('You do not have permission to undelete that Query.');
  }
  
  Query("
    UPDATE Query SET
      Trash = 0
    WHERE 
      UserID  = ".$ASTRIA['Session']['User']['UserID']." AND
      QueryID = ".intval(path(1))."
  ");
  
  header('Location: /');
  exit;
  
}
