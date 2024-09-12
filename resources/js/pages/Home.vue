<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Suggested Users for YOU</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="row text-center">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Email</th>
                                </tr>
                            </thead>
                            <tbody v-if="allContents.length">
                                <tr v-for="(content, index) in allContents" class="row text-center">
                                    <td class="col">{{ index+1 }}</td>
                                    <td class="col">{{ $filters.capitalizeEachWord(content.name) }}</td>
                                    <td class="col">{{ content.email }}</td>
                                </tr>
                            </tbody>

                            <tbody v-else>
                                <tr>
                                    <th class="text-center" colspan="3">
                                        <span class="text-danger">No Users Found</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

    import { onMounted, ref } from 'vue'

    onMounted(() => {
        // console.log('Home mounted.')
        fetchAllContents();
    })

    const allContents = ref([])

    function fetchAllContents() {

        // loading.value = true;
        allContents.value = [];

        axios
            .get('/api/v1/my-users/')
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
                // loading.value = false;
            });

    }
</script>
