<template>
    <div>
        <CarModel/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car Model</h3>

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
                                <th>Car Model No</th>
                                <th>Car Model Name</th>
                                <th>Car Brand Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in models.data" :key="value._id">
                                <td>{{value.ModelNo}}</td>
                                <td>{{value.ModelName}}</td>
                                <td>{{value.BrandName}}</td>
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
                                    <button class="btn btn-danger" @click="deleteCarModel(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="models" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Model</h4>
                        <h4 class="modal-title" v-else>Add New Model</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateCarModel() : createCarModel()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ModelName">Car Model Name :</label>
                                <input v-model="form.ModelName" 
                                    class="form-control"
                                    type="text" 
                                    id="ModelName" 
                                    placeholder="Enter Car Model Name">
                            </div>
                            <div class="form-group">
                                <label for="BrandName">Car Brand Name :</label>
                                <select v-model="form.BrandName" id="BrandName" class="form-control">
                                    <option value="" selected disabled>Select associated Brand</option>
                                    <option :value="value.BrandName" v-for="value in brands.data" :key="value._id">{{value.BrandName}}</option>
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
import CarModel from '../../components/PageHeaders/CarModelHeader';
export default {
    components: {
        CarModel,
    },

    data() {
        return {
            editmode: false,
            models: {},
            brands: {},

            form: new Form({
                _id: '',
                ModelNo: '',
                ModelName: '',
                BrandName: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/car-models?page=' + page).then(({data}) => {
                this.models = data;
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

        createCarModel() {
            this.form.post('api/car-models').then(() => {
                $('#modal').modal('hide')
                this.loadCarModel()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateCarModel() {
            // Submit the form via a PUT request
            this.form.put('api/car-models/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Motor Car Model has been updated.',
                    'success'
                )
                this.loadCarModel()
            }).catch(() => {

            });
        },

        deleteCarModel(_id) {
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
                    this.form.delete('api/car-models/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadCarModel()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/car-model/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Motor Car Model was Inactive.',
                    'error'
                )
                // Success
                this.loadCarModel()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/car-model/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Motor Car Model was Restore.',
                    'success'
                )
                // Success!
                this.loadCarModel()
            }).catch(() => {

            });
        },

        loadCarModel() {
            axios.get('api/car-models').then(({data}) => {
                this.models = data
            })
        },

        loadCarBrand() {
            axios.get('api/car-brands').then(({data}) => {
                this.brands = data
            })
        }
    },

    created() {
        this.loadCarModel()
        this.loadCarBrand()
    }
}
</script>