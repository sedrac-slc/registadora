( (win, doc) => {
    "use strict";

    const formServicoCliente = doc.querySelector("#form-servico-cliente");
    const modalServicoJoinTitle = doc.querySelector("#modalServicoJoinTitle");
    const panelInput = doc.querySelector("#panelInput");
    const panelTable = doc.querySelector("#panelTable");
    const operationService = doc.querySelector("#operation-service");
    const btnActionService = doc.querySelector("#btn-action-service");

    const btnsClienteServiceAdd = doc.querySelectorAll(".btn-servico-add");
    const btnsClienteServiceList = doc.querySelectorAll(".btn-servico-list");

    const inputService = doc.querySelector("#name_service");
    const inputUser = doc.querySelector("#name_user");
    const inputUrl = doc.querySelector("#url-json");

    function msgEmpty() {
        return `<div class="msg-empty mt-2"> Nenhum resultado foi encontrado</div>`;
    }

    function getServico(url, action) {
        fetch(url)
            .then((resp) => resp.json())
            .then((resp) => {
                let html = "";
                resp.forEach((obj) => {
                    html += `<tr>
                    <td class="text-center">
                        <input class="form-check" type="checkbox" name="servicos[]" value="${obj.id}" required="true">
                    </td>
                    <td class="text-center">${obj.nome}</td>
                    <td class="text-center">${obj.preco}</td>
                    <td>${obj.descricao}</td>
                </tr>`;
                });
                panelTable.innerHTML =
                    html != ""
                        ? tableComponentCreate(html, action)
                        : msgEmpty();
            });
    }

    function tableComponentCreate(line, action) {
        return `<table class="table table-hover">
             <thead>
                 <tr>
                     <th><div class="d-flex gap-1"><i class="fas fa-check"></i><span>Escolha</span></div></th>
                     <th><div class="d-flex gap-1"><i class="fas fa-signature"></i><span>Nome</span></div></th>
                     <th><div class="d-flex gap-1"><i class="fas fa-money-bill"></i><span>Preço</span></div></th>
                     <th><div class="d-flex gap-1"><i class="fas fa-comment"></i><span>Descrição</span></div></th>
                 </tr>
             </thead>
             <tbody>${line}</tbody>
         </table>`;
    }

    inputService.addEventListener("blur", function (e) {
        let url = `${inputUrl.value}?search=${inputService.value}`;
        if (inputService.value.trim() != "") {
            getServico(url, "");
        } else {
            panelTable.innerHTML = msgEmpty();
        }
    });

    btnsClienteServiceAdd.forEach((item) => {
        item.addEventListener("click", function (e) {
            formServicoCliente.action = item.getAttribute("url");
            modalServicoJoinTitle.innerHTML = "Adicionar\\Serviço";
            operationService.value = item.getAttribute("operation");
            panelTable.innerHTML = "";
            inputUser.value = item.getAttribute("name_cliente");

            if (panelInput.classList.contains("d-none"))
                panelInput.classList.remove("d-none");

            if (btnActionService.classList.contains("d-none")) {
                btnActionService.classList.remove("d-none");
            }

            btnActionService.innerHTML = "Salvar";
            if (!btnActionService.classList.contains("btn-primary")) {
                btnActionService.classList.remove("btn-danger");
                btnActionService.classList.add("btn-primary");
            }
        });
    });

    btnsClienteServiceList.forEach((item) => {
        item.addEventListener("click", function (e) {
            formServicoCliente.action = item.getAttribute("url");
            modalServicoJoinTitle.innerHTML = "Listar\\Serviço";
            operationService.value = item.getAttribute("operation");
            inputUser.value = item.getAttribute("name_cliente");

            let url = `${inputUrl.value}?cliente=${item.getAttribute(
                "cliente"
            )}`;
            let size = item.querySelector("sup").innerHTML.trim();

            if (!panelInput.classList.contains("d-none"))
                panelInput.classList.add("d-none");

            if (size > 0) {
                btnActionService.innerHTML = "Eliminar";
                if (btnActionService.classList.contains("d-none")) {
                    btnActionService.classList.remove("d-none");
                }
                if (!btnActionService.classList.contains("btn-danger")) {
                    btnActionService.classList.remove("btn-primary");
                    btnActionService.classList.add("btn-danger");
                }
                getServico(url, operationService.value);
            }else{
                if (!btnActionService.classList.contains("d-none")) {
                    btnActionService.classList.add("d-none");
                }
                panelTable.innerHTML = msgEmpty();
            }

        });
    });

})(window, document);
