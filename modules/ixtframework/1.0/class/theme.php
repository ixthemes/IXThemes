<?php
/**
 * ixtframework - MODULE FOR XOOPS CONTENT MANAGEMENT SYSTEM
 * Copyright (c) IXThemes Project (http://ixthemes.org)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       IXThemes Project (http://ixthemes.org)
 * @license         GPL 2.0
 * @package         ixtframework
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.04:
 * ****************************************************************************
 */

/**
* This is the plugins parent class
*/

abstract class IXThemesTheme
{
	protected $info = array();
	protected $errors = array();
	
	protected function set_config(){
		$info = $this->get_info();
	}
	
	public function name(){
		return $this->info['name'];
	}
	public function version(){
		return $this->info['version'];
	}
	public function author(){
		return $this->info['author'];
	}
	public function url(){
		return $this->info['url'];
	}
	public function description(){
		return $this->info['description'];
	}
	public function help(){
		return $this->info['help'];
	}
	public function email(){
		return $this->info['email'];
	}
	public function errors(){
		return $this->errors;
	}
	
	abstract public function get_info();
	
}
