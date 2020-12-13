import axios from 'axios'

const state = {

    channels:[],
    discussions:[],
    discussion:null,
    profileDate:[]
}


const getters = {
    channels:state=>state.channels,
    discussions:state=>state.discussions,
    discussion:state=>state.discussion,
    profileDate:state=>state.profileDate
}

const mutations = {
    fetchChannelsSuccess(state,{channels}){
      state.channels = channels;

    },
    fetchDiscussionsSuccess(state,{discussions}){
        state.discussions = discussions;
    },
    fetchSingleDiscussionSuccess(state,{discussion}){
        state.discussion = discussion;
    },
    fetchProfile(state,{profileDate}){
        state.profileDate = profileDate;

    }
}
const actions = {
async fetchChannels({commit}){
try{
   const {data} = await axios.get("api/v1/channels");
   commit("fetchChannelsSuccess",{channels:data})
}catch(error){
console.log(error);

}

},
async fetchDiscussions({commit}){
    try{
       const {data} = await axios.get("api/v1/discussions");
       commit("fetchDiscussionsSuccess",{discussions:data})
    }catch(error){
    console.log(error);

    }

    },
    async fetchProfile({commit},id){
        try{
           const {data} = await axios.get(`/api/v1/profiles/${id}`);
           commit("fetchProfile",{profileDate:data})
        }catch(error){
        console.log(error);

        }

        },
async fetchSingleDiscussion({commit},slug){
        try{
            console.log(slug);
           const {data} = await axios.get(`/api/v1/discussions/${slug}`);

           commit("fetchSingleDiscussionSuccess",{discussion:data})
        }catch(error){
        console.log(error);

        }

},
async StoreDiscussion({commit},data){
    try{
      await axios.post("/api/v1/discussions",data)
      console.log("well done")
    }catch(err){
console.log(err)

    }
},
async StoreReply({commit},data){
    try{
      await axios.post("/api/v1/replies",data)
      console.log("reply saved done")
    }catch(err){
console.log(err)

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
