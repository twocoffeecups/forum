<template>

    <option :selected="isSelectedCategory" :value="id"> {{ "-".repeat(indent) + ' ' + name }}</option>
    <ForumOptionTree v-if="children" :is-selected="isSelected" v-for="child in children" :children="child.children"
                     :name="child.name" :id="child.id" :indent="indent + 1"/>
</template>

<script>
export default {
    name: "ForumOptionTree",

    props: ['children', 'name', 'id', 'indent', 'isSelected'],

    computed: {
        isSelectedCategory() {
            return this.id == this.isSelected ? 'selected' : '';
        }
    },
}
</script>

<style scoped>

</style>
