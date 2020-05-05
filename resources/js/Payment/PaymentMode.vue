<template>
    <div>
        <section class="content" v-if="form.PaymentMode=='Paypal'">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Paypal Payment</h3><br/>

                            <div class="no-print">
                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business"  value="aa-facilitator@rsi-insure.com">
                                <input type="hidden" name="item_name"   v-model="form.RequestNo" >
                                <input type="hidden" name="item_number"   v-model="form.PaymntDescription">
                                <input type="hidden"   name="amount"  v-model="form.amount" >
                                <input type="hidden" name="handling" value="0.00">
                                <input type="hidden" name="shipping" value="0.00">
                                <input type="hidden" name="lc" value="PH">
                                <input type="hidden" name="bn" value="PP-BuyNowBF">

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

											<tr> <th> </th><th><br/> </th></tr>
											<tr>
											  <th> </th><th> </th>
                                                <th  class="no-print">  
                                              <input type="image" img :src="'https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif'" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                             
                                    <input type="hidden" name="add" value="1">
                                                    
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



        <section class="content" v-if="form.PaymentMode=='PayMaya'">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Paymaya Payment</h3><br/>

                            <div class="no-print">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="seller@business.com">
                                <input type="hidden" name="item_name" value="testing_handling">
                                <input type="hidden" name="item_number" value="test">
                                <input type="hidden" name="amount" value="0.01">
                                <input type="hidden" name="handling" value="0.01">
                                <input type="hidden" name="shipping" value="0.01">
                                <input type="hidden" name="lc" value="US">
                                <input type="hidden" name="bn" value="PP-BuyNowBF">
                                <input type="image" img :src="'https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif'" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                             
                                    <input type="hidden" name="add" value="1">
                          
                          </form>


                   

                      
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


         <!-- <section class="content" v-if="form.PaymentGateway === 'Dragonpay'"> -->
             <section class="content">
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

											<tr> <th> </th><th><br/> </th></tr>
											<tr>
											  <th> </th><th> </th>
                                                <th  class="no-print"> 
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
  

     DragonPayMode() {
         //   let PassID         = this.form.RequestNo1 ;
            let PassDataPayment  = this.form.RequestNo  + ";;" +  this.form.AmountDue  + ";;" +  this.form.PaymntDescription  + ";;" +  this.form.CustEmail  + ";;" +  this.form.RequestNo1 ;
              //                alert(PassDataPayment);
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
                                 window.open(route.href, '_blank');
                                 console.log(PassDataPayment);
                }
            });		
     },
     LoadDataRequest() {
        this.RetrieveTimeInterval = setInterval(() => {
     //   alert(this.ResultQueryRequest.AccountNo);
                     this.form.RequestNo1         = this.ResultQueryRequest.RequestNo;
                    this.form.RequestNo          =this.ResultQueryRequest.RequestNo + this.ResultQueryRequest.AcceptedOption;
                   this.form.PaymentMode       =this.ResultQueryRequest.PaymentGateway;
                    this.form.PaymntDescription   = "Payment for Denomination " + this.ResultQueryRequest.SubLinesName + " under the name " +  this.ResultQueryRequest.CName  + " with Plate No. " + this.ResultQueryRequest.PlateNumber;
                    this.form.AmountDue             =this.ResultQueryRequest.AmountDue;
                    this.form.CustEmail              = this.ResultQueryRequest.RequestNo;
                     this.form.PaymentGateway            = this.ResultQueryRequest.RequestNo;
         },1000)   
			this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                 },5000) 
                   
                           
     
    },
		
 },
 
 
   

 
 

}
</script>