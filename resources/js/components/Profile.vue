<template>
    <div id="profile">
        <div class="wrap">
            <img id="profile-img" src="https://cdn4.iconfinder.com/data/icons/professions-1-2/151/12-512.png" class="online" alt="" />
            <p>Mike Ross</p>
            <!--<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>-->
            <div id="status-options">
                <ul>
                    <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                    <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                    <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                    <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                </ul>
            </div>
            <div id="expanded">
                <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
                <input name="twitter" type="text" value="mikeross" />
                <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
                <input name="twitter" type="text" value="ross81" />
                <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
                <input name="twitter" type="text" value="mike.ross" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile"
    }
</script>

<style scoped>

</style>