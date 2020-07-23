import {
    languages
} from '../i18n/i18n'
import i18n from '../i18n/i18n'

export default function locale({
    to,
    next,
}) {
    // use the language from the routing param or default language
    let language = to.params.locale;

    if (!languages.includes(language)) return next('en')
    // set the current language for vuex-i18n. note that translation data
    // for the language might need to be loaded first

    if (i18n.locale !== language) {
        localStorage.locale = language
        i18n.locale = language

    }

    /* if (to.params.champion && to.params.locale) {
        checkChampion(to.params.champion, to.params.locale);
    } */

    return next();
}
