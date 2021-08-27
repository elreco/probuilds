(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _partials_LiveFeed__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./partials/LiveFeed */ "./resources/js/src/views/probuilds/partials/LiveFeed.vue");
/* harmony import */ var _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/views/main/partials/SearchBanner */ "./resources/js/src/views/main/partials/SearchBanner.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      title: this.$i18n.t("meta.title.probuilds"),
      description: this.$i18n.t("meta.description.probuilds")
    };
  },
  components: {
    LiveFeed: _partials_LiveFeed__WEBPACK_IMPORTED_MODULE_0__["default"],
    SearchBanner: _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  metaInfo: function metaInfo() {
    // if no subcomponents specify a metaInfo.title, this title will be used
    return {
      title: "".concat(this.title),
      // all titles will be injected into this template
      titleTemplate: "EvilSpartan.com – %s",
      meta: [{
        name: "description",
        content: "".concat(this.description)
      }, {
        property: "og:title",
        content: "".concat(this.title)
      }, {
        property: "og:site_name",
        content: "EvilSpartan.com"
      }, {
        property: "og:type",
        content: "website"
      }, {
        name: "robots",
        content: "index,follow"
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a& ***!
  \*********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("section", { attrs: { id: "dashboard-analytics" } }, [
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full mb-base" },
        [
          _c("search-banner", {
            attrs: { displayDecore: true },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function() {
                  return [
                    _c("h1", { staticClass: "mb-4 text-white" }, [
                      _vm._v(_vm._s(_vm.$t("home.welcome")))
                    ]),
                    _vm._v(" "),
                    _c("p", {
                      staticClass:
                        "xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white",
                      domProps: {
                        innerHTML: _vm._s(_vm.$t("home.welcomeText"))
                      }
                    })
                  ]
                },
                proxy: true
              }
            ])
          })
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full" },
        [
          _c(
            "vx-card",
            { attrs: { "content-color": "#fff" } },
            [_c("live-feed")],
            1
          )
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/probuilds/Probuilds.vue":
/*!********************************************************!*\
  !*** ./resources/js/src/views/probuilds/Probuilds.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Probuilds.vue?vue&type=template&id=754c204a& */ "./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a&");
/* harmony import */ var _Probuilds_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Probuilds.vue?vue&type=script&lang=js& */ "./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Probuilds_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/probuilds/Probuilds.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Probuilds_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Probuilds.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Probuilds_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a&":
/*!***************************************************************************************!*\
  !*** ./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Probuilds.vue?vue&type=template&id=754c204a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/Probuilds.vue?vue&type=template&id=754c204a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Probuilds_vue_vue_type_template_id_754c204a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);