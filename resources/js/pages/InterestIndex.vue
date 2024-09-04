<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="interest"

                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="row text-center">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="allContents.length">
                                <tr v-for="(content, index) in allContents" class="row text-center">
                                    <td class="col">{{ index+1 }}</td>
                                    <td class="col">{{ content.name }}</td>
                                    <td class="col">
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
                                            @click="showContentDeleteConfirmationForm(content)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                            <tbody v-else>
                                <tr>
                                    <th class="text-center" colspan="3">
                                        <span class="text-danger">No Interest Found</span>
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
                element-name="interest"
                :is-submitted="isSubmitted"
                :is-create-mode="isCreateMode"
                :single-asset-data="singleAssetData"

                @store-asset="storeAsset"
			    @update-asset="updateAsset"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                :is-submitted="isSubmitted"
                :content-to-delete="singleAssetData"

                @emit-delete-method="deleteAsset"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import { Modal } from 'bootstrap'

    onMounted(async () => {
        fetchAllContents();
        console.log('Interest List mounted.')
        createOrEditModal.value = new Modal('#name-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })

    const loading = ref(true)

    const allContents = ref([])

    const isSubmitted = ref(false)
    const isCreateMode = ref(true)

    const singleAssetData = ref({
        name : ""
    })

    const createOrEditModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchAllContents() {

        loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/interests/')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response);
                    allContents.value = response.data.data;
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

        createOrEditModal.value.show();
    }
    function storeAsset() {

        isSubmitted.value = true;

        axios
            .post('api/v1/interests/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("New skill has been created", "Success");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
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
                singleAssetData.value = {
                    name : ""
                };
            });

    }

    function showContentEditForm(content) {
        isCreateMode.value = false;
        singleAssetData.value = content;
        createOrEditModal.value.show();
    }
    function updateAsset() {

        isSubmitted.value = true;

        axios
            .put('api/v1/interests/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("Skill has been updated", "Success");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
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
                singleAssetData.value = {
                    name : ""
                };
            });

    }

    function showContentDeleteConfirmationForm(content) {
        singleAssetData.value = content;
        deleteConfirmationModal.value.show();
    }
    function deleteAsset() {

        isSubmitted.value = true;

        axios
            .delete('api/v1/interests/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("Skill has been deleted", "Success");
                    allContents.value = response.data.data;
                    deleteConfirmationModal.value.hide();
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
                singleAssetData.value = {
                    name : ""
                };
            });

    }
</script>
