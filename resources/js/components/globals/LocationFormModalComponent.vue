<template>
    <div class="modal fade" id="location-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form
                    v-on:submit.prevent="submitForm()"
                    autocomplete="off"
                >
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ (isCreateMode ? 'Add New' : 'Edit') }} {{ $helpers.capitalizeEachWord(elementName) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">{{ $helpers.capitalizeEachWord(elementName) }} Name</label>
                            <input
                                v-model="singleAssetData.name"
                                type="text"
                                :class="['form-control', props.validationErrors.name ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input name"
                                @change="validateFormInput('name')"
                                :disabled="isSubmitted"
                                required="true"
                            >

                            <div
                                class="text-danger"
                                v-show="props.validationErrors.name"
                            >
                                {{ props.validationErrors.name }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ $helpers.capitalizeEachWord(elementName) }} Latitude</label>
                            <input
                                v-model="singleAssetData.latitude"
                                type="number"
                                :class="['form-control', props.validationErrors.latitude ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input latitude"
                                @change="validateFormInput('latitude')"
                                :disabled="isSubmitted"
                                required="true"
                                step=".001"
                            >
                            <div
                                class="text-danger"
                                v-show="props.validationErrors.latitude"
                            >
                                {{ props.validationErrors.latitude }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ $helpers.capitalizeEachWord(elementName) }} Longitude</label>
                            <input
                                v-model="singleAssetData.longitude"
                                type="number"
                                :class="['form-control', props.validationErrors.longitude ? 'is-invalid' : 'is-valid']"
                                placeholder="Please input longitude"
                                @change="validateFormInput('longitude')"
                                :disabled="isSubmitted"
                                required="true"
                                step=".001"
                            >
                            <div
                                class="text-danger"
                                v-show="props.validationErrors.longitude"
                            >
                                {{ props.validationErrors.longitude }}
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
            default: {
                name: null,
                latitude: null,
                longitude: null,
            }
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

        validateFormInput('name');
        validateFormInput('latitude');
        validateFormInput('longitude');

        if (props.validationErrors.name) {
            return false;
        } else if (props.validationErrors.latitude) {
            return false;
        } else if (props.validationErrors.longitude) {
            return false;
        } else {
            return true;
        }

    }

    function validateFormInput(formInputName) {

        isSubmittable.value = false;

        switch(formInputName) {

            case 'name' :

                if (props.singleAssetData.name.length < 1) {
                    props.validationErrors.name = 'Name is required';
                }
                else if (! props.singleAssetData.name.match(/^[a-zA-Z0-9-_ ]+$/)) {
                    props.validationErrors.name = 'No special character is allowed';
                }
                else{
                    isSubmittable.value = true;
                    props.validationErrors.name = null;
                }

                break;

            case 'latitude' :

                if (props.singleAssetData.latitude.length < 1) {
                    props.validationErrors.latitude = 'Latitude is required';
                }
                else{
                    isSubmittable.value = true;
                    props.validationErrors.latitude = null;
                }

                break;

            case 'longitude' :

                if (props.singleAssetData.longitude.length < 1) {
                    props.validationErrors.longitude = 'Longitude is required';
                }
                else{
                    isSubmittable.value = true;
                    props.validationErrors.longitude = null;
                }

                break;

        }

    }
</script>
