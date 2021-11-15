let checkbox = document.getElementsByClassName( 'ma-agech__checkbox' );

if ( checkbox[0] ) {
    checkbox[0].addEventListener( 'click', ()=> {
        if( document.querySelector( '.ma-agech__checkbox:checked') !== null ) {
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "visible";
        } else {
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "none";
        }
    });
}

let dateBirth = document.querySelector( '.ma-agech__input' );

if( dateBirth ) {
    dateBirth.addEventListener( 'change', ()=> {

        var dob = new Date(dateBirth.value);  
        var minAge = dateBirth.getAttribute('data-min_age');;
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
        } else {
            document.querySelector( '.ma-agech__btn-wrapper .button-disable' ).style.pointerEvents  = "none";
            document.querySelector( '.ma-agech__age-alert' ).style.visibility  = "visible";
        }
    });
}

function enterInSite() {
    document.querySelector( '.ma-agech' ).style.display  = "none";
}

function notAllowed() {
    document.querySelector( '.ma-agech__age-alert' ).style.visibility  = "visible";
}
