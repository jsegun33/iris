<template>
    <div id="MainPage" > 
          <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->


        <section class="content  ContentSection"  v-if="this.ResultQueryRequest.PaymentMode  === '0' && this.ResultQueryRequest.PaymentGateway  === '0'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                      <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Mode of Payment : </label>
                      </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                          <div class="form-group">
                               <div class="col-md-3" style="padding: 0px 2px;">
                                <input @click="SelectModePaymentClick()" v-model="form.PaymentModeOptions" type="radio"  id="Cashier" value="Cashier">
                                      <label for="Paymaya" style="margin: 0px">Cashier</label><br/>
                                      
                            </div>

                             <div class="col-md-3" style="padding: 0px 2px;">
                                <input v-model="form.PaymentModeOptions" type="radio" disabled id="Paymaya" value="Paymaya">
                                      <label for="Paymaya" style="margin: 0px">Paymaya</label><br/>
                                      <small>Available Soon</small>
                          </div>
                            <div class="col-md-3" style="padding: 0px 2px;">
                                    <input v-model="form.PaymentModeOptions" type="radio" id="Paypal" value="Paypal">
                                      <label for="Paypal" style="margin: 0px">Paypal</label>
                            </div>
                           
                           <div class="col-md-3" style="padding: 0px 2px;">
                                <input v-model="form.PaymentModeOptions" type="radio" id="Dragonpay" value="Dragonpay">
                                      <label for="Dragonpay" style="margin: 0px">Dragonpay</label>
                          </div>

                       </div>  
                     </div>
                    </div> 
                </div> 
                </div>
      </section>


        <section class="content  ContentSection" v-if="this.ResultQueryRequest.PaymentGateway ==='Paypal' || form.PaymentModeOptions ==='Paypal'">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Paypal Payment </h3><br/>

                            <div class="no-print">
  

                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_self">
                                 <input type="hidden" name="cmd" value="_s-xclick">
                                 <input type="hidden" name="hosted_button_id" value="MLTPTA59RLKQN">
                                <input type="hidden" name="item_name"   v-model="form.RequestNo" >
                                <input type="hidden" name="item_number"   v-model="form.PaymntDescription">
                                <input type="hidden" name="amount"   v-model="form.AmountDue" >
                                <input type="hidden" name="handling" value="0.00">
                                <input type="hidden" name="shipping" value="0.00">
                                <input type="hidden" name="lc" value="PH">
                                <input type="hidden" name="bn" value="PP-BuyNowBF">

                                <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_target">
                                 
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="item_name"   v-model="form.RequestNo" >
                                <input type="hidden" name="item_number"   v-model="form.PaymntDescription">
                               

                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="business" value="A8387GHJF">
                                <input type="hidden" name="amount" value="20200">


                                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----"> -->

                                    <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_target">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="business" value="jsegun-facilitator-1@iristech.ph">
                                    <input type="hidden" name="lc" value="US">
                                    <input type="hidden" name="item_name" v-model="form.RequestNo">
                                    <input type="hidden" name="amount" v-model="form.AmountDue">
                                    <input type="hidden" name="currency_code" value="PHP">
                                    <input type="hidden" name="button_subtype" value="services">
                                    <input type="hidden" name="cn" value="Add special instructions to the seller:">
                                    <input type="hidden" name="no_shipping" value="0">
                                    <input type="hidden" name="rm" value="0">
                                   
                                    <input type="hidden" name="return" value="https://iris.rsi-insure.com/paypal_return">
                                    <input type="hidden" name="cancel_return"     value="https://iris.rsi-insure.com/paypal_cancel">
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest"> -->
                                       

                                    <table style="width:100%" >
                                            	<tr> <th> </th><th><br/> </th></tr>
                                            <tr>
                                                <th style="text-align:right">Transaction #</th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.RequestNo }}</td> 
                                                
                                            </tr>
											<tr>
                                                <th style="text-align:right">Amount </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.AmountDue | Peso }}</td> 
                                            </tr>
											<tr>
                                                <th style="text-align:right">Description </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.PaymntDescription  }}</td> 
											
                                                
                                            </tr>
                                            <tr>
                                                <th style="text-align:right">Email Address </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.CustEmail  }}</td> 
											
                                                
                                            </tr>
                                             <tr>
                                                <th style="text-align:right">Status</th>
												<th style="text-align:center"> :</th>
                                                <td v-if="form.PaymentPaid =='0'">Pending</td>
                                                <td v-else>{{form.PaymentPaid}}</td>  
											
                                                
                                            </tr>

											<tr> <th> </th><th><br/> </th></tr>
											<tr v-if="form.PaymentPaid =='0'">
											  <th> </th><th> </th>
                                                <th  class="no-print">  

                                                  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" @click='PaymentModePaypal()' border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                     <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              
                                                 <!-- <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                 <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->



                                           
                                                        <!-- <input type="hidden" name="add" value="1"> -->
                                                          <!-- <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif"    @click='PaymentModePaypal()'  border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                     <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              -->
                                                    
                                                    </th>
											
                                            </tr>
											
											</table>                        

                                      
                               
                          </form>
                      
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="content  ContentSection" v-if="form.PaymentMode=='PayMaya'">
            <div class="row">
                <div class="col-md-12">
                   
                </div>
            </div>
        </section>


         <section class="content  ContentSection"  v-if="this.ResultQueryRequest.PaymentGateway  === 'Dragonpay' || form.PaymentModeOptions=='Dragonpay'">
             <!-- <section class="content"> -->
             <form @submit.prevent="" > 
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Dragonpay Payment</h3><br/>
							
                                    <div class="table-responsive">
                                        <table style="width:100%" >
                                            	<tr> <th> </th><th><br/> </th></tr>
                                            <tr>
                                                <th style="text-align:right">Transaction #</th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.RequestNo }}</td> 
                                                
                                            </tr>
											<tr>
                                                <th style="text-align:right">Amount </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.AmountDue | Peso }}</td> 
                                            </tr>
											<tr>
                                                <th style="text-align:right">Description </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.PaymntDescription  }}</td> 
											
                                                
                                            </tr>
                                            <tr>
                                                <th style="text-align:right">Email Address </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.CustEmail  }}</td> 
											
                                                
                                            </tr>
                                            <tr>
                                                <th style="text-align:right">Status</th>
												<th style="text-align:center"> :</th>
                                                <td v-if="form.PaymentPaid =='0'">Pending</td>
                                                <td v-else>{{form.PaymentPaid}}</td>  
											
                                                
                                            </tr>

											<tr v-if="form.PaymentPaid =='0'"> <th> </th><th><br/> </th></tr>
											<tr>
											  <th> </th><th> </th>
                                                <th  class="no-print" > 
                                                     <button type="button" class="btn btn-warning" @click='DragonPayMode()' >Pay Now : {{form.AmountDue | peso }} </button>
                                                     </th>
											
                                            </tr>
											
											</table>
								 </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
           <!-- -----------<pre>{{ $data }}</pre>--------- -->
        </section>


             <section class="content  ContentSection"  v-if="this.ResultQueryRequest.PaymentGateway  === 'Cashier' || form.PaymentModeOptions=='Cashier'">
             <!-- <section class="content"> -->
             <form @submit.prevent="" > 
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Cashier Payment</h3><br/>
							
                                    <div class="table-responsive">
                                        <table style="width:100%" >
                                            	<tr> <th> </th><th><br/> </th></tr>
                                            <tr>
                                                <th style="text-align:right">Transaction #</th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.RequestNo }}</td> 
                                                
                                            </tr>
											<tr>
                                                <th style="text-align:right">Amount </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.AmountDue | Peso }}</td> 
                                            </tr>
											<tr>
                                                <th style="text-align:right">Description </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.PaymntDescription  }}</td> 
											
                                                
                                            </tr>
                                            <tr>
                                                <th style="text-align:right">Email Address </th>
												<th style="text-align:center"> :</th>
                                                <td>{{ form.CustEmail  }}</td> 
											
                                                
                                            </tr>
                                            <tr>
                                                <th style="text-align:right">Status</th>
												<th style="text-align:center"> :</th>
                                                <td v-if="form.PaymentPaid =='0'">Pending</td>
                                                <td v-else>{{form.PaymentPaid}}</td>  
											
                                                
                                            </tr>

											<tr v-if="form.PaymentPaid =='0'"> <th> </th><th><br/> </th></tr>
											<tr>
											  <th> </th><th> </th>
                                                <th  class="no-print" > 
                                                     <button type="button" class="btn btn-warning" @click='PaymentModeCashier()' >Pay Now : {{form.AmountDue | peso }} </button>
                                                     </th>
											
                                            </tr>
											
											</table>
								 </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
           <!-- -----------<pre>{{ $data }}</pre>--------- -->
        </section>
 
    </div>
</template>
 
<script>
  

export default {
 mounted: function(){ 

        axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
	
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
                   
        axios.get("api/URLQueryRequestModify/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
        this.LoadDataRequest(); 
        this.StartLoading();
       
    },
	 data() {
        return {
            ResultQueryRequest:{},
            UserDetails:{},

           
            
            form: new Form({
                RequestNo1:'',
                RequestNo:'',
                AmountDue:'',
                PaymntDescription:'',
                CustEmail:'',
                PaymentGateway:'',
            }),
          
        }
    },
 methods: {

    SelectModePaymentClick(){
       // alert();
        $(".ContentSection").removeClass("DisabledSection");
    },

  async StartLoading() {
              
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 2000,
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




     PaymentModePaypal() {
         // alert('PassDataPayment');
            let PassDataPayment  = this.form.RequestNo  + ";;" +  this.form.AmountDue  + ";;" +  this.form.PaymntDescription  + ";;" +  this.form.CustEmail  + ";;" +  this.form.RequestNo1 ;
               axios.get("api/PaymentModePaypal/" + PassDataPayment)
            //      let route = this.$router.resolve({path: 'api/PaymentModePaypal/' + PassDataPayment});
            //     window.open(route.href, '_self');

         

     },

      PaymentModeCashier() {
          Swal.fire({
                title: "Are you sure?",
                text: "You want to Proceed to Payment !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Pay Now...!"
            }).then(result => {
                    if (result.value) {
                         this.form.post('api/PaymentModeCashier').then(() => {
                    // Success!
                    //  Swal.fire(
                    //     'PAYMENT!',
                    //     `Successfully Payment.`,
                    //     'success'
                    // )
                 this.$router.push("/cashier_return?"+ this.form.RequestNo1);
                  
                }).catch((response) => {
                        alert(response);
                         this.$router.push("/proposal-lists-customer");

                });
                        // this.form.post("api/PaymentModeCashier")
                    }else{
                          this.$router.push("/proposal-lists-customer");
                    }
            });	
         

     },
  

     DragonPayMode() {
         //   let PassID         = this.form.RequestNo1 ;
            let PassDataPayment  = this.form.RequestNo  + ";;" +  this.form.AmountDue  + ";;" +  this.form.PaymntDescription  + ";;" +  this.form.CustEmail  + ";;" +  this.form.RequestNo1 ;
                //alert(PassDataPayment);
			Swal.fire({
                title: "Are you sure?",
                text: "You want to Proceed to Payment !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Pay Now...!"
            }).then(result => {
                // Send request to the server
			
                if (result.value) {
					
                              //this.$router.push('/Customer-Issuance?' + PassID); 
                                let route = this.$router.resolve({path: 'api/PaymentMode/' + PassDataPayment});
                                 window.open(route.href, '_self');
                                 //console.log(PassDataPayment);


                }
            });		
     },
     LoadDataRequest() {
        this.RetrieveTimeInterval = setInterval(() => {
                   
                     this.form.RequestNo1           = this.ResultQueryRequest.RequestNo;
                     this.form.RequestNo            = this.ResultQueryRequest.RequestNo + "-" + this.ResultQueryRequest.AcceptedOption;
                     this.form.PaymentMode          = this.ResultQueryRequest.PaymentGateway; 
                     this.form.PaymentPaid          = this.ResultQueryRequest.PaymentMode;
                   
                    this.form.PaymntDescription     = "Payment for Denomination " + this.ResultQueryRequest.SubLinesName + " under the name " +  this.ResultQueryRequest.CName  + " with Plate No. " + this.ResultQueryRequest.PlateNumber;
                    this.form.AmountDue             = this.ResultQueryRequest.AmountDue;
                    this.form.CustEmail             = this.ResultQueryRequest.RequestNo;
                     //this.form.PaymentGateway            = this.ResultQueryRequest.RequestNo;
         },200)   
			        this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval); 
                 },2000) 
    },
		
 },
 
 

}
</script>