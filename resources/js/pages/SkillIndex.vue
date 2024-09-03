<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="skill"

                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="allContents.length">
                                <tr v-for="(content, index) in allContents">
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ content.name }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary"
                                            @click="showContentEditForm(content)"
                                        >
                                            Edit
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-outline-danger ms-2"
                                            @click="showContentDeleteConfirmationForm"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                            <tbody v-else>
                                <tr>
                                    <th class="text-center" colspan="3">
                                        <span class="text-danger">No Skills Found</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <name-form-modal-component
                element-name="skill"
                :is-submitted="isSubmitted"
                :is-create-mode="isCreateMode"
                :single-asset-data="singleAssetData"

                @store-asset="storeAsset"
			    @update-asset="updateAsset"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import { Modal } from 'bootstrap'

    onMounted(async () => {
        fetchAllContents();
        console.log('Skill List mounted.')
        modal.value = new Modal('#name-form-modal', {})
    })

    const loading = ref(true)

    const allContents = ref([])

    const isSubmitted = ref(false)
    const isCreateMode = ref(true)

    const singleAssetData = ref({
        name : ""
    })

    const modal = ref(null)

    function fetchAllContents() {

        loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/skills/')
            .then(response => {
                if (response.status == 200) {
                    allContents.value = response.data;
                }
            })
            .catch(error => {
                error = error.toString();
                // Request made and server responded
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    console.log(error.response.data.errors[x]);
                }
                // The request was made but no response was received
                else if (error.request) {
                    console.log(error.request);
                }
                // Something happened in setting up the request that triggered an Error
                else {
                    console.log('Error', error.message);
                }

            })
            .finally(response => {
                loading.value = false;
            });

    }

    function showStoreForm() {
        isCreateMode.value = true;

        singleAssetData.value = {
            name : ""
        };

        modal.value.show();
    }
    function storeAsset() {

        isSubmitted.value = true;

        axios
            .post('/skills/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("New skill has been created", "Success");
                    allContents.value = response.data;

                    fetchAllContents();

                    // this.modal.hide();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        // this.$toastr.w(error.response.data.errors[x], "Warning");
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }

    function showContentEditForm(content) {
        isCreateMode = false;
        singleAssetData.value = content;
        modal.value.show();
    }
    function updateAsset() {

        isSubmitted.value = true;

        axios
            .put('/skills/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("Skill has been updated", "Success");
                    allContents.value = response.data;

                    fetchAllContents();

                    modal.value.hide();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        // this.$toastr.w(error.response.data.errors[x], "Warning");
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }
    function deleteAsset(singleAssetData) {

        isSubmitted.value = true;

        axios
            .delete('/containers/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("Skill has been deleted", "Success");
                    allContents.value = response.data;

                    fetchAllContents();

                    $('#delete-confirmation-modal').modal('hide');
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        // this.$toastr.w(error.response.data.errors[x], "Warning");
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }
</script>
