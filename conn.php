<?php
$link = mysqli_connect("localhost","exuljrci_exultradigiuser","ApXCmG4NzWUjpba","exuljrci_exultradigidb");
// $link = mysqli_connect("localhost","root","","exultradigidb");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to Database: " . mysqli_connect_error();
  }
?>