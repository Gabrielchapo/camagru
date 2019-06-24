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

var cnvs = document.getElementById('canvas'),
    ctx = cnvs.getContext('2d'),
    mirror = document.getElementById('mirror');


cnvs.width = mirror.width = window.innerWidth;
cnvs.height = mirror.height = window.innerHeight;

var button = document.getElementById('btn-download');
button.addEventListener('click', function (e) {
    var dataURL = canvas.toDataURL('public');
    button.href = dataURL;
});