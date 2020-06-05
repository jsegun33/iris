<template>
<div id="MainPage"  >
      <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->

         <!-- <section   class="content DisabledSection" id="ContentSection"     >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >NO ACCESS... </big></h1>
                </div>
         </section> -->
    <section class="content DisabledSection ContentSection"     >
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

                        <!-- Updated By: Joleth -->
                        <!-- Updated Date: 06/05/2020 -->
                        <div class="col-sm-4" >
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Denomination:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select DENOMINATION">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="form.DenominationDis" @change="setValueDenomination($event)">                                                                    
                                    <option value='0' disabled>Select Denomination</option>
                                    <option v-for='value in DataDenominations' :key="value._id">{{ value.SubLinesName }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4" >                            
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Car Purchased Amount / Market Value:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select PURCHASED AMOUNT">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="form.POAMount" @change="setValue($event)">                                                                    
                                    <option value='0' disabled>Select Amount</option>
                                    <option v-for='value in MarketValues' :value="value.CarAmount" :key="value._id">{{ value.CarAmount | Peso}}</option>
                                </select>
                            </div>
                            <small class="label label-guide-2">Depreciation Amount : {{ form.DepreciativeAmount | Peso}}</small> 
                        </div>
                    </div>

                    <div class="form-group row">                         
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Year:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select PURCHASED YEAR">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="form.YearPO" @change="setValueYear($event)">                                                                    
                                    <option value='0' disabled>Select Year</option>
                                    <option v-for='yearDs in yearD' :value="yearDs" :key="yearDs">{{ yearDs }}</option>
                                </select>
                            </div>
                            <big class="label label-guide">Min. Year: {{ form.YearMinValue}} To Be Accepted, <br> otherwise call our telephone no. 8-243-0261 loc.139 or 213</big>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Brand:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select BRAND / MAKE">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddCarBrand" @change="setValueCarBrands($event)">                                                                    
                                    <option value='0' disabled>Select Brand / Make</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataCarBrandss in DataCarBrands' :value="DataCarBrandss.BrandName" :key="DataCarBrandss._id">{{ DataCarBrandss.BrandName }}</option>
                                </select>
                                <input v-show="OtherBrand" class="form-control" style="margin-top:5px;" v-model="txtOtherBrand" @change="setValueOtherBrand()">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Model:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select MODEL / SERIES">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddCarModel" @change="setValueCarModel($event)">                                                                    
                                    <option value='0' disabled>Select Model / Series</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataCarModelss in DataCarModelsList' :value="DataCarModelss.ModelName" :key="DataCarModelss._id">{{ DataCarModelss.ModelName }}</option>
                                </select>                                
                                <input v-show="OtherModel" class="form-control" style="margin-top:5px;" v-model="txtOtherModel" @change="setValueOtherModel()">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Body Type:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select BODY TYPE">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddBodyType" @change="setValueCarBodyType($event)">                                                                    
                                    <option value='0' disabled>Select Body Type</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataCarBodyTypes in DataCarBodyType' :value="DataCarBodyTypes.BodyTypeName" :key="DataCarBodyTypes">{{ DataCarBodyTypes.BodyTypeName }}</option>
                                </select>
                                <input v-show="OtherBodyType" class="form-control" style="margin-top:5px;" v-model="txtOtherBodyType" @change="setValueOtherBodyType()" @blur="setValueOtherBarangay()">
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
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
                         <div class="col-sm-3" v-if="ShowCommercial">
                            <label class="col-form-label"><big style="color:red"> * </big>Purposed Description:  </label>                            
                            <select class="form-control" v-model="form.PremiumTypeSave" required  >
                                <option value="" disabled selected > Pls.Select</option>
                                <option v-for="DataPremiumTypes in DataPremiumType.data" :value="DataPremiumTypes.Type + ';;'+ DataPremiumTypes.Description" :key="DataPremiumTypes._id" > {{ DataPremiumTypes.Description}}</option>
                                
                            </select>
                        </div> 
                        <div class="col-sm-3" v-if="ShowCommercial">
                            <label class="col-form-label">Net Weight:  </label>                            
                            <select class="form-control" v-model="form.MotorNetWeight"  >
                                <option value="" > Pls.Select</option>
                                <option value="Less than 3,930 kg"  > Less than 3,930 kg</option>
                                <option value="Over 3,930 kg"  >Over 3,930 kg</option>
                            </select>
                        </div>

                        <div class="col-sm-3" v-if="ShowCommercial">
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
                                        <input :id="peril._id" type="checkbox"  @mouseout="UnCheckAllPerils()" @click="FocusPushRecord(peril)" v-model="form.PerilsName[peril.PerilsNo]" v-bind:data-perils="peril.PerilsNo"/>
                                        <label id="peril" :for="peril._id" style="font-weight: 500;">{{ peril.PerilsName }}</label>
                                        <a data-toggle="tooltip" data-placement="right"  title="Pls. Select to ENABLE the other COVERAGES ">
                                            <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                        </a>             
                                    </div>                                        
                                </div>

                                <br/><br/>

                                <div @mouseover="UnCheckAllPerils()"  v-for="peril in DataCoverages" :key="peril._id"  style="float:right;width:55%; display: block" >
                                    <div class="form-group col-md-12" style="margin-bottom: 0;"  v-if="peril.DefaultSel !== 'YES'">
                                        <input  :id="peril._id" type="checkbox"  v-bind:disabled="PerilsCheckbox" @click="FocusPushRecordSub(peril)"   v-model="form.SubPerilsName[peril.PerilsNo]" :checked="SubPerilsName" v-bind:data-perils="peril.PerilsNo" />
                                        <label id="peril" :for="peril._id" style="font-weight: 500;">{{ peril.PerilsName }}</label>
                                        <a data-toggle="tooltip" data-placement="right"  title=" 4 PASSENGER /s is DEFAULT VALUE otherwise SPECIFY" v-if="peril.PerilsCode === 'PA'" >
                                                <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                        </a>  
                                        <input type="number" oninput="validity.valid||(value='');"  v-model="form.passengers"  v-bind:disabled="PerilsCheckbox"  v-if="peril.PerilsCode === 'PA'" class="form-control" placeholder="Enter number of PASSENGER">
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
                            <input type="text"  v-mask="'###-###-###-###'" oninput="validity.valid||(value='');" placeholder="###-###-###-###" class="form-control" v-model="form.TINNumber"/>
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
                            <input type="text" v-mask="'####-###-####'" placeholder="####-###-####"   oninput="validity.valid||(value='');"  class="form-control" v-model="form.ContactNumber" required/>
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
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Province:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select Province">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddProvince" @change="setValuePropertyProvince()">                                                                    
                                    <option value='0' disabled>Select Province</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataProvincess in DataProvinces' :value="{ id : DataProvincess.ProvCode, text : DataProvincess.ProvName }">{{ DataProvincess.ProvName }}</option>
                                </select>
                                <input v-show="OtherProvince" class="form-control" style="margin-top:5px;" v-model="txtOtherProvince" @change="setValueOtherProvince()">
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group row col-sm-12" >   

                        <div class="col-sm-6">                            
                            <div class="form-group">
                                <label><big style="color:red"> * </big>City:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select City">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddCity" @change="setValuePropertyCity()">                                                                    
                                    <option value='0' disabled>Select City</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataCitiess in DataCities' :value="{ id : DataCitiess.Code, text : DataCitiess.CityName }">{{ DataCitiess.CityName }}</option>
                                </select>
                                <input v-show="OtherCity" class="form-control" style="margin-top:5px;" v-model="txtOtherCity" @change="setValueOtherCity()">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><big style="color:red"> * </big>Barangay:</label>
                                <a data-toggle="tooltip" data-placement="right" title="Pls. Select Barangay">
                                    <big class="label label-guide"><i class="fa fa-info"></i> </big>
                                </a>
                                <select class='form-control' v-model="ddBarangay" @change="setValueBarangay($event)">                                                                    
                                    <option value='0' disabled>Select Barangay</option>
                                    <option value='Others'>Others</option>
                                    <option v-for='DataListBrgys in DataListBrgy' :value="DataListBrgys.BrgyName">{{ DataListBrgys.BrgyName }}</option>
                                </select>
                                <input v-show="OtherBarangay" class="form-control" style="margin-top:5px;" v-model="txtOtherBarangay" @change="setValueOtherBarangay()">
                            </div>                         
                        </div>
                    </div>                   
                </div>

                <div class="box-footer">                
                    <button  type="submit" class="btn btn-primary"  >Submit</button>
                </div>
            </form>

<!---------PREVIEW------------>
   <div>
    <!-- <button class="open-button" @click="openForm()">Preview</button> -->

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
                               <!-- <li v-for="n in form.PerilsName" :key="n._id">{{ n }} </li> -->
                               <!-- <li v-for="n in form.SubPerilsNameDis" :key="n._id">{{ n }} </li> -->
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


    </div>
	
</template>


<script>
import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import {mask} from 'vue-the-mask'

Vue.use(VueMaterial)

export default {
    directives: {mask},
     mounted() {
        console.log('Component mounted.')
         axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
        this.StartLoading()
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
            filterPropertyBrgy: false,
            disabledtext: true,
            PerilsCheckbox: true,
            year: '',

            ShowCommercial: false,
            ShowSurcharges: false,
            effectiveDate: '',

            DataPremiumType:{},
            UserDetails:{},
            checked:true,

            OtherBrand : false,
            OtherModel : false,
            OtherBodyType : false,
            OtherProvince : false,
            OtherCity : false,
            OtherBarangay : false,

            ddCarBrand : 0,
            ddCarModel : 0,
            ddBodyType : 0,
            ddProvince : 0,
            ddCity : 0,
            ddBarangay : 0,

            form: new Form({
                _id: '',
                PlateNumber: '',
                Denomination: '',
                POAMount: 0,
                YearPO: 0,
                CarBrand: '',
                CarModel: '',
                BodyType: '',
                usages: '',
                MotorNetWeight: '',
                MotorAccessories: '',
                SurchageList:[],
                EffectiveDate: '',
                ExpiryDate: '',
                department: '',
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
                IndividualPass: 'Individual',
                DepreciativeAmount:'',
                DepreciativeNumberYear:'',
                DenominationDis:0,
                CheckAll:'',
                YearMinValue:'',
                YearCurrentValue:'',
                PremiumTypeSave:'',               
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



       removeDuplicates(){
            let NamesDuplicate  = this.form.PerilsName;
            let dup = [...new Set(NamesDuplicate)];
            this.form.PerilsName =  dup;
           // alert();

        },


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

        //UPdated by: Joleth
        //Updated date: 05/06/2020 : DenominationOnly() Removed
        setValueDenomination(e){
            let DenDomination             =  e.target.value.trim();
            let SliptDen = DenDomination + "-none-not" ;
            let SliptDenArr = SliptDen.split('-');
             
            if (  SliptDenArr[1] === "none" && SliptDenArr[2] === "not" ){
                this.form.Denomination          = '2019-PC-0001;;' + DenDomination ;
            }else{
                this.form.Denomination          = '2019-PC-0001;;Car' ;
            }

            var valObj = this.DataDenominations.filter( function(elem){
                if(elem.SubLinesName == DenDomination) 
                    return elem;
            });

            this.vallobj = valObj[0];
            this.form.Denomination         = valObj[0].Class + ';;' + valObj[0].SubLinesName + ';;' + valObj[0].mvType + ';;' + valObj[0].mvPremType;
            this.form.DenominationDis      = valObj[0].SubLinesName;
        },

        LoadUserData(){
            this.RetrieveTimeInterval = setInterval(() => {
                    this.LoadDenomination(); this.LoadCarAmounts(); this.LoadCarBrands();this.LoadCarBodyType() ;this.LoadDefaultDate();
                    this.LoadCoverages();  this.LoadProvinces() ; this.LoadGetPremiumType()

                    this.form.TINNumber          = this.UserDetails.TINno;
                    this.form.first_name         = this.UserDetails.first_name;
                    this.form.last_name          = this.UserDetails.last_name;
                    this.form.middle_name        = this.UserDetails.user_mname;
                    this.form.EmailAddress       = this.UserDetails.email;
                    this.form.ContactNumber      = this.UserDetails.ContactNo;
                    this.form.CustAcctNo         = this.UserDetails.AccountNo;
                    this.form.AcctName           = this.UserDetails.CName;  
                    this.form.department         = this.UserDetails.department;    
            }, 500);    
                this.RetrieveTimeInterval2 = setInterval(() => {
                    clearInterval(this.RetrieveTimeInterval);
                     
            },3000);
        
        },


        ShowHideCom(){
            if (this.form.usages === 'Commercial Use'){
                   this.form.PremiumTypeSave='';
                    this.ShowCommercial=true;
            }else{
                    this.form.PremiumTypeSave ="1;;Private Cars (including jeeps and AUVs)";
                     this.ShowCommercial=false;
            }

        },
         FocusPushRecordSub(peril){
            let DataPerils = peril.PerilsNo;  //event.target.getAttribute('data-perils');
            let DataPerilsName = peril.PerilsName; 
           // alert(DataPerilsName);
           if (this.form.SubPerilsName[DataPerils] != false){
           // if ( !(this.form.SubPerilsName[DataPerils])){
               // this.form.SubPerilsName.push(DataPerils);
                this.form.SubPerilsNameDis.push(DataPerilsName);
                // this.PerilsCheckbox = false;
           }else{
               //alert(DataPerilsName);
              //  this.form.SubPerilsName.splice(DataPerils, 1);
                this.form.SubPerilsNameDis.splice(DataPerilsName, 1);
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
               //this.PerilsCheckbox = false;

            
            }else{
                this.form.PerilsName.splice(DataPerils, 1);
                if ( DataPerils === '2019-OD-0003'){
                    this.form.PerilsName.splice('2019-TF-0002');
                }
                this.form.PerilsNameDis.splice(DataPerils, 1);
                //this.PerilsCheckbox = true;
            
            }
            //this.form.PerilsName['5db90f2951e2334594006bf8'] = true; ///check the perils
          
         // this.removeDuplicates();        
        },


       

        UnCheckAllPerils(){
            for (let i = 0; i < this.DataCoverages.length; i++) {
                let DefualtSel =   this.DataCoverages[i].DefaultSel;
                let  IDNO; let IDYES;
                if (DefualtSel !=='YES'){
                    IDNO = this.DataCoverages[i].PerilsNo;
                    IDName       = this.DataCoverages[i].PerilsName;
                }
                //  if (DefualtSel ==='YES'){
                //     IDYES = this.DataCoverages[i].PerilsNo;
                   
                // }
                   
               //if ( this.form.PerilsName[IDYES] == false) {  ///if array is empty
               if (!this.form.PerilsName['2019-CT-0001'] && !this.form.PerilsName['2019-OD-0003'] ) {  ///if array is empty     
                       //  alert(this.form.PerilsName[IDYES] );
                            this.form.SubPerilsName[IDNO] = false;    //uncheck
                            this.form.CheckAll= false;  
                           // this.form.SubPerilsName[IDNO]
                            this.PerilsCheckbox = true;  
                      
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
            //this.FocusCheckAllPerils();
                for (let i = 0; i < this.DataCoverages.length; i++) {
                    let DefualtSel =   this.DataCoverages[i].DefaultSel;
                    let  IDNO;   let  IDName;  let DataPerils;
                    if (DefualtSel !=='YES'){   /// display on the perils that have YES
                        IDNO        = this.DataCoverages[i].PerilsNo;
                        IDName       = this.DataCoverages[i].PerilsName;
                        if(!(this.form.CheckAll)){    //if not empty
                            this.form.SubPerilsName[IDNO] = true; //check
                            //this.form.SubPerilsName.push(IDNO);     ////add into array
                            this.form.SubPerilsNameDis.push(IDName);
                        }else{
                            this.form.SubPerilsName[IDNO] = false;   //uncheck
                            //this.form.SubPerilsName.splice(IDNO);   ///clear array
                            this.form.SubPerilsNameDis.splice(IDName);
                        }
                    }  
                }                
        },

        GetOnlyCheckPerils(){
             for (let i = 0; i < this.DataCoverages.length; i++) {
                let  IDNO = this.DataCoverages[i].PerilsNo;
                if (this.form.SubPerilsName[IDNO] !== true){ //check
               
                }else{
                     this.form.PerilsName.push(IDNO);
                     
                     //GetOnlyCheckPerils
                }
             }
           //  this.form.SubPerilsNameDis.push(this.form.PerilsName);

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
         //alert(IDNO);
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
            }else  if ( parseFloat(this.form.POAMount,2) < 10000){
                  Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pls. Select/ Input Car Purchased Amount / Market Value >= 10,000' ,          
                })
            
            }else if (!this.form.POAMount || this.form.POAMount ===" ") {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls. Select Car Purchased Amount / Market Value.',          
                })
            }else if (!this.form.YearPO || this.form.YearPO ===" " || parseFloat(this.form.YearPO,2) < parseFloat(this.form.YearMinValue,2)) {
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
            }else if (this.form.ContactNumber.length > 13)  {
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
            }else if (this.form.PremiumTypeSave === " ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select your Purposed Description',          
                }) 
            
            }else{
                //this.CombineAllPerils();  //Combine all perilsname 
                this.GetOnlyCheckPerils();
                this.removeDuplicates();
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

         async LoadGetPremiumType() {
            await axios.get("api/GetPremiumType").then(({ data }) => (this.DataPremiumType = data));
           
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

        //updated by: Joleth
        //updated date: 06/05/2020
        setValue(e) {
            this.form.POAMount = e.target.value;
            this.ComputeDepreciativeAmount();
        },

        //updated by: Joleth
        //updated date: 06/05/2020
        setValueYear(e) {
            this.form.YearPO = e.target.value;
            this.ComputeDepreciativeAmount();
        },

        //updated by: Joleth
        //updated date: 06/05/2020
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

            this.form.DepreciativeAmount       =  parseFloat(DepreciativeAmount,2);
            this.form.DepreciativeNumberYear   =  parseFloat(NumberYear,2);
            
            if ( parseFloat(this.form.POAMount,2) < 10000){
                  Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pls. Select/ Input Car Purchased Amount / Market Value >= 10,000' ,          
                })
                this.form.POAMount = 10000;
            }

             if ( parseFloat(this.form.YearPO,2) < parseFloat(this.form.YearMinValue,2)  ||  parseFloat(this.form.YearPO,2) > parseFloat(this.form.YearCurrentValue,2) ){
                  Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pls. Select/ Input Year Model Between ' + this.form.YearMinValue  + " AND " + this.form.YearCurrentValue + " otherwise call our telephone no. 8-243-0261 loc.139 or 213" ,          
                })
                this.form.YearPO = this.form.YearMinValue;
            }
        },  
  
        //updated by: Joleth
        //updated date: 06/05/2020
        setValueCarBrands(e) {
            if(e.target.value === "Others")
            {
                this.OtherBrand = true;
                this.OtherModel = true;
                this.ddCarModel = "Others";
                this.txtOtherBrand = '';
                this.txtOtherModel = '';
            }
            else
            {
                this.OtherBrand = false;
                this.OtherModel = false;
                this.ddCarModel = "0";
                this.form.CarBrand = e.target.value;
                let PassBrandName = this.form.CarBrand;
                axios.get("api/GetCarModels/"  +  PassBrandName) .then(({ data }) => (this.DataCarModelsList = data)  );
            }
        },

        //Added by: Joleth
        //Added date: 06/05/2020
        setValueOtherBrand(){
            this.form.CarBrand = this.txtOtherBrand;
        },

        setValueOtherModel(){
            this.form.CarModel = this.txtOtherModel;
        },

        setValueOtherBodyType(){
            this.form.BodyType = this.txtOtherBodyType;
        },

        //updated by: Joleth
        //updated date: 06/05/2020
        setValueCarModel(e) {
            if(e.target.value === "Others")
            {   
                this.OtherModel = true;
                this.txtOtherModel = '';
            }
            else
            {
                this.OtherModel = false;
                this.form.CarModel = e.target.value;
            }
        },

        //updated by: Joleth
        //updated date: 06/05/2020
        setValueCarBodyType(e) {
             if(e.target.value === "Others")
            {
                this.OtherBodyType = true;
                this.txtOtherBodyType = '';
            }
            else
            {
                this.OtherBodyType = false;
                this.form.BodyType = e.target.value;
            }
        },

        //Updated by: Joleth
        //Updated date: 06/05/2020
        setValuePropertyProvince() {
            if(this.ddProvince === "Others")
            {
                this.OtherProvince = true;
                this.OtherCity = true;
                this.OtherBarangay = true;
                this.ddCity = "Others";
                this.ddBarangay = "Others";
                this.txtOtherProvince = '';
                this.txtOtherCity = '';
                this.txtOtherBarangay = '';
            }
            else
            {
                this.OtherProvince = false;
                this.OtherCity = false;
                this.OtherBarangay = false;
                this.ddCity = "0";
                this.ddBarangay = "0";
                this.form.ProvName = this.ddProvince.text;
                let PassProvCode = this.ddProvince.id;
                axios.get("api/GetCities/"  +  PassProvCode) .then(({ data }) => (this.DataCities = data)  );
            }
        },

        //updated by: Joleth
        //updated date: 05/19/2020
        setValuePropertyCity() {            
            if(this.ddCity === "Others")
            {
                this.OtherCity = true;
                this.OtherBarangay = true;
                this.ddBarangay = "Others";
                this.txtOtherCity = '';
                this.txtOtherBarangay = '';
            }
            else
            {
                this.OtherCity = false;
                this.OtherBarangay = false;
                this.ddBarangay = "0";
                this.form.CityName = this.ddCity.text;
                let PassCityCode = this.ddCity.id;
                axios.get("api/GetBarangays/"  +  PassCityCode) .then(({ data }) => (this.DataListBrgy = data)  );
            }
        },

        setValueBarangay(e) {
            if(this.ddBarangay === "Others")
            {
                this.OtherBarangay = true;
                this.ddBarangay = "Others";
                this.txtOtherBarangay = '';
            }
            else
            {
                this.OtherBarangay = false;
                this.form.Barangay = e.target.value;
            }
        },

        //Added by: Joleth
        //Added date: 06/05/2020
        setValueOtherProvince(){
            this.form.ProvName = this.txtOtherProvince;
        },

        setValueOtherCity(){
            this.form.CityName = this.txtOtherCity;
        },

        setValueOtherBarangay(){
            this.form.Barangay = this.txtOtherBarangay;
        },

        openForm() {
            document.getElementById("myForm").style.display = "block";
            this.GetOnlyCheckPerils();
            //this.removeDuplicates();
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
                this.form.YearMinValue      = parseFloat(MinusYear + 1);
                this.form.YearCurrentValue  = parseFloat(year );
                return Array.from({length: year - MinusYear}, (value, index) => year - index)
         // }
    },
  
  },

  
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

