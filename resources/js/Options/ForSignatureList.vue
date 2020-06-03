<template>
    <div id="MainPage">
        <!-- <section class="content-header">
            <h1>
                Proposal Lists
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Issuance / Proposal</a></li>
                <li class="active">Proposal List-For Signature</li>
            </ol>
        </section> -->

        <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->

          <section class="content DisabledSection ContentSection"   v-if="this.RequestQuotations ==='NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" > {{ this.RequestQuotations  }}</big></h1>
                </div>
         </section>

     
         <section class="content DisabledSection ContentSection" v-if="this.RequestQuotations !=='NO RECORD FOUND'" >
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">List of all Request Issuance / Proposal</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                            <!-- <button class="btn btn-primary pull-right" @click="newModal">
                                <i class="fa fa-plus-circle"></i>
                                Add New
                            </button> -->
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Plate Number</th>
                                <th>Policy #</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Amount Due</th>
                               
                                <th>Expiration</th>
                                <th>Cust. Message</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.PolicyNo  }}</td>
                                <td>{{ RequestQuotationss.CName}} </td>
                                
                                <td>{{ RequestQuotationss.RequestType }}</td>
                                <td>{{ RequestQuotationss.AmountDue | Peso }}</td>
                               
                                <td>{{ RequestQuotationss.QuoteExpiry | DateFormat}} <br/> {{ RequestQuotationss.QuoteExpiryRemarks}} </td>
                                <td>{{ RequestQuotationss.CustMessage }}  <br/> {{ RequestQuotationss.CustMessageDate}} </td>
                               <td>
                                    <span class="label label-success" v-if="RequestQuotationss.PaymentMode ==='Paid'">{{ RequestQuotationss.PaymentMode }} thru {{ RequestQuotationss.PaymentGateway }}</span>
                                    <span class="label label-danger" v-else>Processing thru {{ RequestQuotationss.PaymentGateway }}</span>
                                 </td>
                                <td>
                                    <a v-bind:href="'/ViewForSignature?'+ RequestQuotationss.RequestNo" class="btn btn-warning" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        List Quotation
                                    </a> 
                                     <a v-bind:href="'/final-issuance?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a> 
                                  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="RequestQuotations" :limit="2" @pagination-change-page="getResults" class="pull-right">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </section>
     <!--------------<pre>{{ $data }}</pre>----------->
    
      
    </div>
</template>
		



<script>

 
//import udmodal  from './Proposal'


export default {


     mounted: function() {
            console.log('Component mounted.')
			  axios.get("GetUserData").then(({ data }) => (this.UserDetails = data));
              this.loadRequestQuotation();
              this.StartLoading();
        },
         data() {
            return {
              
             
                editmode: false,
				UserDetails: {},
                RequestQuotations1: {},
				RetrieveTimeInterval: null,
				 RequestQuotations: {},
               ConnectionStatus:'',


               form: new Form({
					AccountNo: "",
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

            getResults(page = 1) {
                axios.get('api/GetIssuanceForSignaturePaging?page=' + page).then(response => {
                    this.RequestQuotations1 = response.data;
                });
            },
            loadRequestQuotation() {
				this.RetrieveTimeInterval = setInterval(() => {
					let PassID = this.UserDetails.AccountNo;  //"2020-0008";
						axios.get("api/GetIssuanceForSignature/" + PassID).then(({ data }) => (this.RequestQuotations = data));
			},200);
			
			 this.RetrieveTimeInterval2 = setInterval(() => {
								clearInterval(this.RetrieveTimeInterval);
            },2000);
				
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