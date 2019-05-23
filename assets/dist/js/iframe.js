

function ajax(m, u, p, c) {
    /*
        m=method
        u=url
        p=params {name:value}
        c=callback
    */
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) c.call(this, xhr.response);
    };

    var params = [];
    for (var n in p) params.push(n + '=' + p[n]);

    switch (m.toLowerCase()) {
        case 'post': p = params.join('&'); break;
        case 'get': u += '?' + params.join('&'); p = null; break;
    }

    xhr.open(m.toUpperCase(), u, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(p);
}


function initialise() {
    var bttn = document.querySelectorAll('input[type="button"]')[0];
    bttn.onclick = function (event) {
        var params = {};
        var fd = new FormData(document.forms['myform']);
        for (var key of fd.keys()) params[key] = fd.get(key);
        ajax.call(this, 'post', document.querySelectorAll('iframe[name="ifr"]')[0].src, params, cbfd);
    };
}

function cbfd(r) {
    var iframe = document.querySelectorAll('iframe[name="ifr"]')[0].contentWindow.document;
    iframe.body.innerHTML = r;
}


document.addEventListener('DOMContentLoaded', initialise, false);

