<template>
    <div id="frame">
        <div id="sidepanel">
            <profile></profile>
            <div id="search">
                <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                <input type="text" placeholder="Search contacts..." />
            </div>

            <contacts></contacts>

            <div id="bottom-bar">
                <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>
        <div class="content">
            <conversation></conversation>
        </div>
    </div>
</template>

<script>

    import profile from './Profile'
    import contacts from './Contacts'
    import conversation from './Conversation'

    export default {
        name: "chat",
        components:{
            profile, contacts, conversation
        },
        data(){
            return{

            }
        },
        created(){

        }
    }
</script>

<style scoped>
@import "./../../sass/chat.css";

</style>