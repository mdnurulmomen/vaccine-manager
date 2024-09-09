<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="political-party"
                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            element-name="political-party"
                            :contents="allContents"
                            :column-names="['name']"
                            :has-actions="true"
                            :action-button-names="['edit', 'delete']"
                            :action-button-class-names="['btn-outline-primary', 'btn-outline-danger']"
                            :action-button-emitting-method-names="['showContentEditForm', 'showContentDeleteConfirmationForm']"

                            @show-content-edit-form="showContentEditForm"
                            @show-content-delete-confirmation-form="showContentDeleteConfirmationForm"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <name-form-modal-component
                element-name="political-party"
                :is-submitted="isSubmitted"
                :is-create-mode="isCreateMode"
                :single-asset-data="singleAssetData"
                :validation-errors="errors"

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
        // console.log('Political-Party List mounted.')
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

    const errors = ref({
        name : ""
    })

    const createOrEditModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchAllContents() {

        loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/political-parties/')
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

        resetErrorObject();
        resetSingleAssetObject();

        createOrEditModal.value.show();
    }
    function storeAsset() {

        isSubmitted.value = true;

        axios
            .post('api/v1/political-parties/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("New party has been created");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
                    resetSingleAssetObject();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        errors.value[x] = error.response.data.errors[x][0];
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
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
            .put('api/v1/political-parties/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Party has been updated");
                    allContents.value = response.data.data;
                    createOrEditModal.value.hide();
                    resetSingleAssetObject();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        errors.value[x] = error.response.data.errors[x][0];
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }
    function showContentDeleteConfirmationForm(content) {
        singleAssetData.value = content;
        deleteConfirmationModal.value.show();
    }
    function deleteAsset() {

        isSubmitted.value = true;

        axios
            .delete('api/v1/political-parties/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Party has been deleted");
                    allContents.value = response.data.data;
                    deleteConfirmationModal.value.hide();
                    resetSingleAssetObject();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        errors.value[x] = error.response.data.errors[x][0];
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }
    function resetSingleAssetObject() {
        singleAssetData.value = {
            name : ""
        };
    }
    function resetErrorObject() {
        errors.value = {
            name : null
        };
    }
</script>
