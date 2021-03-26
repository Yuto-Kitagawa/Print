'use strict'

function PopupSecondeModal() {
    // function about opening SecondModal
    console.log("SecondModal-JS was Loaded");

    var secondopen = document.getElementsByClassName('openSecondModal')[0];
    var secondmodal = document.getElementsByClassName('js-secondPopup')[0];
    var popup = document.getElementsByClassName('js-popup')[0];

    var blackBg = document.getElementsByClassName('js-black-bg')[1];//background
    var closeBtn = document.getElementsByClassName('js-close-btn')[1];

    Popupsecond(secondopen);

    Popupsecond(blackBg);
    Popupsecond(closeBtn);

    function Popupsecond(elem) {

        console.log('SecondModal function was loaded')
        if (!elem) return;
        elem.addEventListener('click', function () {
            //クリックしたら走る
            console.log('function worked(secondmodal)');
            popup.classList.remove('is-show');
            secondmodal.classList.toggle('is-show');
        });
    }

}

PopupSecondeModal();
