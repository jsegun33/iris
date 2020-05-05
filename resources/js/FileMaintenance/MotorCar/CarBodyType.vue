<template>
    <div>
        <CarBodyType/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car BodyType</h3>

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
                                <th>Car Body Type No</th>
                                <th>Car Body Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in bodyType.data" :key="value._id">
                                <td>{{value.BodyTypeNo}}</td>
                                <td>{{value.BodyTypeName}}</td>
                                <td>{{value.Description}}</td>
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
                                    <button class="btn btn-danger" @click="deleteCarBodyType(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="bodyType" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Body Type</h4>
                        <h4 class="modal-title" v-else>Add New Body Type</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateCarBodyType() : createCarBodyType()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="BodyTypeName">Car Body Type :</label>
                                <input v-model="form.BodyTypeName" 
                                    class="form-control"
                                    type="text" 
                                    id="BodyTypeName" 
                                    placeholder="Enter Car Body Type">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description :</label>
                                <textarea v-model="form.Description" id="Description" class="form-control" cols="30" rows="10"></textarea>
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
import CarBodyType from '../../components/PageHeaders/CarBodyTypeHeader';
export default {
    components: {
        CarBodyType,
    },

    data() {
        return {
            editmode: false,
            bodyType: {},

            form: new Form({
                _id: '',
                BodyTypeNo: '',
                BodyTypeName: '',
                Description: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/car-body-types?page=' + page).then(({data}) => {
                this.bodyType = data;
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

        createCarBodyType() {
            this.form.post('api/car-body-types').then(() => {
                $('#modal').modal('hide')
                this.loadCarBodyType()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateCarBodyType() {
            // Submit the form via a PUT request
            this.form.put('api/car-body-types/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Motor Car Body Type has been updated.',
                    'success'
                )
                this.loadCarBodyType()
            }).catch(() => {

            });
        },

        deleteCarBodyType(_id) {
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
                    this.form.delete('api/car-body-types/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadCarBodyType()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/car-body-type/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Motor Car Body Type was Inactive.',
                    'error'
                )
                // Success
                this.loadCarBodyType()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/car-body-type/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Motor Car Body Type was Restore.',
                    'success'
                )
                // Success!
                this.loadCarBodyType()
            }).catch(() => {

            });
        },

        loadCarBodyType() {
            axios.get('api/car-body-types').then(({data}) => {
                this.bodyType = data
            })
        },
    },

    created() {
        this.loadCarBodyType()
    }
}
</script>