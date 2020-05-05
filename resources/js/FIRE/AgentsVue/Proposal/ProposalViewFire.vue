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
	
<!-- <section class="content"  v-if="form.CustAcctNO.trim() ===  UserDetails.AccountNo.trim()"> -->
<section class="content" >
      <div class="row"  >
    
        <div class="col-md-6" v-for="ProposalViewFireGets in ProposalViewFireGet" :key="ProposalViewFireGets._id" >
          
           <div class="box box-solid">
                <div class="box-header with-border box box-danger" id="quotehead" >
                    <h4>Quotation #:  {{ ProposalViewFireGets.RequestNo + "-" + ProposalViewFireGets.OptionNo }}</h4>
                </div>
                <div class="box-body" id="proposalBody" >
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header">
                                <img src="('/../img/rsilogo.png')" alt="RSILogo" id="quoteslogo" style="height: 50px;">
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
                                            <tr><th style="text-align:left">TO</th> <th>:</th> <th>{{ ProposalViewFireGets.CName}}</th></tr>
                                             <tr><th style="text-align:left"><br/></th></tr>
                                            <tr><th style="text-align:left">FROM</th> <th>:</th> <th> Josephine Bino{{ ProposalViewFireGets.AssignCRD}} <br/> 
                                                    <small>
                                                    <b>Customer Relations Department</b>
                                                </small></th></tr>
                                            <tr><th style="text-align:left"><br/></th></tr>
                                            <tr><th style="text-align:left">SUBJECT</th> <th>:</th> <th><u> FIRE INSURANCE PROPOSAL</u></th></tr>

                                    </table>
                            </div>
                        </div> <br/>

                     <div class="row">
                            <div class="col-md-12">
                                <p>We take pleasure to submit hereunder our Fire Insurance Proposal for your review and approval: </p>

                            </div>
                        </div>
                  
                    <!---------------------------------------------Coverage----------------------------------->
                  
                    <div class="row"    >
                        <div class="col-md-11" >
                              
                            <div class="table-responsive">
                                <table style="width:100%" >
                                          
                                
                                                <tr>
                                                    <th style="text-align:right"> 1. </th>
                                                     <td style="width:150px"> Insured </td> <th style="text-align:center;width:20px"> : </th>
                                                    <td>{{  ProposalViewFireGets.AssuredName }} </td>
                                                
                                                </tr>
                                                  <tr>
                                                    <th style="text-align:right"> 2. </th>
                                                     <td > Location of Risk </td> <th style="text-align:center;width:20px"> : </th>
                                                    <td>{{  ProposalViewFireGets.PropertyAddress }} </td>
                                                
                                                </tr>
                                                  <tr>
                                                    <th style="text-align:right"> 3. </th>
                                                     <td > Properties </td> <th style="text-align:center;width:20px"> : </th>
                                                    <td>{{  ProposalViewFireGets.SubName }} </td>
                                                
                                                </tr>
                                                 <tr>
                                                    <th style="text-align:right"> 4. </th>
                                                     <td > Peril Covered </td> <th style="text-align:center;width:20px"> : </th>
                                                    <td>
                                                        <table>
                                                            <tr v-for="coverage in ProposalViewFireGets.ListCoverages" :key="coverage._id">    
                                                                <td >
                                                                  {{  coverage.PerilsDecription }} 
                                                                 </td>   
                                                            </tr>
                                                        </table>
                                                            
                                                      
                                                  </td>
                                                
                                                </tr>
                                                 <tr>
                                                    <th style="text-align:right"> 5. </th>
                                                     <td > Total Sum Insured </td> <th style="text-align:center;width:50px"> : </th>
                                                    <td>{{  ProposalViewFireGets.MarketValue | Peso  }} </td>
                                                
                                                </tr>
                                                  <tr>
                                                    <th style="text-align:right"> 6. </th>
                                                     <td >  Annual Premium </td> <th style="text-align:center;width:50px"> : </th>
                                                   
                                                
                                                </tr>
                                             

                                                <!-- <tr v-for="coverage in ProposalViewFireGets.ListCoverages" :key="coverage._id">
                                                    <td>{{  coverage.Rate }} </td>
                                                    <td>{{  coverage.PerilsDecription }} </td>
                                                    <td style="text-align:right">{{  coverage.MarketValue | Peso }}</td>
                                                     <td style="text-align:right" >{{  coverage.CoveragesPremium | Peso }}</td>
                                                 
                                                </tr> -->
                                                <!---------Total Premium--------------------->
                                          </table>
                                     </div>
                                 <div class="table-responsive">
                                        <table style="width:100%" >
                                                <tr>
                                         
                                                    <td> </td>  <td> </td>  
                                                    <th style="text-align:right;font-style: italic;">Basic Premium</th>
                                                      <td  style="text-align:right;text-decoration-line: overline;text-decoration-style: double;font-style: italic;">{{  ProposalViewFireGets.TotalPremium | Peso }} </td>

                                               </tr>   
                                                    <!-- -------Charges------------------- -->
                                                 <tr v-for="Charges in ProposalViewFireGets.ListCharges" :key="Charges._id">
                                         
                                                    <th></th><th></th>
                                                    <td style="text-align:right">{{Charges.Description}}</td>
                                                    <td style="text-align:right">{{Charges.PremiumCharges | Peso}}</td>
                                                </tr>
                                                   <!---------TOTAL AMOUNT--------------------->    
                                                 <tr> 
                                                    <th></th><th></th>
                                                    <th style="text-align:right" >TOTAL AMOUNT</th>
                                                     <th style="text-align:right;text-decoration-line: underline;text-decoration-style: double;font-style: italic;" >{{ parseFloat(ProposalViewFireGets.TotalAmountDue)  | Peso}}</th>
                                                </tr>

                                                 <tr> <!---------TOTAL AMOUNT--------------------->
                                                    <th><br/></th>
                                                </tr>
                                                    <!---------Deductible AMOUNT--------------------->
                                                  <!-- <tr> 
                                                    <th></th>
                                                    <th style="text-align:right" >Deductible : </th>
                                                    <th  style="text-align:left;" >{{ " " + ProposalViewFireGets.Deductible | Peso}}</th>
                                                </tr> -->


                                        
                                    
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
        
        axios.get("api/ProposalViewFire/" + PassID ) .then(({ data }) => (this.ProposalViewFireGet = data)  );
       
    },

    data() {
        return {
         
            URLQueryPerilsCoverages:{},
            ResultLoginDetails:{},
			ListApproverQuotation:{},
           
            RetrieveTimeInterval:null,
             isShowing:false,

               Wordings: {},
               UserDetails:{},
               ProposalViewFireGet:{},
            form: new Form({
                TINNumber:'',
              
                
             

            }),
        }
    },

    methods: {

   
 

    }, 
   

    created() {
         axios.get('api/wordings').then(({data}) => this.Wordings = data)
     
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