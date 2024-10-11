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
                <td class="col">{{ index + 1 }}</td>

                <td
                    class="col"
                    v-for="columnName in props.columnNames"
                >
                    {{ columnName!='status' ? contentName(content, columnName) : (content[columnName] ? 'Completed' : 'Incomplete') }}
                </td>

                <td
                    class="col"
                    v-if="props.hasActions"
                >
                    <button
                        type="button"
                        v-for="(actionButtonName, actionButtonNameIndex) in props.actionButtonNames"
                        :class="['btn', actionButtonClassNames[actionButtonNameIndex], 'me-2 mb-1']"
                        @click="$emit(actionButtonEmittingMethodNames[actionButtonNameIndex], content)"
                        v-show="! content['status']"
                    >
                        {{ $helpers.capitalizeEachWord(actionButtonName) }}
                    </button>

                    <span
                        class="text-danger"
                        v-show="content['status']"
                    >
                        - -
                    </span>
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
    import { defineProps, onMounted } from 'vue';
    import { useGeneralStore } from '@/stores/general';

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
            default:[],
            validator(value, props) {
                // The value length must be same as another props length
                return (props.actionButtonClassNames.length == value.length && props.actionButtonEmittingMethodNames.length == value.length)
            }
        },
        actionButtonClassNames: {
            type: Array,
            default:[],
            validator(value, props) {
                // The value length must be same as another props length
                return props.actionButtonNames.length == value.length
            }
        },
        actionButtonEmittingMethodNames: {
            type: Array,
            default:[],
            validator(value, props) {
                // The value length must be same as another props length
                return props.actionButtonNames.length == value.length
            }
        },
    })

    const generalStore = useGeneralStore()

    onMounted(()=>{
        //
    })

    function contentName(content, columnName) {
        if (content[columnName]) {
            return content[columnName];
        } else {
            let nestedObjectName = generalStore.currentEntityName.replace(/-/g, '_');
            return content[nestedObjectName] ? content[nestedObjectName][columnName] : 'NA';
        }
    }
</script>
