<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Front\Controller\Tool;
use Oculus\Engine\Controller;

class Captcha extends Controller {
    public function index() {
        $this->session->data['captcha'] = substr(sha1(mt_rand()), 17, 6);
        
        $image = imagecreatetruecolor(150, 35);
        
        $width = imagesx($image);
        $height = imagesy($image);
        
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $red = imagecolorallocatealpha($image, 255, 0, 0, 75);
        $green = imagecolorallocatealpha($image, 0, 255, 0, 75);
        $blue = imagecolorallocatealpha($image, 0, 0, 255, 75);
        
        imagefilledrectangle($image, 0, 0, $width, $height, $white);
        
        imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $red);
        imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $green);
        imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $blue);
        
        imagefilledrectangle($image, 0, 0, $width, 0, $black);
        imagefilledrectangle($image, $width - 1, 0, $width - 1, $height - 1, $black);
        imagefilledrectangle($image, 0, 0, 0, $height - 1, $black);
        imagefilledrectangle($image, 0, $height - 1, $width, $height - 1, $black);
        
        imagestring($image, 10, intval(($width - (strlen($this->session->data['captcha']) * 9)) / 2), intval(($height - 15) / 2), $this->session->data['captcha'], $black);
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        header('Content-type: image/jpeg');
        
        imagejpeg($image);
        
        imagedestroy($image);
    }
}
