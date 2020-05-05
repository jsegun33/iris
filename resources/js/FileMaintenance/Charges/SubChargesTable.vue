<template>
    <div>
        <SubChargesHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Sub Charges</h3>

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
                                <th>Sub Charges No</th>
                                <th>Sub Charges Name</th>
                                <th>Sub Charges Amount</th>
                                <th>Sub Charges Remarks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in SubCharges.data" :key="value._id">
                                <td>{{value.SubChargesNo}}</td>
                                <td>{{value.SubChargesName}}</td>
                                <td>{{value.SubChargesAmount}}</td>
                                <td>{{value.SubChargesRemarks}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.Active === 1 || value.Active === '1'">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td v-if="value.Active === 1 || value.Active === '1'">
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
                                    <button class="btn btn-danger" @click="deleteSubCharges(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="charges" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Charges</h4>
                        <h4 class="modal-title" v-else>Add New Charges</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateSubCharges() : createSubCharges()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="SubChargesCode">Sub Charges Code :</label>
                                <input v-model="form.SubChargesCode" 
                                    class="form-control"
                                    type="text" 
                                    id="SubChargesCode" 
                                    placeholder="Enter Sub Charges Code">
                            </div>
                            <div class="form-group">
                                <label for="SubChargesName">Sub Charges Name :</label>
                                <input v-model="form.SubChargesName" 
                                    class="form-control"
                                    type="text" 
                                    id="SubChargesName" 
                                    placeholder="Enter Sub Charges Name">
                            </div>
                            <div class="form-group">
                                <label for="SubChargesAmount">Sub Charges Amount :</label>
                                <input v-model="form.SubChargesAmount" 
                                    class="form-control"
                                    type="text" 
                                    id="SubChargesAmount" 
                                    placeholder="Enter Sub Charges Amount">
                            </div>
                            <div class="form-group">
                                <label for="SubChargesRemarks">Sub Charges Remarks :</label>
                                <textarea v-model="form.SubChargesRemarks" class="form-control" cols="30" rows="5" placeholder="Write a remarks..."></textarea>
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
import SubChargesHeader from '../../components/PageHeaders/SubChargesHeader';
export default {
    components: {
        SubChargesHeader,
    },

    data() {
        return {
            editmode: false,
            SubCharges: {},

            form: new Form({
                _id: '',
                SubChargesCode: '',
                SubChargesName: '',
                SubChargesAmount: '',
                SubChargesRemarks: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/SubCharges?page=' + page).then(({data}) => {
                this.charges = data;
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

        createSubCharges() {
            this.form.post('api/sub-charges').then(() => {
                $('#modal').modal('hide')
                this.loadCarBrand()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateSubCharges() {
            // Submit the form via a PUT request
            this.form.put('api/sub-charges/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Sub Charges has been updated.',
                    'success'
                )
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        deleteSubCharges(_id) {
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
                    this.form.delete('api/sub-charges/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadCarBrand()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/sub-charge/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Sub Charges was Inactive.',
                    'error'
                )
                // Success
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/sub-charge/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Sub Charges was Restore.',
                    'success'
                )
                // Success!
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        loadCarBrand() {
            axios.get('api/SubCharges').then(({data}) => {
                this.SubCharges = data
            })
        }
    },

    created() {
        this.loadCarBrand()
    }
}
</script>