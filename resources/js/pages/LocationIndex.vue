<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            @show-store-form="locationStore.showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            :column-names="['name']"
                            :has-actions="true"
                            :action-button-names="['edit', 'delete']"
                            :action-button-class-names="['btn-outline-primary', 'btn-outline-danger']"
                            :action-button-emitting-method-names="['showContentEditForm', 'showContentDeleteConfirmationForm']"

                            @show-content-edit-form="generalStore.showContentEditForm"
                            @show-content-delete-confirmation-form="generalStore.showContentDeleteConfirmationForm"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <dynamic-create-update-form-modal-component
                @store-content="locationStore.storeContent"
			    @update-content="locationStore.updateContent"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                @emit-delete-method="locationStore.deleteContent"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue';
    import { Modal } from 'bootstrap';
    // import { storeToRefs } from 'pinia'
    import { useLocationStore } from '@/stores/location';
    import { useGeneralStore } from '@/stores/general';

    // onCreated equivalent
    const locationStore = useLocationStore();
    const generalStore = useGeneralStore();

    // importing state-variables with ref()
    // const { createOrEditModal, deleteConfirmationModal } = storeToRefs(locationStore)

    locationStore.fetchIndexContents();

    generalStore.currentEntityName = 'location';    // has to be lowercase

    onMounted(async () => {
        // console.log('Location List mounted.')
        generalStore.currentEntityShowableFieldObjects = [
            {
                name:'name',
                type:'text'
            },
            {
                name:'latitude',
                type:'number',
                step: 0.001
            },
            {
                name:'longitude',
                type:'number',
                step: 0.001
            }
        ];

        generalStore.currentEntityRequiredFields = ['name', 'latitude', 'longitude'];
        generalStore.createOrEditModal = new Modal('#dynamic-form-modal', {});
        generalStore.deleteConfirmationModal = new Modal('#delete-confirmation-modal', {});
    })
</script>
