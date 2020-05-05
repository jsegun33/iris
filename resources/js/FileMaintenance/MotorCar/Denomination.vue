<template>
    <div>
        <DenominationHeader/>
        
        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car Denomination</h3>

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
                                <th>Denomination No</th>
                                <th>Denomination Name</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in denomination.data" :key="value._id">
                                <td>{{value.SubLinesNo}}</td>
                                <td>{{value.SubLinesName}}</td>
                                <td>{{value.Class}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.Active == 1 || value.Active == '1'">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td v-if="value.Active == 1 || value.Active == '1'">
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
                                    <button class="btn btn-danger" @click="deleteDenomination(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="denomination" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Denomination</h4>
                        <h4 class="modal-title" v-else>Add New Denomination</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateDenomination() : createDenomination()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="SubLinesCode">Denomination Code :</label>
                                <input v-model="form.SubLinesCode" 
                                    class="form-control"
                                    type="text" 
                                    id="SubLinesCode" 
                                    placeholder="Enter Denomination Code">
                            </div>
                            <div class="form-group">
                                <label for="SubLinesName">Denomination Name :</label>
                                <input v-model="form.SubLinesName" 
                                    class="form-control"
                                    type="text" 
                                    id="SubLinesName" 
                                    placeholder="Enter Denomination Name">
                            </div>
                            <div class="form-group">
                                <label for="Class">Class :</label>
                                <select v-model="form.Class" class="form-control" id="Class">
                                    <option value="" selected disabled>Select a Class</option>
                                    <option :value="value.ClassNo" v-for="value in classes" :key="value._id">{{value.ClassName}}{{value.ClassInputNo}}</option>
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
import DenominationHeader from '../../components/PageHeaders/DenominationHeader'
export default {
    components: {
        DenominationHeader,
    },

    data() {
        return {
            editmode: false,
            denomination: {},
            classes: {},

            form: new Form({
                _id: '',
                SubLinesCode: '',
                SubLinesName: '',
                Class: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/denomination?page=' + page).then(({data}) => {
                this.denomination = data;
            });
        },

        addModal() {
            this.editmode = false
            this.form.reset()
            $('#modal').modal('show')
        },

        editForm(val) {
            this.editmode = true
            $('#modal').modal('show')
            this.form.fill(val)
        },

        createDenomination() {
            this.form.post('api/denomination').then(() => {
                $('#modal').modal('hide')
                this.loadDenomination()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateDenomination() {
            // Submit the form via a PUT request
            this.form.put('api/denomination/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Denomination has been updated.',
                    'success'
                )
                this.loadDenomination()
            }).catch(() => {

            });
        },

        deleteDenomination(_id) {
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
                    this.form.delete('api/denomination/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadDenomination()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/denominations/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Denomination was Inactive.',
                    'error'
                )
                // Success
                this.loadDenomination()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/denominations/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Denomination was Restore.',
                    'success'
                )
                // Success!
                this.loadDenomination()
            }).catch(() => {

            });
        },

        loadDenomination() {
            axios.get('api/denomination').then(({data}) => {
                this.denomination = data
            })
        },

        loadClass() {
            axios.get('api/CarClass').then(({data}) => {
                this.classes = data
            })
        }
    },

    created() {
        this.loadDenomination()
        this.loadClass()
    }
}
</script>