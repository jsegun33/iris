<template>
    <div>
        <Charges/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Charges</h3>

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
                                <th>Charges No</th>
                                <th>Charges Name</th>
                                <th>Charges Amount</th>
                                <th>Charges Remarks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in charges.data" :key="value._id">
                                <td>{{value.ChargesNo}}</td>
                                <td>{{value.ChargesName}}</td>
                                <td>{{value.ChargesAmount}}</td>
                                <td>{{value.ChargesType}}</td>
                                <td>{{value.ChargesRemarks}}</td>
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
                                    <button class="btn btn-danger" @click="deleteCharges(value._id)">
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

                    <form @submit.prevent="editmode ? updateCharges() : createCharges()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ChargesCode">Charges Code :</label>
                                <input v-model="form.ChargesCode" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesCode" 
                                    placeholder="Enter Charges Code">
                            </div>
                            <div class="form-group">
                                <label for="ChargesName">Charges Name :</label>
                                <input v-model="form.ChargesName" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesName" 
                                    placeholder="Enter Charges Name">
                            </div>
                            <div class="form-group">
                                <label for="ChargesAmount">Charges Amount :</label>
                                <input 
                                    v-model="option"
                                    type="radio"
                                    value="Charges Amount">
                                    Charges Amount
                                <input 
                                    v-model="option"
                                    type="radio"
                                    value="Sub Charges">
                                    Sub Charges
                                <input 
                                    v-if="option === 'Charges Amount'"
                                    v-model="form.ChargesAmount" 
                                    class="form-control"
                                    type="text" 
                                    id="ChargesAmount" 
                                    placeholder="Enter Charges Amount">
                                <div  
                                    v-else
                                    v-for="value in SubCharges.data" 
                                    :key="value._id">
                                    <div class="sub-group">
                                        <input 
                                            v-model="form.SubChargesAmount"
                                            :value="value"
                                            :id="value._id"
                                            type="checkbox">
                                        <label :for="value._id">{{ value.SubChargesName }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ChargesType">Charges Type :</label>
                                <select v-model="form.ChargesType" class="form-control">
                                    <option value="" selected disabled>Select Charges Type</option>
                                    <option value="Decimal">Decimal</option>
                                    <option value="Percent">Percent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ChargesRemarks">Charges Remarks :</label>
                                <textarea v-model="form.ChargesRemarks" class="form-control" cols="30" rows="5" placeholder="Write a remarks..."></textarea>
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
import Charges from '../../components/PageHeaders/ChargesHeader';
export default {
    components: {
        Charges,
    },

    data() {
        return {
            editmode: false,
            charges: {},
            SubCharges: {},
            option: 'Charges Amount',

            form: new Form({
                _id: '',
                ChargesCode: '',
                ChargesName: '',
                ChargesAmount: '',
                ChargesType: '',
                ChargesRemarks: '',
                SubChargesName: [],
                SubChargesAmount: [],
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/Charges?page=' + page).then(({data}) => {
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

        createCharges() {
           // this.form.post('api/charges').then(() => {
           this.form.post('api/AddCharges').then(() => {
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

        updateCharges() {
            // Submit the form via a PUT request
            this.form.put('api/charges/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Charges has been updated.',
                    'success'
                )
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        deleteCharges(_id) {
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
                    this.form.delete('api/charges/'+_id).then(() => {
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
            axios.delete('api/charge/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Charges was Inactive.',
                    'error'
                )
                // Success
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/charge/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Charges was Restore.',
                    'success'
                )
                // Success!
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        loadCarBrand() {
            axios.get('api/Charges').then(({data}) => {
                this.charges = data
            })

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