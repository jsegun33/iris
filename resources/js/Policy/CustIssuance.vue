<template>
    <div>
        <section class="content-header">
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
        </section>

        <section class="content"  > 
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
                            <img :src="RSILogo" alt="Logo" style="height: 50px;" id="logoRSI">
                            <small class="pull-right  no-print">Date: {{ date }}</small>
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                        <table class="table" style="width:100%;font-size: 12px;">
                            <tr>
                            <td >Policy No.</td><th>:</th><th style="text-align:left">{{ form.QuotationNoDisplay}}</th>
                            </tr><tr>
                            <td>Assured </td><th>:</th><th style="text-align:left">{{ form.LastName + ", " }} {{ form.FirstName }}  {{ form.MiddleName + ". " }} </th>
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
                                    <td style="text-align:left">COC No.  </td><th>:</th><td style="text-align:left"> {{ form.CocNoRequest}}</td>
                                    </tr><tr>
                                    <td style="text-align:left">Authentication Code.  </td><th>:</th><td style="text-align:left"> {{ form.AuthCodeRequest}} </td>
                                    </tr>
                                
                                </table>
                        </div>
                        
                    </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-md-12">
                        <table class="table" style="width:80%;font-size: 12px;">
                            <tr>
                            <td style="text-align:left;width:100px">Amount of Insurance : </td> <td id="wordAmount" colspan="2" style="text-align:left"> {{ form.InsuranceAmount | toWords  }} PESOS ONLY
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
                                            <img :src="'OR-CR/' + form.UploadedORCR" width="100px" @click="zoom()">
                                        

                                         <!-------   <img v-bind:src="'/OR-CR/' + form.UploadedORCR"  alt="OR-CR" style="height: 50px;" @click="zoom(url)">-------->
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
                         
							
							
						 <table class="table" style="width:100%;font-size: 12px;"  v-if="form.MortgageBankName !==null || form.MortgageBankAddrs !==null" >
                                     <tr v-if="!addBanks" >
                                        <th style="width:100px" id="mortgagee">  {{ form.MortgageBankName +
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
                                                             
                                                      
                                                  
                                                    <td id="coverageAmount"
                                                        style="width:150px;text-align:right;" 
                                                    >
                                                        {{
                                                            coverage.ComputeCoveagesAmount
                                                                | peso
                                                        }}
                                                      
                                                    </td>

                                                    
                                                    <td id="PremiumAmount"
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
                                      
                                        <td id="listCharges" colspan="3" style="text-align:right;">{{ charges.ChargesName }}</td>
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
            <!-------------------Policy Attach Docs.------------------------->
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
                                      <p style="text-align:justify" id="clausesStatement"> {{  ClausesWarrantiess.ClausesStatement }} </p> 
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


                 <div class="row no-print" >
                    <div class="col-xs-12">
                      
                        <button  @click="PrintPolicy()"
                            type="button"
                            class="btn btn-info pull-right"  
                            >
                            <i class="fa  fa-print"></i>
                            Print Policy
                        </button>

                        <button @click="downloadPDF()" type="button" class="btn btn-default pull-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Generate PDF
                        </button>
                       
                      
						
                    </div>
                </div>

                <!-- -----------<pre>{{ $data }}</pre>--------- -->
            </div>
        </section>
    </div>
</template>


<script>
import jsPDF from 'jspdf'
import moment from 'moment'
export default {
    mounted: function() {
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
        let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
       // axios.get("api/GetListClauses/" + PassID) .then(({ data }) => (this.GetListClauses = data)  );
      this.loadData();
        
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
            ClausesWarranties: {},
            Accessories: {},
            GetListSignatory: {},
            GetListClauses: {},
            Sections: {},
             UserDetails:{},
             GetListBanksIssuance:{},
			 ListClausesWarranties:{},
            SumUpCoveragesAmount: 0,
            selectedImage: null,
            RetrieveTimeInterval: null,
            RetrieveTimeInterval2: null,
                
            TimeLoading1:null,
            TimeLoading:null,
            TimeLoadingInternet:null,
            ConnectionStatus:'',
              PAClausesDisplay:{},
              RSILogo: 'http://127.0.0.1:8000/img/rsilogo.png',



            
            form: new Form({
                CustAcctNO: "",
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
                 Deductible: '',
                 TowingLimit: '',
                 AuthRepairLimit: '',
               //  CustAcctNO: '',

            })
        };
    },

    methods: {

        downloadPDF() {
            // let image = this.RSILogo;
            // console.log(file);
            var d = new Date();
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var month = monthNames[d.getMonth()];
            var day = d.getDate();
            var year = d.getFullYear();
            var Amount = document.getElementById("wordAmount").innerText;
            var TermFrom = moment(this.form.MotorEffectiveDate).format('LL');
            var TermTo = moment(this.form.MotorExpiryDate).format('LL');
            var AmountCoverage = document.getElementById("coverageAmount").innerText;
            var AmountPremium = document.getElementById("PremiumAmount").innerText;
            var Mortgagee = document.getElementById("mortgagee").innerText;
            var ClausesStatement = document.getElementById("clausesStatement").innerText;
            var ListCharges = this.ListCharges;
            var ClausesWarranties = this.ClausesWarranties;
            var Accessories = this.Accessories;
            // console.log(Mortgagee);

            var pdf = new jsPDF({
                format: 'letter'
            });

            // pdf.addImage(image, 'PNG', 20, 30, 250, 250,);
            pdf.setFontSize(10);
            // Left Side
            pdf.text(`Policy No. : ${this.form.QuotationNoDisplay}`, 10, 30);
            pdf.text(`Assured : ${this.form.RegisteredName}`, 10, 35);
            pdf.text(`Address : ${this.form.Address }`, 10, 40);
            pdf.text(`${this.form.Barangay}`, 25, 45);
            pdf.text(`${this.form.City}`, 25, 50);
            pdf.text(`Amount of ${Amount}`, 10, 65);
            pdf.setFontStyle("bold");
            pdf.text(`Scheduled Vehicle :`, 10, 80);
            pdf.setFontStyle("normal");
            pdf.text(`${this.form.MotorYear} ${this.form.MotorBrand} ${this.form.MotorModel} ${this.form.MotorType}`, 10, 85);
            pdf.text(`Plate No. : ${this.form.PlateNumber}`, 10, 95);
            pdf.text(`Serial No. : ${this.form.ChassisNo}`, 10, 100);
            pdf.text(`Motor No. : ${this.form.EngineNo}`, 10, 105);
            pdf.text(`Color : ${this.form.BodyColor}`, 10, 110);
            pdf.setFontStyle("bold");
            pdf.text(`Accessories Covered :`, 10, 130);
            pdf.setFontStyle("normal");
            let YAXISS = 135
            for (let index = 0; index < Accessories.length; index++) {
                pdf.text(`${this.Accessories[index].Name}`, 10, YAXISS);
                YAXISS+=5;
            }
            pdf.setFontStyle("bold");
            pdf.text(`Mortgagee :`, 10, 160);
            pdf.setFontStyle("normal");
            if (Mortgagee != 'undefined - undefined') {
                pdf.text(`${Mortgagee}`, 10, 165);
            }
            pdf.setFontStyle("bold");
            pdf.text(`Clauses & Warranties :`, 10, 175);
            pdf.setFontStyle("normal");
            let YAXIS = 180;
            for (let index = 0; index < ClausesWarranties.length; index++) {
                pdf.text(`${this.ClausesWarranties[index].ClausesName}`, 10, YAXIS);
                YAXIS+=5
            }

            // Center
            pdf.setFontStyle("bold");
            pdf.text(`PERILS`, 120, 80, "center");
            pdf.setFontStyle("normal");
            pdf.text(`${this.GetNewGroup[0].Section}`, 100, 85, "center");
            pdf.text(`${this.GetNewGroup[0].ListCoverages[0].PerilsName}`, 120, 85, "center");

            // Right Side
            pdf.text(`Issued date : ${month} ${day},${year}`, 200, 30, "right");
            pdf.text(`Term From : ${TermFrom}`, 200, 35, "right");
            pdf.text(`Term To : ${TermTo}`, 200, 40, "right");
            pdf.text(`COC No. : ${this.form.CocNoRequest}`, 200, 45, "right");
            if (this.form.AuthCodeRequest == undefined) {
                pdf.text(`Authentication Code : `, 200, 50, "right");
            } else {
                pdf.text(`Authentication Code : ${this.form.AuthCodeRequest}`, 200, 50, "right");
            }
            pdf.setFontStyle("bold");
            pdf.text(`AMOUNT`, 170, 75, "right");
            pdf.setFontStyle("normal");
            pdf.text(`${AmountCoverage}`, 170, 85, "right"); // Not Yet Done
            let yA = 115;
            for (let i = 0; i < ListCharges.length; i++) {
                yA+=5
                let chargesName = this.ListCharges[i].ChargesName;
                pdf.text(`${chargesName}`, 170, yA, "right");
            }
            pdf.setFontStyle("bold");
            pdf.text(`Total Amount Due`, 170, 155, "right");
            pdf.setFontStyle("normal");
            pdf.text(`Deductible :`, 170, 170, "right");
            pdf.text(`Towing Limit :`, 170, 175, "right");
            pdf.text(`Auth Repair Limit :`, 170, 180, "right");

            pdf.setFontStyle("bold");
            pdf.text(`PREMIUM`, 200, 75, "right");
            pdf.setFontSize(8);
            pdf.text(`(INVOICE VALUE)`, 205, 80, "right");
            pdf.setFontStyle("normal");
            pdf.setFontSize(10);
            pdf.text(`${AmountPremium}`, 200, 85, "right"); // Not Yet Done
            let yAx = 115;
            for (let i = 0; i < ListCharges.length; i++) {
                yAx+=5;
                let chargesPremium = Number(this.ListCharges[i].ChargesPremium).toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                pdf.text(`${chargesPremium}`, 200, yAx, "right");
                console.log(yAx);
            }
            pdf.text(`${Number(this.form.AmountDue).toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`, 200, 155, "right");
            pdf.text(`${Number(this.form.Deductible).toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`, 200, 170, "right");
            pdf.text(`${Number(this.form.TowingLimit).toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`, 200, 175, "right");
            pdf.text(`${Number(this.form.AuthRepairLimit).toLocaleString("ko-KR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`, 200, 180, "right");
            pdf.text(`Authorized Signature`, 200, 250, "right");

            pdf.addPage();
            // Left Side
            pdf.setFontStyle("bold");
            pdf.text('Clauses & Warranties :', 10, 30);

            // Center
            pdf.setFontStyle("bold");
            pdf.text(`ATTACHED TO AND FORMING PART OF POLICY NUMBER ${this.form.QuotationNoDisplay}`, 110, 20, "center");
            pdf.setFontStyle("normal");
            let yAxis1 = 40
            let yAxis2 = 45
            for (let index = 0; index < 5; index++) {
                pdf.text(`${this.ClausesWarranties[index].ClausesName}`, 110, yAxis1, "center");
                pdf.text(`${this.ClausesWarranties[index].ClausesStatement}`, 105, yAxis2, {align: "center", maxWidth:200});
                yAxis1+=35;
                yAxis2+=35;
            }

            pdf.addPage();
            let yAxis11 = 30
            let yAxis22 = 35
            if (ClausesWarranties.length > 5) {
                for (let index = 5; index < 7; index++) {
                    pdf.text(`${this.ClausesWarranties[index].ClausesName}`, 110, yAxis11, "center");
                    pdf.text(`${this.ClausesWarranties[index].ClausesStatement}`, 105, yAxis22, {align: "center", maxWidth:200,});
                    yAxis11+=60;
                    yAxis22+=60;
                }
                if (this.ClausesWarranties[7].ClausesName) {
                    pdf.text(`${this.ClausesWarranties[7].ClausesName}`, 110, 210, "center");
                    pdf.text(`${this.ClausesWarranties[7].ClausesStatement}`, 105, 215, {align: "center", maxWidth:200,});
                }
            }
            // pdf.text(`${this.ClausesWarranties[1].ClausesName}`, 110, 75, "center");
            // pdf.text(`${this.ClausesWarranties[1].ClausesStatement}`, 105, 80, {align: "center", maxWidth:200});
            // pdf.text(`${this.ClausesWarranties[2].ClausesName}`, 110, 110, "center");
            // pdf.text(`${this.ClausesWarranties[2].ClausesStatement}`, 105, 115, {align: "center", maxWidth:200});

            // Right Side
            pdf.save('sample.pdf');
        },

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


          zoom(url) {
      console.log("Zoom", url);
     //this.selectedImage = url;
     this.selectedImage = this.form.UploadedORCR;
    },

        cancelUpdate() {
           // this.loadData()
            this.editMode = false
        },

        PrintPolicy(){
         window.print();

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

               let Desc           =  this.form.CoverageDescPA.trim();
               if (!(Desc)){
                    let SplitData       = Desc.split('.');
                    let NoPassengers    = parseFloat(this.form.PassengerNo) + 1 ;
                    let Split2Compute   = parseFloat(this.form.ClausesStatementAmount)  / parseFloat(NoPassengers) ;
                    let Split3Compute   = (parseFloat(this.form.ClausesStatementAmount)  / parseFloat(NoPassengers)  * 0.10 );
                    this.form.DisplayDescription1 = SplitData[0] ;
                    this.form.DisplayDescription2 = SplitData[1] ;
                    this.form.DisplayDescription3 = SplitData[2] ;
                    this.form.DisplayDescriptionVal3 = parseFloat(Split2Compute).toFixed(2)  + '@' ;
                    this.form.DisplayDescription4 = SplitData[3] ;
                    this.form.DisplayDescriptionVal4 = parseFloat(Split3Compute).toFixed(2)  + '@' ;
                    this.form.DisplayDescription5 = SplitData[4] ;
                    this.form.DisplayDescription6 = SplitData[5] ;
               }
        },
		
		 SplitStatementClauses(){ 
		          let PremiumAmount = this.form.PremiumAmount;
                   let Desc            = this.form.ClausesStatementPA;
            if (!(Desc)){
				   let SplitData       = Desc.split('.');
                let NoPassengers    = parseFloat(this.form.PassengerNo) + 1 ;
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
            }
       },
        


        loadData() {

              let uri = window.location.href.split("?");
            let PassIDNew = uri[1].trim();
   
         axios.get("api/GetListSignatory/") .then(({ data }) => (this.GetListSignatory = data)  );
         axios.get("api/URLQueryRequestModify/" + PassIDNew).then(({ data })  => (this.ResultQueryRequest = data)  );
            axios
                .get("api/CustomerAcceptedCoverage/" + PassIDNew)
                .then(({ data }) => {
                    this.GetNewGroup = data;
                    //console.log(this.GetNewGroup);
                });

            axios
                .get("api/CustomerAcceptedCoverage/" + PassIDNew)
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
                    this.$forceUpdate();
              
          
				
				
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
                  this.RetrieveTimeInterval = setInterval(() => {
                      //  this.SplitStatementClauses();
                     // this.SplitDescription();
				  
				 }, 1000);
				 
				  this.RetrieveTimeInterval2 = setInterval(() => {
								clearInterval(this.RetrieveTimeInterval);
                }, 3000);
				
               
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

       
    },

    // created() {
    //     this.loadData();
    // }
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
