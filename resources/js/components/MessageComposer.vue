<template>
    <div class="composer">
        <div class="row justify-content-center">
            <div class="col-md-10" style="padding-right: 0 !important;">
                <textarea v-model="message" placeholder="  TYPE YOUR MESSAGE HERE..." ></textarea>
            </div>
            <div class="col-md-2" style="padding-left: 0 !important;">
                <button type="button" class="btn send-button" @click="send">SEND</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            message: ''
        }
    },
    methods:{
        send(){
            if(this.message == ''){
                return;
            }
            this.$emit('send', this.message);
            this.message = '';
        }
    }
}
</script>

<style lang="scss" scoped>
.composer textarea {
    width: 100%;
    margin-top: 8px;
    resize: none;
    border-radius: 25px;
    padding: 6px;
    border-color: #2c4e3a;
    border-width: 3px;
    background-color: #d1c3c3;
}
textarea::placeholder {
    color: #514343;
    font-size: 20px;
    vertical-align: middle;
}
.send-button {
    width: 90%;
    margin: 1em;
    border-radius: 20px;
    color: #514343;
    background-color: #8ab588;
    border-color: #2c4e3a;
    border-width: 3px;
}
</style>
