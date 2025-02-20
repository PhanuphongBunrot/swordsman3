$(function () {



    $('#login').on('submit', function (e) {
        e.preventDefault();
        axios.post('/login_check', {
            email: $('#email').val(),
            password: $('#password').val()
        })
            .then(function (response) {
                
                if(response.data.status != false){
                    window.location.href = '/';
                }else{
                    $('#recheck').html('Username or password is incorrect');
                
                }
                // handle success, e.g., redirect to another page
            })
            .catch(function (error) {
                console.log(error);
                // handle error, e.g., show error message
            });

    });


});