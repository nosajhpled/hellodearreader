<?php

$css = file_get_contents('.//css/main.css');
$outPutFile = fopen(".//compiled//main.css", "w") or die("Unable to open file[1]!");
fwrite($outPutFile, $css);



$headerFileName = './includes/header.html';
$footerFileName = './includes/footer.html';
$headerHTML = file_get_contents($headerFileName);
$footerHTML = file_get_contents($footerFileName);
//$HTML = $headerHTML.$footerHTML;

// index page
$file = fopen("site.json", "r") or die("Unable to open file!");
$json = (fread($file,filesize("site.json")));
$pages = json_decode($json,true);
fclose($file);


foreach($pages as $page)
{
  $HTML = $headerHTML;
  $HTML .=  '<section>';
  $HTML .=  '<h3>'.$page['Title'].'</h3>';

  foreach($page['Contents'] as $section){

    $readTime = 0;
    if (file_exists('.//content//'.$section['Link'].'.php'))
    {
      $content = file_get_contents('.//content//'.$section['Link'].'.php');
      $content = (isset($section['Unformatted']) && $section['Unformatted'] ) ? nl2br($content) : $content;
      $outPutFile = fopen(".//compiled//".$section['Link'].'.html', "w") or die("Unable to open file[1]!");
      fwrite($outPutFile, $headerHTML.$content.$footerHTML);
      $readTime = round(count(explode(' ',$content))/200,1);
    }

      $HTML .=  '<article>';
      $HTML .= isset($section['Link']) ?  '<a href="'.$section['Link'].'.html"><header>'.$section['Title'].'</header>' : '<header>'.$section['Title'].'</header>';;
$HTML .= '<h5>(';
foreach($section['Tags'] as $tag)
{
  $HTML .= $tag.' ';
}
$HTML .= ')</h5>';
      //$HTML .= '<h5>(horrorx,suspensex)</h5>';
      $HTML .= $section['Description'];
      $HTML .= '<h6>'.$section['Published'].' * '.($readTime < 1 ? 'Less than 1' : $readTime).' Minute(s)</h6>';
      $HTML .= '</a></article>';


  }
  $HTML .= '</section>';

$HTML .= '</body>';
$HTML .= $footerHTML;
//print_r($page);
$outPutFile = fopen("./compiled/".$page['Filename'], "w") or die("Unable to open file[1]!");
fwrite($outPutFile, $HTML);

}
?>
