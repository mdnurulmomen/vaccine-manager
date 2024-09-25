<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            @show-store-form="mySkillStore.showStoreForm"
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
                @store-content="mySkillStore.storeContent"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                @emit-delete-method="mySkillStore.deleteContent"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue';
    import { Modal } from 'bootstrap';
    // import { storeToRefs } from 'pinia';
    import { useGeneralStore } from '@/stores/general';
    import { useUserSkillStore } from '@/stores/user-skill';

    // onCreated equivalent
    const generalStore = useGeneralStore();
    const mySkillStore = useUserSkillStore();

    // importing state-variables with ref()
    // const { createOrEditModal, deleteConfirmationModal } = storeToRefs(mySkillStore)

    mySkillStore.fetchIndexContents();
    mySkillStore.fetchAssetSelectContents();

    generalStore.currentEntityName = 'skill';    // has to be lowercase

    onMounted(async () => {
        // console.log('User-skill List mounted.')
        generalStore.currentEntityShowableFieldObjects = [
            {
                name:'skill_id',
                type:'number'
            }
        ];

        generalStore.currentEntityRequiredFields = ['skill_id'];
        generalStore.createOrEditModal = new Modal('#user-preference-form-modal', {});
        generalStore.deleteConfirmationModal = new Modal('#delete-confirmation-modal', {});
    })
</script>
