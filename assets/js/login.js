function login (e){
    e.preventDefault();
    /** form data */
    let form = document.getElementById('form-login');
    var formData = new FormData(form);

    if(validate(formData)) {
        fetch(`${base_url}/login/login`,{
            method:'POST',
            body: formData})
        .then(function(response) {
            return response.text()
        })
        .then(function(response){
            let data = JSON.parse(response);
            (data.code === 200) ? window.location.href=`${base_url}/user/home` : displayMessage('section-error',data.error);;
    
        });
    }
}