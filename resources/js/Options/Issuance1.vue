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

        <section class="content">
            <div class="invoice">
                <div class="row">
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
                        <table class="table" >
                            <tr>
                            <td style="width:80px">Policy No.</td><th>:</th><th style="text-align:left">{{ form.QuotationNoDisplay}}</th>
                            </tr><tr>
                            <td>Assured </td><th>:</th><th style="text-align:left">{{ form.LastName + ", " }} {{ form.FirstName }}  {{ form.MiddleName + ". " }} </th>
                            </tr><tr>
                            <td>Address </td><th>:</th><td style="text-align:left"> {{ form.Address }} <br/>  {{ form.Barangay }} {{ form.City }}</td>
                            </tr><tr>
                            <td colspan="3"><br/></td>
                            </tr>
                            <tr>
                            <td colspan="3">Amount of {{ form.InsuranceAmount | toWords }} PESOS ONLY</td>
                            </tr><tr>
                            <td>Insurance </td><th>:</th><th style="tex-align:left">{{ form.InsuranceAmount | peso }}</th>
                            </tr>
                        </table>

                    </div>
                    <!-- <div class="col-sm-1 invoice-col no-padding"></div> -->
                    <div class="col-sm-6 invoice-col no-padding pull-right">
                        <div class="col-sm-6 no-padding">
                              <table class="table" >
                                    <tr >
                                    <td style="text-align:right">Issue Date.</td><th>:</th><td style="text-align:left">{{ date | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:right">Term From </td><th>:</th><td style="text-align:left">{{ form.MotorEffectiveDate | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:right">Term To  </td><th>:</th><td style="text-align:left"> {{ form.MotorExpiryDate | dateFormat }}</td>
                                    </tr><tr>
                                    <td style="text-align:right">COC No.  </td><th>:</th><td style="text-align:left"> </td>
                                    </tr><tr>
                                    <td style="text-align:right">Authentication Code.  </td><th>:</th><td style="text-align:left"> </td>
                                    </tr>
                                
                                </table>
                        </div>
                        
                    </div>
                </div>


            <!--------Perils Table----------------------------->

                <div class="row invoice-info" style="border-style: solid;">
                    <div class="col-sm-4 invoice-col"  style="border-style: dotted;">
                          <div class="row">
                            <label style="text-decoration: underline"
                                >Scheduled Vehicle :</label
                            >
                            <button class="btn btn-xs btn-primary" style="text-decoration: none;" @click="editMode = true" v-if="!editMode">
                                <i class="fa fa-pencil"></i>
                            </button>
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
                                 <table class="table" style="width:60%"  >
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

                                    </table>
                                
                            </div>
                        </div> <!-------ROW Scheduled Vehicle---------------------------->

                    </div>  <!-------close-col-sm-4---------------------------->
                    <!-- <div class="col-sm-1 invoice-col no-padding"></div> -->
                    <div class="col-sm-8 invoice-col no-padding" style="border-style: double;">
                              <div class="col-xs-12 table-responsive">
                            <table style="width:100%">
                                <tbody>
                                    <tr>
                                        <th class="col-md-3"></th>
                                        <th class="col-md-7">
                                            PERILS
                                        </th>
                                        <th class="col-md-3">
                                            AMOUNT
                                        </th>
                                        <th class="col-md-3">
                                            PREMIUM <br />(INVOICE VALUE)
                                        </th>
                                    </tr>
                                    <tr
                                        v-for="GetNewGroups in GetNewGroup"
                                        :key="GetNewGroups._id"
                                    >
                                        <td style="width:50px;"
                                            v-if="
                                                GetNewGroups.Section != 'OTHERS'
                                            "
                                        >
                                            {{
                                                "SECTION " +
                                                    GetNewGroups.Section
                                            }}
                                        </td>
                                        <td v-else   style="width:50px;">
                                            {{ GetNewGroups.Section }}
                                        </td>
                                        <td colspan="3">
                                            <table>
                                                <tr
                                                    v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id"
                                                >
                                                    <td style="width:400px;" >
                                                        <p v-if="coverage.PerilsCode != 'PA'">
                                                            {{
                                                                coverage.PerilsName
                                                            }}
                                                        </p>
                                                         <p v-if="coverage.PerilsCode == 'PA'">
                                                            {{
                                                                coverage.PerilsName
                                                            }} 
                                                        
                                                        </p>
                                                           
                                                     </td>    
                                                             
                                                      
                                                  
                                                    <td
                                                        style="width:120px; text-align:right" 
                                                    >
                                                        {{
                                                            coverage.ComputeCoveagesAmount
                                                                | peso
                                                        }}
                                                      
                                                    </td>

                                                    
                                                    <td
                                                        style="width:120px; text-align:right"
                                                    >
                                                        {{
                                                            coverage.CoveragesPremium
                                                                | peso
                                                        }}
                                                        
                                                    </td>
                                                </tr>

                                                    <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    
                                               
                                                    <td  v-if="coverage.PerilsCode == 'PA'" >
                                                      
                                                           <pre id="preStyle" >{{ form.DisplayDescription }} </pre>
                                                          
                                                     </td>  
                                                   
                                                    
                                                </tr>      
                                                              

                                              
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>

                                        <td 
                                            style="border-top: 2px solid black;"
                                            class="pull-left"
                                        >
                                            {{ form.PremiumAmount | peso }}
                                         
                                                         
                                        </td>
                                    </tr>

                                    <!-- <tr v-for="charges in ListCharges" :key="charges._id">
                                        <td class="pull-right">{{charges.ChargesName}}</td>
                                        <td></td>
                                        <td>{{charges.ChargesAmount | peso}}</td>
                                    </tr> -->
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <table
                                        class="table table-striped table-responsive pull-right"
                                    >
                                        <tbody>
                                            <tr
                                                v-for="charges in ListCharges"
                                                :key="charges._id"
                                            >
                                                <td>
                                                    {{ charges.ChargesName }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td class="pull-right">
                                                    {{
                                                        charges.ChargesPremium
                                                            | peso
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">
                                                    Total Amount Due
                                                </th>
                                                <td></td>
                                                <td
                                                    style="border-top: 2px solid black;"
                                                    class="pull-right"
                                                >
                                                    {{ form.AmountDue | peso }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div><!----------Close for Table Perils-------->
                    
                        
                        
                        
                        
                    </div> <!------Close SM-8--------------->
                </div><!----Close main row Container------------------------->



















                <br />
                <div class="row" style="padding: 15px;">
                    <div class="col-md-5">
                        <div class="row">
                            <label style="text-decoration: underline"
                                >Scheduled Vehicle :</label
                            >
                            <button class="btn btn-xs btn-primary" style="text-decoration: none;" @click="editMode = true" v-if="!editMode">
                                <i class="fa fa-pencil"></i>
                            </button>
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
                                 <table class="table" style="width:60%"  >
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

                                    </table>
                                
                            </div>
                        </div>
                        <br>
                        <div class="row" v-if="editMode">
                            <div class="col-md-8 no-padding">
                                <button class="btn btn-success btn-sm pull-right" @click="UpdateScheduleVehicle()">Update</button>
                                <button class="btn btn-danger btn-sm pull-right" @click="cancelUpdate" style="margin-right: 10px;">Cancel</button>
                            </div>
                        </div>

                        <div class="row">
                            <label style="text-decoration: underline"
                                >Accessories Covered :</label
                            >
                        </div>
                        <div class="row">
                            <div class="col-md-8 no-padding">
                                <div class="col-md-8 no-padding">
                                    <p
                                        v-for="Accessoriess in Accessories"
                                        :key="Accessoriess._id"
                                    >
                                        {{ Accessoriess.Name  }}
                                    </p>
                                </div>
                               
                            </div>
                        </div>

                        <div class="row">
                            <label style="text-decoration: underline"
                                >Mortgagee :</label
                            >
                          <button class="btn btn-xs btn-primary" v-if="!addBanks" @click="loadBanksName(), addBanks = true ">
                                <i class="fa fa-pencil"> </i>
                            </button>
                            <p v-if="!addBanks">
                                {{
                                    form.MortgageBankName +
                                        " - " +
                                        form.MortgageBankAddrs
                                }}
                            </p>

                             <div class="input-group input-group-sm col-md-7" v-else>
                                <select class="form-control" v-model="form.ListBankName" required >
                                    <option value="" selected disabled >List of Banks</option>
                                    <option    v-for="GetListBanksIssuances in GetListBanksIssuance" :key="GetListBanksIssuances._id"  :value="GetListBanksIssuances.BankName"  >{{ GetListBanksIssuances.BankName }}</option>
                                </select>
                                <input v-model="form.ListBankNameAddress" type="text" class="form-control input-sm">
								 
                                <span class="input-group-btn">
                                    <button  class="btn btn-primary btn-flat"
											@click="loadBanksName(),ChangeBankDetails()">
											<i class="fa fa-plus" style="font-size: 18px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-flat" @click="cancelBanksAdd">
                                        <i class="fa fa-times-circle-o" syle="font-size: 18px;"></i>
                                    </button>
                                </span>
                            </div>



                        </div>
                        <div class="row">
                            <label style="text-decoration: underline"
                                >Clauses &amp; Warranties :</label
                            >
                            <button class="btn btn-xs btn-primary" v-if="!addClauses" @click="loadClauses(), addClauses = true ">
                                <i class="fa fa-plus"> </i>
                            </button>
                            <div v-for="ClausesWarrantiess in ClausesWarranties"
                                :key="ClausesWarrantiess._id"
                                style="width: 350px;">
                                <label style="font-weight: 500;">
                                    {{ClausesWarrantiess.ClausesName}}
                                </label>
								
                                <button  v-if="
                                                ClausesWarrantiess.Belong != 'PA' && ClausesWarrantiess.ClausesRequired != 'YES'
                                            "
                                    class="btn btn-xs btn-danger pull-right"
                                    @click="deleteClause(ClausesWarrantiess._id)">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                            <div class="input-group input-group-sm col-md-7" v-if="addClauses">
								 <select class="form-control" v-model="form.ClausessName" required >
                                    <option value="" selected disabled >Add Clausses &amp; Warranties</option>
									<option    v-for="GetListClausess in GetListClauses" :key="GetListClausess._id"  :value="GetListClausess._id + ';;' + form.RequestNo +  ';;' + form.AcceptedOption +  ';;' + form.MortgageBankName +  ';;' + form.MortgageBankAddrs"  >{{ GetListClausess.Name }}</option>
                                 </select>
								 
                                <span class="input-group-btn">
                                    <button  class="btn btn-primary btn-flat"
											@click="loadClauses(), AddClausesWarrantiesToPolicy()">
											<i class="fa fa-plus" style="font-size: 18px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-flat" @click="cancelClauses">
                                        <i class="fa fa-times-circle-o" style="font-size: 18px;"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row" v-if="form.Renewal ==true" >
                            <div>
                                <label for="">Renewing/Replacing Policy {{ form.QuotationNoDisplay}}</label>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th class="col-md-3"></th>
                                        <th class="col-md-7">
                                            PERILS
                                        </th>
                                        <th class="col-md-3">
                                            AMOUNT
                                        </th>
                                        <th class="col-md-3">
                                            PREMIUM <br />(INVOICE VALUE)
                                        </th>
                                    </tr>
                                    <tr
                                        v-for="GetNewGroups in GetNewGroup"
                                        :key="GetNewGroups._id"
                                    >
                                        <td style="width:50px;"
                                            v-if="
                                                GetNewGroups.Section != 'OTHERS'
                                            "
                                        >
                                            {{
                                                "SECTION " +
                                                    GetNewGroups.Section
                                            }}
                                        </td>
                                        <td v-else   style="width:50px;">
                                            {{ GetNewGroups.Section }}
                                        </td>
                                        <td colspan="3">
                                            <table>
                                                <tr
                                                    v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id"
                                                >
                                                    <td style="width:400px;" >
                                                        <p v-if="coverage.PerilsCode != 'PA'">
                                                            {{
                                                                coverage.PerilsName
                                                            }}
                                                        </p>
                                                         <p v-if="coverage.PerilsCode == 'PA'">
                                                            {{
                                                                coverage.PerilsName
                                                            }} 
                                                        
                                                        </p>
                                                           
                                                     </td>    
                                                             
                                                      
                                                  
                                                    <td
                                                        style="width:120px; text-align:right" 
                                                    >
                                                        {{
                                                            coverage.ComputeCoveagesAmount
                                                                | peso
                                                        }}
                                                      
                                                    </td>

                                                    
                                                    <td
                                                        style="width:120px; text-align:right"
                                                    >
                                                        {{
                                                            coverage.CoveragesPremium
                                                                | peso
                                                        }}
                                                        
                                                    </td>
                                                </tr>

                                                    <tr   v-for="coverage in GetNewGroups.ListCoverages"
                                                    :key="coverage._id">
                                                    
                                               
                                                    <td  v-if="coverage.PerilsCode == 'PA'" >
                                                      
                                                           <pre id="preStyle" >{{ form.DisplayDescription }} </pre>
                                                          
                                                     </td>  
                                                   
                                                    
                                                </tr>      
                                                              

                                              
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>

                                        <td 
                                            style="border-top: 2px solid black;"
                                            class="pull-left"
                                        >
                                            {{ form.PremiumAmount | peso }}
                                         
                                                         
                                        </td>
                                    </tr>

                                    <!-- <tr v-for="charges in ListCharges" :key="charges._id">
                                        <td class="pull-right">{{charges.ChargesName}}</td>
                                        <td></td>
                                        <td>{{charges.ChargesAmount | peso}}</td>
                                    </tr> -->
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <table
                                        class="table table-striped table-responsive pull-right"
                                    >
                                        <tbody>
                                            <tr
                                                v-for="charges in ListCharges"
                                                :key="charges._id"
                                            >
                                                <td>
                                                    {{ charges.ChargesName }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td class="pull-right">
                                                    {{
                                                        charges.ChargesPremium
                                                            | peso
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">
                                                    Total Amount Due
                                                </th>
                                                <td></td>
                                                <td
                                                    style="border-top: 2px solid black;"
                                                    class="pull-right"
                                                >
                                                    {{ form.AmountDue | peso }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row no-print">
                    <div class="col-xs-12">
                        <div class="col-md-6">
                            <label>Remarks: </label>
                            <textarea class="form-control" rows="3" cols="5" v-model="form.IssuanceRemarks" placeholder="Leave a Remarks..."></textarea>
                        </div>

                    </div>
                    <div class="col-xs-2 pull-right text-center">
                        <!-- <input type="file" id="file" class="inputfile">
                        <label for="file">Put your Signature</label>
                        <p style="border-top: 1px solid black;">Authorized Signature</p> -->
                        <div>
                            <button @click="textRemark" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                                <i class="fa fa-edit"></i> 
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------Policy Attach Docs.------------------------->
            <div class="invoice">
                <div class="row">
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
                    class="row"
                    v-for="ClausesWarrantiess in ClausesWarranties"
                    :key="ClausesWarrantiess._id"
                >
                    <div class="col-md-12">
                        <h5 class="text-center" v-if="ClausesWarrantiess.ClausesNo !='2020-0012'" style="text-transform: uppercase;">
                            {{ ClausesWarrantiess.ClausesName }}
                        </h5>
                           <pre id="statement" v-if="ClausesWarrantiess.ClausesNo !='2020-0012'">{{ ClausesWarrantiess.ClausesStatement }}</pre>
					

						 <h5 class="text-center" v-if="ClausesWarrantiess.ClausesNo =='2020-0012' && form.FormTitleforPA == 'PA'" style="text-transform: uppercase;">
                            {{ form.PATitleClauses}}
                        </h5>
                          <pre id="statement" v-if="ClausesWarrantiess.ClausesNo =='2020-0012' && form.FormTitleforPA == 'PA'"  >{{ form.DisplayStatementClauses  }} </pre>
	                 

                         <h5 class="text-center" v-if="ClausesWarrantiess.ClausesNo =='2020-0012' && form.FormTitleforPA1 == 'Coverage'" style="text-transform: uppercase;">
                            {{ form.PATitleClauses1 }}
                        </h5>
                            <pre id="statement" v-if="ClausesWarrantiess.ClausesNo =='2020-0012' && form.FormTitleforPA1 == 'Coverage'"  >{{ form.DisplayStatementClauses1  }}   <input type="hidden" v-model="form.ClausesStatementPA"></pre>
	          

                          
                       
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-xs-12">
                        <!-- <div class="input-group input-group-sm col-md-7" >
                         
								 <select class="form-control" v-model="form.SignatureName" required >
                                    <option value="" selected disabled >Select Signatory</option>
									<option    v-for="GetListSignatorys in GetListSignatory" :key="GetListSignatorys._id"  v-bind:value="GetListSignatorys._id + ';;' + GetListSignatorys.AccountNo +  ';;' + GetListSignatorys.CName"  >{{ GetListSignatorys.CName }}</option>
                    
                                 </select>
								 
                                <span class="input-group-btn">
                                    <button  class="btn btn-success btn-flat"
											@click="SubmitForSignature()">
											<i class="fa fa-file-pdf-o"></i>
                                            Submit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-flat" @click="cancelClauses">
                                        <i class="fa fa-arrow-circle-left" style="font-size: 18px;"></i>
                                        Back
                                    </button>
                                </span>
                            </div> -->
                    
                      <a href="api/ISAPInternalAuth" target="_blank">
                        <button
                            type="button"
                            class="btn btn-info pull-right"  
                            >
                            <i class="fa  fa-send"></i>
                            Internal Authentication
                        </button>
                    </a>

                         <button
                            type="button"
                            class="btn btn-success pull-right"  
                            @click="SubmitForSignature"
                            >
                            <i class="fa fa-file-pdf-o"></i>
                            Submit
                        </button>
                        <router-link
                            to="/proposal-lists-accepted"
                            class="btn btn-primary pull-right"
                            style="margin-right: 5px; text-decoration: none;">
                            <i class="fa  fa-arrow-circle-left"></i>
                            Back
                        </router-link>
                        <div class="pull-right" style="margin-right: 5px; width: 250px;">
                            <select class="form-control" v-model="form.SignatureName" required >
                                <option value="" selected disabled >Select Signatory</option>
                                <option    v-for="GetListSignatorys in GetListSignatory" :key="GetListSignatorys._id"  v-bind:value="GetListSignatorys._id + ';;' + GetListSignatorys.AccountNo +  ';;' + GetListSignatorys.CName"  >{{ GetListSignatorys.CName }}</option>
                
                            </select>
                        </div>
                        <!-- <button
                            type="button"
                            class="btn btn-info pull-right"
                            style="margin-right: 5px;">
                            <i class="fa fa-download"></i>
                            Generate PDF
                        </button> -->
						
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
        axios.get("api/GetListSignatory/") .then(({ data }) => (this.GetListSignatory = data)  );
        //this.SplitDescription();
     
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
                DisplayDescription: '',
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
            })
        };
    },

    methods: {
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
        InternalAuthen()
            {
            
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

                let GetRequestNo =  this.form.RequestNo.trim()  + ';;'  + this.UserDetails.AccountNo + ';;' + this.UserDetails.CName  + ';;' + this.ListCoverages[0].OptionNo  + ";;" + this.form.Remarks + ";;" + this.form.IssuanceRemarks;
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
                this.form.DisplayDescription = SplitData[0] + '\n'  + SplitData[1] + '\n'  + SplitData[2] + '\t \t' + parseFloat(Split2Compute).toFixed(2)  + ' @'  + '\n'  + SplitData[3] + '\t \t \t \t \t \xa0' + parseFloat(Split3Compute).toFixed(2)  + ' @'  + '\n'  + SplitData[4] ;
       
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
                  this.form.DisplayStatementClauses1     =   Display1to4  + '\n' + Display5to6  + '\n' +   Display7 + '\n' +  Display8  + '\n' + Display8a + '\n' + NewDisplay8b + '\n' + Display8c + '\n' +  Display8d + '\n' +  Display8e + '\n' +  Display8f + '\n' +  Display8g;
          
                 
       
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
            let uri = window.location.href.split("?");
            let PassID = uri[1].trim();
            axios.get("api/URLQueryRequestModify/" + PassID).then(({ data }) => {
                let result = (this.ResultQueryRequest = data.data);

                result.map(detail => {
                    
				    this.form.RequestNo 		= detail.RequestNo;
					this.form.AcceptedOption 	= detail.AcceptedOption;
                    this.form.TINNumber 		= detail.TINNumber;
                    this.form.EmailAddress = detail.EmailAddress;
                    this.form.MotorBrand = detail.MotorBrand;
                    this.form.ContactNumber = detail.ContactNumber;
                    this.form.FirstName = detail.FirstName;
                    this.form.MiddleName = detail.MiddleName;
                    this.form.LastName = detail.LastName;
                    this.form.Address = detail.Address;
                    this.form.Barangay = detail.Barangay;
                    this.form.City = detail.City;
                    this.form.Denomination = detail.Denomination;
                    this.form.TypeClass = detail.MotorBodyType;
                    this.form.MotorYear = detail.MotorYear;
                    this.form.MotorBrand = detail.MotorBrand;
                    this.form.CoverageAmount = detail.MotorPOAmount;
                    this.form.RatePercent = detail.RatePercent;
                    this.form.MotorModel = detail.MotorModel;
                    this.form.MotorType = detail.MotorBodyType;
                    this.form.TxtPremiumAmount = detail.PremiumAmount;
                    this.form.AmountDue = detail.AmountDue;
                    this.form.ProductLine = detail.ProductLine;
                    this.form.Deductable = detail.Deductable;
                    this.form.PlateNumber = detail.PlateNumber;
                    this.form.ChassisNo = detail.ChassisNo;
                    this.form.EngineNo = detail.EngineNo;
                    this.form.BodyColor = detail.BodyColor;
                    this.form.MortgageBankName = detail.MortgageBankName;
                    this.form.MortgageBankAddrs = detail.MortgageBankAddress;

                    this.form.MotorEffectiveDate = detail.MotorEffectiveDate;
                    this.form.MotorExpiryDate = detail.MotorExpiryDate;
                    this.form.PremiumAmount = detail.PremiumAmount;
                    this.form.PassengerNo = detail.Passengers;
                    this.form.Renewal = detail.Renewal;
                     this.form.InsuranceAmount  =   parseFloat(detail.TotalCoverages).toFixed(2) ;    

                    let GetDenoSplit         = detail.Denomination.split('-');
                    let DenoSplit            = GetDenoSplit[1].trim();
                    this.form.QuotationNoDisplay = "HO-MC" + DenoSplit  +  "-" +   detail.RequestNo ;
                     this.form.OptionWithAOG              =detail.OptionWithAOG;
                   
                    

                    this.$forceUpdate();
                });
            });

            let PassIDNew = uri[1].trim() + ";;2" ;
           // alert(PassIDNew);
            axios
                .get("api/CustomerAcceptedCoverage/" + PassIDNew)
                .then(({ data }) => {
                    this.GetNewGroup = data;
                    console.log(this.GetNewGroup);
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
				
				
				this.RetrieveTimeInterval = setInterval(() => {
				 this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
                        
					
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
				  
				 }, 1000);
				 
				  this.RetrieveTimeInterval2 = setInterval(() => {
                      this.SplitStatementClauses();
                      this.SplitDescription();
                                                  
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
                "₱ " +
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

    created() {
        this.loadData();
    }
};
</script>

<style scoped>
#upperRight > b {
    font-weight: 500;
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


#preStyle {
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
</style>
