<template >
    <div class="flex items-center">
        <div class="flex items-center">
            <span>Bans</span>
        </div>
        <ul class="user-list mt-2 mr-2 ml-3 sm:ml-6">
            <li>
                <vx-tooltip text position="bottom">
                    <vs-avatar
                        src="https://ddragon.leagueoflegends.com/cdn/10.11.1/img/champion/Jax.png"
                        size="30px"
                        class="border-2 border-white border-solid -m-1"
                    ></vs-avatar>
                </vx-tooltip>
            </li>
            <li>
                <vx-tooltip text position="bottom">
                    <vs-avatar
                        src="https://ddragon.leagueoflegends.com/cdn/10.11.1/img/champion/Jax.png"
                        size="30px"
                        class="border-2 border-white border-solid -m-1"
                    ></vs-avatar>
                </vx-tooltip>
            </li>
        </ul>
    </div>
</template>


<script>
export default {
    name: "bans"
};
</script>