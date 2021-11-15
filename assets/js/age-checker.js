
let checkbox = document.getElementsByClassName( 'ma-agech__checkbox' );
let cookieTime = document.querySelector( '.ma-agech' ).getAttribute('data-cookie_time');
let id = document.querySelector( '.ma-agech' ).getAttribute('data-id');

if ( checkbox[0] ) {

    checkbox[0].addEventListener( 'click', ()=> {

        if( document.querySelector( '.ma-agech__checkbox:checked') !== null ) {

            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "visible";
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.opacity  = 1;

        } else {

            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "none";
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.opacity  = 0.7;

        }
    });
}

let dateBirth = document.querySelector( '.ma-agech__input' );

if( dateBirth ) {

    dateBirth.addEventListener( 'change', ()=> {

        var dob = new Date(dateBirth.value);  
        var minAge = dateBirth.getAttribute('data-min_age');
        //calculate month difference from current date in time  
        var month_diff = Date.now() - dob.getTime();  
        
        //convert the calculated difference in date format  
        var age_dt = new Date(month_diff);   
        
        //extract year from date      
        var year = age_dt.getUTCFullYear();  
        
        //now calculate the age of the user  
        var age = Math.abs(year - 1970);  
        
        if( age >= minAge ) {
            
            document.querySelector( '.ma-agech__age-alert' ).style.visibility  = "hidden";
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "visible";
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.opacity  = 1;

        } else {

            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "none";
            document.querySelector( '.ma-agech__age-alert' ).style.visibility  = "visible";
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.opacity  = 0.7;

        }

    });
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function enterInSite() {
    document.querySelector( '.ma-agech' ).style.display  = "none";
    
    if ( cookieTime ) {
        setCookie( cookieTime );
    }
}

function notAllowed() {
    document.querySelector( '.ma-agech__age-alert' ).style.visibility  = "visible";
}

function setCookie(time) {
    var date = new Date();
    date.setTime(date.getTime() + (time*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
    document.cookie = 'applicable-for-site'+id + "=" + ('yes' || "")  + expires + "; path=/";
}
