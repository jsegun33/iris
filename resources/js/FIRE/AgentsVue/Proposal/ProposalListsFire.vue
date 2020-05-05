<template>
    <div>
        <!-- <section class="content-header">
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
      -->
         
            
       
        <section class="content">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><strong>FIRE List of all Request Proposals / Quotations</strong></h3>

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
                                <th>Business Type</th>
                                <th>Name</th>
                                <th>Market Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.RequestNo }}</td>    
                                <td>{{ RequestQuotationss.BusinessType }}</td>                            
                                <td>{{ RequestQuotationss.CName}} </td>
                                <td>{{ RequestQuotationss.MarketValue | Peso }}</td> 
                             
                                <td>
                                    <span class="label label-warning" v-if="RequestQuotationss.status  == 1"> Processing</span>
                                     <span class="label label-warning" v-if="RequestQuotationss.status  != 1">{{ RequestQuotationss.status  }}</span>
                                </td>
                               
                                <td>
                                    <router-link :to="'/ProposalOptions?'+ RequestQuotationss.RequestNo"   class="btn btn-success" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        Accept
                                    </router-link>
                                    <router-link  :to="'/proposal-view-fire?'+ RequestQuotationss.RequestNo"   class="btn btn-info"  style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </router-link>

                                     <router-link  :to="'/Customer-Issuance?'+ RequestQuotationss.RequestNo" class="btn btn-warning"  style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                       Policy
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                      <pagination :data="RequestQuotationsPaging" :limit="2" @pagination-change-page="getResults" class="pull-right">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>

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
           this.getResults();
            axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
            
            //this.loadRequestQuotation();
          
        },
         data() {
            return {
            
                RequestQuotations: {},
                RequestQuotationsPaging: {},
                UserDetails:{},
                //counter:1,
         
                    form: new Form({
                       // UserLastName:[],
                        
                    }),
             }

        },


        methods: {
              getResults(page = 1) {
                axios.get('api/FireGetUserRequestPaging?page=' + page).then(response => {
                    this.RequestQuotationsPaging = response.data;
                });
            },
         
          loadRequestQuotation() {
              this.RetrieveTimeInterval = setInterval(() => {
                        let PassNO            = this.UserDetails.AccountNo;
                        let PassEmail         = this.UserDetails.email;	    		
                        let NewPassID         = PassNO.trim() +  ';;' +  PassNO.trim();  
                        axios.get("api/FireGetUserRequest/" + NewPassID).then(({ data }) => (this.RequestQuotations = data));
                 
                 
                 }, 1000)

                   this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                    },3000) 
            },
           
         
          },
           created() {
                
                    //let response = await axios.get('/GetUserData')
                    //this.UserDetails = response.data;

                 this.loadRequestQuotation();
                        Fire.$on('AfterCreate',() => {
                            this.loadRequestQuotation();
                        });
               
                 
                 
                },
          
         
    
}
</script>