
function userSubmit(e){
    e.preventDefault();
    /** form data */
    let url = `${base_url}/user/newUser`;
    
    let form = document.getElementById('form-user');
    let formData = new FormData(form);
    
    let edit = (formData.get('id') ?? null);
    if(edit){
        url = `${base_url}/user/editUser/${formData.get('id')}`;
    }
    resetDisplay('section-successfully');
    resetDisplay('section-error');
    
    if(validate(formData)) {
        fetch(`${url}`,{
            method:`POST`,
            body: formData})
        .then(function(response) {
            return response.text()
        })
        .then(function(response){
            let data = JSON.parse(response);
            if(data.code === 200){
                displayMessage('section-successfully',data.data);
                if(!edit){
                    form.reset()
                }
                else{
                    (document.getElementById('title-user')).innerText = formData.get('name')+' '+formData.get('last_name');
                }
            }
            else{
                displayMessage('section-error',data.error);
            }    
        });
    }
}


function userDelete(id,e){
    e.preventDefault();
    if (window.confirm("Do you really want to delete user?")) {
        console.log('adsad');
        fetch(`${base_url}/user/delete/${id}`,{
            method:`DELETE`})
        .then(function(response) {
            return response.json()
        })
        .then(function(response){
            console.log(response)
            if(response.code === 200){
                displayMessage('section-successfully',response.data);
                var row = document.getElementById("user-"+id);
                row.parentNode.removeChild(row);
            }
            else{
                displayMessage('section-error',response.error);
            }    
        });
    }
}

