
<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
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
        </section>
            
        <section class="content" >
            <div class="row" >
                <div class="col-md-3">
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
                                {{ UserDetails.AgentType +  " : " + UserDetails.SubAgent }}
                            </p>


                          
                                <div class="form-goup no-print">
                                    <label for="brand">Start Date:</label>
                                    <input
                                      v-model="form.StartDate" type="date"
                                      
                                        class="form-control"
                                        name="brand"
                                        id="brand"
                                        placeholder="Enter Car Brand"
                                       
                                    />
                                </div>
                     
                                <div class="form-goup no-print">
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
                                <div class="form-goup no-print">
                                     <label for="brand"> </label>
                                   <button type="button" @click="loadCommission()" class="btn btn-warning"><i class="fa fa-search"></i> Search</button>
                                         <router-link to="/report-agent-commission"  class="btn btn-primary btn-block pull-right" style="text-decoration: none;width:100px">
                                                         <b> <i class="fa fa-backward"></i> Back</b>
                                            </router-link> 
                                </div><br/>

                            <ul class="list-group list-group-unbordered no-print">
                                

                                <li class="list-group-item">
                                    <b>Request Amount</b>
                                    <a class="pull-right">{{ logs[parseFloat(this.logs.length) - 1].CashOutAmount | peso}}</a>
                                </li>

                               
                               
                            </ul>
                              
                                
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           
                            <li class="active">
                                <a href="#coverage" data-toggle="tab">Breakdown - Cash</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                           

                            <div class="active tab-pane" id="coverage">
                                <div >
                                    <!-- <h4>Request #:{{ values.RequestNo }}</h4> -->
                                    <div class="table-responsive"  >
                                            <table class="table table-bordered" >
                                               <tr > <th style="text-align:center">Request No   {{ form.AccountNo}}</th>
                                                <th style="text-align:center">Plate No.</th>
                                                <th style="text-align:center">Status</th>
                                                <th style="text-align:center">Mode</th>
                                                <th style="text-align:center">Commission</th>
                                                <th style="text-align:center">Remaining</th>
                                                <th style="text-align:center">CashOut</th>
                                                <th style="text-align:center">Paid Amount</th>
                                                <th></th>
                                                

                                               </tr>
                                                <tr v-for="log in logs" :key="log._id">
                                       
                                                    <td style="text-align:center">{{log.RequestNo }} </td>
                                                    <td style="text-align:center">{{log.PlateNumber}}</td>
                                                    <td style="text-align:center">{{log.StatusCashOut}}</td>
                                                    <td style="text-align:center" > {{ log.CashOutMode  }}</td>
                                                    <td style="text-align:right">{{log.CommissionAmount | peso}}</td>
                                                    <td style="text-align:right">{{log.TotalCommission | peso}}</td>
                                                    <td style="text-align:right" > {{log.CashOutAmount | peso}}</td>
                                                    <td style="text-align:right" > {{log.PaidAmount | peso}}</td>
                                                   
                                                    
                                                
                                                
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align:right">Total : </th>
                                                 <th style="border-top: 1px solid black;text-align:right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommissionAmount | peso}}</th>
                                                
                                                <th style="border-top: 1px solid black;text-align:right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCommission | peso}}</th>
                                                <td style="border-top: 1px solid black;text-align:right">{{ logs[parseFloat(this.logs.length) - 1].CompTotalCashOut | peso}}</td>
                                                <td style="border-top: 1px solid black;text-align:right">{{ logs[parseFloat(this.logs.length) - 1].TotalCashOutPaid | peso}}</td>


                                             </tr>

                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                               <!-- <pre>{{ $data }}</pre> -->

                                 <div class="row no-print" >
                                    <div class="col-xs-12">
                                    
                                    <button  @click="PrintReport()"
                                            type="button"
                                            class="btn btn-info pull-right"  
                                            >
                                            <i class="fa  fa-print"></i>
                                            Print Report
                                        </button>

                                    
                                    
                                        
                                    </div>
                                </div>
                          
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
         //this.loadLogs();
    },


    data() {
        return {
            details: {},
            UserDetails:{},
             logs: {},
             UserValPassword: {},
               isDisabled:true,

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
         PrintReport(){
            window.print();

        },


        PasswordInput(){
            alert();


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
                 let PassData               =  AccountNo + ";;" +  InputUserPassword;

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
            let PassData;
            if (this.form.StartDate == '' || this.form.EndDate == ''){
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let monthMinus = date.getMonth();
            let year = date.getFullYear();
            let EndDate = `${year}-${month < 10 ? '0' + month : '' + month}-${day < 10 ? '0' + day : '' + day}`;
            let StartDate = `${year}-${monthMinus < 10 ? '0' + monthMinus : '' + monthMinus}-${day < 10 ? '0' + day : '' + day}`;
                PassData =  this.UserDetails.AccountNo  + ";;" + StartDate  + ";;" +  EndDate; 
            }else{
                 PassData =  this.UserDetails.AccountNo  + ";;" + this.form.StartDate + ";;" + this.form.EndDate ;
             
            }
           // alert(PassData);
            axios.get('api/AgentCommissionForCashOut/' + PassData ).then(({data}) => {
                this.logs = data
               //  this.form.RequestNo = this.logs.RequestNo;
            }).catch((response) => {
                alert(response);
                     Swal.fire(
                        " No Record !",
                         " FOUND ",
                        "warning"
                     );

            })
           // alert(this.logs.length);
            console.log();
        }

    },  

    created() {
        let uri = window.location.href.split("?");
         this.RetrieveTimeInterval =  setInterval(() => {
        let PassID =  this.UserDetails.AccountNo ;
        
        axios
            .get("api/AgentCommReportCashOut/" + PassID)
            .then(({ data }) => (this.details = data));


       
            this.loadCommission();
            console.log(this.loadCommission());
        }
        , 1000)

      this.RetrieveTimeInterval2 = setInterval(() => {
                clearInterval(this.RetrieveTimeInterval);  
                  
            },3000) 
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
