<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $filename = $_POST['year'] . '/' . 'moneyOnGrafik/' . $_POST['mes'] . '.txt';

      if ($_POST['s'] == 'save'){
          file_put_contents($filename, $_POST['text_new']);
      }
      else{
          $text = file_get_contents($filename);

          echo $text;
      }
    }

?>
