<template>
    <div class="modal fade" id="name-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="verifyUserInput"
                    autocomplete="off"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ (isCreateMode ? 'Add New' : 'Edit') }} {{ $filters.capitalize(elementName) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">{{ $filters.capitalize(elementName) }} Name</label>
                            <input
                                v-model="singleAssetData.name"
                                type="text"
                                :class="['form-control', errors.name  ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input name"
                                @change="validateFormInput('name')"
                                :disabled="isSubmitted"
                                required="true"
                            >
                            <div class="text-danger" v-show="errors.name">{{ errors.name }}</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button
                            type="submit"
                            :class="['btn', isCreateMode ? 'btn-success' : 'btn-primary']"
                            :disabled="! submitForm || isSubmitted"
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
        }
    })

    const emit = defineEmits(['storeAsset', 'updateAsset'])

    onMounted(() => {
        console.log('Add Button Component mounted.')
    })

    const submitForm = ref(true)

    const errors = ref({
        name: null,
    })

    function verifyUserInput() {

        validateFormInput('name');

        if (errors.value.name) {
            submitForm.value = false;
            return;
        }
        else {

            if (props.isCreateMode) {
                emit('storeAsset', props.singleAssetData);
            }

            else {
                emit('updateAsset', props.singleAssetData)
            }

        }

    }

    function validateFormInput(formInputName) {

        submitForm.value = false;

        switch(formInputName) {

            case 'name' :

                if (props.singleAssetData.name.length < 1) {
                    console.log(props.singleAssetData.name.length);
                    errors.value.name = 'Name is required';
                }
                else if (! props.singleAssetData.name.match(/^[a-zA-Z0-9-_ ]+$/)) {
                    errors.value.name = 'No special character is allowed';
                }
                else{
                    submitForm.value = true;
                    errors.value.name = null;
                }

                break;

        }

    }
</script>
