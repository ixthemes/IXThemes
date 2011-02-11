<?php
/**
 * HelpersGroupTest file
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
 * @subpackage    cake.tests.groups
 * @since         CakePHP(tm) v 1.2.0.4206
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */

/**
 * HelpersGroupTest class
 *
 * This test group will run all test in the cases/libs/view/helpers directory.
 *
 * @package       cake
 * @subpackage    cake.tests.groups
 */
class HelpersGroupTest extends TestSuite {

/**
 * label property
 *
 * @var string 'All core helpers'
 * @access public
 */
	var $label = 'All Helpers';

/**
 * HelpersGroupTest method
 *
 * @access public
 * @return void
 */
	function HelpersGroupTest() {
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helper');
// algalochkin: session test	must be disabled in helper group test, you can run it as individual test
//		TestManager::addTestCasesFromDirectory($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'ajax');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'cache');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'form');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'html');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'javascript');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'jquery_engine');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'js');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'mootools_engine');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'number');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'paginator');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'prototype_engine');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'rss');
//		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'session');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'text');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'time');
		TestManager::addTestFile($this, CORE_TEST_CASES . DS . 'libs' . DS . 'view' . DS . 'helpers' . DS . 'xml');
	}
}
