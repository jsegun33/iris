<template>
    <div id="MainPage">

         <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->

 
     <section class="content DisabledSection ContentSection" v-if="this.RequestQuotations === 'NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
    </section>
         <section class="content DisabledSection ContentSection" v-if="this.RequestQuotations !== 'NO RECORD FOUND'" >
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Lists of Paid Policy /ies </h3>

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
                                <th>Policy No</th>
                                <th>Plate Number</th>
                                <th>Name</th>
                                <th>Amount Due </th>
                                <th>Type </th>
                                <th>Payment </th>
                                <th>Status </th>
                                 <th> </th>
                               
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.PolicyNo  }}</td>
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.CName }}  </td>
                                 <td>{{ RequestQuotationss.AmountDue | peso  }}</td>
                                <td>{{ RequestQuotationss.RequestType  }}</td>
                                <td>
                                    <span class="label label-success" v-if="RequestQuotationss.PaymentMode ==='Paid'">{{ RequestQuotationss.PaymentMode }} thru {{ RequestQuotationss.PaymentGateway }}</span>
                                    <span class="label label-danger" v-else>Processing thru {{ RequestQuotationss.PaymentGateway }}</span>
                                 </td>
                                 <td> 
                                     <span class="label label-warning" v-if=" RequestQuotationss.Status  === 'Approved'" >{{ RequestQuotationss.Status  }}</span>
                                     <span class="label label-danger" v-else >{{ RequestQuotationss.Status  }}</span>
                                 </td>
                                
                               <td>
                                    <a v-bind:href="'/PolicyPayment?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
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
               this.getResults();
              this.StartLoading();
			 
        },
         data() {
            return {
             
                editmode: false,
				UserDetails: {},
                RequestQuotations1: {},
				RetrieveTimeInterval: null,
                 RequestQuotations: {},
               TimeLoading1:null,
            TimeLoading:null,
            TimeLoadingInternet:null,
            ConnectionStatus:'',


                //counter:1,
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
                axios.get('api/PaidPolicies?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
                        axios.get("api/PaidPolicies").then(({ data }) => (this.RequestQuotations = data));
              
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
    
}
</script>