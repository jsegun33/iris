<template>
     <div>
       

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">User List</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <!-- <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div> -->
                         
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th> Name</th>
                                <th>Account No.</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="UserLists in UserList.data" :key="UserLists._id"> 
                                <td>{{ UserLists.user_lname + " " + UserLists.user_fname + " " + UserLists.user_mname}}</td>
                                <td>{{ UserLists.AccountNo}}</td>
                                <td>{{ UserLists.department}}</td>
                                
                                <td>
                                    <span class="label label-success" v-if="UserLists.status == 1 || UserLists.status == '1'">Active</span>
                                    <span class="label label-danger" v-else>{{ UserLists.status}}</span>
                                </td>
                                <td v-if="UserLists.status == 1 || UserLists.status == '1'">
                                   
                                    <a v-bind:href="'/View-User-Record?' + UserLists.AccountNo" class="btn btn-primary" style="text-decoration: none;">
                                        <i class="fa fa-eye"></i> 
                                        View
                                    </a> 
                                    <button class="btn btn-danger" @click="RemoveUser(UserLists)">
                                        <i class="fa fa-warning"></i>
                                        Remove
                                    </button>
                                </td> 
                                <td v-else>
                                    <button class="btn btn-success" @click="RestoreUser(UserLists)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <!-- <button class="btn btn-danger" @click="deleteUserAuthority(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="UserLists" :limit="2" @pagination-change-page="getResults" class="pull-right">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </section>

       
    </div>
</template>


<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },

       

        data() {
            return {
                editmode: false,
              
                UserList: {},
                form: new Form({
                    _id: '',
                    active: '',
                    AccountNo: '',
                    RemarksRestore: '',
                    RemarksRemove: '',
                }),
            }
        },

        methods: {


             async  RemoveUser(UserLists){
                this.form.AccountNo = UserLists.AccountNo;
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


             async  RestoreUser(UserLists){
                this.form.AccountNo = UserLists.AccountNo;
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



              getResults(page = 1) {
                axios.get('api/ViewUserList?page=' + page).then(response => {
                    this.UserList = response.data;
                });
            },
           
             LoadViewUser() {
                axios.get("api/ViewUserList").then(({ data }) => (this.UserList = data));
            },
        },

        created() {

              this.LoadViewUser();
            Fire.$on('AfterCreate',() => {
                this.LoadViewUser();
            });


        }
    }
</script>
