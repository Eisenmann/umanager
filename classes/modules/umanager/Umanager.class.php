<?php

/**
 * Модуль статических страниц
 *
 */
class PluginUmanager_ModuleUmanager extends Module {
	protected $oMapper;
	protected $aRebuildIds=array();

	/**
	 * Инициализация
	 *
	 */
	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
	}
	
	
	/*public function GetUsers()
	{
		$aUsers = $this->oMapper->GetUsers();
		
		return $aUsers;
	}*/

	/**
	 * Удаляет страницу по её айдишнику
	 * Если тип таблиц БД InnoDB, то удалятся и все дочернии страницы
	 *
	 * @param unknown_type $sId
	 * @return unknown
	 */
	public function deleteUserById($sId) {
		if ($this->oMapper->deleteUserById($sId)) {
			//чистим зависимые кеши
			//$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('page_change',"page_change_{$sId}"));
			return true;
		}
		return false;
	}


}
?>