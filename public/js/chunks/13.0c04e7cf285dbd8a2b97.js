(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{pKmM:function(t,e,n){"use strict";n.r(e);var r=n("nyNP"),s=n("L2JU");function i(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var a={data:function(){return{title:this.$i18n.t("meta.title.community"),description:this.$i18n.t("meta.description.community"),steps:[{target:"#btnLogin",content:this.$i18n.t("Message.tourLoginMessage")}]}},components:{SearchBanner:r.a,VxTour:function(){return n.e(10).then(n.bind(null,"pC3X"))}},computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?i(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(s.b)({user:"auth/user"}),{windowWidth:function(){return this.$store.state.windowWidth}}),metaInfo:function(){return{title:"".concat(this.title),titleTemplate:"EvilSpartan.com – %s",meta:[{name:"description",content:"".concat(this.description)},{property:"og:title",content:"".concat(this.title)},{property:"og:site_name",content:"EvilSpartan.com"},{property:"og:type",content:"website"},{name:"robots",content:"index,follow"}]}}},c=n("KHd+"),l=Object(c.a)(a,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("section",{attrs:{id:"dashboard-analytics"}},[t.windowWidth>=1200&&!t.user?n("vx-tour",{attrs:{steps:t.steps}}):t._e(),t._v(" "),n("div",{staticClass:"vx-row"},[n("div",{staticClass:"vx-col w-full mb-base"},[n("search-banner",{attrs:{displayDecore:!0},scopedSlots:t._u([{key:"default",fn:function(){return[n("h1",{staticClass:"mb-4 text-white"},[t._v(t._s(t.$t("Community.title")))]),t._v(" "),n("p",{staticClass:"xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white",domProps:{innerHTML:t._s(t.$t("Community.description"))}})]},proxy:!0}])})],1)]),t._v(" "),n("div",{staticClass:"bg-warning text-white px-4 py-3 shadow-md",attrs:{role:"alert"}},[n("div",{staticClass:"flex"},[n("div",{staticClass:"py-1"},[n("svg",{staticClass:"fill-current h-6 w-6 text-teal-500 mr-4",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"}},[n("path",{attrs:{d:"M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"}})])]),t._v(" "),n("div",[n("p",{staticClass:"font-bold"},[t._v(t._s(t.$t("Message.notAvailable")))]),t._v(" "),n("p",{staticClass:"text-sm",domProps:{innerHTML:t._s(t.$t("Message.notAvailableDescription"))}})])])])],1)}),[],!1,null,null,null);e.default=l.exports}}]);