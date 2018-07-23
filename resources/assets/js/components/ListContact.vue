<template>
    <div class="list-contact">
        <ul>
            <li v-for="(contact,index) in contacts" :class="(selected == index) ? 'select' : ''" @click="setSelectedContact(contact,index)">
                <div class="row">
                    <div class="avatar col-4">
                        <img :src="contact.avatar" :alt="contact.name" class="img-fluid rounded-circle" width="100px" height="100px">
                    </div>
                    <div class="info col-8">
                        <div class="name"><b>{{ contact.name }}</b></div>
                        <div class="email">{{contact.email }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              selected: -1,
          }
        },
        props:{
            contacts:{
                type: Array,
                default: [],
                required: true,
            }
        },
        methods:{
            setSelectedContact: function (contact,index) {
                this.selected = index;
                this.$emit('selectedContact',contact);
            }
        }
    }
</script>

<style scoped>
    .list-contact{
        margin: 0;
        padding: 0;
        height: 450px;
        overflow-y: scroll;
        overflow-x:hidden;
    }
    ul{
        list-style-type: none;
        margin: 0;
        padding:0;
    }
    ul li{
        cursor: pointer;
        border-bottom:1px solid #b9bbbe;
    }
    ul li.select{
        background-color:#dedede;
    }
    ul li .avatar{
    }
</style>