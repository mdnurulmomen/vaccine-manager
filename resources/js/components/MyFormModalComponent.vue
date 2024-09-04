<template>
    <div class="modal fade" id="my-preference-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="verifyUserInput"
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
                                :class="['form-control', errors.name  ? 'is-invalid' : 'is-valid']"
                                :disabled="isSubmitted"
                                required="true"
                            >
                                <option disabled value="">Please select {{ $filters.capitalize(elementName) }}</option>
                                <option
                                    v-for="asset in props.assets" :value="asset.id"
                                >
                                    {{ $filters.capitalize(asset.name) }}
                                </option>
                            </select>
                            <div class="text-danger" v-show="errors.name">{{ errors.name }}</div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button
                            type="submit"
                            class="btn btn-success"
                            :disabled="! submitForm || isSubmitted"
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
        assets: {
            type: Array,
            required: true,
            default: []
        }
    })

    const emit = defineEmits(['storeAsset', 'updateAsset'])

    onMounted(() => {
        // console.log('Add Button Component mounted.')
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

            emit('storeMyAsset', props.singleAssetData);

        }

    }

    function validateFormInput(formInputName) {

        submitForm.value = false;

        switch(formInputName) {

            case 'name' :

                if (! props.singleAssetData.asset_id) {
                    // console.log(props.singleAssetData.name.length);
                    errors.value.name = 'This is required';
                }
                else{
                    submitForm.value = true;
                    errors.value.name = null;
                }

                break;

        }

    }
</script>
