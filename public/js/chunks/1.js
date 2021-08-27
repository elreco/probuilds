(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
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
  name: "popover-avatar",
  props: {
    default: {
      type: Boolean,
      default: true,
      required: false
    },
    src: {
      required: false
    },
    id: {
      required: false
    },
    type: {
      type: String,
      required: false
    },
    forceTitle: {
      type: String,
      required: false
    },
    forceDescription: {
      type: String,
      required: false
    },
    border: {
      type: String,
      default: "",
      required: false
    },
    sold: {
      type: Boolean,
      default: false,
      required: false
    },
    win: {
      type: Boolean,
      default: false,
      required: false
    }
  },
  data: function data() {
    return {
      srcIfNull: __webpack_require__(/*! @assets/images/livefeed/unknown.png */ "./resources/assets/images/livefeed/unknown.png"),
      title: "",
      description: "",
      isLoading: true
    };
  },
  methods: {
    getData: function getData(type, id) {
      var _this = this;

      if (type && id) {
        this.$http.get("".concat(type, "/").concat(id), {
          params: {
            locale: this.$route.params.locale
          }
        }).then(function (response) {
          _this.title = response.data.name;
          _this.description = response.data.description;
          _this.isLoading = false;
        });
      } else {
        this.description = this.forceDescription;
        this.title = this.forceTitle;
        this.isLoading = false;
      }
    }
  },
  computed: {
    classImg: function classImg() {
      var classImg = "";

      if (this.title) {
        classImg = "tooltip-target";
      }

      if (this.default) {
        classImg += " border-solid border-2";

        if (this.border) {
          classImg += " border-" + this.border;
        } else {
          classImg += " border-theme-dark";
        }
      } else {
        if (this.win) {
          classImg += " border-solid border-2 win-border win-shadow";
        } else {
          classImg += " border-solid border-2 lose-border lose-shadow";
        }
      }

      return classImg;
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".vs-card--header h3 {\n  color: black !important;\n}\n.vs-card--content {\n  width: 100%;\n}\n[dir] .vs-card--content {\n  margin: 0;\n}\n.tooltip-inner {\n  max-width: 40rem !important;\n}\n.tooltip-inner {\n  min-width: 20rem !important;\n}\n.lds-dual-ring {\n  display: inline-block;\n  width: 12px;\n  height: 12px;\n}\n[dir] .lds-dual-ring {\n  padding-top: 0.45rem !important;\n}\n.lds-dual-ring:after {\n  content: \" \";\n  display: block;\n  width: 24px;\n  height: 24px;\n}\n[dir] .lds-dual-ring:after {\n  margin: 0px auto;\n  border-radius: 50%;\n  border: 3px solid #fff;\n  border-color: #fff transparent #fff transparent;\n}\n[dir=ltr] .lds-dual-ring:after {\n  -webkit-animation:  lds-dual-ring-ltr 1.2s linear infinite;\n          animation:  lds-dual-ring-ltr 1.2s linear infinite;\n}\n[dir=rtl] .lds-dual-ring:after {\n  -webkit-animation:  lds-dual-ring-rtl 1.2s linear infinite;\n          animation:  lds-dual-ring-rtl 1.2s linear infinite;\n}\n@-webkit-keyframes lds-dual-ring-ltr {\n0% {\n    transform: rotate(0deg);\n}\n100% {\n    transform: rotate(360deg);\n}\n}\n@keyframes lds-dual-ring-ltr {\n0% {\n    transform: rotate(0deg);\n}\n100% {\n    transform: rotate(360deg);\n}\n}\n@-webkit-keyframes lds-dual-ring-rtl {\n0% {\n    transform: rotate(0deg);\n}\n100% {\n    transform: rotate(-360deg);\n}\n}\n@keyframes lds-dual-ring-rtl {\n0% {\n    transform: rotate(0deg);\n}\n100% {\n    transform: rotate(-360deg);\n}\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PopoverAvatar.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
  return _vm.src
    ? _c(
        "v-popover",
        {
          staticClass: "inline text-white",
          attrs: {
            container: "body",
            boundariesElement: "body",
            trigger: "hover",
            placement: "auto",
            offset: "5",
            content: _vm.getData(_vm.type, _vm.id)
          }
        },
        [
          _c("div", { staticClass: "relative inline" }, [
            _c("img", {
              staticClass: "tooltip-target w-10 h-10 rounded",
              class: _vm.classImg,
              attrs: {
                loading: "lazy",
                width: "32",
                height: "32",
                alt: _vm.title,
                src: _vm.src
              }
            }),
            _vm._v(" "),
            _vm.sold
              ? _c("div", [
                  _c("div", {
                    staticClass: "w-10 h-10 rounded",
                    class: _vm.classImg,
                    staticStyle: {
                      position: "absolute",
                      top: "0",
                      background: "rgba(255,255,255,0.5)"
                    },
                    attrs: { loading: "lazy", width: "32", height: "32" }
                  }),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "dot-count vs-avatar--count badgeNumber",
                      staticStyle: {
                        background: "rgb(140, 23, 164)",
                        right: "-8px"
                      }
                    },
                    [_vm._v(_vm._s(_vm.$t("Global.sold")))]
                  )
                ])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c(
            "template",
            { slot: "popover" },
            [
              _c("vx-card", { staticClass: "mb-0 bg-primary" }, [
                _c("div", { staticClass: "text-left mb-5" }, [
                  _c("h4", { staticClass: "text-white" }, [
                    _vm._v(_vm._s(_vm.title ? _vm.title : " "))
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "vx-row" }, [
                  _c("div", { staticClass: "vx-col w-1/5" }, [
                    _c("img", {
                      staticClass:
                        "w-12 h-12 rounded border-solid border-2 border-white mx-auto text-center",
                      attrs: { src: _vm.src }
                    })
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "vx-col w-4/5 text-left",
                      class: { "lds-dual-ring ": _vm.isLoading }
                    },
                    [
                      _c("p", {
                        staticClass:
                          "text-white text-xs font-light text-shadow",
                        domProps: { innerHTML: _vm._s(_vm.description) }
                      })
                    ]
                  )
                ])
              ])
            ],
            1
          )
        ],
        2
      )
    : _c("div", { staticClass: "relative inline" }, [
        _c("img", {
          staticClass:
            "inline tooltip-target w-10 h-10 rounded tooltip-target border-solid border-2 border-theme-dark",
          attrs: {
            loading: "lazy",
            width: "32",
            height: "32",
            alt: "None",
            src: _vm.srcIfNull
          }
        })
      ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/assets/images/livefeed/unknown.png":
/*!******************************************************!*\
  !*** ./resources/assets/images/livefeed/unknown.png ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/unknown.png?7ced93dff2bc2df950b3a39457228519";

/***/ }),

/***/ "./resources/js/src/components/popovers/PopoverAvatar.vue":
/*!****************************************************************!*\
  !*** ./resources/js/src/components/popovers/PopoverAvatar.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PopoverAvatar.vue?vue&type=template&id=65af9afd& */ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd&");
/* harmony import */ var _PopoverAvatar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PopoverAvatar.vue?vue&type=script&lang=js& */ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PopoverAvatar.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _PopoverAvatar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/components/popovers/PopoverAvatar.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PopoverAvatar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss& ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PopoverAvatar.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./PopoverAvatar.vue?vue&type=template&id=65af9afd& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/components/popovers/PopoverAvatar.vue?vue&type=template&id=65af9afd&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PopoverAvatar_vue_vue_type_template_id_65af9afd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);