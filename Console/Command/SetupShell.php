<?php

if (!defined('CHMOD_PUBLIC')) {
	define('CHMOD_PUBLIC', 0770);
}
if (!defined('FILES')) {
	define('FILES', APP.'files'.DS);
}
App::uses('AppShell', 'Console/Command');
App::uses('Folder', 'Utility');

/**
 * 2011-11-06 ms
 */
class SetupShell extends AppShell {

	public function run() {
		$this->out('running ...');
		$this->createFolders();
		$this->out('tmp folders created');

		if (!file_exists(APP . 'Config' . DS.'database.php')) {
			$this->out('! database.php is missing !');
		}
	}

	/**
	 * Test the console to work with
	 * - utf8 input (unix only it seems)
	 * - utf8 output (from db or utf8 encoded files)
	 * - colorful output (unix only)
	 * 2012-12-12 ms
	 */
	public function test() {
		$this->out('Testing the console...');
		$this->out();

		$this->err('This is an error message');
		$this->out('This is an utf8 umlauts test with äöüÄÖÜ& output');
		$this->out();

		$list = array(
			'emergency',
			'alert',
			'critical',
			'error',
			'warning',
			'info',
			'debug',
			'success',
			'comment',
			'question',
		);
		foreach ($list as $type) {
			$this->out('<'.$type.'>This is a message of type \''.$type.'\'</'.$type.'>');
		}
		$this->out();

		$x = $this->in('Some input maybe?', null, null);
		if ($x) {
			$this->out('Your input was:');
			$this->out($x);
		} else {
			$this->out('You did not input anything');
		}
		$this->out();
		$this->out('Done!');
	}

	public function createFolders() {
		$handle = new Folder(TMP, true, CHMOD_PUBLIC);
		$handle = new Folder(TMP.'logs'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(TMP.'work'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(TMP.'sessions'.DS, true, CHMOD_PUBLIC);

		$handle = new Folder(CACHE, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'models'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'persistent'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'views'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'feeds'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'searches'.DS, true, CHMOD_PUBLIC);
		$handle = new Folder(CACHE.'data'.DS, true, CHMOD_PUBLIC);

		$handle = new Folder(FILES, true, CHMOD_PUBLIC);
		//$handle = new Folder(WWW_ROOT.'img'.DS.'avatars', true, CHMOD_PUBLIC);
		//$handle = new Folder(WWW_ROOT.'img'.DS.'content', true, 0777);
	}


}
