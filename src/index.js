

const button = document.getElementById("contactbutton")

button.addEventListener('click',  function contactUs(event){
    event.preventDefault();
    const fullName = document.getElementById('fname').value;
    const company = document.getElementById('company').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    // Log form field values
    console.log('Full Name:', fullName);
    console.log('Company:', company);
    console.log('Email:', email);
    console.log('Message:', message);
    (function(){
        emailjs.init("i9P0tanq7Q5bqkfPF");
        emailjs.send("service_52dmlph", 'my_first_template', {from_name:fullName,
            company:company, 
            email:email,
            message: message,
            reply_to:"reply"},
             "i9P0tanq7Q5bqkfPF");
     })();
})



