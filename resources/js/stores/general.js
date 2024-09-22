import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useGeneralStore = defineStore('general', () => {
    /* state */
    const loading = ref(true)

    const isSubmitted = ref(false)

    const isCreateMode = ref(true)

    const createOrEditModal = ref(null)

    const deleteConfirmationModal = ref(null)

    const currentIndexContents = ref([])

    const currentEntityName = ref(null)

    const currentEntity = ref({})

    const errors = ref({})

    const currentEntityShowableProperties = ref([])

    const currentEntityRequiredProperties = ref([])

    const deletionWarningMessage = ref("Remember, You can't restore this item again !")

    /* getters */
    // const doubleCount = computed(() => count.value * 2)

    /* actions */
    function showStoreForm() {
        isCreateMode.value = true;
        createOrEditModal.value.show();
    }
    function showContentEditForm(content) {
        isCreateMode.value = false;
        currentEntity.value = content;
        createOrEditModal.value.show();
    }

    function showContentDeleteConfirmationForm(content) {
        currentEntity.value = content;
        deleteConfirmationModal.value.show();
    }

    return {
        loading, isSubmitted, isCreateMode, createOrEditModal, deleteConfirmationModal, currentIndexContents, currentEntityName, currentEntity, currentEntityShowableProperties, currentEntityRequiredProperties, errors, deletionWarningMessage,
        showStoreForm, showContentEditForm, showContentDeleteConfirmationForm
    }
})
