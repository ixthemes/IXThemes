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
 * Version : 1.05:
 * ****************************************************************************
 */
 
	
	function ixtframework_search($queryarray, $andor, $limit, $offset, $userid)
	{
		global $xoopsDB;
		
		$sql = "SELECT themes_id, themes_name, themes_submitter, themes_date_created FROM ".$xoopsDB->prefix("ixtframework_themes")." WHERE themes_online = 1";
		
		if ( $userid != 0 ) {
			$sql .= " AND themes_submitter=".intval($userid)." ";
		}
		
		if ( is_array($queryarray) && $count = count($queryarray) ) 
		{
			$sql .= " AND (()";
			
			for($i=1;$i<$count;$i++)
			{
				$sql .= " $andor ";
				$sql .= "()";
			}
			$sql .= ")";
		}
		
		$sql .= " ORDER BY themes_date_created DESC";
		$result = $xoopsDB->query($sql,$limit,$offset);
		$ret = array();
		$i = 0;
		while($myrow = $xoopsDB->fetchArray($result))
		{
			$ret[$i]["image"] = "images/deco/themes_search.png";
			$ret[$i]["link"] = "themes.php?themes_id=".$myrow["themes_id"]."";
			$ret[$i]["title"] = $myrow["themes_name"];
			$ret[$i]["time"] = $myrow["themes_date_created"];
			$ret[$i]["uid"] = $myrow["themes_submitter"];
			$i++;
		}
		return $ret;
	}

	
?>