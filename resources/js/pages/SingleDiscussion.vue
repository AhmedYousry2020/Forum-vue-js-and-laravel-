<template>
    <div v-if="discussion">
        <div class="head">
            <h1 class="inline-block text-4xl">{{ discussion.data.title }}</h1>
            <span class="float-right mt-2"
                >Posted In
                <span
                    class="rounded-full bg-red-500 text-white font-bold text-sm py-1 px-2"
                >
                    {{ discussion.data.channel.title }}
                </span>
            </span>
        </div>
        <div class="body mt-4">
            <div class="container mx-auto bg-white flex mb-1 p-3">
                <div class="bg-white w-1/12 self-center">
                    <img
                        src="https://randomuser.me/api/portraits/men/17.jpg"
                        alt="avatar"
                        class="rounded-full h-16"
                    />
                </div>
                <span class="bg-white flex-grow">
                    <h3 class="font-bold text-lg mt-2">
                        {{ discussion.data.user.name }}
                        <span class="text-sm text-gray-500">{{
                            discussion.data.published_at
                        }}</span>
                    </h3>

                    <p
                        class="text-gray-600 text-sm mt-6"
                        v-html="discussion.data.content"
                    ></p>
                </span>
            </div>
            <div>
                <div class="container mx-auto bg-white flex mb-1 p-3" v-for="reply in discussion.data.replies" :key="reply.id">
                    <div class="bg-white w-1/12 self-center">
                        <img
                            src="https://randomuser.me/api/portraits/men/17.jpg"
                            alt="avatar"
                            class="rounded-full h-16"
                        />
                    </div>
                      <span class="bg-white flex-grow">
                    <h3 class="font-bold text-lg mt-2">
                        {{ reply.user }}
                        <span class="text-sm text-gray-500">{{reply.published_at}}</span>
                    </h3>

                    <p
                        class="text-gray-600 text-sm mt-6"
                        v-html="reply.content"
                    ></p>
                </span>
                </div>
                <yimo-vue-editor v-model="reply"></yimo-vue-editor>
                <button
                    class="bg-btnBlueColor text-white py-2 px-4 rounded-full uppercase text-sm mt-1"
                    @click="storeReply"
                >
                    Reply
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import YimoVueEditor from "yimo-vue-editor";
export default {
    data() {
        return {
            reply: ""
        };
    },
    mounted() {
        this.$store.dispatch(
            "forum/fetchSingleDiscussion",
            this.$route.params.discussion
        );
          this.$store.dispatch("auth/fetchUser");

    },
    computed: {
        ...mapGetters({
                  user: "auth/user",

            discussion: "forum/discussion"
        })
    },
    components: {
        YimoVueEditor
    },
    methods: {
        storeReply() {
            this.$store.dispatch("forum/StoreReply", {
                content: this.reply,
                user_id: this.user.id,
                discussion_id: this.discussion.data.id
            });
            this.$store.dispatch(
            "forum/fetchSingleDiscussion",
            this.$route.params.discussion
        );
        }
    }
};
</script>
