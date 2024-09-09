<template>
    <table class="table table-striped">
        <thead>
            <tr class="row text-center">
                <th class="col">#</th>

                <th
                    class="col"
                    v-for="columnName in props.columnNames"
                >
                    {{ $filters.capitalize(columnName) }}
                </th>

                <th
                    class="col"
                    v-if="props.hasActions"
                >
                    Actions
                </th>
            </tr>
        </thead>
        <tbody v-if="contents.length">
            <tr
                class="row text-center"
                v-for="(content, index) in contents"
            >
                <td class="col">{{ index+1 }}</td>

                <td
                    class="col"
                    v-for="columnName in props.columnNames"
                >
                    {{
                        (content[columnName] ? content[columnName] : (content[elementName.replace(/-/g, '_')] ? content[elementName.replace(/-/g, '_')][columnName] : 'NA'))
                    }}
                </td>

                <td
                    class="col"
                    v-if="props.hasActions"
                >
                    <button
                        type="button"
                        v-for="(actionButtonName, index) in props.actionButtonNames"
                        :class="['btn', actionButtonClassNames[index], 'me-2']"
                        @click="$emit(actionButtonEmittingMethodNames[index], content)"
                    >
                        {{ $filters.capitalize(actionButtonName) }}
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
                    <span class="text-danger">No {{ $filters.capitalize(elementName) }} Found</span>
                </th>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
    import { defineProps, defineEmits, onMounted, ref } from 'vue';

    const props = defineProps({
        elementName: {
            type: String,
            required: true
        },
        contents: {
            type: Array,
            required: true
        },
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

    onMounted(()=>{

    })
</script>
