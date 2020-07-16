/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import i18n from '../../../i18n/i18n'

export default [{
        url: '/' + i18n.locale,
        name: i18n.t('nav.home'),
        slug: 'home',
        icon: 'HomeIcon'
    },
    {
        url: '/' + i18n.locale + '/probuilds',
        name: i18n.t('nav.probuilds'),
        slug: 'probuilds',
        icon: 'ZapIcon'
    },
    {
        url: '/' + i18n.locale + '/spectate',
        name: i18n.t('nav.spectate'),
        slug: 'spectate',
        icon: 'MonitorIcon'
    },
    {
        url: '/' + i18n.locale + '/community',
        name: i18n.t('nav.community') + " <i class='pl-1 pt-custom fas fa-circle text-md blink pt-custom'></i>",
        slug: 'community',
        icon: 'UsersIcon'
    }
]
