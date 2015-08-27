<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/
$config=array();

$config['table']['user']                = '___db.table.prefix___user';


Config::Set('router.page.umanager', 'PluginUmanager_ActionUmanager');

$config['user_count']='5';	// Количество пользователей в блоке

// Settings for plugin Sitemap
$config['sitemap'] = array (
    'cache_lifetime' => 60 * 60 * 24, // 24 hours
    'sitemap_priority' => '0.8',
    'sitemap_changefreq' => 'monthly'
);

return $config;
?>