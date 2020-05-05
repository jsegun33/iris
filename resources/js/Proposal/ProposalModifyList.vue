<template>
    <div>
        <section class="content-header">
            <h1>
                 Proposal Modification List
                <small>Table of Proposals</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal Modification List</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>Proposal Modification List</strong></h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive" >
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Plate Number</th>
                                <th>Denomination</th>
                                <th>Name</th>
                                <th>Total Premium</th>
                                <th>Amount Due</th>
                                <th>Deductible</th>
                                <th>Expiration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="PolicyModificationAmounts in PolicyModificationAmount" :key="PolicyModificationAmounts._id">
                                <td>{{ PolicyModificationAmounts.PlateNumber }}</td>
                                <td>{{ PolicyModificationAmounts.Denomination }}</td>
                                <td>{{ PolicyModificationAmounts.FirstName + ' ' +  PolicyModificationAmounts.MiddleName + ' '  +  PolicyModificationAmounts.LastName  }}</td>
                                <td>{{ PolicyModificationAmounts.PremiumAmount }}</td>
                                <td>{{ PolicyModificationAmounts.AmountDue }}</td>
                                <td>{{ PolicyModificationAmounts.Deductable }}</td>
                                <td>{{ PolicyModificationAmounts.QuoteExpiry }}</td>
                               
                                <td><span class="label label-warning">{{ PolicyModificationAmounts.Status }}</span></td>
                                <!-- <td>
                                    <router-link to="/" class="btn btn-info" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i>
                                        View
                                    </router-link>
                                    <router-link to="/proposal-modification-form" class="btn btn-primary" style="text-decoration: none;">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </router-link>
                                </td> -->
								
								
								 <td>
                                    <a v-bind:href="'/ViewQuoteModify?'+ PolicyModificationAmounts.RequestNo" class="btn btn-info" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a> 
                                    <a  v-bind:href="'/proposal-modification-form?'+ PolicyModificationAmounts.RequestNo" class="btn btn-primary" style="text-decoration: none;">
                                        <i class="fa fa-edit"></i> 
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {

 mounted: function(){ 
		
         	axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));	
			  
              this.loadRequestModification(); 
    },
	
 data() {
        return {
            UserDetails:{},
			PolicyModificationAmount:{},
        }
    },
	
	
	
	methods: {
           
            loadRequestModification() {
              this.RetrieveTimeInterval = setInterval(() => {
                              let PassID      = this.UserDetails.AccountNo; //uri[1].trim();
								//alert(PassID);
							  axios.get("api/PolicyModificationAmount/" + PassID ) .then(({ data }) => (this.PolicyModificationAmount = data)  );
				 
                 }, 1000)

                  this.RetrieveTimeInterval2 = setInterval(() => {
                           // clearInterval(this.RetrieveTimeInterval);  
                    },2000) 
            },
            
          },


    
}
</script>