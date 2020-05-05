<template>
    <div>
        <section class="content-header">
            <h1>
                 Lists Approver Quotation
                <small>Table of Quoatation</small>
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
                </div>

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dataTables_length" id="example1_length">
                                    <label class="pull-left">Show: 
                                        <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                            <option value="10">Client</option>
                                            <option value="25">Agent</option>
                                            <option value="50">Public</option>
                                            <option value="100">Employee</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="example1_filter" class="dataTables_filter">
                                    <label class="pull-right">Search:
                                        <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                             <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" style="width: 297px;" aria-sort="ascending">Plate Number</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Denomination</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">Quotation #</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" class="odd"   v-for="RequestQuotationss in RequestQuotations" :key="RequestQuotationss._id">
                                               <!-- <td class="sorting_1">{{ counter++ }}</td> -->
                                            
                                            <td class="sorting_1">{{ RequestQuotationss.PlateNumber }}</td>
                                            <td>{{ RequestQuotationss.Denomination }}</td>
                                            <td>{{ RequestQuotationss.FirstName}}  {{ RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                            <td>{{ RequestQuotationss.RequestNo + '-' + RequestQuotationss.OptionNo }}</td>
                                            
                                            <td>{{ RequestQuotationss.Status }}  </td>
                                            <td>
                                               <a v-bind:href="'/UWApproverView?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
                                                   <i class="fa fa-eye"></i> 
                                                   View
                                              </a> 
                                               
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Showing 1 to 10 of 57 entries
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <pagination 
                                        class="pagination pull-right" 
                                        :data="RequestQuotations" 
                                        @pagination-change-page="getResults">
                                        <span slot="prev-nav">&lt; Previous</span>
                                        <span slot="next-nav">Next &gt;</span>
                                    </pagination>
                                </div>
                            </div>
                        </div>
                    </div>
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
            //this.getResults();
            // axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
             axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
              
        },
         data() {
            return {
              
                url: '/proposal?2019-0001',
                editmode: false,
                RequestQuotations: {},
               UserDetails : {},
               
                
            }
        },


        methods: {
            getResults(page = 1) {
                axios.get('api/GetRequestProposalApprover?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
               this.RetrieveTimeInterval = setInterval(() => {
                        let PassID = this.UserDetails.AccountNo;
                        //alert(PassID);
                        axios.get("api/GetRequestProposalApprover/" + PassID).then(({ data }) => (this.RequestQuotations = data));
                 }, 1000)

                   this.RetrieveTimeInterval2 = setInterval(() => {
                            clearInterval(this.RetrieveTimeInterval);  
                    },3000) 
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