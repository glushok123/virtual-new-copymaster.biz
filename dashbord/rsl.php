<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if ($_POST['s'] == 'save'){
      $filename ='2022/den/'.$_POST['mes'].'.txt';
      file_put_contents($filename, $_POST['text_new']);
  }
  else{
    $filename ='2022/den/'.$_POST['mes'].'.txt';
    $text = file_get_contents($filename);
    echo $text;
  }
}

 ?>
