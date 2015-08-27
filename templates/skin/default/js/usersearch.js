	/**
 * Управление пользователями
 */
ls.umanager = (function ($) {
	/**
	 * Поиск пользователей
	 */
	this.searchUsers = function(form) {
		var url = aRouter['umanager']+'ajax-search/';
		var inputSearch=$('#'+form).find('input');
		inputSearch.addClass('loader');

		ls.hook.marker('searchUsersBefore');
		ls.ajaxSubmit(url, form, function(result){
			inputSearch.removeClass('loader');
			if (result.bStateError) {
				$('#users-list-search').hide();
				$('#users-list-original').show();
			} else {
				$('#users-list-original').hide();
				$('#users-list-search').html(result.sText).show();
				ls.hook.run('ls_user_search_users_after',[form, result]);
			}
		});
	};

	/**
	 * Поиск пользователей по началу логина
	 */
	this.searchUsersByPrefix = function(sPrefix,obj) {
		obj=$(obj);
		var url = aRouter['umanager']+'ajax-search/';
		var params = {user_login: sPrefix, isPrefix: 1};
		$('#search-user-login').addClass('loader');

		ls.hook.marker('searchUsersByPrefixBefore');
		ls.ajax(url, params, function(result){
			$('#search-user-login').removeClass('loader');
			$('#user-prefix-filter').find('.active').removeClass('active');
			obj.parent().addClass('active');
			if (result.bStateError) {
				$('#users-list-search').hide();
				$('#users-list-original').show();
			} else {
				$('#users-list-original').hide();
				$('#users-list-search').html(result.sText).show();
				ls.hook.run('ls_user_search_users_by_prefix_after',[sPrefix, obj, result]);
			}
		});
		return false;
	};	

}).call(ls.umanager || {},jQuery);
