<?php

/**
* phpBB Extension - marttiphpbb topicprefixtags
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\topicprefixtags\service;

use phpbb\event\dispatcher;

class tags
{
	/** @var dispatcher */
	private $dispatcher;

	/** @var array */
	private $tags = [];

	/**
	 * @param dispatcher $dispatcher
	*/
	public function __construct(dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @param array 
	 */
	public function trigger_event(string $origin_event_name, array $topic_data)
	{
		$topic_id = $topic_data['topic_id'];	
		$tags = [];
	
		/**
		 * Event to set topic prefix tags 
		 *
		 * @event 
		 * @var	int 	topic_id			changing won't be fed back to calling event
		 * @var	array	topic_data			changing won't be fed back to calling event
		 * @var string  origin_event_name	the name of the original event
		 * @var array	tags				push here your tags 
		 *
		 */
		$vars = ['topic_id', 'topic_data', 'origin_event_name', 'tags'];
		$result = $this->dispatcher->trigger_event('marttiphpbb.topicprefixtags.set_tags', compact($vars));

		if (count($result['tags']))
		{
			$this->tags[$topic_id] = $result['tags'];
		}
	}

	/**
	 * @return array
	 */
	public function get_all():array
	{
		return $this->tags;
	}
}
