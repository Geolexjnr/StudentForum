</body>
<script>

    var regform = document.getElementById('regform')
    
    var error = []

    regform.addEventListener('submit',function(e){

        var username = document.getElementById('username')
        var email = document.getElementById('email')
        var password = document.getElementById('password')
        var confirm_password = document.getElementById('confirm_password')

        if(username.value == ""){
            error.push('Please enter username')
        }

        if(username.value.length < 5 || username.value.length > 25){
            error.push('Username must be between 5 and 25 Characters')
        }

        if(email.value == ""){
            error.push("Please enter email")
        }

        if(password.value == ""){
            error.push("please enter password")
        }

        if(password.value.length <= 6){
            error.push("number of characters for password should be 6 or more")
        }

        if(password.value!=confirm_password.value){
            error.push("passwords don't match")
        }

        var message = document.getElementById('message')

        if(error.length > 0){
        e.preventDefault()
        message.innerText = error
        }
    })
</script>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</html>