import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state:{
        authenticated:false,
        user:{},
        tocken: ''
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        },
        tocken(state){
            return state.tocken
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_USER (state, value) {
            state.user = value
        },
        SET_TOCKEN (state, value) {
            state.tocken = value
        }
    },
    actions:{
        login({commit}){
            return axios.get('/api/user').then(({data})=>{
                if(data.success){
                    commit('SET_TOCKEN', localStorage.getItem('tocken'))
                    commit('SET_USER',data.data)
                    commit('SET_AUTHENTICATED',true)
                }
                router.push({name:'dashboard'})
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        logout({commit}){
            localStorage.removeItem('tocken');
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
            commit('SET_TOCKEN', '')
        }
    }
}