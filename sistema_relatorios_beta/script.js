function loginUsuario() {
    $.ajax({
        type: "POST",
        url: 'autenticacao2132.php',
        async: true,
        data: {
            userLogin: $('#userLogin').val(),
            senhaLogin: $('#senhaLogin').val()
        },
        success: function (data) {
            var data0 = JSON.stringify(data);
            data = data.trim();
            if (data == 1) {
                Swal.fire({
                    title: "Bem Vindo",
                    text: "Login efetuado com sucesso",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'index.php';
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Credenciais incorretas!",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok!"
                }).then((result) => {
                    console.log(data);
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        }
    });
}

function modal(data) {
    $('#modalpadrao').html(data);
    //$("#ahrefmodalpadrao").click();
    $('#modalpadrao').modal({
        backdrop: 'static'
        //keyboard: false
    });
    $('#modalpadrao').modal('show');
}

function deslogarUsuario() {
    $.ajax({
        type: "POST",
        url: 'sair.php',
        async: true,
        data: {
        },
        success: function (data) {
            location.href = 'index.php';
        }
    });
}

function transformarData(data) {
    const dataArray = data.split("-");
    let retorno = dataArray[2] + '/' + dataArray[1] + '/' + dataArray[0];
    return retorno;
}


function exportar(select, tipo) {
    $.ajax({
        type: "POST",
        url: 'exportar.php',
        async: true,
        data: {
            select: select,
            tipo: tipo
        },
        success: function (data) {
             // Se a resposta não estiver vazia e não for um erro
             if (data.trim() !== "") {
                // Cria um link temporário
                var link = document.createElement('a');
                link.href = 'export/'+data; // contém o caminho do arquivo
                link.download = data; // data contém o nome do arquivo

                // Adiciona o link ao corpo do documento
                document.body.appendChild(link);

                // Simula o clique no link para iniciar o download
                link.click();

                // Remove o link do corpo do documento
                document.body.removeChild(link);
            } else {
                // Trate o caso em que a resposta é vazia ou um erro
                console.error("Erro ao exportar relatório");
            }
        }
    });
}