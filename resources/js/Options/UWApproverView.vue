<style>
    #proposals {
        padding: 0px 50px 30px;
    }

    #quotehead {
        padding: 0px 10px;
    }
</style>


<template >

  <div>
    <section class="content-header">
      <h1>
        Quotations
        <small>List of Quotations Approved</small>
        <!--------{{data}}----->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation </li>
      </ol>
    </section>

    <!-- Main content -->
	
<section class="content"  >
      <div class="row"  >
    
        <div class="col-md-4" v-for="URLQueryPerilsCoveragesGroups in URLQueryPerilsCoveragesGroup" :key="URLQueryPerilsCoveragesGroups._id" >
          
           <div class="box box-solid">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h3>Quotation #:  {{ URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo }}</h3>
                </div>
                <div class="box-body" id="proposals" >
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo">
                                <small class="pull-right">Date: {{date }} </small>
							
                            </h2>
							<div v-if="showSecretWindow">
								<h1>This is a secret window, don't tell anyone!</h1>
							</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2 ">
                            <strong>Unit</strong> <strong class="pull-right">:</strong>
                        </div>
                        <div class="col-md-10 " v-for="ResultQueryRequests in ResultQueryRequest.data" :key="ResultQueryRequests._id">
                            <strong>{{ ResultQueryRequests.MotorYear }} {{ ResultQueryRequests.MotorBrand }}  {{ ResultQueryRequests.MotorModel }}  {{ ResultQueryRequests.MotorBodyType }}</strong>
                        </div>
                    </div>

                    <br>
                    <!---------------------------------------------Coverage----------------------------------->
                    <h3 style="text-align:center;color:blue">{{ form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo] }}</h3>
                    
                    <div class="row"    >
                        <div class="col-md-11" >
                              
                            <div class="table-responsive">
                                <table class="table" >
                                    <tbody>
                                        <tr v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages" :key="coverage._id">
                                         
                                            <td style="text-align:left"  >{{  coverage.PerilsName }} </td>
                                            <td>₱ {{  coverage.CoveragesAmount }}</td>
                                            <td>₱ {{  coverage.CoveragesPremium }}</td>
                                     
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="text-align:right">Total Premium</th>
                                            <td></td>
                                            <td>₱ {{ form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo] }} </td>
                                               <input type="hidden"    v-model='form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]'   class="form-control input-sm text-center"  readonly>
                                        </tr>
                                         <!---------------------------------------------Charges----------------------------------->
                                        <tr v-for="Charges in URLQueryPerilsCoveragesGroups.ListCharges" :key="Charges._id" >
                                            <th style="text-align:left" ><i> {{Charges.ChargesName}} </i></th>
                                            <td></td>
                                            <td >₱ {{Charges.ChargesPremium}}</td>
                                        </tr>
                                       
                                        <tr>
                                            <th><strong>Amount Due</strong></th>
                                            <td></td>
                                            <td id="total" >₱ {{ form.TotalAmountDue[URLQueryPerilsCoveragesGroups.OptionNo] }}</td>
                                        </tr>
                                        <br>
                                        <tr>
                                            <th><strong>Deductible</strong>    </th>
                                            <td v-for="ResultQueryRequests in ResultQueryRequest.data" :key="ResultQueryRequests._id"><strong>₱ {{ResultQueryRequests.Deductable}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                       
                    <form @submit.prevent=""> 
                            <input type="hidden"  v-model="form.AcceptQuotationPassData"  >
                         <div class="row text-center"  >
                           <div class="col-md-10">
                                    <div class="form-inline" style="text-align:left">
                                        <label for="accessories">Remarks: </label>
                                        {{ form.RemarksApprover[URLQueryPerilsCoveragesGroups.OptionNo] }}
                                          <br/><label for="accessories">Assigned Date: </label>
                                        {{  form.RemarksApproverDate[URLQueryPerilsCoveragesGroups.OptionNo] }}
                                      
                                         
                                </div>
                          </div>   

                          <div class="col-md-10">
                                    <div class="form-inline" style="text-align:left">
                                         <label for="accessories">Customer Remarks: </label>
                                        {{ form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo] }}
                                         <br/><label for="accessories">Accepted Date: </label>
                                        {{  form.RemarksCustomerDate[URLQueryPerilsCoveragesGroups.OptionNo] }}
                                         
                                         
                                    </div>
                          </div>

                            <div class="col-md-10">
                                        <label for="accessories">Remarks</label>
                                        <input type="text" class="form-control"  v-model="form.RemarksReviewee[URLQueryPerilsCoveragesGroups.OptionNo]"  >
                                        
                                     </div>
                           
                       
                        <div class="col-md-4">      
                                 <button class="btn btn-lg btn-success"  @click='UWApprovedQuotation()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksReviewee[URLQueryPerilsCoveragesGroups.OptionNo]" > Reviewed   </button>
                        </div> 
                            </div>
                      
                   
                    </form>
                </div>
            </div>
        </div>


</div>


        <div class="col-md-6" >
            <router-link class="btn btn-primary" to="/quotations-approved">Back</router-link>
        </div>
		
<!--------<pre>{{ $data }}</pre>-------->
      
    </section>
  </div>
</template>




<script>
export default {
 
  props : ['propMessage'],
   mounted: function(){ 
		console.log(this.surveyData);
       // let id = this.$route.params.id
        //console.log('mounted' + id)
         console.log('Component mounted.')  
       
        axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
        this.AutoLoadGetData();
          
   
        
    },

    data() {
        return {
            ResultQueryRequest:{},
            URLQueryPerilsCoverages:{},
            ResultLoginDetails:{},
            ListApproverQuotation:{},
            UserDetails:{},
            URLQueryPerilsCoveragesGroup:'',
            RetrieveTimeInterval:null,
             isShowing:false,
             isShowingApproval:true,
             isShowingPass:true,
             RetrieveTimeInterval2:null,
           
            form: new Form({
                TINNumber:'',
                EmailAddress:'',
                ContactNumber:'',
                FirstName:'',
                MiddleName:'',
                Address:'',
                Barangay:'',
                City:'',
                Denomination:'',
                RatePercent:'',
                Surcharge:'',
                CoverageAmount:'',
                TypeClass:'',
                MotorYear:'',
                MotorBrand:'',
                MotorModel:'',
                MotorType:'',
                SelectCoverageAmounts:[],
                ProductLine:'',
                SelectPremiumAmount:[],
                TxtSelectAmount:'',
                SelectTotalPremium:[],
                OptionNo:[],
                CoveragesNameDisplay:[],
                CoveragesAmountDisplay:[],
                CoveragesPremiumDisplay:[],
                TotalAmountDue:[],
                AcceptQuotationPassData:[],
                AcceptedQuotation:[],
                TxtCoverageAmount:[],
                DisplayRemarks:[],
                RemarksApprover:[],
                ListApprover:[],
                ListApproverDisplay:[],
                ListApproverDisplayName:[],
                 RemarksCustomer:[],
                 RemarksApprover:[],
                 RemarksReviewee:[],
                 RemarksApproverDate:[],
                 RemarksCustomerDate:[],
            }),
        }
    },

    methods: {
            AutoLoadGetData(){ 
                //alert(this.AccountNoUser);
                this.RetrieveTimeInterval = setInterval(() => {
                    let uri                 = window.location.href.split('?');
                    let PassID              = uri[1].trim();
                    let NewPassID           = PassID  + ';;' + this.UserDetails.AccountNo ;
                    axios.get("api/URLQueryRequest/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
                    axios.get("api/ListCoveragesForApprovalUW/" + NewPassID ) .then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data)  );
               }, 1000)

                 this.RetrieveTimeInterval2 = setInterval(() => {
                           clearInterval(this.RetrieveTimeInterval);  
                   },3000)           
        },
        QueryByOPtion1(e){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
             this.form.AcceptQuotationPassData = e.target.value.trim();
           
        
        },

        //  SetApproverQuotation(){
               
        
        //     this.form.post('api/SetApproverQuotation').then(() => {
        //             Fire.$emit('AfterCreate');
        //             console.log();
        //             this.$router.push('Home') ;
                  
        //         }).catch((response) => {
        //                 alert(response);

        //         });
        
        // },

         UWApprovedQuotation(){
         
            this.form.post('api/ReviewedQuotation').then(() => {
                    // Success!
                    Fire.$emit('AfterCreate');
                    console.log();
                    this.$router.push('Home') ;
                  
                }).catch((response) => {
                        alert(response);

                });
       
        
        }
 

    }, 
   

    created() {
        this.RetrieveTimeInterval = setInterval(() => {
            this.ResultQueryRequest.data.map((ResultRequestDetailss) => { 
                this.form.TINNumber          =ResultRequestDetailss.TINNumber;
                this.form.EmailAddress       =ResultRequestDetailss.EmailAddress;
                this.form.MotorBrand         =ResultRequestDetailss.MotorBrand;
                this.form.ContactNumber      =ResultRequestDetailss.ContactNumber;
                this.form.FirstName          =ResultRequestDetailss.FirstName;
                this.form.MiddleName         =ResultRequestDetailss.MiddleName;
                this.form.LastName           =ResultRequestDetailss.LastName;
                this.form.Address            =ResultRequestDetailss.Address;
                this.form.Barangay           =ResultRequestDetailss.Barangay;
                this.form.City               =ResultRequestDetailss.City;
                this.form.Denomination       =ResultRequestDetailss.Denomination;
                this.form.TypeClass          =ResultRequestDetailss.MotorBodyType;
                this.form.MotorYear          =ResultRequestDetailss.MotorYear;
                this.form.MotorBrand         =ResultRequestDetailss.MotorBrand;
                this.form.CoverageAmount     =ResultRequestDetailss.MotorPOAmount;
                this.form.RatePercent        =ResultRequestDetailss.RatePercent;
                this.form.MotorModel         =ResultRequestDetailss.MotorModel;
                this.form.MotorType          =ResultRequestDetailss.MotorBodyType;
                this.form.TxtPremiumAmount   =ResultRequestDetailss.PremiumAmount;
                this.form.AmountDue          =ResultRequestDetailss.AmountDue;
                this.form.ProductLine        =ResultRequestDetailss.ProductLine;
                this.form.Deductible         =ResultRequestDetailss.Deductable;
                
                this.$forceUpdate();   
            })

            this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                
                //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
                let CompCoveragesAmount = 0 ; let CompChargesAmount = 0 ; let CompCoverageAmount = 0 ; let DisplayText; 
                       URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoveragesURL) => {
                           
                           CompCoveragesAmount  +=  parseFloat(ListCoveragesURL.CoveragesPremium ) ;
                           CompCoverageAmount   +=  parseFloat(ListCoveragesURL.CoveragesAmount ) ;
                              
                             this.form.ListApproverDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     = ListCoveragesURL.Approver + ';;'+ ListCoveragesURL.ApproverName;
                          this.form.ListApproverDisplayName[URLQueryPerilsCoveragesGroups.OptionNo] = ListCoveragesURL.ApproverName;
                    
                            this.form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo]           = ListCoveragesURL.ClientRemarks;
                            this.form.RemarksApprover[URLQueryPerilsCoveragesGroups.OptionNo]           = ListCoveragesURL.ApproverRemarks;
                            this.form.RemarksApproverDate[URLQueryPerilsCoveragesGroups.OptionNo]       = ListCoveragesURL.ApproverRemarksDate;
                            this.form.RemarksCustomerDate[URLQueryPerilsCoveragesGroups.OptionNo]       = ListCoveragesURL.ClientRemarksDate;
           
                    
                    });
                                       
                      
                      this.form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo]       = DisplayText;     
                      this.form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]       = parseFloat(CompCoverageAmount) ;        

                              


                      URLQueryPerilsCoveragesGroups.ListCharges.map(( ListChargesURL) => {
                             CompChargesAmount   +=  parseFloat(ListChargesURL.ChargesPremium ) ;
                           
                             
                       });
                      this.$forceUpdate(); 
                     
                                      
                      let TotalAmountDue  =parseFloat(CompCoveragesAmount) + parseFloat(CompChargesAmount) ; 
                            this.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     =parseFloat(CompCoveragesAmount).toFixed(2)
                            
                            this.form.TotalAmountDue[URLQueryPerilsCoveragesGroups.OptionNo]                = parseFloat(TotalAmountDue).toFixed(2) ;
            })
 }, 1000)
                  

                     //alert(CompCoverageAmount);

                    this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                 },5000) 
                 //this.isShowingApproval = false;
               
                           
     
    },

    computed: {
        date() {
           let date = new Date()
           let day = date.getDate()
           let month = date.getMonth() + 1
           let year = date.getFullYear()
           return `${month} / ${day} / ${year}`
        },
		 
    }
}
</script>