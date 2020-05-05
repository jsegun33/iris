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
       
    }
</style>


<template >

  <div>
    <section class="content-header">
      <h1>
        Quotations
        <small>List of Quotations Approved</small>
        {{data}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation </li>
      </ol>
    </section>

    <!-- Main content -->
	
<section class="content"  v-if="form.CustAcctNO.trim() ===  UserDetails.AccountNo.trim()">
      <div class="row"  >
    
        <div class="col-md-6" v-for="URLQueryPerilsCoveragesGroups in URLQueryPerilsCoveragesGroup" :key="URLQueryPerilsCoveragesGroups._id" >
          
           <div class="box box-solid">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h4>Quotation #:  {{ URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo }}</h4>
                </div>
                <div class="box-body" id="proposalBody" >
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo" style="height: 50px;">
                                <small class="pull-right">Date: {{date }} </small>
							
                            </h2>
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
                        </div> <br/>

                     <div class="row">
                            <div class="col-md-12">
                                <p>We are pleased to submit our Motor Car Insurance Proposal for your review and approval.</p>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-md-12 text-center">
                                <p v-for="ResultQueryRequests in ResultQueryRequest.data" :key="ResultQueryRequests._id">
                                    <strong>
                                       {{ ResultQueryRequests.SubLinesName }}: {{ ResultQueryRequests.MotorYear }} {{ ResultQueryRequests.MotorBrand }}  {{ ResultQueryRequests.MotorModel }}  {{ ResultQueryRequests.MotorBodyType }}
                                    </strong>
                                </p>
                            </div>
                        </div> 
                    <!---------------------------------------------Coverage----------------------------------->
                    <h3 style="text-align:center;color:blue" >{{ form.AcceptedQuotationDisplay[URLQueryPerilsCoveragesGroups.OptionNo]  }}</h3>
                      <strong> Rate :  </strong>  {{  URLQueryPerilsCoveragesGroups.CoverageRates  + "%"  }} 
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
                                                    <td style="text-align:right">{{  coverage.CoveragesAmount | Peso }}</td>
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
                        <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <pre id="statetment"><br/>
                                {{ Wordings.Statement }}
                            </pre>
                        </div>
                    </div>
                       
               </div>   
            </div>
        </div>


</div>
		
<!-----------<pre>{{ $data }}</pre>--------------->
      
    </section>
  </div>
</template>




<script>
export default {
 
 // props : ['propMessage'],
   mounted: function(){ 
	 axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim() + ";;0";
                  
			
        axios.get("api/URLQueryRequest/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
        axios.get("api/CustomerAcceptedCoverageView/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data)  );
       
    },

    data() {
        return {
            ResultQueryRequest:{},
             UserDetails:{},
            URLQueryPerilsCoverages:{},
            ResultLoginDetails:{},
			ListApproverQuotation:{},
            URLQueryPerilsCoveragesGroup:'',
            RetrieveTimeInterval:null,
             isShowing:false,
              Wordings: {},
            
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
                AcceptedQuotationDisplay:[],
                TxtCoverageAmount:[],
                AcctName: '',
                AssignCRD: '',
                NoAOG:[],
                NoAOGCoveragePremium:[],
                AcceptedOption : '',
                OptionWithAOG:[],
                CustAcctNO: '',
            
                
             

            }),
        }
    },

    methods: {

   
 

    }, 
   

    created() {
         axios.get('api/wordings').then(({data}) => this.Wordings = data)
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
                this.form.AcctName           =ResultRequestDetailss.FirstName + " " + ResultRequestDetailss.MiddleName + " " + ResultRequestDetailss.LastName ;
                this.form.AssignCRD          =ResultRequestDetailss.AssignCRD;
                this.form.NoAOG              =ResultRequestDetailss.WithAOG;
                this.form.OptionWithAOG      =ResultRequestDetailss.OptionWithAOG;
                this.form.AcceptedOption     =ResultRequestDetailss.AcceptedOption;
                this.form.CustAcctNO         =ResultRequestDetailss.CustAcctNO;
                
                this.$forceUpdate();   
            })

            this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                
                //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
                let CompCoveragesAmount = 0 ; let CompChargesAmount = 0 ; let CompCoverageAmount = 0 ; let DisplayText; let NoAOGDisplay  ;let AOG ;
                       URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoveragesURL) => {
                           
                           CompCoveragesAmount  +=  parseFloat(ListCoveragesURL.CoveragesPremium ) ;
                           CompCoverageAmount  +=  parseFloat(ListCoveragesURL.CoveragesAmount ) ;
                                         if ( ListCoveragesURL.Status == 4  ){
                                            
                                            DisplayText = "Accepted Option" ;
                                            this.isShowing =false;
                                              
                                              if (this.form.OptionWithAOG.trim() == "YES"){
                                                  AOG  =  " With AOG" ;
                                              }else{
                                                  AOG  =  " Without AOG" ;
                                              }
                                        
                                        }else{
                                            DisplayText = "New Option" ;
                                            this.isShowing =true;
                                            AOG  =  " " ;
                                        }
                                        
                                            //NoAOGDisplay        =   ListCoveragesURL.NoAOG.trim();  
                                             //this.form.NoAOG[URLQueryPerilsCoveragesGroups.OptionNo]  = NoAOGDisplay ; 
                                              
                     });
                       
                         this.form.AcceptedQuotationDisplay[URLQueryPerilsCoveragesGroups.OptionNo]       = DisplayText + AOG  ;  

                     
                      this.form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]       = parseFloat(CompCoverageAmount) ;        

                      URLQueryPerilsCoveragesGroups.ListCharges.map(( ListChargesURL) => {
                             CompChargesAmount   +=  parseFloat(ListChargesURL.ChargesPremium ) ;
                           
                             
                       });
                      this.$forceUpdate(); 
                     
                                      
                            let TotalAmountDue  = parseFloat(CompCoveragesAmount) + parseFloat(CompChargesAmount) ; 
                            this.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     =   parseFloat(CompCoveragesAmount).toFixed(2)
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