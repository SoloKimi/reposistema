//Todas as funções caps sensitive

function redirecionarCompra() {
    location.href = "../compra.php";
};


function salvarCompra() {
    //alert($('#datacompra').val());
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
            $('#buttoninserircompra').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'compra/compraI001.php',
                async: true,
                data: {
                    descricao: $('#descricao').val(),
                    notafiscal: $('#notafiscal').val(),
                    datacompra: $('#datacompra').val(),
                    datavencimento: $('#datavencimento').val(),
                    produto: $('#produto').val(),
                    quantidade: $('#quantidade').val(),
                    tabela: $('#tabela').val(),
                    revenda: $('#revenda').val(),
                    status: status0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Compra cadastrada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../compra.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar a compra!",
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

function alterarCompra(id0) {
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
            $('#buttonalterarcompra').prop('disabled', false);
        } else {
            console.log(id0, status0);
            $.ajax({
                type: "POST",
                url: 'compra/compraA001.php',
                async: true,
                data: {
                    id: id0,
                    descricao: $('#descricao').val(),
                    notafiscal: $('#notafiscal').val(),
                    datacompra: $('#datacompra').val(),
                    datavencimento: $('#datavencimento').val(),
                    produto: $('#produto').val(),
                    quantidade: $('#quantidade').val(),
                    tabela: $('#tabela').val(),
                    revenda: $('#revenda').val(),
                    status: status0
                }, success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Compra atualizada com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../compra.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar a compra!",
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

function excluirCompra(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir compra?",
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
                url: 'compra/compraE001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Compra deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../compra.php';
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
                text: "Compra não excluida",
                icon: "error"
            });
        }
    });
}

function exportarCompra() {
    $.ajax({
        type: "POST",
        url: 'exportar.php',
        async: true,
        data: {
            tipo: 'compra'
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