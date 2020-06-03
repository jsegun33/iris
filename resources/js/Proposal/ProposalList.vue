<template>
    <div id="MainPage"  >
        <!-- <section class="content-header">
            <h1>
                Proposal Lists
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section>
      -->

      <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->



      <section class="content DisabledSection ContentSection" id="ContentSection"  v-if="this.RequestQuotations === 'NO RECORD FOUND'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" > {{ this.RequestQuotations  }}</big></h1>
                </div>
         </section>


         <section class="content DisabledSection ContentSection"  v-if="this.RequestQuotations !== 'NO RECORD FOUND'">
            <div class="box box-success">
            <!-- <div class="box-header"> -->
              <h3 class="box-title">Request List</h3>
       
       
                <div class="box-body table-responsive" >
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Request #</th>
                                 <th>Type</th>
                                <th>Plate Number</th>
                                <th>Assign CRD</th>
                                <th>Name</th>
                                <th>Expiration</th>
                                
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.RequestNo }}</td>
                                <td>{{ RequestQuotationss.RequestType }}</td>
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.AssignCRD }}</td>
                                <td>{{ RequestQuotationss.FirstName}}  {{RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                
                               
                                <td>
                                      <small v-if="RequestQuotationss.QuoteExpiry !== '0'">  {{ RequestQuotationss.QuoteExpiry | DateFormat}} </small><br/>
                                        <span class="label label-danger"  v-if="RequestQuotationss.QuoteExpiryRemarks == 'Expired'">{{ RequestQuotationss.QuoteExpiryRemarks}}</span>
                                        <br/> <span class="label label-primary"  v-if="RequestQuotationss.CustMessage != null ">{{ RequestQuotationss.CustMessage}}</span>
                          
                                
                                </td>
                                
                                <td><span class="label label-warning">{{ RequestQuotationss.Status }}</span></td>
                              
                                <td>
                                    <a v-bind:href="'/ViewQuoteList?'+ RequestQuotationss.RequestNo" @click="UpdateRequest(RequestQuotationss)" class="btn btn-info" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a> 
                                    <a  v-bind:href="'/proposal-form?'+ RequestQuotationss.RequestNo" @click="UpdateRequest(RequestQuotationss)" class="btn btn-primary" style="text-decoration: none;">
                                        <i class="fa fa-edit"></i> 
                                        Edit
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

$(document).ready(function() {
     

 });   
export default {


     mounted() {
           this.StartLoading();
             axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
            console.log('Component mounted.')
            this.getResults();
           
              this.loadRequestQuotation();
        },
         data() {
            return {
                UserDetails:{},
                 TimeLoading1:null,
         
                 

                editmode: false,
                RequestQuotations: {},


                form: new Form({
                CustAcctNO: "",
                RoleAlias: "",
                })
                
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
                axios.get('api/GetRequestQuotation?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
                this.RetrieveTimeInterval = setInterval(() => {  
                    this.form.CustAcctNO = this.UserDetails.AccountNo;
                    this.form.RoleAlias = this.UserDetails.RoleAlias;
                     
                     this.form.post("api/GetRequestQuotation"  ).then(({ data }) => (this.RequestQuotations = data));
                 }, 200);
				 
				  this.RetrieveTimeInterval2 = setInterval(() => {
                                clearInterval(this.RetrieveTimeInterval);
                }, 3000);

            },


            
            UpdateRequest(RequestQuotationss) {
              let  PassID  =RequestQuotationss.RequestNo;
                axios.get("api/UpdateRequest/" + PassID   ).then(({ data }) => (this.RequestQuotations = data));
               // alert(RequestQuotationss.RequestNo);
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

