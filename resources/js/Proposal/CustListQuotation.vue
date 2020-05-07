<template>
    <div>
        <section class="content-header">
            <h1>
                 Lists Customer Quotation
                <small>Table of Quotation</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section>
     
         
            
       
        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>List of all Request Proposals / Quotations</strong></h3>

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

                <div class="box-body table-responsive">
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
                                <td>{{ RequestQuotationss.QuoteExpiry | DateFormat}}   <br/> 
                                        <span class="label label-danger"  v-if="RequestQuotationss.QuoteExpiryRemarks == 'Expired'">{{ RequestQuotationss.QuoteExpiryRemarks}}</span>
                                        <br/> <span class="label label-primary"  v-if="RequestQuotationss.CustMessage != null ">{{ RequestQuotationss.CustMessage}}</span>
                                </td>
                                <td>
                                    <span class="label label-warning">{{ RequestQuotationss.Status  }}</span><br/>
                                     <span class="label label-danger" v-if="RequestQuotationss.PaymentMode != '0'">{{ RequestQuotationss.PaymentMode  }}</span>
                                    
                                </td>
                               
                                <td>
                                    <router-link :to="'/ProposalOptions?'+ RequestQuotationss.RequestNo" v-if=" RequestQuotationss.RequestModify > 0  || RequestQuotationss.OktoAccept  == 1"  class="btn btn-success" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
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

                                     <router-link  :to="'/Customer-Issuance?'+ RequestQuotationss.RequestNo" v-if="RequestQuotationss.PaymentMode != '0' && RequestQuotationss.PolicyApproverSignature != ' '"    class="btn btn-warning"  style="text-decoration: none;">
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
            //this.getResults();
           axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
          // this.loadRequestQuotation();
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
                //counter:1,
         
                    form: new Form({
                       // UserLastName:[],
                        
                    }),
             }

        },


        methods: {

         loadRequestQuotation() {
         this.RetrieveTimeInterval = setInterval(() => {   
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
             }, 1000)
             this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                      },3000) 
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