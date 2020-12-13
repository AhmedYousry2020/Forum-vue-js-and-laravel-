<template>
   <ul>
                    <li v-for="discussion in profileDate.data.discussions" :key="discussion.id">

                        <div class="container mx-auto bg-white flex mb-1 p-3" >

          <div class="bg-white flex-grow">
            <h3 class="font-bold text-lg mt-2">
              {{ discussion.title }}
              <span class="px-2 py-1 bg-red-500 text-white font-bold text-xs rounded-full">{{discussion.channel.title}}</span>
            </h3>

            <p class="text-gray-600 text-sm" v-html="$options.filters.shorten(discussion.content)"></p>
          </div>
          <div class="bg-white w-1/12 self-center text-center">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            <span>{{discussion.replies_count}}</span>
          </div>
        </div>

              </li>
            </ul>
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
filters:{
  shorten: function(v){
  return v.substring(0,100) + ' ....'
  }

  },
  methods:{
      getImagePath(){
          return "/images/"+this.profileDate.data.image;
      }
  }
}
</script>
