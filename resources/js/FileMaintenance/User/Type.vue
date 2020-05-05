<template>
    <div>
        <TypeHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">User Type</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <!-- <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div> -->
                            <button class="btn btn-primary pull-right" @click="newModal">
                                <i class="fa fa-plus-circle"></i>
                                Add New
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Type Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in types.data" :key="value._id">
                                <td >
                                  
                                        {{value.type_name}}
                                </td>
                                <td>
                                    <span class="label label-success" v-if="value.active == 1 || value.active == '1'">Active</span>
                                    <span class="label label-danger" v-else>Inactive</span>
                                </td>
                                <td v-if="value.active == 1 || value.active == '1'">
                                    <button class="btn btn-primary" @click="editModal(value)">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-danger" @click="softDelete(value._id)">
                                        <i class="fa fa-warning"></i>
                                        Inactive
                                    </button>
                                </td>
                                <td v-else>
                                    <button class="btn btn-success" @click="ActivateRecord(value._id)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <!-- <button class="btn btn-danger" @click="deleteUserType(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="types" :limit="2" @pagination-change-page="getResults" class="pull-right">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
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
                        <h4 class="modal-title" v-if="editmode">Update Type</h4>
                        <h4 class="modal-title" v-else>Add New Type</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateType() : addType()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="TypeName">Type Name :</label>
                                <input 
                                    v-model="form.type_name"
                                    class="form-control"
                                    type="text" 
                                    id="TypeName" 
                                    placeholder="Enter Type Name">
                            </div>
                        </div>

                         <div class="modal-body">
                            <div class="form-group">
                                <label for="TypeName">Menu Icon:</label>
                                <input 
                                    v-model="form.icon_display"
                                    class="form-control"
                                    type="text" 
                                    id="TypeName" 
                                    placeholder="Enter Icon e.g fa fa-circle-o">
                            </div>
                        </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label for="type_name">Under Sub Menu:</label>
                                <select class="form-control" v-model="form.UnderSubMenu"  >
                                    <option selected disabled  > Pls.Select</option>
                                    <option    v-for="MainTypes in MainType.data" :key="MainTypes._id"  v-bind:value="MainTypes._id + ';;' + MainTypes.type_name"  >{{ MainTypes.type_name }}</option>
                                </select>
                                {{ form.UnderSubMenu}}
                            </div>
                    </div>

                      <div class="modal-body">
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
import TypeHeader from '../../components/PageHeaders/TypeHeader';
export default {
    mounted() {
        console.log('Component mounted.')
             this.loadType();
             this.loadMainType();
    },

    components: {
        TypeHeader
    },

    data() {
        return {
            editmode: false,
            types: {},
            MainType: {},
            form: new Form({
                _id: '',
                type_name: '',
                active: '',
                icon_display: '',
                UnderSubMenu: '',
                UserMenu: '',
                
                
            }),
        }
    },

    methods: {
        editModal(type) {
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show')
            this.form.fill(type);
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show')
        },

        addType() {
            // Submit the form via a POST request
            this.form.post('api/MenuTypeAddNew').then(() => {
                // Success!
                             Swal.fire(
                                    " NEW RECORD ",
                                    " New Record has been ADDED",
                                    "success"
                                );
                                 this.loadType();
                                 this.loadMainType();

                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
            }).catch(() => {

            });
        },

        updateType() {
            // Submit the form via a PUT request
            this.form.post('api/MenuTypeUpdate').then(() => {
                // Success!
                                Swal.fire(
                                    " UPDATED ",
                                    " Record has been UPDATED",
                                    "success"
                                );
                                
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
                             this.loadType();
                                 this.loadMainType();
            }).catch(() => {
                            Swal.fire(
                                    " UPDATED ",
                                    " Incouter Problem in Updating",
                                    "warning"
                                );

            });
        },

        deleteType(_id) {
            this.form.delete('api/types/'+_id).then(() => {
                // Success
                Fire.$emit('AfterCreate');
            }).catch(() => {

            });
        },

        softDelete(_id) {
            axios.delete('api/RecordDeletes/'+_id).then(() => {
                // Success
                Fire.$emit('AfterCreate');
            }).catch(() => {

            });
        },

        ActivateRecord(_id) {
            axios.put('api/ActivateRecord/'+_id).then(() => {
                // SuccesssoftDelete
                Fire.$emit('AfterCreate');
            }).catch(() => {

            });
        },

        loadType() {
            axios.get("api/MenuType").then(({ data }) => (this.types = data));
        },

          loadMainType() {
            axios.get("api/MenuTypeDisplay").then(({ data }) => (this.MainType = data));
        },
    },

    created() {
        this.loadType();
        Fire.$on('AfterCreate',() => {
            this.loadType();
        });
         this.loadMainType();
        Fire.$on('AfterCreate',() => {
           
            this.loadMainType();
        });
    }
}
</script>
