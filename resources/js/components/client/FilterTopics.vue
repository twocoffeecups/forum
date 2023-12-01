<template>
    <div class="row text-left">
        <div class="col-lg-4 mb-sm-0">
            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">
                <select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select"
                        tabindex="-98">
                    <option> First Message</option>
                    <option> Last message</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">
                <VueMultiselect
                    v-model="multiValue"
                    :options="source"
                    :multiple="true"
                    :close-on-select="false"
                    placeholder="Select whith tag"
                    label="option"
                    track-by="option"
                />
            </div>

        </div>

        <div class="col-lg-4 text-lg-right">
            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">
                <select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select"
                        tabindex="-98">
                    <option> {{ $t('component.filterTopics.filterBy.filterBy') }}</option>
                    <option> {{ $t('component.filterTopics.filterBy.votes') }}</option>
                    <option> {{ $t('component.filterTopics.filterBy.replys') }}</option>
                    <option> {{ $t('component.filterTopics.filterBy.views') }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect';

export default {
    name: 'FilterTopics',
    components: {VueMultiselect},

    data() {
        return {
            multiValue: [],
            source: [
                {option: '1', value: 1},
                {option: '2', value: 2},
                {option: '3', value: 3},
            ],
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
