<?php
  if(!empty($_FILES)){

  $tempfile = $_FILES["file"]["tmp_name"];                          //Temporary file location on server
  $fname = $_POST["fname"];                                        //Custom File name input
  $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);  //File extention
  $name = $fname . '.' . $type;                                  //Complete file name with extention to be used in API

  require('doodstream.php');  //Path to the library should be correct!
  $ds = new DoodstreamAPI();
  $key = "api-key-here";      //Insert API key here
  $ds->Setup($key);
  $result = $ds->Upload($tempfile, $type, $name);
  print_r($result);
  }
  else{
    die('No file uploaded');
  }


?>
