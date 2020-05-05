<template>
    <div>
        <ProductLine/>

        <section class="content">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Product Lines</h3>

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
                                <th>Line No</th>
                                <th>Line Code</th>
                                <th>Line Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="line in Lines.data" :key="line._id">
                                <td>{{line.LinesNo}}</td>
                                <td>{{line.LinesCode}}</td>
                                <td>{{line.LinesName}}</td>
                                <td>
                                    <span class="label label-success" v-if="line.Active == 1">Active</span>
                                    <span class="label label-warning" v-else>Inactive</span>
                                </td>
                                <td v-if="line.Active == 1">
                                    <button class="btn btn-primary" @click="editForm(line)">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-warning" @click="softDelete(line._id)">
                                        <i class="fa fa-warning"></i>
                                        Inactive
                                    </button>
                                </td>
                                <td v-else>
                                    <button class="btn btn-primary" @click="restore(line._id)">
                                        <i class="fa fa-mail-forward"></i>
                                        Restore
                                    </button>
                                    <button class="btn btn-danger" @click="deleteProductLine(line._id)">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="Lines" :limit="2" @pagination-change-page="getResults" class="pull-right">
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
                        <h4 class="modal-title" v-if="editmode">Update Product Line</h4>
                        <h4 class="modal-title" v-else>Add New Product Line</h4>
                    </div>

                    <form @submit.prevent="editmode ? updateProductLine() : createProductLine()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="LinesCode">Line Code :</label>
                                <input v-model="form.LinesCode" 
                                    class="form-control"
                                    type="text" 
                                    id="LinesCode" 
                                    placeholder="Enter Line Code">
                            </div>
                            <div class="form-group">
                                <label for="LinesName">Line Name :</label>
                                <input v-model="form.LinesName" 
                                    class="form-control"
                                    type="text" 
                                    id="LinesName" 
                                    placeholder="Enter Line Name">
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
import ProductLine from '../../components/PageHeaders/ProductLineHeader'
export default {
    components: {
        ProductLine,
    },

    data() {
        return {
            editmode: false,
            Lines: {},
            
            form: new Form({
                _id: '',
                LinesCode: '',
                LinesName: '',
                Active: ''
            }),
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get('api/lines?page=' + page).then(({data}) => {
                this.Lines = data;
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

        createProductLine() {
            this.form.post('api/lines').then(() => {
                $('#modal').modal('hide')
                this.loadProductLines()

                toast.fire({
                    icon: 'success',
                    title: 'Successfully Created'
                })

                // console.log('Success!');
            }).catch((error) => {
                console.log(error);
            })
        },

        updateProductLine() {
            // Submit the form via a PUT request
            this.form.put('api/lines/' + this.form._id).then(() => {
                // Success!
                $('#modal').modal('hide')
                Swal.fire(
                    'Updated!',
                    'Product Line has been updated.',
                    'success'
                )
                this.loadProductLines()
            }).catch(() => {

            });
        },

        deleteProductLine(_id) {
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
                    this.form.delete('api/lines/'+_id).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Success
                        this.loadProductLines()
                    }).catch(() => {
                        Swal.fire('Failed', 'There was something wrong', 'warning');
                    });
                }
            })
        },

        softDelete(_id) {
            axios.delete('api/line/'+_id).then(() => {
                Swal.fire(
                    'Inactive!',
                    'Product Line was Inactive.',
                    'error'
                )
                // Success
                this.loadProductLines()
            }).catch(() => {

            });
        },

        restore(_id) {
            axios.put('api/line/' +_id).then(() => {
                Swal.fire(
                    'Restored!',
                    'Product Line was Restore.',
                    'success'
                )
                // Success!
                this.loadProductLines()
            }).catch(() => {

            });
        },

        loadProductLines() {
            axios.get('api/lines').then(({data}) => {
                this.Lines = data
            })
        } 
    },
    
    created() {
        this.loadProductLines()
    }
}
</script>
<style scoped>
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>