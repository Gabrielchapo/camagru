function activate()
{
    sendRequest('activate');
}

function desactivate()
{
    sendRequest('desactivate');
}

function sendRequest(param)
{
    // ajax post request
    const req = new XMLHttpRequest();
    req.open('POST', '?url=Profil&submit=' + param, true);
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
    req.send();
}