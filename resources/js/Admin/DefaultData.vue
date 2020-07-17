<template>
    <div>
 
             <section class="content" @mouseover="VerifyAccessRoles()"   v-if ="this.AllRolesList ==='NO ACCESS'" >
                <div class="box-header with-border box box-success" id="quotehead" >
                    <h1> <big class="label label-warning" >{{ this.AllRolesList }}</big></h1>
                    
                </div>
           </section>
       

        <section class="content" v-if ="this.AllRolesList ==='YES ACCESS'" >
            <div class="box box-success">
                <div class="box-header">
                   

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <!-- <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div> -->
                            <button class="btn btn-primary pull-right" @click="addModal">
                                <i class="fa fa-plus-circle"></i>
                                Add New
                            </button>
                        </div>
                    </div>
               
 <h1 >Default Data</h1>
                 <v-client-table 
                        :data="SubTypes"
                        :columns="columns" 
                        :options="options">
                    <div slot="actions" slot-scope="{ row }" v-if="row.active == 'Active'">
                                      
                                     <button class="btn btn-primary" @click="editModal(row)"><i class="fa fa-edit"></i>  Edit</button>
                                    <button class="btn btn-danger"   @click="softDelete(row._id)" disabled> <i class="fa fa-warning"></i> Remove </button>
                    </div>
                      <div slot="actions" slot-scope="{ row }" v-else>
                           <button class="btn btn-success" @click="SubTypeRestore(row._id)" disabled> <i class="fa fa-mail-forward"></i>Restore</button>
                      </div> 
                    </v-client-table>
             </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" v-if="editmode">Update Charges</h4>
                        <h4 class="modal-title" v-else>Add New Charges</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateDefaultData() : AddNewDefaultData()">
                        <div class="modal-body">
                   <div class="col-md-12"> 
                         <div class="form-group">
                             <div class="col-md-6" style="padding: 0px 2px;">
                                <label for="ChargesCode">Default Data No:</label>
                                <input v-model="form.DefaultDataNo" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter Default Data No">
                                </div>
                           

                            <div class="col-md-6" style="padding: 0px 2px;">
                                <label for="ChargesCode">LinesNo :</label>
                                <input v-model="form.LinesNo" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter LinesNo">
                            </div>
                         </div>
                            <div class="form-group" >
                                  <div class="col-md-12" style="padding: 0px 2px;">
                                <label for="ChargesRemarks">Name:</label>
                                <textarea v-model="form.NameDefault" class="form-control" cols="30" rows="5" placeholder="Name "></textarea>
                           </div>
                        </div>

                            <div class="form-group">
                                  <div class="col-md-4" style="padding: 0px 2px;">
                                        <label for="ChargesCode">Amount :</label>
                                        <input v-model="form.Amount" 
                                            class="form-control"
                                            type="text" 
                                            id="ChargesCode" 
                                            placeholder="Enter Amount">
                                </div>
                        
                                <div class="col-md-4" style="padding: 0px 2px;">
                                    <label for="ChargesCode">MinAmount :</label>
                                    <input v-model="form.MinAmount" 
                                        class="form-control"
                                        type="text" 
                                        id="ChargesCode" 
                                        placeholder="Enter MinAmount">
                                </div>
                            <div class="col-md-4" style="padding: 0px 2px;">
                                <label for="ChargesCode">Formula :</label>
                                <input v-model="form.Formula" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter Formula">
                            </div>

                    </div>
                      <div class="form-group">
                           <div class="col-md-4" style="padding: 0px 2px;">
                                <label for="ChargesCode">PerilsName :</label>
                                <input v-model="form.PerilsName" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter PerilsName">
                            </div>

                            <div class="col-md-4" style="padding: 0px 2px;">
                                <label for="ChargesCode">PerilsClass :</label>
                                <input v-model="form.PerilsClass" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter PerilsClass">
                            </div>
                            <div class="col-md-4" style="padding: 0px 2px;">
                                <label for="ChargesCode">Section :</label>
                                <input v-model="form.Section" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter Section">
                            </div>
                    </div>
                        <div class="form-group">
                                  <div class="col-md-12" style="padding: 0px 2px;">
                                <label for="ChargesRemarks">Description:</label>
                                <textarea v-model="form.Description" class="form-control" cols="30" rows="5" placeholder="Description "></textarea>
                        </div>
                        </div>
                    </div>

                        </div>
                        <div class="modal-footer"><br/>
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
// import Charges from '../../components/PageHeaders/ChargesHeader';
export default {
    // components: {
    //     Charges,
    // },
     mounted() {
           this.GetUserData();
        },


    data() {
        return {
            editmode: false,
            charges: {},
            SubCharges: {},
            AllRolesList: {},
            option: 'Charges Amount',


              SubTypes: {},

                columns: ['DefaultDataNo', 'LinesNo', 'NameDefault','Amount','MinAmount','Formula','PerilsName','PerilsClass','Section','Description','HowToUse','actions'],
                SubTypes: [],
                options: {
                    headings: {
                        
                        DefaultDataNo: 'DefaultDataNo',
                        LinesNo: 'LinesNo',
                        NameDefault: 'Name',
                        Amount: 'Amount',
                        MinAmount: 'Min.Amount',
                        Formula: 'Formula',
                        PerilsName: 'PerilsName',
                        PerilsClass: 'PerilsClass',
                        Section: 'Section',
                        Description: 'Description',
                        HowToUse: 'HowToUse',
                        action: "action"
                        
                    },
                    sortable: ['DefaultDataNo', 'LinesNo', 'NameDefault','Amount','MinAmount','Formula','PerilsName','PerilsClass','Section','Description','HowToUse'],
                    filterable: ['DefaultDataNo', 'LinesNo', 'NameDefault','Amount','MinAmount','Formula','PerilsName','PerilsClass','Section','Description','HowToUse']
                },




            form: new Form({
                _id: '',
              
                Active: '',
                   CustAcctNo: '',
                    PassURL: '',
                    LinesNo: '',
                    NameDefault: '',
                    DefaultDataNo: '',

                      Amount: '',
                      MinAmount: '', 
                      Formula: '',
                      PerilsName: '',
                      Description: '',
                      PerilsClass: '',
                      Section: '',
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
                    await axios.get("api/DefaultDataLoad").then(({ data }) => (this.SubTypes = data));
            },
              VerifyAccessRoles(){
                if( this.AllRolesList === "NO ACCESS"){
                    this.$router.push('/Dashboard'); 
                 
                }
                   
            },


        // getResults(page = 1) {
        //     axios.get('api/Charges?page=' + page).then(({data}) => {
        //         this.charges = data;
        //     });
        // },

        addModal() {
            this.editmode = false
            this.form.reset()
            $('#modal').modal('show')
        },

        editModal(val) {
            this.editmode = true;
            $('#modal').modal('show');
            this.form.fill(val);
        },
          updateDefaultData() {
            // Submit the form via a PUT request
            this.form.post('api/UpdateDefaultData/').then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Charges has been updated.',
                    'success'
                )
                this.GetUserData()
            }).catch(() => {

            });
        },

        AddNewDefaultData() {
           // this.form.post('api/charges').then(() => {
           this.form.post('api/AddNewDefaultData').then(() => {
                $('#modal').modal('hide')
                this.GetUserData()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

      

        // deleteCharges(_id) {
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         // Send request to the server
        //         if (result.value) {
        //             this.form.delete('api/charges/'+_id).then(() => {
        //                 Swal.fire(
        //                     'Deleted!',
        //                     'Your file has been deleted.',
        //                     'success'
        //                 )
        //                 // Success
        //                 this.loadCarBrand()
        //             }).catch(() => {
        //                 Swal.fire('Failed', 'There was something wrong', 'warning');
        //             });
        //         }
        //     })
        // },

        // softDelete(_id) {
        //     axios.delete('api/charge/'+_id).then(() => {
        //         Swal.fire(
        //             'Inactive!',
        //             'Charges was Inactive.',
        //             'error'
        //         )
        //         // Success
        //         this.loadCarBrand()
        //     }).catch(() => {

        //     });
        // },

        // restore(_id) {
        //     axios.put('api/charge/' +_id).then(() => {
        //         Swal.fire(
        //             'Restored!',
        //             'Charges was Restore.',
        //             'success'
        //         )
        //         // Success!
        //         this.loadCarBrand()
        //     }).catch(() => {

        //     });
        // },

        // loadCarBrand() {
        //     axios.get('api/Charges').then(({data}) => {
        //         this.charges = data
        //     })

        //     axios.get('api/SubCharges').then(({data}) => {
        //         this.SubCharges = data
        //     })
        // }
    },

    // created() {
    //     this.loadCarBrand()
    // }
}
</script>