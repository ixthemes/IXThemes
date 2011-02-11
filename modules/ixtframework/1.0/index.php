<?php
/**
 * IXTFrameWork - MODULE FOR XOOPS AND IMPRESS CMS
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
 * @license         GPL 3.0
 * @package         IXTFrameWork
 * @author          IXThemes Project (http://ixthemes.org)
 *
 * Version : 1.00:
 * ****************************************************************************
 */
 
include "../../mainfile.php";
include_once XOOPS_ROOT_PATH."/header.php";
redirect_header(XOOPS_URL, 1, "Thanks. Welcome to our Site with IXThemes FrameWork Module!", false);
exit();
include_once XOOPS_ROOT_PATH."/footer.php";	
?>