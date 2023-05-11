
function likeArticle(articleId) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById('likes-for-article-' + articleId).innerHTML = this.responseText;
    }
    xhttp.open("GET", "functions/like_form.php?id="+articleId);
    xhttp.send();
    
}
