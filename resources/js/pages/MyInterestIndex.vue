<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="preferred-interest"

                            @show-store-form="showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="row text-center">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="myAllContents.length">
                                <tr v-for="(content, index) in myAllContents" class="row text-center">
                                    <td class="col">{{ index+1 }}</td>
                                    <td class="col">{{ content.interest ? content.interest.name : 'NA' }}</td>
                                    <td class="col">
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
                                        <span class="text-danger">No Interests Found</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <my-form-modal-component
                element-name="interest"
                :available-assets="allAvailableAssets"
                :is-submitted="isSubmitted"
                :single-asset-data="singleAssetData"
                :validation-errors="errors"

                @store-my-asset="storeMyAsset"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                :is-submitted="isSubmitted"
                :content-to-delete="singleAssetData"

                @emit-delete-method="deleteMyAsset"
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
        fetchMyContents();
        fetchAvailableAssets();
        // console.log('My Interest List mounted.')
        myPreferenceAddModal.value = new Modal('#my-preference-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })

    const loading = ref(true)

    const myAllContents = ref([])

    const allAvailableAssets = ref([])

    const isSubmitted = ref(false)

    const singleAssetData = ref({
        interest_id : "",
        user_id : JSON.parse(window.localStorage.getItem('user')).id,
    })

    const errors = ref({
        name : null
    })

    const user = ref(JSON.parse(window.localStorage.getItem('user')))

    const myPreferenceAddModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchMyContents() {

        loading.value = true;
        myAllContents.value = [];

        axios
            .get('/api/v1/user-interests/')
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
            .get('/api/v1/interests/')
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
        singleAssetData.value.interest_id = singleAssetData.value.asset_id;

        axios
            .post('api/v1/user-interests/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Selected interest has been added");
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
            .delete('api/v1/user-interests/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Selected interest has been removed");
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
            interest_id : "",
            user_id : user.value.id,
        };
    }
    function resetErrorObject() {
        errors.value = {
            name : ""
        };
    }
</script>
