<?php
$headerFileName = './includes/header.html';
$footerFileName = './includes/footer.html';
$headerHTML = file_get_contents($headerFileName);
$footerHTML = file_get_contents($footerFileName);
$HTML = $headerHTML.$footerHTML;
$outPutFile = fopen("./compiled/index.html", "w") or die("Unable to open file!");
fwrite($outPutFile, $HTML);
?>
