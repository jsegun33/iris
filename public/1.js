(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/Issuance1.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    var uri = window.location.href.split("?");
    var PassID = uri[1].trim(); // axios.get("api/GetListClauses/" + PassID) .then(({ data }) => (this.GetListClauses = data)  );

    axios.get("api/GetListSignatory/").then(function (_ref2) {
      var data = _ref2.data;
      return _this.GetListSignatory = data;
    }); //this.SplitDescription();
  },
  data: function data() {
    return {
      addClauses: false,
      addBanks: false,
      editMode: false,
      ResultQueryRequest: {},
      URLQueryPerilsCoveragesGroup: {},
      GetNewGroup: {},
      ListCoverages: {},
      ListCharges: {},
      ClausesWarranties: {},
      Accessories: {},
      GetListSignatory: {},
      GetListClauses: {},
      Sections: {},
      UserDetails: {},
      GetListBanksIssuance: {},
      ListClausesWarranties: {},
      SumUpCoveragesAmount: 0,
      form: new Form({
        TINNumber: "",
        EmailAddress: "",
        ContactNumber: "",
        FirstName: "",
        MiddleName: "",
        LastName: "",
        Address: "",
        Barangay: "",
        City: "",
        Denomination: "",
        RatePercent: "",
        Surcharge: "",
        CoverageAmount: "",
        TypeClass: "",
        MotorYear: "",
        MotorBrand: "",
        MotorModel: "",
        MotorType: "",
        PlateNumber: "",
        ChassisNo: "",
        EngineNo: "",
        BodyColor: "",
        MortgageBankName: "",
        MortgageBankAddrs: "",
        SelectCoverageAmounts: [],
        ProductLine: "",
        SelectPremiumAmount: [],
        TxtSelectAmount: "",
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
        RemarksApprover: [],
        RemarksReviewee: [],
        RemarksApproverDate: [],
        RemarksCustomerDate: [],
        ListApproverDisplayUW: [],
        ListApprover: [],
        MotorEffectiveDate: "",
        MotorExpiryDate: "",
        PremiumAmount: "",
        ClausessName: '',
        RequestNo: '',
        AcceptedOption: '',
        DisplayDescription: '',
        Description: '',
        PassengerNo: '',
        Remarks: '',
        RemarksSignature: '',
        QuotationNoDisplay: '',
        SignatureName: '',
        ListBankName: '',
        ListBankNameAddress: '',
        IssuanceRemarks: '',
        DisplayStatementClauses: '',
        DisplayStatementClauses1: '',
        ClausesStatementPA: [],
        ClausesStatementAmount: [],
        CoverageDescPA: [],
        PATitleClauses: '',
        PATitleClauses1: '',
        FormTitleforPA: '',
        FormTitleforPA1: '',
        Renewal: '',
        InsuranceAmount: '',
        OptionWithAOG: ''
      })
    };
  },
  methods: {
    textRemark: function textRemark() {
      var _this2 = this;

      var _ref3, text;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function textRemark$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Swal.fire({
                title: 'Are you sure?',
                text: "Leave a remark",
                icon: 'info',
                input: 'textarea',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                  'aria-label': 'Type your message here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
              }).then(function (result) {
                // console.log(result);
                _this2.form.Remarks = result.value;

                _this2.loadData();

                var GetRequestNo = _this2.form.RequestNo.trim() + ';;' + _this2.UserDetails.AccountNo + ';;' + _this2.UserDetails.CName + ';;' + _this2.ListCoverages[0].OptionNo + ";;" + _this2.form.Remarks;

                if (_this2.form.Remarks === '' || _this2.form.Remarks) {
                  axios.get("api/EditAmountPolicyMktg/" + GetRequestNo).then(function () {
                    Swal.fire("Request for Modification!", "Request has been Submitted.", "success"); // Success

                    _this2.loadData(); //alert(_id);
                    //this.addClauses = false

                  });
                }
              })["catch"](function () {
                Swal.fire("Failed", "There was something wrong", "warning");
              }));

            case 2:
              _ref3 = _context.sent;
              text = _ref3.value;

            case 4:
            case "end":
              return _context.stop();
          }
        }
      });
    },
    InternalAuthen: function InternalAuthen() {},
    SubmitForSignature: function SubmitForSignature() {
      var _this3 = this;

      var _ref4, text;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function SubmitForSignature$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Swal.fire({
                title: 'Are you sure?',
                text: "Leave a remark",
                icon: 'info',
                input: 'textarea',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                  'aria-label': 'Type your message here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
              }).then(function (result) {
                // console.log(result);
                _this3.form.RemarksSignature = result.value;

                _this3.loadData();

                var GetRequestNo = _this3.form.RequestNo.trim() + ';;' + _this3.UserDetails.AccountNo + ';;' + _this3.UserDetails.CName + ';;' + _this3.ListCoverages[0].OptionNo + ";;" + _this3.form.Remarks + ";;" + _this3.form.IssuanceRemarks;

                if (_this3.form.RemarksSignature === '' || _this3.form.RemarksSignature) {
                  axios.get("api/SubmitForSignature/" + GetRequestNo).then(function () {
                    Swal.fire("Request for Signature!", "Request has been Submitted.", "success"); // Success

                    _this3.loadData(); //alert(_id);
                    //this.addClauses = false

                  });
                }
              })["catch"](function () {
                Swal.fire("Failed", "There was something wrong", "warning");
              }));

            case 2:
              _ref4 = _context2.sent;
              text = _ref4.value;

            case 4:
            case "end":
              return _context2.stop();
          }
        }
      });
    },
    cancelUpdate: function cancelUpdate() {
      this.loadData();
      this.editMode = false;
    },
    UpdateScheduleVehicle: function UpdateScheduleVehicle() {
      var _this4 = this;

      var uri = window.location.href.split("?");
      var PassID = uri[1].trim() + ';;' + this.form.PlateNumber + ';;' + this.form.ChassisNo + ';;' + this.form.EngineNo + ';;' + this.form.BodyColor + ';;' + this.form.MotorBrand + ';;' + this.form.MotorModel + ';;' + this.form.MotorType;
      Swal.fire({
        title: "Are you sure?",
        text: "Updated Scheduled Vehicle",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          //alert(GetClausessName);
          axios.get("api/UpdateScheduleVehicle/" + PassID).then(function () {
            Swal.fire("Scheduled Vehicle!", "Your file has been Updated.", "success"); // Success

            _this4.loadData(); /// alert(PassID);


            _this4.addClauses = false;
          })["catch"](function () {
            Swal.fire("Failed", "There was Something wrong", "warning");
          });
        }
      });
    },
    cancelClauses: function cancelClauses() {
      this.form.ClausessName = '';
      this.addClauses = false;
    },
    cancelBanksAdd: function cancelBanksAdd() {
      this.form.ListBankName = '';
      this.addBanks = false;
    },
    SplitDescription: function SplitDescription() {
      // let Desc = "1 Driver & 4 Passenger/s.Coverage of each declared helper/passenger/s.(1) Accidental Death & Disablement.(2) Medical Indemnity.Disablement will abide by Schedule stated on page two(2)";
      var Desc = this.form.CoverageDescPA.trim();
      var SplitData = Desc.split('.');
      var NoPassengers = parseFloat(this.form.PassengerNo) + 1;
      var Split2Compute = parseFloat(this.form.ClausesStatementAmount) / parseFloat(NoPassengers);
      var Split3Compute = parseFloat(this.form.ClausesStatementAmount) / parseFloat(NoPassengers) * 0.10;
      this.form.DisplayDescription = SplitData[0] + '\n' + SplitData[1] + '\n' + SplitData[2] + '\t \t' + parseFloat(Split2Compute).toFixed(2) + ' @' + '\n' + SplitData[3] + '\t \t \t \t \t \xa0' + parseFloat(Split3Compute).toFixed(2) + ' @' + '\n' + SplitData[4];
    },
    SplitStatementClauses: function SplitStatementClauses() {
      var PremiumAmount = this.form.PremiumAmount;
      var Desc = this.form.ClausesStatementPA;
      var SplitData = Desc.split('.'); //alert(PremiumAmount);

      var NoPassengers = parseFloat(this.form.PassengerNo) + 1; // alert(NoPassengers);

      var SplitCompute1 = parseFloat(this.form.ClausesStatementAmount) / parseFloat(NoPassengers);
      var SplitCompute5to6 = parseFloat(SplitCompute1) / 2;
      var SplitCompute7 = parseFloat(SplitCompute1) * 0.12;
      var SplitCompute8 = parseFloat(SplitCompute1) * 0.10;
      var NewDisplay8b;
      var Display1to4 = SplitData[3] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' + parseFloat(SplitCompute1).toFixed(2) + '@ \n' + SplitData[4] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' + parseFloat(SplitCompute1).toFixed(2) + '@ \n' + SplitData[5] + '\t \t \t \t \t \t \t \t \t' + 'Ps ' + parseFloat(SplitCompute1).toFixed(2) + '@ \n' + SplitData[6] + '\t' + 'Ps ' + parseFloat(SplitCompute1).toFixed(2) + '@ ';
      var Display5to6 = SplitData[7] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' + parseFloat(SplitCompute5to6).toFixed(2) + '@ \n' + SplitData[8] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' + parseFloat(SplitCompute5to6).toFixed(2) + "@";
      var Display7 = SplitData[9] + '\t \t \t \t \t \xa0' + 'Ps ' + parseFloat(SplitCompute7).toFixed(2) + "@";
      var Display8 = SplitData[10] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \xa0' + 'Ps ' + parseFloat(SplitCompute8).toFixed(2) + "@ \n";
      var Display8a = SplitData[11];
      var Display8b = SplitData[12];
      var Display8c = SplitData[13];
      var Display8d = SplitData[14];
      var Display8e = SplitData[15];
      var Display8f = SplitData[16];
      var Display8g = SplitData[17]; // this.form.PATitleClauses   = SplitData[0].toUpperCase()  ;
      // this.form.PATitleClauses1  =  SplitData[2].toUpperCase();

      var n = Display8b.includes("50,000");

      if (n !== false) {
        NewDisplay8b = Display8b.replace("50,000", SplitCompute1);
      } else {
        NewDisplay8b = Display8b;
      } // let Split3Compute   = (parseFloat(coverage.CoveragesAmount)  / parseFloat(NoPassengers)  * 0.10 );
      //  this.form.DisplayStatementClauses       =   SplitData[1]  ;
      // this.form.DisplayStatementClauses1      =   Display1to4  + '\n' + Display5to6  + '\n' +   Display7 + '\n' +  Display8  + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' +  Display8d + '\n' +  Display8e + '\n' +  Display8f + '\n' +  Display8g;


      var Title = SplitData[0].includes("PA");
      var Title1 = SplitData[2].includes("Coverage");

      if (Title !== false) {
        this.form.FormTitleforPA = "PA";
      }

      if (Title1 !== false) {
        this.form.FormTitleforPA1 = "Coverage";
      }

      this.form.PATitleClauses = SplitData[0].toUpperCase();
      this.form.DisplayStatementClauses = SplitData[1] + '\n';
      this.form.PATitleClauses1 = SplitData[2].toUpperCase();
      this.form.DisplayStatementClauses1 = Display1to4 + '\n' + Display5to6 + '\n' + Display7 + '\n' + Display8 + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' + Display8d + '\n' + Display8e + '\n' + Display8f + '\n' + Display8g;
    },
    EditAmountPolicyMktg: function EditAmountPolicyMktg() {
      var _this5 = this;

      var GetRequestNo = this.form.RequestNo.trim() + ';;' + this.UserDetails.AccountNo + ';;' + this.UserDetails.CName + ';;' + this.ListCoverages[0].OptionNo; // alert(GetRequestNo);

      Swal.fire({
        title: "Amount Modification",
        text: "Return to Assigned Personnel...",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          //alert(GetClausessName);
          axios.get("api/EditAmountPolicyMktg/" + GetRequestNo).then(function () {
            Swal.fire("Request for Modification!", "Request has been Submitted.", "success"); // Success

            _this5.loadData(); //alert(_id);
            //this.addClauses = false

          })["catch"](function () {
            Swal.fire("Failed", "There was something wrong", "warning");
          });
        }
      });
    },
    ChangeBankDetails: function ChangeBankDetails() {
      var _this6 = this;

      var uri = window.location.href.split("?");
      var PassID = uri[1].trim() + ";;" + this.form.ListBankName.trim() + ";;" + this.form.ListBankNameAddress; //alert(PassID);

      Swal.fire({
        title: "Are you sure?",
        text: "Changing Mortgagee Bank...",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          //alert(GetClausessName);
          axios.get("api/ChangeBankDetails/" + PassID).then(function () {
            Swal.fire("Updated Mortgagee Bank", "Your file has been Added.", "success"); // Success

            _this6.loadData(); //alert(_id);


            _this6.addBanks = false;
          })["catch"](function () {
            Swal.fire("Failed", "There was something wrong", "warning");
          });
        }
      });
    },
    AddClausesWarrantiesToPolicy: function AddClausesWarrantiesToPolicy() {
      var _this7 = this;

      var uri = window.location.href.split("?");
      var GetClausessName = this.form.ClausessName.trim() + ";;" + uri[1].trim(); //alert(GetClausessName);

      Swal.fire({
        title: "Are you sure?",
        text: "Adding Clauses & Warranties...",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          //alert(GetClausessName);
          axios.get("api/AddClausesWarrantiesToPolicy/" + GetClausessName).then(function () {
            Swal.fire("New Clauses & Warranties!", "Your file has been Added.", "success"); // Success

            _this7.loadData(); //alert(_id);


            _this7.addClauses = false;
          })["catch"](function () {
            Swal.fire("Failed", "There was something wrong", "warning");
          });
        }
      });
    },
    deleteClause: function deleteClause(_id) {
      var _this8 = this;

      console.log(_id);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          axios.put("api/DeleteRequestClauses/" + _id).then(function () {
            Swal.fire("Deleted!", "Your file has been deleted.", "success"); // Success

            _this8.loadData(); //alert(_id);

          })["catch"](function () {
            Swal.fire("Failed", "There was something wrong", "warning");
          });
        }
      });
    },
    loadClauses: function loadClauses() {
      var _this9 = this;

      var uri = window.location.href.split("?");
      var PassID = uri[1].trim() + ";;" + this.form.AcceptedOption; //alert(PassID);

      axios.get("api/GetListClauses/" + PassID).then(function (_ref5) {
        var data = _ref5.data;
        return _this9.GetListClauses = data;
      });
    },
    loadBanksName: function loadBanksName() {
      var _this10 = this;

      var uri = window.location.href.split("?");
      var PassID = uri[1].trim();
      axios.get("api/GetListBanksIssuance/" + PassID).then(function (_ref6) {
        var data = _ref6.data;
        return _this10.GetListBanksIssuance = data;
      });
    },
    loadData: function loadData() {
      var _this11 = this;

      var uri = window.location.href.split("?");
      var PassID = uri[1].trim();
      axios.get("api/URLQueryRequestModify/" + PassID).then(function (_ref7) {
        var data = _ref7.data;
        var result = _this11.ResultQueryRequest = data.data;
        result.map(function (detail) {
          _this11.form.RequestNo = detail.RequestNo;
          _this11.form.AcceptedOption = detail.AcceptedOption;
          _this11.form.TINNumber = detail.TINNumber;
          _this11.form.EmailAddress = detail.EmailAddress;
          _this11.form.MotorBrand = detail.MotorBrand;
          _this11.form.ContactNumber = detail.ContactNumber;
          _this11.form.FirstName = detail.FirstName;
          _this11.form.MiddleName = detail.MiddleName;
          _this11.form.LastName = detail.LastName;
          _this11.form.Address = detail.Address;
          _this11.form.Barangay = detail.Barangay;
          _this11.form.City = detail.City;
          _this11.form.Denomination = detail.Denomination;
          _this11.form.TypeClass = detail.MotorBodyType;
          _this11.form.MotorYear = detail.MotorYear;
          _this11.form.MotorBrand = detail.MotorBrand;
          _this11.form.CoverageAmount = detail.MotorPOAmount;
          _this11.form.RatePercent = detail.RatePercent;
          _this11.form.MotorModel = detail.MotorModel;
          _this11.form.MotorType = detail.MotorBodyType;
          _this11.form.TxtPremiumAmount = detail.PremiumAmount;
          _this11.form.AmountDue = detail.AmountDue;
          _this11.form.ProductLine = detail.ProductLine;
          _this11.form.Deductable = detail.Deductable;
          _this11.form.PlateNumber = detail.PlateNumber;
          _this11.form.ChassisNo = detail.ChassisNo;
          _this11.form.EngineNo = detail.EngineNo;
          _this11.form.BodyColor = detail.BodyColor;
          _this11.form.MortgageBankName = detail.MortgageBankName;
          _this11.form.MortgageBankAddrs = detail.MortgageBankAddress;
          _this11.form.MotorEffectiveDate = detail.MotorEffectiveDate;
          _this11.form.MotorExpiryDate = detail.MotorExpiryDate;
          _this11.form.PremiumAmount = detail.PremiumAmount;
          _this11.form.PassengerNo = detail.Passengers;
          _this11.form.Renewal = detail.Renewal;
          _this11.form.InsuranceAmount = parseFloat(detail.TotalCoverages).toFixed(2);
          var GetDenoSplit = detail.Denomination.split('-');
          var DenoSplit = GetDenoSplit[1].trim();
          _this11.form.QuotationNoDisplay = "HO-MC" + DenoSplit + "-" + detail.RequestNo;
          _this11.form.OptionWithAOG = detail.OptionWithAOG;

          _this11.$forceUpdate();
        });
      });
      var PassIDNew = uri[1].trim() + ";;2"; // alert(PassIDNew);

      axios.get("api/CustomerAcceptedCoverage/" + PassIDNew).then(function (_ref8) {
        var data = _ref8.data;
        _this11.GetNewGroup = data;
        console.log(_this11.GetNewGroup);
      });
      axios.get("api/CustomerAcceptedCoverage/" + PassIDNew).then(function (_ref9) {
        var data = _ref9.data;
        var results = _this11.URLQueryPerilsCoveragesGroup = data;
        results.map(function (details) {
          // console.log(details.ListCoverages);
          _this11.ListCoverages = details.ListCoverages;
          _this11.ListCharges = details.ListCharges;
          _this11.ClausesWarranties = details.ClausesWarranties;
          _this11.Accessories = details.Accessories;
          _this11.Sections = _this11.URLQueryPerilsCoveragesGroup;
        });
      });
      this.RetrieveTimeInterval = setInterval(function () {
        _this11.URLQueryPerilsCoveragesGroup.map(function (URLQueryPerilsCoveragesGroups) {
          URLQueryPerilsCoveragesGroups.ClausesWarranties.map(function (ListWarranties) {
            if (ListWarranties.Belong == "PA") {
              _this11.form.ClausesStatementPA = ListWarranties.ClausesStatement;
            }
          });
          URLQueryPerilsCoveragesGroups.ListCoverages.map(function (ListCoverages) {
            if (ListCoverages.PerilsCode == "PA") {
              _this11.form.ClausesStatementAmount = ListCoverages.CoveragesAmount;
              _this11.form.CoverageDescPA = ListCoverages.Description; // CoverageAmountPA
            }
          });
        });
      }, 1000);
      this.RetrieveTimeInterval2 = setInterval(function () {
        _this11.SplitStatementClauses();

        _this11.SplitDescription();

        clearInterval(_this11.RetrieveTimeInterval);
      }, 5000);
    }
  },
  filters: {
    dateFormat: function dateFormat(date) {
      return moment(date).format("LL");
    },
    toWords: function toWords(amount) {
      var number = Math.round(amount);
      return converter.toWords(number).toUpperCase();
    },
    peso: function peso(amount) {
      var amt = Number(amount);
      return "₱ " + amt.toLocaleString("ko-KR", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }
  },
  computed: {
    date: function date() {
      var date = new Date();
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      return "".concat(month, " / ").concat(day, " / ").concat(year);
    }
  },
  created: function created() {
    this.loadData();
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n#upperRight > b[data-v-caa51092] {\r\n    font-weight: 500;\n}\n.inputfile[data-v-caa51092] {\r\n\twidth: 0.1px;\r\n\theight: 0.1px;\r\n\topacity: 0;\r\n\toverflow: hidden;\r\n\tposition: absolute;\r\n\tz-index: -1;\n}\n.inputfile + label[data-v-caa51092] {\r\n    font-size: 1em;\r\n    font-weight: 700;\r\n    display: inline-block;\r\n    cursor: pointer; /* \"hand\" cursor */\n}\n.inputfile:focus + label[data-v-caa51092],\r\n.inputfile + label[data-v-caa51092]:hover {\r\n    background-color: white;\n}\n.inputfile + label *[data-v-caa51092] {\r\n\tpointer-events: none;\n}\n#preStyle[data-v-caa51092] {\r\n    border: none;\r\n    font-family: sans-serif;\r\n    background: transparent;\r\n    font-size: x-small\n}\n#statement[data-v-caa51092] {\r\n    overflow: visible;\r\n    /* text-align: left; */\r\n    white-space: pre-wrap;\r\n    background: white;\r\n    border-style: none;\r\n    font-family: Arial, Helvetica, sans-serif\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true& ***!
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
    _vm._m(0),
    _vm._v(" "),
    _c("section", { staticClass: "content" }, [
      _c("div", { staticClass: "invoice" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-xs-12" }, [
            _c("h2", { staticClass: "page-header" }, [
              _c("img", {
                staticStyle: { height: "50px" },
                attrs: { src: "/img/rsilogo.png", alt: "Logo" }
              }),
              _vm._v(" "),
              _c("small", { staticClass: "pull-right" }, [
                _vm._v("Date: " + _vm._s(_vm.date))
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "row invoice-info" }, [
          _c("div", { staticClass: "col-sm-6 invoice-col" }, [
            _c("table", { staticClass: "table" }, [
              _c("tr", [
                _c("td", { staticStyle: { width: "80px" } }, [
                  _vm._v("Policy No.")
                ]),
                _c("th", [_vm._v(":")]),
                _c("th", { staticStyle: { "text-align": "left" } }, [
                  _vm._v(_vm._s(_vm.form.QuotationNoDisplay))
                ])
              ]),
              _c("tr", [
                _c("td", [_vm._v("Assured ")]),
                _c("th", [_vm._v(":")]),
                _c("th", { staticStyle: { "text-align": "left" } }, [
                  _vm._v(
                    _vm._s(_vm.form.LastName + ", ") +
                      " " +
                      _vm._s(_vm.form.FirstName) +
                      "  " +
                      _vm._s(_vm.form.MiddleName + ". ") +
                      " "
                  )
                ])
              ]),
              _c("tr", [
                _c("td", [_vm._v("Address ")]),
                _c("th", [_vm._v(":")]),
                _c("td", { staticStyle: { "text-align": "left" } }, [
                  _vm._v(" " + _vm._s(_vm.form.Address) + " "),
                  _c("br"),
                  _vm._v(
                    "  " +
                      _vm._s(_vm.form.Barangay) +
                      " " +
                      _vm._s(_vm.form.City)
                  )
                ])
              ]),
              _vm._m(1),
              _vm._v(" "),
              _c("tr", [
                _c("td", { attrs: { colspan: "3" } }, [
                  _vm._v(
                    "Amount of " +
                      _vm._s(_vm._f("toWords")(_vm.form.InsuranceAmount)) +
                      " PESOS ONLY"
                  )
                ])
              ]),
              _c("tr", [
                _c("td", [_vm._v("Insurance ")]),
                _c("th", [_vm._v(":")]),
                _c("th", { staticStyle: { "tex-align": "left" } }, [
                  _vm._v(_vm._s(_vm._f("peso")(_vm.form.InsuranceAmount)))
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "col-sm-6 invoice-col no-padding pull-right" },
            [
              _c("div", { staticClass: "col-sm-6 no-padding" }, [
                _c("table", { staticClass: "table" }, [
                  _c("tr", [
                    _c("td", { staticStyle: { "text-align": "right" } }, [
                      _vm._v("Issue Date.")
                    ]),
                    _c("th", [_vm._v(":")]),
                    _c("td", { staticStyle: { "text-align": "left" } }, [
                      _vm._v(_vm._s(_vm._f("dateFormat")(_vm.date)))
                    ])
                  ]),
                  _c("tr", [
                    _c("td", { staticStyle: { "text-align": "right" } }, [
                      _vm._v("Term From ")
                    ]),
                    _c("th", [_vm._v(":")]),
                    _c("td", { staticStyle: { "text-align": "left" } }, [
                      _vm._v(
                        _vm._s(
                          _vm._f("dateFormat")(_vm.form.MotorEffectiveDate)
                        )
                      )
                    ])
                  ]),
                  _c("tr", [
                    _c("td", { staticStyle: { "text-align": "right" } }, [
                      _vm._v("Term To  ")
                    ]),
                    _c("th", [_vm._v(":")]),
                    _c("td", { staticStyle: { "text-align": "left" } }, [
                      _vm._v(
                        " " +
                          _vm._s(_vm._f("dateFormat")(_vm.form.MotorExpiryDate))
                      )
                    ])
                  ]),
                  _vm._m(2),
                  _vm._m(3)
                ])
              ])
            ]
          )
        ]),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass: "row invoice-info",
            staticStyle: { "border-style": "solid" }
          },
          [
            _c(
              "div",
              {
                staticClass: "col-sm-4 invoice-col",
                staticStyle: { "border-style": "dotted" }
              },
              [
                _c("div", { staticClass: "row" }, [
                  _c(
                    "label",
                    { staticStyle: { "text-decoration": "underline" } },
                    [_vm._v("Scheduled Vehicle :")]
                  ),
                  _vm._v(" "),
                  !_vm.editMode
                    ? _c(
                        "button",
                        {
                          staticClass: "btn btn-xs btn-primary",
                          staticStyle: { "text-decoration": "none" },
                          on: {
                            click: function($event) {
                              _vm.editMode = true
                            }
                          }
                        },
                        [_c("i", { staticClass: "fa fa-pencil" })]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.editMode
                    ? _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col-md-2" }, [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.MotorYear,
                                expression: "form.MotorYear"
                              }
                            ],
                            staticClass: "form-control input-sm",
                            attrs: { type: "text", readonly: "" },
                            domProps: { value: _vm.form.MotorYear },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(
                                  _vm.form,
                                  "MotorYear",
                                  $event.target.value
                                )
                              }
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "col-md-2",
                            staticStyle: { "padding-left": "0px" }
                          },
                          [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.MotorBrand,
                                  expression: "form.MotorBrand"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.MotorBrand },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "MotorBrand",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "col-md-2",
                            staticStyle: { "padding-left": "0px" }
                          },
                          [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.MotorModel,
                                  expression: "form.MotorModel"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.MotorModel },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "MotorModel",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "col-md-2",
                            staticStyle: { "padding-left": "0px" }
                          },
                          [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.MotorType,
                                  expression: "form.MotorType"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.MotorType },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "MotorType",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ]
                        )
                      ])
                    : _c("p", [
                        _vm._v(
                          "\n                                " +
                            _vm._s(_vm.form.MotorYear) +
                            " " +
                            _vm._s(_vm.form.MotorBrand) +
                            "\n                                " +
                            _vm._s(_vm.form.MotorModel) +
                            " " +
                            _vm._s(_vm.form.MotorType) +
                            "\n                            "
                        )
                      ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-8 no-padding" }, [
                    _c(
                      "table",
                      { staticClass: "table", staticStyle: { width: "60%" } },
                      [
                        _c("tr", [
                          _c("th", { staticStyle: { width: "100px" } }, [
                            _vm._v("Plate#:")
                          ]),
                          _vm._v(" "),
                          _vm.editMode
                            ? _c("td", [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.PlateNumber,
                                      expression: "form.PlateNumber"
                                    }
                                  ],
                                  staticClass: "form-control input-sm",
                                  attrs: { type: "text" },
                                  domProps: { value: _vm.form.PlateNumber },
                                  on: {
                                    input: function($event) {
                                      if ($event.target.composing) {
                                        return
                                      }
                                      _vm.$set(
                                        _vm.form,
                                        "PlateNumber",
                                        $event.target.value
                                      )
                                    }
                                  }
                                })
                              ])
                            : _c("td", { staticStyle: { width: "200px" } }, [
                                _vm._v(_vm._s(_vm.form.PlateNumber))
                              ])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("th", [_vm._v("Serial No.:")]),
                          _vm._v(" "),
                          _vm.editMode
                            ? _c("td", [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.ChassisNo,
                                      expression: "form.ChassisNo"
                                    }
                                  ],
                                  staticClass: "form-control input-sm",
                                  attrs: { type: "text" },
                                  domProps: { value: _vm.form.ChassisNo },
                                  on: {
                                    input: function($event) {
                                      if ($event.target.composing) {
                                        return
                                      }
                                      _vm.$set(
                                        _vm.form,
                                        "ChassisNo",
                                        $event.target.value
                                      )
                                    }
                                  }
                                })
                              ])
                            : _c("td", [_vm._v(_vm._s(_vm.form.ChassisNo))])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("th", [_vm._v("Motor No.:")]),
                          _vm._v(" "),
                          _vm.editMode
                            ? _c("td", [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.EngineNo,
                                      expression: "form.EngineNo"
                                    }
                                  ],
                                  staticClass: "form-control input-sm",
                                  attrs: { type: "text" },
                                  domProps: { value: _vm.form.EngineNo },
                                  on: {
                                    input: function($event) {
                                      if ($event.target.composing) {
                                        return
                                      }
                                      _vm.$set(
                                        _vm.form,
                                        "EngineNo",
                                        $event.target.value
                                      )
                                    }
                                  }
                                })
                              ])
                            : _c("td", [_vm._v(_vm._s(_vm.form.EngineNo))])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("th", [_vm._v("Color:")]),
                          _vm._v(" "),
                          _vm.editMode
                            ? _c("td", [
                                _c("input", {
                                  directives: [
                                    {
                                      name: "model",
                                      rawName: "v-model",
                                      value: _vm.form.BodyColor,
                                      expression: "form.BodyColor"
                                    }
                                  ],
                                  staticClass: "form-control input-sm",
                                  attrs: { type: "text" },
                                  domProps: { value: _vm.form.BodyColor },
                                  on: {
                                    input: function($event) {
                                      if ($event.target.composing) {
                                        return
                                      }
                                      _vm.$set(
                                        _vm.form,
                                        "BodyColor",
                                        $event.target.value
                                      )
                                    }
                                  }
                                })
                              ])
                            : _c("td", [_vm._v(_vm._s(_vm.form.BodyColor))])
                        ])
                      ]
                    )
                  ])
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "col-sm-8 invoice-col no-padding",
                staticStyle: { "border-style": "double" }
              },
              [
                _c("div", { staticClass: "col-xs-12 table-responsive" }, [
                  _c("table", { staticStyle: { width: "100%" } }, [
                    _c(
                      "tbody",
                      [
                        _vm._m(4),
                        _vm._v(" "),
                        _vm._l(_vm.GetNewGroup, function(GetNewGroups) {
                          return _c("tr", { key: GetNewGroups._id }, [
                            GetNewGroups.Section != "OTHERS"
                              ? _c("td", { staticStyle: { width: "50px" } }, [
                                  _vm._v(
                                    "\n                                            " +
                                      _vm._s(
                                        "SECTION " + GetNewGroups.Section
                                      ) +
                                      "\n                                        "
                                  )
                                ])
                              : _c("td", { staticStyle: { width: "50px" } }, [
                                  _vm._v(
                                    "\n                                            " +
                                      _vm._s(GetNewGroups.Section) +
                                      "\n                                        "
                                  )
                                ]),
                            _vm._v(" "),
                            _c("td", { attrs: { colspan: "3" } }, [
                              _c(
                                "table",
                                [
                                  _vm._l(GetNewGroups.ListCoverages, function(
                                    coverage
                                  ) {
                                    return _c("tr", { key: coverage._id }, [
                                      _c(
                                        "td",
                                        { staticStyle: { width: "400px" } },
                                        [
                                          coverage.PerilsCode != "PA"
                                            ? _c("p", [
                                                _vm._v(
                                                  "\n                                                            " +
                                                    _vm._s(
                                                      coverage.PerilsName
                                                    ) +
                                                    "\n                                                        "
                                                )
                                              ])
                                            : _vm._e(),
                                          _vm._v(" "),
                                          coverage.PerilsCode == "PA"
                                            ? _c("p", [
                                                _vm._v(
                                                  "\n                                                            " +
                                                    _vm._s(
                                                      coverage.PerilsName
                                                    ) +
                                                    " \n                                                        \n                                                        "
                                                )
                                              ])
                                            : _vm._e()
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "td",
                                        {
                                          staticStyle: {
                                            width: "120px",
                                            "text-align": "right"
                                          }
                                        },
                                        [
                                          _vm._v(
                                            "\n                                                        " +
                                              _vm._s(
                                                _vm._f("peso")(
                                                  coverage.ComputeCoveagesAmount
                                                )
                                              ) +
                                              "\n                                                      \n                                                    "
                                          )
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "td",
                                        {
                                          staticStyle: {
                                            width: "120px",
                                            "text-align": "right"
                                          }
                                        },
                                        [
                                          _vm._v(
                                            "\n                                                        " +
                                              _vm._s(
                                                _vm._f("peso")(
                                                  coverage.CoveragesPremium
                                                )
                                              ) +
                                              "\n                                                        \n                                                    "
                                          )
                                        ]
                                      )
                                    ])
                                  }),
                                  _vm._v(" "),
                                  _vm._l(GetNewGroups.ListCoverages, function(
                                    coverage
                                  ) {
                                    return _c("tr", { key: coverage._id }, [
                                      coverage.PerilsCode == "PA"
                                        ? _c("td", [
                                            _c(
                                              "pre",
                                              { attrs: { id: "preStyle" } },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.form.DisplayDescription
                                                  ) + " "
                                                )
                                              ]
                                            )
                                          ])
                                        : _vm._e()
                                    ])
                                  })
                                ],
                                2
                              )
                            ])
                          ])
                        }),
                        _vm._v(" "),
                        _c("tr", [
                          _c("th", { attrs: { colspan: "3" } }),
                          _vm._v(" "),
                          _c(
                            "td",
                            {
                              staticClass: "pull-left",
                              staticStyle: { "border-top": "2px solid black" }
                            },
                            [
                              _vm._v(
                                "\n                                            " +
                                  _vm._s(
                                    _vm._f("peso")(_vm.form.PremiumAmount)
                                  ) +
                                  "\n                                         \n                                                         \n                                        "
                              )
                            ]
                          )
                        ])
                      ],
                      2
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "row" }, [
                    _c("div", { staticClass: "col-md-3" }),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c(
                        "table",
                        {
                          staticClass:
                            "table table-striped table-responsive pull-right"
                        },
                        [
                          _c(
                            "tbody",
                            [
                              _vm._l(_vm.ListCharges, function(charges) {
                                return _c("tr", { key: charges._id }, [
                                  _c("td", [
                                    _vm._v(
                                      "\n                                                    " +
                                        _vm._s(charges.ChargesName) +
                                        "\n                                                "
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("td"),
                                  _vm._v(" "),
                                  _c("td"),
                                  _vm._v(" "),
                                  _c("td", { staticClass: "pull-right" }, [
                                    _vm._v(
                                      "\n                                                    " +
                                        _vm._s(
                                          _vm._f("peso")(charges.ChargesPremium)
                                        ) +
                                        "\n                                                "
                                    )
                                  ])
                                ])
                              }),
                              _vm._v(" "),
                              _c("tr", [
                                _c("th", { attrs: { colspan: "2" } }, [
                                  _vm._v(
                                    "\n                                                    Total Amount Due\n                                                "
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td"),
                                _vm._v(" "),
                                _c(
                                  "td",
                                  {
                                    staticClass: "pull-right",
                                    staticStyle: {
                                      "border-top": "2px solid black"
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                                    " +
                                        _vm._s(
                                          _vm._f("peso")(_vm.form.AmountDue)
                                        ) +
                                        "\n                                                "
                                    )
                                  ]
                                )
                              ])
                            ],
                            2
                          )
                        ]
                      )
                    ])
                  ])
                ])
              ]
            )
          ]
        ),
        _vm._v(" "),
        _c("br"),
        _vm._v(" "),
        _c("div", { staticClass: "row", staticStyle: { padding: "15px" } }, [
          _c("div", { staticClass: "col-md-5" }, [
            _c("div", { staticClass: "row" }, [
              _c("label", { staticStyle: { "text-decoration": "underline" } }, [
                _vm._v("Scheduled Vehicle :")
              ]),
              _vm._v(" "),
              !_vm.editMode
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-xs btn-primary",
                      staticStyle: { "text-decoration": "none" },
                      on: {
                        click: function($event) {
                          _vm.editMode = true
                        }
                      }
                    },
                    [_c("i", { staticClass: "fa fa-pencil" })]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.editMode
                ? _c("div", { staticClass: "row" }, [
                    _c("div", { staticClass: "col-md-2" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.MotorYear,
                            expression: "form.MotorYear"
                          }
                        ],
                        staticClass: "form-control input-sm",
                        attrs: { type: "text", readonly: "" },
                        domProps: { value: _vm.form.MotorYear },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.form, "MotorYear", $event.target.value)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "col-md-2",
                        staticStyle: { "padding-left": "0px" }
                      },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.MotorBrand,
                              expression: "form.MotorBrand"
                            }
                          ],
                          staticClass: "form-control input-sm",
                          attrs: { type: "text" },
                          domProps: { value: _vm.form.MotorBrand },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "MotorBrand",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "col-md-2",
                        staticStyle: { "padding-left": "0px" }
                      },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.MotorModel,
                              expression: "form.MotorModel"
                            }
                          ],
                          staticClass: "form-control input-sm",
                          attrs: { type: "text" },
                          domProps: { value: _vm.form.MotorModel },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "MotorModel",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "col-md-2",
                        staticStyle: { "padding-left": "0px" }
                      },
                      [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.MotorType,
                              expression: "form.MotorType"
                            }
                          ],
                          staticClass: "form-control input-sm",
                          attrs: { type: "text" },
                          domProps: { value: _vm.form.MotorType },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "MotorType",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ]
                    )
                  ])
                : _c("p", [
                    _vm._v(
                      "\n                                " +
                        _vm._s(_vm.form.MotorYear) +
                        " " +
                        _vm._s(_vm.form.MotorBrand) +
                        "\n                                " +
                        _vm._s(_vm.form.MotorModel) +
                        " " +
                        _vm._s(_vm.form.MotorType) +
                        "\n                            "
                    )
                  ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-8 no-padding" }, [
                _c(
                  "table",
                  { staticClass: "table", staticStyle: { width: "60%" } },
                  [
                    _c("tr", [
                      _c("th", { staticStyle: { width: "100px" } }, [
                        _vm._v("Plate#:")
                      ]),
                      _vm._v(" "),
                      _vm.editMode
                        ? _c("td", [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.PlateNumber,
                                  expression: "form.PlateNumber"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.PlateNumber },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "PlateNumber",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ])
                        : _c("td", { staticStyle: { width: "200px" } }, [
                            _vm._v(_vm._s(_vm.form.PlateNumber))
                          ])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("th", [_vm._v("Serial No.:")]),
                      _vm._v(" "),
                      _vm.editMode
                        ? _c("td", [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.ChassisNo,
                                  expression: "form.ChassisNo"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.ChassisNo },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "ChassisNo",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ])
                        : _c("td", [_vm._v(_vm._s(_vm.form.ChassisNo))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("th", [_vm._v("Motor No.:")]),
                      _vm._v(" "),
                      _vm.editMode
                        ? _c("td", [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.EngineNo,
                                  expression: "form.EngineNo"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.EngineNo },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "EngineNo",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ])
                        : _c("td", [_vm._v(_vm._s(_vm.form.EngineNo))])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _c("th", [_vm._v("Color:")]),
                      _vm._v(" "),
                      _vm.editMode
                        ? _c("td", [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.BodyColor,
                                  expression: "form.BodyColor"
                                }
                              ],
                              staticClass: "form-control input-sm",
                              attrs: { type: "text" },
                              domProps: { value: _vm.form.BodyColor },
                              on: {
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.form,
                                    "BodyColor",
                                    $event.target.value
                                  )
                                }
                              }
                            })
                          ])
                        : _c("td", [_vm._v(_vm._s(_vm.form.BodyColor))])
                    ])
                  ]
                )
              ])
            ]),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _vm.editMode
              ? _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-8 no-padding" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-success btn-sm pull-right",
                        on: {
                          click: function($event) {
                            return _vm.UpdateScheduleVehicle()
                          }
                        }
                      },
                      [_vm._v("Update")]
                    ),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-danger btn-sm pull-right",
                        staticStyle: { "margin-right": "10px" },
                        on: { click: _vm.cancelUpdate }
                      },
                      [_vm._v("Cancel")]
                    )
                  ])
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm._m(5),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-8 no-padding" }, [
                _c(
                  "div",
                  { staticClass: "col-md-8 no-padding" },
                  _vm._l(_vm.Accessories, function(Accessoriess) {
                    return _c("p", { key: Accessoriess._id }, [
                      _vm._v(
                        "\n                                        " +
                          _vm._s(Accessoriess.Name) +
                          "\n                                    "
                      )
                    ])
                  }),
                  0
                )
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("label", { staticStyle: { "text-decoration": "underline" } }, [
                _vm._v("Mortgagee :")
              ]),
              _vm._v(" "),
              !_vm.addBanks
                ? _c(
                    "button",
                    {
                      staticClass: "btn btn-xs btn-primary",
                      on: {
                        click: function($event) {
                          _vm.loadBanksName(), (_vm.addBanks = true)
                        }
                      }
                    },
                    [_c("i", { staticClass: "fa fa-pencil" })]
                  )
                : _vm._e(),
              _vm._v(" "),
              !_vm.addBanks
                ? _c("p", [
                    _vm._v(
                      "\n                                " +
                        _vm._s(
                          _vm.form.MortgageBankName +
                            " - " +
                            _vm.form.MortgageBankAddrs
                        ) +
                        "\n                            "
                    )
                  ])
                : _c(
                    "div",
                    { staticClass: "input-group input-group-sm col-md-7" },
                    [
                      _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.ListBankName,
                              expression: "form.ListBankName"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: { required: "" },
                          on: {
                            change: function($event) {
                              var $$selectedVal = Array.prototype.filter
                                .call($event.target.options, function(o) {
                                  return o.selected
                                })
                                .map(function(o) {
                                  var val = "_value" in o ? o._value : o.value
                                  return val
                                })
                              _vm.$set(
                                _vm.form,
                                "ListBankName",
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
                              attrs: { value: "", selected: "", disabled: "" }
                            },
                            [_vm._v("List of Banks")]
                          ),
                          _vm._v(" "),
                          _vm._l(_vm.GetListBanksIssuance, function(
                            GetListBanksIssuances
                          ) {
                            return _c(
                              "option",
                              {
                                key: GetListBanksIssuances._id,
                                domProps: {
                                  value: GetListBanksIssuances.BankName
                                }
                              },
                              [_vm._v(_vm._s(GetListBanksIssuances.BankName))]
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
                            value: _vm.form.ListBankNameAddress,
                            expression: "form.ListBankNameAddress"
                          }
                        ],
                        staticClass: "form-control input-sm",
                        attrs: { type: "text" },
                        domProps: { value: _vm.form.ListBankNameAddress },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "ListBankNameAddress",
                              $event.target.value
                            )
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "input-group-btn" }, [
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-primary btn-flat",
                            on: {
                              click: function($event) {
                                _vm.loadBanksName(), _vm.ChangeBankDetails()
                              }
                            }
                          },
                          [
                            _c("i", {
                              staticClass: "fa fa-plus",
                              staticStyle: { "font-size": "18px" }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-danger btn-flat",
                            attrs: { type: "button" },
                            on: { click: _vm.cancelBanksAdd }
                          },
                          [
                            _c("i", {
                              staticClass: "fa fa-times-circle-o",
                              attrs: { syle: "font-size: 18px;" }
                            })
                          ]
                        )
                      ])
                    ]
                  )
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "row" },
              [
                _c(
                  "label",
                  { staticStyle: { "text-decoration": "underline" } },
                  [_vm._v("Clauses & Warranties :")]
                ),
                _vm._v(" "),
                !_vm.addClauses
                  ? _c(
                      "button",
                      {
                        staticClass: "btn btn-xs btn-primary",
                        on: {
                          click: function($event) {
                            _vm.loadClauses(), (_vm.addClauses = true)
                          }
                        }
                      },
                      [_c("i", { staticClass: "fa fa-plus" })]
                    )
                  : _vm._e(),
                _vm._v(" "),
                _vm._l(_vm.ClausesWarranties, function(ClausesWarrantiess) {
                  return _c(
                    "div",
                    {
                      key: ClausesWarrantiess._id,
                      staticStyle: { width: "350px" }
                    },
                    [
                      _c("label", { staticStyle: { "font-weight": "500" } }, [
                        _vm._v(
                          "\n                                    " +
                            _vm._s(ClausesWarrantiess.ClausesName) +
                            "\n                                "
                        )
                      ]),
                      _vm._v(" "),
                      ClausesWarrantiess.Belong != "PA" &&
                      ClausesWarrantiess.ClausesRequired != "YES"
                        ? _c(
                            "button",
                            {
                              staticClass: "btn btn-xs btn-danger pull-right",
                              on: {
                                click: function($event) {
                                  return _vm.deleteClause(
                                    ClausesWarrantiess._id
                                  )
                                }
                              }
                            },
                            [_c("i", { staticClass: "fa fa-close" })]
                          )
                        : _vm._e()
                    ]
                  )
                }),
                _vm._v(" "),
                _vm.addClauses
                  ? _c(
                      "div",
                      { staticClass: "input-group input-group-sm col-md-7" },
                      [
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.ClausessName,
                                expression: "form.ClausessName"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: { required: "" },
                            on: {
                              change: function($event) {
                                var $$selectedVal = Array.prototype.filter
                                  .call($event.target.options, function(o) {
                                    return o.selected
                                  })
                                  .map(function(o) {
                                    var val = "_value" in o ? o._value : o.value
                                    return val
                                  })
                                _vm.$set(
                                  _vm.form,
                                  "ClausessName",
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
                                attrs: { value: "", selected: "", disabled: "" }
                              },
                              [_vm._v("Add Clausses & Warranties")]
                            ),
                            _vm._v(" "),
                            _vm._l(_vm.GetListClauses, function(
                              GetListClausess
                            ) {
                              return _c(
                                "option",
                                {
                                  key: GetListClausess._id,
                                  domProps: {
                                    value:
                                      GetListClausess._id +
                                      ";;" +
                                      _vm.form.RequestNo +
                                      ";;" +
                                      _vm.form.AcceptedOption +
                                      ";;" +
                                      _vm.form.MortgageBankName +
                                      ";;" +
                                      _vm.form.MortgageBankAddrs
                                  }
                                },
                                [_vm._v(_vm._s(GetListClausess.Name))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("span", { staticClass: "input-group-btn" }, [
                          _c(
                            "button",
                            {
                              staticClass: "btn btn-primary btn-flat",
                              on: {
                                click: function($event) {
                                  _vm.loadClauses(),
                                    _vm.AddClausesWarrantiesToPolicy()
                                }
                              }
                            },
                            [
                              _c("i", {
                                staticClass: "fa fa-plus",
                                staticStyle: { "font-size": "18px" }
                              })
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "button",
                            {
                              staticClass: "btn btn-danger btn-flat",
                              attrs: { type: "button" },
                              on: { click: _vm.cancelClauses }
                            },
                            [
                              _c("i", {
                                staticClass: "fa fa-times-circle-o",
                                staticStyle: { "font-size": "18px" }
                              })
                            ]
                          )
                        ])
                      ]
                    )
                  : _vm._e()
              ],
              2
            ),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _vm.form.Renewal == true
              ? _c("div", { staticClass: "row" }, [
                  _c("div", [
                    _c("label", { attrs: { for: "" } }, [
                      _vm._v(
                        "Renewing/Replacing Policy " +
                          _vm._s(_vm.form.QuotationNoDisplay)
                      )
                    ])
                  ])
                ])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-7" }, [
            _c("div", { staticClass: "col-xs-12 table-responsive" }, [
              _c("table", { staticClass: "table table-striped" }, [
                _c(
                  "tbody",
                  [
                    _vm._m(6),
                    _vm._v(" "),
                    _vm._l(_vm.GetNewGroup, function(GetNewGroups) {
                      return _c("tr", { key: GetNewGroups._id }, [
                        GetNewGroups.Section != "OTHERS"
                          ? _c("td", { staticStyle: { width: "50px" } }, [
                              _vm._v(
                                "\n                                            " +
                                  _vm._s("SECTION " + GetNewGroups.Section) +
                                  "\n                                        "
                              )
                            ])
                          : _c("td", { staticStyle: { width: "50px" } }, [
                              _vm._v(
                                "\n                                            " +
                                  _vm._s(GetNewGroups.Section) +
                                  "\n                                        "
                              )
                            ]),
                        _vm._v(" "),
                        _c("td", { attrs: { colspan: "3" } }, [
                          _c(
                            "table",
                            [
                              _vm._l(GetNewGroups.ListCoverages, function(
                                coverage
                              ) {
                                return _c("tr", { key: coverage._id }, [
                                  _c(
                                    "td",
                                    { staticStyle: { width: "400px" } },
                                    [
                                      coverage.PerilsCode != "PA"
                                        ? _c("p", [
                                            _vm._v(
                                              "\n                                                            " +
                                                _vm._s(coverage.PerilsName) +
                                                "\n                                                        "
                                            )
                                          ])
                                        : _vm._e(),
                                      _vm._v(" "),
                                      coverage.PerilsCode == "PA"
                                        ? _c("p", [
                                            _vm._v(
                                              "\n                                                            " +
                                                _vm._s(coverage.PerilsName) +
                                                " \n                                                        \n                                                        "
                                            )
                                          ])
                                        : _vm._e()
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "td",
                                    {
                                      staticStyle: {
                                        width: "120px",
                                        "text-align": "right"
                                      }
                                    },
                                    [
                                      _vm._v(
                                        "\n                                                        " +
                                          _vm._s(
                                            _vm._f("peso")(
                                              coverage.ComputeCoveagesAmount
                                            )
                                          ) +
                                          "\n                                                      \n                                                    "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "td",
                                    {
                                      staticStyle: {
                                        width: "120px",
                                        "text-align": "right"
                                      }
                                    },
                                    [
                                      _vm._v(
                                        "\n                                                        " +
                                          _vm._s(
                                            _vm._f("peso")(
                                              coverage.CoveragesPremium
                                            )
                                          ) +
                                          "\n                                                        \n                                                    "
                                      )
                                    ]
                                  )
                                ])
                              }),
                              _vm._v(" "),
                              _vm._l(GetNewGroups.ListCoverages, function(
                                coverage
                              ) {
                                return _c("tr", { key: coverage._id }, [
                                  coverage.PerilsCode == "PA"
                                    ? _c("td", [
                                        _c(
                                          "pre",
                                          { attrs: { id: "preStyle" } },
                                          [
                                            _vm._v(
                                              _vm._s(
                                                _vm.form.DisplayDescription
                                              ) + " "
                                            )
                                          ]
                                        )
                                      ])
                                    : _vm._e()
                                ])
                              })
                            ],
                            2
                          )
                        ])
                      ])
                    }),
                    _vm._v(" "),
                    _c("tr", [
                      _c("th", { attrs: { colspan: "3" } }),
                      _vm._v(" "),
                      _c(
                        "td",
                        {
                          staticClass: "pull-left",
                          staticStyle: { "border-top": "2px solid black" }
                        },
                        [
                          _vm._v(
                            "\n                                            " +
                              _vm._s(_vm._f("peso")(_vm.form.PremiumAmount)) +
                              "\n                                         \n                                                         \n                                        "
                          )
                        ]
                      )
                    ])
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-3" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-9" }, [
                  _c(
                    "table",
                    {
                      staticClass:
                        "table table-striped table-responsive pull-right"
                    },
                    [
                      _c(
                        "tbody",
                        [
                          _vm._l(_vm.ListCharges, function(charges) {
                            return _c("tr", { key: charges._id }, [
                              _c("td", [
                                _vm._v(
                                  "\n                                                    " +
                                    _vm._s(charges.ChargesName) +
                                    "\n                                                "
                                )
                              ]),
                              _vm._v(" "),
                              _c("td"),
                              _vm._v(" "),
                              _c("td"),
                              _vm._v(" "),
                              _c("td", { staticClass: "pull-right" }, [
                                _vm._v(
                                  "\n                                                    " +
                                    _vm._s(
                                      _vm._f("peso")(charges.ChargesPremium)
                                    ) +
                                    "\n                                                "
                                )
                              ])
                            ])
                          }),
                          _vm._v(" "),
                          _c("tr", [
                            _c("th", { attrs: { colspan: "2" } }, [
                              _vm._v(
                                "\n                                                    Total Amount Due\n                                                "
                              )
                            ]),
                            _vm._v(" "),
                            _c("td"),
                            _vm._v(" "),
                            _c(
                              "td",
                              {
                                staticClass: "pull-right",
                                staticStyle: { "border-top": "2px solid black" }
                              },
                              [
                                _vm._v(
                                  "\n                                                    " +
                                    _vm._s(_vm._f("peso")(_vm.form.AmountDue)) +
                                    "\n                                                "
                                )
                              ]
                            )
                          ])
                        ],
                        2
                      )
                    ]
                  )
                ])
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("br"),
        _vm._v(" "),
        _c("div", { staticClass: "row no-print" }, [
          _c("div", { staticClass: "col-xs-12" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("label", [_vm._v("Remarks: ")]),
              _vm._v(" "),
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.form.IssuanceRemarks,
                    expression: "form.IssuanceRemarks"
                  }
                ],
                staticClass: "form-control",
                attrs: {
                  rows: "3",
                  cols: "5",
                  placeholder: "Leave a Remarks..."
                },
                domProps: { value: _vm.form.IssuanceRemarks },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.form, "IssuanceRemarks", $event.target.value)
                  }
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-xs-2 pull-right text-center" }, [
            _c("div", [
              _c(
                "button",
                {
                  staticClass: "btn btn-success pull-right",
                  staticStyle: { "margin-right": "5px" },
                  attrs: { type: "button" },
                  on: { click: _vm.textRemark }
                },
                [
                  _c("i", { staticClass: "fa fa-edit" }),
                  _vm._v(
                    " \n                                Edit\n                            "
                  )
                ]
              )
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "invoice" },
        [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-xs-12" }, [
              _c("h2", { staticClass: "page-header" }, [
                _c("img", {
                  staticStyle: { height: "50px" },
                  attrs: { src: "/img/rsilogo.png", alt: "Logo" }
                }),
                _vm._v(" "),
                _c("small", { staticClass: "pull-right" }, [
                  _vm._v("Date: " + _vm._s(_vm.date))
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row invoice-info" }, [
            _c("div", { staticClass: "col-md-12 text-center" }, [
              _c("h4", [
                _vm._v(
                  "\n                            ATTACHED TO AND FORMING PART OF POLICY NUMBER\n                           " +
                    _vm._s(_vm.form.QuotationNoDisplay) +
                    "\n                        "
                )
              ])
            ])
          ]),
          _vm._v(" "),
          _c("br"),
          _vm._v(" "),
          _vm._m(7),
          _vm._v(" "),
          _vm._l(_vm.ClausesWarranties, function(ClausesWarrantiess) {
            return _c(
              "div",
              { key: ClausesWarrantiess._id, staticClass: "row" },
              [
                _c("div", { staticClass: "col-md-12" }, [
                  ClausesWarrantiess.ClausesNo != "2020-0012"
                    ? _c(
                        "h5",
                        {
                          staticClass: "text-center",
                          staticStyle: { "text-transform": "uppercase" }
                        },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(ClausesWarrantiess.ClausesName) +
                              "\n                        "
                          )
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  ClausesWarrantiess.ClausesNo != "2020-0012"
                    ? _c("pre", { attrs: { id: "statement" } }, [
                        _vm._v(_vm._s(ClausesWarrantiess.ClausesStatement))
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  ClausesWarrantiess.ClausesNo == "2020-0012" &&
                  _vm.form.FormTitleforPA == "PA"
                    ? _c(
                        "h5",
                        {
                          staticClass: "text-center",
                          staticStyle: { "text-transform": "uppercase" }
                        },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(_vm.form.PATitleClauses) +
                              "\n                        "
                          )
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  ClausesWarrantiess.ClausesNo == "2020-0012" &&
                  _vm.form.FormTitleforPA == "PA"
                    ? _c("pre", { attrs: { id: "statement" } }, [
                        _vm._v(_vm._s(_vm.form.DisplayStatementClauses) + " ")
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  ClausesWarrantiess.ClausesNo == "2020-0012" &&
                  _vm.form.FormTitleforPA1 == "Coverage"
                    ? _c(
                        "h5",
                        {
                          staticClass: "text-center",
                          staticStyle: { "text-transform": "uppercase" }
                        },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(_vm.form.PATitleClauses1) +
                              "\n                        "
                          )
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  ClausesWarrantiess.ClausesNo == "2020-0012" &&
                  _vm.form.FormTitleforPA1 == "Coverage"
                    ? _c("pre", { attrs: { id: "statement" } }, [
                        _vm._v(
                          _vm._s(_vm.form.DisplayStatementClauses1) + "   "
                        ),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.ClausesStatementPA,
                              expression: "form.ClausesStatementPA"
                            }
                          ],
                          attrs: { type: "hidden" },
                          domProps: { value: _vm.form.ClausesStatementPA },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "ClausesStatementPA",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ])
                    : _vm._e()
                ])
              ]
            )
          }),
          _vm._v(" "),
          _c("div", { staticClass: "row no-print" }, [
            _c(
              "div",
              { staticClass: "col-xs-12" },
              [
                _vm._m(8),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-success pull-right",
                    attrs: { type: "button" },
                    on: { click: _vm.SubmitForSignature }
                  },
                  [
                    _c("i", { staticClass: "fa fa-file-pdf-o" }),
                    _vm._v(
                      "\n                            Submit\n                        "
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "router-link",
                  {
                    staticClass: "btn btn-primary pull-right",
                    staticStyle: {
                      "margin-right": "5px",
                      "text-decoration": "none"
                    },
                    attrs: { to: "/proposal-lists-accepted" }
                  },
                  [
                    _c("i", { staticClass: "fa  fa-arrow-circle-left" }),
                    _vm._v(
                      "\n                            Back\n                        "
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "pull-right",
                    staticStyle: { "margin-right": "5px", width: "250px" }
                  },
                  [
                    _c(
                      "select",
                      {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.SignatureName,
                            expression: "form.SignatureName"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { required: "" },
                        on: {
                          change: function($event) {
                            var $$selectedVal = Array.prototype.filter
                              .call($event.target.options, function(o) {
                                return o.selected
                              })
                              .map(function(o) {
                                var val = "_value" in o ? o._value : o.value
                                return val
                              })
                            _vm.$set(
                              _vm.form,
                              "SignatureName",
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
                          { attrs: { value: "", selected: "", disabled: "" } },
                          [_vm._v("Select Signatory")]
                        ),
                        _vm._v(" "),
                        _vm._l(_vm.GetListSignatory, function(
                          GetListSignatorys
                        ) {
                          return _c(
                            "option",
                            {
                              key: GetListSignatorys._id,
                              domProps: {
                                value:
                                  GetListSignatorys._id +
                                  ";;" +
                                  GetListSignatorys.AccountNo +
                                  ";;" +
                                  GetListSignatorys.CName
                              }
                            },
                            [_vm._v(_vm._s(GetListSignatorys.CName))]
                          )
                        })
                      ],
                      2
                    )
                  ]
                )
              ],
              1
            )
          ])
        ],
        2
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticClass: "content-header" }, [
      _c("h1", [
        _vm._v("\n                Quotations\n                "),
        _c("small", [_vm._v("List of Quotations Approved")])
      ]),
      _vm._v(" "),
      _c("ol", { staticClass: "breadcrumb" }, [
        _c("li", [
          _c("a", { attrs: { href: "#" } }, [
            _c("i", { staticClass: "fa fa-dashboard" }),
            _vm._v(" Home")
          ])
        ]),
        _vm._v(" "),
        _c("li", { staticClass: "active" }, [_vm._v("Quotation")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [_c("td", { attrs: { colspan: "3" } }, [_c("br")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("td", { staticStyle: { "text-align": "right" } }, [
        _vm._v("COC No.  ")
      ]),
      _c("th", [_vm._v(":")]),
      _c("td", { staticStyle: { "text-align": "left" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("td", { staticStyle: { "text-align": "right" } }, [
        _vm._v("Authentication Code.  ")
      ]),
      _c("th", [_vm._v(":")]),
      _c("td", { staticStyle: { "text-align": "left" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticClass: "col-md-3" }),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-7" }, [
        _vm._v(
          "\n                                            PERILS\n                                        "
        )
      ]),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-3" }, [
        _vm._v(
          "\n                                            AMOUNT\n                                        "
        )
      ]),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-3" }, [
        _vm._v("\n                                            PREMIUM "),
        _c("br"),
        _vm._v("(INVOICE VALUE)\n                                        ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("label", { staticStyle: { "text-decoration": "underline" } }, [
        _vm._v("Accessories Covered :")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticClass: "col-md-3" }),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-7" }, [
        _vm._v(
          "\n                                            PERILS\n                                        "
        )
      ]),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-3" }, [
        _vm._v(
          "\n                                            AMOUNT\n                                        "
        )
      ]),
      _vm._v(" "),
      _c("th", { staticClass: "col-md-3" }, [
        _vm._v("\n                                            PREMIUM "),
        _c("br"),
        _vm._v("(INVOICE VALUE)\n                                        ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-5" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-12" }, [
            _c("label", { staticStyle: { "text-decoration": "underline" } }, [
              _vm._v("Clauses & Warranties :")
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-7" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "a",
      { attrs: { href: "api/ISAPInternalAuth", target: "_blank" } },
      [
        _c(
          "button",
          { staticClass: "btn btn-info pull-right", attrs: { type: "button" } },
          [
            _c("i", { staticClass: "fa  fa-send" }),
            _vm._v(
              "\n                            Internal Authentication\n                        "
            )
          ]
        )
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/Options/Issuance1.vue":
/*!********************************************!*\
  !*** ./resources/js/Options/Issuance1.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Issuance1.vue?vue&type=template&id=caa51092&scoped=true& */ "./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true&");
/* harmony import */ var _Issuance1_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Issuance1.vue?vue&type=script&lang=js& */ "./resources/js/Options/Issuance1.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& */ "./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Issuance1_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "caa51092",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Options/Issuance1.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Options/Issuance1.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/Options/Issuance1.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Issuance1.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& ***!
  \*****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=style&index=0&id=caa51092&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_style_index_0_id_caa51092_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true&":
/*!***************************************************************************************!*\
  !*** ./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Issuance1.vue?vue&type=template&id=caa51092&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Options/Issuance1.vue?vue&type=template&id=caa51092&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Issuance1_vue_vue_type_template_id_caa51092_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);