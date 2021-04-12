<template>
  <slot :edit="edit" :cancel="cancel" :editing="editing" :update="update" :bodyHtml="bodyHtml" :body="body" :onInput="onInput" :isInvalid="isInvalid"/>
</template>

<script>
export default {
    props: ['answer'],
    data() {
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionid: this.answer.question_id,
            beforeEditCache: null,
        }
    },
    methods: {
        edit(){
            this.beforeEditCache = this.body;
            this.editing = true
        },
        cancel(){
            this.body = this.beforeEditCache;
            this.editing = false
        },
        update(){

            axios.patch(`/questions/${this.questionid}/answers/${this.id}`, {
                body: this.body, 
            })
            .then(res=>{
                console.log(res);
                this.editing = false;
                this.bodyHtml = res.data.body_html;
                alert(res.data.message);
            }).catch(err=>{
                console.log("something went wrong");
            })
        },
        onInput(event, prop){
            this[prop] = event.target.value;
        },
        // isInvalid () {
        //     return this.body.length < 10;
        // }

    },

    computed: {
        isInvalid () {
            return this.body.length < 10;
        }
    }
}
</script>