const username = document.getElementById('username')
const email = document.getElementById('email')
const password = document.getElementById('password')
const confirm_password = document.getElementById('confirm_password')
const regform = document.getElementById('regform')
const errorElement = document.getElementById('error')

regform.addEventListener('submit', (e) => {
    const messages = []
    if(username.value === '' || username.value == null){
        messages.push('Username is required')
    }

    if(messages.length > 0){

        e.preventDefault()
       errorElement.innerText = messages.join(', ')
    }


})