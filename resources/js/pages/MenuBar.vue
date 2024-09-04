<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#">Network Connector</a>

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
                                            <RouterLink class="dropdown-item" to="/skills">
                                                Skills
                                                <span class="sr-only" v-show="currentRouteName=='skills.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/interests">
                                                Interests
                                                <span class="sr-only" v-show="currentRouteName=='interests.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/locations">
                                                Locations
                                                <span class="sr-only" v-show="currentRouteName=='locations.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/political-parties">
                                                Polytical-Parties
                                                <span class="sr-only" v-show="currentRouteName=='political-parties.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            My Preferences
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <RouterLink class="dropdown-item" to="/my-skills">
                                                Preferred Skills
                                                <span class="sr-only" v-show="currentRouteName=='my-skills.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/my-interests">
                                                Preferred Interests
                                                <span class="sr-only" v-show="currentRouteName=='my-interests.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/my-locations">
                                                Preferred Locations
                                                <span class="sr-only" v-show="currentRouteName=='my-locations.index'">
                                                    (current)
                                                </span>
                                            </RouterLink>

                                            <RouterLink class="dropdown-item" to="/my-political-parties">
                                                Preferred Parties
                                                <span class="sr-only" v-show="currentRouteName=='my-political-parties.index'">
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

<script>
    export default {
        mounted() {
            console.log('MenuBar mounted.')
        },

        computed: {
            currentRouteName() {
                return this.$route.name;
            }
        }
    }
</script>
