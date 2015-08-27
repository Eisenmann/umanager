<?php


/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
	die('Hacking attempt!');
}

class PluginUmanager extends Plugin {

	protected $aInherits = array(
		'module' => array(
			'PluginSitemap_ModuleSitemap' => 'PluginUmanager_ModuleSitemap',
		),
	);


	/**
	 * Активация плагина "Управление пользователями".
	 */
	public function Activate() {
	
		return true;
	}

	/**
	 * Инициализация плагина
	 */
	public function Init() {
           $this->Viewer_AppendScript(Plugin::GetTemplateWebPath('umanager') . 'js/usersearch.js');
	}
}
?>