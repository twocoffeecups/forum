<template>
    <div class="d-flex justify-content-center mt-3">
        <router-link
            v-if="checkHasPermissions([AccessPermissions.CAN_CREATE_TOPIC])"
            :to="{name:'topic.create'}"
            class="btn btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold">
            {{ $t('component.createTopic.btn') }}
        </router-link>
    </div>
</template>

<script>
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "CreateTopic",

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },
}
</script>

<style scoped>

</style>
