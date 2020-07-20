<template>
    <div>
        <!-- <SubTypeHeader/> -->

           <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
       

       <section class="content"  v-if="this.UserList !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1>Create Report</h1>    
                           
                    <v-client-table 
                        :data="ReportDynamic"
                        :columns="columns" 
                        :options="options">
                   
                    </v-client-table>

                   
                </div>

         </section>

        <!-- <pre>{{ $data }}</pre> -->
       
    </div>
</template>


<script>
// import SubTypeHeader from '../../components/PageHeaders/SubTypeHeader';
export default {
    mounted() {
        console.log('Component mounted.')
           this.GetUserData();
    },

    // components: {
    //     SubTypeHeader
    // },

    data() {
        return {
            editmode: false,
            UserDetails: {},
            AllRolesList: {},
           ReportDynamic: {},
            // GetUWStaff: {},

                columns: ['AccountName', 'AccountNo','actions'],
                ReportDynamic: [],
                options: {
                    headings: {
                        AccountName: 'Requester Acct',
                        AccountNo: 'Requester Name' ,
                        action: "action"
                        
                    },
                    sortable: ['AccountName', 'AccountNo'],
                    filterable: ['AccountName', 'AccountNo']
                },



            form: new Form({
                _id: '',
                InchargeName: '',
                InchargeNameUW: '',
                // SubLink_URL: '',
                // active: '',
                // icon_display: '',
                RequestNo:'',
                DisMenu:'',
                DisMenuUW:'',
            }),
        }
    },

    methods: {

             async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                        this.form.CustAcctNo    = this.UserDetails.AccountNo;
                        let PassID              = window.location.pathname;
                        this.form.PassURL       = PassID;
                    await  this.form.post("api/GetAllUserAccessRole").then(({ data }) => (this.AllRolesList = data));
                     this.loadType();
                     this.loadMainType();
            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },


       async loadType() {
           await axios.get("api/CreateReportDynamic").then(({ data }) => (this.ReportDynamic = data));
           
        },
     

    },

  
}
</script>
