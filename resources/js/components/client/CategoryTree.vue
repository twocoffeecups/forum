<template>
  <div class="tree-menu">
    <div @click="toggleChildrenComponent(); selectCategory(id, title, root)"  :style="componentIndent">
      <i v-if="children" :class="`${arrowIcon} arrow-icon`"></i>
      <span :class="selectCategoryBtn"> {{ title }}</span>
    </div>
    <CategoryTree v-if="showChildren" @selectCategoryEmit="selectCategoryEmit" :is-selected="isSelected" v-for="child in children" :children="child.children" :root="child.root" :title="child.title" :id="child.id" :indent="indent + 1"/>
  </div>
</template>

<script>
export default {
  name: "CategoryTree",

  props:[ 'children', 'title', 'id', 'indent', 'isSelected', 'root', 'root'],

  computed:{
    componentIndent(){
      return { transform: `translate(${this.indent * 30}px)` };
    },

    arrowIcon(){
      return this.showChildren!==true?'fas fa-arrow-down':'fas fa-arrow-up';
    },

    selectCategoryBtn(){
      return this.id===this.isSelected && !this.root ? 'active-btn':'';
    }
  },

  data(){
    return{
      showChildren: false,
      selectedId:null,
    }

  },

  methods:{
    toggleChildrenComponent() {
      this.showChildren = !this.showChildren;
    },

    selectCategory(id, title, root){
      if(!root){
        this.selectedId = id;
        this.$emit('selectCategoryEmit', {id: id, title: title});
      }
    },

    selectCategoryEmit(data) {
      this.$emit('selectCategoryEmit', data)
    }

  }
}
</script>

<style scoped>
.arrow-icon{
  font-size: 12px;
  padding: 4px;
}

.active-btn{
  background-color: #0b5ed7;
  border-radius: 7px;
  color: white;
}

.tree-menu{
  padding: 5px;
  font-size: 18px;
}

.tree-menu span{
  margin-top: 2px;
  padding: 6px;
  cursor: pointer;
}

</style>