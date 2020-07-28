(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[17],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_popovers_PopoverAvatar__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/popovers/PopoverAvatar */ "./resources/js/src/components/popovers/PopoverAvatar.vue");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "live-feed",
  props: ["champion"],
  data: function data() {
    return {
      selectedLane: "all",
      selectedRegion: null,
      isFetching: true,
      page: 1,
      regions: [],
      totalItems: 0,
      get_feed_is_running: false,
      matches: {
        data: [],
        totalItems: 1,
        maxItems: 1
      },
      requests: [],
      request: null
    };
  },
  mounted: function mounted() {
    this.getFeed();
    this.getRegions();
    this.pollLiveMatches();
  },
  methods: {
    handleSelected: function handleSelected(tr) {
      this.$router.push({
        name: "probuilds.matches",
        params: {
          region: tr.region,
          summonerId: tr.summonerId,
          matchId: tr.matchId,
          champion: tr.champion.id,
          participantId: tr.participantId
        }
      });
    },
    handleChangePage: function handleChangePage(page) {
      this.page = page;
      this.getFeed();
    },
    getFeed: function getFeed() {
      var _this = this;

      // loading
      this.loadingData(true, "#loadingFeed");
      this.livefeed().then(function () {
        _this.loadingData(false, "#loadingFeed");
      }); // UPDATE this.matches après avoir fait la requête axios
    },
    livefeed: function livefeed() {
      var _this2 = this;

      return this.$http.get("livefeed", {
        params: {
          page: this.page,
          lane: this.selectedLane,
          region: this.selectedRegion,
          champion: this.champion,
          locale: this.$route.params.locale
        }
      }).then(function (response) {
        _this2.isFetching = false;
        _this2.matches = response.data;

        _this2.formatDate();
      }).then(function () {
        setInterval(function () {
          _this2.formatDate();
        }, 1000);
      });
    },
    formatDate: function formatDate() {
      if (this.matches.data.length) {
        this.matches.data = this.matches.data.map(function (m) {
          m.ago = moment__WEBPACK_IMPORTED_MODULE_1___default()(m.date).fromNow();
          return m;
        });
      }
    },
    getRegions: function getRegions() {
      var _this3 = this;

      this.loadingData(true, "#loadingRegions");
      this.$http.get("regions").then(function (response) {
        _this3.regions = response.data;
      }).then(function () {
        _this3.loadingData(false, "#loadingRegions");
      });
    },
    pollLiveMatches: function pollLiveMatches() {
      var _this4 = this;

      var channelName = ".livefeed." + this.selectedLane;

      if (this.champion) {
        channelName += "." + this.champion;
      }

      window.Echo.channel("probuilds").listen(channelName, function (e) {
        if (_this4.matches.data.length) {
          _this4.livefeed();
        }
      });
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
  computed: {
    filterTable: function filterTable() {
      var selectedLane = this.selectedLane;
      var selectedRegion = this.selectedRegion;
      return {
        selectedLane: selectedLane,
        selectedRegion: selectedRegion
      };
    }
  },
  watch: {
    filterTable: function filterTable() {
      this.handleChangePage(1);
    }
  },
  components: {
    PopoverAvatar: _components_popovers_PopoverAvatar__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "[dir] .selectExample {\n  margin: 10px;\n}\n.con-select-example {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.con-select .vs-select {\n  width: 100%;\n}\n@media (max-width: 550px) {\n.con-select {\n    flex-direction: column;\n}\n.con-select .vs-select {\n    width: 100%;\n}\n}\n.vs__dropdown-menu {\n  z-index: 9999 !important;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader??ref--7-1!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LiveFeed.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220& ***!
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
  return _c("div", { staticClass: "vx-row" }, [
    _c(
      "div",
      { staticClass: "vx-col w-full" },
      [
        _c(
          "vs-navbar",
          {
            staticClass: "nabarx mb-base lane-selection p-2",
            attrs: {
              "active-text-color": "rgba(255,255,255,1)",
              "text-color": "",
              type: "flat",
              id: "loadingRegions"
            },
            model: {
              value: _vm.selectedLane,
              callback: function($$v) {
                _vm.selectedLane = $$v
              },
              expression: "selectedLane"
            }
          },
          [
            _c(
              "div",
              { attrs: { slot: "title" }, slot: "title" },
              [
                _c("vs-navbar-title", [
                  _vm._v(_vm._s(_vm.$t("LiveFeed.title")))
                ])
              ],
              1
            ),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "all" } }, [
              _c("a", { staticClass: "all", attrs: { href: "#" } }, [
                _vm._v(_vm._s(_vm.$t("LiveFeed.all")))
              ])
            ]),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "top" } }, [
              _c("a", { staticClass: "top", attrs: { href: "#" } }, [
                _vm._v("Top")
              ])
            ]),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "jungle" } }, [
              _c("a", { staticClass: "jungle", attrs: { href: "#" } }, [
                _vm._v("Jungle")
              ])
            ]),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "mid" } }, [
              _c("a", { staticClass: "mid", attrs: { href: "#" } }, [
                _vm._v("Mid")
              ])
            ]),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "adc" } }, [
              _c("a", { staticClass: "bot", attrs: { href: "#" } }, [
                _vm._v("Bot")
              ])
            ]),
            _vm._v(" "),
            _c("vs-navbar-item", { attrs: { index: "support" } }, [
              _c("a", { staticClass: "support", attrs: { href: "#" } }, [
                _vm._v("Support")
              ])
            ]),
            _vm._v(" "),
            _c("v-select", {
              staticClass: "w-48",
              attrs: {
                clearable: true,
                options: _vm.regions,
                placeholder: _vm.$t("LiveFeed.allRegion")
              },
              model: {
                value: _vm.selectedRegion,
                callback: function($$v) {
                  _vm.selectedRegion = $$v
                },
                expression: "selectedRegion"
              }
            })
          ],
          1
        ),
        _vm._v(" "),
        Object.keys(_vm.matches.data).length != 0 || _vm.isFetching == true
          ? _c(
              "vs-table",
              {
                staticClass: "vs-con-loading__container",
                attrs: {
                  noDataText: "",
                  currentPage: _vm.page,
                  sst: true,
                  "max-items": _vm.matches.maxItems,
                  total: _vm.matches.totalItems,
                  pagination: "",
                  data: _vm.matches.data,
                  id: "loadingFeed"
                },
                on: {
                  "change-page": _vm.handleChangePage,
                  selected: _vm.handleSelected
                },
                scopedSlots: _vm._u(
                  [
                    {
                      key: "default",
                      fn: function(ref) {
                        var data = ref.data
                        return _vm._l(data, function(tr, indextr) {
                          return _c(
                            "vs-tr",
                            {
                              key: indextr,
                              staticClass: "whitespace-no-wrap text-base",
                              attrs: { data: tr }
                            },
                            [
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.date }
                                },
                                [_vm._v(_vm._s(tr.ago))]
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.champion }
                                },
                                [
                                  _c("popover-avatar", {
                                    attrs: {
                                      win: tr.win,
                                      default: false,
                                      type: "champions",
                                      id: tr.champion.id,
                                      src: tr.champion.src
                                    }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                { attrs: { data: tr.player } },
                                [
                                  _c(
                                    "vs-chip",
                                    { attrs: { color: "primary" } },
                                    [
                                      _c("vs-avatar", {
                                        attrs: { src: tr.player.icon }
                                      }),
                                      _vm._v(
                                        "\n                            " +
                                          _vm._s(tr.player.name) +
                                          "\n                        "
                                      )
                                    ],
                                    1
                                  )
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.vs }
                                },
                                [
                                  _c("popover-avatar", {
                                    attrs: {
                                      src: tr.vs.src,
                                      type: "champions",
                                      id: tr.vs.id
                                    }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.kda }
                                },
                                [_vm._v(_vm._s(tr.kda))]
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.gold }
                                },
                                [_vm._v(_vm._s(tr.gold))]
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.keystone }
                                },
                                [
                                  _c(
                                    "div",
                                    { staticClass: "relative inline" },
                                    [
                                      _c("vs-avatar", {
                                        attrs: { src: tr.keystone }
                                      }),
                                      _vm._v(" "),
                                      _c("img", {
                                        staticClass:
                                          "supperposed-avatar rounded",
                                        attrs: { src: tr.subkeystone }
                                      })
                                    ],
                                    1
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.items }
                                },
                                [
                                  _vm._l(tr.items, function(item, index) {
                                    return _c("popover-avatar", {
                                      key: index,
                                      attrs: {
                                        src: item.src,
                                        id: item.id,
                                        type: "items"
                                      }
                                    })
                                  }),
                                  _vm._v(" "),
                                  _vm._l(
                                    6 - Object.keys(tr.items).length,
                                    function(n) {
                                      return _c("div", {
                                        key: n + 100,
                                        staticClass:
                                          "inline-block w-10 h-10 rounded bg-theme-dark mr-1"
                                      })
                                    }
                                  )
                                ],
                                2
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.summonerSpells }
                                },
                                _vm._l(tr.summonerSpells, function(
                                  spell,
                                  index
                                ) {
                                  return _c("popover-avatar", {
                                    key: index,
                                    attrs: {
                                      src: spell.src,
                                      id: spell.id,
                                      type: "spells"
                                    }
                                  })
                                }),
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-td",
                                {
                                  staticClass: "text-center",
                                  attrs: { data: tr.region }
                                },
                                [_vm._v(_vm._s(tr.region.toUpperCase()))]
                              )
                            ],
                            1
                          )
                        })
                      }
                    }
                  ],
                  null,
                  false,
                  700522318
                )
              },
              [
                _c(
                  "template",
                  { slot: "thead" },
                  [
                    _c("vs-th"),
                    _vm._v(" "),
                    _c("vs-th"),
                    _vm._v(" "),
                    _c("vs-th", [_vm._v(_vm._s(_vm.$t("LiveFeed.player")))]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.vs")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.kda")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.gold")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.keystone")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.build")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.summoners")))
                    ]),
                    _vm._v(" "),
                    _c("vs-th", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(_vm.$t("LiveFeed.region")))
                    ])
                  ],
                  1
                )
              ],
              2
            )
          : _c(
              "div",
              {
                staticClass: "bg-primary text-teal-900 px-4 py-3 shadow-md",
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
                      _vm._v(_vm._s(_vm.$t("Message.noLivefeedData")))
                    ])
                  ])
                ])
              ]
            )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/probuilds/partials/LiveFeed.vue":
/*!****************************************************************!*\
  !*** ./resources/js/src/views/probuilds/partials/LiveFeed.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LiveFeed.vue?vue&type=template&id=58ae4220& */ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220&");
/* harmony import */ var _LiveFeed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LiveFeed.vue?vue&type=script&lang=js& */ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./LiveFeed.vue?vue&type=style&index=0&lang=css& */ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _LiveFeed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/probuilds/partials/LiveFeed.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LiveFeed.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css& ***!
  \*************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader??ref--7-1!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LiveFeed.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LiveFeed.vue?vue&type=template&id=58ae4220& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/probuilds/partials/LiveFeed.vue?vue&type=template&id=58ae4220&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LiveFeed_vue_vue_type_template_id_58ae4220___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);