<template>
    <div>
        <section class="content-header">
            <h1>
                 Lists of Accepted Proposal
                <small>Table of Proposal</small>
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
                                <th>Plate Number</th>
                                <th>Denomination</th>
                                <th>Name</th>
                                <th>TIN Number</th>
                                <th>Total Premium</th>
                                <th>Total Charges</th>
                                <th>Amount Due</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.Denomination }}</td>
                                <td>{{ RequestQuotationss.FirstName}}  {{RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                <td>{{ RequestQuotationss.TINNumber }}</td>
                                <td>{{ RequestQuotationss.PremiumAmount | Peso }}</td>
                                <td>{{ RequestQuotationss.TotalCharges | Peso }}</td>
                                <td>{{ RequestQuotationss.AmountDue | Peso }}</td>                                
                                <td><span class="label label-success">{{ RequestQuotationss.Status }}</span></td>
                                <td>
                                    <!-- <a v-bind:href="'/AcceptedView?'+ RequestQuotationss.RequestNo" class="btn btn-info">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a>  -->
                                    <a v-bind:href="'/Accepted?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
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

 
//import udmodal  from './Proposal'


export default {


     mounted() {
            console.log('Component mounted.')
            this.getResults();
        },
         data() {
            return {
              
                url: '/proposal?2019-0001',
                editmode: false,
                RequestQuotations: {},
                //counter:1,
               
                
            }
        },


        methods: {
            getResults(page = 1) {
                axios.get('api/GetRequestQuotationAccepted?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
                axios.get("api/GetRequestQuotationAccepted"  ).then(({ data }) => (this.RequestQuotations = data));
            },
            ViewRequest() {
             window.open("request"); 
               //window.location.hostname + '/request' 
               
            },
         
          },

          
           created() {
            this.loadRequestQuotation();
            Fire.$on('AfterCreate',() => {
                this.loadRequestQuotation();
            });


        }
    
}
</script>