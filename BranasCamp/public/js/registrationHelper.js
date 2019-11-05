var emailValid = false;
var emailGuardianValid = false;
var ssnValid = false;
var ssnGuardianValid = false;

// Detects a key change on input element with an id and calls CheckInputsEqual function
$('#email').keyup(CheckInputsEqual); // Change to first email id
$('#emailConfirm').keyup(CheckInputsEqual); // change to second email id

// Checks if two input elements have the same value. If not, a btn will be disabled
function CheckInputsEqual(){
    var email = $('#email').val(); // Change to first email id
    var repeatEmail = $('#emailConfirm').val(); // change to second email id
    
    var emailGuardian = $('#emailAdvocate').val();
    var repeatEmailGuardian = $('#emailAdvocateConfirm').val();

    if(email == repeatEmail && emailGuardian == repeatEmailGuardian){
        $('#emailConfirm').css('border', '1px solid #ced4da');
        emailValid = true;
        EnableSubmit();
    }
    else{
        $('#emailConfirm').css('border', '2px solid red');
        emailValid = false;
        EnableSubmit();
    }
}

// Detects a key change on input element with an id and calls CheckInputsEqual function
$('#emailAdvocate').keyup(CheckInputsEqualAdvocate); // Change to first email id
$('#emailAdvocateConfirm').keyup(CheckInputsEqualAdvocate); // change to second email id

// Checks if two input elements have the same value. If not, a btn will be disabled
function CheckInputsEqualAdvocate(){
    var email = $('#email').val(); // Change to first email id
    var repeatEmail = $('#emailConfirm').val(); // change to second email id
    
    var emailGuardian = $('#emailAdvocate').val();
    var repeatEmailGuardian = $('#emailAdvocateConfirm').val();

    if(email == repeatEmail && emailGuardian == repeatEmailGuardian){
        $('#emailAdvocateConfirm').css('border', '1px solid #ced4da');
        emailGuardianValid = true;
        EnableSubmit();
    }
    else{
        $('#emailAdvocateConfirm').css('border', '2px solid red');
        emailGuardianValid = false;
        EnableSubmit();
    }
}


// Check validity of personnummer.
$('#socialSecurityNumber').keyup(function(){
    var valid = isValidSwedishSSN($('#socialSecurityNumber').val());
    if(valid){
        $('#socialSecurityNumber').css('border', '1px solid #ced4da');
        ssnValid = true;
        EnableSubmit();
    }
    else {
        $('#socialSecurityNumber').css('border', '2px solid red');
        ssnValid = false;
        EnableSubmit();
    }
})


// Check validity of personnummer.
$('#socialSecurityNumberAdvocate').keyup(function(){
    var valid = isValidSwedishSSN($('#socialSecurityNumberAdvocate').val());
    if(valid){
        $('#socialSecurityNumberAdvocate').css('border', '1px solid #ced4da');
        ssnGuardianValid = true;
        EnableSubmit();
    }
    else {
        $('#socialSecurityNumberAdvocate').css('border', '2px solid red');
        ssnGuardianValid = false;
        EnableSubmit();
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

function EnableSubmit(){
    if($('#socialSecurityNumberAdvocate').length < 1){
        emailGuardianValid = true;
        ssnGuardianValid = true;
    }
    if(emailValid && emailGuardianValid && ssnValid && ssnGuardianValid){
        console.log("Enabling submit button");
        $('#submitRegistration').attr('disabled', false);
    } else {
        console.log("Disabling submit button");
        $('#submitRegistration').attr('disabled', true);
    }
}