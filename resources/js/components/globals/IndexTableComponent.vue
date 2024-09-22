<template>
    <table class="table table-striped">
        <thead>
            <tr class="row text-center">
                <th class="col">#</th>

                <th
                    class="col"
                    v-for="columnName in props.columnNames"
                >
                    {{ $helpers.capitalizeEachWord(columnName) }}
                </th>

                <th
                    class="col"
                    v-if="props.hasActions"
                >
                    Actions
                </th>
            </tr>
        </thead>
        <tbody v-if="generalStore.currentIndexContents.length">
            <tr
                class="row text-center"
                v-for="(content, index) in generalStore.currentIndexContents"
            >
                <td class="col">{{ index+1 }}</td>

                <td
                    class="col"
                    v-for="columnName in props.columnNames"
                >
                    {{
                        (content[columnName] ? content[columnName] : (content[generalStore.currentEntityName.replace(/-/g, '_')] ? content[generalStore.currentEntityName.replace(/-/g, '_')][columnName] : 'NA'))
                    }}
                </td>

                <td
                    class="col"
                    v-if="props.hasActions"
                >
                    <button
                        type="button"
                        v-for="(actionButtonName, actionButtonNameIndex) in props.actionButtonNames"
                        :class="['btn', actionButtonClassNames[actionButtonNameIndex], 'me-2']"
                        @click="$emit(actionButtonEmittingMethodNames[actionButtonNameIndex], content)"
                    >
                        {{ $helpers.capitalizeEachWord(actionButtonName) }}
                    </button>
                </td>
            </tr>
        </tbody>

        <tbody v-else>
            <tr>
                <th
                    class="text-center"
                    :colspan="props.hasActions ? (columnNames.length+2) : (columnNames.length+1)"
                >
                    <span class="text-danger">
                        No {{ $helpers.capitalizeEachWord(generalStore.currentEntityName) }} Found
                    </span>
                </th>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
    import { useGeneralStore } from '@/stores/general';
    import { defineProps, onMounted, ref } from 'vue';

    const props = defineProps({
        columnNames: {
            type: Array,
            required: true
        },
        hasActions: {
            type: Boolean,
            default: true
        },
        actionButtonNames: {
            type: Array,
            required: true
        },
        actionButtonClassNames: {
            type: Array,
            required: true
        },
        actionButtonEmittingMethodNames: {
            type: Array,
            required: true
        },
    })

    const generalStore = useGeneralStore()

    onMounted(()=>{

    })
</script>
