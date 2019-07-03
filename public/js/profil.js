function checkPreferenceButton()
{
    var mode = document.getElementsByClassName("preference_button")[0].innerHTML;

    //To desactivate
    if (mode === 'Desactivate notifications') {
        sendRequest('desactivate');
        document.getElementsByClassName("preference_button")[0].innerHTML = 'Activate notifications';
    }
    //To activate
    else {
        sendRequest('activate');
        document.getElementsByClassName("preference_button")[0].innerHTML = 'Desactivate notifications';
    }
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