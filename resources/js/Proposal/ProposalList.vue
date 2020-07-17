<template>
    <div>
        <section class="content-header">
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
                                <th>Request #</th>
                                <th>Plate Number</th>
                                <th>Denomination</th>
                                <th>Name</th>
                                <th>Expiration</th>
                                
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.RequestNo }}</td>
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.Denomination }}</td>
                                <td>{{ RequestQuotationss.FirstName}}  {{RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                
                               
                                <td>{{ RequestQuotationss.QuoteExpiry | DateFormat}} <br/>
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

 
//import udmodal  from './Proposal'


export default {


     mounted() {
            console.log('Component mounted.')
            this.getResults();
        },
         data() {
            return {
                editmode: false,
                RequestQuotations: {},
                //counter:1,
               
                
            }
        },


        methods: {
            getResults(page = 1) {
                axios.get('api/GetRequestQuotation?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
                axios.get("api/GetRequestQuotation"  ).then(({ data }) => (this.RequestQuotations = data));
            },
            UpdateRequest(RequestQuotationss) {
              let  PassID  =RequestQuotationss.RequestNo;
                axios.get("api/UpdateRequest/" + PassID   ).then(({ data }) => (this.RequestQuotations = data));
               // alert(RequestQuotationss.RequestNo);
            },
         
          },

          
           created() {
               
            this.loadRequestQuotation();
            Fire.$on('AfterCreate',() => {
                this.loadRequestQuotation();
            });
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