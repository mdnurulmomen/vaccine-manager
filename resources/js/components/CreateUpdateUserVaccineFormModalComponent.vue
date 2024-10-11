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
                        <div class="mb-3">
                            <label class="form-label">
                                Select User
                            </label>

                            <select
                                v-model="generalStore.currentEntity['user']"
                                :class="['form-control', generalStore.errors['user'] ? 'is-invalid' : 'is-valid']"
                                :disabled="generalStore.isSubmitted"
                                :required="true"
                                @change="setPreferredCenter"
                            >
                                <option disabled value="">
                                    Please Select User
                                </option>

                                <option
                                    v-for="unscheduledUser in userVaccineStore.unscheduledUsers"
                                    :value="unscheduledUser"
                                >
                                    {{ $helpers.capitalizeEachWord(unscheduledUser.name) }}
                                </option>
                            </select>

                            <div
                                class="text-danger"
                                v-show="generalStore.errors['user']"
                            >
                                {{ generalStore.errors['user'] }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Change Vaccine Center
                            </label>

                            <select
                                v-model="generalStore.currentEntity['vaccine_center']"
                                :class="['form-control', generalStore.errors['vaccine_center'] ? 'is-invalid' : 'is-valid']"
                                :disabled="generalStore.isSubmitted"
                                :required="true"
                            >
                                <option disabled value="">
                                    Please Select Center
                                </option>

                                <option
                                    v-for="center in userVaccineStore.vaccineCenters"
                                    :value="center"
                                >
                                    {{ $helpers.capitalizeEachWord(center.name) }}
                                </option>
                            </select>

                            <div
                                class="text-danger"
                                v-show="generalStore.errors['vaccine_center']"
                            >
                                {{ generalStore.errors['vaccine_center'] }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Choose Schedule
                            </label>

                            <VueDatePicker
                                v-model="generalStore.currentEntity['schedule']"
                                placeholder="Select Date"
                                :class="['form-control', generalStore.errors['schedule'] ? 'is-invalid' : 'is-valid']"
                                :min-date="new Date()"
                                :enable-time-picker="false"
                                :disabled="generalStore.isSubmitted"
                                required
                            />

                            <div
                                class="text-danger"
                                v-show="generalStore.errors['schedule']"
                            >
                                {{ generalStore.errors['schedule'] }}
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
    import '@vuepic/vue-datepicker/dist/main.css'
    import VueDatePicker from '@vuepic/vue-datepicker';
    import { defineEmits, ref } from 'vue';
    import { useGeneralStore } from '@/stores/general';
    import { useUserVaccineStore } from '@/stores/user-vaccine';

    const generalStore = useGeneralStore()
    const userVaccineStore = useUserVaccineStore()

    const emit = defineEmits(['storeContent', 'updateContent'])

    userVaccineStore.fetchVaccineCenters();
    userVaccineStore.fetchUnscheduledUsers();

    const isSubmittable = ref(true)

    function setPreferredCenter() {
        generalStore.currentEntity['vaccine_center'] = userVaccineStore.vaccineCenters.find(
            vaccineCenter => vaccineCenter.id == generalStore.currentEntity['user'].vaccine_center_id
        )
    }

    function submitForm() {

        if (isVerifiedInput()) {

            generalStore.currentEntity['user_id'] = generalStore.currentEntity['user']['id'];
            generalStore.currentEntity['vaccine_center_id'] = generalStore.currentEntity['vaccine_center']['id'];
            generalStore.currentEntity['schedule'] = formatVaccineSchedule(generalStore.currentEntity['schedule']);

            if (generalStore.isCreateMode) {
                emit('storeContent', generalStore.currentEntity);
            }

            else {
                emit('updateContent', generalStore.currentEntity)
            }

        }

    }

    function formatVaccineSchedule(date) {
        const d = new Date(date);

        const day = d.getDate();
        const month = d.getMonth() + 1;
        const year = d.getFullYear();

        return `${year}-${month}-${day}`;
    }

    function isVerifiedInput() {

        validateFormInput('user');
        validateFormInput('schedule');
        validateFormInput('vaccine_center');

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

            case 'user' :

                if (! generalStore.currentEntity['user']) {
                    generalStore.errors[formInputName] = 'User is required';
                }
                else{
                    isSubmittable.value = true;
                    generalStore.errors[formInputName] = null;
                }

                break;

            case 'vaccine_center' :

                if (! generalStore.currentEntity['vaccine_center']) {
                    generalStore.errors[formInputName] = 'Vaccine center is required';
                }
                else{
                    isSubmittable.value = true;
                    generalStore.errors[formInputName] = null;
                }

                break;

            case 'schedule' :

                if (! generalStore.currentEntity['schedule']) {
                    generalStore.errors[formInputName] = 'Schedule is required';
                }
                else{
                    isSubmittable.value = true;
                    generalStore.errors[formInputName] = null;
                }

                break;

        }

    }
</script>
