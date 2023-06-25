(function (win, doc) {
    "use strict";

    const formServicoCliente = doc.querySelector('#form-servico-cliente');
    const modalRegistarTitle = doc.querySelector("#modalRegistarTitle");
    const modalHeader = doc.querySelector('#modalRegistar .modal-header');
    const operation = doc.querySelector("#operation");

    const btnsRegistroAdd = doc.querySelectorAll('.btns-registro-add');
    const btnsRegistroDel = doc.querySelectorAll('.btns-registro-del');
    const msgs = doc.querySelectorAll('.msg');

    function defaultValues(item){
        operation.value = item.getAttribute('operation');
        formServicoCliente.action = item.getAttribute('url');
        modalRegistarTitle.innerHTML = item.getAttribute('title');
        msgs.forEach(item => {
            if(item.id == "msg"+operation.value)
             item.classList.remove('d-none')
            else{
                if(!item.classList.contains('d-none'))
                    item.classList.add('d-none')
            }
        })
    }

    btnsRegistroAdd.forEach(item => {
        item.addEventListener('click', function(e){
            defaultValues(item);
            if(!modalHeader.classList.contains('bg-warning')){
                modalHeader.classList.remove('bg-danger');
                modalHeader.classList.add('bg-warning','text-white')
            }
        })
    });

    btnsRegistroDel.forEach(item => {
        item.addEventListener('click', function(e){
            defaultValues(item);
            if(!modalHeader.classList.contains('bg-danger')){
                modalHeader.classList.remove('bg-warning');
                modalHeader.classList.add('bg-danger','text-white')
            }
        })
    });

})(window, document);
