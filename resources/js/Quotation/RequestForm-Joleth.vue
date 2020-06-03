<template>
    <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Motor Car Details</strong></h3>
                <a data-toggle="tooltip" data-placement="right" title="Your Motor Car details can be found on your Certificate of Registration (CR)">
                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                </a>
            </div>
           
            <form @submit.prevent="MotorRequestQuotation()" enctype="multipart/form-data" >
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-sm-4" >
                            <label class=" col-form-label"><big style="color:red"> * </big> Plate Number:  
                            <a data-toggle="tooltip" data-placement="right" title="Pls. input Plate Number / Temporary / Conduction Sticker">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>                                
                            </label>
                            <input type="text"  class="form-control"    v-model="form.PlateNumber" placeholder="Plate Number" required />                                
                        </div>
                        <div class="col-sm-4" > 
                            <label class="col-form-label"><big style="color:red"> * </big> Denomination: </label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select DENOMINATION on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>
                            <input type="text" v-model="form.DenominationDis" @change="ChangeDenomination()" autocomplete="off" @focus="filterDen = true"  class="form-control" placeholder="Enter / Select Denomination" required>
                            <div v-if="DataDenominations && filterDen" class="custom">
                                <ul>
                                    <li v-for="value in DataDenominations" :key="value._id" @click="setValueDenomination(value)">{{value.SubLinesName}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4" >
                            <label class=" col-form-label"><big style="color:red"> * </big> Car Purchased Amount / Market Value: </label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select PURCHASED AMOUNT on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>                            
                            <input type="number" v-model="form.POAMount" @change="ChangeDenomination(),ComputeDepreciativeAmount()"  autocomplete="off" @focus="filter = true"   class="form-control" placeholder="Enter / Select Car Purchase Amount" required>
                            <div v-if="MarketValues && filter" class="custom">
                                <ul>
                                    <li v-for="value in MarketValues" :key="value._id" @click="setValue(value.CarAmount)">{{value.CarAmount | Peso}}</li>
                                </ul>
                            </div>
                            <small class="label label-guide-2">Depreciation Amount : {{ form.DepreciativeAmount | Peso}}</small> 
                        </div>
                    </div>

                    <div class="form-group row">                         
                        <div class="col-sm-3">
                            <label class="col-form-label"><big style="color:red"> * </big> Year</label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select YEAR Purchased  on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>   
                            <input type="number" v-model="form.YearPO" @change="ChangeDenomination(),ComputeDepreciativeAmount()"  autocomplete="off" @focus="filterYear = true"  class="form-control" placeholder="Enter / Select Year Purchased" required>
                            <div v-if="yearD && filterYear" class="custom">
                                <ul>
                                    <li  v-for="yearDs in yearD" :value="yearDs" :key="yearDs" @click="setValueYear(yearDs)">{{ yearDs }} </li>
                                </ul>
                            </div>
                        </div>
                            <div class="col-sm-3">
                            <label class="col-form-label"><big style="color:red"> * </big> Brand:</label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select BRAND  on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>                            
                            <input type="text" v-model="form.CarBrand"  @change="ChangeDenomination()"  autocomplete="off" @focus="filterCarBrands = true"  class="form-control" placeholder="Enter / Select Year Car Brand" required>
                            <div v-if="DataCarBrands && filterCarBrands" class="custom">
                                <ul>
                                    <li  v-for="DataCarBrandss in DataCarBrands" :value="DataCarBrandss.BrandName" :key="DataCarBrandss._id"  @click="setValueCarBrands(DataCarBrandss)">{{ DataCarBrandss.BrandName }} </li>
                                </ul>
                            </div>
                        </div>
                            <div class="col-sm-3">
                            <label class="col-form-label"><big style="color:red"> * </big> Model:</label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select MODEL on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>
                            <input type="text" v-model="form.CarModel" @change="ChangeDenomination()"   autocomplete="off" @focus="filterCarModels = true"  class="form-control" placeholder="Enter / Select Car Model" required>
                            <div v-if="DataCarModelsList && filterCarModels" class="custom">
                                <ul>
                                    <li  v-for="DataCarModelss in DataCarModelsList" :value="DataCarModelss.ModelName" :key="DataCarModelss._id" @click="setValueCarModel(DataCarModelss)">{{ DataCarModelss.ModelName }} </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label"><big style="color:red"> * </big> Body Type</label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select BODY TYPE on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>
                            <input type="text" v-model="form.BodyType" @change="ChangeDenomination()"  autocomplete="off" @focus="filterCarBodyType = true"  class="form-control" placeholder="Enter / Select Body Type" required>
                            <div v-if="DataCarBodyType && filterCarBodyType" class="custom">
                                <ul>
                                    <li  v-for="DataCarBodyTypes in DataCarBodyType" :value="DataCarBodyTypes.BodyTypeName" :key="DataCarBodyTypes" @click="setValueCarBodyType(DataCarBodyTypes)">{{ DataCarBodyTypes.BodyTypeName }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="col-form-label"><big style="color:red"> * </big> Usage  </label>
                            <a data-toggle="tooltip" data-placement="right" title="Pls. Select USAGE on the list, FOR COMMERCIAL USE-->select Net Weight and check Accessories">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>
                            <select class="form-control" v-model="form.usages" @change="ShowHideCom()"  required>
                                <option selected disabled  > Pls.Select</option>
                                <option value="Personnal Use"  > Personal Use</option>
                                <option value="Commercial Use"  >  Commercial Use</option>
                            </select>
                            <a class="label label-guide-2" @click="LoadDataSurcharges()"  data-toggle="tooltip" data-placement="right" title="View more usage /s">Other Usage ... </a> 
                        </div>
                        
                        <div class="col-sm-4" v-if="ShowCommercial">
                            <label class="col-form-label">Net Weight:  </label>                            
                            <select class="form-control" v-model="form.MotorNetWeight"  >
                                <option value="" > Pls.Select</option>
                                <option value="Less than 3,930 kg"  > Less than 3,930 kg</option>
                                <option value="Over 3,930 kg"  >Over 3,930 kg</option>
                            </select>
                        </div>

                        <div class="col-sm-4" v-if="ShowCommercial">
                            <label class="col-form-label">    Check if you have accessories: </label><br/>
                            <input id="accessories" type="checkbox" v-model="form.MotorAccessories" @change="onChange">
                            <label for="accessories">With Accessories</label>
                            <a data-toggle="tooltip" data-placement="right" title="Accessories are for approval basis. Accessories: Aircon, Stereo, Speakers, 5 Wheels">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>
                        </div>

                    </div>

                    <div class="form-group row" v-if="ShowSurcharges">
                        <div class="col-md-4" v-for="surcharge in DataSurcharges"  :key="surcharge._id" >
                            <div class="form-group" style="margin-bottom: 0">
                                <input type="checkbox" v-model="form.SurchageList" :value="surcharge.SurchargeName" :id="surcharge._id" />
                                <label :for="surcharge._id" style="font-weight: 500;">{{ surcharge.SurchargeName }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">                        
                           
                        <div class="col-sm-2">
                            <label class="col-form-label">Effective Date  :</label> 
                            <a data-toggle="tooltip" data-placement="right" title="Current Date is  a DEFAULT date for a EFFECTIVE DATE otherwise SPECIFY">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>      
                            <span class="label label-guide-2" data-toggle="tooltip" data-placement="right" title="Current Date is a Defualt Date ">{{ form.EffectiveDate }} </span>
                            <input type="date"  class="form-control"  v-model="effectiveDate"  data-toggle="tooltip" data-placement="right" title="Change the EFFECTIVE DATE" />
                            <label for="inputPassword" class="col-form-label">Expiry Date : </label>
                            <a data-toggle="tooltip" data-placement="right" title="EXPIRATION DATE of the Policy ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>     
                            <span class="label label-guide-2" >{{ form.ExpiryDate }} </span>
                        </div>

                        <div class="col-sm-10">
                            <label class="col-form-label"><big style="color:red"> * </big>Coverages:</label>
                            <a data-toggle="tooltip" data-placement="right"  title="Pls. Select COVERAGES on the List ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>  
                            <div class="form-group row container" >
                                <div  v-for="peril in DataCoverages" :key="peril._id"  style="float: left;width:25%;" >
                                    <div class="form-group col-md-12" style="margin-bottom: 0;"  v-if="peril.DefaultSel === 'YES'">
                                        <input :id="peril._id" type="checkbox"  @click="FocusPushRecord(peril)" v-model="form.PerilsName[peril.PerilsNo]" v-bind:data-perils="peril.PerilsNo"/>
                                        <label id="peril" :for="peril._id" style="font-weight: 500;">{{ peril.PerilsName }}</label>
                                        <a data-toggle="tooltip" data-placement="right"  title="Pls. Select to ENABLE the other COVERAGES ">
                                            <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                        </a>             
                                    </div>                                        
                                </div>

                                <br/><br/>

                                <div  v-for="peril in DataCoverages" :key="peril._id"  style="float:right;width:55%; display: block" >
                                    <div class="form-group col-md-12" style="margin-bottom: 0;"  v-if="peril.DefaultSel !== 'YES'">
                                        <input  :id="peril._id" type="checkbox" @click="FocusPushRecordSub(peril)" v-bind:disabled="PerilsCheckbox" v-model="form.SubPerilsName[peril.PerilsNo]" :checked="SubPerilsName" v-bind:data-perils="peril.PerilsNo" />
                                        <label id="peril" :for="peril._id" style="font-weight: 500;">{{ peril.PerilsName }}</label>
                                        <a data-toggle="tooltip" data-placement="right"  title=" 4 PASSENGER /s is DEFAULT VALUE otherwise SPECIFY" v-if="peril.PerilsCode === 'PA'" >
                                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                        </a>  
                                        <input type="nunmber" v-model="form.passengers"  v-bind:disabled="PerilsCheckbox"  v-if="peril.PerilsCode === 'PA'" class="form-control" placeholder="Enter number of PASSENGER">
                                    </div>                                                    
                                </div>

                                <div style="float:right;width:55%;"  >
                                    <div class="form-group col-md-12" style="margin-bottom: 0;" >
                                        <input id="checkall" type="checkbox" v-model="form.CheckAll" v-bind:disabled="PerilsCheckbox"   @click="CheckAllPerils()" />
                                        <label for="checkall" style="font-weight: 500;" class="label label-guide-2" > Check / Uncheck All : <i class="fa fa-arrow-up"></i> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title" ><strong>Personal Details</strong></h3>
                        <div style="margin-left: 50%;">                                    
                            <input type="checkbox" id="cbIndividualOption" @click="IndividualOption()">
                            <label for="cbIndividualOption"> Others</label>
                        </div>
                    </div>

                    <div class="form-group row col-sm-12">
                        <div class="col-sm-4">
                            <label class="col-form-label"><big style="color:red"> * </big> First Name </label>
                            <a data-toggle="tooltip" data-placement="right"  title="CONTACT PERSON First Name ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="text" class="form-control" v-model="form.first_name" v-bind:disabled="disabledtext" required />
                        </div>
                   
                        <div class="col-sm-4">
                            <label class="col-form-label"> Middle Name</label>
                            <a data-toggle="tooltip" data-placement="right"  title="CONTACT PERSON Middle Name ">
                                        <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="text"  class="form-control"    v-model="form.middle_name"  v-bind:disabled="disabledtext"/>
                        </div>

                         <div class="col-sm-4">
                            <label class="col-form-label"><big style="color:red"> * </big> Last Name:</label>
                            <a data-toggle="tooltip" data-placement="right"  title="CONTACT PERSON Last Name ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="text"  class="form-control"    v-model="form.last_name"  v-bind:disabled="disabledtext"  required />
                        </div>

                    </div>

                    <div id='regname' class="form-group row col-sm-12" style="display: none;">
                        <div class="col-sm-6">
                            <label class="col-form-label"><big style="color:red"> * </big> Registered Name </label>
                            <a data-toggle="tooltip" data-placement="right"  title="SPECIFY the Registered Name (Based on CR)">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="text"  class="form-control"    v-model="form.registered_name"  v-bind:disabled="disabledtext"  required />
                        </div>
                    </div>

                    <div class="form-group row col-sm-12">
                        <div class="col-sm-4">
                            <label class="col-form-label"> TIN Number </label>
                            <a data-toggle="tooltip" data-placement="right"  title="SPECIFY the TIN Number ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="number" class="form-control" v-model="form.TINNumber"/>
                        </div>
                   
                        <div class="col-sm-4">
                            <label class="col-form-label"><big style="color:red"> * </big> Email Address </label>
                            <a data-toggle="tooltip" data-placement="right"  title=" EMAIL ADDRESS should be use to verify other needed INFORMATION / Data ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 

                            <input type="email"  class="form-control"    v-model="form.EmailAddress" required />
                        </div>

                         <div class="col-sm-4">
                            <label class="col-form-label"><big style="color:red"> * </big> Contact Number</label>
                            <a data-toggle="tooltip" data-placement="right"  title=" Contact Number should be use to verify other needed INFORMATION / Data">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="number" class="form-control" v-model="form.ContactNumber" required/>
                        </div>

                    </div>

                    <div class="form-group row col-sm-12" >                     
                        <div class="col-sm-6">
                            <label class="col-form-label"><big style="color:red"> * </big> Address:</label>
                            <a data-toggle="tooltip" data-placement="right" title="House No. & Street">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>  
                            <textarea class="form-control" rows="2" v-model="form.Address" placeholder="Address" required  ></textarea>
                        </div>

                        <div class="col-sm-6">
                            <label class="col-form-label"><big style="color:red"> * </big>Address Province:</label>
                            <a data-toggle="tooltip" data-placement="right"  title="Pls. Select Province on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>  
                            <input type="text" v-model="form.ProvName" @change="ChangeDenomination()"  autocomplete="off" @focus="filterPropertyProvince = true"  class="form-control" placeholder="Enter / Select Province" required>

                            <div v-if="DataProvinces && filterPropertyProvince" class="custom">
                                <ul>
                                    <li v-for="DataProvincess in DataProvinces"   :value="DataProvincess.ProvName"  :key="DataProvincess._id" @click="setValuePropertyProvince(DataProvincess)">{{DataProvincess.ProvName}}</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group row col-sm-12" >   

                        <div class="col-sm-6">
                            <label class="col-form-label"><big style="color:red"> * </big>Address City:</label>
                            <a data-toggle="tooltip" data-placement="right"  title="Pls.Select CITY on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a>  
                            <input type="text" v-model="form.CityName" @change="ChangeDenomination()"  autocomplete="off" @focus="filterPropertyCity = true"  class="form-control" placeholder="Enter / Select City" required>                            
                            
                            <div v-if="DataCities && filterPropertyCity" class="custom">
                                <ul>
                                    <li v-for="DataCitiess in DataCities"   :value="DataCitiess.CityName"  :key="DataCitiess._id" @click="setValuePropertyCity(DataCitiess)">{{DataCitiess.CityName}}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="col-form-label" ><big style="color:red"> * </big>Address Barangay:</label>
                            <a data-toggle="tooltip" data-placement="right"  title="Pls. Select BARANGAY on the list otherwise SPECIFY ">
                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                            </a> 
                            <input type="text" v-model="form.Barangay" @change="ChangeDenomination()"  autocomplete="off" @focus="filterPropertyBrgy = true" class="form-control" placeholder="Enter / Select Barangay" required>
                            
                            <div v-if="DataListBrgy && filterPropertyBrgy" class="custom">
                                <ul>
                                    <li v-for="DataListBrgys in DataListBrgy"  :value="DataListBrgys.BrgyName"  :key="DataListBrgys._id" @click="setValueBarangay(DataListBrgys)">{{DataListBrgys.BrgyName}}</li>
                                </ul>
                            </div>                            
                        </div>
                    </div>                   
                </div>

                <div class="box-footer">                
                    <button  type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

<!---------PREVIEW------------>
   <div>
    <button class="open-button" @click="openForm()" @focus="GetPerilsName()">Preview</button>

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
                    <h3>Request for Proposal</h3>
                </div>
            </div>
            
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <p><b>Assured</b><b class="pull-right">:</b></p>
                            <p><b>Address</b><b class="pull-right">:</b></p>
                            <p><b>Unit</b><b class="pull-right">:</b></p>
                            <p><b>Coverage</b><b class="pull-right">:</b></p>
                        </div>
                        <div class="col-md-10" style="padding: 0px 0px 0px 10px;">
                            <p>{{form.first_name}} {{form.middle_name}} {{form.last_name}}</p>
                            <p>{{ form.Address}}</p>
                            <p>{{ form.DenominationDis}} : {{form.YearPO}} {{form.CarBrand}} {{form.CarModel}} {{form.BodyType}} </p>
                             <p></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <ol class="pull-right">
                            <!-- <li v-for="coverage in PerilsName" :key="coverage._id">{{coverage.PerilsNo}}</li> -->
                               <li v-for="n in form.PerilsNameDis" :key="n._id">{{ n }} </li>
                               <li v-for="n in form.SubPerilsNameDis" :key="n._id">{{ n }} </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <small><b>Note:</b></small> 
                        <ol>
                            <li v-if="form.MotorAccessories"><small>Included Accessories</small></li>
                            <li  v-if="form.MotorNetWeight"><small>{{ form.MotorNetWeight }}</small></li>
                          
                        </ol>
                    </div>
                </div>
            </section>
            <button type="button" class="btn cancel" @click="closeForm()">Close</button>
        </div>
    </div>
</div>

               

            
        </div>
	<!-- ------<pre>{{ $data }}</pre>------- -->
        </div> 
        </div>

  

    </section>
    
	
</template>


<script>
import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial)

export default {
     mounted() {
        console.log('Component mounted.')
     
        this.LoadDenomination(); this.LoadCarAmounts(); this.LoadCarBrands();this.LoadCarBodyType() ;this.LoadDefaultDate();
        this.LoadCoverages();  this.LoadProvinces() ;
         axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
            this.LoadUserData();

          
    },

    data() {
        return {
            DataDenominations: {},
            MarketValues: {},
            DataCarBrands: {},
            DataCarBodyType: {},
            DataCarModelsList: {},
            DataSurcharges: {},
            DataCoverages: {},
            DataProvinces: {},
            DataCities: {},
            DataListBrgy: {},
            filter: false,
            filterDen: false,
            filterYear: false,
            filterCarBrands: false,
            filterCarModels: false,
            filterCarBodyType: false,
            filterPropertyProvince: false,
            filterPropertyCity: false,
            filterPropertyBrgy: false,
            disabledtext: true,
            PerilsCheckbox: true,
            year: '',

            ShowCommercial: false,
            ShowSurcharges: false,
            effectiveDate: '',
           // isCheckAll: false,

          
      
            UserDetails:{},
            checked:true,

            form: new Form({
                _id: '',
                PlateNumber: '',
                Denomination: '',
                POAMount: '',
                YearPO: '',
                CarBrand: '',
                CarModel: '',
                BodyType: '',
                usages: '',
                MotorNetWeight: '',
                MotorAccessories: '',
                SurchageList:[],
                EffectiveDate: '',
                ExpiryDate: '',
               // AssuredName: '',
                //AssuredAddress: '',
               // AssuredCity: '',
                //AssuredBarangay: '',
                passengers: '4',
                PerilsName:[],
                SubPerilsName:[],
                PerilsNameDis:[],
                SubPerilsNameDis:[],
                TINNumber: '',
                EmailAddress: '',
                ContactNumber: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                CustAcctNo: '',
                AcctName: '',
                Barangay: '',
                CityName: '',
                Province: '',
                Address: '',
                Individual: 'Individual',
                IndividualPass: '',
                DepreciativeAmount:'',
                DepreciativeNumberYear:'',


                DenominationDis:'',
                CheckAll:'',

               
            }),
        }
    },
    
    methods: { 
        IndividualOption(){
            //  let DataIndi = event.target.getAttribute('data-perils');
            //  this.form.IndividualPass = DataIndi;
            if (document.getElementById('cbIndividualOption').checked === true){
                this.disabledtext            = false;
                this.form.first_name         = '';
                this.form.last_name          = '';
                this.form.middle_name        = '';
                this.form.registered_name    = '';
                this.form.TINNumber          = '';
                this.form.EmailAddress       = '';
                this.form.ContactNumber      = '';
                this.form.Individual         = 'Others';
                this.form.IndividualPass     = 'Others';
                $('#regname').show();
                // alert("True");
            }else{
                this.disabledtext           = true;
                this.form.first_name        = this.UserDetails.first_name;
                this.form.last_name         = this.UserDetails.last_name;
                this.form.middle_name       = this.UserDetails.user_mname;
                this.form.EmailAddress      = this.UserDetails.email;
                this.form.Individual        = 'Individual';
                this.form.IndividualPass    = 'Individual';
                $('#regname').hide();
            }
        },

        ChangeDenomination(){

            this.form.Denomination    = '2019-PC-0001;;' + this.form.DenominationDis    ///default value
            this.filter = false;
            this.filterDen = false;
            this.filterYear = false;
            this.filterCarBrands = false;
            this.filterCarModels = false;
            this.filterCarBodyType = false;
            this.filterPropertyProvince = false;
            this.filterPropertyCity = false;
            this.filterPropertyBrgy = false;
        },

        LoadUserData(){
            this.RetrieveTimeInterval = setInterval(() => {
                    this.form.TINNumber          = this.UserDetails.TINno;
                    this.form.first_name         = this.UserDetails.first_name;
                    this.form.last_name          = this.UserDetails.last_name;
                    this.form.middle_name        = this.UserDetails.user_mname;
                    this.form.EmailAddress       = this.UserDetails.email;
                    this.form.ContactNumber      = this.UserDetails.ContactNo;
                    this.form.CustAcctNo         = this.UserDetails.AccountNo;
                    this.form.AcctName           = this.UserDetails.CName;            
            }, 1000);    
                this.RetrieveTimeInterval2 = setInterval(() => {
                    clearInterval(this.RetrieveTimeInterval);
            },5000); 	
        
        },


        ShowHideCom(){
            if (this.form.usages === 'Commercial Use'){
                   // alert();
                    this.ShowCommercial=true;
            }else{
                     this.ShowCommercial=false;
            }

        },

        FocusPushRecord(peril){
            let DataPerils = peril.PerilsNo;  //event.target.getAttribute('data-perils');
          
           if ( !(this.form.PerilsName[DataPerils])){
               if ( DataPerils === '2019-OD-0003'){
                  this.form.PerilsName.push('2019-TF-0002');
               }
               this.form.PerilsName.push(DataPerils);
                

               this.form.PerilsNameDis.push(peril.PerilsName);
               this.PerilsCheckbox = false;

            
            }else{
                this.form.PerilsName.splice(DataPerils, 1);
                if ( DataPerils === '2019-OD-0003'){
                    this.form.PerilsName.splice('2019-TF-0002');
                }
                this.form.PerilsNameDis.splice(DataPerils, 1);
                // this.PerilsCheckbox = true;
            
            }
            //this.form.PerilsName['5db90f2951e2334594006bf8'] = true; ///check the perils
            this.UnCheckAllPerils(); 
         // this.removeDuplicates();        
        },


        FocusPushRecordSub(peril){
            let DataPerils = peril.PerilsNo;  //event.target.getAttribute('data-perils');
            let DataPerilsName = peril.PerilsName; 
            if ( !(this.form.SubPerilsName[DataPerils])){
                this.form.SubPerilsName.push(DataPerils);
                this.form.SubPerilsNameDis.push(DataPerilsName);
                // this.PerilsCheckbox = false;
           }else{
                this.form.SubPerilsName.splice(DataPerils, 1);
                this.form.SubPerilsNameDis.splice(DataPerilsName, 1);
            }         
        },

        UnCheckAllPerils(){
            for (let i = 0; i < this.DataCoverages.length; i++) {
                let DefualtSel =   this.DataCoverages[i].DefaultSel;
                let  IDNO; let IDYES;
                if (DefualtSel !=='YES'){
                    IDNO = this.DataCoverages[i].PerilsNo;
                    IDName       = this.DataCoverages[i].PerilsName;
                }

                if (!this.form.PerilsName || !this.form.PerilsName.length) {  ///if array is empty
                    this.form.SubPerilsName[IDNO] = false;    //uncheck
                    this.form.CheckAll= false;  
                    this.PerilsCheckbox = true;  
                    this.form.SubPerilsName.splice(IDNO,1);
                    this.form.SubPerilsNameDis.splice(IDName,1);
                }else{
                    this.PerilsCheckbox = false;  
                }

                // this.form.PerilsName[IDNO] = false;                          
            }              
        },

        FocusCheckAllPerils(){
            for (let i = 0; i < this.DataCoverages.length; i++) {
                let DefualtSel =   this.DataCoverages[i].DefaultSel;
                let  IDNO; let  IDName;   let DataPerils;
                if (DefualtSel !=='YES'){
                    IDNO        = this.DataCoverages[i].PerilsNo;
                    IDName     = this.DataCoverages[i].PerilsName;
                    this.form.SubPerilsName.splice(IDNO);
                    this.form.SubPerilsNameDis.splice(IDName);
                }
            }       
        },

        CheckAllPerils(){
            this.FocusCheckAllPerils();
            
                for (let i = 0; i < this.DataCoverages.length; i++) {
                    let DefualtSel =   this.DataCoverages[i].DefaultSel;
                    let  IDNO;   let  IDName;  let DataPerils;
                    if (DefualtSel !=='YES'){
                        IDNO        = this.DataCoverages[i].PerilsNo;
                        IDName       = this.DataCoverages[i].PerilsName;
                        if(!(this.form.CheckAll)){    //if not empty
                            this.form.SubPerilsName[IDNO] = true; //check
                            this.form.SubPerilsName.push(IDNO);     ////add into array
                            this.form.SubPerilsNameDis.push(IDName);
                        }else{
                            this.form.SubPerilsName[IDNO] = false;   //uncheck
                            this.form.SubPerilsName.splice(IDNO);   ///clear array
                            this.form.SubPerilsNameDis.splice(IDName);
                        }
                    }  
                }                
        },

        CombineAllPerils() {   ///copy array into another array         
            const OrigArray         = this.form.PerilsName  
            this.form.PerilsName    = OrigArray.concat(this.form.SubPerilsName)
            //alert()
        },

        GetPerilsName(){
            let TotalV = this.form.PerilsName.length;   let IDNO  ;
            for(let i = 0; i < TotalV; i++) {
            IDNO        = this.form.PerilsName[i];
            // alert(IDNO);
                this.form.PerilsName[IDNO ]= true;  
            }
        },
     

   
        MotorRequestQuotation() {
            // this.form.post('api/quotation')
            // .then(res => {
            //   Swal.fire(
            //       'Successful!',
            //       `Quotaion has been submitted.`,
            //       'success'
            //   )
            //   console.log(res);
            //   //this.$router.push('/dashboard');
            //   this.$router.push("/proposal-lists-customer");
            // })
            // .catch(error => {
            //   console.log(error);
            // });

            if (!this.form.PlateNumber || this.form.PlateNumber ===" ") {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Input Plate No.',          
                })
            }else if (!this.form.Denomination || this.form.Denomination ===" ") {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Denomination.',          
                })
            }else if (!this.form.POAMount || this.form.POAMount ===" ") {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Car Purchased Amount / Market Value.',          
                })
            }else if (!this.form.YearPO || this.form.YearPO ===" ") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Year.',          
            })
            }else if (!this.form.CarBrand || this.form.CarBrand===" ") {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Brand.',        
                })
            }else if (!this.form.CarModel || this.form.CarModel===" ") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select Model.',          
                })
            }else if  (!this.form.BodyType || this.form.BodyType===" ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select Body Type.',          
                })
            }else if (!this.form.usages || this.form.usages===" ") { 
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select Usages.',          
                })
            }else if (!this.form.EffectiveDate || this.form.EffectiveDate===" " ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select /Input Effective Date.',
                
                })
            }else if (!this.form.PerilsName.length)  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select Coverages.',
                
                })
            }else if (!this.form.Address.length || this.form.EffectiveDate===" " )  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input your Address.',          
                }) 
            }else if (this.form.ContactNumber.length > 11)  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Contact No. is maximum of 11 digits',          
                }) 
            }else if (this.form.ContactNumber.length < 8)  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Contact No. is minimum of 8 digits',          
                })
            }else if (this.form.Individual === "Others" && this.form.registered_name === " ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input the Registered Name',          
                }) 
            }else{
                this.CombineAllPerils();  //Combine all perilsname 
                this.ComputeDepreciativeAmount();
                    this.loading = true,
                    Swal.fire({
                    title: "Are you sure ?",
                    text: "Add New Quotation Option",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then(result => {
                        //  let GetRequestNo =  this.form.RequestNoPass  + ';;'  + this.form.Denomination + ';;'  + this.form.RequestNoOptionNo  ;
                        if (result.value) {
                            this.form.post("api/QuotationMotor" )
                            .then(() => {
                                Swal.fire(
                                    " Successfull....",
                                    "New Quotation Submitted",
                                    "success"
                                );
                                            
                                this.$router.push("/proposal-lists-customer");
                            })
                            .catch(() => {
                                Swal.fire(
                                    "Failed",
                                    "There was something wrong",
                                    "warning"
                                );
                            });
                        }else{
                            this.$router.push("/request-form-new");
                        }
                    })
                }
        },

    
        async LoadDenomination() {
            await axios.get("api/GetDenomination").then(({ data }) => (this.DataDenominations = data));
           
        },

        async LoadCarAmounts() {
            let res = await axios.get('api/CarAmounts')
            this.MarketValues = res.data
           // this.filterValues()
        },

        async LoadCarBrands() {
            await axios.get("api/GetCarBrands").then(({ data }) => (this.DataCarBrands = data));
           
        },

        async LoadCarBodyType() {
            await axios.get("api/GetCarBodyTypes").then(({ data }) => (this.DataCarBodyType = data));
           
        },

        async LoadSurcharges() {
            await axios.get("api/GetSurcharges").then(({ data }) => (this.DataSurcharges = data));
           
        },


        async LoadCoverages() {
            await axios.get("api/GetPerils").then(({ data }) => (this.DataCoverages= data));
           
        },

        // async LoadCities() {
        //     await axios.get("api/GetCities").then(({ data }) => (this.DataCities= data));
           
        // },

        async LoadProvinces() {
            await axios.get("api/GetProvinces").then(({ data }) => (this.DataProvinces= data));
           
        },
        LoadDataSurcharges(){            
            if ( this.ShowSurcharges === true){
                    this.ShowSurcharges =false
            }else{
                this.ShowSurcharges =true
                this.LoadSurcharges();
            }   
        // alert();
        },

        LoadDefaultDate() {                
            let dateCurrent = new Date();
            let dayCurrent  = dateCurrent.getDate();
            let monthCurrent  = dateCurrent.getMonth() + 1;
            let year = dateCurrent.getFullYear();

            let yearAdd = dateCurrent.getFullYear() + 1;
            let monthAdd  = dateCurrent.getMonth() + 1;
            let dayAdd  = dateCurrent.getDate()
            this.form.ExpiryDate      = `${monthAdd }/${dayAdd }/${yearAdd }`
            this.form.EffectiveDate  = `${monthCurrent}/${dayCurrent}/${year}`
        },
        setValue(value) {
            this.form.POAMount = value
            this.filter = false
            this.ComputeDepreciativeAmount();
        },

        setValueDenomination(value) {

            this.form.Denomination         = value.Class + ';;' + value.SubLinesName
            this.form.DenominationDis      = value.SubLinesName
            this.filterDen = false

        },

        setValueYear(yearDs) {
            this.form.YearPO = yearDs;
            this.filterYear = false;
            this.ComputeDepreciativeAmount();
        },

        ComputeDepreciativeAmount(){
            let POAmount = this.form.POAMount
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
            this.form.DepreciativeAmount       =  parseFloat(DepreciativeAmount,2);
            this.form.DepreciativeNumberYear   =  parseFloat(NumberYear,2);

        },  

  
        setValueCarBrands(DataCarBrandss) {
            this.form.CarBrand = DataCarBrandss.BrandName
            this.filterCarBrands = false

            let PassBrandName = this.form.CarBrand;
            axios.get("api/GetCarModels/"  +  PassBrandName) .then(({ data }) => (this.DataCarModelsList = data)  );
        },


        setValueCarModel(DataCarModelss) {
            this.form.CarModel = DataCarModelss.ModelName
            this.filterCarModels = false
        },

        setValueCarBodyType(DataCarBodyTypes) {
            this.form.BodyType = DataCarBodyTypes.BodyTypeName
            this.filterCarBodyType = false
        },

        //added by: Joleth
        //added date: 05/19/2020
        setValuePropertyProvince(DataProvincess) {
            this.form.ProvName = DataProvincess.ProvName
            this.filterPropertyProvince = false

            let PassBrandName = DataProvincess.ProvCode;
            axios.get("api/GetCities/"  +  PassBrandName) .then(({ data }) => (this.DataCities = data)  );
        },

        //updated by: Joleth
        //updated date: 05/19/2020
        setValuePropertyCity(DataCitiess) {
            this.form.CityName = DataCitiess.CityName
            this.filterPropertyCity = false

            let PassBrandName = DataCitiess.Code;
            axios.get("api/GetBarangays/"  +  PassBrandName) .then(({ data }) => (this.DataListBrgy = data)  );
        },

        setValueBarangay(DataListBrgys) {
            this.form.Barangay = DataListBrgys.BrgyName
            this.filterPropertyBrgy = false        
        },

        openForm() {
            document.getElementById("myForm").style.display = "block";
        },

        closeForm() {
            document.getElementById("myForm").style.display = "none";
        },
    },

    watch:{
        year(val) {
            this.$emit('year', val)        
        },

        effectiveDate(val) {
            let dateCurrent = new Date(val);
            let dayCurrent  = dateCurrent.getDate();
            let monthCurrent  = dateCurrent.getMonth() + 1;
            let yearOld = dateCurrent.getFullYear()

            let date = new Date(val)
            let year = date.getFullYear() + 1
            let month = date.getMonth() + 1
            let day = date.getDate()
            
            this.form.ExpiryDate      = `${month }/${day }/${year }`
            this.form.EffectiveDate  = `${monthCurrent}/${day}/${yearOld}`    
        },    

    },



    computed : {
    yearD () {
      const year = new Date().getFullYear()
      //return Array.from({length: year - 1900}, (value, index) => 1901 + index)
         // sortArrays(year) {
                let MinusYear = year - 10;
                return Array.from({length: year - MinusYear}, (value, index) => year - index)
         // }
    },
  
  },

    created() {
        
       

    }
}
</script>


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

.label-guide{
    color:#fff;
    background:#bfbfbf;
}

.label-guide-2{
    color:#fff;
    background:#a6a6a6;
}
</style>

