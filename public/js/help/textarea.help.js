function textareaChange(name,value, action=false){
    let textarea = document.querySelector(`textarea[name="${name}"]`);
    action ? textarea.setAttribute('disabled','') : textarea.removeAttribute('disabled');
    textarea.innerHTML = value;
}
