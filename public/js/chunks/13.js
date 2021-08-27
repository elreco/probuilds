(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  /* middleware: ["guest"], */
  data: function data() {
    return {
      token: this.$route.query.token ? this.$route.query.token : null,
      error: this.$route.query.error ? this.$route.query.error : null,
      redirect: this.$route.query.redirect ? this.$route.query.redirect : "/"
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$vs.loading({
      type: "default",
      background: "transparent"
    });

    if (this.token) {
      this.$store.dispatch("auth/saveToken", {
        token: this.token
      }).then(function () {
        setTimeout(function () {
          return _this.$vs.notify({
            title: _this.$i18n.t("Message.loginTitle"),
            text: _this.$i18n.t("Message.loginMessage"),
            color: "success",
            position: "top-center"
          });
        }, 3000);
        setTimeout(function () {
          return _this.$router.push(_this.redirect);
        }, 3000);
        setTimeout(function () {
          return _this.$vs.loading.close();
        }, 3000);
      });
    } else {
      this.$vs.loading.close();
      this.$vs.notify({
        title: "Login error",
        text: this.error,
        color: "warning",
        position: "top-center"
      });
      this.$router.push(this.redirect);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "h-screen flex w-full text-white" }, [
    _c(
      "div",
      {
        staticClass:
          "vx-col flex items-center justify-center flex-col sm:w-1/2 md:w-3/5 lg:w-3/4 xl:w-1/2 mx-auto text-center"
      },
      [
        _c("h1", { staticClass: "text-5xl" }, [
          _vm._v(_vm._s(_vm.$t("Message.loginWaitTitle")))
        ]),
        _vm._v(" "),
        _c("p", { staticStyle: { "margin-bottom": "10rem" } }, [
          _vm._v(_vm._s(_vm.$t("Message.loginWaitMessage")) + ".")
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/main/pages/auth/SocialCallback.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/src/views/main/pages/auth/SocialCallback.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SocialCallback.vue?vue&type=template&id=7c341fbc& */ "./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc&");
/* harmony import */ var _SocialCallback_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SocialCallback.vue?vue&type=script&lang=js& */ "./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SocialCallback_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/main/pages/auth/SocialCallback.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SocialCallback_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SocialCallback.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SocialCallback_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./SocialCallback.vue?vue&type=template&id=7c341fbc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/main/pages/auth/SocialCallback.vue?vue&type=template&id=7c341fbc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SocialCallback_vue_vue_type_template_id_7c341fbc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);