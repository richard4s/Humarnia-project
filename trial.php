<?php

if(isset($_POST["submit"])) {
if(is_array($_FILES)) {
$file = $_FILES['myImage']['tmp_name'];
$source_properties = getimagesize($file);
$image_type = $source_properties[2];
if( $image_type == IMAGETYPE_JPEG ) {
$image_resource_id = imagecreatefromjpeg($file);
$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
imagejpeg($target_layer,$_FILES['myImage']['name'] . "_thump.jpg");
}
elseif( $image_type == IMAGETYPE_GIF )  {
$image_resource_id = imagecreatefromgif($file);
$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
imagegif($target_layer,$_FILES['myImage']['name'] . "_thump.gif");
}
elseif( $image_type == IMAGETYPE_PNG ) {
$image_resource_id = imagecreatefrompng($file);
$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
imagepng($target_layer,$_FILES['myImage']['name'] . "_thump.png");
}
}
}
function fn_resize($image_resource_id,$width,$height) {
$target_width =200;
$target_height =200;
$target_layer=imagecreatetruecolor($target_width,$target_height);
imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
return $target_layer;
}

//fn_resize('image/cache/catalog/white6.jpg', 200, 200);
imagejpeg($target_layer,"image/cache/catalog/white6.jpg");

echo '<img src="'.$target_layer.'" />'

 ?>


 <form name="frmImageResize" action="" method="post" enctype="multipart/form-data">
<input type="file" name="myImage" />
<input type="submit" name="submit" value="Submit" />
</form>
