<template>
    <div>
        <ClassHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car Class / Kind</h3>

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
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover text-center">
                        <tbody>
                            <tr>
                                <th>Sub Lines No</th>
                                <th>Class Name</th>
                                <th>Class Input No</th>
                                <th>Class No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in classes.data" :key="value._id">
                                <td>{{value.SubLinesClassNo}}</td>
                                <td>{{value.ClassName}}</td>
                                <td>{{value.ClassInputNo}}</td>
                                <td>{{value.ClassNo}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.Active == 1">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td v-if="value.Active == 1">
                                    <button class="btn btn-primary" @click="editForm(value)">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-warning" @click="softDelete(value._id)">
                                        <i class="fa fa-warning"></i>
                                        Inactive
                                    </button>
                                </td>
                                <td v-else>
                                    <button class="btn btn-primary" @click="restore(value._id)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <button class="btn btn-danger" @click="deleteClass(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="classes" @pagination-change-page="getResults">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
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
                        <h4 class="modal-title" v-if="editmode">Update Clas / Kind</h4>
                        <h4 class="modal-title" v-else>Add New Clas / Kind</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateClass() : createClass()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ClassName">Class Name :</label>
                                <input v-model="form.ClassName" 
                                    class="form-control"
                                    type="text" 
                                    id="ClassName" 
                                    placeholder="Enter Class Name">
                            </div>
                            <div class="form-group">
                                <label for="ClassInputNo">Class Input No :</label>
                                <input v-model="form.ClassInputNo" 
                                    class="form-control"
                                    type="text" 
                                    id="ClassInputNo" 
                                    placeholder="Enter Class Input No">
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
import ClassHeader from '../../components/PageHeaders/ClassHeader'
export default {
    components: {
        ClassHeader,
    },

    data() {
        return {
            editmode: false,
            classes: {},

            form: new Form({
                _id: '',
                ClassName: '',
                ClassInputNo: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/class?page=' + page).then(({data}) => {
                this.classes = data;
            });
        },

        addModal() {
            this.editmode = false
            this.form.reset()
            $('#modal').modal('show')
        },

        editForm(val) {
            this.editmode = true;
            $('#modal').modal('show');
            this.form.fill(val);
        },

        createClass() {
            this.form.post('api/class').then(() => {
                $('#modal').modal('hide')
                this.loadClass()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateClass() {
            // Submit the form via a PUT request
            this.form.put('api/class/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Class / Kind has been updated.',
                    'success'
                )
                this.loadClass()
            }).catch(() => {

            });
        },

        deleteClass(_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // Send request to the server
                if (result.value) {
                    this.form.delete('api/class/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadClass()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/car-class/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Class / Kind was Inactive.',
                    'error'
                )
                // Success
                this.loadClass()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/car-class/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Class / Kind was Restore.',
                    'success'
                )
                // Success!
                this.loadClass()
            }).catch(() => {

            });
        },

        loadClass() {
            axios.get('api/class').then(({data}) => {
                this.classes = data
            })
        }
    },

    created() {
        this.loadClass()
    }
}
</script>