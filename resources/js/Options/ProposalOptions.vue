<style>
    

    #proposalBody {
        padding: 0px 30px 30px;
    }

   

   

   
</style>


<template >

  <div id="MainPage" >
    <!-- <section class="content-header">
      <h1>
        Quotations
        <small>List of Quotations Approved</small>
        {{data}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation </li>
      </ol>
    </section> -->

    <!-- Main content -->

     <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
    </section> -->

 <section class="content DisabledSection ContentSection" v-if="form.AcctNo.trim() !==  UserDetails.AccountNo.trim()" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >NO RECORD FOUND</big></h1>
                </div>
 </section>


	
    <section class="content DisabledSection ContentSection"  v-if="form.AcctNo.trim() ===  UserDetails.AccountNo.trim()"  >
      <!-- <section class="content"  > -->
       <!-- <section class="content" > -->
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
                                            <tr><th style="text-align:left">TO</th> <th>:</th> 
                                                 <big v-if="form.Individual !=='Others'">   {{ form.AcctName}} </big>
                                                  <big v-else>   {{ form.RegisteredName}} </big>
                                            </tr>
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
                         <!-- <strong> Rate :  </strong>  {{  URLQueryPerilsCoveragesGroups.CoverageRates  + "%"   }}  -->
                          
						  
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
                                                <tr v-for="coverage in URLQueryPerilsCoveragesGroups.ListCoverages" :key="coverage._id" >
                                                
                                                    <td  v-if = "coverage.PerilsCode  ==='OD'">{{  coverage.PerilsName + " / Theft"}} </td>
                                                    <td  v-if = "coverage.PerilsCode  !=='OD'">{{  coverage.PerilsName }} </td>
                                                    <td style="text-align:right" >{{  coverage.CoveragesAmount | Peso }}</td>
                                                    <td style="text-align:right"  v-if = "coverage.PerilsCode  ==='AOG' && form.NoAOG  ==='YES'"> NONE </td>
                                                    <td style="text-align:right"  v-if = "coverage.PerilsCode  !='AOG' &&  form.NoAOG  ==='YES'">{{  coverage.CoveragesPremium | Peso }}</td>
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
                       
                    <form @submit.prevent="" enctype="multipart/form-data"> 
                        <input type="hidden"  v-model="form.AcceptQuotationPassData"  >
                        <input type="hidden"  v-model="form.Accessories"  >

                            <div class="row text-center no-print"  v-if="(form.QuoteExpiryStatus == 1 || form.QuoteExpiryStatus == 3) && URLQueryPerilsCoveragesGroups.StatusCovetages === 3"  >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="accessories">Remarks : </label>
                                        <textarea type="text" class="form-control"  v-model="form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo]"  ></textarea>
                                    </div>
                                </div> 
                            </div>
                      
                            <div class="row text-center no-print" id="AcceptWhenApproved"  v-if="(form.QuoteExpiryStatus === 1 || form.QuoteExpiryStatus === 3) && URLQueryPerilsCoveragesGroups.StatusCovetages ===3"    >
                            

                            <!-- <div class="row text-center no-print"  id="AcceptWhenApproved"  >  -->
                          
                             <!-- <div class="row text-center no-print"    > -->
                           
                                <!-- <button class="btn btn-lg btn-success" @click='QueryByOPtion()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo] + ';;' + URLQueryPerilsCoveragesGroups.TotalAmountDue"    > ACCEPT    </button>
                                <br> -->
                                <button type="button" class="btn btn-lg btn-success"  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.RemarksCustomer[URLQueryPerilsCoveragesGroups.OptionNo] + ';;' + URLQueryPerilsCoveragesGroups.TotalAmountDue + ';;' + URLQueryPerilsCoveragesGroups.NoAOGPremiumTotal + ';;' + URLQueryPerilsCoveragesGroups.TotalChargesAOG" data-toggle="modal" data-target="#acceptModal">
                                    Accept  
                                </button>
                                <br>
                                <a href="#" class="text-red" style="text-decoration: underline;" @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo" @click='DeclineProposal()'>Decline</a>
                            </div>


                            <div class="row text-center no-print"  v-show="isShowing"  v-if="form.QuoteExpiryStatus == 2"   >
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="accessories">Send Messages</label>
                                        <input type="text" class="form-control"  v-model="form.CustMessage[URLQueryPerilsCoveragesGroups.OptionNo]"  >
                                </div>
                          </div>     


                            <button type="button" class="btn btn-lg btn-success no-print" @click='ComposeMessageCustomer()'  @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo + ';;' + form.CustMessage[URLQueryPerilsCoveragesGroups.OptionNo]" > Submit    </button><br>
                            <a class="text-red" style="text-decoration: underline; no-print" @mouseover="QueryByOPtion1($event)"  :value="URLQueryPerilsCoveragesGroups.OptionNo + ';;' + URLQueryPerilsCoveragesGroups.RequestNo" @click='DeclineProposal()'>Decline</a>
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
                <h4 class="modal-title">Additional Details </h4>
              </div>
              <div class="modal-body">
			 <div class="row">
			 <div class="col-md-12">
                     
					 <div class="col-md-11">
                          <div class="form-group" v-if='form.NoAOG === "YES"'>
                              <input v-model="form.OptionWithAOG" @click="ShowDiscount($event)" type="radio" id="ds" value="YES">
                              <label for="" >With Acts of Nature	</label>  <br/>
							                   <small><strong>(if selected,Your Policy Total Amount Due: {{ form.ModalDisplayTotalAmountDue  | Peso}})</strong></small>
                             </div>
                             <div class="form-group" v-if='form.NoAOG === "NO" || form.NoAOG === "YES" ' >
							
                              <input v-model="form.OptionWithAOG"  @click="ShowDiscount($event)"  type="radio" id="dsd" value="NO"  >
                              <label for="">Without Acts of Nature</label>
							              <br/>
							                 <small><strong>(if selected,Your Policy Total Amount Due: {{  form.ModalDisplayWithAOG  | Peso}} )</strong></small>
                          </div>


                         

           
                <div class="col-md-12" v-show="isShowingDiscount" v-if="form.TotalAmountComm >= 1 ">
                       <div class="form-group form-inline">
                            <label for="Discount">Discount: </label>
                            <input  v-model="form.DiscountDeduct" @change="DiscountDeduct()" type="number" class="form-control input-sm" placeholder="Amount Discount">
                            <br/> <small>Max. Commission : {{ form.TotalAmountComm  | Peso}}</small>
                             <br/> <small v-if="UserDetails.CashOutDiscount > 0">CashOut Discount : {{ UserDetails.CashOutDiscount | Peso}}</small>
                             <br/> <label style="color: red; padding: 0px;" v-if="UserDetails.CashOutDiscount > 0">Total Discount  : {{ parseFloat(UserDetails.CashOutDiscount) + parseFloat(form.TotalAmountComm) | Peso}}</label >
                       </div>

                        <div class="form-group form-inline">
                           <small> <label for="Discount">Discounted Amount:  </label></small>
                           <label style="color: blue; padding: 0px;"> {{ form.DiscountedAmount  | Peso  }} </label>
                       </div>
                </div>     
               
           </div>
				
					</div>     
			</div> 	 

                
				<br/>
				 <div class="row">	
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for=""><big class="label" style="color: red; padding: 0px;" v-if="!form.mvFileNo">*</big> MV File No. : </label>
                            <input v-model="form.mvFileNo" type="text" class="form-control input-sm" placeholder="Enter MV File No."/>
                      </div>
                  
                      <div class="col-md-4">
                          <label for=""> <span class="label" style="color: red; padding: 0px;" v-if="!form.engineNo">*</span> Engine No. :</label>
                          <input v-model="form.engineNo" type="text" class="form-control input-sm" placeholder="Enter Engine No."/>
                      </div>

                        <div class="col-md-4">
                          <label for=""> <span class="label" style="color: red; padding: 0px;" v-if="!form.chassisNo">*</span> Chassis No. :</label>
                         <input v-model="form.chassisNo" type="text" class="form-control input-sm" placeholder="Enter Chassis No."/>
                      </div>
                     
                  </div>
         </div>
                <br/>
          
          <div class="row">	
                  <div class="form-group">
                      <div class="col-md-4">
                          <label for=""><span class="label" style="color: red; padding: 0px;" v-if="!form.color">*</span>Car Color :</label>
                             <input v-model="form.color" type="text" class="form-control input-sm" placeholder="Enter Car Color"/>
                      </div>
                  
                      <div class="col-md-4">
                          <label for=""> <span class="label" style="color: red; padding: 0px;" >Optional</span> Upload OR/CR :</label>
                              <input class="form-control" type="file" v-on:change="onImageChange" multiple tabindex="-1" />
                      </div>

                        <div class="col-md-4">
                            <input v-model="form.mortgage" type="checkbox" id="mortgaged">
                          <label for=""> Mortgaged ?</label>
                             <select class="form-control" v-model="form.bankName" :disabled="!form.mortgage" required >
                                    <option value="" selected disabled >Select Banks</option>
									                  <option    v-for="GetListBankss in GetListBanks" :key="GetListBankss._id"  v-bind:value="GetListBankss.BankName"  >{{ GetListBankss.BankName}}</option>
                              </select>
                                  <input v-model="form.bankNameAddress" type="text" class="form-control input-sm" :readonly="!form.mortgage" placeholder="Enter Branch"/>
                 
                      </div>
                     
                  </div>
         </div>

                <!-- <div class="row">
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
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <!-- <label for=""> Mode of Delivery :</label> -->
                      </div>
                        <div class="col-md-1"> </div>
                        <!-- <div class="col-md-12">
                          <div class="form-group"> 
                           
                            <div class="col-md-4" style="padding: 0px 2px;">
                                <input v-model="form.deliveryAddress" type="radio" id="sameAddress" value="sameAddress" @change="onChangeAddress">
                               <label for="sameAddress">Same Address</label>
                            </div>
                            <div class="col-md-4" style="padding: 0px 2px;">
                               <input v-model="form.deliveryAddress" type="radio" id="differentAddress" value="differentAddress" @change="onChangeAddress">
                               <label for="differentAddress">Different Address</label>
                          </div>
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
                        </div> -->


                      <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Mode of Payment :</label>
                      </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-11"> 
                          <div class="form-group">
                             <div class="col-md-3" style="padding: 0px 2px;" v-if="form.RequestType ==='Manual'">
                                    <input v-model="form.PaymentMode" type="radio" id="Cashier" value="Cashier">
                                      <label for="Cashier" style="margin: 0px">Cashier</label>
                            </div>
                             <div class="col-md-3" style="padding: 0px 2px;">
                                      <input v-model="form.PaymentMode" type="radio" disabled id="Paymaya" value="Paymaya">
                                      <label for="Paymaya" style="margin: 0px">Paymaya</label><br/>
                                      <small>Available Soon</small>
                            </div>
                            
                            <div class="col-md-3" style="padding: 0px 2px;">
                                    <input v-model="form.PaymentMode" type="radio" id="Paypal" value="Paypal">
                                      <label for="Paypal" style="margin: 0px">Paypal</label>
                            </div>
                           
                           <div class="col-md-3" style="padding: 0px 2px;">
                                <input v-model="form.PaymentMode" type="radio" id="Dragonpay" value="Dragonpay">
                                      <label for="Dragonpay" style="margin: 0px">Dragonpay</label>
                          </div>

                       </div>  
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
              <div class="modal-footer no-print">
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
 <!-- <pre>{{ $data }}</pre> -->
    </section>
 <!-- Modal -->
        <div class="modal fade" id="LoadingModal" data-backdrop="static" data-keyboard="false" href="#">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                        <div class="overlay" style="color:#00a65a">
                             <h1>  <i class="fa fa-refresh fa-spin" > </i> Loading...</h1> 
                            
                        </div>
                         <small>Status :  {{this.ConnectionStatus}}</small>
                    
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->


  </div>
</template>




<script>
export default {
 
 
   mounted: function(){ 
		console.log(this.surveyData);
       // let id = this.$route.params.id
        //console.log('mounted' + id)
         console.log('Component mounted.')  
         axios.get("GetUserData").then(({ data }) => (this.UserDetails = data));

              
       this.StartLoading();
        this.LoadData();
      
       
       
    },

    data() {
        return {
            ResultQueryRequest:{},
            URLQueryPerilsCoverages:{},
            ResultLoginDetails:{},
            ListApproverQuotation:{},
            UserDetails:{},
            GetListBanks:{},
            AgentComm:{},
            URLQueryPerilsCoveragesGroup:'',
            RetrieveTimeInterval:null,
             isShowing:false,
              isShowingDiscount:false,
            image: '',

             ConnectionStatus:'',

            
            form: new Form({
                RequestNo:'',
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
                    PaymentMode: '0',
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
                  UploadORCR: '',
                  DiscountDeduct: '0.00',
                  DiscountedAmount: '',
                  TotalAmountComm: '',
                  CashOutDiscount: '0.00',
                  OptionNoByClick: '',
                  RequestType: '',
				  

             

            }),

            Wordings: {},
          
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


      DeclineProposal(){
        
              Swal.fire({
                title: " CONFIRMED ?",
                text: " Decline Quotation",
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
               if (result.value) {
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
                  
                  this.form.post('api/DeclineProposal').then(() => {
                    // Success!
                     Swal.fire(
                        ' Decline ! ',
                        `Quotation Declined.`,
                        'success'
                    )
                    this.LoadData();
                   
                }).catch((response) => {
                        alert(response);

                });
            }
            })
          


      },


      ShowDiscount(e){
          this.isShowingDiscount  =true;
         
          //this.form.TotalAmountComm  =   this.AgentComm[0].TotalAmountComm ;
         
           let OptionAmountDue       =  e.target.value.trim(); //this.form.OptionWithAOG;
            let AmountDue;let ComputeDeductedAmount;  let AmountDeduct  = this.form.DiscountDeduct;
            if (OptionAmountDue == "NO"){
                    AmountDue  = this.form.ModalDisplayWithAOG ;
                    ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(AmountDeduct);
                    
                     this.form.TotalAmountComm  =   this.AgentComm[0].TotalAmountCommAOG ;
                }else{
                  
                  AmountDue  = this.form.ModalDisplayTotalAmountDue ;
                  ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(AmountDeduct);
                   this.form.TotalAmountComm  =   this.AgentComm[0].TotalAmountComm ;
                   
                }
                //  alert(OptionAmountDue);
                 this.form.DiscountedAmount =   ComputeDeductedAmount;
      },
      DiscountDeduct(){
        let OptionAmountDue       = this.form.OptionWithAOG;
        let AmountDeduct          = this.form.DiscountDeduct;
        let MaxComm               =  parseFloat(this.form.TotalAmountComm + this.UserDetails.CashOutDiscount);
          let AmountDue; let ComputeDeductedAmount; 
       // alert(form.TotalAmountComm );
          if ( AmountDeduct > MaxComm){
             // alert("Entered Amount is Higher to :  " + MaxComm );
               //ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(AmountDeduct);
                       Swal.fire(
                                "Higher Amount!",
                                "Allowed Discount : " + parseFloat(MaxComm,2),
                                "warning"
                            );
                            this.form.DiscountDeduct =  MaxComm;
                              if (OptionAmountDue == "NO"){
                                  AmountDue  = this.form.ModalDisplayWithAOG ;
                                  ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(MaxComm);
                              }else{
                                
                                AmountDue  = this.form.ModalDisplayTotalAmountDue ;
                                  ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(MaxComm);
                              }
                              this.form.DiscountedAmount  =   ComputeDeductedAmount;
                              this.form.CashOutDiscount   = 0.00;
          }else{
                if (OptionAmountDue == "NO"){
                    AmountDue  = this.form.ModalDisplayWithAOG ;
                    ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(AmountDeduct);
                }else{
                  
                  AmountDue  = this.form.ModalDisplayTotalAmountDue ;
                    ComputeDeductedAmount = parseFloat(AmountDue) - parseFloat(AmountDeduct);
                }
                 this.form.DiscountedAmount =   ComputeDeductedAmount;
                 if ( parseFloat(this.form.DiscountDeduct)  >  parseFloat(this.UserDetails.CashOutDiscount )){
                     this.form.CashOutDiscount   = 0.00; //parseFloat(this.form.DiscountDeduct - this.UserDetails.CashOutDiscount); 
                 }else{
                     this.form.CashOutDiscount   = parseFloat(this.UserDetails.CashOutDiscount - this.form.DiscountDeduct  ); 
                 }
                 
          }

      },

      onImageChange(e){
       
          let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
         

      },

      createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    
                };
                reader.readAsDataURL(file);
                
              
            },

         uploadImage(){
                // axios.get('api/UploadImage' + {image: this.image} ).then(response => {
                //    console.log(response);
                // });
                     this.form.UploadORCR = this.image;
                //  axios.post('api/UploadImage',{image: this.image}).then(response => {
                //    console.log(response);
                // });

            },   




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
	          let AmountDue                     = e.target.value.trim();
			      let GetAmountDue                  = AmountDue.split(';;');
			      let ModalDisplayTotalAmountDue    = GetAmountDue[3].trim();
		      	let ModalDisplayWithAOG           = parseFloat(GetAmountDue[4]) +  parseFloat(GetAmountDue[5]); 
			
			      this.form.ModalDisplayWithAOG         =ModalDisplayWithAOG.toFixed(2);
            this.form.ModalDisplayTotalAmountDue  = GetAmountDue[3].trim();
            this.form.OptionNoByClick = GetAmountDue[0].trim();
            let PassIDCom =     this.form.AcctNo + ";;" + this.form.RequestNo + ";;" + GetAmountDue[0].trim();
           
               this.form.post("api/GetAgentComReport") .then(({ data }) => (this.AgentComm = data)  );     
        //console.log(this.AgentComm );
       //alert(this.AgentComm );
        
        },

         QueryByOPtion(){
        
         if (!this.form.OptionWithAOG.length )  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Select either w/ AOG or w/o AOG.',
              
                })
           }else if (!this.form.mvFileNo  || this.form.mvFileNo ===" ") {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Pls. input MV File No.',
                    
                    })  
           }else if (!this.form.engineNo || this.form.engineNo ===" ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input Engine No.',
              
                })
           }else if (!this.form.chassisNo || this.form.chassisNo ===" ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input Chassis No.',
              
                })
           }else if (!this.form.color || this.form.color ===" ")  {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pls. Input Color.',
              
                })
          //  }else if (!this.form.PaymentMode.length)  {
          //       Swal.fire({
          //           icon: 'error',
          //           title: 'Oops...',
          //           text: 'Pls. Choose Payment Mode',
              
          //       })
          }else{
         
             this.loading = true,
              Swal.fire({
                title: " CONFIRMED ?",
                text: " Accept Quotation",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(result => {
               if (result.value) {
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
                    this.form.UploadORCR = this.image;

                  this.form.post('api/AcceptQuotation').then(() => {
                    // Success!
                     Swal.fire(
                        ' Successful! ',
                        `Quotation Accepted.`,
                        'success'
                    )
                    // console.log();
                  //this.$router.push('/CustAcceptedView?' + PassID); 
                 // this.$router.push('/Payment-Mode?' + PassID) ; 
                 if ( !this.form.PaymentMode.length){   //no payment selected
                      //alert('empty ' );
                       // this.$router.push('/CustAcceptedView?' + PassID); 
                 }else{   //yes payment selected redirect to payment
                      //alert('NOt empty ' );
                      let route = this.$router.resolve({path: '/Payment-Mode?' + PassID});
                       window.open(route.href, '_self');
                 }
              
                  
                  //this.form.post('api/PaymentMode').then(() => { });
                }).catch((response) => {
                        alert(response);

                });
            }else{
                  this.$router.push("/ProposalOptions?" + PassID);
                }
            })
          }  
        
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
       
        
        },

         LoadData() {
          // alert();
        axios.get('api/wordings').then(({data}) => this.Wordings = data)
                   let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
        axios.get("api/URLQueryRequestModify/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
        axios.get("api/CustomerRequestQuotation/" + PassID ) .then(({ data }) => (this.URLQueryPerilsCoveragesGroup = data)  );
        axios.get("api/GetListBanks/") .then(({ data }) => (this.GetListBanks = data)  );
       axios.get("api/URLQueryRequestModify/" + PassID).then(({ data })  => (this.ResultQueryRequest = data)  );

      this.RetrieveTimeInterval = setInterval(() => {
            
                this.form.TINNumber          =this.ResultQueryRequest.TINNumber;
                this.form.RequestNo          =this.ResultQueryRequest.RequestNo;
                this.form.EmailAddress       =this.ResultQueryRequest.EmailAddress;
                this.form.MotorBrand         =this.ResultQueryRequest.MotorBrand;
                this.form.ContactNumber      =this.ResultQueryRequest.ContactNumber;
                this.form.FirstName          =this.ResultQueryRequest.FirstName;
                this.form.MiddleName         =this.ResultQueryRequest.MiddleName;
                this.form.LastName           =this.ResultQueryRequest.LastName;
                this.form.Address            =this.ResultQueryRequest.Address;
                this.form.Barangay           =this.ResultQueryRequest.Barangay;
                this.form.City               =this.ResultQueryRequest.City;
                
                this.form.TypeClass          =this.ResultQueryRequest.MotorBodyType;
                this.form.MotorYear          =this.ResultQueryRequest.MotorYear;
                this.form.MotorBrand         =this.ResultQueryRequest.MotorBrand;
                this.form.CoverageAmount     =this.ResultQueryRequest.MotorPOAmount;
                this.form.RatePercent        =this.ResultQueryRequest.RatePercent;
                this.form.MotorModel         =this.ResultQueryRequest.MotorModel;
                this.form.MotorType          =this.ResultQueryRequest.MotorBodyType;
                this.form.TxtPremiumAmount   =this.ResultQueryRequest.PremiumAmount;
                this.form.AmountDue          =this.ResultQueryRequest.AmountDue;
                this.form.ProductLine        =this.ResultQueryRequest.ProductLine;
                this.form.Deductible         =this.ResultQueryRequest.Deductable;
                this.form.QuoteExpiryStatus  =this.ResultQueryRequest.QuoteExpiryStatus;
                this.form.Accessories        =this.ResultQueryRequest.MotorWithAccessories;

                 this.form.AcctNo            = this.ResultQueryRequest.CustAcctNO;
                this.form.AcctName           = this.ResultQueryRequest.CName ;
                this.form.AssignCRD          = this.ResultQueryRequest.AssignCRD;
                 this.form.NoAOG             = this.ResultQueryRequest.WithAOG;
                this.form.Denomination       =this.ResultQueryRequest.Denomination;
                this.form.Individual              = this.ResultQueryRequest.Individual;
                this.form.RegisteredName          = this.ResultQueryRequest.RegisteredName;
                this.form.RequestType       = this.ResultQueryRequest.RequestType;
                this.$forceUpdate();   
          
          this.form.post("api/UpdateCommCoverages") .then(({ data }) => (this.AgentCommUpdate = data)  ); 

            this.URLQueryPerilsCoveragesGroup.map(( URLQueryPerilsCoveragesGroups) => {
			      
                //alert(URLQueryPerilsCoveragesGroups.UserApprovedLimit);
                let CompCoveragesAmount = 0 ;  let CompCoveragesAmountNoAOG = 0 ;  let CompChargesAmount = 0 ; let CompCoverageAmount = 0 ; let DisplayText; 
                       URLQueryPerilsCoveragesGroups.ListCoverages.map(( ListCoveragesURL) => {
                            this.form.RequestModify[URLQueryPerilsCoveragesGroups.OptionNo]  =   ListCoveragesURL.RequestModify;
                           CompCoveragesAmount  +=  parseFloat(ListCoveragesURL.CoveragesPremium ) ;
                           CompCoverageAmount  +=  parseFloat(ListCoveragesURL.CoveragesAmount ) ;
                       this.form.FormStatusCoverages[URLQueryPerilsCoveragesGroups.OptionNo]  = ListCoveragesURL.Status;
                                         if ( ListCoveragesURL.Status != 3){
                                              if ( ListCoveragesURL.Status === 'DECLINE'){
                                                  DisplayText = "OPTION DECLINED" ;
                                              }else{
                                                    DisplayText = "New Quotation" ;
                                              }
                                            
                                            this.isShowing =false;
                                        
                                        }else{
                                            DisplayText = " " ;
                                            this.isShowing =true;
                                        }
                                       
                                         

                                         if ( ListCoveragesURL.PerilsCode == "AOG"){
                                             CompCoveragesAmountNoAOG  = parseFloat(ListCoveragesURL.CoveragesPremium );
                                             /// this.form.NoAOG              = "YES"; 
                                         }else{
                                              CompCoveragesAmountNoAOG  = CompCoveragesAmount ;
                                             // this.form.NoAOG              = "NO";
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
 }, 200)
                  
                    this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                           
                 },3000) 
                 //this.isShowingApproval = false;
               
                           
     
    },

 

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