# apiNexmo
Nexmo API Call PHP Curl

I share 2 function:

1/ sendSms() is the function i use to call Nexmo API and send a SMS - you need to use it 5 variables:
- the phone number (international version)
- the transmitter (for example "Easy Renter")
- the SMS message (a string with a limited number of caracter - refer to Nexmo doc for more info)
- the Nexmo key and secret key

2/ phonenumberConvertion() is the function which convert french number to international number. It also clean the string number from unnecessary caracter.

I hope it will help others. And do not hesitate to propose improvements ;)
