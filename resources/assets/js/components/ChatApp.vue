<template>
    <div class="chat row">
        <conversation :contact="contact" :messages="messages" @message="message" class="col-8"></conversation>
        <list-contact :contacts="contacts" @selectedContact="selectedContact" class="col-4"></list-contact>
    </div>
</template>

<script>
    import ListContact from './ListContact';
    import Conversation from './Conversation';

    export default {
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
                    console.log(response.data);
                    this.messages = response.data;
                });
            },
            message:function (content) {
                console.log(content);
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