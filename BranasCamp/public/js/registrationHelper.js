// Move one page forward as long as current page is not "last"
$('#formNextPage').click(function(){
    if($(".formPage.current").attr("form-index") == "last")
        return;

    var foundFaults = false;
    var allInputsForCurrentPage = $('.formPage.current input');
        allInputsForCurrentPage.each(function() {
            if($(this).val().length <= 0 && $(this).attr("reqiered")){
                console.log("found an invalid input")
                $(this).css("border-color", "red");
                foundFaults = true;
            }
        }
    ); 
        
    if(foundFaults)
        return;

    $(".progressbar > .active").last().next().toggleClass('active'); // sets next progressbar point to not active

    // Toggle current class to the next page
    var nextPage = $('.formPage.current').next();
    $('.formPage.current').toggleClass('current'); // Do not change order of this line and line under. Will breake
    nextPage.toggleClass('current');

    // When on last page, set next btn to submit
    if($(".formPage.current").attr("form-index") == "last"){
        $('#formNextPage').text("Skicka in");
        $('#formNextPage').attr('type', 'submit');
    }
    // Displays the previus page btn if not on the first page
    else if($(".formPage.current").attr("form-index") > "0"){
        $('#formPrevPage').css('display', "inherit");
    }    
    
    event.preventDefault()
});



// Move one page forward as long as current page is not "0"
$('#formPrevPage').click(function(){
    if($(".formPage.current").attr("form-index") == "0")
        return;

    $(".progressbar > .active").last().toggleClass('active'); // sets last progressbar point to active

    // Toggle current class to the last page
    var prevPage = $('.formPage.current').prev();
    $('.formPage.current').toggleClass('current'); // Do not change order of this line and line under. Will breake
    prevPage.toggleClass('current');

    // When not on last page, set next btn to next
    if($(".formPage.current").attr("form-index") != "last"){
        $('#formNextPage').text("Nästa");
        $('#formNextPage').attr('type', 'next');
    }
    // Hides the previus page btn if on the first page
    else if($(".formPage.current").attr("form-index") == "0"){
        $('#formPrevPage').css("display","none");
    }

    event.preventDefault()
});



// Detects a key change on input element with an id and calls CheckInputsEqual function
$('#email').keyup(CheckInputsEqual); // Change to first email id
$('#emailConfirm').keyup(CheckInputsEqual); // change to second email id

// Checks if two input elements have the same value. If not, a btn will be disabled
function CheckInputsEqual(){
    var email = $('#email').val(); // Change to first email id
    var repeatEmail = $('#emailConfirm').val(); // change to second email id

    if(email == repeatEmail){
        $('#formNextPage').removeAttr('disabled');
        console.log("Enabling btn");
    }
    else{
        $('#formNextPage').attr('disabled', true);
        console.log("Disabling btn");
    }
}

// Detects a key change on input element with an id and calls CheckInputsEqual function
$('#emailAdvocate').keyup(CheckInputsEqualAdvocate); // Change to first email id
$('#emailAdvocateConfirm').keyup(CheckInputsEqualAdvocate); // change to second email id

// Checks if two input elements have the same value. If not, a btn will be disabled
function CheckInputsEqualAdvocate(){
    var email = $('#emailAdvocate').val(); // Change to first email id
    var repeatEmail = $('#emailAdvocateConfirm').val(); // change to second email id

    if(email == repeatEmail){
        $('#formNextPage').removeAttr('disabled');
        console.log("Enabling btn");
    }
    else{
        $('#formNextPage').attr('disabled', true);
        console.log("Disabling btn");
    }
}

// Set border color to white on key up on any input in current form page
$('.formPage.current input').keyup(function(){
    $(this).css("border-color", "#fff");
});

// Check validity of personnummer.
$('#socialSecurityNumber').keyup(function(){
    var valid = isValidSwedishSSN($('#socialSecurityNumber').val());
    if(valid){
        $('#socialSecurityNumber').css('border', 'inherit');
    }
    else {
        $('#socialSecurityNumber').css('border', '2px solid red');
    }
})

// Personnummer checksum
function isValidSwedishSSN(ssn) {
    ssn = ssn
        .replace(/\D/g, "")     // strip out all but digits
        .split("")              // convert string to array
        .reverse()              // reverse order for Luhn
        .slice(0, 10);          // keep only 10 digits (i.e. 1977 becomes 77)

    // verify we got 10 digits, otherwise it is invalid
    if (ssn.length != 10) {
        return false;
    }

    var sum = ssn
        // convert to number
        .map(function(n) {
            return Number(n);
        })
        // perform arithmetic and return sum
        .reduce(function(previous, current, index) {
            // multiply every other number with two
            if (index % 2) current *= 2;
            // if larger than 10 get sum of individual digits (also n-9)
            if (current > 9) current -= 9;
            // sum it up
            return previous + current;
        });

    // sum must be divisible by 10
    return 0 === sum % 10;
};