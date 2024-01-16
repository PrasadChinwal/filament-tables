<script>
export default {
    data: () => ({
        loadingUsers: false,
        dialog: false,
        appName: import.meta.env.VITE_APP_NAME,
        appUrl: import.meta.env.VITE_APP_URL,
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        search: '',
        loadingUpdate: false,
        editedIndex: -1,
        editedItem: {
            first_name: null,
            last_name: null,
            netid: null,
            email: null,
            uin: null,
            roles: []
        },
        defaultItem: {
            first_name: null,
            last_name: null,
            netid: null,
            email: null,
            uin: null,
            roles: []
        },
        headers: [
            { title: 'UIN', key: 'uin'},
            { title: 'First Name', key: 'first_name'},
            { title: 'Last Name', key: 'last_name'},
            { title: 'NetID', key: 'name'},
            { title: 'Email', key: 'email'},
            { title: 'Action', key: 'actions', sortable: false },
        ],
    }),
    props: {
        users: {
            type: Array,
            required: true
        },
        roles: {
            type: Array,
            required: true
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },
    watch: {
        dialog (val) {
            val || this.close()
        },
    },
    created(){
    },
    methods: {
        editItem (item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        close () {
            this.dialog = false;
            this.editedItem = Object.assign({}, this.defaultItem);
            this.editedIndex = -1;
        },
        onSubmit(item) {
            if (this.editedIndex > -1) {
                //Update
                this.loadingUpdate = true;
                axios.post(process.env.MIX_APP_URL + '/api/user/' + item.id,{
                    netid: item.netid,
                    first_name: item.first_name,
                    last_name: item.last_name,
                    uin: item.uin,
                    email: item.email,
                    _method: 'patch'
                }).then((response) => {
                    if (response.status === 200) {
                        Object.assign(this.users[this.editedIndex], response.data);
                        this.snack = true;
                        this.snackColor = 'success';
                        this.snackText = 'Successfully Updated';
                    } else {
                        this.snack = true;
                        this.snackColor = 'error';
                        this.snackText = 'Oops! Something went wrong!';
                    }
                    this.close();
                }).catch(error => {
                    this.snack = true;
                    this.snackColor = 'error';
                    this.snackText = 'Oops! Something went wrong!'
                }).finally(() => {
                    this.loadingUpdate = false;
                });
            } else {
                //Add
                this.loadingUpdate = true;
                axios.post(process.env.MIX_APP_URL + '/api/user',{
                    netid: item.netid,
                    first_name: item.first_name,
                    last_name: item.last_name,
                    uin: item.uin,
                    email: item.email,
                }).then((response) => {
                    if (response.status === 200) {
                        this.users.push(response.data);
                        this.snack = true;
                        this.snackColor = 'success';
                        this.snackText = 'Successfully Updated';
                    } else {
                        this.snack = true;
                        this.snackColor = 'error';
                        this.snackText = 'Oops! Something went wrong!';
                    }
                    this.close();
                }).catch(error => {
                    this.snack = true;
                    this.snackColor = 'error';
                    this.snackText = 'Oops! Something went wrong!'
                }).finally(() => {
                    this.loadingUpdate = false;
                });
            }
        }
    }
}
</script>
<template>
    <div>
        <v-dialog v-model="dialog" max-width="900px">
            <v-card>
                <v-card-title>
                    <span class="font-semibold text-2xl">Add New User</span>
                    <v-spacer></v-spacer>
                    <v-icon color="error" @click="dialog = false">cancel</v-icon>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-3">
                        <v-text-field v-model="editedItem.first_name" variant="outlined" prepend-icon="person" label="User First Name" required></v-text-field>
                        <v-text-field v-model="editedItem.last_name" variant="outlined" prepend-icon="person" label="User Last Name" required></v-text-field>
                        <v-text-field v-model="editedItem.uin" variant="outlined" prepend-icon="mdi-dialpad" label="User UIN" required></v-text-field>
                        <v-text-field v-model="editedItem.netid" variant="outlined" prepend-icon="mdi-details" label="User NetID" required></v-text-field>
                        <v-text-field v-model="editedItem.email" variant="outlined" prepend-icon="mdi-email" label="User Email" required></v-text-field>
                        <v-select v-model="editedItem.roles" :items="roles" item-title="name" item-value="id" multiple label="User Roles" variant="outlined" prepend-icon="mdi-fingerprint"></v-select>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn outlined color="error" @click="close">Cancel</v-btn>
                    <v-btn :loading="loadingUpdate" color="success" @click="onSubmit(editedItem)">Submit</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-card raised class="shadow-lg">
            <v-card-title>
                <span class="text-3xl font-semibold">Users</span>
                <v-spacer></v-spacer>
                <v-btn class="mx-4" @click="dialog = true" color="primary" variant="outlined">Add User</v-btn>
                <v-text-field v-model="search" append-icon="search" label="Search" variant="outlined" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers" :items="users" item-value="name"
                :loading="loadingUsers" :search="search" class="elevation-1" multi-sort
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon @click="editItem(item)" color="primary">mdi-pencil</v-icon>
                    <v-btn :href="`${appUrl}/user/${item.id}/impersonate`" class="ma-2" outlined color="primary">
                        <v-icon left>mdi-check</v-icon>Impersonate
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>
