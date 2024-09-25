<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            element-name="preferred-location"

                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            element-name="location"
                            :contents="myAllContents"
                            :column-names="['name']"
                            :has-actions="true"
                            :action-button-names="['delete']"
                            :action-button-class-names="['btn-outline-danger']"
                            :action-button-emitting-method-names="['showContentDeleteConfirmationForm']"

                            @show-content-delete-confirmation-form="showContentDeleteConfirmationForm"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <user-form-modal-component
                element-name="location"
                :available-assets="allAvailableAssets"
                :is-submitted="isSubmitted"
                :single-asset-data="singleAssetData"
                :validation-errors="errors"

                @store-asset="storeAsset"
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
        fetchIndexContents();
        fetchAvailableAssets();
        // console.log('User Location List mounted.')
        myPreferenceAddModal.value = new Modal('#user-preference-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })

    const loading = ref(true)

    const myAllContents = ref([])

    const allAvailableAssets = ref([])

    const isSubmitted = ref(false)

    const singleAssetData = ref({
        location_id : ""
    })

    const errors = ref({
        location_id : null
    })

    const myPreferenceAddModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchMyContents() {

        loading.value = true;
        myAllContents.value = [];

        axios
            .get('/api/v1/user-locations/')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response);
                    myAllContents.value = response.data.data;
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
    function fetchAvailableAssets() {

        loading.value = true;
        allAvailableAssets.value = [];

        axios
            .get('/api/v1/locations/')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response);
                    allAvailableAssets.value = response.data.data;
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

        resetErrorObject();
        resetSingleAssetObject();

        myPreferenceAddModal.value.show();
    }
    function storeMyAsset() {

        isSubmitted.value = true;

        axios
            .post('api/v1/user-locations/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Selected location has been added");
                    myAllContents.value = response.data.data;
                    myPreferenceAddModal.value.hide();
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
    function deleteMyAsset() {

        isSubmitted.value = true;

        axios
            .delete('api/v1/user-locations/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Selected location has been removed");
                    myAllContents.value = response.data.data;
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
            location_id : "",
        };
    }
    function resetErrorObject() {
        errors.value = {
            location_id : null
        };
    }
</script>
