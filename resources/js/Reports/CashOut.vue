<template>
    <div>
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
            <h1>
                Agent 
                <small>Commission Convert</small>
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

         <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section>


        <section class="content" v-show="isShowingRecord" v-if="this.details === 'NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h4> <big class="label label-warning" >{{ this.details  }} </big></h4>
                </div>
      </section>


        <section class="content" v-show="isShowingRecord"  v-if="this.details !== 'NO RECORD FOUND'" >
            <div class="row" >
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

                            <p class="text-muted text-center" v-if="this.UserDetails.AgentType != null">
                                {{ UserDetails.AgentType +  " : " + UserDetails.SubAgent }}
                            </p>
                             <p class="text-muted text-center" v-else>
                               Department: {{ UserDetails.department  }}
                            </p>


                          
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
                                    <br/>
                                <div class="form-goup">
                                     <label for="brand"> </label>
                                   <button type="button" @click="loadCommission()" class="btn btn-warning"><i class="fa fa-search"></i> Search</button>
                                         <router-link to="/report-agent-commission"  class="btn btn-primary btn-block pull-right" style="text-decoration: none;width:100px">
                                                         <b> <i class="fa fa-backward"></i> Back</b>
                                            </router-link> 
                                </div><br/>

                            <ul class="list-group list-group-unbordered">
                                

                                <li class="list-group-item">
                                    <b>Available Amount </b>
                                    <a class="pull-right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommission | peso}}</a>
                                </li>

                               
                               
                            </ul>
                              
                                
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#info" data-toggle="tab">Request</a>
                            </li>
                            <li>
                                <a href="#coverage" data-toggle="tab">Breakdown</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="info">
                                        <table class="table table-condensed">
                                        
                                           <tr> <th>Cash-Out Mode</th>  
                                                <td><select class="form-control" v-model="form.CashOutMode" required >
                                                         <option value="" selected disabled>Pls.Select</option>
                                                         <option value="Cash">Cash</option>
                                                         <option value="Discount">Discount</option>
                                                      
                                                    </select>
                                                </td> 
                                            </tr>   
                                           <tr> <th>Amount</th>  
                                                 <td> <input type="number"  v-model="form.CashOutAmount" @change="MaxInputCommVal()"  class="form-control"  placeholder="Enter Amount" />
                                                            <!-- {{ form.CorrectPassword}} -->
                                                 </td> 
                                           
                                           </tr>  

                                            <tr> 
                                                 <td colspan="2"> <br/>
                                                     <!-- <a v-bind:href="'/report-agent-commission?'+ this.UserDetails.AccountNo"> -->
                                                        <button type="button" :disabled='isDisabled' v-if="logs[parseFloat(this.logs.length) - 1].CompTotalCommission !=0.00"  @click="CashOutComm()" class="btn btn-danger pull-right"><i class="fa fa-sign-out"></i> Cash-Out</button>
                                                   <!-- </a> -->
                                                    </td> 
                                           
                                           </tr>    
                                        
                                        </table>
                               
                            </div>

                            <div class="tab-pane" id="coverage">
                                <div >
                                    <!-- <h4>Request #:{{ values.RequestNo }}</h4> -->
                                    <div class="table-responsive"  >
                                            <table class="table table-bordered" >
                                               <tr> <th>Request No   {{ form.AccountNo}}</th>
                                                <th>Plate No.</th>
                                                <th>Status</th>
                                                <th>Available Amount</th>
                                                

                                               </tr>


                                                <tr v-for="log in logs" :key="log._id">
                                       
                                                    <td >{{log.RequestNo }} </td>
                                                    <td>{{log.PlateNumber}}</td>
                                                    <td> <span class="label label-warning" >{{log.StatusCashOut}}</span></td>
                                                    <td style="text-align:right">{{log.TotalCommission | peso}}</td>
                                                    
                                                
                                                
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Total : </th>
                                                <th style="border-top: 1px solid black;text-align:right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommission | peso}}</th>

                                             </tr>

                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                               <!-- <pre>{{ $data }}</pre> -->
                          
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
        
         this.StartLoading();
         this.loadCommission();
    },


    data() {
        return {
            details: {},
            UserDetails:{},
             logs: {},
             UserValPassword: {},
               isDisabled:true,
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
                 CashOutMode:'',
                 CashOutAmount:'',
                 UserPassword:'',
                 CorrectPassword:'',
                 RequestNo:[],
                 PlateNumber:[],
                 AccountNo:'',
               

           })
        };
        
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
      
       async CashOutComm(){
          this.form.AccountNo =  this.UserDetails.AccountNo;
           const { value: text } = await Swal.fire({
                title: 'Confirmed ?',
                text: "Pls. Enter Your Password to Cash-Out",
                icon: 'info',
                input: 'password',
                inputPlaceholder: 'Enter Your Password...',
                inputAttributes: {
                    'aria-label': 'Password Code'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
             
            }).then(result => {
                // console.log(result);
                this.form.AuthCode = result.value
               // this.loadData()
                let AccountNo           =  this.UserDetails.AccountNo;
                let InputUserPassword   =  result.value;
                 let PassData               =  AccountNo + ";;" +  InputUserPassword.trim();

                             axios.get('api/CheckUserPassword/' + PassData ).then(({data}) => {
                                    this.UserValPassword            = data;
                                    this.form.CorrectPassword       = data[0].Confirmed;
                                    if (data[0].Confirmed ==  'YES') {

                                             this.form.post('api/CashOutCommission').then(() => {
                                                   Swal.fire(
                                                            " Cash-Out !",
                                                            "Request has been Submitted.",
                                                            "success"
                                                    );
                                                  this.$router.push('/report-agent-commission');

                                                }).catch((response) => {
                                                        alert(response);

                                                });
                                    }else{
                                          Swal.fire(
                                                "Failed!",
                                                " Invalid Password ",
                                                "warning"
                                            );


                                    }
                                })

              
                

            }).catch(() => {
               
                // Swal.fire(
                //     "Failed",
                //     "There was something wrong",
                //     "warning"
                // );
            })


        },
        MaxInputCommVal(){

         
            if (this.form.StartDate == '' || this.form.EndDate == ''){
                let date = new Date();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let monthMinus = date.getMonth();
                let year = date.getFullYear();
                let EndDate = `${year}-${month < 10 ? '0' + month : '' + month}-${day < 10 ? '0' + day : '' + day}`;
                let StartDate = `${year}-${monthMinus < 10 ? '0' + monthMinus : '' + monthMinus}-${day < 10 ? '0' + day : '' + day}`;
                this.form.StartDate      =  StartDate ;
                this.form.EndDate       =   EndDate ;
            }  
            // }else{
            //     let EndDate      =  this.form.EndDate ;
            //     let StartDate       = this.form.StartDate;
               
            // }



          
          
        let AmountDeduct          = this.form.CashOutAmount;
        let MaxComm               =  this.logs[parseFloat(this.logs.length) - 1].CompTotalCommission;
      
        
          if ( AmountDeduct > MaxComm){
             
                       Swal.fire(
                                "Higher Amount!",
                                "Available Amount : " + parseFloat(MaxComm,2),
                                "warning"
                            );
                            this.form.CashOutAmount =  MaxComm;
                             this.isDisabled=false;
          }else{
              this.isDisabled=false;
          }

      },

         loadCommission() {
       this.RetrieveTimeInterval =  setInterval(() => {

                              

                        let PassID = this.UserDetails.AccountNo; // uri[1].trim();

             axios.get("api/AgentCommReportCashOut/" + PassID).then(({ data }) => (this.details = data));
                let PassData;
                    if (this.form.StartDate == '' || this.form.EndDate == ''){
                    let date = new Date();
                    let day = date.getDate();
                    let month = date.getMonth() + 1;
                    let monthMinus = date.getMonth();
                    let year = date.getFullYear();
                    let EndDate = `${year}-${month < 10 ? '0' + month : '' + month}-${day < 10 ? '0' + day : '' + day}`;
                    let StartDate = `${year}-${monthMinus < 10 ? '0' + monthMinus : '' + monthMinus}-${day < 10 ? '0' + day : '' + day}`;
                        PassData =  PassID  + ";;" + StartDate  + ";;" +  EndDate; 
                    }else{
                        PassData =  PassID  + ";;" + this.form.StartDate + ";;" + this.form.EndDate ;
                    
                    }
                //alert(PassData);
                    axios.get('api/AgentCommissionForCashOut/' + PassData ).then(({data}) => {
                        this.logs = data
                    //  this.form.RequestNo = this.logs.RequestNo;
                    }).catch((response) => {
                            // Swal.fire(
                            //     " No Record !",
                            //     " FOUND " + response,
                            //     "warning"
                            // );

                    })
                // alert(this.logs.length);
                 
              
          }
        , 1000)

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
    //     let uri = window.location.href.split("?");
    //  this.RetrieveTimeInterval =  setInterval(() => {
      
    //   let PassID = this.UserDetails.AccountNo; 
        
    //     axios
    //         .get("api/AgentCommReportCashOut/" + PassID)
    //         .then(({ data }) => (this.details = data));
    //     }
    //     , 1000)

    //   this.RetrieveTimeInterval2 = setInterval(() => {
    //             clearInterval(this.RetrieveTimeInterval);  
                  
    //         },3000) 
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
