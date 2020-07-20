<template>
    <div id="MainPage">
        <!-- <section class="content-header">
            <h1>
                 Lists of Accepted Proposal
                <small>Table of Proposal</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Quotation / Proposal</a></li>
                <li class="active">Proposal List</li>
            </ol>
        </section> -->

        
            <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
     
        <section class="content"  @mouseover="VerifyAccessRoles()" v-if="this.RequestQuotations === 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
      </section>
        <section class="content"  @mouseover="VerifyAccessRoles()" v-if="this.RequestQuotations !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1>List Accepted Request  </h1>
                    <v-client-table 
                        :data="RequestQuotations"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }">
                        <a :href="'/Accepted?' + row.RequestNo"  class="btn btn-primary" style="text-decoration: none;" v-if="row.Payment ==='Paid'" @click="SaveCocafDetails(row)" > <i class="fa fa-eye"></i>  View</a>
                    
                    </div>
                     
                      
                    </v-client-table>
                   
                </div>

         </section>

     
     
       <!--------- <pre>{{ $data }}</pre>-------->
       

      
    </div>
</template>
		



<script>

export default {
     mounted() {
            this.GetUserData();
            this.StartLoading();
        },
         data() {
            return {
             
                editmode: false,
                RequestQuotations: {},
                AllRolesList: {},
                UserDetails: {},


                 columns: ['RequestNo', 'PolicyNo', 'CName','PlateNumber', 'AmountDue','Payment','PaymentMode','Type','actions'],
                RequestQuotations: [],
                options: {
                    headings: {
                        RequestNo: 'RequestNo',
                        PolicyNo: 'Policy No',
                        CName: 'Assured Name',
                        PlateNumber:'Plate No',
                        AmountDue: 'AmountDue',
                          Payment: 'Payment',
                          PaymentMode: 'Mode',
                         Type: "Request Type",
                          action: "action"
                        
                    },
                    sortable: ['RequestNo', 'PolicyNo', 'CName','PlateNumber', 'AmountDue','Payment','PaymentMode','Type'],
                    filterable: ['RequestNo', 'PolicyNo', 'CName','PlateNumber', 'AmountDue','Payment','PaymentMode','Type']
                },

                 form: new Form({
                CustAcctNO: "",
               
                RoleAlias: "",
                 CustAcctNo: "",
                PassURL:"",
                })

                
            }
        },


        methods: {
             async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                            this.form.CustAcctNo = this.UserDetails.AccountNo;
                            let PassID          = window.location.pathname;
                            this.form.PassURL   = PassID;
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
                    },100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                     $(".ContentSection").removeClass("DisabledSection");
                   
                }
                }).then((result) => {
               
                })
              
            },


            // getResults(page = 1) {
            //     axios.get('api/GetRequestQuotationAccepted?page=' + page).then(response => {
            //         this.RequestQuotations = response.data;
            //     });
            // },
         async   loadRequestQuotation() {
                //      this.RetrieveTimeInterval = setInterval(() => {  
                //       this.form.CustAcctNo = this.UserDetails.AccountNo;
                //         let PassID      = window.location.pathname;
                //             this.form.PassURL = PassID;

                //        axios.get("api/GetRequestQuotationAccepted/" + this.UserDetails.AccountNo  ).then(({ data }) => (this.RequestQuotations = data));
                //     this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                //  },1000);
			
                //   this.RetrieveTimeInterval2 = setInterval(() => {
                //             clearInterval(this.RetrieveTimeInterval); 
                          
                               
                //     },3000) 

                        try {
                         await  axios.get("api/GetRequestQuotationAccepted/" + this.form.CustAcctNo).then(({ data }) => (this.RequestQuotations = data));
                    } catch(error) {
                       
                        alert("error", error);
                       
                    }
          },
            
            SaveCocafDetails(row) {
                axios.get("api/SaveCocafDetails/" + row.RequestNo)
               
            },
         
          },

     
    
}
</script>