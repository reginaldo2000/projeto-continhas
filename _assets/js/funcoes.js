const URL_BASE = "http://localhost/projeto-continhas";

const prepareNova = () => {
    document.querySelector("#modal-nova-conta .modal-title").innerHTML = "Nova Conta";
    document.getElementById("btn-conta").innerHTML = "Cadastrar";
    document.getElementById("formConta").reset();
    document.getElementById("formConta").setAttribute("action", `${URL_BASE}/conta/cadastrar`);
    $("#modal-nova-conta").modal("show");
}

const prepareEdicao = (id) => {
    let urlRequest = `${URL_BASE}/conta/get/${id}`;
    $.ajax({
        type: "get",
        dataType: "json",
        url: urlRequest,
        success: (response) => {
            const form = document.getElementById("formConta");
            const elementos = document.querySelectorAll("#formConta input, #formConta select");
            let dados = response.data;

            elementos.forEach(item => {
                Object.keys(dados).forEach(obj => {
                    if(item.getAttribute("name") === obj) {
                        item.value = dados[obj];
                    }
                })
            })

            document.querySelector("#modal-nova-conta .modal-title").innerHTML = "Editar Conta";
            document.getElementById("btn-conta").innerHTML = "Atualizar";
            form.setAttribute("action", `${URL_BASE}/conta/editar/${response.data.id}`);
            $("#modal-nova-conta").modal("show");
        }
    });
}

const prepareDelete = (id) => {
    let urlRequest = `${URL_BASE}/conta/get/${id}`;
    $.ajax({
        type: "get",
        dataType: "json",
        url: urlRequest,
        success: (response) => {
            const form = document.getElementById("formExcluirConta");
            
            form.setAttribute("action", `${URL_BASE}/conta/excluir/${response.data.id}`);
            document.getElementById("excluir-conta").innerHTML = response.data.descricao;
            $("#modal-excluir-conta").modal("show");
        }
    });
    
}