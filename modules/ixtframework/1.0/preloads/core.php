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
 * Version : 1.03:
 * ****************************************************************************
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class IxtframeworkCorePreload extends XoopsPreloadItem
{
	function eventIxtframeworkAdmin($args)
	{
		$GLOBALS['xoTheme']->addStylesheet('modules/ixtframework/css/tooltip.css');
		$GLOBALS['xoTheme']->addStylesheet('modules/ixtframework/css/prettyPhoto.css');
		$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
		if (!(is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/plugins/jquery.jgrowl.js"))) {
			// it is XOOPS 2.4.x
			$GLOBALS['xoTheme']->addScript('browse.php?modules/ixtframework/js/jquery.jgrowl.js');
			$GLOBALS['xoTheme']->addStylesheet('modules/ixtframework/css/jgrowl.css');
		} else {
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.jgrowl.js');
		}
		if (!(is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/plugins/jquery.prettyPhoto.js"))) {
			$GLOBALS['xoTheme']->addScript('browse.php?modules/ixtframework/js/jquery.prettyPhoto.js');
		} else {
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.prettyPhoto.js');
		}
		$GLOBALS['xoTheme']->addScript('', array('type' => 'text/javascript'), '
		(function($){
			$(document).ready(function(){
				$("a[rel^=prettyPhoto]").prettyPhoto({
					animationSpeed: "normal",
					padding: 40,
					opacity: 0.35,
					showTitle: true,
					allowresize: true,
					counter_separator_label: "/",
					theme: "light_rounded"
				});
			});
		})(jQuery);
		');
	}
	
	function eventIxtframeworkJgrowlredirect($args)
	{
		if (!empty($_SESSION['redirect_message'])) {
	//		$GLOBALS['xoTheme']->addStylesheet('xoops.css');
			$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
			if (!(is_file(XOOPS_TRUST_PATH . "/Frameworks/jquery/plugins/jquery.jgrowl.js"))) {
				// it is XOOPS 2.4.x
				$GLOBALS['xoTheme']->addScript('browse.php?modules/ixtframework/js/jquery.jgrowl.js');
				$GLOBALS['xoTheme']->addStylesheet('modules/ixtframework/css/jgrowl.css');
			} else {
				$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.jgrowl.js');
			}
			$GLOBALS['xoTheme']->addScript('', array('type' => 'text/javascript'), '
			(function($){
			$(document).ready(function(){
							$.jGrowl("' . $_SESSION['redirect_message'] . '", {  life:3000 , position: "center", speed: "slow" });
			});
			})(jQuery);
			');
			unset($_SESSION['redirect_message']);
		}
	}
	
	function eventCoreIncludeFunctionsRedirectheader($args)
	{
		global $xoopsConfig;
		$url = $args[0];
		if (preg_match("/[\\0-\\31]|about:|script:/i", $url)) {
						if (!preg_match('/^\b(java)?script:([\s]*)history\.go\(-[0-9]*\)([\s]*[;]*[\s]*)$/si', $url)) {
										$url = XOOPS_URL;
						}
		}
		if (!headers_sent()) {
						$_SESSION['redirect_message'] = $args[2];
						header("Location: " . preg_replace("/[&]amp;/i", '&', $url));
						exit();
		}
	}

}

?>