<template>
     <div>
              <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
       

       <section class="content"  v-if="this.UserList !== 'NO RECORD FOUND' && this.AllRolesList ==='YES ACCESS'">
                <div class="box-header with-border box box-success" id="quotehead" >
               <h1> USER LIST</h1>
                    <v-client-table 
                        :data="UserList"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }" v-if="row.status == 'Active'">
                        <a :href="'/View-User-Record?' + row.AccountNo"  class="btn btn-info" style="text-decoration: none;"> <i class="fa fa-eye"></i>View</a>
                         <button class="btn btn-danger" @click="RemoveUser(row)"><i class="fa fa-warning"></i>Remove</button>
                    
                    </div>
                      <div slot="actions" slot-scope="{ row }" v-else>
                       <button class="btn btn-success" @click="RestoreUser(row)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                      </div> 
                    </v-client-table>
                   
                </div>

         </section>

       
    </div>
</template>


<script>

    export default {
        mounted() {
           this.GetUserData();
        },

       

        data() {
            return {
                editmode: false,
                AllRolesList: {},
              
               UserList: {},

                         columns: ['UserName', 'AccountNo', 'Department','ApprovedLimit','username','status','actions'],
                UserList: [],
                options: {
                    headings: {
                        
                        UserName: 'Name',
                        AccountNo: 'Account No',
                        Department: 'Department',
                        ApprovedLimit: 'Approved Limit',
                        username: 'Login Username',
                         status: 'Status',
                       
                        action: "action"
                        
                    },
                    sortable: ['UserName', 'AccountNo', 'Department','ApprovedLimit','username','status'],
                    filterable: ['UserName', 'AccountNo', 'Department','ApprovedLimit','username','status']
                },




                form: new Form({
                    _id: '',
                    active: '',
                    AccountNo: '',
                    RemarksRestore: '',
                    RemarksRemove: '',
                    CustAcctNo: '',
                    PassURL: '',
                }),
            }
        },

        methods: {

              async GetUserData() {
             const response    =  await  axios.get("GetUserData"  ).then(({ data }) => (this.UserDetails = data));
                        this.form.CustAcctNo    = this.UserDetails.AccountNo;
                        let PassID              = window.location.pathname;
                        this.form.PassURL       = PassID;
                     await   this.form.post("api/GetAllUserAccessRoleByAdmin").then(({ data }) => (this.AllRolesList = data));
                    this.LoadViewUser();
            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },



             async  RemoveUser(row){
                this.form.AccountNo = row.AccountNo;
               // alert(EmployeeProfiles.AccountNo);
                    
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to REMOVE this USER's Record ?",
                icon: "info",
                input: 'textarea',
                inputPlaceholder: 'Type your message /reason here...',
                inputAttributes: {
                    'aria-label': 'Type your message/reason  here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
            }).then(result => {
                    this.form.RemarksRemove = result.value;
                 if (result.value) {

                         
                             this.form.post("api/RemoveUser/" )
                            .then(() => {
                                Swal.fire(
                                    " REMOVE ",
                                    " USER's Record has been REMOVE",
                                    "success"
                                );
                                   this.LoadViewUser();
								   
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
           })
               
                 
        },


             async  RestoreUser(row){
                this.form.AccountNo = row.AccountNo;
               // alert(EmployeeProfiles.AccountNo);
                    
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to RESTORE this USER's Record ?",
                icon: "info",
                input: 'textarea',
                inputPlaceholder: 'Type your message /reason here...',
                inputAttributes: {
                    'aria-label': 'Type your message/reason  here'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave remarks!'
            }).then(result => {
                    this.form.RemarksRestore = result.value;
                 if (result.value) {

                         
                             this.form.post("api/RestoreUser/" )
                            .then(() => {
                                Swal.fire(
                                    " RESTORE ",
                                    " USER's Record has been RESTORE",
                                    "success"
                                );
                                   this.LoadViewUser();
								   
                            })

                       
                             .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });
                }
           })
               
                 
        },


           async  LoadViewUser() {
              await  axios.get("api/ViewUserList").then(({ data }) => (this.UserList = data));
            },
        },

        // created() {

        //       this.LoadViewUser();
        //     Fire.$on('AfterCreate',() => {
        //         this.LoadViewUser();
        //     });
       // }
    }
</script>
