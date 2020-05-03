/*=========================================================================================
  File Name: i18n.js
  Description: i18n configuration file. Imports i18n data.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import VueI18n from 'vue-i18n'
import i18nData from './i18nData'

Vue.use(VueI18n)

function checkDefaultLanguage() {
    let matched = null
    let languages = Object.getOwnPropertyNames(i18nData)
    languages.forEach(lang => {
        if (lang === navigator.language) {
            matched = lang
        }
    })
    if (!matched) {
        languages.forEach(lang => {
            let languagePartials = navigator.language.split('-')[0]
            if (lang === languagePartials) {
                matched = lang
            }
        })
    }
    if (!matched) {
        languages.forEach(lang => {
            let languagePartials = navigator.language.split('-')[0]
            if (lang.split('-')[0] === languagePartials) {
                matched = lang
            }
        })
    }
    return matched
}

if (!localStorage.locale) {
    localStorage.locale = checkDefaultLanguage() || process.env.VUE_APP_I18N_LOCALE || "fr"
}

export const selectedLocale = localStorage.locale

export const languages = Object.getOwnPropertyNames(i18nData)



export default new VueI18n({
    locale: selectedLocale, // set default locale
    fallbackLocale: process.env.VUE_APP_I18N_FALLBACK_LOCALE || 'fr',
    messages: i18nData
})
