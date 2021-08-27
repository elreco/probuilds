(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[7],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/views/main/partials/SearchBanner */ "./resources/js/src/views/main/partials/SearchBanner.vue");
/* harmony import */ var _partials_RegionNavbar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./partials/RegionNavbar */ "./resources/js/src/views/spectate/partials/RegionNavbar.vue");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_3__);
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
  data: function data() {
    return {
      title: this.$i18n.t("meta.title.home"),
      regions: [],
      queueIDs: [],
      queueLoading: true,
      queueType: [],
      isFetching: true,
      activeRegion: this.$route.params.region,
      matches: [],
      polling: null,
      ago: [],
      agoInterval: null,
      popupActive: false,
      popupMatch: {
        champion: []
      },
      activeItem: 0,
      os: "windows"
    };
  },
  components: {
    SearchBanner: _views_main_partials_SearchBanner__WEBPACK_IMPORTED_MODULE_0__["default"],
    RegionNavbar: _partials_RegionNavbar__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mounted: function mounted() {
    this.getRegions();
    this.getLiveMatches();
    this.pollLiveMatches();
  },
  methods: {
    getLiveMatches: function getLiveMatches() {
      var _this = this;

      // loading
      this.loadingData(true, "#loadingSpectate");
      this.liveMatches().then(function () {
        _this.loadingData(false, "#loadingSpectate");
      }).then(function (response) {
        _this.isFetching = false;
      });
    },
    forceFileDownload: function forceFileDownload(response, fileName) {
      var url = window.URL.createObjectURL(new Blob([response.data]));
      var link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", fileName); //or any other extension

      document.body.appendChild(link);
      link.click();
    },
    download: function download(url, matchId) {
      var _this2 = this;

      axios__WEBPACK_IMPORTED_MODULE_3___default()({
        method: "get",
        url: "https://moi.elreco.fr" + url,
        responseType: "blob"
      }).then(function (response) {
        _this2.forceFileDownload(response, "EvilSpartan_lol_spectate_" + _this2.activeRegion + "_" + matchId + ".bat");
      });
    },
    pollLiveMatches: function pollLiveMatches() {
      var _this3 = this;

      window.Echo.channel("probuilds").listen(".spectate", function (e) {
        if (_this3.matches.length) {
          _this3.liveMatches();
        }
      });
      /* this.polling = setInterval(
          function() {
              if (this.matches.length) {
                  this.liveMatches();
              }
          }.bind(this),
          10000
      ); */
    },
    openPopup: function openPopup(match) {
      this.popupActive = true;
      this.popupMatch = match;
    },
    liveMatches: function liveMatches() {
      var _this4 = this;

      return this.$http.get("spectate", {
        params: {
          region: this.activeRegion,
          locale: this.$route.params.locale
        }
      }).then(function (response) {
        _this4.matches = response.data.matches;
        _this4.queueIDs = response.data.queueIDs;
      }).then(function (response) {
        _this4.getQueuesTypes();
      }).then(function (response) {
        clearInterval(_this4.agoInterval);

        _this4.updateDate();

        _this4.agoInterval = setInterval(function () {
          _this4.updateDate();
        }, 1000);
      });
    },
    updateDate: function updateDate() {
      var _this5 = this;

      this.matches = this.matches.map(function (m, index) {
        var a = moment__WEBPACK_IMPORTED_MODULE_2___default()();
        var b = moment__WEBPACK_IMPORTED_MODULE_2___default()(m.date);
        _this5.ago[index] = moment__WEBPACK_IMPORTED_MODULE_2___default.a.utc(a.diff(b, "seconds") * 1000).add(1, "seconds").format("mm:ss");
        return m;
      });
    },
    getRegions: function getRegions() {
      var _this6 = this;

      this.$http.get("regions", {
        cache: true
      }).then(function (response) {
        _this6.regions = response.data;
      });
    },
    setQueue: function setQueue(queueID) {
      return !this.queueLoading ? this.queueType[queueID].name : '<i class="fas fa-spinner fa-spin"></i>';
    },
    getQueuesTypes: function getQueuesTypes() {
      var _this7 = this;

      if (this.matches.length) this.$http.get("queues-types", {
        params: {
          queues: this.queueIDs,
          locale: this.$route.params.locale
        }
      }).then(function (response) {
        _this7.queueType = response.data;
        _this7.queueLoading = false;
      });
    },
    changeOS: function changeOS(os) {
      this.os = os;
    },
    loadingData: function loadingData(boolean, id) {
      if (boolean) {
        this.$vs.loading({
          type: "default",
          container: id
        });
      } else {
        this.$vs.loading.close(id + " > .con-vs-loading");
      }
    }
  },
  beforeDestroy: function beforeDestroy() {
    clearInterval(this.polling);
    clearInterval(this.agoInterval);
  },
  metaInfo: function metaInfo() {
    // if no subcomponents specify a metaInfo.title, this title will be used
    return {
      title: "".concat(this.title),
      // all titles will be injected into this template
      titleTemplate: "EvilSpartan.com – %s"
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js& ***!
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
      colorx: "#0091EA"
    };
  },
  props: ["regions", "activeRegion"]
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".vs-textarea {\n  height: 100%;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".myNavbar .is-active-item a {\n  color: white !important;\n}\n.myNavbar .vs-navbar--item:hover a {\n  color: white !important;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Spectate.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&");

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

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader??ref--7-1!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RegionNavbar.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56& ***!
  \*******************************************************************************************************************************************************************************************************************/
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
    [
      _c("div", { staticClass: "vx-row" }, [
        _c(
          "div",
          { staticClass: "vx-col w-1/2 mx-auto mb-base" },
          [
            _c("region-navbar", {
              staticClass: "vs-con-loading__container",
              attrs: {
                regions: _vm.regions,
                activeRegion: _vm.activeRegion,
                id: "loadingRegions"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "items-grid-view vx-row match-height",
          attrs: { id: "loadingSpectate" }
        },
        _vm._l(_vm.matches, function(match, index) {
          return _c(
            "div",
            {
              key: index,
              staticClass: "vx-col xl:w-1/5 md:w-1/3 w-full",
              attrs: { data: match }
            },
            [
              _c(
                "vx-card",
                {
                  staticClass: "grid-view-item mb-base overflow-hidden",
                  staticStyle: { "background-size": "cover" },
                  attrs: {
                    "card-background":
                      "linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)),no-repeat 100% 25%/100% url(" +
                      match.champion.splash +
                      ")"
                  }
                },
                [
                  _c("template", { slot: "no-body" }, [
                    _c(
                      "div",
                      {
                        staticClass:
                          "item-img-container mx-auto flex items-center justify-center my-4 cursor-pointer"
                      },
                      [
                        _c("img", {
                          staticClass:
                            "grid-view-img w-16 h-16 rounded border-solid border-2 border-primary shadow-primary",
                          staticStyle: {
                            "border-radius": "50%",
                            "object-fit": "cover"
                          },
                          attrs: { src: match.champion.src }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "item-details px-4" }, [
                      _c(
                        "div",
                        { staticClass: "flex justify-between items-center" },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "text-gold border border-solid border-gold flex py-1 px-2 rounded"
                            },
                            [
                              _c("feather-icon", {
                                attrs: {
                                  icon: "VideoIcon",
                                  svgClasses: "h-4 w-4"
                                }
                              }),
                              _vm._v(" "),
                              _c("span", { staticClass: "text-sm ml-1" }, [
                                _vm._v(_vm._s(_vm.ago[index]))
                              ])
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "h6",
                            { staticClass: "font-bold" },
                            [
                              _c(
                                "router-link",
                                {
                                  staticClass: "hover:text-primary text-white",
                                  attrs: {
                                    to: {
                                      name: "probuilds.champions",
                                      params: { champion: match.champion.id }
                                    }
                                  }
                                },
                                [_vm._v(_vm._s(match.champion.name))]
                              )
                            ],
                            1
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "my-4 text-center" }, [
                        _c(
                          "h6",
                          {
                            staticClass:
                              "truncate font-semibold mb-1 hover:text-primary cursor-pointer"
                          },
                          [
                            _c(
                              "a",
                              {
                                staticClass: "hover:text-primary text-white",
                                attrs: {
                                  target: "_blank",
                                  href:
                                    "https://" +
                                    match.region +
                                    ".op.gg/summoner/userName=" +
                                    match.summonerName
                                }
                              },
                              [
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(match.summonerName) +
                                    "\n                                    "
                                ),
                                _c("i", {
                                  staticClass: "fas fa-external-link-alt"
                                })
                              ]
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("p", {
                          staticClass:
                            "item-description truncate text-sm text-gold font-light",
                          domProps: {
                            innerHTML: _vm._s(_vm.setQueue(match.queueID))
                          }
                        }),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass:
                              "con-vs-chip vs-chip-primary con-color w-12 mx-auto mt-2 mb-5 rounded-sm float-none"
                          },
                          [
                            _c(
                              "span",
                              { staticClass: "text-chip vs-chip--text" },
                              [_vm._v(_vm._s(match.region.toUpperCase()))]
                            )
                          ]
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "flex flex-wrap" }, [
                      _c(
                        "div",
                        {
                          staticClass:
                            "item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer",
                          on: {
                            click: function($event) {
                              _vm.download(match.url, match.matchId)
                              _vm.openPopup(match)
                            }
                          }
                        },
                        [
                          _c("feather-icon", {
                            attrs: { icon: "EyeIcon", svgClasses: "h-4 w-4" }
                          }),
                          _vm._v(" "),
                          _c(
                            "span",
                            {
                              staticClass:
                                "text-sm font-semibold ml-2 uppercase"
                            },
                            [_vm._v(_vm._s(_vm.$t("Spectate.watch")))]
                          )
                        ],
                        1
                      )
                    ])
                  ])
                ],
                2
              )
            ],
            1
          )
        }),
        0
      ),
      _vm._v(" "),
      _vm.matches && _vm.matches.length == 0 && _vm.isFetching == false
        ? _c(
            "div",
            {
              staticClass: "bg-primary text-white px-4 py-3 shadow-md",
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
                    _vm._v(_vm._s(_vm.$t("Message.noData")))
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "text-sm" }, [
                    _vm._v(_vm._s(_vm.$t("Message.noMatchesData")))
                  ])
                ])
              ])
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c(
        "vs-popup",
        {
          staticClass: "holamundo",
          attrs: {
            title:
              _vm.popupMatch.summonerName +
              " - " +
              _vm.popupMatch.champion.name,
            active: _vm.popupActive
          },
          on: {
            "update:active": function($event) {
              _vm.popupActive = $event
            }
          }
        },
        [
          _c(
            "vs-navbar",
            {
              staticClass: "vx-navbar rounded-sm px-5 myNavbar text-white mb-4",
              attrs: {
                color: "#0091EA",
                "text-color": "rgba(255,255,255,.6)",
                "active-text-color": "rgba(255,255,255,1)"
              },
              model: {
                value: _vm.activeItem,
                callback: function($$v) {
                  _vm.activeItem = $$v
                },
                expression: "activeItem"
              }
            },
            [
              _c(
                "div",
                { attrs: { slot: "title" }, slot: "title" },
                [
                  _c(
                    "vs-navbar-title",
                    { staticClass: "font-semibold text-sm text-white" },
                    [_vm._v(_vm._s(_vm.$t("Spectate.OS")))]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("vs-navbar-item", { attrs: { index: "0" } }, [
                _c(
                  "a",
                  {
                    staticClass: "text-base",
                    attrs: { href: "#" },
                    on: {
                      click: function($event) {
                        return _vm.changeOS("windows")
                      }
                    }
                  },
                  [
                    _c("i", { staticClass: "fab fa-windows pr-1" }),
                    _vm._v(" Windows\n                ")
                  ]
                )
              ]),
              _vm._v(" "),
              _c("vs-navbar-item", { attrs: { index: "1" } }, [
                _c(
                  "a",
                  {
                    staticClass: "text-base",
                    attrs: { href: "#" },
                    on: {
                      click: function($event) {
                        return _vm.changeOS("mac")
                      }
                    }
                  },
                  [
                    _c("i", { staticClass: "fab fa-apple pr-1" }),
                    _vm._v(" Mac\n                ")
                  ]
                )
              ])
            ],
            1
          ),
          _vm._v(" "),
          _c("vx-card", [
            _c(
              "div",
              {
                staticClass: "w-full",
                class: _vm.os == "windows" ? "block" : "hidden"
              },
              [
                _c("p", { staticClass: "text-white text-sm mb-4" }, [
                  _vm._v(
                    "\n                    " +
                      _vm._s(_vm.$t("Spectate.restartDownload1")) +
                      "\n                    " +
                      _vm._s(_vm.$t("Spectate.restartDownload2")) +
                      "\n                    "
                  ),
                  _c(
                    "a",
                    {
                      staticClass: "text-gold hover:text-primary",
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          return _vm.download(
                            _vm.popupMatch.url,
                            _vm.popupMatch.matchId
                          )
                        }
                      }
                    },
                    [_vm._v(_vm._s(_vm.$t("Spectate.restartDownload3")))]
                  )
                ]),
                _vm._v(" "),
                _c("hr"),
                _vm._v(" "),
                _c("img", {
                  staticClass:
                    "border-2 border-primary border-solid w-full mt-4",
                  attrs: {
                    src: __webpack_require__(/*! @assets/images/match/tuto.gif */ "./resources/assets/images/match/tuto.gif"),
                    icon: "windows"
                  }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "w-full",
                class: _vm.os == "mac" ? "block" : "hidden"
              },
              [
                _c("p", {
                  staticClass: "text-white text-sm mb-4",
                  domProps: { innerHTML: _vm._s(_vm.$t("Spectate.macMessage")) }
                }),
                _vm._v(" "),
                _c("hr"),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "vs-component vs-con-textarea mt-4 vs-textarea-primary",
                    staticStyle: {
                      border: "1px solid rgba(0, 0, 0, 0.08)",
                      height: "295px"
                    }
                  },
                  [
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.popupMatch.mac,
                          expression: "popupMatch.mac"
                        }
                      ],
                      staticClass: "vs-textarea",
                      attrs: { readonly: "" },
                      domProps: { value: _vm.popupMatch.mac },
                      on: {
                        focus: function($event) {
                          return $event.target.select()
                        },
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(_vm.popupMatch, "mac", $event.target.value)
                        }
                      }
                    })
                  ]
                )
              ]
            )
          ])
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675& ***!
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
  return _c(
    "vs-navbar",
    {
      staticClass:
        "vx-navbar px-5 myNavbar text-white vs-con-loading__container mb-4",
      attrs: {
        color: "#0091EA",
        "text-color": "rgba(255,255,255,.6)",
        "active-text-color": "rgba(255,255,255,1)",
        id: "regionLoading"
      },
      model: {
        value: _vm.activeRegion,
        callback: function($$v) {
          _vm.activeRegion = $$v
        },
        expression: "activeRegion"
      }
    },
    [
      _c(
        "div",
        { attrs: { slot: "title" }, slot: "title" },
        [
          _c(
            "vs-navbar-title",
            { staticClass: "font-semibold uppercase text-white" },
            [_vm._v(_vm._s(_vm.$t("Global.Regions")))]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "vs-navbar-item",
        [
          _c("router-link", { attrs: { to: { name: "spectate" } } }, [
            _vm._v(_vm._s(_vm.$t("LiveFeed.allRegion")))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _vm._l(_vm.regions, function(data, index) {
        return _c(
          "vs-navbar-item",
          { key: index, attrs: { index: data, data: data } },
          [
            _c(
              "router-link",
              {
                attrs: {
                  to: {
                    name: "spectate",
                    params: {
                      region: data
                    }
                  }
                }
              },
              [_vm._v(_vm._s(data))]
            )
          ],
          1
        )
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/assets/images/match/tuto.gif":
/*!************************************************!*\
  !*** ./resources/assets/images/match/tuto.gif ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/tuto.gif?59846deefe15e66699100770ea92e955";

/***/ }),

/***/ "./resources/js/src/views/spectate/Spectate.vue":
/*!******************************************************!*\
  !*** ./resources/js/src/views/spectate/Spectate.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Spectate.vue?vue&type=template&id=3f601f56& */ "./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56&");
/* harmony import */ var _Spectate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Spectate.vue?vue&type=script&lang=js& */ "./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Spectate.vue?vue&type=style&index=0&lang=css& */ "./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Spectate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/spectate/Spectate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Spectate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************************!*\
  !*** ./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Spectate.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56&":
/*!*************************************************************************************!*\
  !*** ./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Spectate.vue?vue&type=template&id=3f601f56& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/Spectate.vue?vue&type=template&id=3f601f56&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Spectate_vue_vue_type_template_id_3f601f56___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/src/views/spectate/partials/RegionNavbar.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/src/views/spectate/partials/RegionNavbar.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RegionNavbar.vue?vue&type=template&id=40ea3675& */ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675&");
/* harmony import */ var _RegionNavbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RegionNavbar.vue?vue&type=script&lang=js& */ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./RegionNavbar.vue?vue&type=style&index=0&lang=css& */ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _RegionNavbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/spectate/partials/RegionNavbar.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RegionNavbar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css& ***!
  \****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader??ref--7-1!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RegionNavbar.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./RegionNavbar.vue?vue&type=template&id=40ea3675& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/spectate/partials/RegionNavbar.vue?vue&type=template&id=40ea3675&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RegionNavbar_vue_vue_type_template_id_40ea3675___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);