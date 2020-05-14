<template>
<div>
    <div class="col-md-12"   >
            <div class="box box-success" v-if="this.ProposalFormEdit ==='NO RECORD FOUND'" >
                <!-- Personal Details -->
                <div class="box-header with-border">
                    <h3> <big class="label label-warning">{{ this.ProposalFormEdit  }} </big></h3>
                
                </div>
            </div>
     </div>
    <div class="col-md-12"   >
        <div class="box box-success" v-if="this.ProposalFormEdit !=='NO RECORD FOUND'" >
            <!-- Personal Details -->
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Personal Details </strong></h3>
            </div>
            <form>
               

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tin">TIN Number:</label>
                                <input
                                    v-model="form.TINNumber"
                                    class="form-control"
                                    type="text"
                                    name="tin"
                                    id="tin"
                                    placeholder="Enter TIN Number"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input
                                    v-model="form.EmailAddress"
                                    class="form-control"
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Enter Email Address"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input
                                    v-model="form.ContactNumber"
                                    class="form-control"
                                    type="text"
                                    name="contact"
                                    id="contact"
                                    placeholder="Enter Contact Number"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input
                                    v-model="form.FirstName"
                                    class="form-control"
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    placeholder="Enter First Name"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input
                                    v-model="form.MiddleName"
                                    class="form-control"
                                    type="text"
                                    name="middle_name"
                                    id="middle_name"
                                    placeholder="Enter Middle Name"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input
                                    v-model="form.LastName"
                                    class="form-control"
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    placeholder="Enter Last Name"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input
                                    v-model="form.Address"
                                    class="form-control"
                                    type="text"
                                    name="address"
                                    id="address"
                                    placeholder="Enter Address"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay">Barangay:</label>
                                 <input
                                    v-model="form.Barangay"
                                    class="form-control"
                                    type="text"
                                    name="address"
                                    id="address"
                                    placeholder="Enter Barangay Address  "
                                />
                                <!-- <select
                                    v-model="form.Barangay"
                                    class="form-control"
                                    name="barangay"
                                    id="barangay"
                                >
                                    <option value="">Select Barangay</option>
                                    <option value="Barangay 288"
                                        >Barangay 288</option
                                    >
                                    <option value="Barangay 289"
                                        >Barangay 289</option
                                    >
                                </select> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City:</label>
                                  <input
                                    v-model="form.City"
                                    class="form-control"
                                    type="text"
                                    name="address"
                                    id="address"
                                    placeholder="Enter City Address  "
                                />
                                <!-- <select
                                    v-model="form.City"
                                    class="form-control"
                                    name="city"
                                    id="city"
                                >
                                    <option value="">Select City</option>
                                    <option value="Quezon City"
                                        >Quezon City</option
                                    >
                                    <option value="Manila City"
                                        >Manila City</option
                                    >
                                </select> -->
                                
                            </div>
                            
                        </div>
                       
                    </div>
                     <button type="button" class="btn btn-primary no-print" @click="UpdatePersonalDetails()"  >Update Personal Details </button>
                </div>

                <!-- Coverage -->
                <div class="box-header with-border box box-success">
                    <h3 class="box-title">
                        <strong>Motor Car Details</strong>
                    </h3>
                
                <div class="box-body">
                    <div class="row" style="margin-bottom: 10px;">
                             <div class="col-sm-3" > 
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Denomination: </label>
                                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select DENOMINATION on the list otherwise SPECIFY ">
                                                <big class="label label-warning"><i class="fa fa-info"></i> </big>
                                            </a>

                                 <input type="text" v-model="form.DenominationDis" @change="ChangeDenomination()" autocomplete="off" @focus="filterDen = true"  class="form-control" placeholder="Enter / Select Denomination" required>
                                <div v-if="DataDenominations && filterDen" class="custom">
                                    <ul>
                                    <li v-for="value in DataDenominations" :key="value._id" @click="setValueDenomination(value)">{{value.SubLinesName}}</li>
                                    </ul>
                                </div>
                                <small class="label label-danger">Selected : {{ form.Denomination }} </small>


                             </div>


                        <!-- <div class="col-md-3">
                            <div class="form-goup">
                                <label for="rate">Denomination:</label>
                                <input
                                    v-model="form.Denomination"
                                    class="form-control"
                                    type="text"
                                    name="Denomination"
                                    id="Denomination"
                                    placeholder="Enter Denomination"
                                    readonly
                                />
                            </div>
                        </div> -->

                        <div class="col-md-3">
                            <div class="form-goup">
                                <label for="surcharge">USAGE:</label>
                                <select   v-model="form.OptSurcharge"
                                    class="form-control"
                                    name="surcharge"
                                    id="surcharge"
                                    @change="UsageChange($event)"
                                >
                                    <option selected disabled>
                                        {{ form.OptSurcharge }}
                                    </option>
                                    <option value="Personal Use">Personal Use</option>
                                    <option value="Commercial Use"
                                        >Commercial Use</option
                                    >
                                </select>
                               
                            </div>
                            <!-- <label for="surcharge">Selected:</label>
                             <small> {{ form.OptSurcharge }}</small> -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-goup">
                                <label for="surcharge">PO AMNT:</label>
                                <input
                                    type="number"
                                    v-model.number="form.MotorPOAmount" @change="ChangeAmountPO()"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <!-- <div class="col-md-2">
                            <div class="form-goup">
                                <label for="surcharge"
                                    >Depreciative AMNT:</label
                                >
                                <input
                                    type="text"
                                    v-model="form.DepreciativeAmount"
                                    class="form-control"
                                    readonly
                                />
                            </div>
                        </div> -->

                        <div class="col-md-3">
                            <div class="form-goup">
                                <label for="surcharge">COVERAGE / Depreciative Amount:</label>
                                <input
                                    type="text"
                                    v-model="form.CoverageAmount"
                                    class="form-control"
                                    readonly
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-md-2">
                            <div class="form-goup">
                                <label for="type">TYPE:</label>
                                <input
                                    v-model="form.TypeClass"
                                    type="text"
                                    class="form-control text-center"
                                    name="type"
                                    id="type"
                                    value="PC1"
                                    disabled
                                />
                            </div>
                        </div> -->
                        <div class="col-md-12">
                           
                                 <div class="col-sm-3">
                                <label for="inputPassword" class="col-form-label"><big style="color:red"> * </big> Year</label>
                                        <a data-toggle="tooltip" data-placement="right" title="Pls. Select YEAR Purchased  on the list otherwise SPECIFY ">
                                                <big class="label label-warning"><i class="fa fa-info"></i> </big>
                                         </a>
                              

                                  <input type="number" v-model="form.YearPO" @change="ChangeDenomination(),ComputeDepreciativeAmount()"  autocomplete="off" @focus="filterYear = true"  class="form-control" placeholder="Enter / Select Year Purchased" required>
                                <div v-if="yearD && filterYear" class="custom">
                                    <ul>
                                    <li  v-for="yearDs in yearD" :value="yearDs" :key="yearDs" @click="setValueYear(yearDs)">{{ yearDs }} </li>
                                    </ul>
                                </div>
                                <small class="label label-danger">Selected : {{ form.MotorYear }} </small>
                            </div>
                                  

                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="brand">Brand:</label>
                                    <input
                                        v-model="form.MotorBrand"
                                        type="text"
                                        class="form-control"
                                        name="brand"
                                        id="brand"
                                        placeholder="Enter Car Brand"
                                       
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="model">Model:</label>
                                    <input
                                        v-model="form.MotorModel"
                                        type="text"
                                        class="form-control"
                                        name="model"
                                        id="model"
                                        placeholder="Enter Car Model"
                                        value="INNOVA"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-goup">
                                    <label for="bodytype">Body Type:</label>
                                    <input
                                        v-model="form.MotorType"
                                        type="text"
                                        class="form-control"
                                        name="bodytype"
                                        id="bodytype"
                                        placeholder="Enter Body Type"
                                        value="A/T"
                                    />
                                    <p v-for="CheckBoxComps in CheckBoxComp"   :key="CheckBoxComps._id"> {{ CheckBoxComps.Amount }} </p>
                                   
                                   <input v-for="CheckBoxComps in CheckBoxComp"   :key="CheckBoxComps._id"
                                        v-model="form.Amount"
                                        type="text"
                                        class="form-control"
                                        name="bodytype"
                                        id="bodytype"
                                        placeholder="Enter Body Type"
                                        value="A/T"
                                    />
                                   

                                </div>
                                
                            </div>
                            
                        </div>
                         
                    </div>
                    
                </div> <br/>
                     <button type="button" class="btn btn-primary no-print" @click="UpdateMotorDetails()" >Update Motor Details </button> 
                </div>     
                <!------------New Design------------------------>
            <!-- <div v-if="this.ProposalFormEdit !=='NO RECORD FOUND'" > -->
              <div class="box box-success "  v-for="ProposalFormEdits  in ProposalFormEdit"   :key="ProposalFormEdits._id"> 
                 <div class="box-header with-border">
                    <h3 class="box-title">
                        <strong>Quotation #:{{ ProposalFormEdits.RequestNo + "-" + ProposalFormEdits.OptionNo}}</strong>
                    </h3>
                </div>
                <div class="box-body "  >
                    <div class="row" style="margin-left: 10px;margin-right: 10px;">
					                
                      <strong> Rate:</strong>    <input   type="input" v-model="form.PassCoverageRate[ProposalFormEdits.OptionNo]" @change="ChangeRateAmount(ProposalFormEdits)"  />
					         
					
                        <div class="col-xs-12 table-responsive">
                            <table style="width:85%" >
                                <tr>
                                        <th>PERILS</th>
                                        <th>AMOUNT</th>
                                        <th>PREMIUM  </th>
                                       
                                <tr v-for="CoverageEdit in ProposalFormEdits.ListCoverages" :key="CoverageEdit._id">
                                        <td>{{ CoverageEdit.PerilsName }} </td>
                                       
                                        <td> 
                                                    <input  @change="EditAmountUsingTxtBox(CoverageEdit)" 
                                                       
                                                        type="input" v-model="CoverageEdit.CoveragesAmount"
                                                    />

                                                     <input   v-model="
                                                            form.CoveragesAmountChk[
                                                                CoverageEdit._id
                                                            ]
                                                        "
                                                       
                                                        type="hidden" v-model:value="CoverageEdit.CoveragesAmount"
                                                    />

                                                    
												                                 
                                                    <input
                                                        v-model="
                                                            form.TxtSelectAmount[
                                                                CoverageEdit._id
                                                            ]
                                                        "
                                                        checked
                                                          @change="EditAmountUsingChkBox(CoverageEdit)"
                                                        type="checkbox"
                                                    />
                                            
                                    </td>
                                       <td style="text-align:left">{{ CoverageEdit.CoveragesPremium | Peso }} 
                                            <input   v-model="form.TxtCoveragesPremium[ProposalFormEdits._id]"
                                                        type="hidden" v-model:value="CoverageEdit.CoveragesPremium"
                                            />
											
									   </td>
                                       
                                </tr>
						
								 <!----<tr>
                                    <th  style="text-align:right" >Total Coverages : </th>
									<th>{{ ProposalFormEdits.TotalCoverages  | Peso }}</th>
 
                                </tr>----->
								
                                <tr>
                                       <th  style="text-align:left" >   </th>
                                       <th  style="text-align:right" >Total Premium :</th>
                                       <td style="text-align:left;text-decoration-line: overline;text-decoration-style: double;"> {{ ProposalFormEdits.TotalPremium   | Peso  }}   </td>
                                      
                                       
                                </tr>

                                
                                  <tr>  <th><br/></th></tr>
                                  <tr v-for="ChargesEdit in ProposalFormEdits.ListCharges" :key="ChargesEdit._id">
                                       <th></th>
                                       <td style="text-align:right"  >{{ ChargesEdit.ChargesName + " : "}}</td>
                                       <td style="text-align:left;">{{ ChargesEdit.ChargesPremium  | Peso }}</td>
                                </tr>
                                  <tr>
                                       <th></th>
                                       <th  style="text-align:right" >Total Charges :</th>
                                       <td style="text-align:left;text-decoration-line: overline;text-decoration-style: double;"> {{ ProposalFormEdits.TotalCharges   | Peso }}  </td>
                                         
                                </tr> <tr>  <th><br/></th></tr>
                                 <tr>
                                       <th></th>
                                       <th  style="text-align:right" >Total Amount Due :</th>
                                       <th style="text-align:left;font-size:15px"> {{ ProposalFormEdits.TotalAmountDue   | Peso }}  </th>
                                         
                                </tr> <tr>  <th><br/></th></tr>
                                 <tr>
                                       <th  style="text-align:left" >   </th>
                                       <th  style="text-align:right" >Assured Share of Loss : {{ ProposalFormEdits.Deductible   | Peso  }}  </th>
                                      
                                       
                                </tr>



                            </table>
                    </div> 
                  </div>      
              </div>
                
            </div>
            <!-- </div> ---close v-if condition------- -->
                <!-----------Close NEw Design--------------------------->
                <!----------------------------Default From Request------------------------------------------------------------------->
             <!-- ----------------------------<pre>{{ $data }} </pre> --------------------------------------- -->
					
       
            
            
            </form>
            <div
                class="box-footer"
                v-if="
                    form.QuoteExpiryStatus == 0 || form.QuoteExpiryStatus == 2
                "
            >
                <button
                    @click="UpdateQuotationOption()"  v-show="isShowing" 
                    type="submit"
                    class="btn btn-success pull-right"
                    v-if="
                        form.QuoteExpiryStatus == 0 ||
                            form.QuoteExpiryStatus == 2
                    "
                >
                    UPDATE OPTION
                </button>
              
                <button
                    @click="SubmitNewCoveragesOption()"  @mousehover="clearPerilsData()"
                    class="btn btn-primary pull-right"
                    style="margin-right: 5px;"
                >
                    ADD NEW OPTION
                </button>
            </div>
        </div>

        <div
            v-for="data in URLQueryPerilsCoveragesPreview.data"
            :key="data._id"
        >
            {{ data.requestStatus }} <br /><br />
            {{ data.RequestNo }} <br /><br />
            <div v-for="coverage in data.CoveragesAmount" :key="coverage._id">
                {{ coverage.CoverageName }} <br />
                <br />
                {{ coverage.CoveragePremium }}
            </div>
        </div>
    </div>

    <div>
        <button class="open-button" @click="openForm()" v-if="this.ProposalFormEdit !=='NO RECORD FOUND'">Preview</button>

        <div class="chat-popup" id="myForm">
            <div class="box-body form-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            <img src="/img/rsilogo.png" alt="RSILogo" id="quoteslogo">
                            <small class="pull-right"><strong> Date: {{date}} </strong></small>
                        </h2>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-12">
                        <h3>Request for Proposal  </h3>
                    </div>
                </div>
                
                <section class="content" style="height:50px; overflow-y: scroll; ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2" style="padding: 0px;">
                                <p><b>Assured</b><b class="pull-right">:</b></p>
                                <p><b>Address</b><b class="pull-right">:</b></p>
                                <p><b>Unit</b><b class="pull-right">:</b></p>
                                <p><b>Coverage</b><b class="pull-right">:</b></p>
                            </div>
                            <div class="col-md-10" style="padding: 0px 0px 0px 10px;">
                                <p>{{form.FirstName + " " +   form.MiddleName + " " +  form.LastName}}</p>
                                <p>{{ form.Address + " " +   form.Barangay + " " + form.City}}</p>
                                <p>{{ form.MotorYear + " " +   form.MotorBrand + " " + form.MotorModel + " " + form.MotorType  }}</p>
                               
                                <div class="table-responsive"  >
                                    
                                        <table  v-for="URLQueryPerilsCoveragesGroups in ProposalFormEdit"
                                                                :key="URLQueryPerilsCoveragesGroups._id">
                                              <p><strong>Quotation # :</strong>  {{URLQueryPerilsCoveragesGroups.RequestNo + "-" + URLQueryPerilsCoveragesGroups.OptionNo }} 
                                              <br/> <strong>Rate :</strong> {{ URLQueryPerilsCoveragesGroups.CoverageRates }}</p>             
                                            <tr > 
                                                    
                                                    <th style=" border: 0.5px solid black;">Perils Name</th>
                                                    <th style=" border: 0.5px solid black;">Amount</th>
                                                    <th style=" border: 0.5px solid black;">Premium</th>
                                            </tr>
                                            
                                            <tr  v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages"
                                                        :key="coverage._id" > 
                                                    
                                                    <td style=" border: 0.5px solid black;">{{coverage.PerilsName}}</td>
                                                    <td style=" border: 0.5px solid black;text-align:right">{{coverage.CoveragesAmount}}</td>
                                                    <td style=" border: 0.5px solid black;text-align:right">{{coverage.CoveragesPremium}}</td>
                                            </tr>
                                            <tr >  <th >Total</th>  
                                                <th style="text-align:right">{{ form.TxtPremiumAmount[URLQueryPerilsCoveragesGroups.OptionNo]}}</th>
                                               <th style="text-align:right">{{ form.TxtCoverageAmount[URLQueryPerilsCoveragesGroups.OptionNo]}}</th>
                                            
                                            </tr>
                                             <tr >  <th ><br/><br/></th></tr>

                                        </table>
                                    

                                </div>
                            </div>
                            
                          



                        </div>
                    </div>
                    
                </section>
                <button type="button" class="btn cancel" @click="closeForm()">Close </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted: function() {
        console.log("Component mounted.");
        this.LoadResultData();
        this.AutoLoad();
    },  

    data() {
        return {
            isShowing:false,
            CheckBoxComp: {},
            ProposalFormEdit:{},
            ListChargesOption:{},
			ListChargesOptionLoop:{},
            
            ListCoveragesOption:{},
            ListCoveragesOptionNew: {},
            ListCoveragesOptionNewUsage: {},
            ListChargesOptionNewUsage: {},
		    ListChargesOptionLoopNew: {},
             GetPerilsTaripaByAmount: {},
             CoveragesAmount: {},
			ResultQueryRequest: {},
            UserDetails:{},
            GetPerils:{},


            filterDen: false,
            filterYear: false,
            DataDenominations: {},

            ///OLD--------
            
            
            URLQueryPerilsCoverages: {},
            URLQueryPerilsCoveragesPreview: {},
            URLQueryPerilsCoveragesGroup: {},
            GetDefaultPerilsForADD: {},
            PerilsList: {},
            GetPerilsTaripa: {},
            GetPerilsCoverageAmount: {},
            ResultSelectByAmount: {},
            GetPerilsDefaultData: {},
            GetDefaultSurcharge: {},
            
            GetPerilsCoverageAmountByDefault: {},
           
            GetPerilsTaripaByAmountADD: {},
            GetProductLineCharges: {},
            GetPerilsTaripaByAmountADDs: {},
            RetrieveTimeInterval: null,
            RetrieveTimeInterval1: null,
            CheckNameTrue: true,
            CheckNamefalse: false,
            LoopTR: [],
            GreatherValue:1000,

            form: new Form({
                TINNumber: "",
                EmailAddress: "",
                ContactNumber: "",
                FirstName: "",
                LastName: "",
                MiddleName: "",
                Address: "",
                Barangay: "",
                City: "",
                Denomination: "",
                RatePercent: "",
                Surcharge: "",
                UsageCar: "",
                CoverageAmount: "",
                TypeClass: "",
                MotorYear: "",
                MotorBrand: "",
                MotorModel: "",
                MotorType: "",
                CoveragesRateSave: [],
                SelectCoverageAmounts: [],
                ProductLine: "",
                


                ///OLD----------
                SelectPremiumAmount: [],
               
                SelectTotalPremium: [],
                CompTotalPremium: 0,
                
                TxtChargesPremium: [],
                TxtByAmountRequest: [],
                OptionAmountRequest: [],
                TxtOptionAmountRequest: [],
                ODQueryPassID: "",
                TFQueryPassID: "",
                GetCurrentClickBySelect: "",
                TxtPreviousCoveragesPremium: "",
                TxtUpdatedCoveragesPremium: "",
                GetPerilsNO: "",
                ToSAvedAmountRequest: [],
                PerilsNameForDisplay: [],
                PerilsNameAmountForDisplay: [],
                ChargesNameAmountForDisplay: [],
                TxtChargesNameID: [],
                TxtChargesPremiumForDisplay: [],
                TxtCoveragesName: [],
                DepreciativeAmount: "",
                OptSurcharge: "",
                TxtChargesPremiumAdd: [],
                TxtPremiumAmountAdd: "",
                TxtCoveragesPremiumAdd: [],
                TxtSelectAmountAdd: [],
                TxtOptionAmountRequestAdd: [],
                TxtCoveragesNameAdd: [],
                ToSAvedAmountRequestADD: [],
                PerilsNameForDisplayADD: [],
                PerilsNameAmountForDisplayADD: [],
                PerilsPremiumForDisplayADD: [],
                TxtChargesPremiumAdd111: [],
                PassChargesChargesNo: [],
                PassChargesChargesName: [],
                PassChargesChargesPremium: [],
                TxtPremiumAmount: [],
                TxtCoverageAmount: [],
               // TotalCharges: [],
                AmountDue: [],
                GetOptionNo: "",
                SaveMotorUsage: "",
                QueryCoveragesAmount: [],
                QueryCoveragesName: [],
                QueryCoveragesID: [],
                RatePercentADD: "",
                PostRequestNO: "",
                CoveragesRate: [],
                QuoteExpiryStatus: "",
                passengers: "",
                CustAcctNo: "",
                CustAcctCName : "",
                PlateNumber: "",
                RequestNoOptionNo: "",
                Deductible: [],



                ///NEW--------
                NewTxtOptionAmountRequest: [],
                TxtInputAmount: "",
                TxtSelectAmount: [],
                PassDataOnHover: [],
                RunSample: [],
                PassCoverageAmount: [],
				PassCoverageAmount1: [],
                PassCoverageID: [],
				PassCoveragePremium: [],
				PassCoverageRate: [],
				PassTotalCoverage: [],
				
				PassChargesID: [],
				PassChargesPremium: [],
				PassTotalCharges: [],
				
				ToSavedCoverageID:[],
				ToSavedCoverageAmount:[],
				ToSavedCoveragePremium:[],
				ToSavedTotalPremium:[],
				
				ToSavedTotalAmountDue:[],
				ToSavedTotalCoverages:[],
				
				//charges
				ToSavedChargesID:[],
				ToSavedChargesPremium:[],
				ToSavedTotalCharge:[],
				
				ToSavedWithAOGID:[],
				ToSavedWithTFID:[],
                ToSavedWithODID:[],
                ToSavedGetPerils:[],
                ToSavedCoveragesRate:[],

                CoveragesAmountChk:[],
                TxtCoveragesPremium: [],

                ///--for Update
                DenominationDis: "",
                DenominationPass: "",
                DepreciativeAmountPass: "",
                POAMount: "",
                DepreciativeNumberYear: "",
                YearPO: "",
  
                
            })
        };
    },
    

    methods: {

            async LoadDenomination() {
             await axios.get("api/GetDenomination").then(({ data }) => (this.DataDenominations = data));
           
        },


        ChangeDenomination(){

            this.form.DenominationPass    = '2019-PC-0001;;' + this.form.DenominationDis    ///default value
            this.filter = false;
             this.filterDen =false;
            // this.filterYear =false;
            // this.filterCarBrands =false;
            // this.filterCarModels =false;
            // this.filterCarBodyType =false;
            // this.filterPropertyCity =false;
            //  this.filterPropertyBrgy = false;
        },

          setValueDenomination(value) {
            this.form.DenominationPass         = value.Class + ';;' + value.SubLinesName
            this.form.DenominationDis          = value.SubLinesName
            this.filterDen = false
    },
     setValueYear(yearDs) {
         this.form.YearPO = yearDs;
           this.filterYear = false;
           this.ComputeDepreciativeAmount();
    },

    ChangeAmountPO() {
           this.form.YearPO = this.form.MotorYear;
           this.filterYear = false;
           this.ComputeDepreciativeAmount();
    },


  ComputeDepreciativeAmount(){
          let POAmount = this.form.MotorPOAmount
         const CurrentYear = new Date().getFullYear(); let NumberYear ;
          if( !(this.form.YearPO )){   ///if YearPO is Empty
               NumberYear  = 1 ; //default amount for current
          }else{
                NumberYear  = parseFloat(CurrentYear - this.form.YearPO );
               
          }  
         
         let  DepreciativeAmount = 0;
         if( !(POAmount)){ ///if POamount is Empty
                POAmount = 100000;  //default amount
               DepreciativeAmount =  parseFloat( POAmount  - (POAmount * ( NumberYear * 0.10 )) );
         
         }else{
                DepreciativeAmount =  parseFloat( POAmount  - (POAmount * ( NumberYear * 0.10 )) );
                
         }
       //  alert(DepreciativeAmount);
         this.form.CoverageAmount                   =  parseFloat(DepreciativeAmount,2);
         this.form.DepreciativeAmountPass           =  parseFloat(DepreciativeAmount,2);
         this.form.DepreciativeNumberYear           =  parseFloat(NumberYear,2);

    },



  async UsageChange(e){
        let Usage                       =  e.target.value.trim();
        let UsageAmount                 =   this.GetDefaultSurcharge[0].Amount ;
        
          for (let k = 0; k < this.ProposalFormEdit.length; k++) {
              let CompTotalPremium = 0; 
               this.ListCoveragesOptionNewUsage[k]       =  this.ProposalFormEdit[k].ListCoverages ;
               this.ListChargesOptionNewUsage[k]         =  this.ProposalFormEdit[k].ListCharges ;
              	for (let coverages = 0; coverages < this.ListCoveragesOptionNewUsage[k].length; coverages++) {
                      let IDidCoverages = this.ListCoveragesOptionNewUsage[k][coverages]._id;	

                        if (this.form.TxtSelectAmount[IDidCoverages] != false) { 
                                    let CompPA;
                                if (  e.target.value.trim() === "Commercial Use" ||  e.target.value.trim() === "commercial Use"   ) {
                                        if (this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-PA-0007" ){
                                            let CoveragesAmount            =   this.form.PassCoverageAmount[this.ListCoveragesOptionNewUsage[k][coverages]._id]
                                            let passQuery2                 = this.form.Denomination.trim() +   ";;" +    this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim();
                                            const response                 = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                            
                                            let PAFormula   = this.GetPerilsDefaultData[0].Amount;
                                            let Premium    = parseFloat(CoveragesAmount) *  parseFloat(PAFormula);    
                                            CompPA = ( parseFloat(Premium) * parseFloat(UsageAmount));
                                            this.ListCoveragesOptionNewUsage[k][coverages].CoveragesPremium   = CompPA;
                                        
                                            
                                        }

                                        if (this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-XBI-0006" || this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-PD-0005"  ){
                                            let CoveragesAmount            =   this.form.PassCoverageAmount[this.ListCoveragesOptionNewUsage[k][coverages]._id]
                                            let passQuery     = this.form.Denomination.trim() +   ";;" +   this.ListCoveragesOptionNewUsage[k][coverages].CoveragesAmount +     ";;" +   this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim();
                                             const response = await axios.get('api/GetPerilsCoverageUsingTxtBox/'+passQuery.trim()).then(  ({ data }) => (this.GetPerilsTaripaByAmount = data)  );
                                            console.log(response);
                                           let Premium        = this.GetPerilsTaripaByAmount[0].PremiumAmount; //parseFloat(CoveragesAmount) *  parseFloat(PAFormula);    
                                            CompPA          = ( parseFloat(Premium) * parseFloat(UsageAmount));
                                            this.ListCoveragesOptionNewUsage[k][coverages].CoveragesPremium   = CompPA;
                                        
                                            
                                        }
                                    
                                }else{

                                    if (this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-PA-0007" ){
                                            let CoveragesAmount            =   this.form.PassCoverageAmount[this.ListCoveragesOptionNewUsage[k][coverages]._id]
                                            let passQuery2                 = this.form.Denomination.trim() +   ";;" +    this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim();
                                            const response                 = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                            
                                            let PAFormula   = this.GetPerilsDefaultData[0].Amount;
                                            let Premium     = parseFloat(CoveragesAmount) *  parseFloat(PAFormula);    
                                            CompPA       =  parseFloat(Premium);
                                            this.ListCoveragesOptionNewUsage[k][coverages].CoveragesPremium   = CompPA;
                                        
                                        
                                            
                                        }

                                        if (this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-XBI-0006" || this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim() === "2019-PD-0005"  ){
                                            let CoveragesAmount            =   this.form.PassCoverageAmount[this.ListCoveragesOptionNewUsage[k][coverages]._id]
                                            let passQuery     = this.form.Denomination.trim() +   ";;" +   this.ListCoveragesOptionNewUsage[k][coverages].CoveragesAmount +     ";;" +   this.ListCoveragesOptionNewUsage[k][coverages].PerilsNo.trim();
                                            const response = await axios.get('api/GetPerilsCoverageUsingTxtBox/'+passQuery.trim()).then(  ({ data }) => (this.GetPerilsTaripaByAmount = data)  );
                                            console.log(response);
                                
                                            let Premium        = this.GetPerilsTaripaByAmount[0].PremiumAmount; //parseFloat(CoveragesAmount) *  parseFloat(PAFormula);    
                                            CompPA          =  parseFloat(Premium);
                                            this.ListCoveragesOptionNewUsage[k][coverages].CoveragesPremium   = CompPA;
                                        
                                        
                                        }
                                }
                                CompTotalPremium += parseFloat( this.ListCoveragesOptionNewUsage[k][coverages].CoveragesPremium);
                        }
                  } 
                        this.ProposalFormEdit[k].TotalPremium     = parseFloat(CompTotalPremium); 

            ///------------Charges------------
            let CompTotalCharges = 0;
  	                for (let charges = 0; charges < this.ListChargesOptionNewUsage[k].length; charges++) {
                              // alert(this.ListChargesOptionNewUsage[k][charges].ChargesType);
                              if (  this.ListChargesOptionNewUsage[k][charges].ChargesType === "Percent"  ) {
                                let CompChargesAmount =   parseFloat( this.ListChargesOptionNewUsage[k][charges].ChargesAmount) *   parseFloat(this.ProposalFormEdit[k].TotalPremium);
                           
                                 if ( this.ListChargesOptionNewUsage[k][charges].ChargesNo === "2019-DP-0001"  ) {
                                    let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                                    let numpart = parseFloat(value).toFixed(2).split(".");
                                            if (numpart[1] < 51) {
                                                let CompChargesAmount = parseFloat(numpart[0]) + "." + 50;
                                                this.ProposalFormEdit[k].ListCharges[charges].ChargesPremium = CompChargesAmount ; 
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                                
                                            }else {
                                                let CompChargesAmount =parseFloat(numpart[0]) + 1;
                                                this.ProposalFormEdit[k].ListCharges[charges].ChargesPremium = CompChargesAmount ; 
                                               
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                            }
                                              
                                            
                                             
                                }else{
                                            this.ProposalFormEdit[k].ListCharges[charges].ChargesPremium = CompChargesAmount ; 
                                             CompTotalCharges +=    parseFloat(CompChargesAmount);
                                } 
                                
                             }else{
                                   let CompChargesAmount =   parseFloat( this.ListChargesOptionNewUsage[k][charges].ChargesAmount);
                                     CompTotalCharges +=    parseFloat(CompChargesAmount);
                             }

                      }
                  this.ProposalFormEdit[k].TotalCharges    = CompTotalCharges   ;  
                  this.ProposalFormEdit[k].TotalAmountDue  = parseFloat(CompTotalCharges) + parseFloat( this.ProposalFormEdit[k].TotalPremium )     ;  
     
                  

          }
   },         
async ChangeRateAmount(ProposalFormEdits){
                    this.isShowing = true; 
                     let RatePercentage             = this.form.PassCoverageRate[ProposalFormEdits.OptionNo];
                     let ArrayIndex                 =  parseFloat(ProposalFormEdits.OptionNo) - 1;
                     this.ListCoveragesOption       =  this.ProposalFormEdit[ArrayIndex].ListCoverages ;
                     this.ListChargesOption         =  this.ProposalFormEdit[ArrayIndex].ListCharges ;
                     let UsageAmount                =   this.GetDefaultSurcharge[0].Amount ;

                    for (let i = 0; i < this.ListCoveragesOption.length; i++) {
                      
                      
                                if (this.ListCoveragesOption[i].PerilsNo.trim() === "2019-OD-0003" ){
                                        let passQuery2         = this.form.Denomination.trim() +   ";;" +    this.ListCoveragesOption[i].PerilsNo.trim();
                                        const response         = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                                        console.log(response);

                                        let PremiumAmount      =  this.GetPerilsDefaultData[0].Amount ; // 0.006; // this.form.PassCoveragePremium[this.ListCoveragesOption[i]._id ] ;   //this.ListCoveragesOption[i].CoveragesPremium	;
                                        let CoveragesAmount    = this.form.PassCoverageAmount[this.ListCoveragesOption[i]._id ] ; 
                                        this.ListCoveragesOption[i].CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoveragesAmount)) *  parseFloat(PremiumAmount); 
                                        this.form.PassCoveragePremium[this.ListCoveragesOption[i]._id ]	    =  this.ListCoveragesOption[i].CoveragesPremium ;
                            }
                            if (this.ListCoveragesOption[i].PerilsNo.trim() === "2019-TF-0002" ){
                                        let passQuery2         = this.form.Denomination.trim() +   ";;" +    this.ListCoveragesOption[i].PerilsNo.trim();
                                        const response         = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                                        console.log(response);

                                        let PremiumAmount      =  this.GetPerilsDefaultData[0].Amount ; // 0.006; // this.form.PassCoveragePremium[this.ListCoveragesOption[i]._id ] ;   //this.ListCoveragesOption[i].CoveragesPremium	;
                                        let CoveragesAmount    = this.form.PassCoverageAmount[this.ListCoveragesOption[i]._id ] ; 
                                        this.ListCoveragesOption[i].CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoveragesAmount)) *  parseFloat(PremiumAmount); 
                                        this.form.PassCoveragePremium[this.ListCoveragesOption[i]._id ]	    =  this.ListCoveragesOption[i].CoveragesPremium ;
                            }

                    this.ComputeTotals(this.ListCoveragesOption[i]);	

                  }
                  //Compute Charges---------------------
                  let CompTotalCharges = 0;
                  
                     for (let i = 0; i < this.ListChargesOption.length; i++) {
                           
                             if (  this.ListChargesOption[i].ChargesType === "Percent"  ) {
                                let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount) *   parseFloat(this.ProposalFormEdit[ArrayIndex].TotalPremium);
                             
                                 if ( this.ListChargesOption[i].ChargesNo === "2019-DP-0001"  ) {
                                    let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                                    let numpart = parseFloat(value).toFixed(2).split(".");
                                            if (numpart[1] < 51) {
                                                let CompChargesAmount = parseFloat(numpart[0]) + "." + 50;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                                
                                            }else {
                                                let CompChargesAmount =parseFloat(numpart[0]) + 1;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                               
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                            }
                                              
                                            
                                             
                                }else{
                                            this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                             CompTotalCharges +=    parseFloat(CompChargesAmount);
                                } 
                                
                             }else{
                                   let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount);
                                     CompTotalCharges +=    parseFloat(CompChargesAmount);
                             }
                          
                               
                     }
                
				   
				 this.ProposalFormEdit[ArrayIndex].TotalCharges    = CompTotalCharges   ;  
                 this.ProposalFormEdit[ArrayIndex].TotalAmountDue  = parseFloat(CompTotalCharges) + parseFloat( this.ProposalFormEdit[ArrayIndex].TotalPremium )     ;  

           
                
      
},
LoadResultData(){
                let uri = window.location.href.split("?");
                 let PassID = uri[1].trim();
                 //alert(PassID);
                axios.get("api/ProposalFormEdit/" + PassID).then(({ data }) => 
                (
                    this.ProposalFormEdit = data
                  
                ));  

                axios.get("api/GetPerilsOption/").then(({ data }) => 
                (
                    this.GetPerils = data
                  
                )); 

                 axios.get("api/GetDefaultSurcharge/").then(({ data }) => 
                (
                    this.GetDefaultSurcharge = data
                  
                )); 

        },
        async  ComputeTotals(CoverageEdit){
                 let ArrayIndex                =  parseFloat(CoverageEdit.OptionNo) - 1;
                 this.ListCoveragesOption      =  this.ProposalFormEdit[ArrayIndex].ListCoverages ;
                    let CompTotalPremium = 0;
                   for (let i = 0; i < this.ListCoveragesOption.length; i++) {
                         let PremiumAmount =  this.form.PassCoveragePremium[this.ListCoveragesOption[i]._id ] ;   //this.ListCoveragesOption[i].CoveragesPremium	;
                        CompTotalPremium += parseFloat(PremiumAmount);
                   }
                     this.ProposalFormEdit[ArrayIndex].TotalPremium     = parseFloat(CompTotalPremium);


         },

        async  EditAmountUsingTxtBox(CoverageEdit) {
                 this.isShowing = true;  //show the Update button , default false
               
                 let ArrayIndex                 =  parseFloat(CoverageEdit.OptionNo) - 1;
                 this.ListChargesOption         =  this.ProposalFormEdit[ArrayIndex].ListCharges ;
                 let UsageAmount                =   this.GetDefaultSurcharge[0].Amount ;
  
		if (this.form.TxtSelectAmount[CoverageEdit._id] != false) { //if the textbox is uncheck
                 let passQuery     = this.form.Denomination.trim() +   ";;" +   CoverageEdit.CoveragesAmount.trim() +     ";;" +   CoverageEdit.PerilsNo.trim();
                 let passQuery2    = this.form.Denomination.trim() +   ";;" +    CoverageEdit.PerilsNo.trim();
                
          
          let PAmountODTF = 0;   
			if (CoverageEdit.PerilsNo.trim() === "2019-AOG-0004" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
						   // CoverageEdit.CoveragesPremium   =  this.GetPerilsDefaultData[0].PremiumAmount;
							let AOGFormula  = this.GetPerilsDefaultData[0].Amount;
							CoverageEdit.CoveragesPremium   = parseFloat(CoverageEdit.CoveragesAmount) *  parseFloat(AOGFormula);     
							this.form.PassCoveragePremium[CoverageEdit._id]			=  CoverageEdit.CoveragesPremium ;							
							this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
			}else if (CoverageEdit.PerilsNo.trim() === "2019-PA-0007" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
                             let PAFormula  = this.GetPerilsDefaultData[0].Amount;
                            if (this.form.OptSurcharge.trim() === "Commercial Use"){
                                    CoverageEdit.CoveragesPremium                       = parseFloat(CoverageEdit.CoveragesAmount * PAFormula * UsageAmount);      
                                    this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
                                    this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);
                                    
                            }else{
                                    CoverageEdit.CoveragesPremium                       = parseFloat(CoverageEdit.CoveragesAmount) *  parseFloat(PAFormula);      
                                    this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
                                    this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);

                            }

                       
					
					   
							
			}else if (CoverageEdit.PerilsNo.trim() === "2019-OD-0003" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
						   // CoverageEdit.CoveragesPremium   =  this.GetPerilsDefaultData[0].PremiumAmount;
					    let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount = this.GetPerilsDefaultData[0].Amount;
						CoverageEdit.CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoverageEdit.CoveragesAmount)) *  parseFloat(PremiumAmount);        
						this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
						this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);
					    let PAmountOD =  CoverageEdit.CoveragesPremium;
			}else if (CoverageEdit.PerilsNo.trim() === "2019-TF-0002" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
						   // CoverageEdit.CoveragesPremium   =  this.GetPerilsDefaultData[0].PremiumAmount;
					  let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount = this.GetPerilsDefaultData[0].Amount;
					 CoverageEdit.CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoverageEdit.CoveragesAmount)) *  parseFloat(PremiumAmount);        
					  this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
					  this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
            }else if (CoverageEdit.PerilsNo.trim() === "2019-CT-0001" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
						   // CoverageEdit.CoveragesPremium   =  this.GetPerilsDefaultData[0].PremiumAmount;
					  let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount = this.GetPerilsDefaultData[0].Amount;
					  CoverageEdit.CoveragesPremium   =parseFloat(PremiumAmount);        
					  this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
					  this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
					
	

			}else{
			
			try {
                    const response = await axios.get('api/GetPerilsCoverageUsingTxtBox/'+passQuery.trim()).then(  ({ data }) => (this.GetPerilsTaripaByAmount = data)  );
                    console.log(response);
						  
						 if (this.form.OptSurcharge.trim() === "Commercial Use"){
                                 CoverageEdit.CoveragesPremium                          =  parseFloat( this.GetPerilsTaripaByAmount[0].PremiumAmount) *  parseFloat(UsageAmount) ;
						         this.form.PassCoverageAmount[CoverageEdit._id]  		=  this.GetPerilsTaripaByAmount[0].CoverageAmount; 
						         this.form.PassCoveragePremium[CoverageEdit._id]	    =  CoverageEdit.CoveragesPremium ;

                         }else{
                                CoverageEdit.CoveragesPremium   =  this.GetPerilsTaripaByAmount[0].PremiumAmount;
						        this.form.PassCoverageAmount[CoverageEdit._id]  		=  this.GetPerilsTaripaByAmount[0].CoverageAmount; 
						        this.form.PassCoveragePremium[CoverageEdit._id]	    =  CoverageEdit.CoveragesPremium ;
                                //();
                         }
                        
                } catch (error) {

                    console.error(error);
                     Swal.fire(
                                "Failed",
                                "No Taripa  Record Found Max = 1M",
                                "warning"
                            );
                }
			   

			} //close for If condition
				 this.ComputeTotals(CoverageEdit);		
				  let CompTotalCharges = 0;
                     for (let i = 0; i < this.ListChargesOption.length; i++) {
                           
                             if (  this.ListChargesOption[i].ChargesType === "Percent"  ) {
                                let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount) *   parseFloat(this.ProposalFormEdit[ArrayIndex].TotalPremium);
                             
                                 if ( this.ListChargesOption[i].ChargesNo === "2019-DP-0001"  ) {
                                    let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                                    let numpart = parseFloat(value).toFixed(2).split(".");
                                            if (numpart[1] < 51) {
                                                let CompChargesAmount = parseFloat(numpart[0]) + "." + 50;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                                
                                            }else {
                                                let CompChargesAmount =parseFloat(numpart[0]) + 1;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                               
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                            }
                                              
                                            
                                             
                                }else{
                                            this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                             CompTotalCharges +=    parseFloat(CompChargesAmount);
                                } 
                                
                             }else{
                                   let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount);
                                     CompTotalCharges +=    parseFloat(CompChargesAmount);
                             }
                          
                               
                     }
                
				   
				 this.ProposalFormEdit[ArrayIndex].TotalCharges    = CompTotalCharges   ;  
                 this.ProposalFormEdit[ArrayIndex].TotalAmountDue  = parseFloat(CompTotalCharges) + parseFloat( this.ProposalFormEdit[ArrayIndex].TotalPremium )     ;  
              } ///close if checkbox uncheck        
           
        },

          async  EditAmountUsingChkBox(CoverageEdit) {
               this.isShowing = true;  //show the Update button , default false
                let UsageAmount     =   this.GetDefaultSurcharge[0].Amount ;
               let ArrayIndex                =  parseFloat(CoverageEdit.OptionNo) - 1;
               this.ListChargesOption        =  this.ProposalFormEdit[ArrayIndex].ListCharges ;
               this.form.CoveragesAmountChk[CoverageEdit._id] =  CoverageEdit.CoveragesAmount;
              
               if (this.form.TxtSelectAmount[CoverageEdit._id] == false) { 
                      
                        let CompTotalPremium           = parseFloat(this.ProposalFormEdit[ArrayIndex].TotalPremium) - parseFloat(CoverageEdit.CoveragesPremium);
                         CoverageEdit.CoveragesPremium  = 0.00 ;
                        this.form.PassCoveragePremium[CoverageEdit._id]	   = CoverageEdit.CoveragesPremium ;
                      //  this.ProposalFormEdit[ArrayIndex].TotalPremium     =  parseFloat(CompTotalPremium) + parseFloat( CoverageEdit.CoveragesPremium);
                       this.ComputeTotals(CoverageEdit);

               }else{
                        let passQuery2    = this.form.Denomination.trim() +   ";;" +    CoverageEdit.PerilsNo.trim();
              
                   if (CoverageEdit.PerilsNo.trim() === "2019-AOG-0004" ){
                        const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                             console.log(response);
							let AOGFormula  =  this.GetPerilsDefaultData[0].Amount;
							CoverageEdit.CoveragesPremium   = parseFloat(CoverageEdit.CoveragesAmount) *  parseFloat(AOGFormula);     
							this.form.PassCoveragePremium[CoverageEdit._id]			=  CoverageEdit.CoveragesPremium ;							
							this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
					}else if (CoverageEdit.PerilsNo.trim() === "2019-PA-0007" ){
                             const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                             console.log(response);
                            let PAFormula  =  this.GetPerilsDefaultData[0].Amount;
                            
                            if (this.form.OptSurcharge.trim() === "Commercial Use"){
                                        CoverageEdit.CoveragesPremium                       = (parseFloat(CoverageEdit.CoveragesAmount) *  parseFloat(PAFormula) )* parseFloat(UsageAmount);       
						                this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
						                this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);

                            }else{
                                    CoverageEdit.CoveragesPremium                       = parseFloat(CoverageEdit.CoveragesAmount) *  parseFloat(PAFormula);      
						            this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
						             this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);
					   

                            }
                        
							
					
                    }else if (CoverageEdit.PerilsNo.trim() === "2019-OD-0003" ){
                         const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                             console.log(response);
                                let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount =  this.GetPerilsDefaultData[0].Amount;;
                                CoverageEdit.CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoverageEdit.CoveragesAmount)) *  parseFloat(PremiumAmount);        
                                this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
                                this.form.PassCoverageAmount[CoverageEdit._id]  	=  parseFloat(CoverageEdit.CoveragesAmount);
                                let PAmountOD =  CoverageEdit.CoveragesPremium;
                    }else if (CoverageEdit.PerilsNo.trim() === "2019-TF-0002" ){
                           const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                             console.log(response);
                            let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount =  this.GetPerilsDefaultData[0].Amount;;
                            CoverageEdit.CoveragesPremium   =( parseFloat(RatePercentage) * parseFloat(CoverageEdit.CoveragesAmount)) *  parseFloat(PremiumAmount);        
                            this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
                            this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
                    }else if (CoverageEdit.PerilsNo.trim() === "2019-CT-0001" ){
                    const response = await axios.get('api/GetPerilsDefaultData/'+passQuery2.trim()).then(  ({ data }) => (this.GetPerilsDefaultData = data)  );
                    console.log(response);
						   // CoverageEdit.CoveragesPremium   =  this.GetPerilsDefaultData[0].PremiumAmount;
					  let RatePercentage = this.form.PassCoverageRate[CoverageEdit.OptionNo] ; let  PremiumAmount = this.GetPerilsDefaultData[0].Amount;
					  CoverageEdit.CoveragesPremium   =parseFloat(PremiumAmount);        
					  this.form.PassCoveragePremium[CoverageEdit._id]		=  CoverageEdit.CoveragesPremium ;
					  this.form.PassCoverageAmount[CoverageEdit._id]  		=  parseFloat(CoverageEdit.CoveragesAmount);
   
                    }else{

                            try {
                                    let  TxtAmountInput           =   this.form.CoveragesAmountChk[CoverageEdit._id];
                                
                                let passQuery   = this.form.Denomination.trim() +   ";;" +   TxtAmountInput +     ";;" +   CoverageEdit.PerilsNo.trim();
                                    const response = await axios.get('api/GetPerilsCoverageUsingTxtBox/'+passQuery.trim()).then(  ({ data }) => (this.GetPerilsTaripaByAmount = data)  );
                                    console.log(response);
                                      if (this.form.OptSurcharge.trim() === "Commercial Use"){
                                            CoverageEdit.CoveragesPremium                           =  parseFloat(this.GetPerilsTaripaByAmount[0].PremiumAmount ) *  parseFloat(UsageAmount);
                                            this.form.PassCoverageAmount[CoverageEdit._id]  		=  this.GetPerilsTaripaByAmount[0].CoverageAmount; 
                                            this.form.PassCoveragePremium[CoverageEdit._id]		    =  CoverageEdit.CoveragesPremium ;


                                      }else{
                                           CoverageEdit.CoveragesPremium   =  this.GetPerilsTaripaByAmount[0].PremiumAmount;
                                             this.form.PassCoverageAmount[CoverageEdit._id]  		=  this.GetPerilsTaripaByAmount[0].CoverageAmount; 
                                             this.form.PassCoveragePremium[CoverageEdit._id]		    =  CoverageEdit.CoveragesPremium ;


                                      }
                                   
                                    //this.ComputeTotals(CoverageEdit);
                                } catch (error) {
                                    console.error(error);
                                    Swal.fire(
                                                "Failed",
                                                "No Taripa  Record Found Max = 1M",
                                                "warning"
                                            );
                                }
                 
                    }
                    this.ComputeTotals(CoverageEdit);	
              } //close for If condition for CheckBox
                      
                    let CompTotalCharges = 0;
                     for (let i = 0; i < this.ListChargesOption.length; i++) {
                           
                             if (  this.ListChargesOption[i].ChargesType === "Percent"  ) {
                                let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount) *   parseFloat(this.ProposalFormEdit[ArrayIndex].TotalPremium);
                             
                                 if ( this.ListChargesOption[i].ChargesNo === "2019-DP-0001"  ) {
                                    let value = CompChargesAmount; //parseFloat(URLQueryPerilsChargess.ChargesAmount )  *  parseFloat(this.form.TxtPremiumAmount )  ;
                                    let numpart = parseFloat(value).toFixed(2).split(".");
                                            if (numpart[1] < 51) {
                                                let CompChargesAmount = parseFloat(numpart[0]) + "." + 50;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                                
                                            }else {
                                                let CompChargesAmount =parseFloat(numpart[0]) + 1;
                                                this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                               
                                                CompTotalCharges +=    parseFloat(CompChargesAmount);
                                            }
                                              
                                            
                                             
                                }else{
                                            this.ProposalFormEdit[ArrayIndex].ListCharges[i].ChargesPremium = CompChargesAmount ; 
                                             CompTotalCharges +=    parseFloat(CompChargesAmount);
                                } 
                                
                             }else{
                                   let CompChargesAmount =   parseFloat( this.ListChargesOption[i].ChargesAmount);
                                     CompTotalCharges +=    parseFloat(CompChargesAmount);
                             }
                          
                               
                     }
                
				   
				 this.ProposalFormEdit[ArrayIndex].TotalCharges    = CompTotalCharges   ;  
                 this.ProposalFormEdit[ArrayIndex].TotalAmountDue  = parseFloat(CompTotalCharges) + parseFloat( this.ProposalFormEdit[ArrayIndex].TotalPremium )     ;  

           
        },

         async  UpdateMotorDetails(){
       
      if ( !this.form.MotorPOAmount || this.form.MotorPOAmount ===" ") {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Motor PO Amount.',
          
          })
            
          
      }else if (!this.form.MotorBrand || this.form.MotorBrand ===" ") {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Select Motor Brand.',
          
          })
      }else if (!this.form.MotorModel || this.form.MotorModel ===" ") {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Motor Model.',
          
          })
      }else if (!this.form.MotorType || this.form.MotorType ===" ") {
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pls. Motor Type.',
          
          })
      }else{
            
             const { value: text } = await Swal.fire({
                title: "CONFIRMED?",
                text: "Update Motor Details",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                  //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                 if (result.value) {

                          //this.LoadDataForUpdata(); 
                             this.form.post("api/UpdateMotorDetails/" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    " Motor Details Updated",
                                    "success"
                                );
                                   this.LoadResultData();
								   this.AutoLoad() ;
                                   this.load();
                                   //this.isShowing = false; 
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
           })
               
             }        
        },

        async  UpdatePersonalDetails(){
            
             const { value: text } = await Swal.fire({
                title: "CONFIRMED?",
                text: "Update Personal Details",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                  //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                 if (result.value) {

                          //this.LoadDataForUpdata(); 
                             this.form.post("api/UpdatePersonalDetails/" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    " Personal Details Updated",
                                    "success"
                                );
                                   this.LoadResultData();
								   this.AutoLoad() ;
                                   this.load();
                                   //this.isShowing = false; 
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
           })
               
                 
        },
        


        async  UpdateQuotationOption(){
                    
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ?",
                text: " Update Quotation ",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                  //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                 if (result.value) {

                          this.LoadDataForUpdata(); 
                             this.form.post("api/UpdateQuotationOption/" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    "Quotation Updated",
                                    "success"
                                );
                                   this.LoadResultData();
								   this.AutoLoad() ;
                                   this.load();
                                   this.isShowing = false; 
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }else{
                     this.isShowing = false; 
                }
           })
               
                 
        },
        

        async SubmitNewCoveragesOption() {
            this.clearPerilsData();        
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ?",
                text: " Add New Quotation Option",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                  //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                 if (result.value) {

                             for (let p = 0; p < this.GetPerils.data.length; p++) { 	
                                this.form.ToSavedGetPerils.push(this.GetPerils.data[p].PerilsNo);	
                   
                             }
                             this.form.post("api/SubmitNewCoveragesOption/" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    "New Quotation Option Created",
                                    "success"
                                );
                                  this.LoadResultData();
								   this.AutoLoad() ;
                                   this.load();
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
           })
               
           
        },


LoadDataForUpdata(){
                for (let i = 0; i < this.ProposalFormEdit.length; i++) {
                this.ListCoveragesOptionNew[i]       =  this.ProposalFormEdit[i].ListCoverages ;
				this.ListChargesOptionLoopNew[i]         =  this.ProposalFormEdit[i].ListCharges ;
              
						
					for (let coverages = 0; coverages < this.ListCoveragesOptionNew[i].length; coverages++) {  
								let IDid = this.ListCoveragesOptionNew[i][coverages]._id;
						
							this.form.ToSavedCoverageID.push( this.ListCoveragesOptionNew[i][coverages]._id  );
                            this.form.ToSavedCoverageAmount.push( parseFloat( this.ListCoveragesOptionNew[i][coverages].CoveragesAmount) );
                           

                           


                            this.form.ToSavedCoveragePremium.push( parseFloat(this.ListCoveragesOptionNew[i][coverages].CoveragesPremium) ); 
						 
							this.form.ToSavedTotalPremium.push(parseFloat(this.ProposalFormEdit[i].TotalPremium ) );
						if ( this.ListCoveragesOptionNew[i][coverages].PerilsCode === "AOG"){
								this.form.ToSavedWithAOGID.push( this.ListCoveragesOptionNew[i][coverages]._id );
						}
						if ( this.ListCoveragesOptionNew[i][coverages].PerilsCode === "OD"){
								this.form.ToSavedWithODID.push( this.ListCoveragesOptionNew[i][coverages]._id );
						}
						if ( this.ListCoveragesOptionNew[i][coverages].PerilsCode === "TF"){
								this.form.ToSavedWithTFID.push( this.ListCoveragesOptionNew[i][coverages]._id );
						}						
							
							this.form.ToSavedCoveragesRate.push( this.form.PassCoverageRate[this.ProposalFormEdit[i].OptionNo]);
							this.form.ToSavedTotalCoverages.push(parseFloat(this.ProposalFormEdit[i].TotalCoverages));
					}//-----Charges----------------------
					for (let charges = 0; charges < this.ListChargesOptionLoopNew[i].length; charges++) { 	
							let IDidCharges = this.ListChargesOptionLoopNew[i][charges]._id;		
							
							this.form.ToSavedChargesID.push( IDidCharges); 
							this.form.ToSavedChargesPremium.push( parseFloat( this.ListChargesOptionLoopNew[i][charges].ChargesPremium)); 
							this.form.ToSavedTotalCharge.push(parseFloat( this.ProposalFormEdit[i].TotalCharges));	
							this.form.ToSavedTotalAmountDue.push(this.ProposalFormEdit[i].TotalAmountDue); 
					}
                }

        },
  clearPerilsData(){
        this.form.ToSavedGetPerils = []; ///clear array
  },
        ////OLD Codes
        AutoLoad() {
            axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));

            let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
            axios
                .get("api/URLQueryRequestModify/" + PassID)
                .then(({ data }) => (this.ResultQueryRequest = data));
                this.LoadDenomination() ;
           
        },

     
        //---------------CODES FOR ADD CLICK------------------------------------------------------------------------------------
     
        load() {
            this.RetrieveTimeInterval = setInterval(() => {
                this.form.CustAcctNo        =  this.UserDetails.AccountNo;
                this.form.CustAcctCName     =  this.UserDetails.CName;
                //this.ResultQueryRequest.data.map(ResultRequestDetailss => {
                this.form.RequestNoPass         = this.ResultQueryRequest.RequestNo;
                this.form.PlateNumber           = this.ResultQueryRequest.PlateNumber;
                this.form.TINNumber             = this.ResultQueryRequest.TINNumber;
                this.form.EmailAddress          = this.ResultQueryRequest.EmailAddress;
                this.form.MotorBrand            = this.ResultQueryRequest.MotorBrand;
                this.form.ContactNumber         = this.ResultQueryRequest.ContactNumber;
                this.form.FirstName             = this.ResultQueryRequest.FirstName;
                this.form.MiddleName            = this.ResultQueryRequest.MiddleName;
                this.form.LastName              = this.ResultQueryRequest.LastName;
                this.form.Address               = this.ResultQueryRequest.Address;
                this.form.Barangay              = this.ResultQueryRequest.Barangay;
                this.form.City                  = this.ResultQueryRequest.City;
                this.form.Denomination          = this.ResultQueryRequest.Denomination;
                this.form.TypeClass             = this.ResultQueryRequest.MotorBodyType;
                this.form.MotorYear             = this.ResultQueryRequest.MotorYear;
                this.form.MotorBrand            = this.ResultQueryRequest.MotorBrand;
                this.form.CoverageAmount        = this.ResultQueryRequest.CoverageAmount;
                this.form.MotorPOAmount         = this.ResultQueryRequest.MotorPOAmount;
                this.form.RatePercent           = this.ResultQueryRequest.RatePercent;
                this.form.MotorModel            = this.ResultQueryRequest.MotorModel;
                this.form.MotorType             = this.ResultQueryRequest.MotorBodyType;
                this.form.OptSurcharge          = this.ResultQueryRequest.MotorUsage;
                // this.form.TxtPremiumAmount   =ResultRequestDetailss.PremiumAmount;
                this.form.passengers            = this.ResultQueryRequest.Passengers;
                this.form.ProductLine           = this.ResultQueryRequest.ProductLine;
                //this.form.Deductible = ResultRequestDetailss.Deductable;
                this.form.QuoteExpiryStatus     = this.ResultQueryRequest.QuoteExpiryStatus;
                this.form.DepreciativeAmount    = this.ResultQueryRequest.DepreciativeAmount;

                this.$forceUpdate();
           // });
			
						 this.ProposalFormEdit.map( URLQueryPerilsCoveragesGroups => {
							this.form.PassCoverageRate[URLQueryPerilsCoveragesGroups.OptionNo] =URLQueryPerilsCoveragesGroups.CoverageRates;
						 
                                             URLQueryPerilsCoveragesGroups.ListCoverages.map(
                                            ListCoveragesURL => {
                                             this.form.PassCoverageAmount[ListCoveragesURL._id] 		=   ListCoveragesURL.CoveragesAmount;
											 this.form.PassCoverageID[ListCoveragesURL._id] 			=   ListCoveragesURL._id;
											 this.form.PassCoveragePremium[ListCoveragesURL._id]		=   ListCoveragesURL.CoveragesPremium;
											// this.form.PassTotalCoverages[ListChargesURL.OptionNo]			=   ListChargesURL.TotalCharges;
                                              }
                                         );
										 
										  URLQueryPerilsCoveragesGroups.ListCharges.map(
                                            ListChargesURL => {
                                             this.form.PassChargesPremium[ListChargesURL._id] 		=   ListChargesURL.ChargesPremium;
											 this.form.PassChargesID[ListChargesURL._id] 			=   ListChargesURL._id;
											 this.form.PassTotalCharges[ListChargesURL.OptionNo]			=   ListChargesURL.TotalCharges;

                                              }
                                         );

                                          this.form.RequestNoOptionNo = URLQueryPerilsCoveragesGroups.OptionNo;
                                
                         }
                    );
			

           
        }, 1000);

        this.RetrieveTimeInterval2 = setInterval(() => {
            clearInterval(this.RetrieveTimeInterval);
        }, 5000);
        },

        openForm() {
            document.getElementById("myForm").style.display = "block";
        },

        closeForm() {
            document.getElementById("myForm").style.display = "none";
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
        yearD () {
                const year = new Date().getFullYear()
                let MinusYear = year - 10;
                return Array.from({length: year - MinusYear}, (value, index) => year - index)
       
         },
    },


    created() {
        this.load()
        //this.RetrieveTimeInterval     = setInterval(this.fetchEventsList, 1000) ;
        //this.RetrieveTimeInterval1    = setInterval(this.GetPerilsTaripaByAmount, 1000) ;
        //this.loadGetRequestDetails();
        
    }
};
</script>

<style scoped>
/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 50px;
  right: 28px;
  width: 280px;
  border-radius: 25px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 50px;
  right: 15px;
  border: 1px solid #f1f1f1;
  z-index: 9;
  border-radius: 10px;
}

/* Add styles to the form container */
.form-container {
  width: 550px;
  max-width: 500px;
  padding: 10px;
  background-color: white;
  display: inline-block;
}

/* Full-width textarea */
/* .form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
} */

/* When the textarea gets focus, do something */
/* .form-container textarea:focus {
  background-color: #ddd;
  outline: none;
} */

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
  border-radius: 25px;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#quoteslogo {
    width: 125px;
}
</style>


<style scoped>
.custom {
  overflow: auto;
  max-height: 200px;
  position: absolute;
  z-index: 10;
  background: #fff;
  width: 95%;
  color: black;
  margin-right: 1rem;
}

ul {
  list-style: none;
  padding: 1rem;
  cursor: pointer;
}

li:hover {
    color: red;
    background-color: #a5b1c2;
}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: green;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 50px;
  right: 28px;
  width: 280px;
  border-radius: 25px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 50px;
  right: 15px;
  border: 1px solid #f1f1f1;
  z-index: 9;
  border-radius: 10px;
}

/* Add styles to the form container */
.form-container {
  width: 550px;
  max-width: 500px;
  padding: 10px;
  background-color: white;
  display: inline-block;
}

/* Full-width textarea */
/* .form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
} */

/* When the textarea gets focus, do something */
/* .form-container textarea:focus {
  background-color: #ddd;
  outline: none;
} */

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
  border-radius: 25px;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#quoteslogo {
    width: 125px;
}
</style>


