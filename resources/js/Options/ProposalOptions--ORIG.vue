<style>
    #statetment {
        overflow: visible;
        text-align: left;
        white-space: pre-line;
        background: white;
        border-style: none;
        font-family: Arial, Helvetica, sans-serif;
        padding: 0;
    }

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

    .modal {
        text-align: center;
        padding: 0!important;
    }

    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }

    .modal-body {
        padding: 25px;
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
	
    <section class="content"  >
        <div class="row" >
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
                                            <tr><th style="text-align:left">SUBJECT</th> <th>:</th> <th>{{ form.AcctName}}</th></tr>

                                    </table>
                            </div>
                        </div><br/>

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
                          <h3 style="text-align:center;color:blue" >{{ form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo] }}</h3>
                         <strong> Rate :  </strong>  {{  URLQueryPerilsCoveragesGroups.CoverageRates  + "%"   }} 
                          <input type="hidden"    v-model='form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]'   class="form-control input-sm text-center"  readonly>
                                      
                        <div class="row" v-if="URLQueryPerilsCoveragesGroups.StatusCovetages === 3 || URLQueryPerilsCoveragesGroups.StatusCovetage === 4">
                             <div class="col-md-12">
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
                            <pre id="statetment"> <br/>
                                {{ Wordings.Statement }}
                            </pre>
                        </div>
                    </div>
                       
                    <form @submit.prevent=""> 
                        <input type="hidden"  v-model="form.AcceptQuotationPassData"  >
                        <input type="hidden"  v-model="form.Accessories"  >

                            <div class="row text-center"  v-if="(form.QuoteExpiryStatus == 1 || form.QuoteExpiryStatus == 3) && URLQueryPerilsCoveragesGroups.StatusCovetages === 3"  >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="accessories">Remarks : </label>
                                        <textarea type="text" class="form-control"  v-model="form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo]"  ></textarea>
                                    </div>
                                </div> 
                            </div>
                      
                            <div class="row text-center"   v-if="(form.QuoteExpiryStatus === 1 || form.QuoteExpiryStatus === 3) && URLQueryPerilsCoveragesGroups.StatusCovetages ===3"    >
                                <!-- <button class="btn btn-lg btn-success" @click='QueryByOPtion()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo] + ';;' + URLQueryPerilsCoveragesGroups.TotalAmountDue"    > ACCEPT    </button>
                                <br> -->
                                <button type="button" class="btn btn-lg btn-success"  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo] + ';;' + URLQueryPerilsCoveragesGroups.TotalAmountDue + ';;' + URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal + ';;' + URLQueryPerilsCoveragesGroups.TotalChargesAOG" data-toggle="modal" data-target="#acceptModal">
                                    Accept  
                                </button>
                                <br>
                                <a href="#" class="text-red" style="text-decoration: underline;">Decline</a>
                            </div>


                            <div class="row text-center"  v-show="isShowing"  v-if="form.QuoteExpiryStatus == 2"   >
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="accessories">Send Messages</label>
                                        <input type="text" class="form-control"  v-model="form.CustMessage[URLQueryPerilsCoveragesGroups.OptionNo]"  >
                                </div>
                          </div>     


                            <button type="button" class="btn btn-lg btn-success" @click='ComposeMessageCustomer()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.CustMessage[URLQueryPerilsCoveragesGroups.OptionNo]" > Submit    </button><br>
                            <a class="text-red" style="text-decoration: underline;">Decline</a>
                        </div>
                    </form>
                </div>
            </div>
     

    <!-- Modal -->
        <div class="modal fade" id="acceptModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Additional Details</h4>
              </div>
              <div class="modal-body">
			 <div class="row">
			 <div class="col-md-12">
                     
					 <div class="col-md-11">
                          <div class="form-group">
                              <input v-model="form.OptionWithAOG" type="radio" id="ds" value="YES">
                              <label for="sameAddress1">With Acts of Nature	</label><br/>
							   <small>(if selected,Your Policy Total Amount Due: {{ form.ModalDisplayTotalAmountDue  | Peso}})</small>
                              <br>
							
                              <input v-model="form.OptionWithAOG" type="radio" id="dsd" value="NO" >
                              <label for="differentAddress1">Without Acts of Nature</label>
							  <br/>
							   <small>(if selected,Your Policy Total Amount Due: {{  form.ModalDisplayWithAOG  | Peso}} )</small>
                             
                               
                          </div>
                 </div>
				
					</div>     
			</div> 	 

                
				<br/>
				 <div class="row">	
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for="">MV File No. :</label>
                      </div>
                      <div class="col-md-4">
                          <input v-model="form.mvFileNo" type="text" class="form-control input-sm" placeholder="Enter MV File No."/>
                      </div>
                      <div class="col-md-1">
                        <span class="label" style="color: red; padding: 0px;" v-if="!form.mvFileNo">*</span>
                      </div>
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for="">Engine No. :</label>
                      </div>
                      <div class="col-md-4">
                          <input v-model="form.engineNo" type="text" class="form-control input-sm" placeholder="Enter Engine No."/>
                      </div>
                      <div class="col-md-1">
                        <span class="label" style="color: red; padding: 0px;" v-if="!form.engineNo">*</span>
                      </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for="">Chassis No. :</label>
                      </div>
                      <div class="col-md-4">
                          <input v-model="form.chassisNo" type="text" class="form-control input-sm" placeholder="Enter Chassis No."/>
                      </div>
                      <div class="col-md-1">
                        <span class="label" style="color: red; padding: 0px;" v-if="!form.chassisNo">*</span>
                      </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for="">Car Color :</label>
                      </div>
                      <div class="col-md-4">
                          <input v-model="form.color" type="text" class="form-control input-sm" placeholder="Enter Car Color"/>
                      </div>
                      <div class="col-md-1">
                        <span class="label" style="color: red; padding: 0px;" v-if="!form.color">*</span>
                      </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input v-model="form.mortgage" type="checkbox" id="mortgaged">
                        <label for="mortgaged">Mortgaged?</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                              
                             <select class="form-control" v-model="form.bankName" :disabled="!form.mortgage" required >
                                    <option value="" selected disabled >Select Banks</option>
									<option    v-for="GetListBankss in GetListBanks" :key="GetListBankss._id"  v-bind:value="GetListBankss.BankName"  >{{ GetListBankss.BankName}}</option>
                    
                                 </select>
                        <input v-model="form.bankNameAddress" type="text" class="form-control input-sm" :readonly="!form.mortgage" placeholder="Enter Mortgage"/>
                 

                  </div>
                  <div class="col-md-1"  v-if="!form.bankName">
                    <span class="label" style="color: red; padding: 0px;">*</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input v-model="form.hardCopy" type="checkbox" id="Hardcopy" @change="onChangeHardCopy">
                      <label for="Hardcopy">Required Hardcopy?</label>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-10" v-if="form.hardCopy" style="padding: 0px">
                      <div class="form-group">
                        <input v-model="form.delivery" type="radio" id="normalDelivery" value="normalDelivery" @change="onChange">
                        <label for="normalDelivery" style="margin: 0px">Normal Delivery</label>
                        <br>
                        <small>(Usually 3 to 25 business days)</small>
                        <br>
                        <input v-model="form.delivery" type="radio" id="rushDelivery" value="rushDelivery" @change="onChange">
                        <label for="rushDelivery" style="margin: 0px">Rush (Metro Manila Only)</label>
                        <br>
                        <small>(Usually 1 to 2 business days and will require payment of Php 250.00)</small>
                      </div>

                      <div class="col-md-12" v-if="form.delivery == 'rushDelivery'">
                        <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.PaymentGateway" type="radio" id="GCash" value="GCash">
                            <label for="GCash" style="margin: 0px">GCASH</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.PaymentGateway" type="radio" id="PayMaya" value="PayMaya">
                            <label for="PayMaya" style="margin: 0px">PayMaya</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.PaymentGateway" type="radio" id="DragonPay" value="DragonPay">
                            <label for="DragonPay" style="margin: 0px">DragonPay</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Delivery</label>
                      </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                          <div class="form-group">
                              <input v-model="form.deliveryAddress" type="radio" id="sameAddress" value="sameAddress" @change="onChangeAddress">
                              <label for="sameAddress">Same Address</label>
                              <br>
                              <input v-model="form.deliveryAddress" type="radio" id="differentAddress" value="differentAddress" @change="onChangeAddress">
                              <label for="differentAddress">Different Address</label>
                              <br>
                              <div class="col-md-5" style="padding: 0px 2px;" v-if="form.deliveryAddress == 'differentAddress'">
                                  <input v-model="form.address" type="text" id="" class="form-control input-sm" placeholder="Address">
                              </div>
                              <div class="col-md-3" style="padding: 0px 2px;" v-if="form.deliveryAddress == 'differentAddress'">
                                <select v-model="form.barangay" id="" class="form-control input-sm">
                                    <option value="" selected disabled>Select Barangay</option>
                                    <option value="Barangay San Antonio">Barangay San Antonio</option>
                                  </select>
                              </div>
                              <div class="col-md-3" style="padding: 0px 2px;" v-if="form.deliveryAddress == 'differentAddress'">
                                <select v-model="form.city" id="" class="form-control input-sm">
                                  <option value="" selected disabled>Select City</option>
                                  <option value="Manila City">Manila City</option>
                                </select>
                              </div>
                              <div class="col-md-1" >
                                <span class="label" style="color: red; padding: 0px;" v-if="!form.address + !form.barangay + !form.city && form.deliveryAddress == 'differentAddress'">*</span>
                              </div>
                               
                          </div>
                        </div>
                          <div class="form-group">
                                <input v-model="form.AutoRenew"  type="checkbox" id="AutoRenew" >
                                <label for="AutoRenew">Auto Renew ?</label><br>
                                  <small>(if check, policy will automatically renew at the end of each term)</small>
                                </div>
                        </div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click='QueryByOPtion()' >Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		   </div>
    </div>
 <!-- <pre>{{ $data }}</pre>-->
    </section>
  </div>
</template>




<script>
export default {
 
 
   mounted: function(){ 
		console.log(this.surveyData);
       // let id = this.$route.params.id
        //console.log('mounted' + id)
         console.log('Component mounted.')  
         axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));

                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
        axios.get("api/URLQueryRequestModify/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
        axios.get("api/CustomerRequestQuotation/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data)  );
        axios.get("api/GetListBanks/") .then(({ data }) => (this.GetListBanks = data)  );

       
       
    },

    data() {
        return {
            ResultQueryRequest:{},
            URLQueryPerilsCoverages:{},
            ResultLoginDetails:{},
            ListApproverQuotation:{},
            UserDetails:{},
            GetListBanks:{},
            URLQueryPerilsCoveragesGroup:'',
            RetrieveTimeInterval:null,
             isShowing:false,
            
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
                Accessories:'',
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
                 RemarksCustomer:[],
                 QuoteExpiryStatus:'',
                 CustMessage:[],
                
                  // Additional Details
                    mvFileNo: '',
                    engineNo: '',
                    chassisNo: '',
                    color: '',
                    mortgage: '',
                    bankName: '',
                    bankNameAddress: '',
                    hardCopy: '',
                    delivery: '',
                    PaymentGateway: '',
                    deliveryAddress: '',
                    address: '', // 
                    barangay: '',
                    city: '',
                    AcctNo: '',
                    AcctName: '',
                   AutoRenew : '',
                   AssignCRD: '',
                   RequestModify: [],
                   FormStatusCoverages: [],
                   NoAOG: '',
				           OptionWithAOG: '',
				           ModalDisplayWithAOG: '',
				          ModalDisplayTotalAmountDue: '',
				  

             

            }),

            Wordings: {},
          
        }
    },

    methods: {
        onChange() {
            if (this.form.delivery == 'normalDelivery') {
                this.form.PaymentGateway = '';
            } 
        },

        onChangeHardCopy() {
            if (this.form.hardCopy == false) {
                this.form.delivery = '';
                this.form.PaymentGateway = '';
            } 
        },

        onChangeAddress() {
            if (this.form.deliveryAddress == 'sameAddress') {
                this.form.address = '';
                this.form.barangay = '';
                this.form.city = '';
            } 
        },

        QueryByOPtion1(e){
             this.form.AcceptQuotationPassData = e.target.value.trim();
			 let AmountDue = e.target.value.trim();
			  let GetAmountDue         = AmountDue.split(';;');
			 let ModalDisplayTotalAmountDue      = GetAmountDue[3].trim();
			let ModalDisplayWithAOG     = parseFloat(GetAmountDue[4]) +  parseFloat(GetAmountDue[5]); 
			
			this.form.ModalDisplayWithAOG         =ModalDisplayWithAOG.toFixed(2);
			this.form.ModalDisplayTotalAmountDue  = GetAmountDue[3].trim();
           //alert(ModalDisplayWithAOG);
        
        },

         QueryByOPtion(){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
             let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
            this.form.post('api/AcceptQuotation').then(() => {
                    // Success!
                     Swal.fire(
                        'Successful!',
                        `Quotation Accepted.`,
                        'success'
                    )
                    // console.log();
                    this.$router.push('/CustAcceptedView?' + PassID);
                  
                }).catch((response) => {
                        alert(response);

                });
       
        
        },

         ComposeMessageCustomer(){
               
                //axios.get("api/AcceptQuotation/" + e.target.value.trim()  ) .then(({ data }) => (this.AcceptQuotation = data)  ); 
            //alert(e.target.value);
           
            this.form.post('api/ComposeMessageCustomer').then(() => {
                    // Success!
                    //this.$router.push('Home') ;
                     this.$router.push('/CustAcceptedView?' + PassID);
                  
                }).catch((response) => {
                        alert(response);

                });
       
        
        }
 

    }, 

    filters: {
        peso(amount) {
            const amt = Number(amount)
            return '₱ ' + amt.toLocaleString('ko-KR', {minimumFractionDigits: 2, maximumFractionDigits: 2})
        },
    },
   

    created() {
        axios.get('api/wordings').then(({data}) => this.Wordings = data)
        this.RetrieveTimeInterval = setInterval(() => {
            //this.UserDetails.data.map((UserDetailss) => { 
                   
            
            //});
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
                this.form.Accessories        =ResultRequestDetailss.MotorWithAccessories;

                 this.form.AcctNo            = ResultRequestDetailss.CustAcctNO;
                this.form.AcctName           = ResultRequestDetailss.FirstName + " " + ResultRequestDetailss.MiddleName + " " + ResultRequestDetailss.LastName ;
                this.form.AssignCRD          = ResultRequestDetailss.AssignCRD;
                this.form.NoAOG              = ResultRequestDetailss.WithAOG;
				
                
                
                this.$forceUpdate();   
            });

            this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
			      
                //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
                let CompCoveragesAmount = 0 ;  let CompCoveragesAmountNoAOG = 0 ;  let CompChargesAmount = 0 ; let CompCoverageAmount = 0 ; let DisplayText; 
                       URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoveragesURL) => {
                            this.form.RequestModify[URLQueryPerilsCoveragesGroups.OptionNo]  =   ListCoveragesURL.RequestModify;
                           CompCoveragesAmount  +=  parseFloat(ListCoveragesURL.CoveragesPremium ) ;
                           CompCoverageAmount  +=  parseFloat(ListCoveragesURL.CoveragesAmount ) ;
                       this.form.FormStatusCoverages[URLQueryPerilsCoveragesGroups.OptionNo]  = ListCoveragesURL.Status;
                                         if ( ListCoveragesURL.Status != 3){
                                            DisplayText = "New Quotation" ;
                                            this.isShowing =false;
                                        
                                        }else{
                                            DisplayText = " " ;
                                            this.isShowing =true;
                                        }

                                         if ( ListCoveragesURL.PerilsCode == "AOG"){
                                             CompCoveragesAmountNoAOG  = parseFloat(ListCoveragesURL.CoveragesPremium );
                                         }else{
                                              CompCoveragesAmountNoAOG  = CompCoveragesAmount ;
                                         }
                              
                              
                                   
                     });
                      
                      this.form.AcceptedQuotation[URLQueryPerilsCoveragesGroups.OptionNo]       = DisplayText;     
                      this.form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]       = TotalPremium ;        

                              


                      URLQueryPerilsCoveragesGroups.ListCharges.map(( ListChargesURL) => {
                             CompChargesAmount   +=  parseFloat(ListChargesURL.ChargesPremium ) ;
                           
                             
                       });
                      this.$forceUpdate(); 
                     
                                      
                      let TotalAmountDue  =parseFloat(CompCoveragesAmount) + parseFloat(CompChargesAmount) ; 
                           // this.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     = parseFloat(CompCoveragesAmount).toFixed(2)
                            this.form.CoveragesPremiumDisplay[URLQueryPerilsCoveragesGroups.OptionNo]     = parseFloat(CompCoveragesAmountNoAOG).toFixed(2)
                           
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