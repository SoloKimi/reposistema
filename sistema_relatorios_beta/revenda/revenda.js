//Todas as funções js com Caps Sensitive

function redirecionarRevenda() {
    location.href = "../revenda.php";
};


function salvarRevenda() {
    var statusCheckbox = document.getElementById("status");
    if (statusCheckbox) {
        var status0;
        if (statusCheckbox.checked) {
            // A checkbox está marcada
            status0 = 1;
            console.log("Checkbox está marcada!");
        } else {
            // A checkbox não está marcada
            status0 = 0;
            console.log("Checkbox não está marcada!");
        }

        // Restante do seu código aqui
        var erro = "";
        erro = $("[obrigatorio=1]:visible").filter(function () {
            return $(this).val() == "";
        });
        if (erro.length > 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Preencha todos os campos Obrigatórios(*)!"
            });
            $('#buttoninserirrevenda').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'revenda/revendaI001.php',
                async: true,
                data: {
                    nomefantasia: $('#nomefantasia').val(),
                    cnpj: $('#cnpj').val(),
                    razaosocial: $('#razaosocial').val(),
                    base: $('#base').val(),
                    status: status0,
                    cidade: $('#cidade').val(),
                    estado: $('#estado').val(),
                    baseteste: $('#baseteste').val(),
                    adesao: $('#adesao').val(),
                    inscricaoestadual: $('#inscricaoestadual').val(),
                    responsavel: $('#responsavel').val()
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Revenda cadastrada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../revenda.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar a revenda!",
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                            }
                        });
                    }
                }
            });
        }
    } else {
        console.error("Elemento com ID 'status' não encontrado.");
    }
}

function alterarRevenda(id0) {
    var statusCheckbox = document.getElementById("status");
    if (statusCheckbox) {
        var status0;
        if (statusCheckbox.checked) {
            // A checkbox está marcada
            status0 = 1;
            console.log("Checkbox está marcada!");
        } else {
            // A checkbox não está marcada
            status0 = 0;
            console.log("Checkbox não está marcada!");
        }

        // Restante do seu código aqui
        var erro = "";
        erro = $("[obrigatorio=1]:visible").filter(function () {
            return $(this).val() == "";
        });
        if (erro.length > 0) {
            Swal.fire({
                icon: "waring",
                title: "Preencha os campos obrigatorios (*)",
                showConfirmButton: false,
                timer: 2000
            });
            $('#buttonalterarrevenda').prop('disabled', false);
        } else {
            console.log(id0, status0);
            $.ajax({
                type: "POST",
                url: 'revenda/revendaA001.php',
                async: true,
                data: {
                    id: id0,
                    nomefantasia: $('#nomefantasia').val(),
                    cnpj: $('#cnpj').val(),
                    razaosocial: $('#razaosocial').val(),
                    base: $('#base').val(),
                    status: status0,
                    cidade: $('#cidade').val(),
                    estado: $('#estado').val(),
                    baseteste: $('#baseteste').val(),
                    adesao: $('#adesao').val(),
                    inscricaoestadual: $('#inscricaoestadual').val(),
                    responsavel: $('#responsavel').val()
                }, success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Revenda atualizada com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../revenda.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar a revenda!",
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                            }
                        });
                    }
                }
            });
        }
    } else {
        console.error("Elemento com ID 'status' não encontrado.");
    }
}

function excluirRevenda(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir revenda?",
        text: "Essa ação não poderá ser revertida!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Excluir!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: 'revenda/revendaE001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Revenda deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../revenda.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Oops...!",
                            text: "Algo deu errado!",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                            }
                        });
                    }
                }
            });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "Revenda não excluida",
                icon: "error"
            });
        }
    });
}

function buscarRevenda() {
    if ($('#pesquisanome').val().trim() === '') {
        $('#divrevendapadrao').show();
        $('#divresultadorevenda').hide();
    } else {
        $.ajax({
            type: "POST",
            url: 'revenda/revendaC001.php',
            async: true,
            data: {
                pesquisanome: $('#pesquisanome').val().trim()
            },
            success: function (data) {
                if (data.trim() === "") {
                    $('#divrevendapadrao').show();
                } else {
                    $('#divresultadorevenda').show();
                    $('#divresultadorevenda').html(data);
                    $('#divrevendapadrao').hide();
                }
            }
        });
    }
}

function exportarRevendaPesquisa() {
    $.ajax({
        type: "POST",
        url: 'exportarpesquisarevenda.php',
        async: true,
        data: {
            pesquisanome: $('#pesquisanome').val().trim(),
            tipo: 'revenda'
        },
        success: function (data) {
            // Se a resposta não estiver vazia e não for um erro
            if (data.trim() !== "") {
                // Cria um link temporário
                var link = document.createElement('a');
                link.href = 'export/' + data; // contém o caminho do arquivo
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


function exportarRevenda(select) {
    $.ajax({
        type: "POST",
        url: 'exportar.php',
        async: true,
        data: {
            select: select,
            tipo: 'revenda'
        },
        success: function (data) {
            // Se a resposta não estiver vazia e não for um erro
            if (data.trim() !== "") {
                // Cria um link temporário
                var link = document.createElement('a');
                link.href = 'export/' + data; // contém o caminho do arquivo
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