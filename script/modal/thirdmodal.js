'use strict'

function PopupThirdModal() {
    // function about opening SecondModal
    console.log("SecondModal-JS was Loaded");

    var secondopen = document.getElementsByClassName('openThiedModal')[0];
    var secondmodal = document.getElementsByClassName('js-thirdPopup')[0];
    var popup = document.getElementsByClassName('js-popup')[0];

    var blackBg = document.getElementsByClassName('js-black-bg')[2];//background
    var closeBtn = document.getElementsByClassName('js-close-btn')[2];

    Popupthird(secondopen);

    Popupthird(blackBg);
    Popupthird(closeBtn);

    function Popupthird(elem) {

        console.log('ThirdModal function was loaded')
        if (!elem) return;
        elem.addEventListener('click', function () {
            //クリックしたら走る
            console.log('function worked(thirdModal)');
            popup.classList.remove('is-show');
            secondmodal.classList.toggle('is-show');
        });
    }

}

PopupThirdModal();
