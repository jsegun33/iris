<template>
    <div id="MainPage">
        <!-- <section class="content-header">
            <h1>
                 Lists of Accepted Proposal
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section> -->

     
        <section class="content DisabledSection ContentSection"  v-if="this.RequestQuotations === 'NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
      </section>


     
         <section class="content DisabledSection ContentSection"   v-if="this.RequestQuotations !== 'NO RECORD FOUND'">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">List of all Request Proposals / Quotations</h3>

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
                                <th>Request No.</th>
                                <th>Policy No.</th>
                                <th>Name</th>
                                <th>Plate Number</th>
                                <th>Type</th>
                                
                                <th>Amount Due</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.RequestNo }}</td>
                                <td>{{ RequestQuotationss.PolicyNo }}</td>
                                <td>{{ RequestQuotationss.CName}} </td>
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.RequestType}}</td>
                                
                                <td>{{ RequestQuotationss.AmountDue | Peso }}</td>                                
                                <td>
                                    <span class="label label-success" v-if="RequestQuotationss.PaymentMode ==='Paid'">{{ RequestQuotationss.PaymentMode }} thru {{ RequestQuotationss.PaymentGateway }}</span>
                                    <span class="label label-danger" v-else>Processing thru {{ RequestQuotationss.PaymentGateway }}</span>
                                 </td>
                                <td>
                                    <!-- <a v-bind:href="'/AcceptedView?'+ RequestQuotationss.RequestNo" class="btn btn-info">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a>  -->
                                    <a v-bind:href="'/Accepted?'+ RequestQuotationss.RequestNo" @click="SaveCocafDetails(RequestQuotationss)" class="btn btn-info" style="text-decoration: none;">
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
       <!--------- <pre>{{ $data }}</pre>-------->
       

      
    </div>
</template>
		



<script>

export default {
     mounted() {
            console.log('Component mounted.')
            this.loadRequestQuotation();
            this.StartLoading();
        },
         data() {
            return {
             
                editmode: false,
                RequestQuotations: {},
                
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
                    },100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                     $(".ContentSection").removeClass("DisabledSection");
                }
                }).then((result) => {
               
                })
              
            },


            getResults(page = 1) {
                axios.get('api/GetRequestQuotationAccepted?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
                  axios.get("api/GetRequestQuotationAccepted"  ).then(({ data }) => (this.RequestQuotations = data));
           },
            
            SaveCocafDetails(RequestQuotationss) {
                axios.get("api/SaveCocafDetails/" + RequestQuotationss.RequestNo)
               
            },
         
          },

     
    
}
</script>