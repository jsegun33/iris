<style>
    #proposalBody {
        padding: 0px 30px 30px;
    }

    #quotehead {
        padding: 0px 10px;
    }

    td {
        text-align: left;
    }

    #charges {
        padding: 6px;
        padding-right: 40px;
    }

    #coverage, #premium {
        padding: 6px;
    }

    #TotalPremium {
        text-decoration-line: underline;
        text-decoration-style: double;
    }

    #AmountDue {
        text-decoration-line: underline;
        text-decoration-style: double;
        padding: 6px;
        padding-right: 40px;
    }
</style>


<template >

  <div>
    <!-- <section class="content-header">
      <h1>
        Quotations
        <small>List of Quotations Approved</small>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation </li>
      </ol>
    </section> -->

    <!-- Main content -->
	
<section class="content"  >
      <div class="row"  >
    
        <div class="col-md-6" v-for="URLQueryPerilsCoveragesGroups in URLQueryPerilsCoveragesGroup" :key="URLQueryPerilsCoveragesGroups._id" >
              <div class="box box-solid">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h4>Quotation #:  {{ URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo }}</h4>
                </div>
                <div class="box-body" id="proposalBody" >
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-header">
                                <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo" style="height: 50px;">
                                <small class="pull-right">Date: {{date }} </small>
							
                            </h4>
							<div v-if="showSecretWindow">
								<h1>This is a secret window, don't tell anyone!</h1>
							</div>
                        </div>
                    </div>
                    
                     <div class="row">
                            <div class="table-responsive">
                                    <table style="width:100%" >
                                            <tr><th style="text-align:left">TO</th> <th>:</th> <th>{{ form.AcctName}}</th></tr>
                                             <tr><th style="text-align:left"><br/></th></tr>
                                            <tr><th style="text-align:left">FROM</th> <th>:</th> <th>{{ form.AssignCRD}} <br/> 
                                                    <small>
                                                    <b>Customer Relations Department</b>
                                                </small></th></tr>
                                            <tr><th style="text-align:left"><br/></th></tr>
                                          <tr><th style="text-align:left">SUBJECT</th> <th>:</th> <th> MOTORCAR INSURANCE PROPOSAL</th></tr>

                                    </table>
                            </div>
                </div><br/>



                     <div class="row">
                        <div class="col-md-4 ">
                            <strong>Quote Expiration :</strong> 
                        </div>
                        <div class="col-md-8 " >
                            <strong>{{ ResultQueryRequest.QuoteExpiry | DateFormat}} </strong>
                        </div>
                    </div>

                    <!---------------------------------------------Coverage----------------------------------->
                    <h3 style="text-align:center;color:blue">{{ form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo] }}</h3>
                    
					
					  
                    <div class="row">
                        <div class="col-md-4 ">
                            <strong>Coverage Rate :</strong> {{ URLQueryPerilsCoveragesGroups.CoverageRates + ' %'}}
					
                        </div>
                       
                    </div>
					
					
                    <div class="row"    >
                        <div class="col-md-11" >
                              
                            <div class="table-responsive">
                                 <table style="width:100%" >
                                            <tr>
                                                <th style="border: 1px solid black;border-left:transparent;border-top:transparent;border-right:transparent">Perils Name</th>
                                                <th style="border: 1px solid black;border-left:transparent;border-top:transparent;border-right:transparent">Coverages</th> 
                                                <th  v-if = "form.NoAOG  ==='YES'"    style="text-align:right;border: 1px solid black;border-left:transparent;border-top:transparent;border-right:transparent">W /o AOG <br/>Premium</th> 
                                                <th  style="text-align:right;border: 1px solid black;border-left:transparent;border-top:transparent;border-right:transparent">W/ AOG <br/>Premium</th>
                                            </tr>
                                            <tbody>
                                                <tr v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages" :key="coverage._id">
                                                
                                                    <td>{{  coverage.PerilsName }} </td>
                                                    <td style="text-align:right" >{{  coverage.CoveragesAmount | Peso }}</td>
                                                    <td style="text-align:right"  v-if = "coverage.PerilsCode  ==='AOG' && form.NoAOG  ==='YES'"> NONE </td>
                                                    <td style="text-align:right"  v-if = "coverage.PerilsCode  !='AOG' && form.NoAOG  ==='YES'">{{  coverage.CoveragesPremium | Peso }}</td>
                                                    <td style="text-align:right" >{{  coverage.CoveragesPremium | Peso }}</td>
                                                </tr>
                                                <!---------Total Premium--------------------->
                                                <tr>
                                         
                                                <td> </td>  
                                                <th style="text-align:right;font-style: italic;">Total Premium </th>
                                                <td  v-if = "form.NoAOG  ==='YES'" style="text-align:right;text-decoration-line: overline;text-decoration-style: double;font-style: italic;">{{ URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal | Peso }} </td>
                                                <td  style="text-align:right;text-decoration-line: overline;text-decoration-style: double;font-style: italic;">{{  URLQueryPerilsCoveragesGroups.TotalPremium | Peso }} </td>

                                            </tr><!---------Charges--------------------->
                                                 <tr v-for="Charges in URLQueryPerilsCoveragesGroups.ListCharges" :key="Charges._id">
                                         
                                                    <th></th>
                                                    <td style="text-align:right">{{Charges.ChargesName}}</td>
                                                    <td v-if = "form.NoAOG  ==='YES'" style="text-align:right">{{Charges.ChargesPremiumAOG | Peso}}</td>
                                                    <td style="text-align:right">{{Charges.ChargesPremium | Peso}}</td>
                                                </tr>
                                                       
                                                 <tr> <!---------TOTAL AMOUNT--------------------->
                                                    <th></th>
                                                    <th style="text-align:right" >TOTAL AMOUNT</th>
                                                    <th v-if = "form.NoAOG  ==='YES'" style="text-align:right;text-decoration-line: underline;text-decoration-style: double;font-style: italic;" >{{ parseFloat(URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal) + parseFloat(URLQueryPerilsCoveragesGroups.TotalChargesAOG ) | Peso}}</th>
                                                    <th style="text-align:right;text-decoration-line: underline;text-decoration-style: double;font-style: italic;" >{{ parseFloat(URLQueryPerilsCoveragesGroups.TotalAmountDue)  | Peso}}</th>
                                                </tr>

                                                 <tr> <!---------TOTAL AMOUNT--------------------->
                                                    <th><br/></th>
                                                </tr>

                                                  <tr> <!---------Deductible AMOUNT--------------------->
                                                    <th></th>
                                                    <th style="text-align:right" >Deductible : </th>
                                                    <th  style="text-align:left;" >{{ " " + URLQueryPerilsCoveragesGroups.Deductible | Peso}}</th>
                                                </tr>


                                            </tbody>
                                    
                                        </table>
                            </div>
                                
                        </div>
                    </div>

                   <div class="row">
                <div class="col-md-12">
                  <pre id="statetment">
                                {{ Wordings.Statement }}
                            </pre>
                </div>
              </div>
                       
                    <form @submit.prevent=""> 
                       
                              <input type="hidden"  v-model="form.AcceptQuotationPassData"  >
                              
                              <div class="row text-center"   v-show="isShowingPass"  v-if="parseFloat(form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]) < parseFloat(UserDetails.ApprovedLimit)  "  >
                                <button v-if="form.CoveragesStatus[URLQueryPerilsCoveragesGroups.OptionNo] == 1" class="btn btn-lg btn-success" @click='MktgApprovedQuotation()' @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;'  + UserDetails.AccountNo + ';;' + UserDetails.CName" > Approve </button>
                            </div>

                             <div class="form-inline" v-if="form.CoveragesStatus[URLQueryPerilsCoveragesGroups.OptionNo] == 3" >
                                        <label for="accessories">Approved By: {{ form.CoveragesApproverName[URLQueryPerilsCoveragesGroups.OptionNo] }} <br/>    {{ form.CoveragesApproverDate[URLQueryPerilsCoveragesGroups.OptionNo]}} </label>
                                      
                                       
                                </div>

                             <div class="row text-center" v-if="parseFloat(form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]) >= parseFloat(UserDetails.ApprovedLimit)"  >
                                <div class="col-md-12" v-if="form.CoveragesStatus[URLQueryPerilsCoveragesGroups.OptionNo] == 1" >
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="accessories">Approver:</label>  
                                            <select class="form-control input-sm" @click='LoadApprover(URLQueryPerilsCoveragesGroups)' v-model="form.ListApprover[URLQueryPerilsCoveragesGroups.OptionNo]" >
                                                <option value="" selected disabled >Select Approver</option>
                                                <option    v-for="ListApproverQuotations in ListApproverQuotation" :key="ListApproverQuotations._id"  v-bind:value="ListApproverQuotations._id + ';;' + ListApproverQuotations.CName + ';;' + ListApproverQuotations.AccountNo"  >{{ ListApproverQuotations.CName }}</option>
                                            </select>
                                        
                                        </div>
                            
                                        <div class="form-group" v-if="parseFloat(form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo])">
                                            <label for="accessories">Remarks:</label>
                                            <textarea  class="form-control"  v-model="form.RemarksApprover[URLQueryPerilsCoveragesGroups.OptionNo]"  >
                                            </textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>  
                                <div class="row text-center"> 
                                    <div class="col-md-4"></div>    
                                    <div class="col-md-4"  v-if="form.CoveragesStatus[URLQueryPerilsCoveragesGroups.OptionNo] == 1" >      
                                        <button class="btn btn-lg btn-success"  @click='SetApproverQuotation()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksApprover[URLQueryPerilsCoveragesGroups.OptionNo] + ';;' + form.ListApprover[URLQueryPerilsCoveragesGroups.OptionNo] + ';;'  + UserDetails.AccountNo + ';;' + UserDetails.CName" > Assign Approver  </button>
                                    </div>  
                                    <div class="col-md-4"></div> 
                                </div>
                                <br>
                                <div class="row text-center">
                                     <router-link class="btn btn-md btn-primary" to="/proposal-lists" style="text-decoration: none;">Back</router-link>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		
<!-------------<pre>{{ $data }}</pre>----------->
      
    </section>
  </div>
</template>




<script>
export default {
   mounted: function(){ 
	
         console.log('Component mounted.')  
         	axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
            this.AutoLoadGetData();
            this.StartLoading();
    },

    data() {
        return {
		Wordings: {},
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
                QuoteExpiryStatus:'',
                CoveragesStatus:[],
                CoveragesApproverName:[],
                CoveragesApproverDate:[],
				NoAOG:'',
				AcctName:'',
				AssignCRD:'',
                
             

            }),
        }
    },

    methods: {
        async StartLoading() {
              
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 3000,
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
                }
                }).then((result) => {
               
                })
              
            },


         AutoLoadGetData(){ 
					axios.get("api/wordings").then(({ data }) => (this.Wordings = data));
         
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
         //alert(TotalCoverages);
                    axios.get("api/URLQueryRequest/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
                    axios.get("api/URLQueryPerilsCoveragesGroup/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data)  );
           },

         LoadApprover(URLQueryPerilsCoveragesGroups){ 
                        //this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                                        let TotalCoverages   =  parseFloat(this.form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]);
                                        
                                        axios.get('api/ListApproverQuotation/' + TotalCoverages) .then(({ data }) => (this.ListApproverQuotation = data)  );
                                        this.$forceUpdate();
                                       // alert(TotalCoverages);
                            //})
         },



        QueryByOPtion1(e){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
             this.form.AcceptQuotationPassData = e.target.value.trim();
           
        
        },

         SetApproverQuotation(){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
           
            this.form.post('api/SetApproverQuotation').then(() => {
                    // Success!
                    Swal.fire(
                        'Assigned!',
                        `Successfully Assigned.`,
                        'success'
                    )
                    Fire.$emit('AfterCreate');
                    console.log();
                    // this.$router.push('/dashboard');
                    this.$forceUpdate();
                }).catch((response) => {
                        alert(response);

                });
        
        },

         MktgApprovedQuotation(){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
           
            this.form.post('api/MktgApprovedQuotation').then(() => {
                    // Success!
                     Swal.fire(
                        'Approved!',
                        `Successfully Approved.`,
                        'success'
                    )
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
                this.form.QuoteExpiryStatus  =ResultRequestDetailss.QuoteExpiryStatus;
				  this.form.NoAOG              = ResultRequestDetailss.WithAOG;

          this.form.AcctName =
            ResultRequestDetailss.FirstName +
            " " +
            ResultRequestDetailss.MiddleName +
            " " +
            ResultRequestDetailss.LastName;
          this.form.AssignCRD = ResultRequestDetailss.AssignCRD;
                
                this.$forceUpdate();   
            })

            this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                
                //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
                let CompCoveragesAmount = 0 ; let CompChargesAmount = 0 ; let CompCoverageAmount = 0 ; let DisplayText; 
                       URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoveragesURL) => {
                           
                           CompCoveragesAmount  +=  parseFloat(ListCoveragesURL.CoveragesPremium ) ;
                           CompCoverageAmount   +=  parseFloat(ListCoveragesURL.CoveragesAmount ) ;
                              
                          this.form.RemarksApprover[URLQueryPerilsCoveragesGroups.OptionNo]         = ListCoveragesURL.ApproverRemarks;
                          this.form.ListApproverDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     = ListCoveragesURL.ApproverName;
                                    
                                    if ( ListCoveragesURL.Status == 3 ){
                                            this.isShowing =false;
                                        }else{
                                         
                                            this.isShowing =true;
                                        }
                        this.form.CoveragesStatus[URLQueryPerilsCoveragesGroups.OptionNo]         =  ListCoveragesURL.Status;  
                        this.form.CoveragesApproverName[URLQueryPerilsCoveragesGroups.OptionNo]         =  ListCoveragesURL.ApproverNameQuote;
                        this.form.CoveragesApproverDate[URLQueryPerilsCoveragesGroups.OptionNo]         =  ListCoveragesURL.ApproverRemarksDate;  
                     
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
 },200)
                  

                     //alert(CompCoverageAmount);

                    this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                 },2000) 
                 //this.isShowingApproval = false;
               
                           
     
    },

    filters: {
        peso(amount) {
            const amt = Number(amount)
            return '₱ ' + amt.toLocaleString('ko-KR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
        },
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