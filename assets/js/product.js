function plus(e) {

    var value = 1;

    if(typeof e.parentNode.getElementsByTagName('input')[0].value != 'undefined')
        value = e.parentNode.getElementsByTagName('input')[0].value;

    value++;

    e.parentNode.getElementsByTagName('input')[0].value = value;
    e.parentNode.getElementsByClassName('product_number')[0].innerHTML = value;

}

function minus(e) {

    var value = 1;

    if(typeof e.parentNode.getElementsByTagName('input')[0].value != 'undefined')
        value = e.parentNode.getElementsByTagName('input')[0].value;

    value--;

    if(value < 0)
        value = 0;

    e.parentNode.getElementsByTagName('input')[0].value = value;
    e.parentNode.getElementsByClassName('product_number')[0].innerHTML = value;
}