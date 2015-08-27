<?php


class PluginUmanager_ModuleUmanager_MapperUmanager extends Mapper {

	public function deleteUserById($sUserId) {
		$sql = "DELETE FROM ".Config::Get('plugin.umanager.table.user')." WHERE user_id = ?d" ;
	 
		if ($this->oDb->query($sql,$sUserId)) {
			return true;
		}
		return false;
	}


}
?>