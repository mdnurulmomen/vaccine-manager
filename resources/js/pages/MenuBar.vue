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
                                        <RouterLink class="nav-link" to="/">
                                            Home
                                            <span class="sr-only" v-show="currentRouteName=='dashboard'">(current)</span>
                                        </RouterLink>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <RouterLink id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Assets
                                        </RouterLink>

                                        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a> -->

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <RouterLink class="dropdown-item" to="/skills">
                                                Skills
                                                <span class="sr-only" v-show="currentRouteName=='skills.index'">
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
