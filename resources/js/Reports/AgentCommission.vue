<template>
    <div>
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
            <h1>
                Report Commission
                <small>Table of Commission</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <router-link to="/dashboard">
                        <i class="fa fa-dashboard"></i> 
                        Dashboard
                    </router-link>
                </li>
                
                <li class="active">
                    <i class="fa fa-cog"></i> 
                    Agent Commission
                </li>
                 
            </ol>
        </section> -->

        <section class="content" v-show="isShowingLoading">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section>


          <section class="content" v-show="isShowingRecord" v-if="this.logs === 'NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h4> <big class="label label-warning" >{{ this.logs  }} </big></h4>
                </div>
        </section>
        <section class="content" v-show="isShowingRecord" v-if="this.logs !== 'NO RECORD FOUND'">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <p class="box-title pull-right no-print"> 
                                  <a v-bind:href="'/Comm-Cash-Out?'+ this.UserDetails.AccountNo" v-if="logs[parseFloat(this.logs.length) - 1].CompTotalCommission != 0.00"   target="_blank" > 
                                    <button class="btn btn-warning btn.btn-app"><i class="fa  fa-sign-out"></i> {{ logs[parseFloat(this.logs.length) - 1].CompTotalCommission | peso}}</button>
                                </a>
                              
                            </p>
                          
                            <div class="box-tools col-md-10 no-print">
                                
                             <div class="col-md-3">
                                <div class="form-goup ">
                                    <label for="brand">Start Date:</label>
                                    <input
                                      v-model="form.StartDate" type="date"
                                      
                                        class="form-control"
                                        name="brand"
                                        id="brand"
                                        placeholder="Enter Car Brand"
                                       
                                    />
                                </div>
                            </div>
                            
                             <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="brand">End Date:</label>
                                    <input
                                      
                                        v-model="form.EndDate" type="date"
                                        class="form-control"
                                        name="brand"
                                        id="brand"
                                        placeholder="Enter Car Brand"
                                       
                                    />
                                </div>
                            </div>
                            
                             <div class="col-md-1">
                                <div class="form-goup">
                                     <label for="brand"> </label>
                                         <button type="submit" @click="loadLogs()" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                           
                                </div>
                            </div>
                           
                            </div>
                        </div>
                         
                        <div class="box-body table-responsive">
                                        <a v-bind:href="'/Printable-Com-Agent?'+ this.UserDetails.AccountNo" target="_blank" class="no-print" > 
                                                     <button class="btn btn-info pull-left no-print"><i class="fa  fa-print"></i>  Print</button>
                                        </a><br/>
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                       
                                        <th>Request No</th>
                                        <th>Plate No.</th>
                                        <th>Status</th>
                                        
                                                <th style="text-align:center">Commission</th>
                                                
                                                <th style="text-align:center">Remaining</th>
                                                <th style="text-align:center">Mode</th>
                                                <th style="text-align:center">CashOut</th>
                                        <th></th>
                                    </tr>
                                    <tr v-for="log in logs" :key="log._id">
                                       
                                        <td>{{log.RequestNo}}</td>
                                        <td>{{log.PlateNumber}}</td>
                                        <td style="text-align:center">{{log.StatusCashOut}}</td>
                                        <td style="text-align:right"  v-if="log.CommissionAmount != 0" >{{log.CommissionAmount | peso}}</td>
                                          <td style="text-align:right"  > {{log.TotalCommission | peso}}</td>
                                         
                                        
                                        
                                        <td style="text-align:center" v-if="log.CashOutAmount != 0" >
                                                <p v-for="BreakDown in log.CashOutBreakdown" :key="BreakDown._id">
                                                         {{ BreakDown.CashOutMode }}

                                                </p>
                                                 
                                            
                                            </td>
                                      
                                        <td style="text-align:right"  v-if="log.CashOutAmount != 0" >
                                                    <p v-for="BreakDown in log.CashOutBreakdown" :key="BreakDown._id">
                                                         {{ BreakDown.RequestAmount  | peso}} 

                                                    </p>
                                            
                                            
                                            
                                            </td>
                                       
                                       
                                        <td >
                                            <router-link :to="`/Comm-Details? ${log.RequestNo}`" class="btn btn-info no-print" style="text-decoration: none;">
                                                <i class="fa fa-eye"></i>
                                                View
                                            </router-link>
                                        </td>
                                    </tr>
                                    <tr>
                                                <th colspan="3" style="text-align:right">Total : </th>
                                                <td  style="text-align:right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommissionAmount | peso}}</td>
                                               
                                                <th style="text-align:right" v-if="logs[parseFloat(this.logs.length) - 1].CompTotalCommission != 0" >{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommission | peso}}</th>
                                                 <th></th>
                                                <td style="text-align:right" v-if="logs[parseFloat(this.logs.length) - 1].CompTotalCashOut != 0" >{{ logs[parseFloat(this.logs.length) - 1].CompTotalCashOut | peso}}</td>

                                                
                                                
                                    </tr>
                                </tbody>
                            </table>
                           <!-- <pre>{{  $data }}</pre> -->
                            <pagination :data="logs" :limit="2" @pagination-change-page="getResults" class="pull-right">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
     mounted: function() {
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
          
           this.StartLoading();
            this.loadLogs() ;
    },
    data() {
        return {
            logs: {},
             UserDetails:{},
            search: '',
            RetrieveTimeInterval:null,
            RetrieveTimeInterval2:null,

                IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:180,
                 timer_is_on:0,



             form: new Form({
                 StartDate:'',
                 EndDate:'',

           })
        }
    },

    methods: {

           LoadingDesign(){
                        this.IntervalLoading  = this.clock;
                        this.clock = this.IntervalLoading - 1;
                        this.timer = setTimeout(this.LoadingDesign, 1000/60);
            },
            StartLoading() {
 
                  if (!this.timer_is_on) {
                      this.timer_is_on = 1;
                      this.LoadingDesign();
                  }
                    
              
            },


        ComWalletPage(){
                    let route = this.$router.resolve({path: 'api/PaymentMode' });
                     window.open(route.href, '_blank');
                    

        },

        getResults(page = 1) {
            axios.get('api/AgentCommissionReport?page=' + page).then(({data}) => {
                this.logs = data;
            });
        },

         loadLogs() {
           
             this.RetrieveTimeInterval =  setInterval(() => {
                               


                                let PassData;
                                if (this.form.StartDate == '' || this.form.EndDate == ''){
                                    let date = new Date();
                                let day = date.getDate();
                                let month = date.getMonth() + 1;
                                let monthMinus = date.getMonth();
                                let year = date.getFullYear();
                            // let EndDate1 = `${year}-${month < 10 ? '0' + month : '' + month}-${day < 10 ? '0' + day : '' + day}`;
                                let EndDate = `${year}-${month < 10 ? '0' + month : '' + month}-${day < 10 ? '0' + day : '' + day}`;
                                let StartDate = `${year}-${monthMinus < 10 ? '0' + monthMinus : '' + monthMinus}-${day < 10 ? '0' + day : '' + day}`;
                                PassData =  this.UserDetails.AccountNo  + ";;" + StartDate  + ";;" +  EndDate; 
                                }else{
                                    PassData =  this.UserDetails.AccountNo  + ";;" + this.form.StartDate + ";;" + this.form.EndDate ;
                                
                                }
                            
                            
                                axios.get('api/AgentCommissionReport/' + PassData ).then(({data}) => {
                                    this.logs = data
                                }).catch(() => {

                                })
                            // alert(this.logs.length);
                                console.log();
                 }, 1000)
                this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                                     clearTimeout(this.timer);   //clear timer /loading
                                this.timer_is_on = 0; //clear timer /loading
                                this.isShowingLoading = false; //clear timer /loading
                                this.isShowingRecord = true; 
                            
                            
                        },3000) 
                    }
    },

    created() {
    //   this.RetrieveTimeInterval =  setInterval(() => {
    //                             clearTimeout(this.timer);   //clear timer /loading
    //                             this.timer_is_on = 0; //clear timer /loading
    //                             this.isShowingLoading = false; //clear timer /loading
    //                             this.isShowingRecord = true; 

    //         this.loadLogs()
    //         //console.log(this.loadLogs());
    //     }
    //     , 1000)

    //   this.RetrieveTimeInterval2 = setInterval(() => {
    //             clearInterval(this.RetrieveTimeInterval);  
                  
    //         },3000) 

        
    },

   
}
</script>