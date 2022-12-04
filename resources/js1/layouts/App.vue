<template>
    <div v-if="$store.getters.getToken == 0">
        <login />
    </div>
    <div v-else>
        <b-navbar toggleable="lg" type="dark" variant="faded">
            <b-navbar-brand href="#">
                <b-img src="images/energy-logo.png" v-bind="mainProps" rounded="0" width="100"></b-img>
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse is-nav style="border: 1px solid">

                <!-- Right aligned nav items -->
                <b-navbar-nav class="float-right">

                    <b-nav-item-dropdown right>
                    <!-- Using 'button-content' slot -->
                    <template #button-content>
                        <em>User</em>
                    </template>
                    <b-dropdown-item href="#">Profile</b-dropdown-item>
                    <b-dropdown-item href="#">Sign Out</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <router-view></router-view>
    </div>
    <!--
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        
        <router-link class="navbar-brand" :to="{name :'Home' }">Home </router-link>
        <ul class="navbar-nav">
            <li class="nav-item">
                <router-link class="text-white" :to="{name : 'Login' }" v-if="$store.getters.getToken == 0">Login</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'Register' }" v-if="$store.getters.getToken == 0"> Register</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ml-2" :to="{name : 'Dashboard' }" v-if="$store.getters.getToken != 0"> Dashboard</router-link>
            </li>

        </ul>
    </nav>
    {{$store.getters.getToken}}
    -->
</template>

<script>
import Login from '@/components/Login.vue';
import {onMounted} from 'vue';
import { useRouter } from "vue-router";
import { useStore } from 'vuex';
import api from "../services/api";

export default {
    components: {
        Login
    },
    setup(){
        const router = useRouter()
        const store = useStore()
        const user = async() =>{
            await api.get('/api/user').then(res=>{
                if(res.data.success){
                }else{
                    store.dispatch('removeToken');
                }
            }).catch(e=>{
                store.dispatch('removeToken');
            })
        }
        onMounted(()=>{
            user()
        })
    }
/*
    mounted() {
        this.user()
    }
    */
}
</script>