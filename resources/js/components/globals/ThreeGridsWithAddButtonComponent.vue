<template>
    <div class="row">
        <div class="col-xs-4 col-md-4">
            Available {{ elementName.slice(-1)=='y' ? ($helpers.capitalizeEachWord(elementName.replace(/.$/,"ies"))) : ($helpers.capitalizeEachWord(elementName) + "'s") }}
        </div>
        <div class="col-xs-4 col-md-4 text-center"></div>
        <div class="col-xs-4 col-md-4 text-end">
            <button type="button" class="btn btn-success" @click="showStoreForm">
                Add {{ $helpers.capitalizeEachWord(elementName) }}
            </button>
        </div>
    </div>
</template>

<script setup>
    import { defineProps, defineEmits, onMounted } from 'vue'

    const props = defineProps({
        elementName: {
            type: String,
            required: true
        }
    })

    const emit = defineEmits([
        'showStoreForm'
    ])

    onMounted(() => {
        // console.log('Three Grids With Add Button Component mounted.')
    })

    function showStoreForm() {
        emit('showStoreForm');
    }
</script>
