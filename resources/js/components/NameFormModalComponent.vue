<template>
    <div class="modal fade" id="name-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="submitForm()"
                    autocomplete="off"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ (isCreateMode ? 'Add New' : 'Edit') }} {{ $filters.capitalize(elementName) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div
                            class="mb-3"
                            v-for="singleAssetFieldName in Object.keys(props.singleAssetData)"
                        >
                            <label class="form-label">{{ $filters.capitalize(elementName) }} {{ $filters.capitalize(singleAssetFieldName) }}</label>
                            <input
                                v-model="singleAssetData[singleAssetFieldName]"
                                type="text"
                                :class="['form-control', props.validationErrors[singleAssetFieldName] ? 'is-invalid' : 'is-valid']"
                                :placeholder="`Please input ${singleAssetFieldName}`"
                                @change="validateFormInput(singleAssetFieldName)"
                                :disabled="isSubmitted"
                                required="true"
                            >
                            <div
                                class="text-danger"
                                v-show="props.validationErrors[singleAssetFieldName]"
                            >
                                {{ props.validationErrors[singleAssetFieldName] }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button
                            type="submit"
                            :class="['btn', isCreateMode ? 'btn-success' : 'btn-primary']"
                            :disabled="! isSubmittable || isSubmitted || Object.keys(props.validationErrors).some(key => props.validationErrors[key])"
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

    import { defineProps, defineEmits, onMounted, ref } from 'vue'

    const props = defineProps({
        isSubmitted: {
            type: Boolean,
            default: false
        },
        isCreateMode: {
            type: Boolean,
            default: true
        },
        elementName: {
            type: String,
            required: true
        },
        singleAssetData: {
            type: Object,
            required: true
        },
        validationErrors: {
            type: Object,
            required: true
        }
    })

    const emit = defineEmits(['storeAsset', 'updateAsset'])

    onMounted(() => {
        // console.log('Add Button Component mounted.')
    })

    const isSubmittable = ref(true)

    function submitForm() {

        if (isVerifiedInput()) {

            if (props.isCreateMode) {
                emit('storeAsset', props.singleAssetData);
            }

            else {
                emit('updateAsset', props.singleAssetData)
            }

        }

    }

    function isVerifiedInput() {

        for (let singleAssetFieldName in props.singleAssetData) {

            validateFormInput(singleAssetFieldName);

        }

        if (Object.keys(props.validationErrors).some(key => props.validationErrors[key])) {
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

                if (! props.singleAssetData[formInputName]) {
                    props.validationErrors[formInputName] = 'This is required';
                }
                else{
                    isSubmittable.value = true;
                    props.validationErrors[formInputName] = null;
                }

                break;

        }

    }
</script>
