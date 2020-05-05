<template>
    <div>
        <CarAmount/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car Purchased Amount</h3>

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
                                <th>Car Amount No</th>
                                <th>Car Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in amounts.data" :key="value._id">
                                <td>{{value.CarAmountNo}}</td>
                                <td>{{value.CarAmount | Peso}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.Active == 1 || value.Active == 'Active'">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td v-if="value.Active == 1 || value.Active == 'Active'">
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
                                    <button class="btn btn-danger" @click="deleteCarAmount(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="amounts" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Car Purchased Amount</h4>
                        <h4 class="modal-title" v-else>Add New Car Purchased Amount</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateCarAmount() : createCarAmount()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="CarAmount">Car Purchased Amount :</label>
                                <input v-model="form.CarAmount" 
                                    class="form-control"
                                    type="text" 
                                    id="CarAmount" 
                                    placeholder="Enter Car Purchased Amount">
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
import CarAmount from '../../components/PageHeaders/CarAmountHeader';
export default {
    components: {
        CarAmount,
    },

    data() {
        return {
            editmode: false,
            amounts: {},

            form: new Form({
                _id: '',
                CarAmountNo: '',
                CarAmount: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/car-amounts?page=' + page).then(({data}) => {
                this.amounts = data;
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

        createCarAmount() {
            this.form.post('api/car-amounts').then(() => {
                $('#modal').modal('hide')
                this.loadCarAmount()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateCarAmount() {
            // Submit the form via a PUT request
            this.form.put('api/car-amounts/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Motor Car Amount has been updated.',
                    'success'
                )
                this.loadCarAmount()
            }).catch(() => {

            });
        },

        deleteCarAmount(_id) {
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
                    this.form.delete('api/car-amounts/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadCarAmount()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/car-amount/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Motor Car Amount was Inactive.',
                    'error'
                )
                // Success
                this.loadCarAmount()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/car-amount/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Motor Car Amount was Restore.',
                    'success'
                )
                // Success!
                this.loadCarAmount()
            }).catch(() => {

            });
        },

        loadCarAmount() {
            axios.get('api/car-amounts').then(({data}) => {
                this.amounts = data
            })
        }
    },

    created() {
        this.loadCarAmount()
    }
}
</script>