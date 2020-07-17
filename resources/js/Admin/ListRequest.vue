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
               <h1>All Request</h1>    
                           
                    <v-client-table 
                        :data="SubTypes"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }" >
                                     <button class="btn btn-primary" @click="editModal(row)"><i class="fa fa-edit"></i>  Edit</button>
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
                        <h4 class="modal-title" v-if="editmode">Update Request</h4>
                      
                    </div>

                    <form @submit.prevent="editmode ? updateType() : addType()">
                        <div class="modal-body">
                          
                            <div class="form-group">
                                <label for="type_name">Mktg Assigned:</label>
                                <select class="form-control" v-model="form.InchargeName"  >
                                         <option    v-for="GetAQ in MainType" :key="GetAQ._id"  v-bind:value="GetAQ.AccountNo + ';;' + GetAQ.CName"  >{{ GetAQ.CName }}</option>
                                </select>
                                <small>Selected :{{ form.DisMenu }} </small>
                            </div>
                               <div class="form-group">
                                <label for="type_name">UW Assigned:</label>
                                <select class="form-control" v-model="form.InchargeNameUW"  >
                                         <option    v-for="GetIQ in GetUWStaff" :key="GetIQ._id"  v-bind:value="GetIQ.AccountNo + ';;' + GetIQ.CName"  >{{ GetIQ.CName }}</option>
                                </select>
                                <small>Selected :{{ form.DisMenuUW }} </small>
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
            GetUWStaff: {},

                         columns: ['RequestNo', 'CustAcctNO', 'AcctName','MktgInchargeName','MktgInchargeCode','UWInchargeName','UWInchargeCode','PaymentGateway','PaymentMode','actions'],
                SubTypes: [],
                options: {
                    headings: {
                        
                        RequestNo: 'RequestNo',
                        CustAcctNO: 'Requester Acct',
                        AcctName: 'Requester Name' ,
                        MktgInchargeName: 'Mktg Name',
                        MktgInchargeCode: 'Mktg Act ', 
                        UWInchargeName: 'UW Name & Auth Inter.',
                        UWInchargeCode: 'UW Code & Auth Inter.', 
                        PaymentGateway: 'Payment', 
                         PaymentMode: 'PaymentStatus', 
                      
                       
                        action: "action"
                        
                    },
                    sortable: ['RequestNo', 'CustAcctNO', 'AcctName','MktgInchargeName','MktgInchargeCode','UWInchargeName','UWInchargeCode','PaymentGateway','PaymentMode'],
                    filterable: ['RequestNo', 'CustAcctNO', 'AcctName','MktgInchargeName','MktgInchargeCode','UWInchargeName','UWInchargeCode','PaymentGateway','PaymentMode']
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
               this.form.DisMenu    = row.MktgInchargeName;
               this.form.DisMenuUW  = row.UWInchargeName;
               this.form.RequestNo  = row.RequestNo;
               
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show')
        },

        // addType() {
          
        //     this.form.post('api/SubTypes').then(() => {
        //                      Swal.fire(
        //                             " NEW RECORD ",
        //                             " New Record has been ADDED",
        //                             "success"
        //                         );
              
        //         Fire.$emit('AfterCreate');
        //         $('#addNew').modal('hide')
        //          this.loadType();
        //         this.loadMainType();
        //     }).catch(() => {

        //     });
        // },

        updateType() {
            // Submit the form via a PUT request
            this.form.post('api/ModifyAssignedAcct/').then(() => {
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

        // SubTypeRestore(_id) {
        //         axios.put('api/SubTypeRestore/'+_id).then(() => {
        //        this.loadType();
        //        this.loadMainType()
        //     }).catch(() => {

        //     });
        // },

        softDelete(_id) {
            axios.delete('api/SubTypeDelete/'+_id).then(() => {
                this.loadType();
               this.loadMainType()
            }).catch(() => {

            });
        },

       async loadType() {
           await axios.get("api/ListRequestAll").then(({ data }) => (this.SubTypes = data));
           await  axios.get("api/GetListMktgStaff").then(({ data }) => (this.MainType = data));
           await  axios.get("api/GetListUWStaff").then(({ data }) => (this.GetUWStaff = data));
        },
     

    },

  
}
</script>
