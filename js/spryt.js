function switchBlock(currectDiv) {

    var display = ['none','none','none'];

    display[currectDiv-1] = 'block';
    for (var i = 0 ; i < display.length; i++){
        document.getElementById('car'+(i+1)).style.display = display[i];
    }
}

