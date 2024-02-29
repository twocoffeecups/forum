<template>
    <div class="card rounded-0 mb-4 mb-xl-0">
        <div class="card-header">{{ $t('view.editAccount.avatar') }}</div>
        <div class="card-body text-center position-relative">
            <!-- Avatar -->
            <img v-if="defaultAvatar" class="img-account-profile rounded-circle mb-2" width="160" :src="defaultAvatar" alt="avatar">
            <img v-if="!defaultAvatar" class="img-account-profile rounded-circle mb-2" width="160" src="../../assets/img/default-avatar.png" alt="avatar">
            <div class="overlay">
                <div v-if="isFileUpload">
                    <span class="mx-2 text-success" title="Upload"><i class="fas fa-check"
                                                                      @click="updateAvatar"></i></span>
                    <span class="mx-2 text-danger" title="Remove"><i class="fas fa-times"
                                                                     @click="removeAvatar"></i></span>
                </div>
            </div>

            <!-- Image help block-->
            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
            <!-- Upload button-->
            <label class="btn btn-primary">
                {{ $t('view.editAccount.newImg') }}
                <input type="file" name="avatar" class="file-input" hidden ref="avatar" @change="handleFileUpload">
            </label>

        </div>
    </div>
</template>

<script>
export default {
    name: "EditAvatarCard",

    data() {
        return {
            defaultAvatar: this.$store.getters['auth/avatar'],
            newAvatar: null,
            isFileUpload: null,
            userId: 1
        }
    },

    watch: {
        updateAvatar() {
            this.printImageButton()
        }
    },

    methods: {

        handleFileUpload() {
            this.newAvatar = this.$refs.avatar.files[0]
            const file = new FileReader();
            file.readAsDataURL(this.newAvatar);
            file.onload = () => {
                this.defaultAvatar = file.result;
            };
            this.isFileUpload = 1;
        },

        printImageButton() {
            let overlay = document.querySelector('.overlay')
            overlay.style.opacity = 1;
        },

        updateAvatar() {
            this.$store.dispatch('profile/updateAvatar', this.newAvatar);
            this.isFileUpload = null;
        },

        removeAvatar() {
            this.defaultAvatar = this.$store.getters['auth/avatar'];
            this.newAvatar = null;
            this.isFileUpload = null;
        }
    },

}
</script>

<style scoped>
[hidden] {
    display: none !important;
}

.overlay {
    text-shadow: black 2px 2px 0, black -2px -2px 0,
    black -1px 1px 0, black 1px -1px 0;
    color: #f1f1f1;
    transition: .5s ease;
    opacity: 1;
    font-size: 20px;
    padding: 10px;
}

/*.overlay:hover {*/
/*  opacity: 1;*/
/*}*/
</style>
