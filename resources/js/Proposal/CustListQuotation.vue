<template>
    <div id="MainPage" >
      
         <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->


     <section class="content DisabledSection ContentSection" v-if="this.RequestQuotations === 'NO RECORD FOUND'">
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
    </section>
         
            
       
        <section class="content DisabledSection ContentSection" v-if="this.RequestQuotations !== 'NO RECORD FOUND'">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>List Request Proposals / Quotations</strong></h3><br/>
                   
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive" >
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Request #</th>
                                <th>Plate Number</th>
                                <th>Denomination</th>
                                <th>Name</th>
                                <th>Amount Due</th>
                                <th>Expiration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.RequestNo }}</td>
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.Denomination }}</td>
                                <td>{{ RequestQuotationss.FirstName}}  {{RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                <td>{{ RequestQuotationss.AmountDue | Peso }}</td>
                                <td>
                                        <small v-if="RequestQuotationss.QuoteExpiry !== '0'">{{ RequestQuotationss.QuoteExpiry | DateFormat}}  </small>  <br/> 
                                        <span class="label label-danger"  v-if="RequestQuotationss.QuoteExpiryRemarks == 'Expired'">{{ RequestQuotationss.QuoteExpiryRemarks}}</span>
                                        <br/> <span class="label label-primary"  v-if="RequestQuotationss.CustMessage != null ">{{ RequestQuotationss.CustMessage}}</span>
                                </td>
                                <td>
                                    <span class="label label-warning">{{ RequestQuotationss.Status  }}</span><br/>
                                     <span class="label label-danger" v-if="RequestQuotationss.PaymentMode != '0'">{{ RequestQuotationss.PaymentMode  }}</span>
                                    
                                </td>
                               
                                <td @mouseover="GetResquestNo(RequestQuotationss)">
                                    <router-link :to="'/ProposalOptions?'+ RequestQuotationss.RequestNo" v-if="RequestQuotationss.RequestModify > 0  || RequestQuotationss.OktoAccept  == 1"  class="btn btn-success" style="text-decoration: none;">
                                        <i class="fa fa-eye"  > </i> 
                                        Accept
                                    </router-link>
                                    <router-link  :to="'/CustAcceptedView?'+ RequestQuotationss.RequestNo"  v-if="RequestQuotationss.AcceptedOption > 0 || RequestQuotationss.RequestModify > 0" class="btn btn-info"  style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </router-link>
                                    <router-link  :to="'/Payment-Mode?'+ RequestQuotationss.RequestNo" v-if="RequestQuotationss.PaymentMode !== 'Paid' && RequestQuotationss.AcceptedOption > 0"    class="btn btn-danger"  style="text-decoration: none;">
                                        <i class="fa fa-money"></i> 
                                       Pay
                                    </router-link>

                                     <router-link  :to="'/Customer-Issuance?'+ RequestQuotationss.RequestNo" v-if="RequestQuotationss.Status == 'Approved'"    class="btn btn-warning"  style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                       Policy
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <!-- --------<pre>{{ $data }}</pre>----- -->
     
      
    </div>
</template>
		



<script>

 
//import udmodal  from './Proposal'


export default {


     mounted() {
            console.log('Component mounted.')
            this.StartLoading();
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
        
        },
         data() {
            return {
                editmode: false,
                RequestQuotations: {},
                UserDetails:{},
                RetrieveTimeInterval:null,
                RetrieveTimeInterval2:null,
                 RetrieveTimeInterva3:null,
                RetrieveTimeInterval4:null,

            
               
               
               IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:47,
                 timer_is_on:0,
         
                    form: new Form({
                       // UserLastName:[],
                       AcctNo: '',
                       RequestNo: '',
                        
                    }),
             }

        },


        methods: {
           

            GetResquestNo(RequestQuotationss){
                this.form.RequestNo = RequestQuotationss.RequestNo;
                //alert(RequestQuotationss.RequestNo);

            },

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


         loadRequestQuotation() {
         this.RetrieveTimeInterval = setInterval(() => {   
             

                this.form.AcctNo = this.UserDetails.AccountNo;
               let PassNO            = this.UserDetails.AccountNo;
                let PassEmail         = this.UserDetails.email;	    		
                let NewPassID         = PassNO.trim() ; 
           //alert(NewPassID);
            axios.get("api/GetRequestQuotationCustomer/" + NewPassID).then(({ data }) => {
                    (this.RequestQuotations = data)

                  }).catch((response) => {
                    //    alert(response  + " pls. try to refresh ");
                    //     this.RetrieveTimeInterval3 = setInterval(() => {
                    //           this.$router.go() ;
                    //    },10000) 

                });
             }, 200)
             this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                          
                      },2000) 
         } 

            //     let PassNO            = this.UserDetails.AccountNo;
            //     let PassEmail         = this.UserDetails.email;	    		
            //     let NewPassID         = PassNO.trim() +  ';;' +  PassNO.trim(); 

            //  axios.get('api/GetRequestQuotationCustomer/'+ NewPassID).then(() => {
            //       this.RequestQuotations = data
            //          Swal.fire(
            //             ' Successful! ',
            //             `Quotation Accepted.`,
            //             'success'
            //         )
               
                //   this.$router.push('/CustAcceptedView?' + PassID); 
                //   let route = this.$router.resolve({path: '/Payment-Mode?' + PassID});
                //   window.open(route.href, '_blank');
                  
                 
                // }).catch((response) => {
                //         alert(response);

                // });
        //  }



            // this.RetrieveTimeInterval = setInterval(() => {
            //             let PassNO            = this.UserDetails.AccountNo;
            //             let PassEmail         = this.UserDetails.email;	    		
            //             let NewPassID         = PassNO.trim() +  ';;' +  PassNO.trim();  
            //             axios.get("api/GetRequestQuotationCustomer/" + NewPassID).then(({ data }) => (this.RequestQuotations = data));
                
                 
            //      }, 1000)

            //        this.RetrieveTimeInterval2 = setInterval(() => {
            //                 clearInterval(this.RetrieveTimeInterval);  
            //          },5000) 
            // },
           
         
          },
            created() {
            this.loadRequestQuotation();
            Fire.$on('AfterCreate',() => {
                this.loadRequestQuotation();
            });
        },   
          
         
    
}
</script>