/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import i18n from '../../../i18n/i18n'

export default [
  {
    url: '/' + i18n.locale,
    name: 'Home',
    slug: 'home',
    icon: 'HomeIcon'
  },
  {
    url: '/' + i18n.locale + '/page2',
    name: 'Page 2',
    slug: 'page2',
    icon: 'FileIcon'
  }
]
