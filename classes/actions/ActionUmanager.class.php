<?php


class PluginUmanager_ActionUmanager extends ActionPlugin {
	protected $sUserLogin=null;
	

	public function Init() {
	}
	/**
	 * Регистрируем евенты
	 *
	 */
	protected function RegisterEvent() {
	
		$this->AddEvent('allusers','GetUsers');
		$this->AddEventPreg('/^ajax-search$/i','EventAjaxSearch');
		
	}


	/**********************************************************************************
	 ************************ РЕАЛИЗАЦИЯ ЭКШЕНА ***************************************
	 **********************************************************************************
	 */

	
	
	protected function GetUsers()
	{
	 
	/**
		 * Если пользователь не авторизован и не админ, то выкидываем его
		 */
		$this->oUserCurrent=$this->User_GetUserCurrent();
		if (!$this->oUserCurrent or !$this->oUserCurrent->isAdministrator()) {
			return $this->EventNotFound();
		}
		
		/**
		 * Обработка удаления пользователя
		*/
        if ($this->GetParam(0)=='delete') {
	      $this->Security_ValidateSendForm();
	
			$sUserId = $this->GetParam(1);
		if ($this->PluginUmanager_Umanager_deleteUserById($sUserId)) {
					
				$this->Message_AddNotice($this->Lang_Get('plugin.umanager.admin_action_delete_ok'));
				
								
			} else {
				$this->Message_AddError($this->Lang_Get('plugin.umanager.admin_action_delete_error'),$this->Lang_Get('error'));
			}
	
	          $this->Cache_Clean();
		 }
	
	/**
		 * По какому полю сортировать
		 */
		$sOrder='user_rating';
		if (getRequest('order')) {
			$sOrder=(string)getRequest('order');
		}
		/**
		 * В каком направлении сортировать
		 */
		$sOrderWay='desc';
		if (getRequest('order_way')) {
			$sOrderWay=(string)getRequest('order_way');
		}
		$aFilter=array(
			'activate' => 1
		);
		
	/**
		 * Получаем список юзеров
		 */
		$aResult=$this->User_GetUsersByFilter($aFilter,array($sOrder=>$sOrderWay),1,Config::Get('plugin.umanager.user_count'));
		$aUsers=$aResult['collection'];
		
		$this->Viewer_Assign('aUsersRating',$aUsers);
			/**
		 * Устанавливаем шаблон вывода
		 */
		$this->SetTemplateAction('allusers');
     
	
		
	}
	
		/**
	 * Поиск пользователей по логину
	 */
	protected function EventAjaxSearch() {
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('json');
		/**
		 * Получаем из реквеста первые быквы для поиска пользователей по логину
		 */
		$sTitle=getRequest('user_login');
		if (is_string($sTitle) and mb_strlen($sTitle,'utf-8')) {
			$sTitle=str_replace(array('_','%'),array('\_','\%'),$sTitle);
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'));
			return;
		}
		/**
		 * Как именно искать: совпадение в любой частилогина, или только начало или конец логина
		 */
		if (getRequest('isPrefix')) {
			$sTitle.='%';
		} elseif (getRequest('isPostfix')) {
			$sTitle='%'.$sTitle;
		} else {
			$sTitle='%'.$sTitle.'%';
		}
		/**
		 * Ищем пользователей
		 */
		$aResult=$this->User_GetUsersByFilter(array('activate' => 1,'login'=>$sTitle),array('user_rating'=>'desc'),1,50);
		/**
		 * Формируем ответ
		 */
		$oViewer=$this->Viewer_GetLocalViewer();
		$oViewer->Assign('aUsersList',$aResult['collection']);
		$oViewer->Assign('oUserCurrent',$this->User_GetUserCurrent());
		$oViewer->Assign('sUserListEmpty',$this->Lang_Get('user_search_empty'));
		$this->Viewer_AssignAjax('sText',$oViewer->Fetch($this->getTemplatePathPlugin()."actions/ActionUmanager/umanager_user_list.tpl"));
	}


}
?>