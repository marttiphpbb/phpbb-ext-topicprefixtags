<?php
/**
* phpBB Extension - marttiphpbb calendar
* @copyright (c) 2014 - 2015 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\calendar\acp;

use marttiphpbb\calendar\model\links;
use marttiphpbb\calendar\model\render_settings;
use marttiphpbb\calendar\model\input_settings;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		global $phpbb_container;

		$user->add_lang_ext('marttiphpbb/calendar', 'acp');
		add_form_key('marttiphpbb/calendar');

		$links = new links($config, $template, $user);
		$render_settings = new render_settings($config, $template, $user);

		switch($mode)
		{
			case 'rendering':

				$this->tpl_name = 'rendering';
				$this->page_title = $user->lang('ACP_CALENDAR_RENDERING');

				if ($request->is_set_post('submit'))
				{
					if (!check_form_key('marttiphpbb/calendar'))
					{
						trigger_error('FORM_INVALID');
					}

					$links->set($request->variable('links', array(0 => 0)), $request->variable('calendar_repo_link', 0));
					$render_settings->set($request->variable('render_settings', array(0 => 0)));
					$config->set('calendar_first_weekday', $request->variable('calendar_first_weekday', 0));

					trigger_error($user->lang('ACP_CALENDAR_SETTING_SAVED') . adm_back_link($this->u_action));
				}

				$weekdays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

				foreach ($weekdays as $value => $name)
				{
					$template->assign_block_vars('weekdays', array(
						'VALUE'		=> $value,
						'SELECTED'	=> ($config['calendar_first_weekday'] == $value) ? true : false,
						'LANG'		=> $user->lang['datetime'][$name],
					));
				}

				$links->assign_acp_select_template_vars();
				$render_settings->assign_acp_template_vars();

				$template->assign_vars(array(
					'U_ACTION'		=> $this->u_action,
				));

				break;

			case 'input':

				$this->tpl_name = 'input';
				$this->page_title = $user->lang('ACP_CALENDAR_INPUT');

				$input_settings = $phpbb_container->get('marttiphpbb.calendar.model.input_settings');

				if ($request->is_set_post('submit'))
				{
					if (!check_form_key('marttiphpbb/calendar'))
					{
						trigger_error('FORM_INVALID');
					}

					trigger_error($user->lang('ACP_CALENDAR_SETTING_SAVED') . adm_back_link($this->u_action));
				}

				$input_settings->assign_acp_template_vars();

				$template->assign_vars(array(
					'U_ACTION'		=> $this->u_action,
				));

				break;
		}
	}
}
