<template>
    <div>
        <TaripaHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Taripa</h3>

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
                                <th>Taripa No</th>
                                <th>Class No</th>
                                <th>Perils No</th>
                                <th>Perils Name</th>
                                <th>Coverage Amount</th>
                                <th>Premium Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in taripas.data" :key="value._id">
                                <td>{{value.TaripaNo}}</td>
                                <td>{{value.SubLinesNo}}</td>
                                <td>{{value.PerilsNo}}</td>
                                <td>{{value.PerilsName}}</td>
                                <td>{{value.CoverageAmount | Peso}}</td>
                                <td>{{value.PremiumAmount | Peso}}</td>
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
                                    <button class="btn btn-danger" @click="deleteTaripa(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="taripas" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Taripa</h4>
                        <h4 class="modal-title" v-else>Add New Taripa</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateTaripa() : createTaripa()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ClassNo">Class :</label>
                                <select v-model="form.ClassNo" id="ClassNo" class="form-control">
                                    <option value="" selected disabled>Select a Class</option>
                                    <option :value="value.ClassNo" v-for="value in classes.data" :key="value._id">{{value.ClassName}}{{value.ClassInputNo}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="PerilsName">Peril Name :</label>
                                <select @change="onChangePeril" v-model="form.PerilsName" id="PerilsName" class="form-control">
                                    <option value="" selected disabled>Select a Peril</option>
                                    <option v-for="value in perils" :key="value._id">{{value.PerilsName}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CoverageAmount">Coverage Amount :</label>
                                <input v-model="form.CoverageAmount" 
                                    class="form-control"
                                    type="text" 
                                    id="CoverageAmount" 
                                    placeholder="Enter Coverage Amount">
                            </div>
                            <div class="form-group">
                                <label for="PremiumAmount">Premium Amount :</label>
                                <input v-model="form.PremiumAmount" 
                                    class="form-control"
                                    type="text" 
                                    id="PremiumAmount" 
                                    placeholder="Enter Premium Amount">
                            </div>
                            <div class="form-group">
                                <label for="Formula">Formula :</label>
                                <input v-model="form.Formula" 
                                    class="form-control"
                                    type="number" 
                                    id="Formula" 
                                    placeholder="Enter Formula">
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
import TaripaHeader from '../../components/PageHeaders/TaripaHeader'
export default {
    components: {
        TaripaHeader,
    },

    data() {
        return {
            editmode: false,
            taripas: {},
            perils: {},
            classes: {},

            form: new Form({
                _id: '',
                ClassNo: '',
                PerilsNo: '',
                PerilsName: '',
                CoverageAmount: '',
                PremiumAmount: '',
                Formula: '',
                Active: '',
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/taripas?page=' + page).then(({data}) => {
                this.taripas = data;
            });
        },

        onChangePeril(e) {
            let perilsNo = this.perils.find(peril => peril.PerilsName == e.target.value)
            this.form.PerilsNo = perilsNo.PerilsNo
            // console.log(perilsNo);
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

        createTaripa() {
            this.form.post('api/taripas').then(() => {
                $('#modal').modal('hide')
                this.loadTaripas()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateTaripa() {
            // Submit the form via a PUT request
            this.form.put('api/taripas/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Taripa has been updated.',
                    'success'
                )
                this.loadTaripas()
            }).catch(() => {

            });
        },

        deleteTaripa(_id) {
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
                    this.form.delete('api/taripas/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadTaripas()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/taripa/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Taripa was Inactive.',
                    'error'
                )
                // Success
                this.loadTaripas()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/taripa/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Taripa was Restore.',
                    'success'
                )
                // Success!
                this.loadTaripas()
            }).catch(() => {

            });
        },

        loadTaripas() {
            axios.get('api/taripas').then(({data}) => {
                this.taripas = data
            })
        },

        loadPerils() {
            axios.get('api/perils').then(({data}) => {
                this.perils = data.data
            })
        },

        loadClass() {
            axios.get('api/class').then(({data}) => {
                this.classes = data
            })
        }
    },

    created() {
        this.loadTaripas()
        this.loadPerils()
        this.loadClass()
    }
}
</script>