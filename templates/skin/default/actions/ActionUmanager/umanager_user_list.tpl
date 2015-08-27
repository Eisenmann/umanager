<table class="table table-users">
	{if $bUsersUseOrder}
		<thead>
			<tr>
				<th class="cell-name cell-tab">
					<div class="cell-tab-inner {if $sUsersOrder=='user_login'}active{/if}"><span>{$aLang.user}</span></div>
				</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th class="cell-skill cell-tab">
					<div class="cell-tab-inner {if $sUsersOrder=='user_date_register'}active{/if}">{$aLang.user_date_registration}</div>
				</th>
				
			</tr>
		</thead>
	{else}
		<thead>
			<tr>
				<th class="cell-name cell-tab"><div class="cell-tab-inner">{$aLang.user}</div></th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th class="cell-skill cell-tab"><div class="cell-tab-inner">{$aLang.user_date_registration}</div></th>
				
			</tr>
		</thead>
	{/if}

	<tbody>
		{if $aUsersList}
			{foreach from=$aUsersList item=oUserList}
				{assign var="oSession" value=$oUserList->getSession()}
				{assign var="oUserNote" value=$oUserList->getUserNote()}
				<tr>
					<td class="cell-name">
						<a href="{$oUserList->getUserWebPath()}"><img src="{$oUserList->getProfileAvatarPath(48)}" alt="avatar" class="avatar" /></a>
						<div class="name {if !$oUserList->getProfileName()}no-realname{/if}">
							<p class="username word-wrap"><a href="{$oUserList->getUserWebPath()}">{$oUserList->getLogin()}</a></p>
							{if $oUserList->getProfileName()}<p class="realname">{$oUserList->getProfileName()}</p>{/if}
						</div>
					</td>
					<td>
						{if $oUserCurrent}
							{if $oUserNote}
								<button type="button" class="button button-action button-action-note js-infobox" title="{$oUserNote->getText()|escape:'html'}"><i class="icon-synio-comments-green"></i></button>
							{/if}
							<a href="{router page='talk'}add/?talk_users={$oUserList->getLogin()}"><button type="submit"  class="button button-action button-action-send-message"><i class="icon-synio-send-message"></i><span>{$aLang.user_write_prvmsg}</span></button></a>
						{/if}
					</td>
						<td align="center">  						
						<a href="{router page='umanager'}allusers/delete/{$oUserList->getId()}/?security_ls_key={$LIVESTREET_SECURITY_KEY}" onclick="return confirm('«{$oUserList->getProfileName()}»: {$aLang.plugin.umanager.admin_action_delete_confirm}');"><img src="{$aTemplateWebPathPlugin.umanager|cat:'images/delete.png'}" alt="{$aLang.plugin.umanager.admin_action_delete}" title="{$aLang.plugin.umanager.admin_action_delete}" /></a>
					</td>
					<td class="cell-date">{date_format date=$oUserList->getDateRegister() format="d.m.y"}</td>
					
				</tr>
			{/foreach}
		{else}
			<tr>
				<td colspan="4">
					{if $sUserListEmpty}
						{$sUserListEmpty}
					{else}
						{$aLang.user_empty}
					{/if}
				</td>
				
			
			</tr>
		{/if}
	</tbody>
</table>


{include file='paging.tpl' aPaging=$aPaging}