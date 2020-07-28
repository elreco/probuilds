(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/community/Community.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/community/Community.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/views/main/partials/SearchBanner */ "./resources/js/src/views/main/partials/SearchBanner.vue");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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



var VxTour = function VxTour() {
  return __webpack_require__.e(/*! import() */ 9).then(__webpack_require__.bind(null, /*! @/components/VxTour.vue */ "./resources/js/src/components/VxTour.vue"));
};

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      title: this.$i18n.t("meta.title.community"),
      description: this.$i18n.t("meta.description.community"),
      steps: [{
        target: "#btnLogin",
        content: this.$i18n.t("Message.tourLoginMessage")
      }]
    };
  },
  components: {
    SearchBanner: _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_0__["default"],
    VxTour: VxTour
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])({
    user: "auth/user"
  }), {
    windowWidth: function windowWidth() {
      return this.$store.state.windowWidth;
    }
  }),
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689& ***!
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
  return _c(
    "section",
    { attrs: { id: "dashboard-analytics" } },
    [
      _vm.windowWidth >= 1200 && !_vm.user
        ? _c("vx-tour", { attrs: { steps: _vm.steps } })
        : _vm._e(),
      _vm._v(" "),
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
                        _vm._v(_vm._s(_vm.$t("Community.title")))
                      ]),
                      _vm._v(" "),
                      _c("p", {
                        staticClass:
                          "xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white",
                        domProps: {
                          innerHTML: _vm._s(_vm.$t("Community.description"))
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
      _c(
        "div",
        {
          staticClass: "bg-warning text-white px-4 py-3 shadow-md",
          attrs: { role: "alert" }
        },
        [
          _c("div", { staticClass: "flex" }, [
            _c("div", { staticClass: "py-1" }, [
              _c(
                "svg",
                {
                  staticClass: "fill-current h-6 w-6 text-teal-500 mr-4",
                  attrs: {
                    xmlns: "http://www.w3.org/2000/svg",
                    viewBox: "0 0 20 20"
                  }
                },
                [
                  _c("path", {
                    attrs: {
                      d:
                        "M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                    }
                  })
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", [
              _c("p", { staticClass: "font-bold" }, [
                _vm._v(_vm._s(_vm.$t("Message.notAvailable")))
              ]),
              _vm._v(" "),
              _c("p", {
                staticClass: "text-sm",
                domProps: {
                  innerHTML: _vm._s(_vm.$t("Message.notAvailableDescription"))
                }
              })
            ])
          ])
        ]
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/community/Community.vue":
/*!********************************************************!*\
  !*** ./resources/js/src/views/community/Community.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Community.vue?vue&type=template&id=071be689& */ "./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689&");
/* harmony import */ var _Community_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Community.vue?vue&type=script&lang=js& */ "./resources/js/src/views/community/Community.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Community_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/community/Community.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/community/Community.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/src/views/community/Community.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Community_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Community.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/community/Community.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Community_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689&":
/*!***************************************************************************************!*\
  !*** ./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Community.vue?vue&type=template&id=071be689& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/community/Community.vue?vue&type=template&id=071be689&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Community_vue_vue_type_template_id_071be689___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);