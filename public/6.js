(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    var _this = this;

    axios.get("GetUserData").then(function (_ref) {
      var data = _ref.data;
      return _this.UserDetails = data;
    });
    var uri = window.location.href.split('?');
    var PassID = uri[1].trim();
    axios.get("api/URLQueryRequestModify/" + PassID).then(function (_ref2) {
      var data = _ref2.data;
      return _this.ResultQueryRequest = data;
    });
    this.LoadDataRequest();
  },
  data: function data() {
    return {
      ResultQueryRequest: {},
      UserDetails: {},
      form: new Form({
        RequestNo1: '',
        RequestNo: '',
        AmountDue: '',
        PaymntDescription: '',
        CustEmail: '',
        PaymentGateway: ''
      })
    };
  },
  methods: {
    DragonPayMode: function DragonPayMode() {
      var _this2 = this;

      //   let PassID         = this.form.RequestNo1 ;
      var PassDataPayment = this.form.RequestNo + ";;" + this.form.AmountDue + ";;" + this.form.PaymntDescription + ";;" + this.form.CustEmail + ";;" + this.form.RequestNo1; //                alert(PassDataPayment);

      Swal.fire({
        title: "Are you sure?",
        text: "You want to Proceed to Payment !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Pay Now...!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          //this.$router.push('/Customer-Issuance?' + PassID); 
          var route = _this2.$router.resolve({
            path: 'api/PaymentMode/' + PassDataPayment
          });

          window.open(route.href, '_blank');
          console.log(PassDataPayment);
        }
      });
    },
    LoadDataRequest: function LoadDataRequest() {
      var _this3 = this;

      this.RetrieveTimeInterval = setInterval(function () {
        //   alert(this.ResultQueryRequest.AccountNo);
        _this3.form.RequestNo1 = _this3.ResultQueryRequest.RequestNo;
        _this3.form.RequestNo = _this3.ResultQueryRequest.RequestNo + "-" + _this3.ResultQueryRequest.AcceptedOption;
        _this3.form.PaymentMode = _this3.ResultQueryRequest.PaymentGateway;
        _this3.form.PaymntDescription = "Payment for Denomination " + _this3.ResultQueryRequest.SubLinesName + " under the name " + _this3.ResultQueryRequest.CName + " with Plate No. " + _this3.ResultQueryRequest.PlateNumber;
        _this3.form.AmountDue = _this3.ResultQueryRequest.AmountDue;
        _this3.form.CustEmail = _this3.ResultQueryRequest.RequestNo;
        _this3.form.PaymentGateway = _this3.ResultQueryRequest.RequestNo;
      }, 1000);
      this.RetrieveTimeInterval2 = setInterval(function () {
        clearInterval(_this3.RetrieveTimeInterval);
      }, 5000);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("section", { staticClass: "content" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-12" }, [
            _c("div", { staticClass: "box box-success" }, [
              _c("div", { staticClass: "box-header" }, [
                _c("h1", [_vm._v("SUCCESS ")]),
                _c("br"),
                _vm._v(" "),
                _c("img", {
                  staticStyle: { width: "150px" },
                  attrs: {
                    src: "/img/check-big.png",
                    alt: "RSILogo",
                    id: "quoteslogo"
                  }
                }),
                _vm._v(" "),
                _c("h1", [_vm._v("Thank You!")]),
                _vm._v(" "),
                _c("h5", [
                  _vm._v(
                    "You are successfully paid. \n                                    "
                  ),
                  _c("br"),
                  _vm._v(
                    "\n                                    It has been a pleasure doing business with you. We wish you the best of luck.\n                                "
                  )
                ])
              ])
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/Payment/PaymentReturnURL--orig.vue":
/*!*********************************************************!*\
  !*** ./resources/js/Payment/PaymentReturnURL--orig.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e& */ "./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e&");
/* harmony import */ var _PaymentReturnURL_orig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PaymentReturnURL--orig.vue?vue&type=script&lang=js& */ "./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PaymentReturnURL_orig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Payment/PaymentReturnURL--orig.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PaymentReturnURL_orig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./PaymentReturnURL--orig.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PaymentReturnURL_orig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e&":
/*!****************************************************************************************!*\
  !*** ./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Payment/PaymentReturnURL--orig.vue?vue&type=template&id=13b64a7e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PaymentReturnURL_orig_vue_vue_type_template_id_13b64a7e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);