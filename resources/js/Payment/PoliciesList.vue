<template>
    <div>
       
     
         <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"> Policy Lists</h3>

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
                                <th>Request #</th>
                                <th>Name</th>
                                <th>Policy No</th>
                                <th>Denomination </th>
                                 <th> </th>
                               
                            </tr>
                            <tr v-for="RequestQuotationss in RequestQuotations.data" :key="RequestQuotationss._id">
                                <td>{{ RequestQuotationss.PlateNumber }}</td>
                                <td>{{ RequestQuotationss.RequestNo  }}</td>
                                <td>{{ RequestQuotationss.FirstName  + " " +  RequestQuotationss.MiddleName + " " + RequestQuotationss.LastName}}  </td>
                                <td>{{ RequestQuotationss.PolicyNo  }}</td>
                                <td>{{ RequestQuotationss.Denomination  }}</td>
                               <td>
                                    <a v-bind:href="'/authentication-Internal?'+ RequestQuotationss.RequestNo" class="btn btn-info" style="text-decoration: none;">
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
			 
        },
         data() {
            return {
             
                editmode: false,
				UserDetails: {},
                RequestQuotations1: {},
				RetrieveTimeInterval: null,
				 RequestQuotations: {},
                //counter:1,
               form: new Form({
					AccountNo: "",
			}),
                
            }
			
        },


        methods: {
            getResults(page = 1) {
                axios.get('api/ListPolicy?page=' + page).then(response => {
                    this.RequestQuotations = response.data;
                });
            },
            loadRequestQuotation() {
			
						axios.get("api/ListPolicy").then(({ data }) => (this.RequestQuotations = data));
		
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
    
}
</script>