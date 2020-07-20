<template>
    <div id="MainPage">
        <!-- <section class="content-header">
            <h1>
                Proposal Lists
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Issuance / Proposal</a></li>
                <li class="active">Proposal List-For Signature</li>
            </ol>
        </section> -->

        <!-- <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->
  <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
     
          <section class="content"  @mouseover="VerifyAccessRoles()"    v-if="this.RequestQuotations ==='NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" > {{ this.RequestQuotations  }}</big></h1>
                </div>
         </section>

         <section class="content"  @mouseover="VerifyAccessRoles()"   v-if="this.RequestQuotations !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1> Policy Lists</h1>
                    <v-client-table 
                        :data="RequestQuotations"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }">
                        <a :href="'/ViewForSignature?' + row.RequestNo"  class="btn btn-warning" style="text-decoration: none;"> <i class="fa fa-eye"></i>   List Quotation</a>
                        <a :href="'/final-issuance?' + row.RequestNo"  class="btn btn-info" style="text-decoration: none;"> <i class="fa fa-eye"></i>  View</a>
                    
                    </div>
                     
                      
                    </v-client-table>
                   
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
              this.GetUserData();
              this.StartLoading();
        },
         data() {
            return {
              
             
                editmode: false,
				UserDetails: {},
                RequestQuotations1: {},
				RetrieveTimeInterval: null,
				 RequestQuotations: {},
               ConnectionStatus:'',
               AllRolesList: {},

                
               columns: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','PaymentMode','PaymentGateway','actions'],
                RequestQuotations: [],
                options: {
                    headings: {
                        PlateNumber: 'Plate Number',
                        RequestNo: 'Request No',
                        RequestType: 'Request Type',
                        CName: 'Assured Name',
                        PolicyNo: 'Policy No',
                        PaymentMode: 'Payment Status',
                         PaymentGateway: 'Payment Mode',
                    
                        
                          action: "action"
                        
                    },
                    sortable: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','PaymentMode','PaymentGateway'],
                    filterable: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','PaymentMode','PaymentGateway']
                },


               form: new Form({
                    AccountNo: "",
                     CustAcctNo: "",
                     PassURL:"",
			}),
                
            }
			
        },


        methods: {

             async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                          this.form.CustAcctNo = this.UserDetails.AccountNo;
                            this.form.PassURL = window.location.pathname;
                    await this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                  this.loadRequestQuotation();
            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },
            
            async StartLoading() {
              
               let timerInterval
                await Swal.fire({
                title: '<h3>Loading Data</h3>',
                text: 'Please wait...',
                timer: 1000,
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

         
           async loadRequestQuotation() {
			// 	this.RetrieveTimeInterval = setInterval(() => {
			// 		let PassID = this.UserDetails.AccountNo;  //"2020-0008";
			// 			axios.get("api/GetIssuanceForSignature/" + PassID).then(({ data }) => (this.RequestQuotations = data));
            //                  this.form.CustAcctNo = this.UserDetails.AccountNo;
            //                 this.form.PassURL = window.location.pathname;
            
            //   this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
            // },1000);
			
			//  this.RetrieveTimeInterval2 = setInterval(() => {
			// 					clearInterval(this.RetrieveTimeInterval);
            // },3000);
				
            // },
                 try {
                         await axios.get("api/GetIssuanceForSignature/" + this.form.CustAcctNo).then(({ data }) => (this.RequestQuotations = data));
                    } catch(error) {
                       
                        alert("error", error);
                       
                    }
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