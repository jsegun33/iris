<template>
    <div>
        <SurchargeHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Surcharge</h3>

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
                                <th>Surcharge No</th>
                                <th>Surcharge Name</th>
                                <th>Charge</th>
                                <th>Lines No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in surcharges.data" :key="value._id">
                                <td>{{value.SurchargeNo}}</td>
                                <td>{{value.SurchargeName}}</td>
                                <td>{{value.Charge}}</td>
                                <td>{{value.LinesNo}}</td>
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
                                    <button class="btn btn-danger" @click="deleteSurcharge(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="surcharges" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Surcharge</h4>
                        <h4 class="modal-title" v-else>Add New Surcharge</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateSurcharge() : createSurcharge()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="SurchargeName">Surcharge Name :</label>
                                <input v-model="form.SurchargeName" 
                                    class="form-control"
                                    type="text" 
                                    id="SurchargeName" 
                                    placeholder="Enter Surcharge Name">
                            </div>
                            <div class="form-group">
                                <label for="LinesNo">Lines No :</label>
                                <select v-model="form.LinesNo" id="LinesNo" class="form-control">
                                    <option value="" selected disabled>Select a Product Line</option>
                                    <option :value="value.LinesNo" v-for="value in Lines.data" :key="value._id">{{value.LinesCode}} - {{value.LinesName}}</option>
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
import SurchargeHeader from '../../components/PageHeaders/SurchargeHeader'
export default {
    components: {
        SurchargeHeader,
    },

    data() {
        return {
            editmode: false,
            surcharges: {},
            Lines: {},

            form: new Form({
                _id: '',
                SurchargeName: '',
                LinesNo: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/surcharges?page=' + page).then(({data}) => {
                this.surcharges = data;
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

        createSurcharge() {
            this.form.post('api/surcharges').then(() => {
                $('#modal').modal('hide')
                this.loadSurcharge()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateSurcharge() {
            // Submit the form via a PUT request
            this.form.put('api/surcharges/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Surcharge has been updated.',
                    'success'
                )
                this.loadSurcharge()
            }).catch(() => {

            });
        },

        deleteSurcharge(_id) {
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
                    this.form.delete('api/surcharges/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadSurcharge()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/surcharge/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Surcharge was Inactive.',
                    'error'
                )
                // Success
                this.loadSurcharge()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/surcharge/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Surcharge was Restore.',
                    'success'
                )
                // Success!
                this.loadSurcharge()
            }).catch(() => {

            });
        },

        loadSurcharge() {
            axios.get('api/surcharges').then(({data}) => {
                this.surcharges = data
            })
        },

        loadProductLines() {
            axios.get('api/lines').then(({data}) => {
                this.Lines = data
            })
        } 
    },

    created() {
        this.loadSurcharge()
        this.loadProductLines()
    }
}
</script>