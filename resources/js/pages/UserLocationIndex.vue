<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            @show-store-form="myLocationStore.showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            :column-names="['name']"
                            :has-actions="true"
                            :action-button-names="['delete']"
                            :action-button-class-names="['btn-outline-danger']"
                            :action-button-emitting-method-names="['showContentDeleteConfirmationForm']"

                            @show-content-delete-confirmation-form="generalStore.showContentDeleteConfirmationForm"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <user-dynamic-create-update-form-modal-component
                @store-asset="myLocationStore.storeAsset"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                @emit-delete-method="myLocationStore.deleteAsset"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { Modal } from 'bootstrap'
    // import { storeToRefs } from 'pinia'
    import { useGeneralStore } from '@/stores/general';
    import { useUserLocationStore } from '@/stores/user-location';

    // onCreated equivalent
    const generalStore = useGeneralStore()
    const myLocationStore = useUserLocationStore()

    // importing state-variables with ref()
    // const { createOrEditModal, deleteConfirmationModal } = storeToRefs(myLocationStore)

    myLocationStore.fetchIndexContents();
    myLocationStore.fetchAssetSelectContents();

    generalStore.currentEntityName = 'location';    // has to be lowercase

    onMounted(async () => {
        // console.log('User-Location List mounted.')
        generalStore.currentEntityShowableFieldObjects = [
            {
                name:'location_id',
                type:'number'
            }
        ];

        generalStore.currentEntityRequiredFields = ['location_id'];
        generalStore.createOrEditModal = new Modal('#user-preference-form-modal', {});
        generalStore.deleteConfirmationModal = new Modal('#delete-confirmation-modal', {});
    })
</script>
