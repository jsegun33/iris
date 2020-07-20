<template>
<div>

         <section class="content" v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                </div>
           </section>

<!--            
          <section class="content" v-show="isShowingLoading" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >Loading... {{ this.IntervalLoading  }}</big></h1>
                </div>
         </section> -->

    <section class="content" v-if ="this.AllRolesList ==='YES ACCESS'">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
            </div>
             <!-- <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
             <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css"> -->

            <form @submit.prevent="addAuthority()">
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
                                      <select v-model="form.select_department" class="form-control" id="select_department" name="select_department">
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
                                <input v-model="form.password" type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>


                           
                        
                    </div>
                      <legend>Set Commission:</legend>
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

                         <div class="col-md-3">
                            <div class="form-group">
                               <button  type="button" class="btn btn-warning" @click="DeleteNewTRComm(index)" >-</button>
                                <button  type="button" class="btn btn-primary" @click="AddNewTRComm"  >+</button>             
                             </div>
                        </div>


                    </div>
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
                  
                        
                    </div>
           




                       <!-- <div class="table-responsive">
                            <table class="table table-condensed" >
                               
                                  <tr v-for="(tryLoop , index)  in LoopTR1"  :key="index" >
                                            <td>
                                                    <select  v-model="form.ClassName[index]" class="form-control"   >
                                                            <option v-for="GetLinesComms in GetLinesComm" :key="GetLinesComms._id"  v-bind:value="GetLinesComms.ClassName + ';;' + GetLinesComms.Class">{{ GetLinesComms.ClassName }} </option>
                                                    </select>
                                             </td>
                                                       
                                             <td v-for="Commission in GetPerilsComm" :key="Commission._id" >
                                                 {{ Commission.PerilsCode }} 
                                                     <input type="number"     v-model="form.AmountCommInput[Commission._id + index ]" style="width:100px" />
                                               
                                             </td> -->
                                             
                                                 
                                             
                                            <!-- <td >
                                              <select @change="GetPerilsChange()" v-model="form.AmountComm[index]" class="form-control" >
                                                    <option  v-for="Commission in GetPerilsComm" :key="Commission._id"      v-bind:value="Commission.PerilsName + ';;' + Commission.PerilsNo + ';;' +Commission.PerilsCode">{{ Commission.PerilsName}} 
                                                               

                                                    </option>
                                            </select>
                                                    {{ form.DisplayPerils  }}

                                            </td> -->



                                            <!-- <td>
                                                <md-select @md-selected="SelectPerilsName($event)"    v-model="form.AmountComm[index]"  class="form-control" md-dense multiple >
                                                        <md-option   v-for="Commission in GetPerilsComm" :key="Commission._id"      v-bind:value="Commission.PerilsName + ';;' + Commission.PerilsNo + ';;' +Commission.PerilsCode">{{ Commission.PerilsName}}
                                                         </md-option>
                                                           
                                                 </md-select>

                                             {{ form.AmountCommInputArray[[form.AmountCommID][index]] }}
                                        
                                            </td> -->

                                             <!-- <td>
                                                 <input type="number" @change="ChangeAmountPerils()" v-model="form.AmountCommInputArray[[form.AmountCommID][index]]" />
                                              </td> -->
                                           
<!-- 
                                           
                                           
                                
                                </tr>  

                                       
                                
                             </table >
                            
                     </div>
                     -->
  
    <!-- <pre>{{  $data }}</pre> -->
 <fieldset>
    <legend>Set Privileges:</legend>
                    <div class="row"  v-for="(tryLoop , index)  in LoopTR"  :key="index">
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
                        <button  type="button" class="btn btn-warning" @click="DeleteNewTR(index)">-</button>
                     

                    </div>
            </fieldset>
                     <button  type="button" class="btn btn-primary" @click="AddNewTR">+</button>
                </div>
                <!--------<pre> {{ $data }}</pre>-------->
                <div class="box-footer">
                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                    <button  type="submit" class="btn btn-primary pull-left">Submit</button>
                    <a v-bind:href="'/View-User-List'" class="btn btn-info pull-right" style="text-decoration: none;"> <i class="fa fa-eye"></i>  View User's List  </a> 
                                        
                                        
                     
                </div>
            </form>
        </div>
	<!--------<pre>{{ $data }}</pre>-------->
        </div>
        </div>

       
    </section>
      <!-- ------<pre>{{ $data }}</pre>------- -->

    </div>
	
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
               
        this.GetUserData();
        // this.StartLoading();
    },

    data() {
        return {
           // users: {},
            UserDetails: {},
            AllRolesList: {},
            GetPerilsComm: {},
            GetLinesComm: {},
             LoopTR: [ {}] ,
              LoopTR1: [ {}] ,
               LoopTR3: [{}] ,
          //select_authority: ['b'], // Array reference
            editmode: false,   
            authorities: {},  
            types: {},  
            departments:{},
            SubTypes:{},
            
            IntervalLoading:null,
                IntervalLoading1:null,
                 isShowingLoading:true,
                 isShowingRecord:false,
                 timedCount:5000,
                 timer:0,
                 clock:47,
                 timer_is_on:0,



            form: new Form({
                _id: '',
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
                CustAcctNo: '',

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
                      await  axios.get("api/GetPerilsComm/").then(({ data }) => ( this.GetPerilsComm = data  )); 
                      await  axios.get("api/GetLinesComm/").then(({ data }) =>  (  this.GetLinesComm = data ));
                        await axios.get("api/DepartmentList").then(({ data }) => (this.departments = data));
        
            await  axios.get("api/AuthorityList").then(({ data }) => (this.authorities = data));
           await axios.get("api/MenuTypeDisplay").then(({ data }) => (this.types = data));
           await   axios.get("api/SubTypesList/" + e.target.value).then(({ data }) => (this.SubTypes = data));
          // await axios.get("api/registrations/") .then(({ data }) => (this.users = data)  );
           
      

            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },
   async loadUserType() {
           await axios.get("api/MenuTypeDisplay").then(({ data }) => (this.types = data));
        },
	async loadSubTypes(e) {
		//alert(e.target.value);
          await  axios.get("api/SubTypesList/" + e.target.value).then(({ data }) => (this.SubTypes = data));
            console.log(e.target.value);
            
        },

        //  LoadingDesign(){
        //                 this.IntervalLoading  = this.clock;
        //                 this.clock = this.IntervalLoading - 1;
        //                 this.timer = setTimeout(this.LoadingDesign, 1000/60);
        //     },
        //     StartLoading() {
 
        //           if (!this.timer_is_on) {
        //               this.timer_is_on = 1;
        //               this.LoadingDesign();
        //           }
                    
              
        //     },



        // LoadAllRolesList(){
        //      this.RetrieveTimeInterval = setInterval(() => {

        //                         clearTimeout(this.timer);   //clear timer /loading
        //                         this.timer_is_on = 0; //clear timer /loading
        //                         this.isShowingLoading = false; //clear timer /loading
        //                         this.isShowingRecord = true; 


        //            this.form.CustAcctNo         = this.UserDetails.AccountNo;
        //            this.form.post("api/GetAllUserAccessRole"  ).then(({ data }) => (this.AllRolesList = data));

        //         },200);    
        //      this.RetrieveTimeInterval2 = setInterval(() => {
		// 						clearInterval(this.RetrieveTimeInterval);
        //             },500); 	
      
        // } ,  
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
                           this.GetUserData();
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
      
    },

    // created() {
    //     this.LoadUsers()
	  
    //     this.loadDepartment();
    //     Fire.$on('AfterCreate',() => {
    //         this.loadDepartment();
    //     });


    //     this.loadAuthorities();
    //     Fire.$on('AfterCreate',() => {
    //         this.loadAuthorities();
    //     });


    //     this.loadUserType();
    //     Fire.$on('AfterCreate',() => {
    //         this.loadUserType();
    //     });
    // }
}
</script>

