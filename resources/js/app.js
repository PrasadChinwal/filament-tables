// import './bootstrap';

import { createApp, defineAsyncComponent } from 'vue'
import "vuetify/styles";
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import 'material-design-icons-iconfont/dist/material-design-icons.css'

const vuetify= createVuetify({
    theme: {
        defaultTheme: 'light'
    },
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
});

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

const app = createApp({});


app.component('user-index', defineAsyncComponent(() => import('./Pages/users/Index.vue')));
app.component('role-index', defineAsyncComponent(() => import('./Pages/roles/Index.vue')));
app.component('feedback-index', defineAsyncComponent(() => import('./Pages/feedback/Index.vue')));

app.use(vuetify).mount("#app");
