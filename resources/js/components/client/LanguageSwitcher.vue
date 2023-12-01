<template>

  <a class="nav-item mx-2" href="#" id="languages" role="button">
    <img src='../../assets/flags/en.png' v-if="locale=='en'" @click="switchLanguage('ru')" width="40">
    <img src='../../assets/flags/ru.png' v-if="locale=='ru'" @click="switchLanguage('en')" width="40">
  </a>

</template>

<script>
import { useI18n } from 'vue-i18n';
export default {
  name: "LanguageSwitcher",

  setup(){
    const {locale} = useI18n()
    return{
      locale
    }
  },

  mounted() {
    console.log(this.locale)
  },

  data(){
    return{
      selectedLang: localStorage.getItem('lang')
    }
  },

  methods:{
    switchLanguage(lang){
      this.locale = lang
      localStorage.setItem('lang', lang);
    },
  }
}
</script>

<style scoped>
.lang-switch{
  border: none;
  background: none;
}
</style>