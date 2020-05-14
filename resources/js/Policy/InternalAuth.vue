<template>
    <div>
        <!-- <section class="content-header">
            <h1>
                Quotations
                <small>List of Quotations Approved</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Quotation</li>
            </ol>
        </section> -->

        <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section>



        <section class="content" v-show="isShowingRecord">
                             <div v-if="selectedImage" max-width="100%" class="no-print">
                                            <!-- <img :src="selectedImage" alt="" width="100%" @click.stop="selectedImage = null"> -->
                                            <img :src="'OR-CR/' + form.UploadedORCR" alt="" width="100%" @click.stop="selectedImage = null">
                                            <hr>
                                        </div>

            <div class="invoice ">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <!-- <i class="fa fa-globe"></i> Issuance
                            <small class="pull-right">Date: {{ date }}</small> -->
                            <img src="/img/rsilogo.png" alt="Logo" style="height: 50px;">
                            <small class="pull-right">Date: {{ date }}</small>
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                        <table class="table" style="width:100%;font-size: 12px;">
                            <tr>
                            <td >Policy No.</td><th>:</th><th style="text-align:left">{{ form.QuotationNoDisplay}}</th>
                            </tr><tr>
                            <td>Assured </td><th>:</th>
                            <th style="text-align:left">
                                <small v-if="form.Individual !=='Others'">   {{ form.CName }} </small>
                                    <small v-else>   {{ form.RegisteredName}} </small> 
                           </th>
                            </tr><tr>
                            <td>Address </td><th>:</th><td style="text-align:left"> {{ form.Address }} <br/>  {{ form.Barangay }} {{ form.City }}</td>
                            </tr>
                        </table>

                    </div>
                    <!-- <div class="col-sm-1 invoice-col no-padding"></div> -->
                    <div class="col-sm-6 invoice-col no-padding pull-right">
                        <div class="col-sm-6 no-padding">
                              <table class="table"  style="width:100%;font-size: 12px;">
                                    <tr >
                                    <td style="text-align:left">Issue Date.</td><th>:</th><td style="text-align:left">{{ date | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:left">Term From </td><th>:</th><td style="text-align:left">{{ form.MotorEffectiveDate | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:left">Term To  </td><th>:</th><td style="text-align:left"> {{ form.MotorExpiryDate | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:left">COC No.  </td><th>:</th>
                                     <td>  {{ form.CocNoRequest}}</td>
                                    </tr><tr>
                                    <td style="text-align:left">Authentication Code.  
                                      
                                    </td><th>:</th> <td>   
                                        <button v-if="form.CocNoRequest !== null || form.AuthCodeRequest !== null" class="btn btn-xs btn-primary no-print" style="text-decoration: none;" @click="UpdateAuthentication()">
                                            <i class="fa fa-pencil"></i>
                                        </button>   {{ form.AuthCodeRequest}}  </td>
                                    </tr>
                                
                                </table>
                        </div>
                        
                    </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-md-12">
                        <table class="table" style="width:80%;font-size: 12px;">
                            <tr>
                            <td style="text-align:left;width:100px">Amount of Insurance : </td> <td colspan="2" style="text-align:left"> {{ form.InsuranceAmount | toWords  }} PESOS ONLY
                                    <br/> {{ form.InsuranceAmount |peso   }}
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>


            <!--------Perils Table----------------------------->

                <div class="row invoice-info" >
                    <div class="col-sm-4 invoice-col" style="width:25%">
                          <div class="row">
                            <label style="text-decoration: underline"
                                >Scheduled Vehicle :</label
                            >
                           
                            <div class="row" v-if="editMode">
                                <div class="col-md-2">
                                    <input v-model="form.MotorYear" type="text" class="form-control input-sm" readonly>
                                </div>
                                <div class="col-md-2" style="padding-left: 0px;">
                                    <input v-model="form.MotorBrand" type="text" class="form-control input-sm">
                                </div>
                                <div class="col-md-2" style="padding-left: 0px;">
                                    <input v-model="form.MotorModel" type="text" class="form-control input-sm">
                                </div>
                                <div class="col-md-2" style="padding-left: 0px;">
                                    <input v-model="form.MotorType" type="text" class="form-control input-sm">
                                </div>
                            </div>
                            <p v-else>
                                {{ form.MotorYear }} {{  form.MotorBrand }}
                                {{ form.MotorModel }} {{ form.MotorType }}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-8 no-padding">
                                 <table class="table" style="width:100%;font-size: 12px;"  >
                                     <tr>
                                        <th style="width:100px">Plate#:</th>
                                        <td  v-if="editMode" >  <input v-model="form.PlateNumber" type="text" class="form-control input-sm"></td>
                                        <td  v-else style="width:200px">{{ form.PlateNumber }}</td>
                                    </tr>

                                     <tr>
                                        <th>Serial No.:</th>
                                        <td  v-if="editMode">  <input v-model="form.ChassisNo" type="text" class="form-control input-sm"></td>
                                        <td  v-else>{{ form.ChassisNo }}</td>
                                    </tr>


                                     <tr>
                                        <th>Motor No.:</th>
                                        <td  v-if="editMode">  <input v-model="form.EngineNo" type="text" class="form-control input-sm"></td>
                                        <td  v-else>{{ form.EngineNo }}</td>
                                    </tr>

                                     <tr>
                                        <th>Color:</th>
                                        <td  v-if="editMode">  <input v-model="form.BodyColor" type="text" class="form-control input-sm"></td>
                                        <td  v-else>{{ form.BodyColor }}</td>
                                    </tr>

                                     <tr class="no-print">
                                         <th>OR /CR :</th>
                                        <td > 
                                            <img :src="'OR-CR/' + form.UploadedORCR" width="100px" @click="zoom()" v-if="form.UploadedORCR !== 'none'">
                                             <small v-if="form.UploadedORCR === 'none'">NO CR Uploaded  </small>
                                        
                                        </td>
                                       
                                    </tr>



                                    </table>
									
									 <br>
										<div class="row" v-if="editMode">
											<div class="col-md-8 no-padding">
												<button class="btn btn-success btn-sm pull-right" @click="UpdateScheduleVehicle()">Update</button>
												<button class="btn btn-danger btn-sm pull-right" @click="cancelUpdate" style="margin-right: 10px;">Cancel</button>
											</div>
										</div>
										
								  <label style="text-decoration: underline"  >Accessories Covered :</label >
						 <table class="table" style="width:100%;font-size: 12px;"  >
                                     <tr  v-for="Accessoriess in Accessories"  :key="Accessoriess._id">
                                        <th style="width:100px"> {{ Accessoriess.Name  }}</th>
                                    </tr>
						</table>
						
						
						 <label style="text-decoration: underline"
                                >Mortgagee :</label
                            >
                         
							
							
						 <table class="table" style="width:100%;font-size: 12px;"  >
                                     <tr v-if="!addBanks">
                                        <th style="width:100px">  {{ form.MortgageBankName +
                                        " - " +
                                        form.MortgageBankAddrs }}</th>
                                    </tr>
									<tr v-else >
										<td style="width:100%">   
											<select class="form-control" v-model="form.ListBankName" required >
												<option value="" selected disabled >List of Banks</option>
												<option    v-for="GetListBanksIssuances in GetListBanksIssuance" :key="GetListBanksIssuances._id"  :value="GetListBanksIssuances.BankName"  >{{ GetListBanksIssuances.BankName }}</option>
											</select><br/>
										 
											   <input v-model="form.ListBankNameAddress" type="text" class="form-control input-sm" placeholder="Bank Address">
										<br/>
											     <button  class="btn btn-primary btn-flat no-print"
											@click="loadBanksName(),ChangeBankDetails()">
											<i class="fa fa-plus" style="font-size: 18px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-flat no-print" @click="cancelBanksAdd">
                                        <i class="fa fa-times-circle-o" syle="font-size: 18px;"></i>
                                    </button>
										</td>
									</tr>
						</table>



                         <label style="text-decoration: underline"
                                >Clauses &amp; Warranties :</label
                            >
                          
							
							
						  <table class="table" style="width:100%;font-size: 12px;" >
                                     <tr  v-for="ClausesWarrantiess in ClausesWarranties"  :key="ClausesWarrantiess._id">
                                        <td>   {{ ClausesWarrantiess.ClausesName }}  </td>
                                          
                                    </tr>

                                    <tr v-if="addClauses">
                                        <td> <br/> 
                                          <select class="form-control" v-model="form.ClausessName" required >
                                            <option value="" selected disabled >Add Clausses &amp; Warranties</option>
                                            <option    v-for="GetListClausess in GetListClauses" :key="GetListClausess._id"  :value="GetListClausess._id + ';;' + form.RequestNo +  ';;' + form.AcceptedOption +  ';;' + form.MortgageBankName +  ';;' + form.MortgageBankAddrs"  >{{ GetListClausess.Name }}</option>
                                        </select>
                                        
                                        </td>
                                        
                                    </tr>
						</table>
						
						
						
                      
												
                            </div>
                        </div> <!-------ROW Scheduled Vehicle---------------------------->

                    </div>  <!-------close-col-sm-4---------------------------->
                    <!-- <div class="col-sm-1 invoice-col no-padding"></div> -->
                    <div class="col-md-8 invoice-col no-padding pull-left" style="width:75%">
                              <div class="col-xs-12 table-responsive" >
                            <table  style="width:100%;font-size: 12px;" >
                                <tbody>
                                    <tr >
                                        <th style="width:200px;"></th>
                                        <th style="width:650px;">
                                            PERILS
                                        </th>
                                        <th style="width:150x;text-align:center;">
                                            AMOUNT
                                        </th>
                                        <th style="text-align:right;width:150px;">
                                            PREMIUM <br />(INVOICE VALUE)
                                        </th>
                                    </tr>
                                    <tr
                                        v-for="GetNewGroups in GetNewGroup"
                                        :key="GetNewGroups._id"
                                    >
                                        <td  style="width:200px;"
                                            v-if="
                                                GetNewGroups.Section != 'OTHERS'
                                            "
                                        >
                                            {{
                                                "SECTION " +
                                                    GetNewGroups.Section
                                            }}
                                        </td>
                                        <td v-else  style="width:200px;"  >
                                            {{ GetNewGroups.Section }}
                                        </td>
                                        <td colspan="3"  style="width:650px;">
                                            <table >
                                                <tr
                                                    v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id"
                                                >
                                                    <td style="width:650px;"  v-if="coverage.PerilsCode != 'PA'">
                                                            
                                                            {{
                                                                coverage.PerilsName
                                                            }}
                                                      
                                                     </td> 
                                                      <td style="width:650px;"  v-if="coverage.PerilsCode == 'PA'">
                                                           
                                                            {{
                                                                coverage.PerilsName
                                                            }} 
                                                     </td>       
                                                             
                                                      
                                                  
                                                    <td
                                                        style="width:150px;text-align:right;" 
                                                    >
                                                        {{
                                                            coverage.ComputeCoveagesAmount
                                                                | peso
                                                        }}
                                                      
                                                    </td>

                                                    
                                                    <td
                                                        style="text-align:right;width:150px;"
                                                    >
                                                        {{
                                                            coverage.CoveragesPremium 
                                                                | peso
                                                        }}
                                                        
                                                    </td>
                                                </tr>

                                                   <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id"  >
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:600px;" colspan="2" class="CLassLeftIndent1">
                                                        {{ form.DisplayDescription1 }} 
                                                     </td> 
                                                </tr> 
                                                  <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:600px;" class="CLassLeftIndent1" >
                                                        {{ form.DisplayDescription2 }} 
                                                     </td> 
                                                </tr>    
                                                  <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:300px;" class="CLassLeftIndent2">
                                                        {{ form.DisplayDescription3 }}  {{ form.DisplayDescriptionVal3 }} 
                                                     </td> 
                                                     
                                                </tr>    
                                                  <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:300px;" class="CLassLeftIndent2" >
                                                        {{ form.DisplayDescription4 + " " + form.DisplayDescriptionVal4  }} 
                                                     </td> 
                                                    
                                                </tr>    
                                                  <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:600px;" class="CLassLeftIndent1">
                                                        {{ form.DisplayDescription5 }} 
                                                     </td>
                                                      
                                                </tr>    
                                                  <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    <td  v-if="coverage.PerilsCode == 'PA'" style="text-align:left;width:600px;" class="CLassLeftIndent1">
                                                        {{ form.DisplayDescription6 }} 
                                                     </td> 
                                                </tr>    

                                              
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>

                                        <td 
                                            style="border-top: 2px solid black;"
                                            class="pull-right"
                                        >
                                            {{ form.PremiumAmount | peso }}
                                         
                                                         
                                        </td>
                                    </tr>
                                    <tr> <th colspan="3"><br/></th></tr>

                                        <!-----------Charges----------------------->
                                     <tr  v-for="charges in ListCharges"   :key="charges._id">
                                        <td colspan="2"></td>
                                        <td  >{{ charges.ChargesName }}</td>
                                        <td class="pull-right"  >
                                            {{  charges.ChargesPremium | peso }}
                                        </td>
                                    </tr>
                                    <tr >
                                        
                                        <th colspan="3" style="text-align:right;" >TOTAL AMOUNT DUE</th>
                                        <th class="pull-right"  style="border-top: 2px solid black;">
                                            {{  form.AmountDue | peso }}
                                        </th>
                                    </tr>

                                      <tr> <th colspan="3"><br/></th></tr>
                                     <tr>
                                        <td colspan="3" style="text-align:right;" >Deductible : </td>
                                        <td class="pull-right" >
                                            {{  form.Deductible | peso }}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td colspan="3" style="text-align:right;" >Towing Limit : </td>
                                        <td class="pull-right" >
                                            {{  form.TowingLimit | peso }}
                                        </td>
                                    </tr>
                                     <tr>
                                        <td colspan="3" style="text-align:right;" >Auth Repair Limit : </td>
                                        <td class="pull-right" >
                                            {{  form.AuthRepairLimit | peso }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                           
                          </div><!----------Close for Table Perils-------->
                    
                        
                        
                        
                        
                    </div> <!------Close SM-8--------------->
                </div><!----Close main row Container------------------------->

               
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-md-6">
                            <label>Remarks: </label>
                           {{ form.IssuanceRemarks}}
                        </div>

                    </div>
					 <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-2 pull-right">
					
                          <img :src="'e-signature/' + form.PolicySignature" width="100px" v-if="form.RequestStatus == 'Approved' && form.PolicySignature != null" >
                         
                            <p style="border-top: 1px solid black;">
                                Authorized Signature 
                            </p> 
							
                          
                        </div>
                    </div>
                </div>
					
                    
                </div>
            </div>
            <!-------------------Policy Attach Docs.------ <pre>{{ $data}} </pre>------------------->
            <div class="invoice pagebreak" >
              
                <div class="row invoice-info" style="font-size: 12px;">
                    <div class="col-md-12 text-center">
                        <h4>
                            ATTACHED TO AND FORMING PART OF POLICY NUMBER
                           {{ form.QuotationNoDisplay}}
                        </h4>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" >
                                <label style="text-decoration: underline"
                                    >Clauses &amp; Warranties :</label
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>

                <div
                    class="row"   v-for="ClausesWarrantiess in ClausesWarranties"    :key="ClausesWarrantiess._id"
                >
                    <div class="col-md-12">
                        <table style="width:100%">
                            <tr v-if="ClausesWarrantiess.ClausesNo !='2020-0012'">
                                <td  >
                                      <p style="text-transform: uppercase;text-align:center">  {{ ClausesWarrantiess.ClausesName }}  </p> 
                                      <p style="text-align:justify"> {{  ClausesWarrantiess.ClausesStatement }} </p> 
                                </td>
                            </tr><tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA === 'PA'">
                                       
                                <td >
                                      <p style="text-transform: uppercase;text-align:center">  {{ form.PATitleClauses }}  </p> 
                                      <p style="text-align:justify"> {{ form.DisplayStatementClauses }} </p> 
                                </td>
                            </tr>
                            <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <input type="hidden" v-model="form.ClausesStatementPA">
                                 <td > <p style="text-transform: uppercase;text-align:center">  {{ form.PATitleClauses1 }}  </p> </td>
                            </tr>
                            
                            <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD1}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal1}}  </td>
                            </tr>
                            <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD2}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal2}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD3}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal3}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD4}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal4}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD5}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal5}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD6}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal6}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD7}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal7}}  </td>
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td style="text-align:justify;width:80%">{{  form.DisplayStatementClausesTD8}}  </td>
                                 <td  style="text-align:left"> {{  form.DisplayStatementClausesTDVal8}}  </td>
                            </tr>
                            <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD10 }}  </td>
                               
                            </tr>
                             <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD9 }}  </td>
                               
                            </tr>
                             
                              <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD11}}  </td>
                               
                            </tr>
                              <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD12}}  </td>
                               
                            </tr>
                              <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD13}}  </td>
                               
                            </tr>
                              <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD14}}  </td>
                               
                            </tr>
                              <tr  v-if="ClausesWarrantiess.ClausesNo === '2020-0012' && form.FormTitleforPA1 === 'Coverage'">
                                 <td class="CLassLeftIndent" colspan="2">{{  form.DisplayStatementClausesTD15}}  </td>
                               
                            </tr>

                            
                        </table>

                   
                       
                </div>
                </div>

                <div class="row no-print" v-if="form.RequestStatus == 'Approved' && form.CocNoRequest == 0">
                    <div class="col-xs-12">
                      
                     <button v-if="form.OnlyCTPL === 1 && form.PaymentMode !== '0'  && UserDetails.department ==='UW' || UserDetails.department ==='IT'" @click="PassAuthentication()"
                            type="button"
                            class="btn btn-info pull-right"  
                            >
                            <i class="fa  fa-send"></i>
                            Internal Authentication
                        </button>

                       
                      
						
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted: function() {
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
        let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
       // axios.get("api/GetListClauses/" + PassID) .then(({ data }) => (this.GetListClauses = data)  );
        //axios.get("api/GetListSignatory/") .then(({ data }) => (this.GetListSignatory = data)  );
         axios.get("api/GetCOCNo") .then(({ data }) => (this.GetCOCNo = data)  ); 
        axios.get("api/URLQueryRequestModify/" + PassID).then(({ data })  => (this.ResultQueryRequest = data)  );
        this.StartLoading();
    },

    data() {
        return {
            addClauses: false,
            addBanks: false,
            editMode: false,
            ResultQueryRequest: {},
            URLQueryPerilsCoveragesGroup: {},
            GetNewGroup: {},
            ListCoverages: {},
            ListCharges: {},
            GetCOCNo: {},
            ClausesWarranties: {},
            Accessories: {},
           // GetListSignatory: {},
            GetListClauses: {},
            Sections: {},
             UserDetails:{},
             GetListBanksIssuance:{},
			 ListClausesWarranties:{},
            SumUpCoveragesAmount: 0,
             selectedImage: null,

                IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:47,
                 timer_is_on:0,



            form: new Form({
                TINNumber: "",
                EmailAddress: "",
                ContactNumber: "",
                FirstName: "",
                MiddleName: "",
                LastName: "",
                Address: "",
                Barangay: "",
                City: "",
                Denomination: "",
                RatePercent: "",
                Surcharge: "",
                CoverageAmount: "",
                TypeClass: "",
                MotorYear: "",
                MotorBrand: "",
                MotorModel: "",
                MotorType: "",
                PlateNumber: "",
                ChassisNo: "",
                EngineNo: "",
                BodyColor: "",
                MortgageBankName: "",
                MortgageBankAddrs: "",
                SelectCoverageAmounts: [],
                ProductLine: "",
                SelectPremiumAmount: [],
                TxtSelectAmount: "",
                SelectTotalPremium: [],
                OptionNo: [],
                CoveragesNameDisplay: [],
                CoveragesAmountDisplay: [],
                CoveragesPremiumDisplay: [],
                TotalAmountDue: [],
                AcceptQuotationPassData: [],
                AcceptedQuotation: [],
                TxtCoverageAmount: [],
                RemarksCustomer: [],
                RemarksApprover: [],
                RemarksReviewee: [],
                RemarksApproverDate: [],
                RemarksCustomerDate: [],
                ListApproverDisplayUW: [],
                ListApprover: [],
                MotorEffectiveDate: "",
                MotorExpiryDate: "",
                PremiumAmount: "",
				ClausessName: '',
				RequestNo: '',
                AcceptedOption: '',
                DisplayDescription1: '',
                DisplayDescription2: '',
                DisplayDescription3: '',
                DisplayDescriptionVal3: '',
                DisplayDescription4: '',
                DisplayDescriptionVal4: '',
                DisplayDescription5: '',
                DisplayDescription6: '',
                Description: '',
                PassengerNo: '',
                Remarks: '',
                RemarksSignature: '',
                 QuotationNoDisplay: '',
                 SignatureName: '',
                 ListBankName: '',
                 ListBankNameAddress: '',
                 IssuanceRemarks: '',
                 DisplayStatementClauses:'',
                 DisplayStatementClauses1:'',
				 ClausesStatementPA:[],
				 ClausesStatementAmount:[],
                 CoverageDescPA:[],
                 PATitleClauses: '',
                 PATitleClauses1: '',
                 FormTitleforPA: '',
                 FormTitleforPA1: '',
                 Renewal: '',
                 InsuranceAmount: '',
                 OptionWithAOG: '',
                 DisplayStatementClausesTD1: '',
                 DisplayStatementClausesTDVal1: '',
                  DisplayStatementClausesTD2: '',
                 DisplayStatementClausesTDVal2: '',
                  DisplayStatementClausesTD3: '',
                 DisplayStatementClausesTDVal3: '',
                  DisplayStatementClausesTD4: '',
                 DisplayStatementClausesTDVal4: '',
                  DisplayStatementClausesTD5: '',
                 DisplayStatementClausesTDVal5: '',
                  DisplayStatementClausesTD6: '',
                 DisplayStatementClausesTDVal6: '',
                  DisplayStatementClausesTD7: '',
                 DisplayStatementClausesTDVal7: '',
                  DisplayStatementClausesTD8: '',
                 DisplayStatementClausesTDVal8: '',
                 DisplayStatementClausesTD9: '',
                 DisplayStatementClausesTD10: '',
                DisplayStatementClausesTD11: '',
                DisplayStatementClausesTD12: '',
                DisplayStatementClausesTD13: '',
                DisplayStatementClausesTD14: '',
                DisplayStatementClausesTD15: '',
				   UploadSign: '',
                 UploadedORCR: '',
                 PolicySignature: '',
                 RequestStatus: '',
               
                 COCNo: '',
                 OnlyCTPL: '',
                 GetCOCNo: '',
                 GetAuthNo: '',
                 Deductible: '',
                 TowingLimit: '',
                 AuthRepairLimit: '',
                 PaymentMode: '',
                 

            })
        };
    },

    methods: {
            LoadingDesign(){
                        this.IntervalLoading  = this.clock;
                        this.clock = this.IntervalLoading - 1;
                        this.timer = setTimeout(this.LoadingDesign, 1000/60);
            },
            StartLoading() {
 
                  if (!this.timer_is_on) {
                      this.timer_is_on = 1;
                      this.LoadingDesign();
                  }
                    
              
            },


          zoom(url) {
      console.log("Zoom", url);
     //this.selectedImage = url;
     this.selectedImage = this.form.UploadedORCR;
    },

      async UpdateAuthentication() {
            const { value: text } = await Swal.fire({
                title: 'Are you sure?',
                text: "Input Authentication Code",
                icon: 'info',
                input: 'text',
                inputPlaceholder: 'Type Authentication Code...',
                inputAttributes: {
                    'aria-label': 'Authentication Code'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(result => {
                // console.log(result);
                this.form.AuthCode = result.value
               // this.loadData()

                let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.form.AuthCode;
                if (this.form.AuthCode === '' || this.form.AuthCode) {
                   
                    axios.get("api/UpdateAuthentication/" + GetRequestNo )
                            .then(() => {
                                Swal.fire(
                                    "Request for Modification!",
                                    "Request has been Submitted.",
                                    "success"
                                );
                                // Success
                                this.loadData();
                                //alert(_id);
                                //this.addClauses = false
                            })
                }
                

            }).catch(() => {
               
                Swal.fire(
                    "Failed",
                    "There was something wrong",
                    "warning"
                );
            })
        },


PassAuthentication(){
           Swal.fire({
                title: "Are you sure?",
                text: "Updated Scheduled Vehicle",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                          
                
                
                let COCNO ;  ///gen COCNo
             if ( this.GetCOCNo[0].CocNoSeqNo ==="0"){
                   let GenCOCNO = parseFloat(this.GetCOCNo[0].CocNo) + 1;  ///gen COCNo
                    COCNO    = "0" +  GenCOCNO;
             }else{
                   COCNO =  "086000001";  ///gen COCNo
             } 
             
           
                  
                let AssuredName = this.form.FirstName + " "  + this.form.MiddleName + " "  + this.form.LastName ;
              
                let TinNOA  ;
                 
                if (this.form.TINNumber != null){
                    
                   TinNOA     = this.form.TINNumber.split('-');
                 
                }else{
                    this.form.TINNumber =  "999-999-999-999";
                   TinNOA     = this.form.TINNumber.split('-');
                }
               let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.form.PlateNumber + ';;'  + COCNO + ';;'  + AssuredName;
                 
				let PassData = "TinNOD=" + TinNOA[3] + "&TinNOC=" + TinNOA[2] + "&TinNOB=" + TinNOA[1] + "&TinNOA=" + TinNOA[0]  + "&MotorExpiryDate=" + this.MotorExpiryDateDisplay + "&MotorEffectiveDate=" + this.MotorEffectiveDateDisplay  + "&AssuredName=" + AssuredName +   "&COCNo=" + COCNO +  "&ChassisNo=" +this.form.ChassisNo + "&EngineNo=" + this.form.EngineNo + "&PlateNumber=" + this.form.PlateNumber   + "&MvFileNo=" + this.form.MvFileNo;

                if (result.value) {
				
				
                    axios.get("api/SaveAuthentication/" + GetRequestNo)
                        .then(() => {
                            Swal.fire(
                                "Scheduled Vehicle!",
                                "Your file has been Updated.",
                                "success"
                            );
                             this.loadData();
                          	
                              let route = this.$router.resolve({path: 'api/ISAPInternalAuth?' + PassData});
                               window.open(route.href, '_blank');
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was Something wrong",
                                "warning"
                            );
							  //let route = this.$router.resolve({path: 'api/ISAPInternalAuth?' + PassData});
                               //window.open(route.href, '_blank');
                        });
                }
            });
	
	
	},



        async textRemark() {
            const { value: text } = await Swal.fire({
                title: 'Are you sure?',
                text: "Leave a remark",
                icon: 'info',
                input: 'textarea',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
            }).then(result => {
                // console.log(result);
                this.form.Remarks = result.value
                this.loadData()

                let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.UserDetails.AccountNo + ';;' + this.UserDetails.CName  + ';;' + this.ListCoverages[0].OptionNo  + ";;" + this.form.Remarks;
                if (this.form.Remarks === '' || this.form.Remarks) {
                    axios.get("api/EditAmountPolicyMktg/" + GetRequestNo )
                            .then(() => {
                                Swal.fire(
                                    "Request for Modification!",
                                    "Request has been Submitted.",
                                    "success"
                                );
                                // Success
                                this.loadData();
                                //alert(_id);
                                //this.addClauses = false
                            })
                }
                

            }).catch(() => {
               
                Swal.fire(
                    "Failed",
                    "There was something wrong",
                    "warning"
                );
            })
        },
    
         async SubmitForSignature() {
            const { value: text } = await Swal.fire({
                title: 'Are you sure?',
                text: "Leave a remark",
                icon: 'info',
                input: 'textarea',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
            }).then(result => {
                // console.log(result);
                this.form.RemarksSignature = result.value
                this.loadData()

                let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.UserDetails.AccountNo + ';;' + this.UserDetails.CName  + ';;' + this.ListCoverages[0].OptionNo  + ";;" + this.form.Remarks + ";;" + this.form.IssuanceRemarks + ";;" + this.form.SignatureName;
                if (this.form.RemarksSignature === '' || this.form.RemarksSignature) {
                    axios.get("api/SubmitForSignature/" + GetRequestNo )
                            .then(() => {
                                Swal.fire(
                                    "Request for Signature!",
                                    "Request has been Submitted.",
                                    "success"
                                );
                                // Success
                                this.loadData();
                                //alert(_id);
                                //this.addClauses = false
                            })
                }
                

            }).catch(() => {
               
                Swal.fire(
                    "Failed",
                    "There was something wrong",
                    "warning"
                );
            })
        },

        cancelUpdate() {
            this.loadData()
            this.editMode = false
        },


        UpdateScheduleVehicle() {
            let uri = window.location.href.split("?");
            let PassID = uri[1].trim() + ';;' + this.form.PlateNumber + ';;' + this.form.ChassisNo + ';;' + this.form.EngineNo + ';;' + this.form.BodyColor + ';;' + this.form.MotorBrand + ';;' + this.form.MotorModel + ';;' + this.form.MotorType;
           

           Swal.fire({
                title: "Are you sure?",
                text: "Updated Scheduled Vehicle",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					//alert(GetClausessName);
                    axios.get("api/UpdateScheduleVehicle/" + PassID )
                        .then(() => {
                            Swal.fire(
                                "Scheduled Vehicle!",
                                "Your file has been Updated.",
                                "success"
                            );
                            // Success
                            this.loadData();
                           /// alert(PassID);
                            this.addClauses = false
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was Something wrong",
                                "warning"
                            );
                        });
                }
            });

        },

        cancelClauses() {
            this.form.ClausessName = ''
            this.addClauses = false
        },

	  cancelBanksAdd() {
            this.form.ListBankName = ''
            this.addBanks = false
        },
	  SplitDescription(){ 
		// let Desc = "1 Driver & 4 Passenger/s.Coverage of each declared helper/passenger/s.(1) Accidental Death & Disablement.(2) Medical Indemnity.Disablement will abide by Schedule stated on page two(2)";
                 let Desc           =  this.form.CoverageDescPA.trim();
                let SplitData       = Desc.split('.');
                let NoPassengers    = parseFloat(this.form.PassengerNo) + 1 ;
                let Split2Compute   = parseFloat(this.form.ClausesStatementAmount)  / parseFloat(NoPassengers) ;
                let Split3Compute   = (parseFloat(this.form.ClausesStatementAmount)  / parseFloat(NoPassengers)  * 0.10 );
                //this.form.DisplayDescription = SplitData[0] + '\n'  + SplitData[1] + '\n'  + SplitData[2] + '    \xa0' + parseFloat(Split2Compute).toFixed(2)  + '@'  + '\n'  + SplitData[3] + '\t \t \t\t\xa0' + parseFloat(Split3Compute).toFixed(2)  + '@'  + '\n'  + SplitData[4]  + '\n'  + SplitData[5];
                this.form.DisplayDescription1 = SplitData[0] ;
                this.form.DisplayDescription2 = SplitData[1] ;
                this.form.DisplayDescription3 = SplitData[2] ;
                this.form.DisplayDescriptionVal3 = parseFloat(Split2Compute).toFixed(2)  + '@' ;
                this.form.DisplayDescription4 = SplitData[3] ;
                this.form.DisplayDescriptionVal4 = parseFloat(Split3Compute).toFixed(2)  + '@' ;
                this.form.DisplayDescription5 = SplitData[4] ;
                this.form.DisplayDescription6 = SplitData[5] ;
               // + '\n'  + SplitData[1] + '\n'  + SplitData[2] + '    \xa0' + parseFloat(Split2Compute).toFixed(2)  + '@'  + '\n'  + SplitData[3] + '\t \t \t\t\xa0' + parseFloat(Split3Compute).toFixed(2)  + '@'  + '\n'  + SplitData[4]  + '\n'  + SplitData[5];
       
        },
		
		 SplitStatementClauses(){ 
		          let PremiumAmount = this.form.PremiumAmount;
		           let Desc            = this.form.ClausesStatementPA;
				   let SplitData       = Desc.split('.');
				//alert(PremiumAmount);
                let NoPassengers    = parseFloat(this.form.PassengerNo) + 1 ;
				 // alert(NoPassengers);
               let SplitCompute1   = parseFloat(this.form.ClausesStatementAmount)  / parseFloat(NoPassengers) ;
               let SplitCompute5to6   = parseFloat(SplitCompute1)  / 2 ;
               let SplitCompute7   = parseFloat(SplitCompute1) * 0.12 ;
               let SplitCompute8   = parseFloat(SplitCompute1) * 0.10 ;

                
                let NewDisplay8b ;
               let Display1to4  =   SplitData[3]  + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@ \n' 
                                    + SplitData[4]  + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@ \n' 
                                    + SplitData[5] + '\t \t \t \t \t \t \t \t \t' + 'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@ \n' 
                                    + SplitData[6] + '\t' + 'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@ ';
               let Display5to6  =   SplitData[7]  + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' +  parseFloat(SplitCompute5to6).toFixed(2)  +  '@ \n' 
                                    +  SplitData[8] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t' + 'Ps ' +  parseFloat(SplitCompute5to6).toFixed(2) + "@";
			   let Display7     =   SplitData[9]  + '\t \t \t \t \t \xa0' + 'Ps ' +  parseFloat(SplitCompute7).toFixed(2) + "@";
               let Display8     =   SplitData[10] + '\t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \t \xa0' + 'Ps ' +  parseFloat(SplitCompute8).toFixed(2) + "@ \n";
			   let Display8a    =   SplitData[11] ;
               let Display8b    =   SplitData[12] ;
               let Display8c    =   SplitData[13] ;
               let Display8d    =   SplitData[14] ;
               let Display8e    =   SplitData[15] ;
               let Display8f    =   SplitData[16] ;
               let Display8g    =   SplitData[17] ;
               
              // this.form.PATitleClauses   = SplitData[0].toUpperCase()  ;
              // this.form.PATitleClauses1  =  SplitData[2].toUpperCase();

                let n = Display8b.includes("50,000");

                if (n !== false){
                   
                     NewDisplay8b      = Display8b.replace("50,000",SplitCompute1);
                   
                }else{
                     NewDisplay8b      =  Display8b;
                }
                       			   // let Split3Compute   = (parseFloat(coverage.CoveragesAmount)  / parseFloat(NoPassengers)  * 0.10 );
              //  this.form.DisplayStatementClauses       =   SplitData[1]  ;
               // this.form.DisplayStatementClauses1      =   Display1to4  + '\n' + Display5to6  + '\n' +   Display7 + '\n' +  Display8  + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' +  Display8d + '\n' +  Display8e + '\n' +  Display8f + '\n' +  Display8g;
              
                    let Title = SplitData[0].includes("PA");
                    let Title1 = SplitData[2].includes("Coverage");
                     if (Title !== false){
                          this.form.FormTitleforPA="PA";
                           
                     }if (Title1 !== false){
                            this.form.FormTitleforPA1="Coverage";
                     }



                  this.form.PATitleClauses                 = SplitData[0].toUpperCase()  ;
                  this.form.DisplayStatementClauses       =   SplitData[1] + '\n'  ;
                    
             
                  this.form.PATitleClauses1              = SplitData[2].toUpperCase()  ;
                 // this.form.DisplayStatementClauses1     =   Display1to4  + '\n' + Display5to6  + '\n' +   Display7 + '\n' +  Display8  + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' +  Display8d + '\n' +  Display8e + '\n' +  Display8f + '\n' +  Display8g;
                 // this.form.DisplayStatementClauses1     =   "<td>" + Display1to4  + '\n' + Display5to6 + "</td>" + '\n' +   Display7 + '\n' +  Display8  + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' +  Display8d + '\n' +  Display8e + '\n' +  Display8f + '\n' +  Display8g;
          
                     this.form.DisplayStatementClausesTD1        =   SplitData[3]  + ".";
                     this.form.DisplayStatementClausesTDVal1     =   'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD2        =   SplitData[4]  + "." ;
                     this.form.DisplayStatementClausesTDVal2     =   'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD3        =   SplitData[5]  + "." ;
                     this.form.DisplayStatementClausesTDVal3     =   'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD4         =   SplitData[6]  + "." ;
                     this.form.DisplayStatementClausesTDVal4     =   'Ps ' +  parseFloat(SplitCompute1).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD5         =   SplitData[7] + "." ;
                     this.form.DisplayStatementClausesTDVal5     =   'Ps ' +  parseFloat(SplitCompute5to6).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD6         =   SplitData[8] + "." ;
                     this.form.DisplayStatementClausesTDVal6     =   'Ps ' +  parseFloat(SplitCompute5to6).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD7        =   SplitData[9]  + "." ;
                     this.form.DisplayStatementClausesTDVal7     =   'Ps ' +  parseFloat(SplitCompute7).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD8        =   SplitData[10]  + "." ;
                     this.form.DisplayStatementClausesTDVal8    =   'Ps ' +  parseFloat(SplitCompute8).toFixed(2)  +  '@' ;
                     this.form.DisplayStatementClausesTD9        =    NewDisplay8b  + ".";
                     this.form.DisplayStatementClausesTD10        =  SplitData[11]   ;
                     this.form.DisplayStatementClausesTD11        = SplitData[13]   + "." ;
                     this.form.DisplayStatementClausesTD12       =  SplitData[14]  + "."  ;
                     this.form.DisplayStatementClausesTD13       = SplitData[15]  + "."  ;
                     this.form.DisplayStatementClausesTD14       = SplitData[16]   + "." ;
                     this.form.DisplayStatementClausesTD15       =  SplitData[17]   + "." ;
                    

            
                 
       
       },
        

        EditAmountPolicyMktg()
	{
            let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.UserDetails.AccountNo + ';;' + this.UserDetails.CName  + ';;' + this.ListCoverages[0].OptionNo ;
         // alert(GetRequestNo);
			Swal.fire({
                title: "Amount Modification",
                text: "Return to Assigned Personnel...",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					//alert(GetClausessName);
                    axios.get("api/EditAmountPolicyMktg/" + GetRequestNo )
                        .then(() => {
                            Swal.fire(
                                "Request for Modification!",
                                "Request has been Submitted.",
                                "success"
                            );
                            // Success
                            this.loadData();
                            //alert(_id);
                            //this.addClauses = false
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
            });
			
			
	},

    ChangeBankDetails()
	{
			
               let uri     = window.location.href.split("?");
               let PassID  = uri[1].trim() +  ";;"  + this.form.ListBankName.trim() +  ";;" +  this.form.ListBankNameAddress ;
			//alert(PassID);
			Swal.fire({
                title: "Are you sure?",
                text: "Changing Mortgagee Bank...",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					//alert(GetClausessName);
                    axios.get("api/ChangeBankDetails/" + PassID )
                        .then(() => {
                            Swal.fire(
                                "Updated Mortgagee Bank",
                                "Your file has been Added.",
                                "success"
                            );
                            // Success
                            this.loadData();
                            //alert(_id);
                            this.addBanks = false
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
            });
			
			
	},

	
	AddClausesWarrantiesToPolicy()
	{
              let uri     = window.location.href.split("?");
          
            let GetClausessName =this.form.ClausessName.trim() +  ";;"  + uri[1].trim() ;
			//alert(GetClausessName);
			Swal.fire({
                title: "Are you sure?",
                text: "Adding Clauses & Warranties...",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					//alert(GetClausessName);
                    axios.get("api/AddClausesWarrantiesToPolicy/" + GetClausessName )
                        .then(() => {
                            Swal.fire(
                                "New Clauses & Warranties!",
                                "Your file has been Added.",
                                "success"
                            );
                            // Success
                            this.loadData();
                            //alert(_id);
                            this.addClauses = false
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
            });
			
			
	},
        deleteClause(_id) {
            console.log(_id);
            
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					
                    axios.put("api/DeleteRequestClauses/" + _id)
                        .then(() => {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            // Success
                            this.loadData();
							//alert(_id);
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
            });
        },

       loadClauses() { 
            let uri = window.location.href.split("?");
             
            let PassID = uri[1].trim() + ";;" +  this.form.AcceptedOption;
           //alert(PassID);
                 axios.get("api/GetListClauses/" + PassID) .then(({ data }) => (this.GetListClauses = data)  );
         },

          loadBanksName() { 
                 let uri = window.location.href.split("?");
                 let PassID = uri[1].trim();
                 axios.get("api/GetListBanksIssuance/" + PassID) .then(({ data }) => (this.GetListBanksIssuance = data)  );
         },

         loadData() {
          this.RetrieveTimeInterval = setInterval(() => {
                                clearTimeout(this.timer);   //clear timer /loading
                                this.timer_is_on = 0; //clear timer /loading
                                this.isShowingLoading = false; //clear timer /loading
                                this.isShowingRecord = true; 

                    this.form.CustAcctNO                 = this.ResultQueryRequest.CustAcctNO;
				    this.form.RequestNo                 = this.ResultQueryRequest.RequestNo;
					this.form.AcceptedOption 	        = this.ResultQueryRequest.AcceptedOption;
                    this.form.TINNumber 		        = this.ResultQueryRequest.TINNumber;
                    this.form.EmailAddress              = this.ResultQueryRequest.EmailAddress;
                    this.form.MotorBrand                = this.ResultQueryRequest.MotorBrand;
                    this.form.ContactNumber             = this.ResultQueryRequest.ContactNumber;
                    this.form.FirstName                 = this.ResultQueryRequest.FirstName;
                    this.form.MiddleName                = this.ResultQueryRequest.MiddleName;
                    this.form.LastName                  = this.ResultQueryRequest.LastName;
                    this.form.Address                   = this.ResultQueryRequest.Address;
                    this.form.Barangay                  = this.ResultQueryRequest.Barangay;
                    this.form.City                      = this.ResultQueryRequest.City;
                    this.form.Denomination              = this.ResultQueryRequest.Denomination;
                    this.form.TypeClass                 = this.ResultQueryRequest.MotorBodyType;
                    this.form.MotorYear                 = this.ResultQueryRequest.MotorYear;
                    this.form.MotorBrand                = this.ResultQueryRequest.MotorBrand;
                    this.form.CoverageAmount            = this.ResultQueryRequest.MotorPOAmount;
                    this.form.RatePercent               = this.ResultQueryRequest.RatePercent;
                    this.form.MotorModel                = this.ResultQueryRequest.MotorModel;
                    this.form.MotorType                 = this.ResultQueryRequest.MotorBodyType;
                    this.form.TxtPremiumAmount          = this.ResultQueryRequest.PremiumAmount;
                    this.form.AmountDue                 = this.ResultQueryRequest.AmountDue;
                    this.form.ProductLine               = this.ResultQueryRequest.ProductLine;
                   // this.form.Deductable                = detail.Deductable;
                    this.form.PlateNumber               = this.ResultQueryRequest.PlateNumber;
                    this.form.ChassisNo                 = this.ResultQueryRequest.ChassisNo;
                    this.form.EngineNo                  = this.ResultQueryRequest.EngineNo;
                    this.form.BodyColor                 = this.ResultQueryRequest.BodyColor;
                    this.form.MortgageBankName          = this.ResultQueryRequest.MortgageBankName;
                    this.form.MortgageBankAddrs         = this.ResultQueryRequest.MortgageBankAddress;

                    this.form.MotorEffectiveDate        = this.ResultQueryRequest.MotorEffectiveDate;
                    this.form.MotorExpiryDate           =this.ResultQueryRequest.MotorExpiryDate;
                    this.form.PremiumAmount             = this.ResultQueryRequest.PremiumAmount;
                    this.form.PassengerNo               =this.ResultQueryRequest.Passengers;
                    this.form.Renewal                   = this.ResultQueryRequest.Renewal;
                    this.form.PaymentMode              = this.ResultQueryRequest.PaymentMode;
                    this.form.OnlyCTPL              = this.ResultQueryRequest.HasCTPL;
                     
                  //   this.form.InsuranceAmount          =   parseFloat(detail.TotalCoverages).toFixed(2) ;    

                    let GetDenoSplit                    = this.ResultQueryRequest.Denomination.split('-');
                    let DenoSplit                       = GetDenoSplit[1].trim();
                    this.form.QuotationNoDisplay        = "HO-MC" + DenoSplit  +  "-" +   this.ResultQueryRequest.RequestNo ;
                    this.form.OptionWithAOG             = this.ResultQueryRequest.OptionWithAOG;
                    this.form.UploadedORCR              = this.ResultQueryRequest.UploadedORCR;
                    this.form.PolicySignature           = this.ResultQueryRequest.PolicyApproverSignature;
                    this.form.RequestStatus             = this.ResultQueryRequest.Status;
                    this.form.CocNoRequest              =this.ResultQueryRequest.CocNoRequest;
                    this.form.AuthCodeRequest           =this.ResultQueryRequest.AuthCodeRequest;
                    this.form.Individual              = this.ResultQueryRequest.Individual;
                    this.form.RegisteredName          = this.ResultQueryRequest.RegisteredName;
                    this.form.CName                    = this.ResultQueryRequest.CName;

                    this.$forceUpdate();
              
            let uri = window.location.href.split("?");
            let PassIDNew = uri[1].trim();
   
           // alert(PassIDNew);
            axios
                .get("api/IssuanceAcceptedPolicy/" + PassIDNew)
                .then(({ data }) => {
                    this.GetNewGroup = data;
                    console.log(this.GetNewGroup);
                });

            axios
                .get("api/IssuanceAcceptedPolicy/" + PassIDNew)
                .then(({ data }) => {
                    let results = (this.URLQueryPerilsCoveragesGroup = data);
                    results.map(details => {
                        // console.log(details.ListCoverages);
                        this.ListCoverages              = details.ListCoverages;
                        this.ListCharges                = details.ListCharges;
                        this.ClausesWarranties          = details.ClausesWarranties;
                        this.Accessories                = details.Accessories;
                        this.Sections                   = this.URLQueryPerilsCoveragesGroup;
						
                        
                    });
                });
				
				
				
				 this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                         this.form.Deductible       = URLQueryPerilsCoveragesGroups.Deductible;
                         this.form.TowingLimit      = URLQueryPerilsCoveragesGroups.TowingLimit;
                         this.form.AuthRepairLimit  = URLQueryPerilsCoveragesGroups.AuthRepairLimit;
                        
					
						  URLQueryPerilsCoveragesGroups.ClausesWarranties.map(( ListWarranties) => {
								   if(ListWarranties.Belong =="PA" ){
								        this.form.ClausesStatementPA  =  ListWarranties.ClausesStatement  ;
                                   }                     
							 });
							 
							  URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoverages) => {
                                  	 
                                   
								   if(ListCoverages.PerilsCode =="PA" ){
										this.form.ClausesStatementAmount  =  ListCoverages.CoveragesAmount  ;
                                        this.form.CoverageDescPA          =  ListCoverages.Description  ;
                                        
                                       // CoverageAmountPA
                                   }    
                                             
                             });
                             
				            
                 })
                  this.SplitStatementClauses();
                      this.SplitDescription();
				  
				 }, 1000);
				 
				  this.RetrieveTimeInterval2 = setInterval(() => {
                     
                                                  
								clearInterval(this.RetrieveTimeInterval);
        }, 			5000);
				
               
        }
    },

    filters: {
        dateFormat(date) {
            return moment(date).format("LL");
        },

        toWords(amount) {
            let number = Math.round(amount);
            return converter.toWords(number).toUpperCase();
        },

        peso(amount) {
            const amt = Number(amount);
            return (
                " " +
                amt.toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })
            );
        }
    },

    computed: {
        date() {
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            return `${month} / ${day} / ${year}`;
        },
     MotorEffectiveDateDisplay () {
             let OrigDate = this.form.MotorEffectiveDate ;
            let date = new Date(OrigDate);
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
           // day < 10 ? '0' + day : '' + day;
            return `${month < 10 ? '0' + month : '' + month}/${day < 10 ? '0' + day : '' + day}/${year}`;
   
        },
    MotorExpiryDateDisplay () {
             let OrigDate = this.form.MotorExpiryDate ;
            let date = new Date(OrigDate);
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            return `${month < 10 ? '0' + month : '' + month}/${day < 10 ? '0' + day : '' + day}/${year}`;
   
        },


       
    },

    created() {
        this.loadData();
    }
};
</script>

<style scoped>
#upperRight > b {
    font-weight: 500;
}
.CLassLeftIndent{
  padding-left: 30px;
  width:100%;
}

.CLassLeftIndent1{
  padding-left:10px;
  width:100%;
  font-size:10px;
}
.CLassLeftIndent2{
  padding-left:20px;
  width:100%;
  font-size:10px;
}
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

.inputfile + label {
    font-size: 1em;
    font-weight: 700;
    display: inline-block;
    cursor: pointer; /* "hand" cursor */
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: white;
}

.inputfile + label * {
	pointer-events: none;
}


.preStyle {
    border: none;
    font-family: sans-serif;
    background: transparent;
    font-size: x-small
}

#statement {
    overflow: visible;
    /* text-align: left; */
    white-space: pre-wrap;
    background: white;
    border-style: none;
    font-family: Arial, Helvetica, sans-serif
}

@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
