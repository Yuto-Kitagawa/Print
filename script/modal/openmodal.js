'use strict'

function PopupFirstModal() {

    console.log("FirstModal-JS was Loaded");
    var popup = document.getElementsByClassName('js-popup')[0];
    //FirstModal iclude Background and body
    if (!popup) return;

    var blackBg = document.getElementsByClassName('js-black-bg')[0];//background
    var closeBtn = document.getElementsByClassName('js-close-btn')[0];
    var showBtn = document.getElementsByClassName('openModal')[0];


    closePopUp(blackBg);
    closePopUp(closeBtn);
    closePopUp(showBtn);

    function closePopUp(elem) {
        console.log('FirstModal function was loaded');
        if (!elem) return;
        elem.addEventListener('click', function () {
            console.log('function worked');
            popup.classList.toggle('is-show');
        });
    }
}
PopupFirstModal();






// //モーダルの表示
// function popupImage() {
//     //navigationより下の全体を取得
//     // Modal-innerのクラスの取得
//     // モーダルの表示のボタンのくらすの取得
//     var showBtn = document.getElementsByClassName('openmodal')[0]; //もともとshow
//     // モーダル２のクラスの取得
//     var inner2 = document.getElementsByClassName("Modal-inner2")[0];

//     // モーダルの表示のボタンに関する処理
//     closePopUp(showBtn);

//     // モーダルの表示のボタンを押すとモーダルを開く関数
//     function closePopUp(elem) {
//         if (!elem) return;
//         // モーダルの表示のボタンをクリックする処理
//         elem.addEventListener('click', function () {
//             // モーダルを含むbackgroundなどの表示（Container）の表示
//             popup.classList.add('is-show');
//             // モーダル１の表示
//             inner.classList.remove('fade');
//         });
//     }

//     const login = document.getElementsByClassName('firstloginBtn')[0];
//     // 一つ目のモーダルのログインボタンに関する関数
//     closefirst(login);

//     // 一つ目のモーダルのログインのボタンを押したときに処理される関数
//     function closefirst(elem) {
//         elem.addEventListener('click', function () {
//             // 最初のモーダルを非表示にする
//             inner.classList.add('fade');
//             // 二つ目のモーダルを表示させる
//             inner2.classList.remove('fade');
//             // 二つ目のモーダルのログインボタンを表示させる

//         });
//     }

//     //アカウント作成ボタンのID取得
//     var crebtn = document.getElementsByClassName('acntcreBtn')[0];
//     // モーダル２のクラスの取得
//     var inner3 = document.getElementsByClassName("Modal-inner3")[0];


//     opence(crebtn);

//     function opence(elem) {
//         elem.addEventListener('click', function () {

//             inner.classList.add('fade');
//             inner3.classList.remove('fade');


//         })
//     }
// }
// popupImage();