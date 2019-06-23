video = document.querySelector('#video');

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
    video.srcObject = stream;
	})
	.catch(function (error) {
		console.log("Something went wrong!");
	});
}

function takepicture() {
	canvas = document.querySelector('#canvas');
	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
}