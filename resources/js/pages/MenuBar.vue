<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#">Vaccine Manager</a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <RouterLink class="nav-link" to="/home">
                                            Home
                                            <span class="sr-only" v-show="currentRouteName=='home'">(current)</span>
                                        </RouterLink>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Assets
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <RouterLink class="dropdown-item" to="/vaccine-centers">
                                                Centers
                                                <span class="sr-only" v-show="currentRouteName=='vaccine-centers.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Vaccinate Users
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <RouterLink class="dropdown-item" to="/user-vaccines">
                                                Scheduled Users
                                                <span class="sr-only" v-show="currentRouteName=='user-vaccines.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <div class="card-body">
                        <RouterView />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, computed } from 'vue';
    import { useRouter } from 'vue-router'

    onMounted(() => {

    });

    const router = useRouter();

    const currentRouteName = computed(() => {
        return router.name;
    })
</script>
