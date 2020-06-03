<template>
    <div id="MainPage">
        <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->


        <section class="content"  >           
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header" style="text-align:center;">
                            <!-- <h1 >Your Payment in {{ form.PaymentMode }} </h1><br/> -->
                                <h1 >Your Payment </h1><br/>
                            <img src="/img/x-big.jpg" alt="RSILogo" id="quoteslogo" style="width:150px;">
                            
                            <h1>was cancelled</h1>
<!--                             
                            <br>{{ $data.form.PaymntDescription }}
                            <br>with amount of {{ form.AmountDue | Peso }} 
                            <br> -->
                            <!-- <router-link  :to="'/Customer-Issuance?'+ $data.form.RequestNo1 " style="text-decoration: none;">
                                You can check your policy here for download.
                            </router-link>                                -->
                        </div>
                    </div>
                </div>
            </div>
           
           <!-- -----------<pre>
               {{ $data}}
               {{ $data.UserDetails.CName }}
               </pre>--------- -->
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
    //  this.StartLoading();

    //     axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
	
    //                 let uri         = window.location.href.split('?');
    //                 let PassID      = uri[1].trim();
    //      axios.get("api/URLQueryRequestModify/" + PassID ) .then(({ data }) => (this.ResultQueryRequest = data)  );
    
    //      this.LoadDataRequest(); 
       
    },
	 data() {
        return {
            // ResultQueryRequest:{},
            // UserDetails:{},
            // TimeLoading1:null,
            // TimeLoading:null,
            // TimeLoadingInternet:null,
            // ConnectionStatus:'',

            
            // form: new Form({
            //     RequestNo1:'',
            //     RequestNo:'',
            //     AmountDue:'',
            //     PaymntDescription:'',
            //     CustEmail:'',
            //     PaymentGateway:'',
            //     PaymentMode:'',
            //     AcctNo:'',

            // }),

          
          
        }
    },


 methods: {
    //    async StartLoading() {
              
    //            let timerInterval
    //             await Swal.fire({
    //             title: '<h3>Loading Data</h3>',
    //             text: 'Please wait...',
    //             timer: 5000,
    //             timerProgressBar: true,
    //             icon: 'info',
    //             timerProgressBarColor:"#00a65a",
             
    //             allowOutsideClick: false,
    //             allowEscapeKey: false,
    //             onBeforeOpen: () => {
    //                 Swal.showLoading()
    //                 timerInterval = setInterval(() => {
    //                 const content = Swal.getContent()
    //                 if (content) {
    //                     const b = content.querySelector('b')
    //                     if (b) {
    //                     b.textContent = Swal.getTimerLeft()
    //                     }
    //                 }
    //                 }, 100)
    //             },
    //             onClose: () => {
    //                 clearInterval(timerInterval)
    //                  $(".ContentSection").removeClass("DisabledSection");
    //             }
    //             }).then((result) => {
               
    //             })
              
    //         },

    
    //  LoadDataRequest() {
    //     this.RetrieveTimeInterval = setInterval(() => {
                       
    //                  this.form.RequestNo1         = this.ResultQueryRequest.RequestNo;
    //                  this.form.AcctNo             = this.ResultQueryRequest.CustAcctNO;
    //                 this.form.RequestNo          =this.ResultQueryRequest.RequestNo + "-" + this.ResultQueryRequest.AcceptedOption;
    //                this.form.PaymentMode       =this.ResultQueryRequest.PaymentGateway;
    //                 this.form.PaymntDescription   = "Payment for Denomination " + this.ResultQueryRequest.SubLinesName + " under the name " +  this.ResultQueryRequest.CName  + " with Plate No. " + this.ResultQueryRequest.PlateNumber;
    //                 this.form.AmountDue             =this.ResultQueryRequest.AmountDue;
    //                 this.form.CustEmail              = this.ResultQueryRequest.RequestNo;
    //                  this.form.PaymentGateway            = this.ResultQueryRequest.RequestNo;
    //      },1000)   
	// 		this.RetrieveTimeInterval2 = setInterval(() => {
    //                         clearInterval(this.RetrieveTimeInterval);  
                         
    //              },3000) 
                   
                           
     
    // },
		
 },
 
 
   

 
 

}
</script>