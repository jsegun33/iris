<template>
    <div id="MainPage" >
        <!-- <section class="content-header">
            <h1>
                Internal
                <small>Table of Authentication</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Issuance </a></li>
                <li class="active">Proposal List-For Signature</li>
            </ol>
        </section> -->
            <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
        <section class="content"  @mouseover="VerifyAccessRoles()"  v-if="this.RequestQuotations === 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.RequestQuotations  }} </big></h1>
                </div>
      </section>
      <section class="content"  @mouseover="VerifyAccessRoles()"   v-if="this.RequestQuotations !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1> Authentication Lists</h1>
                    <v-client-table 
                        :data="RequestQuotations"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }">
                        <a :href="'/authentication-Internal?' + row.RequestNo"  class="btn btn-success" style="text-decoration: none;" v-if="row.AuthOK === 0"> <i class="fa fa-eye"></i>  View</a>
                    
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
              
                url: '/proposal?2019-0001',
                editmode: false,
				UserDetails: {},
                RequestQuotations1: {},
				RetrieveTimeInterval: null,
                 RequestQuotations: {},
                  AllRolesList: {},

               columns: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','CocNo','AuthCode',
                            'ErrorMessage',  
                            'actions'],
                RequestQuotations: [],
                options: {
                    headings: {
                        PlateNumber: 'Plate Number',
                        RequestNo: 'Request No',
                        RequestType: 'Request Type',
                        CName: 'Assured Name',
                        PolicyNo: 'Policy No',
                        CocNo: 'COC No',
                        AuthCode:'Auth Code',
                        ErrorMessage: 'Auth Message',
                        
                          action: "action"
                        
                    },
                    sortable: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','CocNo','AuthCode','ErrorMessage'],
                    filterable: ['PlateNumber', 'RequestNo', 'RequestType','CName', 'PolicyNo','CocNo','AuthCode','ErrorMessage']
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
            //     axios.get('api/GetListNeedAuth?page=' + page).then(response => {
            //         this.RequestQuotations1 = response.data;
            //     });
            // },
           async loadRequestQuotation() {
                   
                //      this.RetrieveTimeInterval = setInterval(() => {  
                //       this.form.CustAcctNo = this.UserDetails.AccountNo;
                //         let PassID      = window.location.pathname;
                //             this.form.PassURL = PassID;
                //              axios.get("api/GetListNeedAuth/" + this.UserDetails.AccountNo ).then(({ data }) => (this.RequestQuotations = data));
                //   this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                // },1000);
			
                //   this.RetrieveTimeInterval2 = setInterval(() => {
                //             clearInterval(this.RetrieveTimeInterval); 
                          
                               
                //     },3000) 
                      try {
                         await  axios.get("api/GetListNeedAuth/" + this.form.CustAcctNo ).then(({ data }) => (this.RequestQuotations = data));
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