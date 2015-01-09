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

namespace Oculus\Library;
use Oculus\Engine\Container;
use Oculus\Library\Mbstring;
use Oculus\Library\Iconv;
use Oculus\Service\LibraryService;

class Encode extends LibraryService {

	private $encode;

	public function __construct(Container $app) {
		parent::__construct($app);

		if (extension_loaded('mbstring')):
		    mb_internal_encoding('UTF-8');
		    $this->encode = new Mbstring($app);
		    
		elseif (function_exists('iconv')):
		    $this->encode = new Iconv($app);
		endif;
	}

	public function strlen($string) {
        return $this->encode->utf8Strlen($string);
    }
    
    public function strpos($string, $needle, $offset = 0) {
        return $this->encode->utf8Strpos($string, $needle, $offset);
    }
    
    public function strrpos($string, $needle, $offset = 0) {
        return $this->encode->utf8Strrpos($string, $needle, $offset);
    }
    
    public function substr($string, $offset, $length = null) {
        if ($length === null):
            return $this->encode->utf8Substr($string, $offset, utf8_strlen($string));
        else:
            return $this->encode->utf8Substr($string, $offset, $length);
        endif;
    }
    
    public function strtoupper($string) {
        return $this->encode->utf8Strtoupper($string);
    }
    
    public function strtolower($string) {
        return $this->encode->utf8Strtolower($string);
    }
}
