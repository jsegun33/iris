<template>
    <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Profile</h3>
            </div>
             <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
             <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">

            <form @submit.prevent="">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">First Name:</label>
                                <input v-model="form.firstname" type="text" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Middle Name:</label>
                                <input v-model="form.middlename" type="text" class="form-control" name="middlename" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Last Name:</label>
                                <input v-model="form.lastname"  type="text" class="form-control" name="lastname" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="select_department">Department:</label>
                                        {{ form.select_department1 }}
                                      <select v-model="form.select_department" class="form-control" id="select_department" name="select_department" required>
                                                <option v-for="departmentss in departments.data" :key="departmentss._id"  v-bind:value="departmentss.department_name + ';;' + departmentss._id">{{ departmentss.department_name }}</option>
                             
                                       </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name"> Limit Amount:</label>
                                <input v-model="form.LimitAmount"  type="number" class="form-control" name="LimitAmount" placeholder="Limit Amount">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Email:</label>
                                <input v-model="form.email"  type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Username:</label>
                                <input v-model="form.username"  type="text" class="form-control"  name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Password:</label>
                                <input v-model="form.password" type="password" class="form-control" name="password" placeholder="Password" >
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name"> Agent Type:</label> 
                                <select  v-model="form.AgentType" class="form-control"   >
                                    <option value="Authorized">Authorized</option>
                                    <option value="Direct">Direct</option>
                                 </select> 
                           </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Sub Agent:</label>
                                <select  v-model="form.SubAgent" class="form-control"   >
                                    <option value="Employee">Employee</option>
                                    <option value="AAA">AAA</option>
                                    <option value="AAA">Reliance</option>
                                   
                                 </select> 
                            
                            </div>
                        </div>


                    </div>
                    
                    
                    <div class="box-footer">
                   
                         <button  type="button" class="btn btn-primary" @click="UpdateUserDetails()" >Update Details</button>
                   
                    </div>

                      <br/><legend>Assigned Commission:</legend>
                       <table class="table table-bordered" style="width:100%"  v-for="UserProfiles in UserProfile" :key="UserProfiles._id">
                                                    <tr><th></th><th>PerilsName</th><th></th><th>Denomination</th><th>AmountCom</th></tr>
                                                    <tr v-for="UserCommission in UserProfiles.ListUserCommission" :key="UserCommission._id">
                                                      <td>
                                                          <button  type="button" class="btn btn-warning" @click="RemoveUserAccess(UserCommission)" v-if="UserCommission.status == '1'"> <i class="fa  fa-trash"></i></button>
                                                          <button  type="button" class="btn btn-danger" @click="RestoreUserAccess(UserCommission)" v-if="UserCommission.status != '1'"> <i class="fa  fa-mail-forward"></i></button> 
                                                     
                                                     </td>
                                                 
                                                    <td >{{  UserCommission.PerilsName }} </td> <th >: </th>
                                                    <td>{{   UserCommission.ClassName}}</td>
                                                    <td>{{   UserCommission.AmountCom}}</td>
                                                   
                                                </tr>
                                        </table>
        <br/><legend>Set Commission:</legend>
                     <div class="row" v-for="(tryLoop , index)  in LoopTR1"  :key="index" >

                        <div class="col-md-1"  >
                            <div class="form-group">
                                <label for="name"> Denomination</label>
                               
                                <select  v-model="form.ClassName[index]" class="form-control"   >
                                    <option selected>Denomination</option>
                                    <option v-for="GetLinesComms in GetLinesComm" :key="GetLinesComms._id"  v-bind:value="GetLinesComms.ClassName + ';;' + GetLinesComms.Class">{{ GetLinesComms.ClassName }} </option>
                                 </select>
                            </div>
                       </div>
                       <div class="col-md-1" v-for="Commission in GetPerilsComm" :key="Commission._id"   >
                            <div class="form-group-inline">
                                <label for="name" v-if="Commission.PerilsCode != 'OD'"> {{ Commission.PerilsCode }}</label>
                                <label v-if="Commission.PerilsCode == 'OD'"> {{ Commission.PerilsCode + " / TF" }}</label>
                                  
                                <input type="number"  class="form-control"    v-model="form.AmountCommInput[Commission._id + index ]" placeholder="Amount" />
                                        
                            </div>
                           
                             
                       </div>

                         <div class="col-md-3">
                            <div class="form-group">
                               <button  type="button" class="btn btn-warning" @click="DeleteNewTRComm(index)" >-</button>
                                <button  type="button" class="btn btn-primary" @click="AddNewTRComm"  >+</button>             
                             </div>
                        </div>
                  
                        
                    </div>
                <div class="box-footer">
                         <button  type="button" class="btn btn-primary" @click="AddNewCommission()">Add New Commission</button>
                    </div><br/>
 
    <legend>Assigned Privileges:</legend><br/>
                                    <table class="table table-bordered" style="width:100%"  v-for="UserProfiles in UserProfile" :key="UserProfiles._id">
                                                    <tr><th></th><th>Access</th><th></th><th>URL</th><th>MENU</th></tr>
                                                    <tr v-for="RolesAccess in UserProfiles.ListUserRoleAccess" :key="RolesAccess._id">
                                                      <td>
                                                          <button  type="button" class="btn btn-warning" @click="RemoveUserAccess(RolesAccess)" v-if="RolesAccess.status == '1'"> <i class="fa  fa-trash"></i></button>
                                                          <button  type="button" class="btn btn-danger" @click="RestoreUserAccess(RolesAccess)" v-if="RolesAccess.status != '1'"> <i class="fa  fa-mail-forward"></i></button> 
                                                     
                                                     </td>
                                                 
                                                    <td >{{  RolesAccess.role_name_access }} </td> <th >: </th>
                                                    <td>{{   RolesAccess.role_number_url}}</td>
                                                    <td>{{   RolesAccess.acctTypeSubName}}</td>
                                                   
                                                </tr>
                                        </table>
 <br/><legend v-if="UserDetails.AccountNo == '2019-0001'" >Set Privileges:
                    <div class="row"  v-for="(tryLoop , index)  in LoopTR"  :key="index"   >
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select_type">Type/ Menu:</label>
                                <select  @change="loadSubTypes($event)" v-model="form.select_type[index]" class="form-control" id="select_type" name="select_type" >
                                    <option value='' selected >pls. select</option>
                                    <option v-for="type in types.data" :key="type._id" v-bind:value="type.type_name + ';;' + type._id + ';;' + type.icon_display + ';;' + type.UnderSubMenu  + ';;' + type.UnderSubMenuName">{{ type.type_name }}</option>
                                </select>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="form-group">
                                <label for="select_type">Type/ Menu Sub:</label>
                                  <md-select v-model="form.select_SubTypes[index]" name="select_SubTypes" id="select_SubTypes" class="form-control" md-dense multiple>
                                                <md-option v-for="SubTypess in SubTypes.data" :key="SubTypess._id"  v-bind:value="SubTypess.SubLink_TypeName + ';;' + SubTypess._id + ';;' + SubTypess.SubLink_URL + ';;' + SubTypess.icon_display">{{ SubTypess.SubLink_TypeName }}</md-option>
                          
                                    </md-select>
                            </div>
                        </div>
                       

                        <div class="col-md-5">
                            <div class="form-inline">
                                    <label for="Authority">Authority</label>
                                    <md-select v-model="form.select_authority[index]" name="select_authority" id="select_authority" class="form-control" md-dense multiple>
                                                <md-option v-for="authority in authorities.data" :key="authority._id"  v-bind:value="authority.authority_name + ';;' + authority._id">{{ authority.authority_name }}</md-option>
                          
                                    </md-select>
                                
                               
                            </div>
                        </div>
                        <button  type="button" class="btn btn-primary" @click="AddNewTR">+</button>
                        <button  type="button" class="btn btn-warning" @click="DeleteNewTR(index)">-</button>

                    </div>

                     <div class="box-footer">
                         <button  type="button" class="btn btn-primary" @click="AddNewPrivileges()">Add New Privileges</button>
                    </div>
                    
           </legend>
                     
                </div>
                <!-- ------<pre> {{ $data }}</pre>------ -->
                
            </form>
        </div>
	<!--------<pre>{{ $data }}</pre>-------->
        </div>
        </div>

      
    </section>
	
</template>

<script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vue-material"></script>
<script>
import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial)

export default {
     mounted() {
        console.log('Component mounted.')
         axios.get("api/GetPerilsComm/").then(({ data }) => 
                (
                    this.GetPerilsComm = data
                  
                )); 

                axios.get("api/GetLinesComm/").then(({ data }) => 
                (
                    this.GetLinesComm = data
                  
                )); 
                this.LoadUsersProfileView();
                axios.get("GetUserData").then(({ data }) => (this.UserDetails = data));

    },

    data() {
        return {
            UserProfile: {},
            users: {},
            GetPerilsComm: {},
            GetLinesComm: {},
             LoopTR: [ {}] ,
              LoopTR1: [ {}] ,
               LoopTR3: [{}] ,
                UserDetails:{},


          //select_authority: ['b'], // Array reference
            editmode: false,   
            authorities: {},  
            types: {},  
            departments:{},
			SubTypes:{},			
            form: new Form({
                _id: '',
                UserRoleAccessID: '',
                firstname: '',
                middlename: '',
                lastname: '',
                email: '',
                username: '',
                password: '',
                select_type: [],
                select_authority: [],
                select_SubTypes: [],
                EditFirstName: '',
                AccountNo: '',
                AgentType: '',
                SubAgent: '',
                select_department1: '',

                AmountComm: [],
                ClassName: [],
                AmountCommInput: [],
                AmountCommID:'',
                AmountCommInputArray: [],
                DisplayPerils: [],
                GetPerilsbyClick:'',

                PassDataAmountPerils: [],
                PassDataPerilsCode: [],
                PassDataClassName: [],
                PassDataPerilsNo: [],
                PassDataPerilsName: [],
                
                
                PassDataPerils: [],
                AssignLoopVal: [],
                RemarksRemove:'',
                RemarksRestore:'',
             

            }),
        }
    },
    
    methods: {

         PushDataIntoArray(){
            let perilscode =  this.GetPerilsComm.length;
            let IndexLength = this.LoopTR1.length;
           for (let index = 0; index < IndexLength; index++){
                   for (let k = 0; k < perilscode; k++) { 
                          this.form.AssignLoopVal.push(this.GetPerilsComm[k]._id + index) ;
                          this.form.PassDataClassName.push(this.form.ClassName[index] ); 
                          this.form.PassDataAmountPerils.push(this.form.AmountCommInput[this.GetPerilsComm[k]._id  + index] ); 
                          this.form.PassDataPerilsCode.push(this.GetPerilsComm[k].PerilsCode); 
                          this.form.PassDataPerilsNo.push(this.GetPerilsComm[k].PerilsNo); 
                          this.form.PassDataPerilsName.push(this.GetPerilsComm[k].PerilsName); 
                   
                  } 

           }
              
        },


      async  AddNewCommission(){
           const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to ADD this USER's Privileges ?",
                icon: "info",
               
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(result => {
                  //  this.form.RemarksRemove = result.value;
                 if (result.value) {
                     this.PushDataIntoArray();
                             this.form.post("api/AddNewCommission/" )
                            .then(() => {
                                Swal.fire(
                                    " COMMISSION ",
                                    " USER's Commission has been UPDATE",
                                    "success"
                                );
                                   this.LoadUsersProfileView();
								   
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


        async AddNewPrivileges(){
         const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to ADD this USER's Privileges ?",
                icon: "info",
               
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(result => {
                  //  this.form.RemarksRemove = result.value;
                 if (result.value) {

                         
                             this.form.post("api/AddNewPrivileges/" )
                            .then(() => {
                                Swal.fire(
                                    " PRIVILEGES ",
                                    " USER's Privileges has been UPDATE",
                                    "success"
                                );
                                   this.LoadUsersProfileView();
								   
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
       
        async  UpdateUserDetails(){
    
              
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to UPDATE this USER's Details ?",
                icon: "info",
               
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(result => {
                  //  this.form.RemarksRemove = result.value;
                 if (result.value) {

                         
                             this.form.post("api/UpdateUserDetails/" )
                            .then(() => {
                                Swal.fire(
                                    " UPDATE ",
                                    " USER's Details has been UPDATE",
                                    "success"
                                );
                                   this.LoadUsersProfileView();
								   
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

         async  RemoveUserAccess(RolesAccess){
                this.form.UserRoleAccessID = RolesAccess.UserRoleAccessID;
               // alert(EmployeeProfiles.AccountNo);
                    
             const { value: text } = await Swal.fire({
                title: " CONFIRMED ? ",
                text: " You want to REMOVE this USER's Access ?",
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

                         
                             this.form.post("api/RemoveUserAccess/" )
                            .then(() => {
                                Swal.fire(
                                    " REMOVE ",
                                    " USER's Access has been REMOVE",
                                    "success"
                                );
                                   this.LoadUsersProfileView();
								   
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


     async  RestoreUserAccess(RolesAccess){
                this.form.UserRoleAccessID = RolesAccess.UserRoleAccessID;
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

                         
                             this.form.post("api/RestoreUserAccess/" )
                            .then(() => {
                                Swal.fire(
                                    " RESTORE ",
                                    " USER's Record has been RESTORE",
                                    "success"
                                );
                                   this.LoadUsersProfileView();
								   
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



        LoadUsersProfileView() {
                    let uri         = window.location.href.split('?');
                    let PassID      = uri[1].trim();
               
                 axios.get("api/UserProfileView/" + PassID).then(({ data }) => {
                    let result = (this.UserProfile = data);
                    result.map(detail => {

                                    this.form.AccountNo     =  detail.AccountNo;
                                    this.form.firstname     =  detail.user_fname;
                                    this.form.middlename    =  detail.user_mname;
                                    this.form.lastname      =  detail.user_lname;
                                    this.form.email         =  detail.email;
                                    this.form.username      =  detail.username;
                                    this.form.AgentType     =  detail.AgentType;
                                    this.form.SubAgent      =  detail.SubAgent;
                                    this.form.SubAgent      =  detail.SubAgent;
                                    this.form.LimitAmount      =  detail.ApprovedLimit;
                                    //this.form.select_department =  detail.department;
                                    this.form.select_department1  =  detail.department;

                                    this.$forceUpdate();
                    });
                });


            },




        GetPerilsChange(){
              this.form.GetPerilsbyClick = this.form.AmountComm  ;
                let PerilsNameDisp          =  this.form.GetPerilsbyClick;
               let SplitPerilsName          = PerilsNameDisp[0].split(";;");

                for (let k = 0; k < SplitPerilsName.length; k++) {
                        this.form.AmountCommID      = k  ;
                        this.form.AmountCommInputArray[k];
                }
        },
        PushDataIntoArray(){
           
            //  this.form.AmountaCommInput.push(this.form.AmountCommInputArray) ;

                //let PerilsNameDisp          =  this.form.GetPerilsbyClick;
                //let SplitPerilsName          = PerilsNameDisp[0].split(";;");
                //this.form.DisplayPerils.push(SplitPerilsName[0]  + " :" + this.form.AmountCommInputArray); 
            let perilscode =  this.GetPerilsComm.length;
            let IndexLength = this.LoopTR1.length;
          // alert(IndexLength);


           for (let index = 0; index < IndexLength; index++){
                   for (let k = 0; k < perilscode; k++) { 
                          this.form.AssignLoopVal.push(this.GetPerilsComm[k]._id + index) ;
                          this.form.PassDataClassName.push(this.form.ClassName[index] ); 
                          this.form.PassDataAmountPerils.push(this.form.AmountCommInput[this.GetPerilsComm[k]._id  + index] ); 
                          this.form.PassDataPerilsCode.push(this.GetPerilsComm[k].PerilsCode); 
                          this.form.PassDataPerilsNo.push(this.GetPerilsComm[k].PerilsNo); 
                          this.form.PassDataPerilsName.push(this.GetPerilsComm[k].PerilsName); 
                   
                  } 

           }
              
        },
        SelectPerilsName(e){
             let PerilsName    = e;
                for (let k = 0; k < PerilsName.length; k++) {
                        this.form.AmountCommID      = k  ;
                        this.form.AmountCommInputArray[k];
                }
        },
         editModal(user) {
                //this.editmode = true;
                this.form.reset();
                $('#EditRegistration').modal('show')
                this.form.fill(user);
                this.$forceUpdate();
            },

         AddNewTR: function () {
                this.LoopTR.push({value:2});
              
                },
            DeleteNewTR: function (index) {
                console.log(index);
                console.log(this.LoopTR);
                this.LoopTR.splice(index, 1);
                },

            DeleteNewTRComm: function (index) {
                //console.log(index);
                //console.log(this.LoopTR);
                this.LoopTR1.splice(index, 1);
                },
            AddNewTRComm: function () {
                this.LoopTR1.push({value1:2});
              
                },

        addAuthority() {

            this.PushDataIntoArray();
            // Submit the form via a POST request
            //this.form.post('api/registration').then(() => {
                // Success!
                //Fire.$emit('AfterCreate');
                //this.$router.push('Home') ;
                //window.Vue.use(VuejsDialog.main.default)
           // }).catch(() => {

           // });

                 this.form.post("api/registration/" )
                        .then(() => {
                            Swal.fire(
                                "User's Registration!",
                                "New User Added.",
                                "success"
                            );
                            // Success
                            this.form.reset();
                             this.LoadUsers();
                            // this.loadDepartment();
                            // this.loadAuthorities();
                            // this.loadUserType();
                            // this.loadSubTypes();
                          
                           /// alert(PassID);
                            //this.addClauses = false
                        })

                        .catch(() => {
                            Swal.fire(
                                "Failed",
                                "There was something wrong",
                                "warning"
                            );
                        });




        },
        loadDepartment() {
                axios.get("api/DepartmentList").then(({ data }) => (this.departments = data));
            },

        loadAuthorities() {
            axios.get("api/AuthorityList").then(({ data }) => (this.authorities = data));
        },

        loadUserType() {
            axios.get("api/MenuTypeDisplay").then(({ data }) => (this.types = data));
        },
		loadSubTypes(e) {
		//alert(e.target.value);
            axios.get("api/SubTypesList/" + e.target.value).then(({ data }) => (this.SubTypes = data));
            console.log(e.target.value);
            
        },

        LoadUsers() {
            axios.get("api/registrations/") .then(({ data }) => (this.users = data)  );
            /*axios.get('api/registrations').then((res) => {
                this.users = res.data
                // console.log(res.data);
            })*/
        }

    },

    created() {
        this.LoadUsers()
	    //this.loadSubTypes();
        this.loadDepartment();
        Fire.$on('AfterCreate',() => {
            this.loadDepartment();
        });


        this.loadAuthorities();
        Fire.$on('AfterCreate',() => {
            this.loadAuthorities();
        });


        this.loadUserType();
        Fire.$on('AfterCreate',() => {
            this.loadUserType();
        });
    }
}
</script>

