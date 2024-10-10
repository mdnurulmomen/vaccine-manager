<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <three-grids-and-add-button-component
                            @show-store-form="userVaccineStore.showStoreForm"
                        />
                    </div>

                    <div class="card-body">
                        <index-table-component
                            :column-names="['name', 'status']"
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
            <create-update-user-vaccine-form-modal-component
                @store-content="userVaccineStore.storeContent"
			    @update-content="userVaccineStore.updateContent"
            />
        </div>

        <div class="row">
            <delete-confirmation-component
                @emit-delete-method="userVaccineStore.deleteContent"
            />
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue';
    import { Modal } from 'bootstrap';
    import { useGeneralStore } from '@/stores/general';
    import { useUserVaccineStore } from '@/stores/user-vaccine';

    // onCreated equivalent
    const generalStore = useGeneralStore();
    const userVaccineStore = useUserVaccineStore();

    userVaccineStore.fetchIndexContents();

    generalStore.currentEntityName = 'scheduled-users';    // has to be lowercase

    onMounted(async () => {
        // console.log('User-Vaccine List mounted.')
        generalStore.createOrEditModal = new Modal('#dynamic-form-modal', {});
        generalStore.deleteConfirmationModal = new Modal('#delete-confirmation-modal', {});
    })
</script>
