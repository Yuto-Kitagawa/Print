
'use strict'

function secondpopup() {

    // Containerのクラス取得
    var popup = document.getElementsByClassName('Container')[0];
    //最初のモーダルのクラスを取得
    const inner = document.getElementsByClassName('Modal-inner')[0];
    // 二つ目のモーダルのクラスを取得
    const inner2 = document.getElementsByClassName('Modal-inner2')[0];
    // Backgroundのクラスの取得
    var blackBg = document.getElementsByClassName('background')[0];
    // 閉じるボタンのクラスの取得
    var closeBtn = document.getElementsByClassName('close')[0];

    const inner3 = document.getElementsByClassName('Modal-inner3')[0];

    // var exit = hasClass(elem, 'passwd-second');

    // backgroundと閉じるボタンを押したときの処理
    closeall(blackBg);
    closeall(closeBtn);

    // モーダルを閉じる関数
    function closeall(elem) {
        if (!elem) return;
        elem.addEventListener('click', function () {
            popup.classList.remove('is-show');
            inner.classList.add('fade');
            inner2.classList.add('fade');
            inner3.classList.add('fade');
        });
    }





    // 戻るボタンのクラスの取得
    const backBtn = document.getElementsByClassName('back')[0];

    // input-emailのidの取得
    var inputEmail = document.getElementById('input');

    // input-passwdのidの取得
    var inputPasswd = document.getElementById('passwd');

    // 二つ目のログインボタンの取得
    const secondloginBtn = document.getElementsByClassName('pre-login')[0];

    const back2 = document.getElementsByClassName('back2')[0];

    back2on(back2);

    function back2on(elem) {
        if (!elem) return;

        elem.addEventListener('click', function () {
            inner.classList.remove('fade');
            inner3.classList.add('fade');
            
        })
    }

    // 戻るボタンを押されたときの処理
    back(backBtn);
    // 戻るボタンを押されたときの処理
    function back(elem) {
        if (!elem) return;
        elem.addEventListener('click', function () {
            // inputにtoheightクラスがあるか判定
            if (inputEmail.classList.contains('toheight')) {
                inputEmail.classList.remove('toheight');
                inputPasswd.classList.replace('passwd-second', 'passwd');
                next.classList.remove('fade');
                input.disabled = false;
                secondloginBtn.classList.add('fade');

            } else {
                inner.classList.remove('fade');
                inner2.classList.add('fade');
            }

        })
    }

}
secondpopup();