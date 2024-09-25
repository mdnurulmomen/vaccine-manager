import { ref } from 'vue'
import { defineStore } from 'pinia'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useGeneralStore } from '@/stores/general';

export const useUserInterestStore = defineStore('user-interest', () => {
    /* state */
    const generalStore = useGeneralStore()

    /* getters */
    // const doubleCount = computed(() => count.value * 2)

    /* actions */
    function fetchIndexContents() {

        generalStore.loading = true;
        generalStore.currentIndexContents = [];

        axios
            .get('/api/v1/user-interests/')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response);
                    generalStore.currentIndexContents = response.data.data;
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
                generalStore.loading = false;
            });

    }

    function fetchAssetSelectContents() {

        generalStore.loading = true;
        generalStore.assetSelectOptions = [];

        axios
            .get('/api/v1/interests/')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response);
                    generalStore.assetSelectOptions = response.data.data;
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
                generalStore.loading = false;
            });

    }

    function storeContent() {

        generalStore.isSubmitted = true;

        axios
            .post('api/v1/user-interests/', generalStore.currentEntity)
            .then(response => {
                if (response.status == 200) {
                    toast.success("New interest has been created");
                    generalStore.currentIndexContents = response.data.data;
                    generalStore.createOrEditModal.hide();
                    resetCurrentEntity();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        generalStore.errors[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                generalStore.isSubmitted = false;
            });

    }

    function updateContent() {

        generalStore.isSubmitted = true;

        axios
            .put('api/v1/user-interests/' + generalStore.currentEntity.id, generalStore.currentEntity)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Interest has been updated");
                    generalStore.currentIndexContents = response.data.data;
                    generalStore.createOrEditModal.hide();
                    resetCurrentEntity();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        generalStore.errors[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                generalStore.isSubmitted = false;
            });

    }

    function deleteContent() {

        generalStore.isSubmitted = true;

        axios
            .delete('api/v1/user-interests/' + generalStore.currentEntity.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Interest has been deleted");
                    generalStore.currentIndexContents = response.data.data;
                    generalStore.deleteConfirmationModal.hide();
                    resetCurrentEntity();
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                    resetErrorObject();

                    for (var x in error.response.data.errors) {
                        toast.warning(error.response.data.errors[x][0]);
                        generalStore.errors[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                generalStore.isSubmitted = false;
            });

    }

    function showStoreForm() {
        resetErrorObject();
        resetCurrentEntity();
        generalStore.showStoreForm();
    }

    function resetCurrentEntity() {
        generalStore.currentEntity = {
            interest_id : ""
        };
    }

    function resetErrorObject() {
        generalStore.errors = {
            interest_id : null,
        };
    }

    return {
        fetchIndexContents, fetchAssetSelectContents, storeContent, updateContent, deleteContent, showStoreForm,
    }
})
