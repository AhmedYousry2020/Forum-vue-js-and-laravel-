import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutations_types'

const state = {
      user:null,
      token:Cookies.get("token"),
      auth_err:null,
      loading:false,
      isLogged:false

}

const getters = {
user: state=>state.user,
token(state){
return state.token;
},
check:state=>state.isLogged ,
authError:state=>state.auth_err,
isLoading:state=>state.loading

}

const mutations = {

[types.LOGIN]:(state)=>{
state.loading  = true,
state.auth_err = null,
state.isLogged= false
},
[types.LOGIN_SUCCESS]: (state,{token,remember})=>{
    state.loading  = false,
    state.auth_err = null,
    state.isLogged=true,
    state.token = token,
    Cookies.set("token",token,{expires: remember ? 365 : null});

},
[types.LOGIN_FAILED]: (state,{error})=>{
    state.loading  = false,
    state.auth_err = error,
    state.isLogged= false

},
// [types.SAVE_TOKEN]: (state,{token,remember})=>{
// state.token = token;
// Cookies.set("token",token,{expires: remember ? 365 : null});

// },
[types.FETCH_USER_SUCCESS]:(state,{user})=>{
state.user = user.data,
state.isLogged= true

},

[types.FETCH_USER_FAILURE]:(state)=>{
    state.token = null,
    Cookies.remove("token"),
    state.isLogged= false

},

[types.LOGOUT]:(state)=>{
    state.user=null,
    state.token = null,
    Cookies.remove("token"),
    state.isLogged= false

}

}

const actions = {
    login({commit}){
         commit(types.LOGIN);

// saveToken({commit},payload){
// commit(types.SAVE_TOKEN,payload);

 },
 async fetchUser({commit}){
 try{
     const {data} = await axios.get('/api/v1/auth/user')
     commit(types.FETCH_USER_SUCCESS,{user:data})
 }
 catch(error)
 {
    commit(types.FETCH_USER_FAILURE)
 }
}

}

export default{
    namespaced:true,
    state,
    getters,
    mutations,
    actions

}
