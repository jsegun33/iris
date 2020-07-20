(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


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
// import SubTypeHeader from '../../components/PageHeaders/SubTypeHeader';
/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component mounted.');
    this.GetUserData();
  },
  // components: {
  //     SubTypeHeader
  // },
  data: function data() {
    var _ref;

    return _ref = {
      editmode: false,
      UserDetails: {},
      AllRolesList: {},
      ReportDynamic: {},
      // GetUWStaff: {},
      columns: ['AccountName', 'AccountNo', 'actions']
    }, _defineProperty(_ref, "ReportDynamic", []), _defineProperty(_ref, "options", {
      headings: {
        AccountName: 'Requester Acct',
        AccountNo: 'Requester Name',
        action: "action"
      },
      sortable: ['AccountName', 'AccountNo'],
      filterable: ['AccountName', 'AccountNo']
    }), _defineProperty(_ref, "form", new Form({
      _id: '',
      InchargeName: '',
      InchargeNameUW: '',
      // SubLink_URL: '',
      // active: '',
      // icon_display: '',
      RequestNo: '',
      DisMenu: '',
      DisMenuUW: ''
    })), _ref;
  },
  methods: {
    GetUserData: function GetUserData() {
      var _this = this;

      var response, PassID;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function GetUserData$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("GetUserData").then(function (_ref2) {
                var data = _ref2.data;
                return _this.UserDetails = data;
              }));

            case 2:
              response = _context.sent;
              this.form.CustAcctNo = this.UserDetails.AccountNo;
              PassID = window.location.pathname;
              this.form.PassURL = PassID;
              _context.next = 8;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(this.form.post("api/GetAllUserAccessRole").then(function (_ref3) {
                var data = _ref3.data;
                return _this.AllRolesList = data;
              }));

            case 8:
              this.loadType();
              this.loadMainType();

            case 10:
            case "end":
              return _context.stop();
          }
        }
      }, null, this);
    },
    VerifyAccessRoles: function VerifyAccessRoles() {
      if (this.AllRolesList === "NO ACCESS") {
        this.$router.push('/Dashboard');
      }
    },
    loadType: function loadType() {
      var _this2 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function loadType$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/CreateReportDynamic").then(function (_ref4) {
                var data = _ref4.data;
                return _this2.ReportDynamic = data;
              }));

            case 2:
            case "end":
              return _context2.stop();
          }
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d& ***!
  \*********************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    this.AllRolesList === "NO ACCESS"
      ? _c(
          "section",
          {
            staticClass: "content",
            on: {
              mouseover: function($event) {
                return _vm.VerifyAccessRoles()
              }
            }
          },
          [
            _c(
              "div",
              {
                staticClass: "box-header with-border box box-success",
                attrs: { id: "quotehead" }
              },
              [
                _c(
                  "h1",
                  [
                    _c("big", { staticClass: "label label-warning" }, [
                      _vm._v(_vm._s(this.AllRolesList))
                    ])
                  ],
                  1
                )
              ]
            )
          ]
        )
      : _vm._e(),
    _vm._v(" "),
    this.UserList !== "NO RECORD FOUND" && this.AllRolesList === "YES ACCESS"
      ? _c("section", { staticClass: "content" }, [
          _c(
            "div",
            {
              staticClass: "box-header with-border box box-success",
              attrs: { id: "quotehead" }
            },
            [
              _c("h1", [_vm._v("Create Report")]),
              _vm._v(" "),
              _c("v-client-table", {
                attrs: {
                  data: _vm.ReportDynamic,
                  columns: _vm.columns,
                  options: _vm.options
                }
              })
            ],
            1
          )
        ])
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/Admin/DefaultData.vue":
/*!********************************************!*\
  !*** ./resources/js/Admin/DefaultData.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DefaultData.vue?vue&type=template&id=7723ea7d& */ "./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d&");
/* harmony import */ var _DefaultData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DefaultData.vue?vue&type=script&lang=js& */ "./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _DefaultData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__["render"],
  _DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Admin/DefaultData.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DefaultData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./DefaultData.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Admin/DefaultData.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DefaultData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d&":
/*!***************************************************************************!*\
  !*** ./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d& ***!
  \***************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./DefaultData.vue?vue&type=template&id=7723ea7d& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Admin/DefaultData.vue?vue&type=template&id=7723ea7d&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DefaultData_vue_vue_type_template_id_7723ea7d___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);