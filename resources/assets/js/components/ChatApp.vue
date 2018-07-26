<template>
    <div class="chat row">
        <conversation :contact="contact" :messages="messages" @new="saveNewMessage" class="col-8"></conversation>
        <list-contact :contacts="contacts" @selectedContact="selectedContact" class="col-4"></list-contact>
    </div>
</template>

<script>
    import ListContact from './ListContact';
    import Conversation from './Conversation';

    export default {
        props:{
            user:{
                type:Object,
                default:null,
                required:true
            }
        },
        data(){
          return {
              contacts:[],
              messages:[],
              contact: null,
          }
        },
        mounted: function () {
            this.getAllContacts();
        },
        methods:{
            getAllContacts() {
                axios.post('/get-contacts').then(response=>{
                    this.contacts = response.data;
                })
            },
            selectedContact:function (contact) {
                this.contact = contact;
                axios.post(`/get-conversation/${contact.id}`).then(response=>{
                    this.messages = response.data;
                });

                Echo.private(`message.${this.user.id}`)
                    .listen('MessageEvent', (e) => {
                        this.handleInComing(e);
                    });
            },
            saveNewMessage:function (res) {
                this.messages.push(res)
            },
            handleInComing:function (e) {
                if(this.contact && e.mess.send_from == this.contact.id){
                    this.saveNewMessage(e.mess);
                }
            }
        },
        components:{
            'list-contact': ListContact,
            'conversation' : Conversation
        }
    }
</script>
<style scoped>
    .chat{
        height: 450px;
        overflow-y: hidden;
        overflow-x: hidden;
    }
</style>