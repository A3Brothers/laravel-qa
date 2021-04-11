<template>
    <div class="text-right mb-4">
        <div class="">
            <span class="block">{{postDate}}</span>
            <a :href="user.url">
                <img class="inline-block" :src="user.avatar" alt="">
            </a>
            <a :href="user.url"> {{user.name}}</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['model', 'label'],
    computed: {
        postDate(){
            return this.label + " " + this.model.created_date;
        }
    },

    data(){
        return {
            user: this.model.user,
        }
    }
    
}
</script>