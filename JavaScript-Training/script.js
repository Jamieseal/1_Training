//Array Variable

var MyTestArray = ["apples", "bananas", "pears", "oranges"];

// example 1

var = QuotesInStrings = "I quote \"string\" "

// If a value is equal to:

if ( a == b ) { }

// If a value is IDENTICAL than:

if ( a === b ) { }

// If a value is greater than:

if ( a > b) { }

// If a value is less than: 

if ( a < b ) { }

// If a value is greater than OR equal to:

if ( a >= b ) { }

// If a value is less than OR equal to:

if ( a <= b ) { }

// If a value is NOT equal to:

if ( a != b ) { }

// If a value is NOT IDENTICAL to:

if ( a !== b ) { }

// If a equals b AND c equals d "Both are true":

if ( a == b && c == d ) { }

// If a equals b OR c equals d "Either or both are true":

if ( a == b || c == d ) { }

// Ternary Operator **

// Longhand example

if ( a == b ) {
	console.log ("match");
} else {
	console.log ("no match");
}

// Shorthand > Condition ? = TRUE / : = FALSE

a == b ? console.log("match") : console.log("no match");

// Arrays

console.log(MyTestArray);

// Functions

// Regular function, called explicitly by name:
function multiply() {
    var result = 3 * 4;
    console.log("3 multiplied by 4 is ", result);
}
multiply();

// Anonymous function stored in variable.
// Invoked by calling the variable as a function:
var divided = function() {
    var result = 3 / 4;
    console.log("3 divided by 4 is ", result);
}
divided();

// Immediately Invoked Function Expression.
// Runs as soon as the browser finds it:
(function() {
    var result = 12 / 0.75;
    console.log("12 divided by 0.75 is ", result);
}())
