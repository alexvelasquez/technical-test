function validate(formData){
    let validate = true;
    for (var value of formData.entries()) {
        if(value[1].trim() === ''){
            validate = false;
            break
        } 
    }
    return validate;
}

function displayMessage(name,message){
    let section = document.getElementById(name);
    console.log(message);
    console.log(section);
    section.innerText=message;
    section.style.display = "block"; /** error report */
}

function resetDisplay(name){
    let section = document.getElementById(name);
    section.textContent='';
    section.style.display = "none"; /** error report */
}
