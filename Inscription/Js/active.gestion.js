
$(document).ready(function() {

    /** Define what step should be 'active' */
    if ($('#step').attr('data-step') === 'step2') {
        $('#2').attr('class', 'active');
    }

    if ($('#step').attr('data-step') === 'step3') {
        $('#3').attr('class', 'active');
    }

    /** CSS gestion for 'active' classes */
    if ($('#1').attr('class') === 'active') {
        setActiveStep1();
    }

    if ($('#2').attr('class') === 'active') {
        setActiveStep1();
        setActiveStep2();
    }

    if ($('#3').attr('class') === 'active') {
        setActiveStep1();
        setActiveStep2();
        setActiveStep3();
    }
});

function setActiveStep1() {
    $("head").append(
        $(document.createElement("link")).attr({
            id: "styleStep1",
            rel: "stylesheet",
            type: "text/css",
            href: "Styles/step1_active.css"
        })
    );
}

function setActiveStep2() {
    $("head").append(
        $(document.createElement("link")).attr({
            id: "styleStep2",
            rel: "stylesheet",
            type: "text/css",
            href: "Styles/step2_active.css"
        })
    );
}

function setActiveStep3() {
    $("head").append(
        $(document.createElement("link")).attr({
            id: "styleStep3",
            rel: "stylesheet",
            type: "text/css",
            href: "Styles/step3_active.css"
        })
    );
}