(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MotorcarDetails__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MotorcarDetails */ "./resources/js/components/ProposalComponent/RequestForm/MotorcarDetails.vue");
/* harmony import */ var _UserDetails__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UserDetails */ "./resources/js/components/ProposalComponent/RequestForm/UserDetails.vue");
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


/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    MotorcarDetails: _MotorcarDetails__WEBPACK_IMPORTED_MODULE_0__["default"],
    UserDetails: _UserDetails__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mounted: function mounted() {
    this.setPersonalDetails();
  },
  data: function data() {
    var _ref;

    return {
      form: new Form((_ref = {
        // coverages: {},
        // motorcar: {},
        // personal: {},
        PlateNumber: '',
        Denomination: '',
        POAMount: '',
        YearPO: '',
        CarBrand: '',
        CarModel: '',
        BodyType: '',
        PerilsName: [],
        driver: '',
        passengers: '',
        EffectiveDate: '',
        ExpiryDate: '',
        MotorNetWeight: '',
        first_name: "",
        middle_name: "",
        last_name: ""
      }, _defineProperty(_ref, "last_name", ""), _defineProperty(_ref, "EmailAddress", ''), _defineProperty(_ref, "CustAcctNo", ''), _defineProperty(_ref, "LinesNo", ""), _defineProperty(_ref, "usages", ''), _defineProperty(_ref, "MotorAccessories", ''), _ref)),
      loading: false
    };
  },
  methods: {
    setMotorcarDetails: function setMotorcarDetails(motorcar, coverages) {
      var motorcarDetails = motorcar;
      var coveragesDetails = coverages; // this.form.motorcar = motorcar
      // this.form.coverages = coverages

      var coverage = coverages.map(function (peril) {
        return peril.PerilsNo;
      });
      this.form.PlateNumber = motorcar.platenumber, this.form.Denomination = motorcar.denomination, this.form.POAMount = motorcar.amountPurchase, this.form.YearPO = motorcar.year, this.form.CarBrand = motorcar.brand, this.form.CarModel = motorcar.model, this.form.BodyType = motorcar.bodyType, this.form.PerilsName = coverage, this.form.driver = motorcar.driver, this.form.passengers = motorcar.passengers, this.form.EffectiveDate = motorcar.effectiveDate, this.form.ExpiryDate = motorcar.expiryDate, this.form.MotorNetWeight = motorcar.netWeight, this.form.MotorAccessories = motorcar.accessories, // this.form.middle_name = "",
      // this.form.last_name = "",
      // this.form.LinesNo = "",
      // this.form.EmailAddress = "",
      this.form.usages = motorcar.usage, this.$emit('new-motorcar-details', motorcarDetails, coveragesDetails); // console.log(motorcar)
    },
    setPersonalDetails: function setPersonalDetails(personal) {
      var personalDetails = personal;
      this.form.first_name = personal.first_name;
      this.form.middle_name = personal.middle_name, this.form.last_name = personal.last_name, this.form.EmailAddress = personal.email, this.form.CustAcctNo = personal.CustAcctNo, // console.log(personalDetails)
      this.$emit('new-personal-details', personalDetails);
    },
    onSubmit: function onSubmit() {
      var _this = this;

      this.loading = true, this.form.post('api/quotation').then(function (res) {
        console.log(res); //this.$router.push("Home");

        _this.$router.push("/proposal-lists-customer");
      })["catch"](function (error) {
        //console.log(error);
        alert(error);
      });
    }
  },
  created: function created() {// this.setPersonalDetails()
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1&":
/*!*********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1& ***!
  \*********************************************************************************************************************************************************************************************************************************************/
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
    _c(
      "form",
      {
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.onSubmit()
          }
        }
      },
      [
        _c("MotorcarDetails", {
          on: { "motorcar-details": _vm.setMotorcarDetails }
        }),
        _vm._v(" "),
        _c("UserDetails", {
          attrs: { form: _vm.form },
          on: { "personal-details": _vm.setPersonalDetails }
        })
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue":
/*!********************************************************************************!*\
  !*** ./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index - Copy.vue?vue&type=template&id=76401ca1& */ "./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1&");
/* harmony import */ var _Index_Copy_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index - Copy.vue?vue&type=script&lang=js& */ "./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_Copy_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_Copy_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index - Copy.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_Copy_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1& ***!
  \***************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index - Copy.vue?vue&type=template&id=76401ca1& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProposalComponent/RequestForm/Index - Copy.vue?vue&type=template&id=76401ca1&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_Copy_vue_vue_type_template_id_76401ca1___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);