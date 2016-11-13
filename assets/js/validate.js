function addClass(e, c) {
    if( !(new RegExp('.*'+c+'.*').test(e.className)) )
        e.className += c;
}

function removeClass(e, c) {
    e.className = e.className.replace(new RegExp('(.*)'+ c + '(.*)'), '$1 $2');
}

function validateString(e) {
    if(/.*\w+.*/i.test(e.value)) {
        removeClass(e, 'errorInput');
        addClass(e, 'validInput');
    }
    else {
        removeClass(e, 'validInput');
        addClass(e, 'errorInput');
    }
}

function validateEmail(e) {
    if(/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/i.test(e.value)) {
        removeClass(e, 'errorInput');
        addClass(e, 'validInput');
    }
    else {
        removeClass(e, 'validInput');
        addClass(e, 'errorInput');
    }
}

function validatePassword() {
    if(document.getElementById('password').value.length != 0 && document.getElementById('password-confirmation').value.length != 0) {
        if (document.getElementById('password').value != document.getElementById('password-confirmation').value) {
            removeClass(document.getElementById('password'), 'validInput');
            removeClass(document.getElementById('password-confirmation'), 'validInput');
            addClass(document.getElementById('password'), 'errorInput');
            addClass(document.getElementById('password-confirmation'), 'errorInput');
        } else {
            removeClass(document.getElementById('password'), 'errorInput');
            removeClass(document.getElementById('password-confirmation'), 'errorInput');
            addClass(document.getElementById('password'), 'validInput');
            addClass(document.getElementById('password-confirmation'), 'validInput');
        }
    }
}