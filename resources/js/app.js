require('./bootstrap');

window.Vue = require('vue');

// Imports Here
import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'
import Multiselect from 'vue-multiselect'
import converter from 'number-to-words'
import moment from 'moment'


import * as VueGoogleMaps from 'vue2-google-maps'
//import GmapMap from 'vue2-google-maps/dist/components/map.vue'



Vue.use(VueGoogleMaps, {
    load: {
      key: "AIzaSyAr10ngkAaz8gZTIXQ1kWYc7XfamFmm4H8",
      libraries: "places" // necessary for places input
    }
  });


// Number to Words
window.converter = converter

// Moment JS
window.moment = moment;

//Sweet Alert
window.Swal = Swal;
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

// New Vue Instance
window.Fire = new Vue();


// VForm
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Vue Router
Vue.use(VueRouter)
//axios.get("GetUserData").then(({ data }) => (this.UserDetails = data));
let URLPath = "/proposal-modification-form"
alert(URLPath);

let routes = [
    {
        path: '*',
        component: require('./Dashboard.vue').default
    },

    // Request Proposal Form
    {
        path: '/request-form',
        component: require('./Proposal/RequestModule.vue').default
       // component: require('./Quotation/RequestForm.vue').default
    },

    {
        path: '/request-form-New',
        //component: require('./Proposal/RequestModule.vue').default
        component: require('./Quotation/RequestForm.vue').default
    },
    {
        path: '/proposal-form',
        component: require('./Proposal/ProposalModule.vue').default
    },

    
 
    
    // Proposal List 
    {
        path: '/proposal-lists',
        component: require('./Proposal/ProposalList.vue').default
    },
    {
        path: '/proposal-lists-customer',
        component: require('./Proposal/CustListQuotation.vue').default
    },
    {
        path: '/proposal-lists-approver',
        component: require('./Proposal/ApproverListQuotation.vue').default
    },
    {
        path: '/proposal-lists-accepted',
        component: require('./Proposal/ProposalAccepted.vue').default
    },
    {
        path: '/ListForApprovalUW',
        component: require('./Proposal/ListForApprovalUW.vue').default
    },
    {
        path: '/quotations-approved',
        component: require('./Quotation/QuotationsApproved.vue').default
    },
    {
        path: '/proposal-modifications',
        component: require('./Proposal/ProposalModifyList.vue').default
    },

    // OPTIONS
    {
        path: '/ProposalOptions',
        component: require('./Options/ProposalOptions.vue').default
    },

    {
        path: '/ViewQuoteList',
        component: require('./Options/ViewQuoteList.vue').default
    },

    {
        path: '/ViewQuoteModify',
        component: require('./Options/ViewQuoteModify.vue').default
    },

    {
        path: '/CustAcceptedView',
        component: require('./Options/CustAcceptedView.vue').default
    },
    {
        path: '/ApproverView',
        component: require('./Options/ApproverView.vue').default
    },
    {
        path: '/UWApproverView',
        component: require('./Options/UWApproverView.vue').default
    },

    {
        path: '/AcceptedView',
        component: require('./Options/AcceptedView.vue').default
    },

    {
        path: '/Accepted',
        component: require('./Policy/Issuance.vue').default
    },
    {
        path: '/final-issuance',
        component: require('./Policy/FinalIssuance.vue').default
    },

    {
        path: '/Customer-Issuance',
        component: require('./Policy/CustIssuance.vue').default
    },

    

    {
        path: '/ForSignatureList',
        component: require('./Options/ForSignatureList.vue').default
    },
    {
        path: '/ViewForSignature',
        component: require('./Options/ViewForSignature.vue').default
    },


    // File Maintenance (User)
    {
        path: '/registration',
        component: require('./FileMaintenance/User/Registration.vue').default
    },
    {
        path: '/department',
        component: require('./FileMaintenance/User/Department.vue').default
    },
    {
        path: '/type',
        component: require('./FileMaintenance/User/Type.vue').default
    },
    {
        path: '/Sub-Type',
        component: require('./FileMaintenance/User/SubType.vue').default
    },
    {
        path: '/authority',
        component: require('./FileMaintenance/User/Authority.vue').default
    },

    // File Maintenance (Lines)
    {
        path: '/maintenance-product-lines',
        component: require('./FileMaintenance/Lines/ProductLine.vue').default
    },

    // File Maintenance (Motor Car)
    {
        path: '/maintenance-class',
        component: require('./FileMaintenance/MotorCar/Class.vue').default
    },
    {
        path: '/maintenance-denomination',
        component: require('./FileMaintenance/MotorCar/Denomination.vue').default
    },
    {
        path: '/CarBodyBranch',
        component: require('./FileMaintenance/MotorCar/CarBrand.vue').default
    },
    {
        path: '/CarModel',
        component: require('./FileMaintenance/MotorCar/CarModel.vue').default
    },
    {
        path: '/CarBodyType',
        component: require('./FileMaintenance/MotorCar/CarBodyType.vue').default
    },
    {
        path: '/maintenance-car-amount',
        component: require('./FileMaintenance/MotorCar/CarPurchasedAmount.vue').default
    },

    // File Maintenance (Coverages)
    {
        path: '/maintenance-peril',
        component: require('./FileMaintenance/Perils/Perils.vue').default
    },
    {
        path: '/maintenance-taripa',
        component: require('./FileMaintenance/Perils/Taripa.vue').default
    },

    

   
    {
        path: '/maintenance-surcharge',
        component: require('./FileMaintenance/Perils/Surcharge.vue').default
    },

    // File Maintenance (Clauses & Warranties)
    {
        path: '/clauses-and-warranties',
        component: require('./FileMaintenance/Others/ClausesWarranties.vue').default
    },

    // File Maintenance (Charges & SubCharges)
    {
        path: '/maintenance-charges',
        component: require('./FileMaintenance/Charges/ChargesTable.vue').default
    },
    {
        path: '/maintenance-sub-charges',
        component: require('./FileMaintenance/Charges/SubChargesTable.vue').default
    },

    {
        path: '/Policies-List',
        component: require('./Payment/PoliciesList.vue').default
    },

    // For Signatory
   

    ///-----------Payment
    {
        path: '/Payment-Mode',
        component: require('./Payment/PaymentMode.vue').default
    },

    {
        path: '/dragonpay_return',
        component: require('./Payment/PaymentReturnURL.vue').default
    },



    {
        path: '/authentication-Internal-list',
        component: require('./Policy/InternalAuthList.vue').default
    },

    {
        path: '/authentication-Internal',
        component: require('./Policy/InternalAuth.vue').default
    },
    ///-----Reports
   
    {
        path: '/report-logs',
        component: require('./Reports/ReportsLogs.vue').default  
    },

    
    {
        path: '/logs',
        component: require('./Reports/Logs.vue').default
    },
    {
        path: '/report-agent-commission',
        component: require('./Reports/AgentCommission.vue').default
    },
    {
        path: '/Comm-Details',
        component: require('./Reports/CommDetails.vue').default
    },
    {
        path: '/Comm-Cash-Out',
        component: require('./Reports/CashOut.vue').default
    },
    {
        path: '/Printable-Com-Agent',
        component: require('./Reports/AgentComPrintable.vue').default
    },
    {
        path: '/Request-CashOut-Agent',
        component: require('./Reports/ListCashOutCom.vue').default
    },


    //----new 
    {
        path: '/View-User-List',
        component: require('./FileMaintenance/User/ViewUser.vue').default
    },

    {
        path: '/View-User-Record',
        component: require('./FileMaintenance/User/ViewUserRecord.vue').default
    },

    //------FIRE

    ///-----------AGENT's 
    {
        path: '/request-form-fire',   
        component: require('./FIRE/AgentsVue/RequestForm.vue').default
    },

    {
        path: '/Google-Map',
        component: require('./FIRE/AgentsVue/GoogleMap.vue').default
    },

    {
        path: '/proposal-lists-fire',
        component: require('./FIRE/AgentsVue/Proposal/ProposalListsFire.vue').default
    },

    {
        path: '/proposal-view-fire',
        component: require('./FIRE/AgentsVue/Proposal/ProposalViewFire.vue').default
    },

  
    {
      
       // path: '/proposal-modification-form',
       // path: '{{/' + this.details + '}}',
       
        path: URLPath,
        component: require('./Proposal/ProposalModifyModule.vue').default
    },


   
   


]
const router = new VueRouter({
    mode: 'history',
    routes
})

// Laravel Vue Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

// Vue Multi-Select (Register Globally)
Vue.component('multiselect', Multiselect)

// Global Currency Filter
Vue.filter('Peso', function(value) {
    const amt = Number(value)
    return '₱ ' + amt.toLocaleString('ko-KR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
});

// Global Currency Filter
Vue.filter('piso', function(value) {
    const amt = Number(value)
    return amt.toLocaleString('ko-KR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
});

// Global Date Format Filet
Vue.filter('DateFormat', function(value) {
    // return moment(value).format('LLLL')  // Thursday, December 12, 2019 11:17 AM
    return moment(value).format('LLL')   // December 12, 2019 11:18 AM
});

Vue.filter('DatePassed', function(value) {
   return moment(value).startOf(value).fromNow(); 
});
// Vue.axios.get('GetUserData', function(data) {

// });


const app = new Vue({
    el: '#app',
    router
});




