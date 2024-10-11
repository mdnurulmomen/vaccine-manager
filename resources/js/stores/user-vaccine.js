import { ref } from 'vue'
import { defineStore } from 'pinia'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useGeneralStore } from '@/stores/general';

export const useUserVaccineStore = defineStore('user-vaccine', () => {
    /* state */
    const vaccineCenters = ref([])
    const unscheduledUsers = ref([])
    const generalStore = useGeneralStore()

    /* getters */
    // const doubleCount = computed(() => count.value * 2)

    /* actions */
    function fetchVaccineCenters() {

        generalStore.loading = true;

        axios
            .get('/api/v1/vaccine-centers/')
            .then(response => {
                // console.log('Vaccine-Centers');
                if (response.status == 200) {
                    // console.log(response);
                    vaccineCenters.value = response.data.data;
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

    function fetchUnscheduledUsers() {

        generalStore.loading = true;

        axios
            .get('/api/v1/unscheduled-users/')
            .then(response => {
                // console.log('Unscheduled-Users');
                if (response.status == 200) {
                    // console.log(response);
                    unscheduledUsers.value = response.data.data;
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

    function fetchIndexContents() {

        generalStore.loading = true;
        generalStore.currentIndexContents = [];

        axios
            .get('/api/v1/user-vaccines?perPage=10')
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

    function storeContent() {

        generalStore.isSubmitted = true;

        axios
            .post('api/v1/user-vaccines/', generalStore.currentEntity)
            .then(response => {
                if (response.status == 200) {
                    toast.success("New user has been scheduled");
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
            .put('api/v1/user-vaccines/' + generalStore.currentEntity.id, generalStore.currentEntity)
            .then(response => {
                if (response.status == 200) {
                    toast.success("User has been rescheduled");
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
            .delete('api/v1/user-vaccines/' + generalStore.currentEntity.id)
            .then(response => {
                if (response.status == 200) {
                    toast.success("User schedule has been deleted");
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

    function vaccinateUser(content) {

        generalStore.currentEntity = content;
        generalStore.currentEntity.is_completed = true;

        generalStore.isSubmitted = true;

        axios
            .patch('api/v1/user-vaccines/' + generalStore.currentEntity.id, generalStore.currentEntity)
            .then(response => {
                if (response.status == 200) {
                    toast.success("User has been vaccinated");
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

    function showStoreForm() {
        resetErrorObject();
        resetCurrentEntity();
        generalStore.showStoreForm();
    }

    function resetCurrentEntity() {
        generalStore.currentEntity = {
            user : "",
            schedule : "",
            vaccine_center : ""
        };
    }

    function resetErrorObject() {
        generalStore.errors = {
            user : "",
            schedule : null,
            vaccine_center : ""
        };
    }

    return {
        vaccineCenters, unscheduledUsers,
        fetchVaccineCenters, fetchUnscheduledUsers, fetchIndexContents, storeContent, updateContent, deleteContent, showStoreForm, vaccinateUser
    }
})
