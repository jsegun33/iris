<template>
    <div id="MainPage">

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
 
     <section class="content" @mouseover="VerifyAccessRoles()" v-if="this.RequestQuotations === 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
    </section>

     <section class="content"  @mouseover="VerifyAccessRoles()" v-if="this.RequestQuotations !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1> PAID Policy /ies</h1>
                    <v-client-table 
                        :data="RequestQuotations"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }">
                        <a :href="'/PolicyPayment?' + row.RequestNo"  class="btn btn-info" style="text-decoration: none;"> <i class="fa fa-eye"></i>View</a>
                    
                    
                    
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
               TimeLoading1:null,
            TimeLoading:null,
            TimeLoadingInternet:null,
            ConnectionStatus:'',

             AllRolesList: {},

              columns: ['PolicyNo','PlateNumber', 'RequestNo', 'RequestType','CName','AmountDue','PaymentMode','PaymentGateway','actions'],
                RequestQuotations: [],
                options: {
                    headings: {
                        PolicyNo: 'Policy No',
                        PlateNumber: 'Plate Number',
                        RequestNo: 'Request No',
                        RequestType: 'Request Type',
                        CName: 'Assured Name',
                        AmountDue: 'Amount Due',
                        PaymentMode: 'Payment Status',
                         PaymentGateway: 'Payment Mode',
                    
                        
                          action: "action"
                        
                    },
                    sortable: ['PolicyNo','PlateNumber', 'RequestNo', 'RequestType','CName','AmountDue','PaymentMode','PaymentGateway'],
                    filterable: ['PolicyNo','PlateNumber', 'RequestNo', 'RequestType','CName','AmountDue','PaymentMode','PaymentGateway']
                },


                //counter:1,
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
                     
                        this.form.CustAcctNO = this.UserDetails.AccountNo;
                         this.form.RoleAlias = this.UserDetails.RoleAlias;
                        this.form.CustAcctNo = this.UserDetails.AccountNo;
                        let PassID           = window.location.pathname;
                        this.form.PassURL    = PassID;
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


            // getResults(page = 1) {
            //     axios.get('api/PaidPolicies?page=' + page).then(response => {
            //         this.RequestQuotations = response.data;
            //     });
            // },
           async loadRequestQuotation() {
//                         axios.get("api/PaidPolicies").then(({ data }) => (this.RequestQuotations = data));

//                          this.RetrieveTimeInterval = setInterval(() => {  
//                     this.form.CustAcctNO = this.UserDetails.AccountNo;
                  
//                     this.form.RoleAlias = this.UserDetails.RoleAlias;
//                       this.form.CustAcctNo = this.UserDetails.AccountNo;
//                         let PassID      = window.location.pathname;
//                             this.form.PassURL = PassID;
//   this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                           
                     
//                  },200);
			
//                   this.RetrieveTimeInterval2 = setInterval(() => {
//                             clearInterval(this.RetrieveTimeInterval); 
                          
                               
//                     },1000) 

                      try {
                         await axios.get("api/PaidPolicies").then(({ data }) => (this.RequestQuotations = data));
                    } catch(error) {
                       
                        alert("error", error);
                       
                    }

              
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