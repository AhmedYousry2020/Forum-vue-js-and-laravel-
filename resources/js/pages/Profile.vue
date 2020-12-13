<template>

 <div class="flex container mx-auto pt-4 overflow-hidden sm:overflow-auto">
  <div class="min-w-52 w-1/6 hidden md:block">
    <div class="flex flex-col bg-white  rounded-lg overflow-hidden border border-gray-100 shadow-sm mb-4 text-left">
    <a class="hover:bg-gray-50 border-b border-gray-200 transition-color duration-200 px-4 py-3 flex items-center" href="#">
      <img :src="getImagePath()" alt="avatar" class="w-10 h-10 rounded-full">
                  <div class="pl-2">
                    <p class="font-bold text-sm text-gray-800 leading-none mb-1">{{profileDate.data.user.name}}</p>
                    <p></p>
                  </div>
                  </a>
         <div class="flex flex-col py-2">
           <a href="#" class="relative pl-3 h-8 mb-1 flex items-center transition-all duration-200 opacity-75 hover:opacity-100">
               <i class="fa fa-ravelry" aria-hidden="true"></i>

My Posts</a>
           </div>
    </div>
    <div class="bg-white px-5 py-4 border-gray-100 rounded-lg border shadow-sm text-left">
      <h3 class="text-sm leading-6 font-medium text-gray-900">Popular Topics:</h3>
      <p class="mt-2 pl-2 text-sm leading-5 font-medium text-gray-500 flex flex-col">
        <a class="mb-1 leading-loose" href="#" v-for="channel in profileDate.data.discussions" :key="channel.id">
<span class="text-yellow-500">#</span>
  {{channel.channel.title}}
        </a>
      </p>
    </div>
    </div>
 <div class="mx-auto container w-full px-4 overflow-x-hidden xl:overflow-auto">

<div class="bg-white shadow-sm border border-gray-100 rounded-lg overflow-hidden mb-4">
          <div class="relative bg-cover bg-center h-16 bg-gray-300">
              <router-link :to="{name: 'EditProfile', params: {id: user.id}}"> <a class="text-xs p-1 px-2 bg-black opacity-50 text-white rounded text absolute right-0 top-0 mt-2 mr-2">Edit Your Profile</a></router-link>
          </div>
          <div class="relative p-3 pb-2 flex justify-between border-b border-gray-100">
               <div class="user-image-info -mt-12 flex items-end">
                   <div class="h-20 w-20 lg:h-24 lg:w-24 relative">
                       <img class="rounded-full h-20 w-20 lg:h-24 lg:w-24 border-4 border-white bg-gray-100" :src="getImagePath()" alt="avatar">
                   </div>
                   <div class="flex flex-col pl-2 pb-2">
                       <h1 class="text-gray-800 font-bold text-sm lg:text-lg leading-tight">{{profileDate.data.user.name}}</h1>
                       <p class="font-bold text-xs lg:text-base text-gray-700 leading-tight">{{profileDate.data.user.email}}</p>
                   </div>
               </div>
               <div class="btns flex items-center">
                  <div class="ml-2">
                      <div class="flex items-center px-3 py-1 border border-gray-300 leading-6 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 cursor-pointer follow-button shadow-sm justify-center text-sm">
                          <span class="hidden sm:inline">Follow</span>
                      </div>
                  </div>
               </div>
          </div>
          <div class="p-6 pr-5 flex">
           <div class="relative flex flex-col justify-start w-full">
               <div class="relative flex justify-between items-center w-full mb-5">
                   <div class="flex relative"><p class="text-sm font-bold font-medium mr-3">0<span class="text-gray-600 font-normal">Followers</span></p></div>
                   <div class="flex relative"><p class="text-xs text-gray-700 font-medium flex"> Joined August 2nd, 2020</p></div>
               </div>
           </div>

          </div>

            <hr style="border-top-width: 10px;border-block-color: cadetblue;">
           <div class="relative flex mt-2">
            <router-view></router-view>
           </div>


    </div>
 </div>
</div>

</template>
<script>
import {mapGetters} from 'vuex'
export default {
computed: {
    ...mapGetters({
      user: "auth/user",
      profileDate: "forum/profileDate"
    })
},

mounted(){
  this.$store.dispatch("forum/fetchProfile",
      this.user.id
  );
},

  methods:{
      getImagePath(){
          return "/images/"+this.profileDate.data.image;
      }
  }
}
</script>
