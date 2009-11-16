<?php

/**
Securimage Test Script
Version 1.0 - 01/02/2008

Upload this PHP script to your web server and call it from the browser.
The script will tell you if you meet the requirements for running Securimage.

http://www.phpcaptcha.org
*/


if (isset($_GET['testimage']) && $_GET['testimage'] == '1') {
  $im = imagecreate(225, 225);
  $white = imagecolorallocate($im, 255, 255, 255);
  $black = imagecolorallocate($im, 0, 0, 0);
 
  $red   = imagecolorallocate($im, 255,   0,   0);
  $green = imagecolorallocate($im,   0, 255,   0);
  $blue  = imagecolorallocate($im,   0,   0, 255);

  // draw the head
  imagearc($im, 100, 120, 200, 200,  0, 360, $black);
  // mouth
  imagearc($im, 100, 120, 150, 150, 25, 155, $red);
  // left and then the right eye
  imagearc($im,  60,  95,  50,  50,  0, 360, $green);
  imagearc($im, 140,  95,  50,  50,  0, 360, $blue);

  imagestring($im, 5, 15, 1, 'Securimage Will Work!!', $blue);
  imagestring($im, 2, 5, 20, ':) :) :)', $black);
  imagestring($im, 2, 5, 30, ':) :)', $black);
  imagestring($im, 2, 5, 40, ':)', $black);

  imagestring($im, 2, 150, 20, '(: (: (:', $black);
  imagestring($im, 2, 168, 30, '(: (:', $black);
  imagestring($im, 2, 186, 40, '(:', $black);

  imagepng($im, null, 3);
  exit;
}

function print_status($supported)
{
  if ($supported) {
    echo "<span style=\"color: #00f\">Yes!</span>";
  } else {
    echo "<span style=\"color: #f00; font-weight: bold\">No</span>";
  }
}

?>
<html>
<head>
  <title>Securimage Test Script</title>
</head>

<body>

<h2>Securimage Test Script</h2>
<p>
  This script will test your PHP installation to see if Securimage will run on your server.
</p>

<ul>
  <li>
    <strong>GD Support:</strong>
    <?php print_status($gd_support = extension_loaded('gd')); ?>
  </li>
  <?php if ($gd_support) $gd_info = gd_info(); else $gd_info = array(); ?>
  <?php if ($gd_support): ?>
  <li>
    <strong>GD Version:</strong>
    <?php echo $gd_info['GD Version']; ?>
  </li>
  <?php endif; ?>
  <li>
    <strong>TTF Support (FreeType):</strong>
    <?php print_status($gd_support && $gd_info['FreeType Support']); ?>
    <?php if ($gd_support && $gd_info['FreeType Support'] == false): ?>
    <br />No FreeType support.  Cannot use TTF fonts, but you can use GD fonts
    <?php endif; ?>
  </li> 
  <li>
    <strong>JPEG Support:</strong>
    <?php print_status($gd_support && $gd_info['JPG Support']); ?>
  </li>
  <li>
    <strong>PNG Support:</strong>
    <?php print_status($gd_support && $gd_info['PNG Support']); ?>
  </li>
  <li>
    <strong>GIF Read Support:</strong>
    <?php print_status($gd_support && $gd_info['GIF Read Support']); ?>
  </li>
  <li>
    <strong>GIF Create Support:</strong>
    <?php print_status($gd_support && $gd_info['GIF Create Support']); ?>
  </li>
 
</ul>

<?php if ($gd_support): ?>
Since you can see this...<br /><br />
<img src="<?php echo $_SERVER['PHP_SELF']; ?>?testimage=1" alt="Test Image" align="bottom" />
<?php else: ?>
Based on the requirements, you do not have what it takes to run Securimage :(
<?php endif; ?>

</body>
</html>
