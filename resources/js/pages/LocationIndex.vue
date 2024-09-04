<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="location"
                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="row text-center">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Latitude</th>
                                    <th class="col">Longitude</th>
                                    <th class="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="allContents.length">
                                <tr v-for="(content, index) in allContents" class="row text-center">
                                    <td class="col">{{ index+1 }}</td>
                                    <td class="col">{{ content.name }}</td>
                                    <td class="col">{{ content.latitude }}</td>
                                    <td class="col">{{ content.longitude }}</td>
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
                                    <th class="text-center" colspan="5">
                                        <span class="text-danger">No Location Found</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <location-form-modal-component
                element-name="location"
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
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';

    onMounted(async () => {
        fetchAllContents();
        // console.log('Location List mounted.')
        createOrEditModal.value = new Modal('#location-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })

    const loading = ref(true)

    const allContents = ref([])

    const isSubmitted = ref(false)
    const isCreateMode = ref(true)

    const singleAssetData = ref({
        name : "",
        latitude : "",
        logitude : ""
    })

    const createOrEditModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchAllContents() {

        loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/locations/')
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
            name : "",
            latitude : "",
            logitude : ""
        };

        createOrEditModal.value.show();
    }
    function storeAsset() {

        isSubmitted.value = true;

        axios
            .post('api/v1/locations/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("New location has been created");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x]);
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
                singleAssetData.value = {
                    name : "",
                    latitude : "",
                    logitude : ""
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
            .put('api/v1/locations/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Location has been updated");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x]);
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
                singleAssetData.value = {
                    name : "",
                    latitude : "",
                    logitude : ""
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
            .delete('api/v1/locations/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Location has been deleted");
                    allContents.value = response.data.data;
                    deleteConfirmationModal.value.hide();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x]);
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
                singleAssetData.value = {
                    name : "",
                    latitude : "",
                    logitude : ""
                };
            });

    }
</script>
