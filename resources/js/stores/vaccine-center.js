import { defineStore } from 'pinia'
import 'vue3-toastify/dist/index.css';
import { useGeneralStore } from '@/stores/general';

export const useVaccineCenterStore = defineStore('vaccine-center', () => {
    /* state */
    const generalStore = useGeneralStore()

    /* getters */
    // const doubleCount = computed(() => count.value * 2)

    /* actions */
    function fetchIndexContents() {

        generalStore.loading = true;
        generalStore.currentIndexContents = [];

        axios
            .get('/api/v1/vaccine-centers?perPage=10')
            .then(response => {
                // console.log(response);
                if (response.status == 200) {
                    // console.log(response.data.data);
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

    return {
        fetchIndexContents
    }
})
