<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            :has-add-button="false"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            :column-names="['name']"
                            :has-actions="false"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useVaccineCenterStore } from '@/stores/vaccine-center';
    import { useGeneralStore } from '@/stores/general';

    // onCreated equivalent
    const vaccineCenterStore = useVaccineCenterStore();
    const generalStore = useGeneralStore();

    vaccineCenterStore.fetchIndexContents();

    generalStore.currentEntityName = 'vaccine-center';    // has to be lowercase
</script>
