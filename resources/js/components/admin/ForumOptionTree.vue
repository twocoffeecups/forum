<template>

    <option v-if="id!==forumId" :selected="isSelectedCategory"  :value="id"> {{ "-".repeat(indent) + ' ' + name }}</option>
    <ForumOptionTree v-if="children" :forum-id="forumId" :is-selected="isSelected" v-for="child in children" :children="child.children"
                     :name="child.name" :id="child.id" :indent="indent + 1"/>
</template>

<script>
export default {
    name: "ForumOptionTree",

    props: ['children', 'name', 'id', 'indent', 'isSelected', 'forumId',],

    computed: {
        isSelectedCategory() {
            return this.id === this.isSelected;
        }
    },
}
</script>

<style scoped>

</style>
