<template>
     <div>
        <AuthorityHeader/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">User Authority</h3>

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
                                <th>Authority Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="value in authorities.data" :key="value._id">
                                <td>{{value.authority_name}}</td>
                                <td>
                                    <span class="label label-success" v-if="value.active == 1 || value.active == '1'">Active</span>
                                    <span class="label label-danger" v-else>Inactive</span>
                                </td>
                                <td v-if="value.active == 1 || value.active == '1'">
                                    <button class="btn btn-primary" @click="editModal(value)">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-danger" @click="softDelete(value._id)">
                                        <i class="fa fa-warning"></i>
                                        Inactive
                                    </button>
                                </td>
                                <td v-else>
                                    <button class="btn btn-success" @click="AuthorityRestore(value._id)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <!-- <button class="btn btn-danger" @click="deleteUserAuthority(value._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="authorities" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Authority</h4>
                        <h4 class="modal-title" v-else>Add New Authority</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateAuthority() : addAuthority()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="AuthorityName">Authority Name :</label>
                                <input v-model="form.authority_name" 
                                    class="form-control"
                                    type="text" 
                                    id="AuthorityName" 
                                    placeholder="Enter Authority Name">
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
import AuthorityHeader from '../../components/PageHeaders/AuthorityHeader';
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            AuthorityHeader,
        },

        data() {
            return {
                editmode: false,
                authorities: {},
                form: new Form({
                    _id: '',
                    authority_name: '',
                    active: '',
                }),
            }
        },

        methods: {
            editModal(authority) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show')
                this.form.fill(authority);
            },

            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show')
            },

            addAuthority() {
                // Submit the form via a POST request
                this.form.post('api/AuthorityAddNew').then(() => {
                    // Success!
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                }).catch(() => {

                });
            },

            updateAuthority() {
                // Submit the form via a PUT request
                this.form.put('api/AuthorityUpdate/' +this.form._id).then(() => {
                    // Success!
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                }).catch(() => {

                });
            },

            deleteAuthority(_id) {
                this.form.delete('api/AuthorityDelete/'+_id).then(() => {
                    // Success
                    Fire.$emit('AfterCreate');
                }).catch(() => {

                });
            },

            softDelete(_id) {
                axios.delete('api/AuthorityDelete/'+_id).then(() => {
                    // Success
                    Fire.$emit('AfterCreate');
                }).catch(() => {

                });
            },

            AuthorityRestore(_id) {
                axios.put('api/AuthorityRestore/' +_id).then(() => {
                    // Success!
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                }).catch(() => {

                });
            },

            loadAuthorities() {
                axios.get("api/Authority").then(({ data }) => (this.authorities = data));
            }
        },

        created() {
            this.loadAuthorities();
            Fire.$on('AfterCreate',() => {
                this.loadAuthorities();
            });
        }
    }
</script>
