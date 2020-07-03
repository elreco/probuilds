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
        name: i18n.t('home.nav'),
        slug: 'home',
        icon: 'HomeIcon'
    },
    {
        url: '/' + i18n.locale + '/probuilds',
        name: "Probuilds",
        slug: 'probuilds',
        icon: 'ZapIcon'
    },
    {
        url: '/' + i18n.locale + '/spectate',
        name: "Spectate <i class='pl-1 fas fa-circle text-md blink pt-custom'></i>",
        slug: 'spectate',
        icon: 'MonitorIcon'
    },
    {
        url: '/' + i18n.locale + '/community',
        name: "Community",
        slug: 'community',
        icon: 'UsersIcon'
    }
]
