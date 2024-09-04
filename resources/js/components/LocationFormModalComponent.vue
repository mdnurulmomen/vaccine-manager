<template>
    <div class="modal fade" id="location-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                        <div class="mb-3">
                            <label class="form-label">{{ $filters.capitalize(elementName) }} Latitude</label>
                            <input
                                v-model="singleAssetData.latitude"
                                type="number"
                                :class="['form-control', errors.latitude  ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input latitude"
                                @change="validateFormInput('latitude')"
                                :disabled="isSubmitted"
                                required="true"
                                step=".001"
                            >
                            <div class="text-danger" v-show="errors.latitude">{{ errors.latitude }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ $filters.capitalize(elementName) }} Longitude</label>
                            <input
                                v-model="singleAssetData.longitude"
                                type="number"
                                :class="['form-control', errors.longitude  ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input longitude"
                                @change="validateFormInput('longitude')"
                                :disabled="isSubmitted"
                                required="true"
                                step=".001"
                            >
                            <div class="text-danger" v-show="errors.longitude">{{ errors.longitude }}</div>
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
        // console.log('Add Button Component mounted.')
    })

    const submitForm = ref(true)

    const errors = ref({
        name: null,
        latitude: null,
        longitude: null,
    })

    function verifyUserInput() {

        validateFormInput('name');

        if (errors.value.name) {
            submitForm.value = false;
            return;
        } else if (errors.value.latitude) {
            submitForm.value = false;
            return;
        } else if (errors.value.longitude) {
            submitForm.value = false;
            return;
        } else {
            submitForm.value = true;

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

            case 'latitude' :

                if (props.singleAssetData.latitude.length < 1) {
                    errors.value.latitude = 'Latitude is required';
                }
                else{
                    submitForm.value = true;
                    errors.value.latitude = null;
                }

                break;

            case 'longitude' :

                if (props.singleAssetData.longitude.length < 1) {
                    errors.value.longitude = 'Longitude is required';
                }
                else{
                    submitForm.value = true;
                    errors.value.longitude = null;
                }

                break;

        }

    }
</script>
