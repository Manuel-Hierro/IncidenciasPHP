"use-strict";

function principal() {

    var tab1 = document.getElementById("label-1");

    tab1.addEventListener('click', function () {

        var hr = document.getElementById("hr");
        var foot = document.getElementById("foot");

        hr.classList.remove("hr");
        hr.classList.add("oculto");

        foot.classList.remove("foot-lnk");
        foot.classList.add("oculto");
    });

    var tab2 = document.getElementById("label-2");

    tab2.addEventListener('click', function () {

        var hr = document.getElementById("hr");
        var foot = document.getElementById("foot");

        hr.classList.remove("oculto");
        hr.classList.add("hr");

        foot.classList.remove("oculto");
        foot.classList.add("foot-lnk");

    });

    var tab3 = document.getElementById("label-3");

    tab3.addEventListener('click', function () {

        var hr = document.getElementById("hr");
        var foot = document.getElementById("foot");

        hr.classList.remove("hr");
        hr.classList.add("oculto");

        foot.classList.remove("foot-lnk");
        foot.classList.add("oculto");

    });
}