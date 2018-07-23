<template>
    <div class="conversation">
        <div class="subject">
            {{ (contact != null) ? contact.name : 'Select one contact' }}
        </div>
        <message-feed :messages="messages" :contact="contact"></message-feed>
        <write-message @sendMessage="getMessage"></write-message>
    </div>
</template>

<script>
    import MessageFeed from './message/MesageFeed';
    import WriteMessage from './message/WriteMessage';
    export default {
        props:{
            contact:{
                type:Object,
                default:null,
            },
            messages:{
                type:Array,
                default:[]
            }
        },
        methods:{
            getMessage:function (content) {
                if(!this.contact)
                {
                    return;
                }
                axios.post('/conversation/send',{
                    contact_id:this.contact.id,
                    contentt:content
                }).then(response=>{
                    this.$emit('new',response.data);
                });
            }
        },
        components:{
            'message-feed':MessageFeed,
            'write-message':WriteMessage
        }
    }
</script>
<style scoped>
    .subject{
        width: 100%;
        font-size: 18px;
        font-weight: bold;
        background-color: #dedede;
        padding-top:10px;
        padding-bottom:10px;
        text-align:center;
    }
</style>