<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if (!function_exists("createThumb")) {
    // 원본 이미지를 넘기면 비율에 따라 썸네일 이미지를 생성함
    function createThumb($imgWidth, $imgHeight, $imgSource, $imgThumb='') {
        if (!$imgThumb)
            $imgThumb = $imgSource;

        //@unlink($imgSource); // 원본 이미지 파일명
        //echo $imgSource; exit;

        $size = getimagesize($imgSource);
        if ($size[2] == 1) 
            $source = imagecreatefromgif($imgSource);
        else if ($size[2] == 2) 
            $source = imagecreatefromjpeg($imgSource);
        else if ($size[2] == 3) 
            $source = imagecreatefrompng($imgSource);
        else 
            return 0;

        $rate = $imgWidth / $size[0];
        $height = (int)($size[1] * $rate);

        if ($size[0] < $imgWidth || $size[1] < $imgHeight) {
            $xWidth = $imgWidth;
            $xHeight = $imgHeight;
            $height = $imgHeight;
        } else {
            $xWidth = $size[0];
            $xHeight = $size[1];
        }

        $target = @imagecreatetruecolor($imgWidth, $imgHeight);
        $white = @imagecolorallocate($target, 255, 255, 255);  
        @imagefilledrectangle($target, 0, 0, $imgWidth, $imgHeight, $white);
        @imagecopyresampled($source, $source, 0, 0, 0, 0, $imgWidth, $height, $xWidth, $xHeight);
        @imagecopy($target, $source, 0, 0, 0, 0, $imgWidth, $imgHeight);

        @imagejpeg($target, $imgThumb, 100);
        @chmod($imgThumb, 0606); // 추후 삭제를 위하여 파일모드 변경
    }
}

// 원본 이미지를 넘기면 비율에 따라 썸네일 이미지를 생성함
function createThumb2($imgWidth, $imgHeight, $imgSource, $imgThumb='', $mb_id) {
    global $g4;

    if (!$imgThumb)
        $imgThumb = $imgSource;

    $size = getimagesize($imgSource);
    if ($size[2] == 1) 
        $source = imagecreatefromgif($imgSource);
    else if ($size[2] == 2) 
        $source = imagecreatefromjpeg($imgSource);
    else if ($size[2] == 3) 
        $source = imagecreatefrompng($imgSource);
    else 
        return 0;

    $rate = $imgWidth / $size[0];
    $height = (int)($size[1] * $rate);

    $target = @imagecreatetruecolor($imgWidth, $imgHeight);
    //@imagecolorallocate($source, 255, 255, 255);
    @imagecopyresampled($source, $source, 0, 0, 0, 0, $imgWidth, $height, $size[0], $size[1]);
    @imagecopy($target, $source, 0, 0, 0, 0, $imgWidth, $imgHeight);
    //$white = imagecolorallocate($target, 255, 255, 255);
    $white = imagecolorallocate($target, 150, 150, 150);
    $black = imagecolorallocate($target, 100, 100, 100);
    $margin=0;
    $n=0;
    for ($y=5;$y<$imgHeight;$y+=100) {
        for ($x=5;$x<$imgWidth;$x+=150) {
            $string = ($n%2) ? $g4[url] : $mb_id;
            $color = ($n%2) ? $white : $black;
            imagestring($target, 1, $x+$margin, $y, $string, $color);
            $n++;
        }
        $margin+=5;
    }
    //@imagettftext($target, 20, 0, 10, 20, $white, "$g4[path]/img/arialbd.ttf", "sir.co.kr");
    /*
    $font=ImagePsLoadFont("$g4[path]/img/cibt____.pfb");
    ImagePsText($target, "Testing... It worked!", $font, 32, $white, $white, 32, 32); 
    ImagePsFreeFont($font); 
    */
    @imagejpeg($target, $imgThumb, 100);
    @chmod($imgThumb, 0606); // 추후 삭제를 위하여 파일모드 변경
}
?>
