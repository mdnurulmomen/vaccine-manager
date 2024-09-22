<template>
    <div class="modal fade" id="dynamic-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="submitForm()"
                    autocomplete="off"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ (generalStore.isCreateMode ? 'Add New' : 'Edit') }} {{ $helpers.capitalizeEachWord(generalStore.currentEntityName) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div
                            class="mb-3"
                            v-for="propertyName in generalStore.currentEntityShowableProperties"
                        >
                            <label class="form-label">
                                {{ $helpers.capitalizeEachWord(generalStore.currentEntityName) }} {{ $helpers.capitalizeEachWord(propertyName) }}
                            </label>
                            <input
                                v-model="generalStore.currentEntity[propertyName]"
                                type="text"
                                :class="['form-control', generalStore.errors[propertyName] ? 'is-invalid' : 'is-valid']"
                                :placeholder="`Please input ${propertyName}`"
                                @change="validateFormInput(propertyName)"
                                :disabled="generalStore.isSubmitted"
                                required="true"
                            >
                            <div
                                class="text-danger"
                                v-show="generalStore.errors[propertyName]"
                            >
                                {{ generalStore.errors[propertyName] }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button
                            type="submit"
                            :class="['btn', generalStore.isCreateMode ? 'btn-success' : 'btn-primary']"
                            :disabled="! isSubmittable || generalStore.isSubmitted || Object.keys(generalStore.errors).some(key => generalStore.errors[key])"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

    import { useGeneralStore } from '@/stores/general';
    import { defineEmits, onMounted, ref } from 'vue'

    const generalStore = useGeneralStore()

    const emit = defineEmits(['storeAsset', 'updateAsset'])

    onMounted(() => {
        // console.log('Add Button Component mounted.')
    })

    const isSubmittable = ref(true)

    function submitForm() {

        if (isVerifiedInput()) {

            if (generalStore.isCreateMode) {
                emit('storeAsset', generalStore.currentEntity);
            }

            else {
                emit('updateAsset', generalStore.currentEntity)
            }

        }

    }

    function isVerifiedInput() {

        generalStore.currentEntityRequiredProperties.forEach(function(propertyName) {
            validateFormInput(propertyName);
        });

        if (Object.keys(generalStore.errors).some(key => generalStore.errors[key])) {
            return false;
        }
        else {
            return true;
        }

    }

    function validateFormInput(formInputName) {

        isSubmittable.value = false;

        switch(formInputName) {

            case formInputName :

                if (! generalStore.currentEntity[formInputName]) {
                    generalStore.errors[formInputName] = 'This is required';
                }
                else{
                    isSubmittable.value = true;
                    generalStore.errors[formInputName] = null;
                }

                break;

        }

    }
</script>
