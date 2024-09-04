<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="preferred-political-party"

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
                                    <td class="col">{{ content.political_party ? content.political_party.name : 'NA' }}</td>
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
                                        <span class="text-danger">No Political-Parties Found</span>
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
                element-name="political-party"
                :assets="allAvailableAssets"
                :is-submitted="isSubmitted"
                :single-asset-data="singleAssetData"

                @store-my-asset="storeMyAsset"
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
        fetchMyContents();
        fetchAvailableAssets();
        console.log('My Political-Party List mounted.')
        myPreferenceAddModal.value = new Modal('#my-preference-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })

    const loading = ref(true)

    const myAllContents = ref([])

    const allAvailableAssets = ref([])

    const isSubmitted = ref(false)

    const singleAssetData = ref({
        political_party_id : "",
        user_id : JSON.parse(window.localStorage.getItem('user')).id,
    })

    const user = ref(JSON.parse(window.localStorage.getItem('user')))

    const myPreferenceAddModal = ref(null)
    const deleteConfirmationModal = ref(null)

    function fetchMyContents() {

        loading.value = true;
        myAllContents.value = [];

        axios
            .get('/api/v1/user-political-parties/')
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
            .get('/api/v1/political-parties/')
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

        singleAssetData.value = {
            political_party_id : "",
            user_id : user.value.id,
        };

        myPreferenceAddModal.value.show();
    }
    function storeMyAsset() {

        isSubmitted.value = true;
        singleAssetData.value.political_party_id = singleAssetData.value.asset_id;

        axios
            .post('api/v1/user-political-parties/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("New political-party has been created", "Success");
                    myAllContents.value = response.data.data;
                    myPreferenceAddModal.value.hide();
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
                    political_party_id : "",
                    user_id : user.value.id,
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
            .delete('api/v1/user-political-parties/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    // this.$toastr.s("Political-Party has been deleted", "Success");
                    myAllContents.value = response.data.data;
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
                    political_party_id : "",
                    user_id : user.value.id,
                };
            });

    }
</script>
