<?php
//var_dump($_SERVER);
//die();
include("./includes/header.php");
/*$x = array();
$x['Stand Alone Stories'][] = array("Title"=>"1","Description"=>"","Published"=>"","ReadTime"=>"","Tags"=>array("x","y"));
$x['Poetry'][] = array("Title"=>"2","Description"=>"","Published"=>"","ReadTime"=>"","Tags"=>array("x","y"));
echo json_encode($x);
die();*/
$file = fopen("stories.json", "r") or die("Unable to open file!");
$json = (fread($file,filesize("stories.json")));
$stories = json_decode($json,true);
fclose($file);


switch( key($_GET))
{
  case "Poetry":
    $key = 'Poetry';
    break;
  default:
    $key = 'Stand Alone Stories';
    break;
}


 ?>

<?php
echo '<section>';
echo '<h3>'.$key.'</h3>';
foreach($stories[$key] as $article)
{



    echo '<article>';
    echo isset($article['Link']) ?  '<header><a href="'.$article['Link'].'">'.$article['Title'].'</a></header>' : '<header>'.$article['Title'].'</header>';;
    echo '<h5>(horror,suspense)</h5>';
    echo $article['Description'];
    echo '<h6>'.$article['Published'].' * '.$article['ReadTime'].' Minute(s)</h6>';
    echo '</article>';


}
echo '</section>';
 ?>
  <!-- Keep all JS at bottom -->
  <script defer="true" async="true" src="?v=1.0"></script>
  <script type="text/javascript">
  </script>
</body>
</html>
