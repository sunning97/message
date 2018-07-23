<template>
    <div class="message-feed" ref="feed">
        <ul>
            <li v-for="message in messages" :class="(contact.id == message.send_from) ? 'reveived' : 'send text-right'">
                <div class="text">{{ message.content }}</div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:{
            messages:{
                type:Array,
                default:[],
            },
            contact:{
                type:Object,
                default:null,
            }
        },
        methods:{
            scroll:function () {
                setTimeout(()=>{
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                },50);
            }
        },
        watch:{
            contact(contact){
                this.scroll();
            },
            messages(message){
                this.scroll();
            }
        }
    }
</script>
<style scoped>
    .message-feed{
        position: relative;
        width: 100%;
        height: 350px;
        overflow-y:scroll;
        overflow-x:hidden;
    }
    .message-feed ul{
        list-style-type: none;
    }
    .message-feed ul li.reveived {
        text-align: left;
        margin-top: 10px ;
        margin-bottom: 10px;
        width: 300px;
    }
    .message-feed ul li.reveived .text{
        display: inline-block;
        background-color: #6c757d;
        padding: 10px 10px;
        border-radius:10px;
    }
    .message-feed ul li.send{
        text-align: right;
        margin: 10px 0;
    }
    .message-feed ul li.send .text{
        display: inline-block;
        background-color: #00a9ff;
        padding: 10px 10px;
        border-radius:10px
    }
</style>