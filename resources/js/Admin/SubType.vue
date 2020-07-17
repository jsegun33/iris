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
               <h1>SUB Menu</h1>    
                            <button class="btn btn-primary pull-left" @click="newModal">
                                <i class="fa fa-plus-circle"></i>
                                Add New
                            </button>
                    <v-client-table 
                        :data="SubTypes"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }" v-if="row.active == 'Active'">
                                      
                                     <button class="btn btn-primary" @click="editModal(row)"><i class="fa fa-edit"></i>  Edit</button>
                                    <button class="btn btn-danger"   @click="softDelete(row._id)"> <i class="fa fa-warning"></i> Remove </button>
                    </div>
                      <div slot="actions" slot-scope="{ row }" v-else>
                           <button class="btn btn-success" @click="SubTypeRestore(row._id)"> <i class="fa fa-mail-forward"></i>Restore</button>
                      </div> 
                    </v-client-table>
                   
                </div>

         </section>



      

        <!-- Modal -->
        <div class="modal fade" id="addNew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" v-if="editmode">Update Sub Type</h4>
                        <h4 class="modal-title" v-else>Add New Sub Type</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateType() : addType()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type_name">Sub Type/ Menu:</label>
                                <input v-model="form.SubLink_TypeName" 
                                    class="form-control"
                                    type="text" 
                                    id="SubLink_TypeName" 
                                    placeholder="Enter Sub Type Name">
                            </div>
                            <div class="form-group">
                                <label for="type_name">Type/ Menu:</label>
                                <select class="form-control" v-model="form.MainMenuType" required >
                                    <option    v-for="MainTypes in MainType.data" :key="MainTypes._id"  v-bind:value="MainTypes._id + ';;' + MainTypes.type_name "  >{{ MainTypes.type_name }}</option>
                                </select>
                                <small>Selected :{{ form.DisMenu }} </small>
                            </div>
                            <div class="form-group">
                                <label for="type_name">Sub Type URL:</label>
                                <input v-model="form.SubLink_URL" type="text" name="SubLink_TypeURL" class="form-control" placeholder="URL ">
                                
                            </div>

                            <div class="form-group">
                                <label for="TypeName">Menu Icon:</label>
                                <input 
                                    v-model="form.icon_display"
                                    class="form-control"
                                    type="text" 
                                    id="TypeName" 
                                    placeholder="Enter Icon e.g fa fa-circle-o">
                            </div>
                             
                               <div class="form-group">
                                <label for="type_name">Customer / Store Menu ?</label>
                                <select class="form-control" v-model="form.UserMenu"  >
                                     <option selected disabled  > Pls.Select</option>
                                     <option value="1"  > YES</option>
                                      <option value="0"  > NO</option>
                                 </select>
                             
                            </div>
                            


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" v-if="editmode">Update</button>
                            <button type="submit" class="btn btn-primary" v-else>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
            types: {},
            MainType: {},
            SubTypes: {},

                         columns: ['SubLink_TypeName', 'SubLink_URL', 'type_name','active','actions'],
                SubTypes: [],
                options: {
                    headings: {
                        
                        SubLink_TypeName: 'Type Name',
                        SubLink_URL: 'URL',
                        type_name: 'Type / Menu',
                        active: 'Status',
                      
                       
                        action: "action"
                        
                    },
                    sortable: ['SubLink_TypeName', 'SubLink_URL', 'type_name','active'],
                    filterable: ['SubLink_TypeName', 'SubLink_URL', 'type_name','active']
                },



            form: new Form({
                _id: '',
                type_name: '',
                SubLink_TypeName: '',
                SubLink_URL: '',
                active: '',
                icon_display: '',
                UserMenu:'',
                DisMenu:'',
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
                     this.loadType();
                    this.loadMainType();
            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },


        //    getResults(page = 1) {
        //         axios.get('api/SubTypesLoad?page=' + page).then(response => {
        //             this.SubTypes = response.data;
        //         });
        //     },


        editModal(row) {
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show')
            this.form.fill(row);
               this.form.DisMenu = row.type_name;
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show')
        },

        addType() {
            // Submit the form via a POST request
            this.form.post('api/SubTypes').then(() => {
                             Swal.fire(
                                    " NEW RECORD ",
                                    " New Record has been ADDED",
                                    "success"
                                );
                // Success!
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                 this.loadType();
        this.loadMainType();
            }).catch(() => {

            });
        },

        updateType() {
            // Submit the form via a PUT request
            this.form.post('api/UpdateTypeSubLink/').then(() => {
                // Success!
                             Swal.fire(
                                    " UPDATE ",
                                    " Record has been UPDATED",
                                    "success"
                                );
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                        this.loadType();
                     this.loadMainType();
            }).catch(() => {

            });
        },

        SubTypeRestore(_id) {
                axios.put('api/SubTypeRestore/'+_id).then(() => {
               this.loadType();
               this.loadMainType()
            }).catch(() => {

            });
        },

        softDelete(_id) {
            axios.delete('api/SubTypeDelete/'+_id).then(() => {
                this.loadType();
               this.loadMainType()
            }).catch(() => {

            });
        },

       async loadType() {
           await axios.get("api/SubTypesLoad").then(({ data }) => (this.SubTypes = data));
        },
       async loadMainType() {
           await  axios.get("api/MenuTypeDisplay").then(({ data }) => (this.MainType = data));
        },
    },

    // created() {
    //     this.loadType();
    //     this.loadMainType();
    //     Fire.$on('AfterCreate',() => {
    //         this.loadType();
    //         this.loadMainType();
    //     });
    // }
}
</script>
