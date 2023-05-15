<template>
    <div class="feed" ref="feed">
        <ul class="ul-element" v-if="contact">
            <li v-for="(message, index) in messages" :key="index.id" :class="`message${message.to == contact.id ? ' sent ': ' received ' }`" >

                <div class="avatar float-left" v-if="message.from === contact.id">
                    <img :src="contact.profile_image" alt="" v-if="contact.profile_image">
                    <img :src="contact.image" alt="" v-else>
                </div>
                <div class="text" style="border-color: #2a9055">
                    {{ message.text }}
                </div>
            </li>
        </ul>

        <ul v-else class="withOutLoadingConversation">
            <p style="font-size:18px">Please select a contact first.</p>
        </ul>

    </div>
</template>

<script>
export default {
    props:{
        contact:{
            type:Object,
        },
        messages:{
            // type:Object,
            // required:true
        }
    },
    methods:{
        scrollToBottom(){
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50)
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>

<style lang="scss" scoped>
.ul-element{
    margin-top: -124px;
}

.feed {
    background: #f0f0f0;
    padding-top: 120px;
    height: 100%;
    max-height: 370px;
    overflow-y: auto;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    border-color: red !important;
                    max-width: 400px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                &.received {
                    padding-left: 20px;
                    text-align: left;
                    .text {
                        //border-color: red !important;
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    // padding-top: -50px;
                    padding-right: 20px;
                    text-align: right;

                    .text {
                        //border-color: red !important;
                        background: #81c4f9;
                    }
                }
            }
        }

    }

}
.withOutLoadingConversation {
    height: 90%;
    margin-top: 190px;
    p {
        margin-top: -160px;
        text-align: center;
    }
}

.avatar {
    flex: 1;
    display: flex;
    margin-right: 3px;
    //align-items: center;

    img {
        max-height: 50px;
        border-radius: 50%;
        margin: 0 auto;
    }
}
</style>
