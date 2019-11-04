// Detects a key change on input element with an id and calls CheckInputsEqual function
$('#email').keyup(CheckInputsEqual); // Change to first email id
$('#emailConfirm').keyup(CheckInputsEqual); // change to second email id

// Checks if two input elements have the same value. If not, a btn will be disabled
function CheckInputsEqual(){
    var email = $('#email').val(); // Change to first email id
    var repeatEmail = $('#emailConfirm').val(); // change to second email id

    if(email == repeatEmail){
        $('#emailConfirm').css('border', 'inherit');
    }
    else{
        $('#emailConfirm').css('border', '2px solid red');
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
        $('#emailAdvocateConfirm').css('border', 'inherit');
    }
    else{
        $('#emailAdvocateConfirm').css('border', '2px solid red');
    }
}


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