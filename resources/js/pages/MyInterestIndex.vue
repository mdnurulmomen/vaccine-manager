<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            @show-store-form="myInterestStore.showStoreForm"
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
            <my-dynamic-create-update-form-modal-component
                @store-asset="myInterestStore.storeAsset"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                @emit-delete-method="myInterestStore.deleteAsset"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { Modal } from 'bootstrap'
    // import { storeToRefs } from 'pinia'
    import { useGeneralStore } from '@/stores/general';
    import { useMyInterestStore } from '@/stores/my-interest';

    // onCreated equivalent
    const generalStore = useGeneralStore()
    const myInterestStore = useMyInterestStore()

    // importing state-variables with ref()
    // const { createOrEditModal, deleteConfirmationModal } = storeToRefs(myInterestStore)

    myInterestStore.fetchIndexContents();
    myInterestStore.fetchMyAssetSelectContents();

    generalStore.currentEntityName = 'interest';    // has to be lowercase

    onMounted(async () => {
        // console.log('My-Interest List mounted.')
        generalStore.currentEntityShowableFieldObjects = [
            {
                name:'interest_id',
                type:'number'
            }
        ]
        generalStore.currentEntityRequiredFields = ['interest_id']
        generalStore.createOrEditModal = new Modal('#my-preference-form-modal', {})
        generalStore.deleteConfirmationModal = new Modal('#delete-confirmation-modal', {})
    })
</script>
