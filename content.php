<?php
include("./includes/header.php");
$story = key($_GET);
if (file_exists('./content/'.$story.".php"))
{
  include("./content/".$story.".php");
}
?>
