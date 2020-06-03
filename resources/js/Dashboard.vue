
<template >

    <div id="MainPage" >
        <!-- Content Header (Page header) -->
        <!-- <section class="content" v-show="isShowingLoading" >
            
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->
           <!-- <section class="content" >
            
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-danger" >{{ this.ConnectionStatus  }}</big></h1>
                    <div class="spinner-border" role="status">
                         <h1> <big class="label label-danger" > <span class="sr-only">Loading...</span></big></h1>
                   <div class="overlay">
                         <i class="fa fa-refresh fa-spin" style="color:#00a65a"></i>
                 </div>
                   
                   
                    </div>
                </div>
         </section> -->

        <section class="content DisabledSection ContentSection"    >
             
            
            <div class="row"  >
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                             <div class="box-body table-responsive">
                    <table class="table table-hover text-center" >
                        <tbody>
                             <tr>
                                <th style="text-align:right" v-if="this.UserDetails.department === 'Agent'" >Agent Code :</th>
                                <th style="text-align:right" v-if="this.UserDetails.department === 'NONE'" >Account # :</th>
                                <th style="text-align:right" v-if="this.UserDetails.department !== 'NONE' && this.UserDetails.department !== 'Agent'" >Employee No.:</th>
                                <td style="text-align:left">{{ this.UserDetails.AccountNo }} </td>
                            </tr>


                            <tr>
                                <th style="text-align:right">Name :</th>
                                <td style="text-align:left">{{ this.UserDetails.CName }} </td>
                            </tr>

                              <tr>
                                <th style="text-align:right">Email Address :</th>
                                <td style="text-align:left">{{ this.UserDetails.email }} </td>
                            </tr>

                              <tr>
                                <th style="text-align:right">Department :</th>
                                <td style="text-align:left">{{ this.UserDetails.department }} </td>
                            </tr>


                              <tr>
                                <th style="text-align:right">Approved Limit :</th>
                                <td style="text-align:left">{{ this.UserDetails.ApprovedLimit | peso }} </td>
                            </tr>
                           
                        </tbody>
                    </table>
                  
                </div>     
                          
                        </div>  <!---End of Profile---->
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#Password" data-toggle="tab">Change Password </a>
                            </li>
                            <li>
                                <a href="#Commission" data-toggle="tab">Commission </a>
                            </li>
                            
                            
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="Password">
                                <div >
                                    <!-- <h4>Request #:{{ values.RequestNo }}</h4> -->
                                    <div class="table-responsive"  >
                                            <table class="table table-bordered" >
                                               <tr> 
                                                    <th style="text-align:center">Enter New Password</th>
                                                    <th style="text-align:center">
                                        <input
                                                v-model="form.NewPassword" type="password"
                                                    class="form-control"
                                                    name="NewPassword"
                                                    id="NewPassword"
                                                    placeholder="Enter New Password"
                                       
                                             />


                                                    </th>
                                                    <td> <button type="button"  @click="ChangePassword()" class="btn btn-primary"><i class="fa fa-pencil"></i> Submit</button></td>
                                               
                                               </tr>
                                                 
                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                           

                            <div class="tab-pane" id="Commission">
                                <div >
                                      
                                       <big class="label label-warning" v-if="this.ResultTotalCom === 'NO RECORD FOUND'">{{ this.ResultTotalCom  }} </big>
                                    <div class="table-responsive"  >
                                            <table class="table table-condensed" v-if="this.ResultTotalCom !== 'NO RECORD FOUND'" >
                                               <tr > 
                                                    <th style="text-align:center">Denomination</th>
                                                    <th style="text-align:center">Break -Down</th>
                                                    <th style="text-align:center">Comm Rate Total</th>
                                                 
                                               </tr>
                                                  <tr v-for="ResultTotalComs in ResultTotalCom" :key="ResultTotalComs._id">
                                                    <th style="text-align:center">{{ ResultTotalComs.ClassName }}</th>
                                                   
                                                    <td  style="text-align:center">
                                                        <div class="table-responsive"  >
                                                        <table class="table table-bordered">
                                                             <tr > 
                                                                <th >Perils</th><th></th>
                                                                <th >Comm. Rate %</th>
                                                             
                                                 
                                                            </tr>
                                                            <tr  v-for="BreakDown in ResultTotalComs.CommBreakdown"  :key="BreakDown._id">
                                                                <th> {{ BreakDown.PerilsCode }}</th><th>: </th>
                                                                <td>{{ BreakDown.AmountCom }} </td>
                                                            </tr>
                                                            
                                                        </table> 
                                                        </div>
                                                    </td>
                                                     <th style="text-align:center">{{ ResultTotalComs.TotalAmountComm }}</th>
                                                  
                                                  </tr> 

                                                
                                               

                                            </table>

                                    </div>
                                    
                                </div>
                            </div>
                               <!-- <pre>{{ $data }}</pre> -->

                                 <div class="row no-print" >
                                    <div class="col-xs-12">
                                        
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
   

    mounted() {
        console.log('Component mounted.')
        axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
        
        this.StartLoading();
       // this.form.UserID = this.UserDetails.AccountNo;
       
    },

    data() {
        return {
            UserDetails:{},
            ResultTotalCom:{},
            RetrieveTimeInterval2:null,
            RetrieveTimeInterval:null,



             form: new Form({
                 NewPassword:'',
                UserID:''
            })
        }
    },

    methods: {
       async StartLoading() {
          
              
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer:2000,
                timerProgressBar: true,
                icon: 'info',
               // background: '#f39c12',
                timerProgressBarColor:"#00a65a",
             
                allowOutsideClick: false,
                allowEscapeKey: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                     $(".ContentSection").removeClass("DisabledSection");
                     this.GetAgentComReport();
                      
                }
                }).then((result) => {
               
                })
              
            },

       
         GetAgentComReport(){ 

            axios.get("api/GetAgentTotalComReportAll/" + this.UserDetails.AccountNo ) .then(({ data }) => (this.ResultTotalCom = data)  ); 
         
        },

        

       async ChangePassword(){
           this.form.UserID = this.UserDetails.AccountNo;
                if (!this.form.NewPassword.length )  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Enter YOUR new Password',
              
                })
            }else{
                    Swal.fire({
                    title: " CONFIRMED ?",
                    text: " PASSWORD Change",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                    }).then(result => {
                        if (result.value) {
                                
                            this.form.post('api/ChangePassword' ).then(() => {
                                // Success!
                                Swal.fire(
                                    ' Successful! ',
                                    `PASSWORD has been CHANGED.`,
                                    'success'
                                )
                                this.GetAgentComReport();
                                this.form.reset();
                                }).catch(error => {
                                        this.fetchError = error;
                                   
                                        if ( error == "Error: Request failed with status code 405"){
                                                alert( 'NO ACCESS');
                                        }else{
                                                alert(error);
                                        }
                                });
                          
                            } 
                    })






            }

                
      }


  },  //close methods



   
}
</script>
<style scoped>

    li.list-group-item>a {
        text-decoration: none;
        cursor: pointer;
    }
   

    
</style>
