<template>
    <div class="content">
        <section class="content-header">
            <h1>
                Data Tables
                <small>Advanced Table</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</router-link></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Clauses and Warranties Table</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <!-- <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div> -->
                            <button class="btn btn-primary pull-right" @click="newModal">
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
                                <th>Number</th>
                                <th>Name</th>
                                <th>Required</th>
                                <th>Default</th>
                                <th>Belong</th>
                                <th>Remarks</th>
                                <th>Statement</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in Warranties.data" :key="value._id">
                                <td>{{ value.Number }}</td>
                                <td>{{ value.Name }}</td>
                                <td>{{ value.Required }}</td>
                                <td>{{ value.Default }}</td>
                                <td>{{ value.Belong }}</td>
                                <td>{{ value.Remarks }}</td>
                                <td :id="value._id" :class="ActiveEllipsis ? 'text-truncate' : ''" @click="toggleEllipsis">{{ value.Statement}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.Active == 1 || value.Active == '1'">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td>
                                    <button v-if="value.Active == 1" class="btn btn-primary" @click="editModal(value)">
                                        Edit
                                        <i class="fa fa-edit"></i>
                                    </button>
                                
                                    <button v-if="value.Active == 1"  class="btn btn-danger" @click="softDelete(value._id)">
                                            In-Active / Delete
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <button  v-else class="btn btn-warning" @click="restore(value._id)">
                                        Activate Again 
                                        <i class="fa fa-lock"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="Warranties" :limit="3" @pagination-change-page="getResults" class="pull-right">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="addNew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" v-if="!editmode">Add New Clauses &amp; Warranties</h4>
                        <h4 class="modal-title" v-else>Update Clauses &amp; Warranties Info</h4>
                    </div>
                    <form @submit.prevent="editmode ? updateClauses() : addClauses()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Name">Name:</label>
                                <input v-model="form.Name" type="text" name="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }" placeholder="Name">
                                <has-error :form="form" field="Name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="Required">Required:</label>
                                    <select v-model="form.Required" type="text" name="Required" class="form-control" :class="{ 'is-invalid': form.errors.has('Required') }" placeholder="Required">
                                        <has-error :form="form" field="Required"></has-error> >
                                        <option disabled selected > PLs.Select  </option>
                                        <option  value="YES">YES</option>
                                        <option  value="NO">NO</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="Default">Default:</label>
                                    <select v-model="form.Default" type="text" name="Default" class="form-control" :class="{ 'is-invalid': form.errors.has('Default') }" placeholder="Default">
                                        <has-error :form="form" field="Default"></has-error> >
                                        <option disabled selected > PLs.Select  </option>
                                        <option  value="YEs">Yes</option>
                                        <option  value="NO">NO</option>
                                    </select>
                            </div>
                             <div class="form-group">
                                <label for="Belong">Belong:</label>
                                    <select v-model="form.Belong" type="text" name="Belong" class="form-control" :class="{ 'is-invalid': form.errors.has('Belong') }" placeholder="Belong">
                                        <has-error :form="form" field="Belong"></has-error> >
                                        <option disabled selected > PLs.Select  </option>
                                        <option  value="Accessories">Accessories</option>
                                        <option  value="PA">PA</option>
                                        <option  value="Bank">Bank</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="Remarks">Remarks:</label>
                                <input v-model="form.Remarks" type="text" name="Remarks" class="form-control" :class="{ 'is-invalid': form.errors.has('Remarks') }" placeholder="Remarks">
                                <has-error :form="form" field="Remarks"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="Statement">Statement:</label>
                                <textarea v-model="form.Statement" rows="10" name="Statement" class="form-control" :class="{ 'is-invalid': form.errors.has('Statement') }" placeholder="Statement"></textareav-model="form.Statement">
                                <has-error :form="form" field="Statement"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-if="!editmode" type="submit" class="btn btn-primary">Create</button>
                            <button v-else type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                editmode: false,
                Warranties: {},
                form: new Form({
                    _id: '',
                    Number:'',
                    Name: '',
                    Required: '',
                    Default: '',
                    Belong: '',
                    Remarks: '',
                    Statement: '',
                    Active: '',
                }),

                ActiveEllipsis: true,

            }
        },

        methods: {
            toggleEllipsis() {
                this.ActiveEllipsis = !this.ActiveEllipsis
                console.log(this.ActiveEllipsis);
                
            },

            getResults(page = 1) {
                axios.get('api/clauses?page=' + page).then(response => {
                    this.Warranties = response.data;
                });
            },
            editModal(value) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show')
                this.form.fill(value);
            },

            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show')
            },

            addClauses() {
                // Submit the form via a POST request
                this.form.post('api/clauses').then(() => {
                    // Success!
                    this.loadWarranties();
                    $('#addNew').modal('hide')
                }).catch(() => {

                });
            },

            updateClauses() {
                // Submit the form via a PUT request
                this.form.put('api/clauses/' +this.form._id).then(() => {
                    // Success!
                    this.loadWarranties();
                    $('#addNew').modal('hide')
                }).catch(() => {

                });
            },

            deleteClauses(_id) {
                this.form.delete('api/clauses/'+_id).then(() => {
                    // Success
                    this.loadWarranties();
                }).catch(() => {

                });
            },

            softDelete(_id) {
                axios.delete('api/warranties/'+_id).then(() => {
                    // Success
                    this.loadWarranties();
                }).catch(() => {

                });
            },

            restore(_id) {
                axios.put('api/warranties/' +_id).then(() => {
                    // Success!
                    this.loadWarranties();
                }).catch(() => {

                });
            },

            loadWarranties() {
                axios.get("api/clauses").then(({ data }) => {
                    this.Warranties = data
                })
            }
        },

        created() {
            this.loadWarranties();
        }
    }
</script>

<style scoped>
.text-truncate {
   display: inline-block;
   max-width: 300px;
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
}
</style>
