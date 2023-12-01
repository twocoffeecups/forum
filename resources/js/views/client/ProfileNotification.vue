<template>
  <div class="container" id="notifications">

    <div class="card">
      <div class="card-body">
        <!-- Notification messages -->
        <div class="alert alert-light d-flex justify-content-between" role="alert">
          <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
              <i class="fas fa-info-circle"></i>
            </div>
            <div>
              Пользователь <a href="#">Tod Howard</a> положительно оценил вашу запись <a href="#">My first topic</a>
            </div>
          </div>
          <div class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
          </div>
        </div>
        <div class="alert alert-danger d-flex justify-content-between" role="alert">
          <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
              Ваш аккаун заблокирован до 29.10.2023 за нарушение правил сообщества.
            </div>
          </div>
          <div class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
          </div>
        </div>
        <div class="alert alert-warning d-flex justify-content-between" role="alert">
          <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
              Ваша заявка на блоклокировку пользователя <a href="#">Tod Howard</a> за сообщение <a href="#">My first topic</a>
              было полученно администрацией и будет рассмотренно в кратчайшие сроки.
            </div>
          </div>
          <div class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
          </div>
        </div>
        <div class="alert alert-success d-flex justify-content-between" role="alert">
          <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
              <i class="fas fa-check-circle"></i>
            </div>
            <div>
              Ваша заявка на блоклокировку пользователя <a href="#">Tod Howard</a> за сообщение <a href="#">My first topic</a> была одобренна.
            </div>
          </div>
          <div class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
          </div>
        </div>
      </div>

    </div>



  </div>
</template>

<script>
export default {
  name: "ProfileNotification"
}
</script>

<style scoped>

</style>