<?php
/**
 * Short description for file.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/view/1196/Testing>
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/view/1196/Testing CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.cake.tests.lib
 * @since         CakePHP(tm) v 1.2.0.4433
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
?>
<div class="test-menu">
		<h3>App</h3>
		<ul>
			<li><a href='<?php echo $groups;?>&amp;app=true'>Test Groups</a></li>
			<li><a href='<?php echo $cases;?>&amp;app=true'>Test Cases</a></li>
		</ul>
<?php
if (!empty($plugins)):
?>
		<h3>Plugins</h3>
	<?php foreach($plugins as $plugin):
			$pluginPath = Inflector::underscore($plugin);
	?>
			<ul>
				<li>
					<span  style="font-size: 18px"><?php echo $plugin;?></span>
					<ul>
						<li><a href='<?php echo $groups;?>&amp;plugin=<?php echo $pluginPath; ?>'>Test Groups</a></li>
						<li><a href='<?php echo $cases;?>&amp;plugin=<?php echo $pluginPath; ?>'>Test Cases</a></li>
					</ul>
				</li>
			</ul>
	<?php endforeach; ?>
<?php endif;?>
		<h3>Core</h3>
		<ul>
			<li><a href='<?php echo $groups;?>'>Test Groups</a></li>
			<li><a href='<?php echo $cases;?>'>Test Cases</a></li>
		</ul>
		<h3>IXTCake</h3>
		<ul>
			<li><a href='<?php echo XOOPS_URL . "/modules/ixtcake/"; ?>'>Start Page</a></li>
		</ul>
</div>
<div  class="test-results">