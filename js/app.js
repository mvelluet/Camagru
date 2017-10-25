var data_img;

var canvas = document.getElementById('canvas');
var video = document.getElementById('video_webcam');

function ft_getvideo()
{

	var video = document.getElementById("video_webcam");

	navigator.getMedia = ( navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);

	if (navigator.getUserMedia) {       
		navigator.getUserMedia({video: true, audio: false}, handleVideo, videoError);
	}


	function handleVideo(stream) {
		video.src = window.URL.createObjectURL(stream);
	}

	function videoError() {
	}

}


function photo()
{
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	canvas.getContext('2d').drawImage(video, 0, 0);
	var data_img = canvas.toDataURL("image/png");
	var shoot = document.getElementById('capture_photo');
	shoot.setAttribute('value', data_img);
	video.setAttribute("hidden", true);
	canvas.removeAttribute("hidden");
}

function get_video()
{
	canvas.setAttribute("hidden", true);
	video.removeAttribute("hidden");
}

function ft_filtre(elem)
{
	var id = elem.id;
	var img = document.getElementById('montage_cam');
	source = 'img/montage_'+id+'.png';
	img.setAttribute('src', source )
	var sauvegarder = document.getElementById('sauvegarder');
	var annuler = document.getElementById('annuler');
	var prendre_photo = document.getElementById('prendre_photo');
	var name_filtre = document.getElementById('name_filtre');
	sauvegarder.removeAttribute('disabled');
	annuler.removeAttribute('disabled');
	prendre_photo.removeAttribute('disabled');
	name_filtre.setAttribute('value', source);
}