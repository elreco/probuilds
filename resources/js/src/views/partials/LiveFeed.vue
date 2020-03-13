<template>
    <vx-card>
        <div class="vx-col w-full">
            <h4 class="mb-base">Live Feed</h4>
            <vs-table max-items="3" pagination :data="users">

                <template slot="thead">
                    <vs-th>Email</vs-th>
                    <vs-th>Name</vs-th>
                    <vs-th>Website</vs-th>
                    <vs-th>Nro</vs-th>

                </template>

                <template slot-scope="{data}">
                    <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                        <vs-td :data="data[indextr].email">
                            {{ data[indextr].email }}
                        </vs-td>
                        <vs-td :data="data[indextr].username">
                            {{ data[indextr].username }}
                        </vs-td>
                        <vs-td :data="data[indextr].username">
                            {{ data[indextr].username }}
                        </vs-td>

                        <vs-td :data="data[indextr].id">
                            {{ data[indextr].website }}
                        </vs-td>

                        <vs-td :data="data[indextr].id">
                            {{ data[indextr].id }}
                        </vs-td>

                    </vs-tr>
                </template>
            </vs-table>
        </div>
    </vx-card>
</template>

<script>
export default {
    name: 'live-feed',
    data: () => ({
        users: [
            {
                "id": 1,
                "src": "http://ddragon.leagueoflegends.com/cdn/10.5.1/img/champion/Aatrox.png"
                "name": "Leanne Graham",
                "username": "Bret",
                "email": "Sincere@april.biz",
                "website": "hildegard.org",
            }
        ]
    }),
}
</script>
