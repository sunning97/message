<template>
    <div class="write-message">
        <div class="form-group">
            <input @keydown.enter="sendMessage" v-model="content" id="ahihi" class="form-control" placeholder="Input text..."/>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                content:'',
            }
        },
        methods:{
            sendMessage(){
                if(this.content == '') return;
                this.$emit('sendMessage',this.content);
                this.content = '';
                $('#ahihi').val('');
            }
        }
    }
</script>
<style scoped>
    .write-message{
        position: absolute;
        top: 400px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
    }
</style>