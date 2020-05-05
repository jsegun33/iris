<template>
    <div>
        <CarBrand/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Motor Car Brand</h3>

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
                                <th>Car Brand No</th>
                                <th>Car Brand Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in brands.data" :key="value._id">
                                <td>{{value.BrandNo}}</td>
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
                                    <button class="btn btn-danger" @click="deleteCarBrand(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="brands" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Car Brand</h4>
                        <h4 class="modal-title" v-else>Add New Car Brand</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateCarBrand() : createCarBrand()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="BrandName">Car Brand Name :</label>
                                <input v-model="form.BrandName" 
                                    class="form-control"
                                    type="text" 
                                    id="BrandName" 
                                    placeholder="Enter Car Brand Name">
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
import CarBrand from '../../components/PageHeaders/CarBrandHeader';
export default {
    components: {
        CarBrand,
    },

    data() {
        return {
            editmode: false,
            brands: {},

            form: new Form({
                _id: '',
                BrandNo: '',
                BrandName: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/car-brands?page=' + page).then(({data}) => {
                this.brands = data;
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

        createCarBrand() {
            this.form.post('api/car-brands').then(() => {
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

        updateCarBrand() {
            // Submit the form via a PUT request
            this.form.put('api/car-brands/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Motor Car Brand has been updated.',
                    'success'
                )
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        deleteCarBrand(_id) {
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
                    this.form.delete('api/car-brands/'+_id).then(() => {
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
            axios.delete('api/car-brand/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Motor Car Brand was Inactive.',
                    'error'
                )
                // Success
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/car-brand/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Motor Car Brand was Restore.',
                    'success'
                )
                // Success!
                this.loadCarBrand()
            }).catch(() => {

            });
        },

        loadCarBrand() {
            axios.get('api/car-brands').then(({data}) => {
                this.brands = data
            })
        }
    },

    created() {
        this.loadCarBrand()
    }
}
</script>