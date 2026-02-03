<?php
$source = "c:\\xampp\\htdocs\\portfolio\\assets\\hero_avatar_raw.png";
$dest = "c:\\xampp\\htdocs\\portfolio\\assets\\hero-avatar.png";

// Load the image
$im = imagecreatefrompng($source);
if (!$im) {
    die("Failed to load image");
}

// Get the color of the top-left pixel (assuming it's the background color)
$rgb = imagecolorat($im, 0, 0);
// Make that color transparent
imagecolortransparent($im, $rgb);

// Save the image
imagepng($im, $dest);
imagedestroy($im);

echo "Transparency applied successfully to $dest";
