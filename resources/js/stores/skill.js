import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export const useSkillStore = defineStore('skill', () => {
    /* state */
    const loading = ref(true)

    const allContents = ref([])

    const isSubmitted = ref(false)

    const isCreateMode = ref(true)

    const singleAssetData = ref({
        name : ""
    })

    const errors = ref({
        name : null
    })

    const createOrEditModal = ref(null)
    const deleteConfirmationModal = ref(null)

    /* getters */
    // const doubleCount = computed(() => count.value * 2)

    /* actions */
    function fetchAllContents() {

        loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/skills/')
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

    function storeAsset() {

        isSubmitted.value = true;

        axios
            .post('api/v1/skills/', singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("New skill has been created");
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
                        errors.value[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }

    function updateAsset() {

        isSubmitted.value = true;

        axios
            .put('api/v1/skills/' + singleAssetData.value.id, singleAssetData.value)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Skill has been updated");
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
                        errors.value[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }

    function deleteAsset() {

        isSubmitted.value = true;

        axios
            .delete('api/v1/skills/' + singleAssetData.value.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("Skill has been deleted");
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
                        errors.value[x] = error.response.data.errors[x][0]
                    }
                }
            })
            .finally(response => {
                isSubmitted.value = false;
            });

    }

    function showStoreForm() {
        isCreateMode.value = true;

        resetErrorObject();
        resetSingleAssetObject();

        createOrEditModal.value.show();
    }

    function showContentEditForm(content) {
        isCreateMode.value = false;
        singleAssetData.value = content;
        createOrEditModal.value.show();
    }

    function showContentDeleteConfirmationForm(content) {
        singleAssetData.value = content;
        deleteConfirmationModal.value.show();
    }

    function resetSingleAssetObject() {
        singleAssetData.value = {
            name : "",
        };
    }

    function resetErrorObject() {
        errors.value = {
            name : null,
        };
    }

    return {
        loading, allContents, isSubmitted, isCreateMode, singleAssetData, errors, createOrEditModal,
        deleteConfirmationModal, fetchAllContents, storeAsset, updateAsset, deleteAsset, showStoreForm,
        showContentEditForm, showContentDeleteConfirmationForm, resetSingleAssetObject, resetErrorObject
    }
})
