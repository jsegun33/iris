<template>
    <div>
        <!-- <section class="content-header">
            <h1>
                 Lists Approver Quotation
                <small>Table of Quoatation</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section> -->

         <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section>

         <section class="content" v-if="this.RequestQuotations === 'NO RECORD FOUND'" v-show="isShowingRecord"  >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" > {{ this.RequestQuotations   }}</big></h1>
                </div>
         </section>



         <section class="content" v-if="this.RequestQuotations !== 'NO RECORD FOUND'" v-show="isShowingRecord">
              
            <div class="box box-success" >
                <div class="box-header">
                    <h3 class="box-title">List of all Request Proposals / Quotations</h3><br/>

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
                <div class="box-body table-responsive" >
                    <table class="table table-hover text-center">
                        <tbody >
                            <tr>
                                <th>Plate Number</th>
                                <th>Denomination</th>
                                <th>Name</th>
                                <th>Quotation #</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.Denomination }}</td>
                                <td>{{ RequestQuotationss.FirstName}}  {{ RequestQuotationss.MiddleName}}  {{RequestQuotationss.LastName}}</td>
                                <td>{{ RequestQuotationss.RequestNo + '-' + RequestQuotationss.OptionNo }}</td>
                                
                                <td>
                                    <span class="label label-warning">{{ RequestQuotationss.Status }} </span>
                             
                                
                                </td>
                                <td>
                                    <a v-bind:href="'/ApproverView?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
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
  <!----<pre>{{ $data }}</pre>-------->
     
      
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
            this.loadRequestQuotation() ;
           this.StartLoading();
        },
         data() {
            return {
                RetrieveTimeInterval:null,
                RetrieveTimeInterval2:null,
                IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:47,
                 timer_is_on:0,



                url: '/proposal?2019-0001',
                editmode: false,
                RequestQuotations: {},
               UserDetails : {},
               
                
            }
        },


        methods: {

             LoadingDesign(){
                        this.IntervalLoading  = this.clock;
                        this.clock = this.IntervalLoading - 1;
                        this.timer = setTimeout(this.LoadingDesign, 1000/60);
            },
            StartLoading() {
 
                  if (!this.timer_is_on) {
                      this.timer_is_on = 1;
                      this.LoadingDesign();
                  }
                    
              
            },

           

            getResults(page = 1) {
                axios.get('api/GetRequestQuotationApprover?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
              this.RetrieveTimeInterval = setInterval(() => {

                                clearTimeout(this.timer);   //clear timer /loading
                                this.timer_is_on = 0; //clear timer /loading
                                this.isShowingLoading = false; //clear timer /loading
                                this.isShowingRecord = true; 
                                
                        let PassID =this.UserDetails.AccountNo;
                        //console.log(this.RetrieveTimeInterval);
						//alert(PassID);
                        axios.get("api/GetRequestQuotationApprover/" + PassID).then(({ data }) => (this.RequestQuotations = data));
                                
                 }, 1000)

                  this.RetrieveTimeInterval2 = setInterval(() => {
                            clearTimeout(this.RetrieveTimeInterval);  
                           
                            
                    },5000) 
            },
           
         
          },

          computed: {
            
        }


            
          
        //    created() {
        //     this.loadRequestQuotation();
        //     Fire.$on('AfterCreate',() => {
        //         this.loadRequestQuotation();
        //     });
      //  }
    
}
</script>

