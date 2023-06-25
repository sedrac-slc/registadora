(function (win, doc) {
    "use strict";

    const btnAction = doc.querySelector("#btn-action");
    const formRealizacao = doc.querySelector('#form-realizacao');
    const modalRealizacaoTitle = doc.querySelector('#modalRealizacaoTitle');

    const formComponent = doc.querySelector("#form-component");
    const tableComponent = doc.querySelector("#table-component");

    const methodForm = doc.querySelector(`#form-realizacao [name="_method"]`);

    const btnsRealizacaoAdd = doc.querySelectorAll(".btns-realizacao-add");
    const btnsRealizacaoList = doc.querySelectorAll(".btns-realizacao-list");

    function dNoneRemove(obj, action){
        if(action){
            if(obj.classList.contains('d-none'))
                obj.classList.remove('d-none');
        }else{
            if(!obj.classList.contains('d-none'))
                obj.classList.add('d-none');
        }
    }

    btnsRealizacaoAdd.forEach(item => {
        item.addEventListener('click',(e)=>{
            dNoneRemove(btnAction, true);
            dNoneRemove(formComponent, true);
            dNoneRemove(tableComponent, false);
            tableComponent.innerHTML = ""
            formRealizacao.action = item.getAttribute('url');
            modalRealizacaoTitle.innerHTML = item.getAttribute('title');
            methodForm.value = item.getAttribute('method');
        })
    });

    btnsRealizacaoList.forEach(item => {
        item.addEventListener('click',(e)=>{
            dNoneRemove(btnAction, false);
            dNoneRemove(formComponent, false);
            dNoneRemove(tableComponent, true)

            formRealizacao.action = item.getAttribute('url');
            modalRealizacaoTitle.innerHTML = item.getAttribute('title');
            methodForm.value = item.getAttribute('method');
            let html = "";
            let viewAction = item.getAttribute('viewAction');
            fetch(`${item.getAttribute('url-json')}`)
            .then(resp => resp.json())
            .then(resp => {
                let tdAction;
                resp.forEach(obj => {
                    tdAction = !viewAction || viewAction != "true" ? ""
                    :`<td>
                        <button class="btn btn-danger" type="submit" value="${obj.id}" name="realizacao_id">
                            <i class="fas fa-trash"></i>
                            <span>apagar</span>
                        </button>
                    </td>`;
                    html += `<tr>
                        <td>${obj.dia_semana}</td>
                        <td>${obj.hora_abertura}</td>
                        <td>${obj.hora_termino}</td>
                        ${tdAction}
                    </tr>`
                })

            tableComponent.innerHTML = html != ""
                ?  tableComponentCreate(html, viewAction)
                :  `<div class="msg-empty"> Nenhum resultado foi encontrado</div>`;
            });


        })
    });

    function tableComponentCreate(line, viewAction){
       let tdAction = !viewAction || viewAction != "true" ? ""
        :`<th><i class="fas fa-tools"></i><span>Acção</span></th>`;
        return `<table class="table">
            <thead>
                <tr>
                    <th><i class="fas fa-calendar"></i><span>Dia semana</span></th>
                    <th><i class="fas fa-clock"></i><span>Hora abertura</span></th>
                    <th><i class="fas fa-clock"></i><span>Hora termino</span></th>
                    ${tdAction}
                </tr>
            </thead>
            <tbody>${line}</tbody>
        </table>`;
    }

})(window, document);
