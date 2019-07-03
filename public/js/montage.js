var streaming = false,
      video        = document.querySelector('#video'),
      filter       = document.querySelector('#filter_image'),
      canvas       = document.querySelector('#snap_canvas'),
      canvas_imported = document.querySelector('#imported'),
      photo        = document.querySelector('#photo'),
      snapButton  = document.querySelector('#snap_button'),
      width = 430,
      height = 320;

if (navigator.mediaDevices.getUserMedia)
{
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}

function checkButton()
{
  console.log('eheheh');
    var mode = document.getElementsByClassName("snap_button")[0].id;
    if (mode == 'snap_button')
    {
        document.getElementsByClassName("snap_button")[0].id = 'save_button';
        document.getElementsByClassName("snap_button")[0].innerHTML = 'Save picture';
        var btn = document.createElement("BUTTON");
        btn.innerHTML = "Retry";
        btn.setAttribute('onclick','retry();');
        btn.setAttribute("class","retry_button");
        document.getElementsByClassName("buttons_list")[0].appendChild(btn);
        takePicture();
    }
    else
    {
        document.getElementsByClassName("snap_button")[0].id = 'snap_button';
        document.getElementsByClassName("snap_button")[0].innerHTML = 'Snap it!';
        savePicture();
    }
}

function takePicture()
{
    // webcam picture
    canvas.width = width;
    canvas.height = height;

    if (video)
    {
      canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    }
    if (canvas_imported)
    {
      canvas.getContext('2d').drawImage(canvas_imported, 0, 0, width, height);
    }


    // + filter superposition for preview
    canvas.getContext('2d').drawImage(filter, 0, 130, 180, 180);
} 

function savePicture()
{
  // ajax post request
  const req = new XMLHttpRequest();
  req.open('POST', '?url=Montage&submit=download', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
      if (this.readyState === XMLHttpRequest.DONE) {
          if (this.status === 200) {
              console.log("Response: %s", this.responseText);
          } else {
              console.log("Response status : %d (%s)", this.status, this.statusText);
          }
      }
  };
  var canvasData = canvas.toDataURL('image/png');
  req.send('img=' + canvasData );
  retry();
}

function retry()
{
  // ajax post request
  const req = new XMLHttpRequest();
  req.open('POST', '?url=Montage', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
          window.location.reload();
          console.log("Response: %s", this.responseText);
        } else {
          console.log("Response status : %d (%s)", this.status, this.statusText);
        }
    }
  };
  req.send();
}


function isCanvasBlank(canvas)
{
    const context = canvas.getContext('2d');
    const pixelBuffer = new Uint32Array(
      context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
    );
    return !pixelBuffer.some(color => color !== 0);
}

function selectFilter(filter_name)
{
    var filter_name_short = filter_name.substring(0, filter_name.indexOf('.'));

    var video = document.getElementsByClassName('camera_view')[0];
    var imported = document.getElementsByClassName('imported')[0];
    const blank = isCanvasBlank(imported);

    document.getElementsByClassName("filter_img")[0].src = "/public/filters/" + filter_name;
    document.getElementsByClassName("filter_img")[0].id = filter_name_short;

    if (!blank || video.readyState === 4)
    {
        snapButton.disabled = false;
    }
}

function deleteImg(id_image)
{
  const req = new XMLHttpRequest();
  req.open('POST', '?url=Montage&submit=delete', true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function()
  {
      if (this.readyState === XMLHttpRequest.DONE) {
          if (this.status === 200) {
              console.log("Response: %s", this.responseText);
          } else {
              console.log("Response status : %d (%s)", this.status, this.statusText);
          }
      }
  };
  var canvasData = canvas.toDataURL('image/png');
  req.send('id_image=' + id_image);
  retry();
}

//import a file

document.getElementById('import_button').onclick = function() {
  document.getElementById('imgLoader').click();
};

var fileinput = document.getElementById('imgLoader').addEventListener('change', importPicture, false);

function importPicture()
{
  var canvas = document.querySelector('#imported');
  var context = canvas.getContext("2d");
  var img = new Image();
  var file = this.files[0];
  var reader = new FileReader();
  if (file)
  {
      reader.readAsDataURL(file);
      reader.onload = function(evt)
  {
      if (evt.target.readyState == FileReader.DONE)
      {
          img.onload = function()
          {
              canvas.width = img.width;
              canvas.height = img.height;
              context.drawImage(img, 0, 0);
          }
          img.src = evt.target.result;
      }
  }
  }
}