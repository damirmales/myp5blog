<?php

              //*** Get an input value entered by user ***
function getFormData($key)
{  
  if (!empty($_SESSION['input'] [$key]))
  {

    return htmlspecialchars($_SESSION['input'] [$key]);
  }
  else  
  {
    return null;
  }        
  
}