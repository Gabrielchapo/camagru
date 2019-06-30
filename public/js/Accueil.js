function like(picture_id, user_id)
{
	if (user_id) {
		var likesElement = document.getElementById('nb_likes' + picture_id);
		var likes = parseInt(document.getElementById('nb_likes' + picture_id).innerHTML);
		var like_logo = document.getElementById("like_logo" + picture_id);

		const req = new XMLHttpRequest();
		req.open('POST', '?url=Accueil', true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		req.onreadystatechange = function() {
			// XMLHttpRequest.DONE === 4
			if (this.readyState === XMLHttpRequest.DONE) {
				if (this.status === 200) {
					console.log("Response: %s", this.responseText);
				} else {
					console.log("Response status : %d (%s)", this.status, this.statusText);
				}
			}
		};
		
		//case : to like
		if (like_logo.src.indexOf("/like") == -1)
		{
			like_logo.src = '/public/like.png';

			likes += 1;
			likesElement.innerHTML = likes; 
			req.send('submit=like' + '&id_image=' + picture_id + '&id_author=' + user_id);
		}
		//case : to unlike
		else
		{
			like_logo.src = '/public/dislike.png';

			likes -= 1;
			likesElement.innerHTML = likes; 
			req.send('submit=unlike' + '&id_image=' + picture_id + '&id_author=' + user_id);
		}
	}
}
