<template>
<form class="m-auto w-1/2">
<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
<label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">Name</label>
<div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg flex rounded-md shadow-sm">
        <input class="flex-1 no-left-round form-input block w-full rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="name" v-model="profileDate.data.user.name">
    </div>
</div>
</div>
<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
<label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">Email</label>
<div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg flex rounded-md shadow-sm">
        <input class="flex-1 no-left-round form-input block w-full rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="name" v-model="profileDate.data.user.email">
    </div>
</div>
</div>
<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
    <label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">About</label>
<div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg flex rounded-md shadow-sm">
        <textarea class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" rows="3" name="about"></textarea>
    </div>
</div>
</div>
<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
        <label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">Image</label>
        <div class="mt-2 sm:mt-0 sm:col-span-2">
            <div class="flex items-center">
                <img class="w-12 h-12 rounded-full" :src="getImagePath()">
                <span class="ml-5 rounded-md shadow-sm">
                    <button  type="button" class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out relative">change
                    <input class="opacity-0 absolute w-full h-full inset-0" type="file"></button>
                </span>
            </div>
        </div>

</div>
<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
<label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">Facebook</label>
<div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg flex rounded-md shadow-sm">
        <input class="flex-1 no-left-round form-input block w-full rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="facebook">
    </div>
</div>
</div>
<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
<label class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">Twitter</label>
<div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg flex rounded-md shadow-sm">
        <input class="flex-1 no-left-round form-input block w-full rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="twitter" >
    </div>
</div>
</div>
<div class="mt-6 border-t border-gray-200 pt-5">
    <div class="flex justify-end">
    <span class="ml-3 inline-flex rounded-md shadow-sm">
        <button class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">Save</button>
    </span>
    </div>
</div>


</form>

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
