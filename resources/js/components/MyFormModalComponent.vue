<template>
    <div class="modal fade" id="my-preference-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="submitForm()"
                    autocomplete="off"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Add New {{ $filters.capitalize(elementName) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Choose {{ $filters.capitalize(elementName) }}</label>
                            <select
                                v-model="singleAssetData.asset_id"
                                :class="['form-control', props.validationErrors.name ? 'is-invalid' : 'is-valid']"
                                :disabled="isSubmitted"
                                required="true"
                            >
                                <option disabled value="">Please select {{ $filters.capitalize(elementName) }}</option>
                                <option
                                    v-for="asset in props.availableAssets" :value="asset.id"
                                >
                                    {{ $filters.capitalize(asset.name) }}
                                </option>
                            </select>
                            <div class="text-danger" v-show="props.validationErrors.name">{{ props.validationErrors.name }}</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button
                            type="submit"
                            class="btn btn-success"
                            :disabled="! isSubmittable || isSubmitted || Object.keys(props.validationErrors).some(key => props.validationErrors[key])"
                        >
                            Add
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
        elementName: {
            type: String,
            required: true
        },
        singleAssetData: {
            type: Object,
            required: true
        },
        availableAssets: {
            type: Array,
            required: true,
            default: []
        },
        validationErrors: {
            type: Object,
            required: true
        }
    })

    const emit = defineEmits(['storeMyAsset'])

    onMounted(() => {
        // console.log('Add Button Component mounted.')
    })

    const isSubmittable = ref(true)

    function submitForm() {

        if (isVerifiedInput()) {

            emit('storeMyAsset', props.singleAssetData);

        }

    }

    function isVerifiedInput() {

        validateFormInput('name');

        if (props.validationErrors.name) {
            return false;
        }
        else {
            return true;
        }

    }

    function validateFormInput(formInputName) {

        isSubmittable.value = false;

        switch(formInputName) {

            case 'name' :

                if (! props.singleAssetData.asset_id) {
                    // console.log(props.singleAssetData.name.length);
                    props.validationErrors.name = 'This is required';
                }
                else{
                    isSubmittable.value = true;
                    props.validationErrors.name = null;
                }

                break;

        }

    }
</script>
