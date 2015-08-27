<?php


/**
 * Регистрация хука для вывода меню страниц
 *
 */
class PluginUmanager_HookUmanager extends Hook {
	public function RegisterHook() {
		$this->AddHook('template_main_menu_item','Menu');
		$this->AddHook('template_admin_action_item','MenuAdmin',__CLASS__,-100);
	}

	public function Menu() {
	
		return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'main_menu.tpl');
	}
	
	public function MenuAdmin() {
	
	  return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'admin_menu.tpl');
	}
}
?>