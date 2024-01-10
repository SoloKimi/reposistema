//Todas as funções js com Caps Sensitive

function redirecionarProduto() {
    location.href = "../produto.php";
};


function salvarProduto() {
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
            $('#buttoninserirproduto').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'produto/produtoI001.php',
                async: true,
                data: {
                    titulo: $('#titulo').val(),
                    peso: $('#peso').val(),
                    tipopeso: $('#tipopeso').val(),
                    valorunitario: $('#valorunitario').val(),
                    paletizacao: $('#paletizacao').val(),
                    lastro: $('#lastro').val(),
                    codigo: $('#codigo').val(),
                    descricao: $('#descricao').val(),
                    familia1: $('#familia1').val(),
                    familia2: $('#familia2').val(),
                    embalagem: $('#embalagem').val(),
                    categoria: $('#categoria').val(),
                    codigofabricante: $('#codigofabricante').val(),
                    status: status0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Produto cadastrado com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../produto.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar o produto!",
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

function alterarProduto(id0) {
    var statusCheckbox = document.getElementById("status");
    if (statusCheckbox) {
        var status0;
        if (statusCheckbox.checked) {
            // A checkbox está marcada
            status0 = '1';
            console.log("Checkbox está marcada!");
        } else {
            // A checkbox não está marcada
            status0 = '0';
            console.log("Checkbox não está marcada!");
        }

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
            $('#buttonalterarproduto').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'produto/produtoA001.php',
                async: true,
                data: {
                    id: id0,
                    titulo: $('#titulo').val(),
                    peso: $('#peso').val(),
                    tipopeso: $('#tipopeso').val(),
                    valorunitario: $('#valorunitario').val(),
                    paletizacao: $('#paletizacao').val(),
                    lastro: $('#lastro').val(),
                    codigo: $('#codigo').val(),
                    codigofabricante: $('#codigofabricante').val(),
                    descricao: $('#descricao').val(),
                    familia1: $('#familia1').val(),
                    familia2: $('#familia2').val(),
                    embalagem: $('#embalagem').val(),
                    categoria: $('#categoria').val(),
                    status: status0
                }, success: function (data) {
                    console.log(data);
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Produto atualizado com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../produto.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar o produto!",
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

function excluirProduto(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir produto?",
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
                url: 'produto/produtoE001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Produto deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../produto.php';
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
                text: "Produto não excluida",
                icon: "error"
            });
        }
    });
}


function buscarProduto() {
    var pesquisaTitulo = $('#pesquisatitulo').val().trim();

    if (pesquisaTitulo === '' && $('#pesquisacategoria').val() === '0' && $('#pesquisaembalagem').val() === '0') {
        $('#divprodutopadrao').show();
        $('#divresultadoproduto').hide();
    } else {
        $.ajax({
            type: "POST",
            url: 'produto/produtoC001.php',
            async: true,
            data: {
                pesquisatitulo: pesquisaTitulo,
                pesquisacategoria: $('#pesquisacategoria').val(),
                pesquisaembalagem: $('#pesquisaembalagem').val()
            },
            success: function (data) {
                if (data.trim() === "") {
                    $('#divprodutopadrao').show();
                } else {
                    $('#divresultadoproduto').show();
                    $('#divresultadoproduto').html(data);
                    $('#divprodutopadrao').hide();
                }
            }
        });
    }
}

function exportarProduto(select) {

    $.ajax({
        type: "POST",
        url: 'exportar.php',
        async: true,
        data: {
            tipo: 'produto',
            select: select
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

function exportarProdutoPesquisa() {
    var pesquisaTitulo = $('#pesquisatitulo').val().trim();

    $.ajax({
        type: "POST",
        url: 'exportarpesquisaproduto.php',
        async: true,
        data: {
            pesquisatitulo: pesquisaTitulo,
            pesquisacategoria: $('#pesquisacategoria').val(),
            pesquisaembalagem: $('#pesquisaembalagem').val()
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