require('./bootstrap');

require('alpinejs');

import {createApp} from 'vue';

import userInfo from './components/userInfo.vue';
import answer from './components/Answer.vue';

const app = createApp({
    components: {
        userInfo,
        answer,
    }
});

app.mount('#app');

let favorite = document.getElementById('favorite');

let unfavorite = document.getElementById('unfavorite');

let upVote = document.getElementById('upVote');

let downVote = document.getElementById('downVote');

let upVoteA = document.getElementsByClassName('upVoteA');

let downVoteA = document.getElementsByClassName('downVoteA');


if(favorite){
    favorite.addEventListener('click', function(){
        document.getElementById('postQuestionFavorite').submit();
    });
}

if(unfavorite){
    unfavorite.addEventListener('click', function() {
        document.getElementById('deleteQuestionFavorite').submit();
        
    });
}

upVote.addEventListener('click', function(){
    document.getElementById('questionUpVote').submit();
})

downVote.addEventListener('click', function(){
    document.getElementById('questionDownVote').submit();
})

for(let i = 0; i < upVoteA.length; i++){
    upVoteA[i].addEventListener('click', function(){
        document.getElementsByClassName('answerUpVote')[i].submit();
    })
}

for(let i = 0; i < downVoteA.length; i++){
    downVoteA[i].addEventListener('click', function(){
        document.getElementsByClassName('answerDownVote')[i].submit();
    })
}




