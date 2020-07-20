(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue_material__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-material */ "./node_modules/vue-material/dist/vue-material.js");
/* harmony import */ var vue_material__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_material__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var vue_material_dist_vue_material_min_css__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue-material/dist/vue-material.min.css */ "./node_modules/vue-material/dist/vue-material.min.css");
/* harmony import */ var vue_material_dist_vue_material_min_css__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(vue_material_dist_vue_material_min_css__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vue-the-mask */ "./node_modules/vue-the-mask/dist/vue-the-mask.js");
/* harmony import */ var vue_the_mask__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(vue_the_mask__WEBPACK_IMPORTED_MODULE_4__);


function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




vue__WEBPACK_IMPORTED_MODULE_1___default.a.use(vue_material__WEBPACK_IMPORTED_MODULE_2___default.a);
/* harmony default export */ __webpack_exports__["default"] = ({
  directives: {
    mask: vue_the_mask__WEBPACK_IMPORTED_MODULE_4__["mask"]
  },
  mounted: function mounted() {
    var _this = this;

    console.log('Component mounted.');
    axios.get("GetUserData").then(function (_ref) {
      var data = _ref.data;
      return _this.UserDetails = data;
    });
    this.StartLoading();
    this.LoadUserData();
  },
  data: function data() {
    return {
      DataDenominations: {},
      MarketValues: {},
      DataCarBrands: {},
      DataCarBodyType: {},
      DataCarModelsList: {},
      DataSurcharges: {},
      DataCoverages: {},
      DataProvinces: {},
      DataCities: {},
      DataListBrgy: {},
      filterPropertyBrgy: false,
      disabledtext: true,
      PerilsCheckbox: true,
      year: '',
      ShowCommercial: false,
      ShowSurcharges: false,
      effectiveDate: '',
      DataPremiumType: {},
      UserDetails: {},
      checked: true,
      txtOtherCarAmount: 0,
      OtherCarAmount: false,
      OtherBrand: false,
      OtherModel: false,
      OtherBodyType: false,
      OtherProvince: false,
      OtherCity: false,
      OtherBarangay: false,
      ddCarAmount: 0,
      ddCarBrand: 0,
      ddCarModel: 0,
      ddBodyType: 0,
      ddProvince: 0,
      ddCity: 0,
      ddBarangay: 0,
      form: new Form({
        _id: '',
        PlateNumber: '',
        Denomination: '',
        POAMount: 0,
        YearPO: '2011',
        CarBrand: '',
        CarModel: '',
        BodyType: '',
        usages: '',
        MotorNetWeight: '',
        MotorAccessories: '',
        SurchageList: [],
        EffectiveDate: '',
        ExpiryDate: '',
        department: '',
        passengers: '4',
        PerilsName: [],
        SubPerilsName: [],
        PerilsNameDis: [],
        SubPerilsNameDis: [],
        TINNumber: '',
        EmailAddress: '',
        ContactNumber: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        CustAcctNo: '',
        AcctName: '',
        Barangay: '',
        CityName: '',
        Province: '',
        Address: '',
        Individual: 'Individual',
        IndividualPass: 'Individual',
        DepreciativeAmount: '',
        DepreciativeNumberYear: '',
        DenominationDis: 0,
        CheckAll: '',
        YearMinValue: '',
        YearCurrentValue: '',
        PremiumTypeSave: ''
      }),
      config: {
        spinner: false,
        min: 10000,
        max: 5050000,
        prefix: "₱ ",
        suffix: "",
        precision: 2,
        decimal: '.',
        thousands: ',',
        bootstrap: true,
        amend: true,
        masked: false,
        align: "left"
      }
    };
  },
  methods: {
    StartLoading: function StartLoading() {
      var timerInterval;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function StartLoading$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 3000,
                timerProgressBar: true,
                icon: 'info',
                // background: '#f39c12',
                timerProgressBarColor: "#00a65a",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onBeforeOpen: function onBeforeOpen() {
                  Swal.showLoading();
                  timerInterval = setInterval(function () {
                    var content = Swal.getContent();

                    if (content) {
                      var b = content.querySelector('b');

                      if (b) {
                        b.textContent = Swal.getTimerLeft();
                      }
                    }
                  }, 100);
                },
                onClose: function onClose() {
                  clearInterval(timerInterval);
                  $(".ContentSection").removeClass("DisabledSection");
                }
              }).then(function (result) {}));

            case 2:
            case "end":
              return _context.stop();
          }
        }
      });
    },
    removeDuplicates: function removeDuplicates() {
      var NamesDuplicate = this.form.PerilsName;

      var dup = _toConsumableArray(new Set(NamesDuplicate));

      this.form.PerilsName = dup; // alert();
    },
    IndividualOption: function IndividualOption() {
      //  let DataIndi = event.target.getAttribute('data-perils');
      //  this.form.IndividualPass = DataIndi;
      if (document.getElementById('cbIndividualOption').checked === true) {
        this.disabledtext = false;
        this.form.first_name = '';
        this.form.last_name = '';
        this.form.middle_name = '';
        this.form.registered_name = '';
        this.form.TINNumber = '';
        this.form.EmailAddress = '';
        this.form.ContactNumber = '';
        this.form.Individual = 'Others';
        this.form.IndividualPass = 'Others';
        $('#regname').show(); // alert("True");
      } else {
        this.disabledtext = true;
        this.form.first_name = this.UserDetails.first_name;
        this.form.last_name = this.UserDetails.last_name;
        this.form.middle_name = this.UserDetails.user_mname;
        this.form.EmailAddress = this.UserDetails.email;
        this.form.Individual = 'Individual';
        this.form.IndividualPass = 'Individual';
        $('#regname').hide();
      }
    },
    //UPdated by: Joleth
    //Updated date: 05/06/2020 : DenominationOnly() Removed
    setValueDenomination: function setValueDenomination(e) {
      var DenDomination = e.target.value.trim();
      var SliptDen = DenDomination + "-none-not";
      var SliptDenArr = SliptDen.split('-');

      if (SliptDenArr[1] === "none" && SliptDenArr[2] === "not") {
        this.form.Denomination = '2019-PC-0001;;' + DenDomination;
      } else {
        this.form.Denomination = '2019-PC-0001;;Car';
      }

      var valObj = this.DataDenominations.filter(function (elem) {
        if (elem.SubLinesName == DenDomination) return elem;
      });
      this.vallobj = valObj[0];
      this.form.Denomination = valObj[0].Class + ';;' + valObj[0].SubLinesName + ';;' + valObj[0].mvType + ';;' + valObj[0].mvPremType;
      this.form.DenominationDis = valObj[0].SubLinesName;
    },
    LoadUserData: function LoadUserData() {
      var _this2 = this;

      this.RetrieveTimeInterval = setInterval(function () {
        _this2.LoadDenomination();

        _this2.LoadCarAmounts();

        _this2.LoadCarBrands();

        _this2.LoadCarBodyType();

        _this2.LoadDefaultDate();

        _this2.LoadCoverages();

        _this2.LoadProvinces();

        _this2.LoadGetPremiumType();

        _this2.form.TINNumber = _this2.UserDetails.TINno;
        _this2.form.first_name = _this2.UserDetails.first_name;
        _this2.form.last_name = _this2.UserDetails.last_name;
        _this2.form.middle_name = _this2.UserDetails.user_mname;
        _this2.form.EmailAddress = _this2.UserDetails.email;
        _this2.form.ContactNumber = _this2.UserDetails.ContactNo;
        _this2.form.CustAcctNo = _this2.UserDetails.AccountNo;
        _this2.form.AcctName = _this2.UserDetails.CName;
        _this2.form.department = _this2.UserDetails.department;
      }, 500);
      this.RetrieveTimeInterval2 = setInterval(function () {
        clearInterval(_this2.RetrieveTimeInterval);
      }, 3000);
    },
    ShowHideCom: function ShowHideCom() {
      if (this.form.usages === 'Commercial Use') {
        this.form.PremiumTypeSave = '';
        this.ShowCommercial = true;
      } else {
        this.form.PremiumTypeSave = "1;;Private Cars (including jeeps and AUVs)";
        this.ShowCommercial = false;
      }
    },
    FocusPushRecordSub: function FocusPushRecordSub(peril) {
      var DataPerils = peril.PerilsNo; //event.target.getAttribute('data-perils');

      var DataPerilsName = peril.PerilsName; // alert(DataPerilsName);

      if (this.form.SubPerilsName[DataPerils] != false) {
        // if ( !(this.form.SubPerilsName[DataPerils])){
        // this.form.SubPerilsName.push(DataPerils);
        this.form.SubPerilsNameDis.push(DataPerilsName); // this.PerilsCheckbox = false;
      } else {
        //alert(DataPerilsName);
        //  this.form.SubPerilsName.splice(DataPerils, 1);
        this.form.SubPerilsNameDis.splice(DataPerilsName, 1);
      }
    },
    FocusPushRecord: function FocusPushRecord(peril) {
      var DataPerils = peril.PerilsNo; //event.target.getAttribute('data-perils');

      if (!this.form.PerilsName[DataPerils]) {
        if (DataPerils === '2019-OD-0003') {
          this.form.PerilsName.push('2019-TF-0002');
        }

        this.form.PerilsName.push(DataPerils);
        this.form.PerilsNameDis.push(peril.PerilsName); //this.PerilsCheckbox = false;
      } else {
        this.form.PerilsName.splice(DataPerils, 1);

        if (DataPerils === '2019-OD-0003') {
          this.form.PerilsName.splice('2019-TF-0002');
        }

        this.form.PerilsNameDis.splice(DataPerils, 1); //this.PerilsCheckbox = true;
      } //this.form.PerilsName['5db90f2951e2334594006bf8'] = true; ///check the perils
      // this.removeDuplicates();        

    },
    UnCheckAllPerils: function UnCheckAllPerils() {
      for (var i = 0; i < this.DataCoverages.length; i++) {
        var DefualtSel = this.DataCoverages[i].DefaultSel;
        var IDNO = void 0;
        var IDYES = void 0;

        if (DefualtSel !== 'YES') {
          IDNO = this.DataCoverages[i].PerilsNo;
          IDName = this.DataCoverages[i].PerilsName;
        } //  if (DefualtSel ==='YES'){
        //     IDYES = this.DataCoverages[i].PerilsNo;
        // }
        //if ( this.form.PerilsName[IDYES] == false) {  ///if array is empty


        if (!this.form.PerilsName['2019-CT-0001'] && !this.form.PerilsName['2019-OD-0003']) {
          ///if array is empty     
          //  alert(this.form.PerilsName[IDYES] );
          this.form.SubPerilsName[IDNO] = false; //uncheck

          this.form.CheckAll = false; // this.form.SubPerilsName[IDNO]

          this.PerilsCheckbox = true;
        } else {
          this.PerilsCheckbox = false;
        } // this.form.PerilsName[IDNO] = false;                          

      }
    },
    FocusCheckAllPerils: function FocusCheckAllPerils() {
      for (var i = 0; i < this.DataCoverages.length; i++) {
        var DefualtSel = this.DataCoverages[i].DefaultSel;
        var IDNO = void 0;

        var _IDName = void 0;

        var DataPerils = void 0;

        if (DefualtSel !== 'YES') {
          IDNO = this.DataCoverages[i].PerilsNo;
          _IDName = this.DataCoverages[i].PerilsName;
          this.form.SubPerilsName.splice(IDNO);
          this.form.SubPerilsNameDis.splice(_IDName);
        }
      }
    },
    CheckAllPerils: function CheckAllPerils() {
      //this.FocusCheckAllPerils();
      for (var i = 0; i < this.DataCoverages.length; i++) {
        var DefualtSel = this.DataCoverages[i].DefaultSel;
        var IDNO = void 0;

        var _IDName2 = void 0;

        var DataPerils = void 0;

        if (DefualtSel !== 'YES') {
          /// display on the perils that have YES
          IDNO = this.DataCoverages[i].PerilsNo;
          _IDName2 = this.DataCoverages[i].PerilsName;

          if (!this.form.CheckAll) {
            //if not empty
            this.form.SubPerilsName[IDNO] = true; //check
            //this.form.SubPerilsName.push(IDNO);     ////add into array

            this.form.SubPerilsNameDis.push(_IDName2);
          } else {
            this.form.SubPerilsName[IDNO] = false; //uncheck
            //this.form.SubPerilsName.splice(IDNO);   ///clear array

            this.form.SubPerilsNameDis.splice(_IDName2);
          }
        }
      }
    },
    alert: function (_alert) {
      function alert(_x) {
        return _alert.apply(this, arguments);
      }

      alert.toString = function () {
        return _alert.toString();
      };

      return alert;
    }(function (wew) {
      alert(wew);
    }),
    GetOnlyCheckPerils: function GetOnlyCheckPerils() {
      for (var i = 0; i < this.DataCoverages.length; i++) {
        var IDNO = this.DataCoverages[i].PerilsNo;

        if (this.form.SubPerilsName[IDNO] !== true) {//check
        } else {
          this.form.PerilsName.push(IDNO); //GetOnlyCheckPerils
        }
      } //  this.form.SubPerilsNameDis.push(this.form.PerilsName);

    },
    CombineAllPerils: function CombineAllPerils() {
      ///copy array into another array         
      var OrigArray = this.form.PerilsName;
      this.form.PerilsName = OrigArray.concat(this.form.SubPerilsName); //alert()
    },
    GetPerilsName: function GetPerilsName() {
      var TotalV = this.form.PerilsName.length;
      var IDNO;

      for (var i = 0; i < TotalV; i++) {
        IDNO = this.form.PerilsName[i]; //alert(IDNO);

        this.form.PerilsName[IDNO] = true;
      }
    },
    MotorRequestQuotation: function MotorRequestQuotation() {
      var _this3 = this;

      // this.form.post('api/quotation')
      // .then(res => {
      //   Swal.fire(
      //       'Successful!',
      //       `Quotaion has been submitted.`,
      //       'success'
      //   )
      //   console.log(res);
      //   //this.$router.push('/dashboard');
      //   this.$router.push("/proposal-lists-customer");
      // })
      // .catch(error => {
      //   console.log(error);
      // });
      if (!this.form.PlateNumber || this.form.PlateNumber === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Input Plate No.'
        });
      } else if (!this.form.Denomination || this.form.Denomination === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Denomination.'
        });
      } else if (parseFloat(this.form.POAMount, 2) < 10000) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select/ Input Car Purchased Amount / Market Value >= 10,000'
        });
      } else if (!this.form.POAMount || this.form.POAMount === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Car Purchased Amount / Market Value.'
        });
      } else if (!this.form.YearPO || this.form.YearPO === " " || parseFloat(this.form.YearPO, 2) < parseFloat(this.form.YearMinValue, 2)) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Year.'
        });
      } else if (!this.form.CarBrand || this.form.CarBrand === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Brand.'
        });
      } else if (!this.form.CarModel || this.form.CarModel === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Model.'
        });
      } else if (!this.form.BodyType || this.form.BodyType === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Body Type.'
        });
      } else if (!this.form.usages || this.form.usages === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Usages.'
        });
      } else if (!this.form.EffectiveDate || this.form.EffectiveDate === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select /Input Effective Date.'
        });
      } else if (!this.form.PerilsName.length) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select Coverages.'
        });
      } else if (!this.form.Address.length || this.form.EffectiveDate === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Input your Address.'
        });
      } else if (this.form.ContactNumber.length > 13) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Contact No. is maximum of 11 digits'
        });
      } else if (this.form.ContactNumber.length < 8) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Contact No. is minimum of 8 digits'
        });
      } else if (this.form.Individual === "Others" && this.form.registered_name === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Input the Registered Name'
        });
      } else if (this.form.PremiumTypeSave === " ") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select your Purposed Description'
        });
      } else {
        //this.CombineAllPerils();  //Combine all perilsname 
        this.GetOnlyCheckPerils();
        this.removeDuplicates();
        this.ComputeDepreciativeAmount();
        this.loading = true, Swal.fire({
          title: "Are you sure ?",
          text: "Add New Quotation Option",
          icon: "success",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes!"
        }).then(function (result) {
          //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
          if (result.value) {
            _this3.form.post("api/QuotationMotor").then(function () {
              Swal.fire(" Successfull....", "New Quotation Submitted", "success");

              _this3.$router.push("/proposal-lists-customer");
            })["catch"](function () {
              Swal.fire("Failed", "There was something wrong", "warning");
            });
          } else {
            _this3.$router.push("/request-form-new");
          }
        });
      }
    },
    LoadDenomination: function LoadDenomination() {
      var _this4 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadDenomination$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetDenomination").then(function (_ref2) {
                var data = _ref2.data;
                return _this4.DataDenominations = data;
              }));

            case 2:
            case "end":
              return _context2.stop();
          }
        }
      });
    },
    LoadGetPremiumType: function LoadGetPremiumType() {
      var _this5 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadGetPremiumType$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetPremiumType").then(function (_ref3) {
                var data = _ref3.data;
                return _this5.DataPremiumType = data;
              }));

            case 2:
            case "end":
              return _context3.stop();
          }
        }
      });
    },
    LoadCarAmounts: function LoadCarAmounts() {
      var res;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadCarAmounts$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              _context4.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get('api/CarAmounts'));

            case 2:
              res = _context4.sent;
              this.MarketValues = res.data; // this.filterValues()

            case 4:
            case "end":
              return _context4.stop();
          }
        }
      }, null, this);
    },
    LoadCarBrands: function LoadCarBrands() {
      var _this6 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadCarBrands$(_context5) {
        while (1) {
          switch (_context5.prev = _context5.next) {
            case 0:
              _context5.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetCarBrands").then(function (_ref4) {
                var data = _ref4.data;
                return _this6.DataCarBrands = data;
              }));

            case 2:
            case "end":
              return _context5.stop();
          }
        }
      });
    },
    LoadCarBodyType: function LoadCarBodyType() {
      var _this7 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadCarBodyType$(_context6) {
        while (1) {
          switch (_context6.prev = _context6.next) {
            case 0:
              _context6.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetCarBodyTypes").then(function (_ref5) {
                var data = _ref5.data;
                return _this7.DataCarBodyType = data;
              }));

            case 2:
            case "end":
              return _context6.stop();
          }
        }
      });
    },
    LoadSurcharges: function LoadSurcharges() {
      var _this8 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadSurcharges$(_context7) {
        while (1) {
          switch (_context7.prev = _context7.next) {
            case 0:
              _context7.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetSurcharges").then(function (_ref6) {
                var data = _ref6.data;
                return _this8.DataSurcharges = data;
              }));

            case 2:
            case "end":
              return _context7.stop();
          }
        }
      });
    },
    LoadCoverages: function LoadCoverages() {
      var _this9 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadCoverages$(_context8) {
        while (1) {
          switch (_context8.prev = _context8.next) {
            case 0:
              _context8.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetPerils").then(function (_ref7) {
                var data = _ref7.data;
                return _this9.DataCoverages = data;
              }));

            case 2:
            case "end":
              return _context8.stop();
          }
        }
      });
    },
    // async LoadCities() {
    //     await axios.get("api/GetCities").then(({ data }) => (this.DataCities= data));
    // },
    LoadProvinces: function LoadProvinces() {
      var _this10 = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function LoadProvinces$(_context9) {
        while (1) {
          switch (_context9.prev = _context9.next) {
            case 0:
              _context9.next = 2;
              return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios.get("api/GetProvinces").then(function (_ref8) {
                var data = _ref8.data;
                return _this10.DataProvinces = data;
              }));

            case 2:
            case "end":
              return _context9.stop();
          }
        }
      });
    },
    LoadDataSurcharges: function LoadDataSurcharges() {
      if (this.ShowSurcharges === true) {
        this.ShowSurcharges = false;
      } else {
        this.ShowSurcharges = true;
        this.LoadSurcharges();
      } // alert();

    },
    LoadDefaultDate: function LoadDefaultDate() {
      var dateCurrent = new Date();
      var dayCurrent = dateCurrent.getDate();
      var monthCurrent = dateCurrent.getMonth() + 1;
      var year = dateCurrent.getFullYear();
      var yearAdd = dateCurrent.getFullYear() + 1;
      var monthAdd = dateCurrent.getMonth() + 1;
      var dayAdd = dateCurrent.getDate();
      this.form.ExpiryDate = "".concat(monthAdd, "/").concat(dayAdd, "/").concat(yearAdd);
      this.form.EffectiveDate = "".concat(monthCurrent, "/").concat(dayCurrent, "/").concat(year);
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    setValue: function setValue(e) {
      if (e.target.value === "Others") {
        this.OtherCarAmount = true;
      } else {
        this.OtherCarAmount = false;
        this.txtOtherCarAmount = '';
        this.form.POAMount = e.target.value;
        this.ComputeDepreciativeAmount();
      }
    },
    setValueOtherCarAmount: function setValueOtherCarAmount() {
      var amount = this.txtOtherCarAmount;
      this.form.POAMount = amount;
      this.ComputeDepreciativeAmount();
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    setValueYear: function setValueYear(e) {
      this.form.YearPO = e.target.value;
      this.ComputeDepreciativeAmount();
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    ComputeDepreciativeAmount: function ComputeDepreciativeAmount() {
      var amount = this.form.POAMount;
      var CurrentYear = new Date().getFullYear();
      var NumberYear;

      if (!this.form.YearPO) {
        ///if YearPO is Empty
        NumberYear = 1; //default amount for current
      } else {
        NumberYear = parseFloat(CurrentYear - this.form.YearPO);
      }

      var DepreciativeAmount = 0;

      if (!amount) {
        ///if POamount is Empty
        amount = 100000; //default amount

        DepreciativeAmount = parseFloat(amount - amount * (NumberYear * 0.10));
      } else {
        DepreciativeAmount = parseFloat(amount - amount * (NumberYear * 0.10));
      }

      this.form.DepreciativeAmount = parseFloat(DepreciativeAmount, 2);
      this.form.DepreciativeNumberYear = parseFloat(NumberYear, 2);

      if (parseFloat(this.form.POAMount, 2) < 10000) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select/ Input Car Purchased Amount / Market Value >= 10,000'
        });
        this.form.POAMount = 10000;
      }

      if (parseFloat(this.form.YearPO, 2) < parseFloat(this.form.YearMinValue, 2) || parseFloat(this.form.YearPO, 2) > parseFloat(this.form.YearCurrentValue, 2)) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Pls. Select/ Input Year Model Between ' + this.form.YearMinValue + " AND " + this.form.YearCurrentValue + " otherwise call our telephone no. 8-243-0261 loc.139 or 213"
        });
        this.form.YearPO = this.form.YearMinValue;
      }
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    setValueCarBrands: function setValueCarBrands(e) {
      var _this11 = this;

      if (e.target.value === "Others") {
        this.OtherBrand = true;
        this.OtherModel = true;
        this.ddCarModel = "Others";
        this.txtOtherBrand = '';
        this.txtOtherModel = '';
      } else {
        this.OtherBrand = false;
        this.OtherModel = false;
        this.ddCarModel = "0";
        this.form.CarBrand = e.target.value;
        var PassBrandName = this.form.CarBrand;
        axios.get("api/GetCarModels/" + PassBrandName).then(function (_ref9) {
          var data = _ref9.data;
          return _this11.DataCarModelsList = data;
        });
      }
    },
    //Added by: Joleth
    //Added date: 06/05/2020
    setValueOtherBrand: function setValueOtherBrand() {
      this.form.CarBrand = this.txtOtherBrand;
    },
    setValueOtherModel: function setValueOtherModel() {
      this.form.CarModel = this.txtOtherModel;
    },
    setValueOtherBodyType: function setValueOtherBodyType() {
      this.form.BodyType = this.txtOtherBodyType;
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    setValueCarModel: function setValueCarModel(e) {
      if (e.target.value === "Others") {
        this.OtherModel = true;
        this.txtOtherModel = '';
      } else {
        this.OtherModel = false;
        this.form.CarModel = e.target.value;
      }
    },
    //updated by: Joleth
    //updated date: 06/05/2020
    setValueCarBodyType: function setValueCarBodyType(e) {
      if (e.target.value === "Others") {
        this.OtherBodyType = true;
        this.txtOtherBodyType = '';
      } else {
        this.OtherBodyType = false;
        this.form.BodyType = e.target.value;
      }
    },
    //Updated by: Joleth
    //Updated date: 06/05/2020
    setValuePropertyProvince: function setValuePropertyProvince() {
      var _this12 = this;

      if (this.ddProvince === "Others") {
        this.OtherProvince = true;
        this.OtherCity = true;
        this.OtherBarangay = true;
        this.ddCity = "Others";
        this.ddBarangay = "Others";
        this.txtOtherProvince = '';
        this.txtOtherCity = '';
        this.txtOtherBarangay = '';
      } else {
        this.OtherProvince = false;
        this.OtherCity = false;
        this.OtherBarangay = false;
        this.ddCity = "0";
        this.ddBarangay = "0";
        this.form.ProvName = this.ddProvince.text;
        var PassProvCode = this.ddProvince.id;
        axios.get("api/GetCities/" + PassProvCode).then(function (_ref10) {
          var data = _ref10.data;
          return _this12.DataCities = data;
        });
      }
    },
    //updated by: Joleth
    //updated date: 05/19/2020
    setValuePropertyCity: function setValuePropertyCity() {
      var _this13 = this;

      if (this.ddCity === "Others") {
        this.OtherCity = true;
        this.OtherBarangay = true;
        this.ddBarangay = "Others";
        this.txtOtherCity = '';
        this.txtOtherBarangay = '';
      } else {
        this.OtherCity = false;
        this.OtherBarangay = false;
        this.ddBarangay = "0";
        this.form.CityName = this.ddCity.text;
        var PassCityCode = this.ddCity.id;
        axios.get("api/GetBarangays/" + PassCityCode).then(function (_ref11) {
          var data = _ref11.data;
          return _this13.DataListBrgy = data;
        });
      }
    },
    setValueBarangay: function setValueBarangay(e) {
      if (this.ddBarangay === "Others") {
        this.OtherBarangay = true;
        this.ddBarangay = "Others";
        this.txtOtherBarangay = '';
      } else {
        this.OtherBarangay = false;
        this.form.Barangay = e.target.value;
      }
    },
    //Added by: Joleth
    //Added date: 06/05/2020
    setValueOtherProvince: function setValueOtherProvince() {
      this.form.ProvName = this.txtOtherProvince;
    },
    setValueOtherCity: function setValueOtherCity() {
      this.form.CityName = this.txtOtherCity;
    },
    setValueOtherBarangay: function setValueOtherBarangay() {
      this.form.Barangay = this.txtOtherBarangay;
    },
    openForm: function openForm() {
      document.getElementById("myForm").style.display = "block";
      this.GetOnlyCheckPerils(); //this.removeDuplicates();
    },
    closeForm: function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
  },
  watch: {
    year: function year(val) {
      this.$emit('year', val);
    },
    effectiveDate: function effectiveDate(val) {
      var dateCurrent = new Date(val);
      var dayCurrent = dateCurrent.getDate();
      var monthCurrent = dateCurrent.getMonth() + 1;
      var yearOld = dateCurrent.getFullYear();
      var date = new Date(val);
      var year = date.getFullYear() + 1;
      var month = date.getMonth() + 1;
      var day = date.getDate();
      this.form.ExpiryDate = "".concat(month, "/").concat(day, "/").concat(year);
      this.form.EffectiveDate = "".concat(monthCurrent, "/").concat(day, "/").concat(yearOld);
    }
  },
  computed: {
    yearD: function yearD() {
      var year = new Date().getFullYear(); //return Array.from({length: year - 1900}, (value, index) => 1901 + index)
      // sortArrays(year) {

      var MinusYear = year - 10;
      this.form.YearMinValue = parseFloat(MinusYear + 1);
      this.form.YearCurrentValue = parseFloat(year);
      return Array.from({
        length: year - MinusYear
      }, function (value, index) {
        return year - index;
      }); // }
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.custom[data-v-57c10da6] {\r\n  overflow: auto;\r\n  max-height: 200px;\r\n  position: absolute;\r\n  z-index: 10;\r\n  background: #fff;\r\n  width: 95%;\r\n  color: black;\r\n  margin-right: 1rem;\n}\nul[data-v-57c10da6] {\r\n  list-style: none;\r\n  padding: 1rem;\r\n  cursor: pointer;\n}\nli[data-v-57c10da6]:hover {\r\n    color: red;\r\n    background-color: #a5b1c2;\n}\r\n\r\n/* Button used to open the chat form - fixed at the bottom of the page */\n.open-button[data-v-57c10da6] {\r\n  background-color: green;\r\n  color: white;\r\n  padding: 10px 10px;\r\n  border: none;\r\n  cursor: pointer;\r\n  opacity: 0.8;\r\n  position: fixed;\r\n  bottom: 50px;\r\n  right: 28px;\r\n  width: 280px;\r\n  border-radius: 25px;\n}\r\n\r\n/* The popup chat - hidden by default */\n.chat-popup[data-v-57c10da6] {\r\n  display: none;\r\n  position: fixed;\r\n  bottom: 50px;\r\n  right: 15px;\r\n  border: 1px solid #f1f1f1;\r\n  z-index: 9;\r\n  border-radius: 10px;\n}\r\n\r\n/* Add styles to the form container */\n.form-container[data-v-57c10da6] {\r\n  width: 550px;\r\n  max-width: 500px;\r\n  padding: 10px;\r\n  background-color: white;\r\n  display: inline-block;\n}\r\n\r\n/* Full-width textarea */\r\n/* .form-container textarea {\r\n  width: 100%;\r\n  padding: 15px;\r\n  margin: 5px 0 22px 0;\r\n  border: none;\r\n  background: #f1f1f1;\r\n  resize: none;\r\n  min-height: 200px;\r\n} */\r\n\r\n/* When the textarea gets focus, do something */\r\n/* .form-container textarea:focus {\r\n  background-color: #ddd;\r\n  outline: none;\r\n} */\r\n\r\n/* Set a style for the submit/send button */\n.form-container .btn[data-v-57c10da6] {\r\n  background-color: #4CAF50;\r\n  color: white;\r\n  padding: 10px 10px;\r\n  border: none;\r\n  cursor: pointer;\r\n  width: 100%;\r\n  margin-bottom:10px;\r\n  opacity: 0.8;\n}\r\n\r\n/* Add a red background color to the cancel button */\n.form-container .cancel[data-v-57c10da6] {\r\n  background-color: red;\r\n  border-radius: 25px;\n}\r\n\r\n/* Add some hover effects to buttons */\n.form-container .btn[data-v-57c10da6]:hover, .open-button[data-v-57c10da6]:hover {\r\n  opacity: 1;\n}\n#quoteslogo[data-v-57c10da6] {\r\n    width: 125px;\n}\n.label-guide[data-v-57c10da6]{\r\n    color:#fff;\r\n    background:#bfbfbf;\n}\n.label-guide-2[data-v-57c10da6]{\r\n    color:#fff;\r\n    background:#a6a6a6;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true& ***!
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
  return _c("div", { attrs: { id: "MainPage" } }, [
    _c("section", { staticClass: "content DisabledSection ContentSection" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-12" }, [
          _c("div", { staticClass: "box box-success" }, [
            _c("div", { staticClass: "box-header with-border" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "a",
                {
                  attrs: {
                    "data-toggle": "tooltip",
                    "data-placement": "right",
                    title:
                      "Your Motor Car details can be found on your Certificate of Registration (CR)"
                  }
                },
                [
                  _c("big", { staticClass: "label label-guide" }, [
                    _c("i", { staticClass: "fa fa-info" })
                  ])
                ],
                1
              )
            ]),
            _vm._v(" "),
            _c(
              "form",
              {
                attrs: { enctype: "multipart/form-data" },
                on: {
                  submit: function($event) {
                    $event.preventDefault()
                    return _vm.MotorRequestQuotation()
                  }
                }
              },
              [
                _c("div", { staticClass: "box-body" }, [
                  _c("div", { staticClass: "form-group row" }, [
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "label",
                        { staticClass: " col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(
                            " Plate Number:  \r\n                            "
                          ),
                          _c(
                            "a",
                            {
                              attrs: {
                                "data-toggle": "tooltip",
                                "data-placement": "right",
                                title:
                                  "Pls. input Plate Number / Temporary / Conduction Sticker"
                              }
                            },
                            [
                              _c("big", { staticClass: "label label-guide" }, [
                                _c("i", { staticClass: "fa fa-info" })
                              ])
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.PlateNumber,
                            expression: "form.PlateNumber"
                          }
                        ],
                        staticClass: "form-control",
                        staticStyle: { "text-transform": "uppercase" },
                        attrs: {
                          type: "text",
                          placeholder: "Plate Number",
                          required: ""
                        },
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
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Denomination:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select DENOMINATION"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.DenominationDis,
                                expression: "form.DenominationDis"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
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
                                    "DenominationDis",
                                    $event.target.multiple
                                      ? $$selectedVal
                                      : $$selectedVal[0]
                                  )
                                },
                                function($event) {
                                  return _vm.setValueDenomination($event)
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Denomination")]
                            ),
                            _vm._v(" "),
                            _vm._l(_vm.DataDenominations, function(value) {
                              return _c("option", { key: value._id }, [
                                _vm._v(_vm._s(value.SubLinesName))
                              ])
                            })
                          ],
                          2
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "div",
                        { staticClass: "form-group" },
                        [
                          _c(
                            "label",
                            [
                              _c("big", { staticStyle: { color: "red" } }, [
                                _vm._v(" * ")
                              ]),
                              _vm._v("Car Purchased Amount / Market Value:")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              attrs: {
                                "data-toggle": "tooltip",
                                "data-placement": "right",
                                title: "Pls. Select PURCHASED AMOUNT"
                              }
                            },
                            [
                              _c("big", { staticClass: "label label-guide" }, [
                                _c("i", { staticClass: "fa fa-info" })
                              ])
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "select",
                            {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.ddCarAmount,
                                  expression: "ddCarAmount"
                                }
                              ],
                              staticClass: "form-control",
                              staticStyle: { "margin-bottom": "5px" },
                              on: {
                                change: [
                                  function($event) {
                                    var $$selectedVal = Array.prototype.filter
                                      .call($event.target.options, function(o) {
                                        return o.selected
                                      })
                                      .map(function(o) {
                                        var val =
                                          "_value" in o ? o._value : o.value
                                        return val
                                      })
                                    _vm.ddCarAmount = $event.target.multiple
                                      ? $$selectedVal
                                      : $$selectedVal[0]
                                  },
                                  function($event) {
                                    return _vm.setValue($event)
                                  }
                                ]
                              }
                            },
                            [
                              _c(
                                "option",
                                { attrs: { value: "0", disabled: "" } },
                                [_vm._v("Select Amount")]
                              ),
                              _vm._v(" "),
                              _c("option", { attrs: { value: "Others" } }, [
                                _vm._v("Others")
                              ]),
                              _vm._v(" "),
                              _vm._l(_vm.MarketValues, function(value) {
                                return _c(
                                  "option",
                                  { domProps: { value: value.CarAmount } },
                                  [
                                    _vm._v(
                                      _vm._s(_vm._f("Peso")(value.CarAmount))
                                    )
                                  ]
                                )
                              })
                            ],
                            2
                          ),
                          _vm._v(" "),
                          _c(
                            "v-money-spinner",
                            _vm._b(
                              {
                                directives: [
                                  {
                                    name: "show",
                                    rawName: "v-show",
                                    value: _vm.OtherCarAmount,
                                    expression: "OtherCarAmount"
                                  }
                                ],
                                nativeOn: {
                                  change: function($event) {
                                    return _vm.setValueOtherCarAmount()
                                  }
                                },
                                model: {
                                  value: _vm.txtOtherCarAmount,
                                  callback: function($$v) {
                                    _vm.txtOtherCarAmount = $$v
                                  },
                                  expression: "txtOtherCarAmount"
                                }
                              },
                              "v-money-spinner",
                              _vm.config,
                              false
                            )
                          ),
                          _vm._v(" "),
                          _c("small", { staticClass: "label label-guide-2" }, [
                            _vm._v(
                              "Depreciation Amount : " +
                                _vm._s(
                                  _vm._f("Peso")(_vm.form.DepreciativeAmount)
                                )
                            )
                          ])
                        ],
                        1
                      )
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c(
                      "div",
                      { staticClass: "col-sm-3" },
                      [
                        _c("div", { staticClass: "form-group" }, [
                          _c(
                            "label",
                            [
                              _c("big", { staticStyle: { color: "red" } }, [
                                _vm._v(" * ")
                              ]),
                              _vm._v("Year:")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              attrs: {
                                "data-toggle": "tooltip",
                                "data-placement": "right",
                                title: "Pls. Select PURCHASED YEAR"
                              }
                            },
                            [
                              _c("big", { staticClass: "label label-guide" }, [
                                _c("i", { staticClass: "fa fa-info" })
                              ])
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "select",
                            {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.YearPO,
                                  expression: "form.YearPO"
                                }
                              ],
                              staticClass: "form-control",
                              on: {
                                change: [
                                  function($event) {
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
                                      "YearPO",
                                      $event.target.multiple
                                        ? $$selectedVal
                                        : $$selectedVal[0]
                                    )
                                  },
                                  function($event) {
                                    return _vm.setValueYear($event)
                                  }
                                ]
                              }
                            },
                            _vm._l(_vm.yearD, function(yearDs) {
                              return _c(
                                "option",
                                { key: yearDs, domProps: { value: yearDs } },
                                [_vm._v(_vm._s(yearDs))]
                              )
                            }),
                            0
                          )
                        ]),
                        _vm._v(" "),
                        _c("big", { staticClass: "label label-guide" }, [
                          _vm._v(
                            "Min. Year: " +
                              _vm._s(_vm.form.YearMinValue) +
                              " To Be Accepted, "
                          ),
                          _c("br"),
                          _vm._v(
                            " otherwise call our telephone no. 8-243-0261 loc.139 or 213"
                          )
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Brand:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select BRAND / MAKE"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddCarBrand,
                                expression: "ddCarBrand"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddCarBrand = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValueCarBrands($event)
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Brand / Make")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataCarBrands, function(DataCarBrandss) {
                              return _c(
                                "option",
                                {
                                  key: DataCarBrandss._id,
                                  domProps: { value: DataCarBrandss.BrandName }
                                },
                                [_vm._v(_vm._s(DataCarBrandss.BrandName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherBrand,
                              expression: "OtherBrand"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherBrand,
                              expression: "txtOtherBrand"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherBrand },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherBrand()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherBrand = $event.target.value
                            }
                          }
                        })
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Model:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select MODEL / SERIES"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddCarModel,
                                expression: "ddCarModel"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddCarModel = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValueCarModel($event)
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Model / Series")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataCarModelsList, function(
                              DataCarModelss
                            ) {
                              return _c(
                                "option",
                                {
                                  key: DataCarModelss._id,
                                  domProps: { value: DataCarModelss.ModelName }
                                },
                                [_vm._v(_vm._s(DataCarModelss.ModelName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherModel,
                              expression: "OtherModel"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherModel,
                              expression: "txtOtherModel"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherModel },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherModel()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherModel = $event.target.value
                            }
                          }
                        })
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Body Type:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select BODY TYPE"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddBodyType,
                                expression: "ddBodyType"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddBodyType = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValueCarBodyType($event)
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Body Type")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataCarBodyType, function(
                              DataCarBodyTypes
                            ) {
                              return _c(
                                "option",
                                {
                                  key: DataCarBodyTypes,
                                  domProps: {
                                    value: DataCarBodyTypes.BodyTypeName
                                  }
                                },
                                [_vm._v(_vm._s(DataCarBodyTypes.BodyTypeName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherBodyType,
                              expression: "OtherBodyType"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherBodyType,
                              expression: "txtOtherBodyType"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherBodyType },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherBodyType()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherBodyType = $event.target.value
                            }
                          }
                        })
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("div", { staticClass: "col-sm-3" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" Usage  ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title:
                              "Pls. Select USAGE on the list, FOR COMMERCIAL USE-->select Net Weight and check Accessories"
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.usages,
                              expression: "form.usages"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: { required: "" },
                          on: {
                            change: [
                              function($event) {
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
                                  "usages",
                                  $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                )
                              },
                              function($event) {
                                return _vm.ShowHideCom()
                              }
                            ]
                          }
                        },
                        [
                          _c(
                            "option",
                            { attrs: { selected: "", disabled: "" } },
                            [_vm._v(" Pls.Select")]
                          ),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "Personnal Use" } }, [
                            _vm._v(" Personal Use")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "Commercial Use" } }, [
                            _vm._v("  Commercial Use")
                          ])
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          staticClass: "label label-guide-2",
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "View more usage /s"
                          },
                          on: {
                            click: function($event) {
                              return _vm.LoadDataSurcharges()
                            }
                          }
                        },
                        [_vm._v("Other Usage ... ")]
                      )
                    ]),
                    _vm._v(" "),
                    _vm.ShowCommercial
                      ? _c("div", { staticClass: "col-sm-3" }, [
                          _c(
                            "label",
                            { staticClass: "col-form-label" },
                            [
                              _c("big", { staticStyle: { color: "red" } }, [
                                _vm._v(" * ")
                              ]),
                              _vm._v("Purposed Description:  ")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "select",
                            {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.PremiumTypeSave,
                                  expression: "form.PremiumTypeSave"
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
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.$set(
                                    _vm.form,
                                    "PremiumTypeSave",
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
                                    disabled: "",
                                    selected: ""
                                  }
                                },
                                [_vm._v(" Pls.Select")]
                              ),
                              _vm._v(" "),
                              _vm._l(_vm.DataPremiumType.data, function(
                                DataPremiumTypes
                              ) {
                                return _c(
                                  "option",
                                  {
                                    key: DataPremiumTypes._id,
                                    domProps: {
                                      value:
                                        DataPremiumTypes.Type +
                                        ";;" +
                                        DataPremiumTypes.Description
                                    }
                                  },
                                  [
                                    _vm._v(
                                      " " + _vm._s(DataPremiumTypes.Description)
                                    )
                                  ]
                                )
                              })
                            ],
                            2
                          )
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.ShowCommercial
                      ? _c("div", { staticClass: "col-sm-3" }, [
                          _c("label", { staticClass: "col-form-label" }, [
                            _vm._v("Net Weight:  ")
                          ]),
                          _vm._v(" "),
                          _c(
                            "select",
                            {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.form.MotorNetWeight,
                                  expression: "form.MotorNetWeight"
                                }
                              ],
                              staticClass: "form-control",
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
                                    "MotorNetWeight",
                                    $event.target.multiple
                                      ? $$selectedVal
                                      : $$selectedVal[0]
                                  )
                                }
                              }
                            },
                            [
                              _c("option", { attrs: { value: "" } }, [
                                _vm._v(" Pls.Select")
                              ]),
                              _vm._v(" "),
                              _c(
                                "option",
                                { attrs: { value: "Less than 3,930 kg" } },
                                [_vm._v(" Less than 3,930 kg")]
                              ),
                              _vm._v(" "),
                              _c(
                                "option",
                                { attrs: { value: "Over 3,930 kg" } },
                                [_vm._v("Over 3,930 kg")]
                              )
                            ]
                          )
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.ShowCommercial
                      ? _c("div", { staticClass: "col-sm-3" }, [
                          _c("label", { staticClass: "col-form-label" }, [
                            _vm._v("    Check if you have accessories: ")
                          ]),
                          _c("br"),
                          _vm._v(" "),
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.form.MotorAccessories,
                                expression: "form.MotorAccessories"
                              }
                            ],
                            attrs: { id: "accessories", type: "checkbox" },
                            domProps: {
                              checked: Array.isArray(_vm.form.MotorAccessories)
                                ? _vm._i(_vm.form.MotorAccessories, null) > -1
                                : _vm.form.MotorAccessories
                            },
                            on: {
                              change: [
                                function($event) {
                                  var $$a = _vm.form.MotorAccessories,
                                    $$el = $event.target,
                                    $$c = $$el.checked ? true : false
                                  if (Array.isArray($$a)) {
                                    var $$v = null,
                                      $$i = _vm._i($$a, $$v)
                                    if ($$el.checked) {
                                      $$i < 0 &&
                                        _vm.$set(
                                          _vm.form,
                                          "MotorAccessories",
                                          $$a.concat([$$v])
                                        )
                                    } else {
                                      $$i > -1 &&
                                        _vm.$set(
                                          _vm.form,
                                          "MotorAccessories",
                                          $$a
                                            .slice(0, $$i)
                                            .concat($$a.slice($$i + 1))
                                        )
                                    }
                                  } else {
                                    _vm.$set(_vm.form, "MotorAccessories", $$c)
                                  }
                                },
                                _vm.onChange
                              ]
                            }
                          }),
                          _vm._v(" "),
                          _c("label", { attrs: { for: "accessories" } }, [
                            _vm._v("With Accessories")
                          ]),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              attrs: {
                                "data-toggle": "tooltip",
                                "data-placement": "right",
                                title:
                                  "Accessories are for approval basis. Accessories: Aircon, Stereo, Speakers, 5 Wheels"
                              }
                            },
                            [
                              _c("big", { staticClass: "label label-guide" }, [
                                _c("i", { staticClass: "fa fa-info" })
                              ])
                            ],
                            1
                          )
                        ])
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _vm.ShowSurcharges
                    ? _c(
                        "div",
                        { staticClass: "form-group row" },
                        _vm._l(_vm.DataSurcharges, function(surcharge) {
                          return _c(
                            "div",
                            { key: surcharge._id, staticClass: "col-md-4" },
                            [
                              _c(
                                "div",
                                {
                                  staticClass: "form-group",
                                  staticStyle: { "margin-bottom": "0" }
                                },
                                [
                                  _c("input", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value: _vm.form.SurchageList,
                                        expression: "form.SurchageList"
                                      }
                                    ],
                                    attrs: {
                                      type: "checkbox",
                                      id: surcharge._id
                                    },
                                    domProps: {
                                      value: surcharge.SurchargeName,
                                      checked: Array.isArray(
                                        _vm.form.SurchageList
                                      )
                                        ? _vm._i(
                                            _vm.form.SurchageList,
                                            surcharge.SurchargeName
                                          ) > -1
                                        : _vm.form.SurchageList
                                    },
                                    on: {
                                      change: function($event) {
                                        var $$a = _vm.form.SurchageList,
                                          $$el = $event.target,
                                          $$c = $$el.checked ? true : false
                                        if (Array.isArray($$a)) {
                                          var $$v = surcharge.SurchargeName,
                                            $$i = _vm._i($$a, $$v)
                                          if ($$el.checked) {
                                            $$i < 0 &&
                                              _vm.$set(
                                                _vm.form,
                                                "SurchageList",
                                                $$a.concat([$$v])
                                              )
                                          } else {
                                            $$i > -1 &&
                                              _vm.$set(
                                                _vm.form,
                                                "SurchageList",
                                                $$a
                                                  .slice(0, $$i)
                                                  .concat($$a.slice($$i + 1))
                                              )
                                          }
                                        } else {
                                          _vm.$set(
                                            _vm.form,
                                            "SurchageList",
                                            $$c
                                          )
                                        }
                                      }
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c(
                                    "label",
                                    {
                                      staticStyle: { "font-weight": "500" },
                                      attrs: { for: surcharge._id }
                                    },
                                    [_vm._v(_vm._s(surcharge.SurchargeName))]
                                  )
                                ]
                              )
                            ]
                          )
                        }),
                        0
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("div", { staticClass: "col-sm-2" }, [
                      _c("label", { staticClass: "col-form-label" }, [
                        _vm._v("Effective Date  :")
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title:
                              "Current Date is  a DEFAULT date for a EFFECTIVE DATE otherwise SPECIFY"
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "span",
                        {
                          staticClass: "label label-guide-2",
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "Current Date is a Defualt Date "
                          }
                        },
                        [_vm._v(_vm._s(_vm.form.EffectiveDate) + " ")]
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.effectiveDate,
                            expression: "effectiveDate"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "date",
                          "data-toggle": "tooltip",
                          "data-placement": "right",
                          title: "Change the EFFECTIVE DATE"
                        },
                        domProps: { value: _vm.effectiveDate },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.effectiveDate = $event.target.value
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "label",
                        {
                          staticClass: "col-form-label",
                          attrs: { for: "inputPassword" }
                        },
                        [_vm._v("Expiry Date : ")]
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "EXPIRATION DATE of the Policy "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("span", { staticClass: "label label-guide-2" }, [
                        _vm._v(_vm._s(_vm.form.ExpiryDate) + " ")
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-10" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v("Coverages:")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "Pls. Select COVERAGES on the List "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "form-group row container" },
                        [
                          _vm._l(_vm.DataCoverages, function(peril) {
                            return _c(
                              "div",
                              {
                                key: peril._id,
                                staticStyle: { float: "left", width: "25%" }
                              },
                              [
                                peril.DefaultSel === "YES"
                                  ? _c(
                                      "div",
                                      {
                                        staticClass: "form-group col-md-12",
                                        staticStyle: { "margin-bottom": "0" }
                                      },
                                      [
                                        _c("input", {
                                          directives: [
                                            {
                                              name: "model",
                                              rawName: "v-model",
                                              value:
                                                _vm.form.PerilsName[
                                                  peril.PerilsNo
                                                ],
                                              expression:
                                                "form.PerilsName[peril.PerilsNo]"
                                            }
                                          ],
                                          attrs: {
                                            id: peril._id,
                                            type: "checkbox",
                                            "data-perils": peril.PerilsNo
                                          },
                                          domProps: {
                                            checked: Array.isArray(
                                              _vm.form.PerilsName[
                                                peril.PerilsNo
                                              ]
                                            )
                                              ? _vm._i(
                                                  _vm.form.PerilsName[
                                                    peril.PerilsNo
                                                  ],
                                                  null
                                                ) > -1
                                              : _vm.form.PerilsName[
                                                  peril.PerilsNo
                                                ]
                                          },
                                          on: {
                                            mouseout: function($event) {
                                              return _vm.UnCheckAllPerils()
                                            },
                                            click: function($event) {
                                              return _vm.FocusPushRecord(peril)
                                            },
                                            change: function($event) {
                                              var $$a =
                                                  _vm.form.PerilsName[
                                                    peril.PerilsNo
                                                  ],
                                                $$el = $event.target,
                                                $$c = $$el.checked
                                                  ? true
                                                  : false
                                              if (Array.isArray($$a)) {
                                                var $$v = null,
                                                  $$i = _vm._i($$a, $$v)
                                                if ($$el.checked) {
                                                  $$i < 0 &&
                                                    _vm.$set(
                                                      _vm.form.PerilsName,
                                                      peril.PerilsNo,
                                                      $$a.concat([$$v])
                                                    )
                                                } else {
                                                  $$i > -1 &&
                                                    _vm.$set(
                                                      _vm.form.PerilsName,
                                                      peril.PerilsNo,
                                                      $$a
                                                        .slice(0, $$i)
                                                        .concat(
                                                          $$a.slice($$i + 1)
                                                        )
                                                    )
                                                }
                                              } else {
                                                _vm.$set(
                                                  _vm.form.PerilsName,
                                                  peril.PerilsNo,
                                                  $$c
                                                )
                                              }
                                            }
                                          }
                                        }),
                                        _vm._v(" "),
                                        _c(
                                          "label",
                                          {
                                            staticStyle: {
                                              "font-weight": "500"
                                            },
                                            attrs: {
                                              id: "peril",
                                              for: peril._id
                                            }
                                          },
                                          [_vm._v(_vm._s(peril.PerilsName))]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "a",
                                          {
                                            attrs: {
                                              "data-toggle": "tooltip",
                                              "data-placement": "right",
                                              title:
                                                "Pls. Select to ENABLE the other COVERAGES "
                                            }
                                          },
                                          [
                                            _c(
                                              "big",
                                              {
                                                staticClass: "label label-guide"
                                              },
                                              [
                                                _c("i", {
                                                  staticClass: "fa fa-info"
                                                })
                                              ]
                                            )
                                          ],
                                          1
                                        )
                                      ]
                                    )
                                  : _vm._e()
                              ]
                            )
                          }),
                          _vm._v(" "),
                          _c("br"),
                          _c("br"),
                          _vm._v(" "),
                          _vm._l(_vm.DataCoverages, function(peril) {
                            return _c(
                              "div",
                              {
                                key: peril._id,
                                staticStyle: {
                                  float: "right",
                                  width: "55%",
                                  display: "block"
                                },
                                on: {
                                  mouseover: function($event) {
                                    return _vm.UnCheckAllPerils()
                                  }
                                }
                              },
                              [
                                peril.DefaultSel !== "YES"
                                  ? _c(
                                      "div",
                                      {
                                        staticClass: "form-group col-md-12",
                                        staticStyle: { "margin-bottom": "0" }
                                      },
                                      [
                                        _c("input", {
                                          directives: [
                                            {
                                              name: "model",
                                              rawName: "v-model",
                                              value:
                                                _vm.form.SubPerilsName[
                                                  peril.PerilsNo
                                                ],
                                              expression:
                                                "form.SubPerilsName[peril.PerilsNo]"
                                            }
                                          ],
                                          attrs: {
                                            id: peril._id,
                                            type: "checkbox",
                                            disabled: _vm.PerilsCheckbox,
                                            "data-perils": peril.PerilsNo
                                          },
                                          domProps: {
                                            checked: _vm.SubPerilsName,
                                            checked: Array.isArray(
                                              _vm.form.SubPerilsName[
                                                peril.PerilsNo
                                              ]
                                            )
                                              ? _vm._i(
                                                  _vm.form.SubPerilsName[
                                                    peril.PerilsNo
                                                  ],
                                                  null
                                                ) > -1
                                              : _vm.form.SubPerilsName[
                                                  peril.PerilsNo
                                                ]
                                          },
                                          on: {
                                            click: function($event) {
                                              return _vm.FocusPushRecordSub(
                                                peril
                                              )
                                            },
                                            change: function($event) {
                                              var $$a =
                                                  _vm.form.SubPerilsName[
                                                    peril.PerilsNo
                                                  ],
                                                $$el = $event.target,
                                                $$c = $$el.checked
                                                  ? true
                                                  : false
                                              if (Array.isArray($$a)) {
                                                var $$v = null,
                                                  $$i = _vm._i($$a, $$v)
                                                if ($$el.checked) {
                                                  $$i < 0 &&
                                                    _vm.$set(
                                                      _vm.form.SubPerilsName,
                                                      peril.PerilsNo,
                                                      $$a.concat([$$v])
                                                    )
                                                } else {
                                                  $$i > -1 &&
                                                    _vm.$set(
                                                      _vm.form.SubPerilsName,
                                                      peril.PerilsNo,
                                                      $$a
                                                        .slice(0, $$i)
                                                        .concat(
                                                          $$a.slice($$i + 1)
                                                        )
                                                    )
                                                }
                                              } else {
                                                _vm.$set(
                                                  _vm.form.SubPerilsName,
                                                  peril.PerilsNo,
                                                  $$c
                                                )
                                              }
                                            }
                                          }
                                        }),
                                        _vm._v(" "),
                                        _c(
                                          "label",
                                          {
                                            staticStyle: {
                                              "font-weight": "500"
                                            },
                                            attrs: {
                                              id: "peril",
                                              for: peril._id
                                            }
                                          },
                                          [_vm._v(_vm._s(peril.PerilsName))]
                                        ),
                                        _vm._v(" "),
                                        peril.PerilsCode === "PA"
                                          ? _c(
                                              "a",
                                              {
                                                attrs: {
                                                  "data-toggle": "tooltip",
                                                  "data-placement": "right",
                                                  title:
                                                    " 4 PASSENGER /s is DEFAULT VALUE otherwise SPECIFY"
                                                }
                                              },
                                              [
                                                _c(
                                                  "big",
                                                  {
                                                    staticClass:
                                                      "label label-guide"
                                                  },
                                                  [
                                                    _c("i", {
                                                      staticClass: "fa fa-info"
                                                    })
                                                  ]
                                                )
                                              ],
                                              1
                                            )
                                          : _vm._e(),
                                        _vm._v(" "),
                                        peril.PerilsCode === "PA"
                                          ? _c("input", {
                                              directives: [
                                                {
                                                  name: "model",
                                                  rawName: "v-model",
                                                  value: _vm.form.passengers,
                                                  expression: "form.passengers"
                                                }
                                              ],
                                              staticClass: "form-control",
                                              attrs: {
                                                type: "number",
                                                oninput:
                                                  "validity.valid||(value='');",
                                                disabled: _vm.PerilsCheckbox,
                                                placeholder:
                                                  "Enter number of PASSENGER"
                                              },
                                              domProps: {
                                                value: _vm.form.passengers
                                              },
                                              on: {
                                                input: function($event) {
                                                  if ($event.target.composing) {
                                                    return
                                                  }
                                                  _vm.$set(
                                                    _vm.form,
                                                    "passengers",
                                                    $event.target.value
                                                  )
                                                }
                                              }
                                            })
                                          : _vm._e()
                                      ]
                                    )
                                  : _vm._e()
                              ]
                            )
                          }),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticStyle: { float: "right", width: "55%" } },
                            [
                              _c(
                                "div",
                                {
                                  staticClass: "form-group col-md-12",
                                  staticStyle: { "margin-bottom": "0" }
                                },
                                [
                                  _c("input", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value: _vm.form.CheckAll,
                                        expression: "form.CheckAll"
                                      }
                                    ],
                                    attrs: {
                                      id: "checkall",
                                      type: "checkbox",
                                      disabled: _vm.PerilsCheckbox
                                    },
                                    domProps: {
                                      checked: Array.isArray(_vm.form.CheckAll)
                                        ? _vm._i(_vm.form.CheckAll, null) > -1
                                        : _vm.form.CheckAll
                                    },
                                    on: {
                                      click: function($event) {
                                        return _vm.CheckAllPerils()
                                      },
                                      change: function($event) {
                                        var $$a = _vm.form.CheckAll,
                                          $$el = $event.target,
                                          $$c = $$el.checked ? true : false
                                        if (Array.isArray($$a)) {
                                          var $$v = null,
                                            $$i = _vm._i($$a, $$v)
                                          if ($$el.checked) {
                                            $$i < 0 &&
                                              _vm.$set(
                                                _vm.form,
                                                "CheckAll",
                                                $$a.concat([$$v])
                                              )
                                          } else {
                                            $$i > -1 &&
                                              _vm.$set(
                                                _vm.form,
                                                "CheckAll",
                                                $$a
                                                  .slice(0, $$i)
                                                  .concat($$a.slice($$i + 1))
                                              )
                                          }
                                        } else {
                                          _vm.$set(_vm.form, "CheckAll", $$c)
                                        }
                                      }
                                    }
                                  }),
                                  _vm._v(" "),
                                  _vm._m(1)
                                ]
                              )
                            ]
                          )
                        ],
                        2
                      )
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "box box-success" }, [
                  _c("div", { staticClass: "box-header with-border" }, [
                    _vm._m(2),
                    _vm._v(" "),
                    _c("div", { staticStyle: { "margin-left": "50%" } }, [
                      _c("input", {
                        attrs: { type: "checkbox", id: "cbIndividualOption" },
                        on: {
                          click: function($event) {
                            return _vm.IndividualOption()
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("label", { attrs: { for: "cbIndividualOption" } }, [
                        _vm._v(" Others")
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row col-sm-12" }, [
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" First Name ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "CONTACT PERSON First Name "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.first_name,
                            expression: "form.first_name"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          disabled: _vm.disabledtext,
                          required: ""
                        },
                        domProps: { value: _vm.form.first_name },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "first_name",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c("label", { staticClass: "col-form-label" }, [
                        _vm._v(" Middle Name")
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "CONTACT PERSON Middle Name "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.middle_name,
                            expression: "form.middle_name"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", disabled: _vm.disabledtext },
                        domProps: { value: _vm.form.middle_name },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "middle_name",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" Last Name:")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "CONTACT PERSON Last Name "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.last_name,
                            expression: "form.last_name"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          disabled: _vm.disabledtext,
                          required: ""
                        },
                        domProps: { value: _vm.form.last_name },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.form, "last_name", $event.target.value)
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "form-group row col-sm-12",
                      staticStyle: { display: "none" },
                      attrs: { id: "regname" }
                    },
                    [
                      _c("div", { staticClass: "col-sm-6" }, [
                        _c(
                          "label",
                          { staticClass: "col-form-label" },
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v(" Registered Name ")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "SPECIFY the Registered Name (Based on CR)"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.form.registered_name,
                              expression: "form.registered_name"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            type: "text",
                            disabled: _vm.disabledtext,
                            required: ""
                          },
                          domProps: { value: _vm.form.registered_name },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.form,
                                "registered_name",
                                $event.target.value
                              )
                            }
                          }
                        })
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row col-sm-12" }, [
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c("label", { staticClass: "col-form-label" }, [
                        _vm._v(" TIN Number ")
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "SPECIFY the TIN Number "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "mask",
                            rawName: "v-mask",
                            value: "###-###-###-###",
                            expression: "'###-###-###-###'"
                          },
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.TINNumber,
                            expression: "form.TINNumber"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          oninput: "validity.valid||(value='');",
                          placeholder: "###-###-###-###"
                        },
                        domProps: { value: _vm.form.TINNumber },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.form, "TINNumber", $event.target.value)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" Email Address ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title:
                              " EMAIL ADDRESS should be use to verify other needed INFORMATION / Data "
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.EmailAddress,
                            expression: "form.EmailAddress"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "email", required: "" },
                        domProps: { value: _vm.form.EmailAddress },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "EmailAddress",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-4" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" Contact Number")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title:
                              " Contact Number should be use to verify other needed INFORMATION / Data"
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "mask",
                            rawName: "v-mask",
                            value: "####-###-####",
                            expression: "'####-###-####'"
                          },
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.ContactNumber,
                            expression: "form.ContactNumber"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          placeholder: "####-###-####",
                          oninput: "validity.valid||(value='');",
                          required: ""
                        },
                        domProps: { value: _vm.form.ContactNumber },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.form,
                              "ContactNumber",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row col-sm-12" }, [
                    _c("div", { staticClass: "col-sm-6" }, [
                      _c(
                        "label",
                        { staticClass: "col-form-label" },
                        [
                          _c("big", { staticStyle: { color: "red" } }, [
                            _vm._v(" * ")
                          ]),
                          _vm._v(" Address:")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: {
                            "data-toggle": "tooltip",
                            "data-placement": "right",
                            title: "House No. & Street"
                          }
                        },
                        [
                          _c("big", { staticClass: "label label-guide" }, [
                            _c("i", { staticClass: "fa fa-info" })
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("textarea", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.form.Address,
                            expression: "form.Address"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          rows: "2",
                          placeholder: "Address",
                          required: ""
                        },
                        domProps: { value: _vm.form.Address },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.form, "Address", $event.target.value)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-6" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Province:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select Province"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddProvince,
                                expression: "ddProvince"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddProvince = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValuePropertyProvince()
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Province")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataProvinces, function(DataProvincess) {
                              return _c(
                                "option",
                                {
                                  domProps: {
                                    value: {
                                      id: DataProvincess.ProvCode,
                                      text: DataProvincess.ProvName
                                    }
                                  }
                                },
                                [_vm._v(_vm._s(DataProvincess.ProvName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherProvince,
                              expression: "OtherProvince"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherProvince,
                              expression: "txtOtherProvince"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherProvince },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherProvince()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherProvince = $event.target.value
                            }
                          }
                        })
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row col-sm-12" }, [
                    _c("div", { staticClass: "col-sm-6" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("City:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select City"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddCity,
                                expression: "ddCity"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddCity = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValuePropertyCity()
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select City")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataCities, function(DataCitiess) {
                              return _c(
                                "option",
                                {
                                  domProps: {
                                    value: {
                                      id: DataCitiess.Code,
                                      text: DataCitiess.CityName
                                    }
                                  }
                                },
                                [_vm._v(_vm._s(DataCitiess.CityName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherCity,
                              expression: "OtherCity"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherCity,
                              expression: "txtOtherCity"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherCity },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherCity()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherCity = $event.target.value
                            }
                          }
                        })
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-6" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c(
                          "label",
                          [
                            _c("big", { staticStyle: { color: "red" } }, [
                              _vm._v(" * ")
                            ]),
                            _vm._v("Barangay:")
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "right",
                              title: "Pls. Select Barangay"
                            }
                          },
                          [
                            _c("big", { staticClass: "label label-guide" }, [
                              _c("i", { staticClass: "fa fa-info" })
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.ddBarangay,
                                expression: "ddBarangay"
                              }
                            ],
                            staticClass: "form-control",
                            on: {
                              change: [
                                function($event) {
                                  var $$selectedVal = Array.prototype.filter
                                    .call($event.target.options, function(o) {
                                      return o.selected
                                    })
                                    .map(function(o) {
                                      var val =
                                        "_value" in o ? o._value : o.value
                                      return val
                                    })
                                  _vm.ddBarangay = $event.target.multiple
                                    ? $$selectedVal
                                    : $$selectedVal[0]
                                },
                                function($event) {
                                  return _vm.setValueBarangay($event)
                                }
                              ]
                            }
                          },
                          [
                            _c(
                              "option",
                              { attrs: { value: "0", disabled: "" } },
                              [_vm._v("Select Barangay")]
                            ),
                            _vm._v(" "),
                            _c("option", { attrs: { value: "Others" } }, [
                              _vm._v("Others")
                            ]),
                            _vm._v(" "),
                            _vm._l(_vm.DataListBrgy, function(DataListBrgys) {
                              return _c(
                                "option",
                                { domProps: { value: DataListBrgys.BrgyName } },
                                [_vm._v(_vm._s(DataListBrgys.BrgyName))]
                              )
                            })
                          ],
                          2
                        ),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: _vm.OtherBarangay,
                              expression: "OtherBarangay"
                            },
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.txtOtherBarangay,
                              expression: "txtOtherBarangay"
                            }
                          ],
                          staticClass: "form-control",
                          staticStyle: { "margin-top": "5px" },
                          domProps: { value: _vm.txtOtherBarangay },
                          on: {
                            change: function($event) {
                              return _vm.setValueOtherBarangay()
                            },
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.txtOtherBarangay = $event.target.value
                            }
                          }
                        })
                      ])
                    ])
                  ])
                ]),
                _vm._v(" "),
                _vm._m(3)
              ]
            ),
            _vm._v(" "),
            _c("div", [
              _c(
                "div",
                { staticClass: "chat-popup", attrs: { id: "myForm" } },
                [
                  _c("div", { staticClass: "box-body form-container" }, [
                    _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-md-12" }, [
                        _c("h2", { staticClass: "page-header" }, [
                          _c("img", {
                            attrs: {
                              src: "/img/rsilogo.png",
                              alt: "RSILogo",
                              id: "quoteslogo"
                            }
                          }),
                          _vm._v(" "),
                          _c("small", { staticClass: "pull-right" }, [
                            _c("strong", [
                              _vm._v(" Date: " + _vm._s(_vm.date) + " ")
                            ])
                          ])
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _vm._m(4),
                    _vm._v(" "),
                    _c("section", { staticClass: "content" }, [
                      _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col-md-12" }, [
                          _vm._m(5),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass: "col-md-10",
                              staticStyle: { padding: "0px 0px 0px 10px" }
                            },
                            [
                              _c("p", [
                                _vm._v(
                                  _vm._s(_vm.form.first_name) +
                                    " " +
                                    _vm._s(_vm.form.middle_name) +
                                    " " +
                                    _vm._s(_vm.form.last_name)
                                )
                              ]),
                              _vm._v(" "),
                              _c("p", [_vm._v(_vm._s(_vm.form.Address))]),
                              _vm._v(" "),
                              _c("p", [
                                _vm._v(
                                  _vm._s(_vm.form.DenominationDis) +
                                    " : " +
                                    _vm._s(_vm.form.YearPO) +
                                    " " +
                                    _vm._s(_vm.form.CarBrand) +
                                    " " +
                                    _vm._s(_vm.form.CarModel) +
                                    " " +
                                    _vm._s(_vm.form.BodyType) +
                                    " "
                                )
                              ]),
                              _vm._v(" "),
                              _c("p")
                            ]
                          )
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col-md-7" }, [
                          _c(
                            "ol",
                            { staticClass: "pull-right" },
                            [
                              _vm._l(_vm.form.PerilsNameDis, function(n) {
                                return _c("li", { key: n._id }, [
                                  _vm._v(_vm._s(n) + " ")
                                ])
                              }),
                              _vm._v(" "),
                              _vm._l(_vm.form.SubPerilsNameDis, function(n) {
                                return _c("li", { key: n._id }, [
                                  _vm._v(_vm._s(n) + " ")
                                ])
                              })
                            ],
                            2
                          )
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col-md-12" }, [
                          _vm._m(6),
                          _vm._v(" "),
                          _c("ol", [
                            _vm.form.MotorAccessories
                              ? _c("li", [
                                  _c("small", [_vm._v("Included Accessories")])
                                ])
                              : _vm._e(),
                            _vm._v(" "),
                            _vm.form.MotorNetWeight
                              ? _c("li", [
                                  _c("small", [
                                    _vm._v(_vm._s(_vm.form.MotorNetWeight))
                                  ])
                                ])
                              : _vm._e()
                          ])
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass: "btn cancel",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            return _vm.closeForm()
                          }
                        }
                      },
                      [_vm._v("Close")]
                    )
                  ])
                ]
              )
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h3", { staticClass: "box-title" }, [
      _c("strong", [_vm._v("Motor Car Details")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "label",
      {
        staticClass: "label label-guide-2",
        staticStyle: { "font-weight": "500" },
        attrs: { for: "checkall" }
      },
      [
        _vm._v(" Check / Uncheck All : "),
        _c("i", { staticClass: "fa fa-arrow-up" })
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h3", { staticClass: "box-title" }, [
      _c("strong", [_vm._v("Personal Details")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "box-footer" }, [
      _c(
        "button",
        { staticClass: "btn btn-primary", attrs: { type: "submit" } },
        [_vm._v("Submit")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row text-center" }, [
      _c("div", { staticClass: "col-md-12" }, [
        _c("h3", [_vm._v("Request for Proposal")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "col-md-2", staticStyle: { padding: "0px" } },
      [
        _c("p", [
          _c("b", [_vm._v("Assured")]),
          _c("b", { staticClass: "pull-right" }, [_vm._v(":")])
        ]),
        _vm._v(" "),
        _c("p", [
          _c("b", [_vm._v("Address")]),
          _c("b", { staticClass: "pull-right" }, [_vm._v(":")])
        ]),
        _vm._v(" "),
        _c("p", [
          _c("b", [_vm._v("Unit")]),
          _c("b", { staticClass: "pull-right" }, [_vm._v(":")])
        ]),
        _vm._v(" "),
        _c("p", [
          _c("b", [_vm._v("Coverage")]),
          _c("b", { staticClass: "pull-right" }, [_vm._v(":")])
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("small", [_c("b", [_vm._v("Note:")])])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/Quotation/RequestForm-joleth.vue":
/*!*******************************************************!*\
  !*** ./resources/js/Quotation/RequestForm-joleth.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true& */ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true&");
/* harmony import */ var _RequestForm_joleth_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RequestForm-joleth.vue?vue&type=script&lang=js& */ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& */ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _RequestForm_joleth_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "57c10da6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Quotation/RequestForm-joleth.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./RequestForm-joleth.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&":
/*!****************************************************************************************************************!*\
  !*** ./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& ***!
  \****************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=style&index=0&id=57c10da6&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_style_index_0_id_57c10da6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Quotation/RequestForm-joleth.vue?vue&type=template&id=57c10da6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RequestForm_joleth_vue_vue_type_template_id_57c10da6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);