<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-with-add-button-component
                            element-name="skill"

                            @show-store-form="skillStore.showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            element-name="skill"
                            :contents="skillStore.allContents"
                            :column-names="['name']"
                            :has-actions="true"
                            :action-button-names="['edit', 'delete']"
                            :action-button-class-names="['btn-outline-primary', 'btn-outline-danger']"
                            :action-button-emitting-method-names="['showContentEditForm', 'showContentDeleteConfirmationForm']"

                            @show-content-edit-form="skillStore.showContentEditForm"
                            @show-content-delete-confirmation-form="skillStore.showContentDeleteConfirmationForm"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <dynamic-form-modal-component
                element-name="skill"
                :is-submitted="skillStore.isSubmitted"
                :is-create-mode="skillStore.isCreateMode"
                :single-asset-data="skillStore.singleAssetData"
                :validation-errors="skillStore.errors"

                @store-asset="skillStore.storeAsset"
			    @update-asset="skillStore.updateAsset"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                :is-submitted="skillStore.isSubmitted"
                :content-to-delete="skillStore.singleAssetData"

                @emit-delete-method="skillStore.deleteAsset"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { Modal } from 'bootstrap'
    import { storeToRefs } from 'pinia'
    import { useSkillStore } from '@/stores/skill';

    const skillStore = useSkillStore()

    // importing state-variables with ref()
    const { createOrEditModal, deleteConfirmationModal } = storeToRefs(skillStore)

    skillStore.fetchAllContents();

    onMounted(async () => {
        // console.log('Skill List mounted.')
        createOrEditModal.value = new Modal('#dynamic-form-modal', {})
        deleteConfirmationModal.value = new Modal('#delete-confirmation-modal', {})
    })
</script>
