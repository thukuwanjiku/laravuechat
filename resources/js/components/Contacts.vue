<style>
    ul {
        list-style-type: none;
        margin-top: 10px;
    }
</style>
<template>
    <div id="contacts">
        <ul>

            <li
                    v-for="connection in connections"
                    :key="connection.room_id"
                    class="contact"
            >
                <div class="wrap">
                    <span class="contact-status online"></span>
                    <img :src="connection.avatar" alt="" />
                    <div class="meta">
                        <p class="name">{{ connection.name }}</p>
                        <!--<p class="preview">You just got LITT up, Mike.</p>-->
                    </div>
                </div>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        name: "contacts",
        data(){
            return{
                chatKitUser:{},
                joinableRooms:[],
                connections:[]
            }
        },
        methods:{
            setMeUp(){
                var vm = this;
                window.chatManager.connect();
                window.chatManager
                    .connect()
                    .then((currentUser)=>{
                    vm.chatKitUser = currentUser
                        this.getPotentialContacts();
                    }).catch((error) => {
                            console.log(error);
                    });
            },
            getPotentialContacts(){
                this.chatKitUser.getJoinableRooms()
                    .then((rooms) => {
                        this.joinableRooms = rooms;
                        this.setUpConnections();
                }).cath((error)=>{
                    console.log(error);
                });
            },

            setUpConnections(){
                //we need userName, avatar, roomId
                if(!this.joinableRooms.length){
                    return;
                }
                let roomIds = [];
                let roomMakers = [];
                this.joinableRooms.forEach((room)=>{
                    roomIds.push(room.id);
                    roomMakers.push(room.name.split('_')[0]);
                });

                axios.get('/get-chatkit-users?ids='+JSON.stringify(roomMakers))
                    .then((response)=>{
                        let users = response.data.data;
                        console.log('');
                        for(let counter=0; counter<roomIds.length; counter++){
                            this.connections.push({
                                id:users[counter].id,
                                name: users[counter].name,
                                avatar: users[counter].avatar_url,
                                room_id: roomIds[counter],
                            });
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }

        },
        created(){
            this.setMeUp();
        }
    }
</script>

<style scoped>

</style>