<template>
    <div>
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
            <h1>
                Agent 
                <small>Details of Commission</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <router-link to="/dashboard">
                        <i class="fa fa-dashboard"></i>
                        Dashboard
                    </router-link>
                </li>
                <li class="active">
                    <i class="fa fa-cogs"></i>
                    Commission
                </li>
                <li class="active">
                    <i class="fa fa-cog"></i>
                    Reports
                </li>
            </ol>
        </section> -->

        <section class="content" v-if="details[0].CustAcctNO.trim() ===  UserDetails.AccountNo.trim()" >
            <div class="row">
                <div class="col-md-5">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <!-- <img
                                class="profile-user-img img-responsive img-circle"
                                src="/img/user4-128x128.jpg"
                                alt="User profile picture"/> -->

                            <h3 class="profile-username text-center">
                                {{ details[0].FirstName + ' '+ details[0].MiddleName   + ' ' + details[0].LastName }} 
                            </h3>

                            <p class="text-muted text-center">
                                {{ details[0].RequestNo }}
                            </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Plate #</b>
                                    <a class="pull-right">{{ details[0].PlateNumber }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Transaction Date</b>
                                    <small><a class="pull-right">{{ details[0].AcceptanceDate | DateFormat }}</a></small>
                                </li>
                                <li class="list-group-item">
                                    <b>Commision Amount </b>
                                    <a class="pull-right">{{ details[0].TotalCommission | peso }}</a>
                                </li>
                                  <li class="list-group-item" v-if="details[0].CashOutPaidAmount !=0">
                                    <b>Cash-Out </b>
                                    <a class="pull-right">{{ details[0].CashOutPaidAmount | peso }}  {{ " : " + details[0].StatusCashOut}}</a>
                                </li>
                                 <li class="list-group-item">
                                    <b>Mode of Payment</b>
                                    <a class="pull-right">{{ details[0].PaymentMode}}</a>
                                </li>
                            </ul>
                                <router-link :to="`/Customer-Issuance? ${details[0].RequestNo}`" target="_blank" class="btn btn-info" style="text-decoration: none;">
                                                <i class="fa fa-eye"></i>
                                                View Policy
                               </router-link>

                                
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#info" data-toggle="tab">Information</a>
                            </li>
                            <li>
                                <a href="#coverage" data-toggle="tab">Breakdown</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">
                               <div v-for="values in details" :key="values.OptionNo">
                                  
                                        <table class="table table-bordered">
                                        
                                           <tr> <th>Assured Name</th>  <td>{{ values.FirstName + ' '+ values.MiddleName   + ' ' + values.LastName }}</td> </tr>
                                           <tr> <th>Address</th>  <td>{{ values.AssuredAddress}}</td> </tr>   
                                           <tr> <th>Car Description</th>  <td>{{ values.CarDescription}}</td> </tr>    
                                           <tr> <th>Mortgage Bank Name</th>  <td>{{ values.MortgageBankName}}</td> </tr>  
                                            <tr> <th>Amount Due</th>  <td>{{ values.AmountDue | peso }}</td> </tr> 
                                           <tr> <th>Discount  </th>  <td>{{ values.DiscountAmount | peso }}</td> </tr> 
                                            <tr> <th>Discounted Amount </th>  <td style="color:red;">{{ values.DiscountedAmountDue | peso }}</td> </tr> 
                                                   
                                        </table>
                                        
                                </div>
                               
                            </div>

                            <div class="tab-pane" id="coverage">
                                <div v-for="values in details" :key="values.OptionNo">
                                    <!-- <h4>Request #:{{ values.RequestNo }}</h4> -->
                                    <div class="table-responsive"  >
                                            <table class="table table-condensed">
                                                <tr> <th>Perils Name</th> <th>Commission</th></tr>
                                                <tr v-for="value in values.CommBreakdown || value.OldCoverages" :key="value.CommBreakdown">
                                                        <td>{{ value.PerilsName }}</td>
                                                        <td> {{ value.AmountCom | peso}}</td>
                                                </tr>
                                                <tr><th style="text-align:right">Total : </th>
                                                    <th style="text-align:left">{{ values.TotalAmountMaxCom | peso}}</th></tr>
                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                                <router-link to="/report-agent-commission" class="btn btn-primary btn-block" style="text-decoration: none;width:100px">
                                            <b>Back</b>
                                 </router-link> 
                          
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted: function(){ 
         axios.get("GetUserData").then(({ data }) => (this.UserDetails = data));
    },


    data() {
        return {
            details: {},
            UserDetails:{},
        };
    },

    created() {
        let uri = window.location.href.split("?");
        let PassID = uri[1].trim();
        axios
            .get("api/AgentCommissionReportGet/" + PassID)
            .then(({ data }) => (this.details = data));
        // console.log(PassID);
    },

    computed: {
        orderedOptionNo() {
            return _.orderBy(this.details.OldRecord, 'OptionNo')
        },

        orderedCoverages() {
            return _.orderBy(this.details.CommBreakdown, 'OptionNo')
        },

        orderedCharges() {
            return _.orderBy(this.details.OldRecord, 'OptionNo')
        }
    }
};
</script>

<style scoped>
    li.list-group-item>a {
        text-decoration: none;
        cursor: pointer;
    }
</style>
