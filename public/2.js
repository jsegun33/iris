(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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

    console.log(this.surveyData); // let id = this.$route.params.id
    //console.log('mounted' + id)

    console.log('Component mounted.');
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
    axios.get("api/CustomerRequestQuotation/" + PassID).then(function (_ref3) {
      var data = _ref3.data;
      return _this.URLQueryPerilsCoveragesGroup = data;
    });
    axios.get("api/GetListBanks/").then(function (_ref4) {
      var data = _ref4.data;
      return _this.GetListBanks = data;
    });
  },
  data: function data() {
    return {
      ResultQueryRequest: {},
      URLQueryPerilsCoverages: {},
      ResultLoginDetails: {},
      ListApproverQuotation: {},
      UserDetails: {},
      GetListBanks: {},
      URLQueryPerilsCoveragesGroup: '',
      RetrieveTimeInterval: null,
      isShowing: false,
      form: new Form({
        TINNumber: '',
        EmailAddress: '',
        ContactNumber: '',
        FirstName: '',
        MiddleName: '',
        Address: '',
        Barangay: '',
        City: '',
        Denomination: '',
        RatePercent: '',
        Surcharge: '',
        CoverageAmount: '',
        TypeClass: '',
        MotorYear: '',
        MotorBrand: '',
        MotorModel: '',
        MotorType: '',
        Accessories: '',
        SelectCoverageAmounts: [],
        ProductLine: '',
        SelectPremiumAmount: [],
        TxtSelectAmount: '',
        SelectTotalPremium: [],
        OptionNo: [],
        CoveragesNameDisplay: [],
        CoveragesAmountDisplay: [],
        CoveragesPremiumDisplay: [],
        TotalAmountDue: [],
        AcceptQuotationPassData: [],
        AcceptedQuotation: [],
        TxtCoverageAmount: [],
        RemarksCustomer: [],
        QuoteExpiryStatus: '',
        CustMessage: [],
        // Additional Details
        mvFileNo: '',
        engineNo: '',
        chassisNo: '',
        color: '',
        mortgage: '',
        bankName: '',
        bankNameAddress: '',
        hardCopy: '',
        delivery: '',
        PaymentGateway: '',
        deliveryAddress: '',
        address: '',
        // 
        barangay: '',
        city: '',
        AcctNo: '',
        AcctName: '',
        AutoRenew: '',
        AssignCRD: '',
        RequestModify: [],
        FormStatusCoverages: [],
        NoAOG: '',
        OptionWithAOG: '',
        ModalDisplayWithAOG: '',
        ModalDisplayTotalAmountDue: ''
      }),
      Wordings: {}
    };
  },
  methods: {
    onChange: function onChange() {
      if (this.form.delivery == 'normalDelivery') {
        this.form.PaymentGateway = '';
      }
    },
    onChangeHardCopy: function onChangeHardCopy() {
      if (this.form.hardCopy == false) {
        this.form.delivery = '';
        this.form.PaymentGateway = '';
      }
    },
    onChangeAddress: function onChangeAddress() {
      if (this.form.deliveryAddress == 'sameAddress') {
        this.form.address = '';
        this.form.barangay = '';
        this.form.city = '';
      }
    },
    QueryByOPtion1: function QueryByOPtion1(e) {
      this.form.AcceptQuotationPassData = e.target.value.trim();
      var AmountDue = e.target.value.trim();
      var GetAmountDue = AmountDue.split(';;');
      var ModalDisplayTotalAmountDue = GetAmountDue[3].trim();
      var ModalDisplayWithAOG = parseFloat(GetAmountDue[4]) + parseFloat(GetAmountDue[5]);
      this.form.ModalDisplayWithAOG = ModalDisplayWithAOG.toFixed(2);
      this.form.ModalDisplayTotalAmountDue = GetAmountDue[3].trim(); //alert(ModalDisplayWithAOG);
    },
    QueryByOPtion: function QueryByOPtion() {
      var _this2 = this;

      //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
      //alert(e.target.value);
      var uri = window.location.href.split('?');
      var PassID = uri[1].trim();
      this.form.post('api/AcceptQuotation').then(function () {
        // Success!
        Swal.fire('Successful!', "Quotation Accepted.", 'success'); // console.log();

        _this2.$router.push('/CustAcceptedView?' + PassID);
      })["catch"](function (response) {
        alert(response);
      });
    },
    ComposeMessageCustomer: function ComposeMessageCustomer() {
      var _this3 = this;

      //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
      //alert(e.target.value);
      this.form.post('api/ComposeMessageCustomer').then(function () {
        // Success!
        //this.$router.push('Home') ;
        _this3.$router.push('/CustAcceptedView?' + PassID);
      })["catch"](function (response) {
        alert(response);
      });
    }
  },
  filters: {
    peso: function peso(amount) {
      var amt = Number(amount);
      return '₱ ' + amt.toLocaleString('ko-KR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }
  },
  created: function created() {
    var _this4 = this;

    axios.get('api/wordings').then(function (_ref5) {
      var data = _ref5.data;
      return _this4.Wordings = data;
    });
    this.RetrieveTimeInterval = setInterval(function () {
      //this.UserDetails.data.map((UserDetailss) => { 
      //});
      _this4.ResultQueryRequest.data.map(function (ResultRequestDetailss) {
        _this4.form.TINNumber = ResultRequestDetailss.TINNumber;
        _this4.form.EmailAddress = ResultRequestDetailss.EmailAddress;
        _this4.form.MotorBrand = ResultRequestDetailss.MotorBrand;
        _this4.form.ContactNumber = ResultRequestDetailss.ContactNumber;
        _this4.form.FirstName = ResultRequestDetailss.FirstName;
        _this4.form.MiddleName = ResultRequestDetailss.MiddleName;
        _this4.form.LastName = ResultRequestDetailss.LastName;
        _this4.form.Address = ResultRequestDetailss.Address;
        _this4.form.Barangay = ResultRequestDetailss.Barangay;
        _this4.form.City = ResultRequestDetailss.City;
        _this4.form.Denomination = ResultRequestDetailss.Denomination;
        _this4.form.TypeClass = ResultRequestDetailss.MotorBodyType;
        _this4.form.MotorYear = ResultRequestDetailss.MotorYear;
        _this4.form.MotorBrand = ResultRequestDetailss.MotorBrand;
        _this4.form.CoverageAmount = ResultRequestDetailss.MotorPOAmount;
        _this4.form.RatePercent = ResultRequestDetailss.RatePercent;
        _this4.form.MotorModel = ResultRequestDetailss.MotorModel;
        _this4.form.MotorType = ResultRequestDetailss.MotorBodyType;
        _this4.form.TxtPremiumAmount = ResultRequestDetailss.PremiumAmount;
        _this4.form.AmountDue = ResultRequestDetailss.AmountDue;
        _this4.form.ProductLine = ResultRequestDetailss.ProductLine;
        _this4.form.Deductible = ResultRequestDetailss.Deductable;
        _this4.form.QuoteExpiryStatus = ResultRequestDetailss.QuoteExpiryStatus;
        _this4.form.Accessories = ResultRequestDetailss.MotorWithAccessories;
        _this4.form.AcctNo = ResultRequestDetailss.CustAcctNO;
        _this4.form.AcctName = ResultRequestDetailss.FirstName + " " + ResultRequestDetailss.MiddleName + " " + ResultRequestDetailss.LastName;
        _this4.form.AssignCRD = ResultRequestDetailss.AssignCRD;
        _this4.form.NoAOG = ResultRequestDetailss.WithAOG;

        _this4.$forceUpdate();
      });

      _this4.URLQueryPerilsCoveragesGroup.map(function (URLQueryPerilsCoveragesGroups) {
        //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
        var CompCoveragesAmount = 0;
        var CompCoveragesAmountNoAOG = 0;
        var CompChargesAmount = 0;
        var CompCoverageAmount = 0;
        var DisplayText;
        URLQueryPerilsCoveragesGroups.ListCoverages.map(function (ListCoveragesURL) {
          _this4.form.RequestModify[URLQueryPerilsCoveragesGroups.OptionNo] = ListCoveragesURL.RequestModify;
          CompCoveragesAmount += parseFloat(ListCoveragesURL.CoveragesPremium);
          CompCoverageAmount += parseFloat(ListCoveragesURL.CoveragesAmount);
          _this4.form.FormStatusCoverages[URLQueryPerilsCoveragesGroups.OptionNo] = ListCoveragesURL.Status;

          if (ListCoveragesURL.Status != 3) {
            DisplayText = "New Quotation";
            _this4.isShowing = false;
          } else {
            DisplayText = " ";
            _this4.isShowing = true;
          }

          if (ListCoveragesURL.PerilsCode == "AOG") {
            CompCoveragesAmountNoAOG = parseFloat(ListCoveragesURL.CoveragesPremium);
          } else {
            CompCoveragesAmountNoAOG = CompCoveragesAmount;
          }
        });
        _this4.form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo] = DisplayText;
        _this4.form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo] = TotalPremium;
        URLQueryPerilsCoveragesGroups.ListCharges.map(function (ListChargesURL) {
          CompChargesAmount += parseFloat(ListChargesURL.ChargesPremium);
        });

        _this4.$forceUpdate();

        var TotalAmountDue = parseFloat(CompCoveragesAmount) + parseFloat(CompChargesAmount); // this.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     = parseFloat(CompCoveragesAmount).toFixed(2)

        _this4.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo] = parseFloat(CompCoveragesAmountNoAOG).toFixed(2);
        _this4.form.TotalAmountDue[URLQueryPerilsCoveragesGroups.OptionNo] = parseFloat(TotalAmountDue).toFixed(2);
      });
    }, 1000); //alert(CompCoverageAmount);

    this.RetrieveTimeInterval2 = setInterval(function () {
      clearInterval(_this4.RetrieveTimeInterval);
    }, 5000); //this.isShowingApproval = false;
  },
  computed: {
    date: function date() {
      var date = new Date();
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      return "".concat(month, " / ").concat(day, " / ").concat(year);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&":
/*!************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n#statetment {\n    overflow: visible;\n    text-align: left;\n    white-space: pre-line;\n    background: white;\n    border-style: none;\n    font-family: Arial, Helvetica, sans-serif;\n    padding: 0;\n}\n#proposalBody {\n    padding: 0px 30px 30px;\n}\n#quotehead {\n    padding: 0px 10px;\n}\ntd {\n    text-align: left;\n}\n#charges {\n    padding: 6px;\n    padding-right: 40px;\n}\n#coverage, #premium {\n    padding: 6px;\n}\n#TotalPremium {\n    -webkit-text-decoration-line: underline;\n            text-decoration-line: underline;\n    -webkit-text-decoration-style: double;\n            text-decoration-style: double;\n}\n#AmountDue {\n    -webkit-text-decoration-line: underline;\n            text-decoration-line: underline;\n    -webkit-text-decoration-style: double;\n            text-decoration-style: double;\n    padding: 6px;\n    padding-right: 40px;\n}\n.modal {\n    text-align: center;\n    padding: 0!important;\n}\n.modal:before {\n    content: '';\n    display: inline-block;\n    height: 100%;\n    vertical-align: middle;\n    margin-right: -4px;\n}\n.modal-dialog {\n    display: inline-block;\n    text-align: left;\n    vertical-align: middle;\n}\n.modal-body {\n    padding: 25px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4& ***!
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
  return _c("div", [
    _c("section", { staticClass: "content-header" }, [
      _c("h1", [
        _vm._v("\n        Quotations\n        "),
        _c("small", [_vm._v("List of Quotations Approved")]),
        _vm._v("\n        " + _vm._s(_vm.data) + "\n      ")
      ]),
      _vm._v(" "),
      _vm._m(0)
    ]),
    _vm._v(" "),
    _c("section", { staticClass: "content" }, [
      _c(
        "div",
        { staticClass: "row" },
        _vm._l(_vm.URLQueryPerilsCoveragesGroup, function(
          URLQueryPerilsCoveragesGroups
        ) {
          return _c(
            "div",
            { key: URLQueryPerilsCoveragesGroups._id, staticClass: "col-md-6" },
            [
              _c("div", { staticClass: "box box-solid" }, [
                _c(
                  "div",
                  {
                    staticClass: "box-header with-border box box-success",
                    attrs: { id: "quotehead" }
                  },
                  [
                    _c("h4", [
                      _vm._v(
                        "Quotation #:  " +
                          _vm._s(
                            URLQueryPerilsCoveragesGroups.RequestNo +
                              "-" +
                              URLQueryPerilsCoveragesGroups.OptionNo
                          )
                      )
                    ])
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "box-body", attrs: { id: "proposalBody" } },
                  [
                    _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-md-12" }, [
                        _c("h4", { staticClass: "page-header" }, [
                          _c("img", {
                            staticStyle: { height: "50px" },
                            attrs: {
                              src: "/img/rsilogo.png",
                              alt: "RSILogo",
                              id: "quoteslogo"
                            }
                          }),
                          _vm._v(" "),
                          _c("small", { staticClass: "pull-right" }, [
                            _vm._v("Date: " + _vm._s(_vm.date) + " ")
                          ])
                        ]),
                        _vm._v(" "),
                        _vm.showSecretWindow
                          ? _c("div", [
                              _c("h1", [
                                _vm._v(
                                  "This is a secret window, don't tell anyone!"
                                )
                              ])
                            ])
                          : _vm._e()
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "table-responsive" }, [
                        _c("table", { staticStyle: { width: "100%" } }, [
                          _c("tr", [
                            _c(
                              "th",
                              { staticStyle: { "text-align": "left" } },
                              [_vm._v("TO")]
                            ),
                            _vm._v(" "),
                            _c("th", [_vm._v(":")]),
                            _vm._v(" "),
                            _c("th", [_vm._v(_vm._s(_vm.form.AcctName))])
                          ]),
                          _vm._v(" "),
                          _vm._m(1, true),
                          _vm._v(" "),
                          _c("tr", [
                            _c(
                              "th",
                              { staticStyle: { "text-align": "left" } },
                              [_vm._v("FROM")]
                            ),
                            _vm._v(" "),
                            _c("th", [_vm._v(":")]),
                            _vm._v(" "),
                            _c("th", [
                              _vm._v(_vm._s(_vm.form.AssignCRD) + " "),
                              _c("br"),
                              _vm._v(" "),
                              _vm._m(2, true)
                            ])
                          ]),
                          _vm._v(" "),
                          _vm._m(3, true),
                          _vm._v(" "),
                          _c("tr", [
                            _c(
                              "th",
                              { staticStyle: { "text-align": "left" } },
                              [_vm._v("SUBJECT")]
                            ),
                            _vm._v(" "),
                            _c("th", [_vm._v(":")]),
                            _vm._v(" "),
                            _c("th", [_vm._v(_vm._s(_vm.form.AcctName))])
                          ])
                        ])
                      ])
                    ]),
                    _c("br"),
                    _vm._v(" "),
                    _vm._m(4, true),
                    _vm._v(" "),
                    _c("div", { staticClass: "row" }, [
                      _c(
                        "div",
                        { staticClass: "col-md-12 text-center" },
                        _vm._l(_vm.ResultQueryRequest.data, function(
                          ResultQueryRequests
                        ) {
                          return _c("p", { key: ResultQueryRequests._id }, [
                            _c("strong", [
                              _vm._v(
                                "\n                                        " +
                                  _vm._s(ResultQueryRequests.SubLinesName) +
                                  ": " +
                                  _vm._s(ResultQueryRequests.MotorYear) +
                                  " " +
                                  _vm._s(ResultQueryRequests.MotorBrand) +
                                  "  " +
                                  _vm._s(ResultQueryRequests.MotorModel) +
                                  "  " +
                                  _vm._s(ResultQueryRequests.MotorBodyType) +
                                  "\n                                   \n                                    "
                              )
                            ])
                          ])
                        }),
                        0
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "h3",
                      {
                        staticStyle: { "text-align": "center", color: "blue" }
                      },
                      [
                        _vm._v(
                          _vm._s(
                            _vm.form.AcceptedQuotation[
                              URLQueryPerilsCoveragesGroups.OptionNo
                            ]
                          )
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c("strong", [_vm._v(" Rate :  ")]),
                    _vm._v(
                      "  " +
                        _vm._s(
                          URLQueryPerilsCoveragesGroups.CoverageRates + "%"
                        ) +
                        " \n                          "
                    ),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value:
                            _vm.form.TxtCoverageAmount[
                              URLQueryPerilsCoveragesGroups.OptionNo
                            ],
                          expression:
                            "form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]"
                        }
                      ],
                      staticClass: "form-control input-sm text-center",
                      attrs: { type: "hidden", readonly: "" },
                      domProps: {
                        value:
                          _vm.form.TxtCoverageAmount[
                            URLQueryPerilsCoveragesGroups.OptionNo
                          ]
                      },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.form.TxtCoverageAmount,
                            URLQueryPerilsCoveragesGroups.OptionNo,
                            $event.target.value
                          )
                        }
                      }
                    }),
                    _vm._v(" "),
                    URLQueryPerilsCoveragesGroups.StatusCovetages === 3 ||
                    URLQueryPerilsCoveragesGroups.StatusCovetage === 4
                      ? _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "table-responsive" }, [
                              _c("table", { staticStyle: { width: "100%" } }, [
                                _c("tr", [
                                  _c(
                                    "th",
                                    {
                                      staticStyle: {
                                        border: "1px solid black",
                                        "border-left": "transparent",
                                        "border-top": "transparent",
                                        "border-right": "transparent"
                                      }
                                    },
                                    [_vm._v("Perils Name")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "th",
                                    {
                                      staticStyle: {
                                        border: "1px solid black",
                                        "border-left": "transparent",
                                        "border-top": "transparent",
                                        "border-right": "transparent"
                                      }
                                    },
                                    [_vm._v("Coverages")]
                                  ),
                                  _vm._v(" "),
                                  _vm.form.NoAOG === "YES"
                                    ? _c(
                                        "th",
                                        {
                                          staticStyle: {
                                            "text-align": "right",
                                            border: "1px solid black",
                                            "border-left": "transparent",
                                            "border-top": "transparent",
                                            "border-right": "transparent"
                                          }
                                        },
                                        [
                                          _vm._v("W /o AOG "),
                                          _c("br"),
                                          _vm._v("Premium")
                                        ]
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _vm._m(5, true)
                                ]),
                                _vm._v(" "),
                                _c(
                                  "tbody",
                                  [
                                    _vm._l(
                                      URLQueryPerilsCoveragesGroups.ListCoverages,
                                      function(coverage) {
                                        return _c("tr", { key: coverage._id }, [
                                          _c("td", [
                                            _vm._v(
                                              _vm._s(coverage.PerilsName) + " "
                                            )
                                          ]),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              staticStyle: {
                                                "text-align": "right"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  _vm._f("Peso")(
                                                    coverage.CoveragesAmount
                                                  )
                                                )
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          coverage.PerilsCode === "AOG" &&
                                          _vm.form.NoAOG === "YES"
                                            ? _c(
                                                "td",
                                                {
                                                  staticStyle: {
                                                    "text-align": "right"
                                                  }
                                                },
                                                [_vm._v(" NONE ")]
                                              )
                                            : _vm._e(),
                                          _vm._v(" "),
                                          coverage.PerilsCode != "AOG" &&
                                          _vm.form.NoAOG === "YES"
                                            ? _c(
                                                "td",
                                                {
                                                  staticStyle: {
                                                    "text-align": "right"
                                                  }
                                                },
                                                [
                                                  _vm._v(
                                                    _vm._s(
                                                      _vm._f("Peso")(
                                                        coverage.CoveragesPremium
                                                      )
                                                    )
                                                  )
                                                ]
                                              )
                                            : _vm._e(),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              staticStyle: {
                                                "text-align": "right"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  _vm._f("Peso")(
                                                    coverage.CoveragesPremium
                                                  )
                                                )
                                              )
                                            ]
                                          )
                                        ])
                                      }
                                    ),
                                    _vm._v(" "),
                                    _c("tr", [
                                      _c("td"),
                                      _vm._v(" "),
                                      _c(
                                        "th",
                                        {
                                          staticStyle: {
                                            "text-align": "right",
                                            "font-style": "italic"
                                          }
                                        },
                                        [_vm._v("Total Premium ")]
                                      ),
                                      _vm._v(" "),
                                      _vm.form.NoAOG === "YES"
                                        ? _c(
                                            "td",
                                            {
                                              staticStyle: {
                                                "text-align": "right",
                                                "text-decoration-line":
                                                  "overline",
                                                "text-decoration-style":
                                                  "double",
                                                "font-style": "italic"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  _vm._f("Peso")(
                                                    URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal
                                                  )
                                                ) + " "
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _c(
                                        "td",
                                        {
                                          staticStyle: {
                                            "text-align": "right",
                                            "text-decoration-line": "overline",
                                            "text-decoration-style": "double",
                                            "font-style": "italic"
                                          }
                                        },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm._f("Peso")(
                                                URLQueryPerilsCoveragesGroups.TotalPremium
                                              )
                                            ) + " "
                                          )
                                        ]
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _vm._l(
                                      URLQueryPerilsCoveragesGroups.ListCharges,
                                      function(Charges) {
                                        return _c("tr", { key: Charges._id }, [
                                          _c("th"),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              staticStyle: {
                                                "text-align": "right"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(Charges.ChargesName)
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _vm.form.NoAOG === "YES"
                                            ? _c(
                                                "td",
                                                {
                                                  staticStyle: {
                                                    "text-align": "right"
                                                  }
                                                },
                                                [
                                                  _vm._v(
                                                    _vm._s(
                                                      _vm._f("Peso")(
                                                        Charges.ChargesPremiumAOG
                                                      )
                                                    )
                                                  )
                                                ]
                                              )
                                            : _vm._e(),
                                          _vm._v(" "),
                                          _c(
                                            "td",
                                            {
                                              staticStyle: {
                                                "text-align": "right"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  _vm._f("Peso")(
                                                    Charges.ChargesPremium
                                                  )
                                                )
                                              )
                                            ]
                                          )
                                        ])
                                      }
                                    ),
                                    _vm._v(" "),
                                    _c("tr", [
                                      _c("th"),
                                      _vm._v(" "),
                                      _c(
                                        "th",
                                        {
                                          staticStyle: { "text-align": "right" }
                                        },
                                        [_vm._v("TOTAL AMOUNT")]
                                      ),
                                      _vm._v(" "),
                                      _vm.form.NoAOG === "YES"
                                        ? _c(
                                            "th",
                                            {
                                              staticStyle: {
                                                "text-align": "right",
                                                "text-decoration-line":
                                                  "underline",
                                                "text-decoration-style":
                                                  "double",
                                                "font-style": "italic"
                                              }
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  _vm._f("Peso")(
                                                    parseFloat(
                                                      URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal
                                                    ) +
                                                      parseFloat(
                                                        URLQueryPerilsCoveragesGroups.TotalChargesAOG
                                                      )
                                                  )
                                                )
                                              )
                                            ]
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _c(
                                        "th",
                                        {
                                          staticStyle: {
                                            "text-align": "right",
                                            "text-decoration-line": "underline",
                                            "text-decoration-style": "double",
                                            "font-style": "italic"
                                          }
                                        },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm._f("Peso")(
                                                parseFloat(
                                                  URLQueryPerilsCoveragesGroups.TotalAmountDue
                                                )
                                              )
                                            )
                                          )
                                        ]
                                      )
                                    ]),
                                    _vm._v(" "),
                                    _vm._m(6, true),
                                    _vm._v(" "),
                                    _c("tr", [
                                      _c("th"),
                                      _vm._v(" "),
                                      _c(
                                        "th",
                                        {
                                          staticStyle: { "text-align": "right" }
                                        },
                                        [_vm._v("Deductible : ")]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "th",
                                        {
                                          staticStyle: { "text-align": "left" }
                                        },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm._f("Peso")(
                                                " " +
                                                  URLQueryPerilsCoveragesGroups.Deductible
                                              )
                                            )
                                          )
                                        ]
                                      )
                                    ])
                                  ],
                                  2
                                )
                              ])
                            ])
                          ])
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-md-12" }, [
                        _c("pre", { attrs: { id: "statetment" } }, [
                          _vm._v(" "),
                          _c("br"),
                          _vm._v(
                            "\n                                " +
                              _vm._s(_vm.Wordings.Statement) +
                              "\n                            "
                          )
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "form",
                      {
                        on: {
                          submit: function($event) {
                            $event.preventDefault()
                          }
                        }
                      },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.AcceptQuotationPassData,
                              expression: "form.AcceptQuotationPassData"
                            }
                          ],
                          attrs: { type: "hidden" },
                          domProps: { value: _vm.form.AcceptQuotationPassData },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "AcceptQuotationPassData",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.Accessories,
                              expression: "form.Accessories"
                            }
                          ],
                          attrs: { type: "hidden" },
                          domProps: { value: _vm.form.Accessories },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "Accessories",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        (_vm.form.QuoteExpiryStatus == 1 ||
                          _vm.form.QuoteExpiryStatus == 3) &&
                        URLQueryPerilsCoveragesGroups.StatusCovetages === 3
                          ? _c("div", { staticClass: "row text-center" }, [
                              _c("div", { staticClass: "col-md-12" }, [
                                _c("div", { staticClass: "form-group" }, [
                                  _c(
                                    "label",
                                    { attrs: { for: "accessories" } },
                                    [_vm._v("Remarks : ")]
                                  ),
                                  _vm._v(" "),
                                  _c("textarea", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value:
                                          _vm.form.RemarksCustomer[
                                            URLQueryPerilsCoveragesGroups
                                              .OptionNo
                                          ],
                                        expression:
                                          "form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo]"
                                      }
                                    ],
                                    staticClass: "form-control",
                                    attrs: { type: "text" },
                                    domProps: {
                                      value:
                                        _vm.form.RemarksCustomer[
                                          URLQueryPerilsCoveragesGroups.OptionNo
                                        ]
                                    },
                                    on: {
                                      input: function($event) {
                                        if ($event.target.composing) {
                                          return
                                        }
                                        _vm.$set(
                                          _vm.form.RemarksCustomer,
                                          URLQueryPerilsCoveragesGroups.OptionNo,
                                          $event.target.value
                                        )
                                      }
                                    }
                                  })
                                ])
                              ])
                            ])
                          : _vm._e(),
                        _vm._v(" "),
                        (_vm.form.QuoteExpiryStatus === 1 ||
                          _vm.form.QuoteExpiryStatus === 3) &&
                        URLQueryPerilsCoveragesGroups.StatusCovetages === 3
                          ? _c("div", { staticClass: "row text-center" }, [
                              _c(
                                "button",
                                {
                                  staticClass: "btn btn-lg btn-success",
                                  attrs: {
                                    type: "button",
                                    value:
                                      URLQueryPerilsCoveragesGroups.OptionNo +
                                      ";;" +
                                      URLQueryPerilsCoveragesGroups.RequestNo +
                                      ";;" +
                                      _vm.form.RemarksCustomer[
                                        URLQueryPerilsCoveragesGroups.OptionNo
                                      ] +
                                      ";;" +
                                      URLQueryPerilsCoveragesGroups.TotalAmountDue +
                                      ";;" +
                                      URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal +
                                      ";;" +
                                      URLQueryPerilsCoveragesGroups.TotalChargesAOG,
                                    "data-toggle": "modal",
                                    "data-target": "#acceptModal"
                                  },
                                  on: {
                                    mouseover: function($event) {
                                      return _vm.QueryByOPtion1($event)
                                    }
                                  }
                                },
                                [
                                  _vm._v(
                                    "\n                                    Accept  \n                                "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("br"),
                              _vm._v(" "),
                              _c(
                                "a",
                                {
                                  staticClass: "text-red",
                                  staticStyle: {
                                    "text-decoration": "underline"
                                  },
                                  attrs: { href: "#" }
                                },
                                [_vm._v("Decline")]
                              )
                            ])
                          : _vm._e(),
                        _vm._v(" "),
                        _vm.form.QuoteExpiryStatus == 2
                          ? _c(
                              "div",
                              {
                                directives: [
                                  {
                                    name: "show",
                                    rawName: "v-show",
                                    value: _vm.isShowing,
                                    expression: "isShowing"
                                  }
                                ],
                                staticClass: "row text-center"
                              },
                              [
                                _c("div", { staticClass: "col-md-10" }, [
                                  _c("div", { staticClass: "form-group" }, [
                                    _c(
                                      "label",
                                      { attrs: { for: "accessories" } },
                                      [_vm._v("Send Messages")]
                                    ),
                                    _vm._v(" "),
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value:
                                            _vm.form.CustMessage[
                                              URLQueryPerilsCoveragesGroups
                                                .OptionNo
                                            ],
                                          expression:
                                            "form.CustMessage[URLQueryPerilsCoveragesGroups.OptionNo]"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      attrs: { type: "text" },
                                      domProps: {
                                        value:
                                          _vm.form.CustMessage[
                                            URLQueryPerilsCoveragesGroups
                                              .OptionNo
                                          ]
                                      },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            _vm.form.CustMessage,
                                            URLQueryPerilsCoveragesGroups.OptionNo,
                                            $event.target.value
                                          )
                                        }
                                      }
                                    })
                                  ])
                                ]),
                                _vm._v(" "),
                                _c(
                                  "button",
                                  {
                                    staticClass: "btn btn-lg btn-success",
                                    attrs: {
                                      type: "button",
                                      value:
                                        URLQueryPerilsCoveragesGroups.OptionNo +
                                        ";;" +
                                        URLQueryPerilsCoveragesGroups.RequestNo +
                                        ";;" +
                                        _vm.form.CustMessage[
                                          URLQueryPerilsCoveragesGroups.OptionNo
                                        ]
                                    },
                                    on: {
                                      click: function($event) {
                                        return _vm.ComposeMessageCustomer()
                                      },
                                      mouseover: function($event) {
                                        return _vm.QueryByOPtion1($event)
                                      }
                                    }
                                  },
                                  [_vm._v(" Submit    ")]
                                ),
                                _c("br"),
                                _vm._v(" "),
                                _c(
                                  "a",
                                  {
                                    staticClass: "text-red",
                                    staticStyle: {
                                      "text-decoration": "underline"
                                    }
                                  },
                                  [_vm._v("Decline")]
                                )
                              ]
                            )
                          : _vm._e()
                      ]
                    )
                  ]
                )
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "modal fade", attrs: { id: "acceptModal" } },
                [
                  _c("div", { staticClass: "modal-dialog" }, [
                    _c("div", { staticClass: "modal-content" }, [
                      _vm._m(7, true),
                      _vm._v(" "),
                      _c("div", { staticClass: "modal-body" }, [
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "col-md-11" }, [
                              _c("div", { staticClass: "form-group" }, [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.OptionWithAOG,
                                      expression: "form.OptionWithAOG"
                                    }
                                  ],
                                  attrs: {
                                    type: "radio",
                                    id: "ds",
                                    value: "YES"
                                  },
                                  domProps: {
                                    checked: _vm._q(
                                      _vm.form.OptionWithAOG,
                                      "YES"
                                    )
                                  },
                                  on: {
                                    change: function($event) {
                                      return _vm.$set(
                                        _vm.form,
                                        "OptionWithAOG",
                                        "YES"
                                      )
                                    }
                                  }
                                }),
                                _vm._v(" "),
                                _c(
                                  "label",
                                  { attrs: { for: "sameAddress1" } },
                                  [_vm._v("With Acts of Nature\t")]
                                ),
                                _c("br"),
                                _vm._v(" "),
                                _c("small", [
                                  _vm._v(
                                    "(if selected,Your Policy Total Amount Due: " +
                                      _vm._s(
                                        _vm._f("Peso")(
                                          _vm.form.ModalDisplayTotalAmountDue
                                        )
                                      ) +
                                      ")"
                                  )
                                ]),
                                _vm._v(" "),
                                _c("br"),
                                _vm._v(" "),
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.OptionWithAOG,
                                      expression: "form.OptionWithAOG"
                                    }
                                  ],
                                  attrs: {
                                    type: "radio",
                                    id: "dsd",
                                    value: "NO"
                                  },
                                  domProps: {
                                    checked: _vm._q(
                                      _vm.form.OptionWithAOG,
                                      "NO"
                                    )
                                  },
                                  on: {
                                    change: function($event) {
                                      return _vm.$set(
                                        _vm.form,
                                        "OptionWithAOG",
                                        "NO"
                                      )
                                    }
                                  }
                                }),
                                _vm._v(" "),
                                _c(
                                  "label",
                                  { attrs: { for: "differentAddress1" } },
                                  [_vm._v("Without Acts of Nature")]
                                ),
                                _vm._v(" "),
                                _c("br"),
                                _vm._v(" "),
                                _c("small", [
                                  _vm._v(
                                    "(if selected,Your Policy Total Amount Due: " +
                                      _vm._s(
                                        _vm._f("Peso")(
                                          _vm.form.ModalDisplayWithAOG
                                        )
                                      ) +
                                      " )"
                                  )
                                ])
                              ])
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "form-group" }, [
                            _vm._m(8, true),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-4" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.mvFileNo,
                                    expression: "form.mvFileNo"
                                  }
                                ],
                                staticClass: "form-control input-sm",
                                attrs: {
                                  type: "text",
                                  placeholder: "Enter MV File No."
                                },
                                domProps: { value: _vm.form.mvFileNo },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.form,
                                      "mvFileNo",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }, [
                              !_vm.form.mvFileNo
                                ? _c(
                                    "span",
                                    {
                                      staticClass: "label",
                                      staticStyle: {
                                        color: "red",
                                        padding: "0px"
                                      }
                                    },
                                    [_vm._v("*")]
                                  )
                                : _vm._e()
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "form-group" }, [
                            _vm._m(9, true),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-4" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.engineNo,
                                    expression: "form.engineNo"
                                  }
                                ],
                                staticClass: "form-control input-sm",
                                attrs: {
                                  type: "text",
                                  placeholder: "Enter Engine No."
                                },
                                domProps: { value: _vm.form.engineNo },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.form,
                                      "engineNo",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }, [
                              !_vm.form.engineNo
                                ? _c(
                                    "span",
                                    {
                                      staticClass: "label",
                                      staticStyle: {
                                        color: "red",
                                        padding: "0px"
                                      }
                                    },
                                    [_vm._v("*")]
                                  )
                                : _vm._e()
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "form-group" }, [
                            _vm._m(10, true),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-4" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.chassisNo,
                                    expression: "form.chassisNo"
                                  }
                                ],
                                staticClass: "form-control input-sm",
                                attrs: {
                                  type: "text",
                                  placeholder: "Enter Chassis No."
                                },
                                domProps: { value: _vm.form.chassisNo },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.form,
                                      "chassisNo",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }, [
                              !_vm.form.chassisNo
                                ? _c(
                                    "span",
                                    {
                                      staticClass: "label",
                                      staticStyle: {
                                        color: "red",
                                        padding: "0px"
                                      }
                                    },
                                    [_vm._v("*")]
                                  )
                                : _vm._e()
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "form-group" }, [
                            _vm._m(11, true),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-4" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.color,
                                    expression: "form.color"
                                  }
                                ],
                                staticClass: "form-control input-sm",
                                attrs: {
                                  type: "text",
                                  placeholder: "Enter Car Color"
                                },
                                domProps: { value: _vm.form.color },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.form,
                                      "color",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }, [
                              !_vm.form.color
                                ? _c(
                                    "span",
                                    {
                                      staticClass: "label",
                                      staticStyle: {
                                        color: "red",
                                        padding: "0px"
                                      }
                                    },
                                    [_vm._v("*")]
                                  )
                                : _vm._e()
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-4" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.mortgage,
                                    expression: "form.mortgage"
                                  }
                                ],
                                attrs: { type: "checkbox", id: "mortgaged" },
                                domProps: {
                                  checked: Array.isArray(_vm.form.mortgage)
                                    ? _vm._i(_vm.form.mortgage, null) > -1
                                    : _vm.form.mortgage
                                },
                                on: {
                                  change: function($event) {
                                    var $$a = _vm.form.mortgage,
                                      $$el = $event.target,
                                      $$c = $$el.checked ? true : false
                                    if (Array.isArray($$a)) {
                                      var $$v = null,
                                        $$i = _vm._i($$a, $$v)
                                      if ($$el.checked) {
                                        $$i < 0 &&
                                          _vm.$set(
                                            _vm.form,
                                            "mortgage",
                                            $$a.concat([$$v])
                                          )
                                      } else {
                                        $$i > -1 &&
                                          _vm.$set(
                                            _vm.form,
                                            "mortgage",
                                            $$a
                                              .slice(0, $$i)
                                              .concat($$a.slice($$i + 1))
                                          )
                                      }
                                    } else {
                                      _vm.$set(_vm.form, "mortgage", $$c)
                                    }
                                  }
                                }
                              }),
                              _vm._v(" "),
                              _c("label", { attrs: { for: "mortgaged" } }, [
                                _vm._v("Mortgaged?")
                              ])
                            ])
                          ]),
                          _vm._v(" "),
                          _c("div", { staticClass: "col-md-4" }, [
                            _c(
                              "select",
                              {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.bankName,
                                    expression: "form.bankName"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  disabled: !_vm.form.mortgage,
                                  required: ""
                                },
                                on: {
                                  change: function($event) {
                                    var $$selectedVal = Array.prototype.filter
                                      .call($event.target.options, function(o) {
                                        return o.selected
                                      })
                                      .map(function(o) {
                                        var val =
                                          "_value" in o ? o._value : o.value
                                        return val
                                      })
                                    _vm.$set(
                                      _vm.form,
                                      "bankName",
                                      $event.target.multiple
                                        ? $$selectedVal
                                        : $$selectedVal[0]
                                    )
                                  }
                                }
                              },
                              [
                                _c(
                                  "option",
                                  {
                                    attrs: {
                                      value: "",
                                      selected: "",
                                      disabled: ""
                                    }
                                  },
                                  [_vm._v("Select Banks")]
                                ),
                                _vm._v(" "),
                                _vm._l(_vm.GetListBanks, function(
                                  GetListBankss
                                ) {
                                  return _c(
                                    "option",
                                    {
                                      key: GetListBankss._id,
                                      domProps: {
                                        value: GetListBankss.BankName
                                      }
                                    },
                                    [_vm._v(_vm._s(GetListBankss.BankName))]
                                  )
                                })
                              ],
                              2
                            ),
                            _vm._v(" "),
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.bankNameAddress,
                                  expression: "form.bankNameAddress"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: {
                                type: "text",
                                readonly: !_vm.form.mortgage,
                                placeholder: "Enter Mortgage"
                              },
                              domProps: { value: _vm.form.bankNameAddress },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "bankNameAddress",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ]),
                          _vm._v(" "),
                          !_vm.form.bankName
                            ? _c("div", { staticClass: "col-md-1" }, [
                                _c(
                                  "span",
                                  {
                                    staticClass: "label",
                                    staticStyle: {
                                      color: "red",
                                      padding: "0px"
                                    }
                                  },
                                  [_vm._v("*")]
                                )
                              ])
                            : _vm._e()
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.hardCopy,
                                    expression: "form.hardCopy"
                                  }
                                ],
                                attrs: { type: "checkbox", id: "Hardcopy" },
                                domProps: {
                                  checked: Array.isArray(_vm.form.hardCopy)
                                    ? _vm._i(_vm.form.hardCopy, null) > -1
                                    : _vm.form.hardCopy
                                },
                                on: {
                                  change: [
                                    function($event) {
                                      var $$a = _vm.form.hardCopy,
                                        $$el = $event.target,
                                        $$c = $$el.checked ? true : false
                                      if (Array.isArray($$a)) {
                                        var $$v = null,
                                          $$i = _vm._i($$a, $$v)
                                        if ($$el.checked) {
                                          $$i < 0 &&
                                            _vm.$set(
                                              _vm.form,
                                              "hardCopy",
                                              $$a.concat([$$v])
                                            )
                                        } else {
                                          $$i > -1 &&
                                            _vm.$set(
                                              _vm.form,
                                              "hardCopy",
                                              $$a
                                                .slice(0, $$i)
                                                .concat($$a.slice($$i + 1))
                                            )
                                        }
                                      } else {
                                        _vm.$set(_vm.form, "hardCopy", $$c)
                                      }
                                    },
                                    _vm.onChangeHardCopy
                                  ]
                                }
                              }),
                              _vm._v(" "),
                              _c("label", { attrs: { for: "Hardcopy" } }, [
                                _vm._v("Required Hardcopy?")
                              ])
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }),
                            _vm._v(" "),
                            _vm.form.hardCopy
                              ? _c(
                                  "div",
                                  {
                                    staticClass: "col-md-10",
                                    staticStyle: { padding: "0px" }
                                  },
                                  [
                                    _c("div", { staticClass: "form-group" }, [
                                      _c("input", {
                                        directives: [
                                          {
                                            name: "model",
                                            rawName: "v-model",
                                            value: _vm.form.delivery,
                                            expression: "form.delivery"
                                          }
                                        ],
                                        attrs: {
                                          type: "radio",
                                          id: "normalDelivery",
                                          value: "normalDelivery"
                                        },
                                        domProps: {
                                          checked: _vm._q(
                                            _vm.form.delivery,
                                            "normalDelivery"
                                          )
                                        },
                                        on: {
                                          change: [
                                            function($event) {
                                              return _vm.$set(
                                                _vm.form,
                                                "delivery",
                                                "normalDelivery"
                                              )
                                            },
                                            _vm.onChange
                                          ]
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "label",
                                        {
                                          staticStyle: { margin: "0px" },
                                          attrs: { for: "normalDelivery" }
                                        },
                                        [_vm._v("Normal Delivery")]
                                      ),
                                      _vm._v(" "),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c("small", [
                                        _vm._v(
                                          "(Usually 3 to 25 business days)"
                                        )
                                      ]),
                                      _vm._v(" "),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c("input", {
                                        directives: [
                                          {
                                            name: "model",
                                            rawName: "v-model",
                                            value: _vm.form.delivery,
                                            expression: "form.delivery"
                                          }
                                        ],
                                        attrs: {
                                          type: "radio",
                                          id: "rushDelivery",
                                          value: "rushDelivery"
                                        },
                                        domProps: {
                                          checked: _vm._q(
                                            _vm.form.delivery,
                                            "rushDelivery"
                                          )
                                        },
                                        on: {
                                          change: [
                                            function($event) {
                                              return _vm.$set(
                                                _vm.form,
                                                "delivery",
                                                "rushDelivery"
                                              )
                                            },
                                            _vm.onChange
                                          ]
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "label",
                                        {
                                          staticStyle: { margin: "0px" },
                                          attrs: { for: "rushDelivery" }
                                        },
                                        [_vm._v("Rush (Metro Manila Only)")]
                                      ),
                                      _vm._v(" "),
                                      _c("br"),
                                      _vm._v(" "),
                                      _c("small", [
                                        _vm._v(
                                          "(Usually 1 to 2 business days and will require payment of Php 250.00)"
                                        )
                                      ])
                                    ]),
                                    _vm._v(" "),
                                    _vm.form.delivery == "rushDelivery"
                                      ? _c(
                                          "div",
                                          { staticClass: "col-md-12" },
                                          [
                                            _c(
                                              "div",
                                              { staticClass: "col-md-4" },
                                              [
                                                _c(
                                                  "div",
                                                  { staticClass: "form-group" },
                                                  [
                                                    _c("input", {
                                                      directives: [
                                                        {
                                                          name: "model",
                                                          rawName: "v-model",
                                                          value:
                                                            _vm.form
                                                              .PaymentGateway,
                                                          expression:
                                                            "form.PaymentGateway"
                                                        }
                                                      ],
                                                      attrs: {
                                                        type: "radio",
                                                        id: "GCash",
                                                        value: "GCash"
                                                      },
                                                      domProps: {
                                                        checked: _vm._q(
                                                          _vm.form
                                                            .PaymentGateway,
                                                          "GCash"
                                                        )
                                                      },
                                                      on: {
                                                        change: function(
                                                          $event
                                                        ) {
                                                          return _vm.$set(
                                                            _vm.form,
                                                            "PaymentGateway",
                                                            "GCash"
                                                          )
                                                        }
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "label",
                                                      {
                                                        staticStyle: {
                                                          margin: "0px"
                                                        },
                                                        attrs: { for: "GCash" }
                                                      },
                                                      [_vm._v("GCASH")]
                                                    )
                                                  ]
                                                )
                                              ]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              { staticClass: "col-md-4" },
                                              [
                                                _c(
                                                  "div",
                                                  { staticClass: "form-group" },
                                                  [
                                                    _c("input", {
                                                      directives: [
                                                        {
                                                          name: "model",
                                                          rawName: "v-model",
                                                          value:
                                                            _vm.form
                                                              .PaymentGateway,
                                                          expression:
                                                            "form.PaymentGateway"
                                                        }
                                                      ],
                                                      attrs: {
                                                        type: "radio",
                                                        id: "PayMaya",
                                                        value: "PayMaya"
                                                      },
                                                      domProps: {
                                                        checked: _vm._q(
                                                          _vm.form
                                                            .PaymentGateway,
                                                          "PayMaya"
                                                        )
                                                      },
                                                      on: {
                                                        change: function(
                                                          $event
                                                        ) {
                                                          return _vm.$set(
                                                            _vm.form,
                                                            "PaymentGateway",
                                                            "PayMaya"
                                                          )
                                                        }
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "label",
                                                      {
                                                        staticStyle: {
                                                          margin: "0px"
                                                        },
                                                        attrs: {
                                                          for: "PayMaya"
                                                        }
                                                      },
                                                      [_vm._v("PayMaya")]
                                                    )
                                                  ]
                                                )
                                              ]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              { staticClass: "col-md-4" },
                                              [
                                                _c(
                                                  "div",
                                                  { staticClass: "form-group" },
                                                  [
                                                    _c("input", {
                                                      directives: [
                                                        {
                                                          name: "model",
                                                          rawName: "v-model",
                                                          value:
                                                            _vm.form
                                                              .PaymentGateway,
                                                          expression:
                                                            "form.PaymentGateway"
                                                        }
                                                      ],
                                                      attrs: {
                                                        type: "radio",
                                                        id: "DragonPay",
                                                        value: "DragonPay"
                                                      },
                                                      domProps: {
                                                        checked: _vm._q(
                                                          _vm.form
                                                            .PaymentGateway,
                                                          "DragonPay"
                                                        )
                                                      },
                                                      on: {
                                                        change: function(
                                                          $event
                                                        ) {
                                                          return _vm.$set(
                                                            _vm.form,
                                                            "PaymentGateway",
                                                            "DragonPay"
                                                          )
                                                        }
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "label",
                                                      {
                                                        staticStyle: {
                                                          margin: "0px"
                                                        },
                                                        attrs: {
                                                          for: "DragonPay"
                                                        }
                                                      },
                                                      [_vm._v("DragonPay")]
                                                    )
                                                  ]
                                                )
                                              ]
                                            )
                                          ]
                                        )
                                      : _vm._e()
                                  ]
                                )
                              : _vm._e()
                          ])
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "row" }, [
                          _c("div", { staticClass: "col-md-12" }, [
                            _vm._m(12, true),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-1" }),
                            _vm._v(" "),
                            _c("div", { staticClass: "col-md-11" }, [
                              _c("div", { staticClass: "form-group" }, [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.deliveryAddress,
                                      expression: "form.deliveryAddress"
                                    }
                                  ],
                                  attrs: {
                                    type: "radio",
                                    id: "sameAddress",
                                    value: "sameAddress"
                                  },
                                  domProps: {
                                    checked: _vm._q(
                                      _vm.form.deliveryAddress,
                                      "sameAddress"
                                    )
                                  },
                                  on: {
                                    change: [
                                      function($event) {
                                        return _vm.$set(
                                          _vm.form,
                                          "deliveryAddress",
                                          "sameAddress"
                                        )
                                      },
                                      _vm.onChangeAddress
                                    ]
                                  }
                                }),
                                _vm._v(" "),
                                _c("label", { attrs: { for: "sameAddress" } }, [
                                  _vm._v("Same Address")
                                ]),
                                _vm._v(" "),
                                _c("br"),
                                _vm._v(" "),
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.deliveryAddress,
                                      expression: "form.deliveryAddress"
                                    }
                                  ],
                                  attrs: {
                                    type: "radio",
                                    id: "differentAddress",
                                    value: "differentAddress"
                                  },
                                  domProps: {
                                    checked: _vm._q(
                                      _vm.form.deliveryAddress,
                                      "differentAddress"
                                    )
                                  },
                                  on: {
                                    change: [
                                      function($event) {
                                        return _vm.$set(
                                          _vm.form,
                                          "deliveryAddress",
                                          "differentAddress"
                                        )
                                      },
                                      _vm.onChangeAddress
                                    ]
                                  }
                                }),
                                _vm._v(" "),
                                _c(
                                  "label",
                                  { attrs: { for: "differentAddress" } },
                                  [_vm._v("Different Address")]
                                ),
                                _vm._v(" "),
                                _c("br"),
                                _vm._v(" "),
                                _vm.form.deliveryAddress == "differentAddress"
                                  ? _c(
                                      "div",
                                      {
                                        staticClass: "col-md-5",
                                        staticStyle: { padding: "0px 2px" }
                                      },
                                      [
                                        _c("input", {
                                          directives: [
                                            {
                                              name: "model",
                                              rawName: "v-model",
                                              value: _vm.form.address,
                                              expression: "form.address"
                                            }
                                          ],
                                          staticClass: "form-control input-sm",
                                          attrs: {
                                            type: "text",
                                            id: "",
                                            placeholder: "Address"
                                          },
                                          domProps: { value: _vm.form.address },
                                          on: {
                                            input: function($event) {
                                              if ($event.target.composing) {
                                                return
                                              }
                                              _vm.$set(
                                                _vm.form,
                                                "address",
                                                $event.target.value
                                              )
                                            }
                                          }
                                        })
                                      ]
                                    )
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.form.deliveryAddress == "differentAddress"
                                  ? _c(
                                      "div",
                                      {
                                        staticClass: "col-md-3",
                                        staticStyle: { padding: "0px 2px" }
                                      },
                                      [
                                        _c(
                                          "select",
                                          {
                                            directives: [
                                              {
                                                name: "model",
                                                rawName: "v-model",
                                                value: _vm.form.barangay,
                                                expression: "form.barangay"
                                              }
                                            ],
                                            staticClass:
                                              "form-control input-sm",
                                            attrs: { id: "" },
                                            on: {
                                              change: function($event) {
                                                var $$selectedVal = Array.prototype.filter
                                                  .call(
                                                    $event.target.options,
                                                    function(o) {
                                                      return o.selected
                                                    }
                                                  )
                                                  .map(function(o) {
                                                    var val =
                                                      "_value" in o
                                                        ? o._value
                                                        : o.value
                                                    return val
                                                  })
                                                _vm.$set(
                                                  _vm.form,
                                                  "barangay",
                                                  $event.target.multiple
                                                    ? $$selectedVal
                                                    : $$selectedVal[0]
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c(
                                              "option",
                                              {
                                                attrs: {
                                                  value: "",
                                                  selected: "",
                                                  disabled: ""
                                                }
                                              },
                                              [_vm._v("Select Barangay")]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "option",
                                              {
                                                attrs: {
                                                  value: "Barangay San Antonio"
                                                }
                                              },
                                              [_vm._v("Barangay San Antonio")]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  : _vm._e(),
                                _vm._v(" "),
                                _vm.form.deliveryAddress == "differentAddress"
                                  ? _c(
                                      "div",
                                      {
                                        staticClass: "col-md-3",
                                        staticStyle: { padding: "0px 2px" }
                                      },
                                      [
                                        _c(
                                          "select",
                                          {
                                            directives: [
                                              {
                                                name: "model",
                                                rawName: "v-model",
                                                value: _vm.form.city,
                                                expression: "form.city"
                                              }
                                            ],
                                            staticClass:
                                              "form-control input-sm",
                                            attrs: { id: "" },
                                            on: {
                                              change: function($event) {
                                                var $$selectedVal = Array.prototype.filter
                                                  .call(
                                                    $event.target.options,
                                                    function(o) {
                                                      return o.selected
                                                    }
                                                  )
                                                  .map(function(o) {
                                                    var val =
                                                      "_value" in o
                                                        ? o._value
                                                        : o.value
                                                    return val
                                                  })
                                                _vm.$set(
                                                  _vm.form,
                                                  "city",
                                                  $event.target.multiple
                                                    ? $$selectedVal
                                                    : $$selectedVal[0]
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c(
                                              "option",
                                              {
                                                attrs: {
                                                  value: "",
                                                  selected: "",
                                                  disabled: ""
                                                }
                                              },
                                              [_vm._v("Select City")]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "option",
                                              {
                                                attrs: { value: "Manila City" }
                                              },
                                              [_vm._v("Manila City")]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  : _vm._e(),
                                _vm._v(" "),
                                _c("div", { staticClass: "col-md-1" }, [
                                  !_vm.form.address +
                                    !_vm.form.barangay +
                                    !_vm.form.city &&
                                  _vm.form.deliveryAddress == "differentAddress"
                                    ? _c(
                                        "span",
                                        {
                                          staticClass: "label",
                                          staticStyle: {
                                            color: "red",
                                            padding: "0px"
                                          }
                                        },
                                        [_vm._v("*")]
                                      )
                                    : _vm._e()
                                ])
                              ])
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.form.AutoRenew,
                                    expression: "form.AutoRenew"
                                  }
                                ],
                                attrs: { type: "checkbox", id: "AutoRenew" },
                                domProps: {
                                  checked: Array.isArray(_vm.form.AutoRenew)
                                    ? _vm._i(_vm.form.AutoRenew, null) > -1
                                    : _vm.form.AutoRenew
                                },
                                on: {
                                  change: function($event) {
                                    var $$a = _vm.form.AutoRenew,
                                      $$el = $event.target,
                                      $$c = $$el.checked ? true : false
                                    if (Array.isArray($$a)) {
                                      var $$v = null,
                                        $$i = _vm._i($$a, $$v)
                                      if ($$el.checked) {
                                        $$i < 0 &&
                                          _vm.$set(
                                            _vm.form,
                                            "AutoRenew",
                                            $$a.concat([$$v])
                                          )
                                      } else {
                                        $$i > -1 &&
                                          _vm.$set(
                                            _vm.form,
                                            "AutoRenew",
                                            $$a
                                              .slice(0, $$i)
                                              .concat($$a.slice($$i + 1))
                                          )
                                      }
                                    } else {
                                      _vm.$set(_vm.form, "AutoRenew", $$c)
                                    }
                                  }
                                }
                              }),
                              _vm._v(" "),
                              _c("label", { attrs: { for: "AutoRenew" } }, [
                                _vm._v("Auto Renew ?")
                              ]),
                              _c("br"),
                              _vm._v(" "),
                              _c("small", [
                                _vm._v(
                                  "(if check, policy will automatically renew at the end of each term)"
                                )
                              ])
                            ])
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "modal-footer" }, [
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-danger",
                            attrs: { type: "button", "data-dismiss": "modal" }
                          },
                          [_vm._v("Close")]
                        ),
                        _vm._v(" "),
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-primary",
                            attrs: { type: "submit" },
                            on: {
                              click: function($event) {
                                return _vm.QueryByOPtion()
                              }
                            }
                          },
                          [_vm._v("Submit")]
                        )
                      ])
                    ])
                  ])
                ]
              )
            ]
          )
        }),
        0
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("ol", { staticClass: "breadcrumb" }, [
      _c("li", [
        _c("a", { attrs: { href: "#" } }, [
          _c("i", { staticClass: "fa fa-dashboard" }),
          _vm._v(" Home")
        ])
      ]),
      _vm._v(" "),
      _c("li", { staticClass: "active" }, [_vm._v("Quotation ")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticStyle: { "text-align": "left" } }, [_c("br")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("small", [_c("b", [_vm._v("Customer Relations Department")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticStyle: { "text-align": "left" } }, [_c("br")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-12" }, [
        _c("p", [
          _vm._v(
            "We are pleased to submit our Motor Car Insurance Proposal for your review and approval."
          )
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "th",
      {
        staticStyle: {
          "text-align": "right",
          border: "1px solid black",
          "border-left": "transparent",
          "border-top": "transparent",
          "border-right": "transparent"
        }
      },
      [_vm._v("W/ AOG "), _c("br"), _vm._v("Premium")]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [_c("th", [_c("br")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close"
          }
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      ),
      _vm._v(" "),
      _c("h4", { staticClass: "modal-title" }, [_vm._v("Additional Details")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("label", { attrs: { for: "" } }, [_vm._v("MV File No. :")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("label", { attrs: { for: "" } }, [_vm._v("Engine No. :")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("label", { attrs: { for: "" } }, [_vm._v("Chassis No. :")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("label", { attrs: { for: "" } }, [_vm._v("Car Color :")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("label", { attrs: { for: "" } }, [_vm._v("Delivery")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/Options/ProposalOptions--ORIG.vue":
/*!********************************************************!*\
  !*** ./resources/js/Options/ProposalOptions--ORIG.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4& */ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4&");
/* harmony import */ var _ProposalOptions_ORIG_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProposalOptions--ORIG.vue?vue&type=script&lang=js& */ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& */ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ProposalOptions_ORIG_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Options/ProposalOptions--ORIG.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ProposalOptions--ORIG.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4&":
/*!***************************************************************************************!*\
  !*** ./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/ProposalOptions--ORIG.vue?vue&type=template&id=e1662ca4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProposalOptions_ORIG_vue_vue_type_template_id_e1662ca4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);