<?php

function UserDeleteQueryHandler(){
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
    die('You do not have permission to delete that Query.');
  }
  
  Query("
    UPDATE Query SET
      Trash = 1
    WHERE 
      UserID  = '.$ASTRIA['Session']['User']['UserID'].' AND
      QueryID = '.intval(path(1)).'
  ");
  
  header('Location: /');
  exit;
  
}
