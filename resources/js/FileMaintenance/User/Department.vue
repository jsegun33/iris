<template>
    <div>
        <DepartmentHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">User Departments</h3>

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
                                <th>Department Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in departments.data" :key="value._id">
                                <td>{{value.department_name}}</td>
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
                                    <button class="btn btn-success" @click="DepartmentRestore(value._id)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <!-- <button class="btn btn-danger" @click="deleteUserDepartment(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="departments" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Department</h4>
                        <h4 class="modal-title" v-else>Add New Department</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateDepartment() : addDepartment()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="DepartmentName">Department Name :</label>
                                <input 
                                    v-model="form.department_name"
                                    class="form-control"
                                    type="text" 
                                    id="DepartmentName" 
                                    placeholder="Enter Department Name">
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
import DepartmentHeader from '../../components/PageHeaders/DepartmentHeader'
export default {
    mounted() {
        console.log('Component mounted.')
    },

    components: {
        DepartmentHeader
    },

    data() {
        return {
            editmode: false,
            departments: {},
            form: new Form({
                _id: '',
                department_name: '',
                active: '1',
            }),
        }
    },

    methods: {
        editModal(department) {
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show')
            this.form.fill(department);
        },

        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show')
        },

        addDepartment() {
            // Submit the form via a POST request
            this.form.post('api/DepartmentAddNew').then(() => {
                // Success!
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
            }).catch(() => {

            });
        },

        updateDepartment() {
            // Submit the form via a PUT request
            this.form.put('api/DepartmentUpdate/' +this.form._id).then(() => {
                // Success!
                Fire.$emit('AfterCreate');
                $('#addNew').modal('hide')
            }).catch(() => {

            });
        },

        DepartmentRestore(_id) {
            this.form.put('api/DepartmentRestore/'+_id).then(() => {
                // Success
                Fire.$emit('AfterCreate');
            }).catch(() => {

            });
        },

        softDelete(_id) {
            axios.delete('api/DepartmentDelete/'+_id).then(() => {
                // Success
                Fire.$emit('AfterCreate');
            }).catch(() => {

            });
        },

        loadDepartment() {
            axios.get("api/Department").then(({ data }) => (this.departments = data));
        }
    },

    created() {
        this.loadDepartment();
        Fire.$on('AfterCreate',() => {
            this.loadDepartment();
        });
    }
}
</script>
