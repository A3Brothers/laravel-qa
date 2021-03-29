require('./bootstrap');

require('alpinejs');

let favorite = document.getElementById('favorite');

let unfavorite = document.getElementById('unfavorite');


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

