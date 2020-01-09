<?php
/**
* phpBB Extension - marttiphpbb topicprefixtags
* @copyright (c) 2014 - 2020 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\topicprefixtags;

class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.3.0', '>=') && version_compare(PHP_VERSION, '7.1', '>=');
	}
}
