<template>
    <div>


       

         <!-- <section class="content" v-if="form.PaymentGateway === 'Dragonpay'"> -->
             <section class="content">
           
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h1 >SUCCESS </h1><br/>

                                
                                    <img src="/img/check-big.png" alt="RSILogo" id="quoteslogo" style="width:150px;">
							  
                                    <h1>Thank You!</h1>
                                    <h5>You are successfully paid. 
                                        <br>
                                        It has been a pleasure doing business with you. We wish you the best of luck.
                                    </h5>
                                    

                        </div>
                    </div>
                </div>
            </div>
           
           <!-- -----------<pre>{{ $data }}</pre>--------- -->
        </section>



    </div>
</template>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous"></script>
 
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
                    this.form.RequestNo          =this.ResultQueryRequest.RequestNo + "-" + this.ResultQueryRequest.AcceptedOption;
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