//Todas as funções js com Caps Sensitive

function redirecionarRelatorioPerguntas() {
    location.href = "../relatorioperguntas.php";
};


function salvarRelatorioPerguntas() {
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
            $('#buttoninserirrelatorioperguntas').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'relatorioperguntas/relatorioperguntasI001.php',
                async: true,
                data: {
                    titulo: $('#titulo').val(),
                    datalimite: $('#datalimite').val(),
                    status: status0
                },
                success: function (data) {
                    if (data != '') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Relatório de Perguntas cadastrado com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(data);
                                $('#formRelatorioPerguntas').submit()
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar o relatório de perguntas!",
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

function alterarRelatorioPerguntas(id0) {
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
            $('#buttonalterarrelatorioperguntas').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'relatorioperguntas/relatorioperguntasA001.php',
                async: true,
                data: {
                    id: id0,
                    titulo: $('#titulo').val(),
                    datalimite: $('#datalimite').val(),
                    status: status0
                }, success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Relatório de Perguntas atualizado com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../relatorioperguntas.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar o relatório perguntas!",
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

function excluirRelatorioPerguntas(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir relatório de perguntas?",
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
                url: 'relatorioperguntas/relatorioperguntasE001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Relatório de Perguntas deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../relatorioperguntas.php';
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
                text: "Relatório Perguntas não excluido",
                icon: "error"
            });
        }
    });
}

function modal(data) {
    $('#ModalDialog').html(data);
    //$("#ahrefmodalpadrao").click();
    $('#ModalDialog').modal({
        backdrop: 'static'
        //keyboard: false
    });
    $('#ModalDialog').modal('show');
}


function novaPergunta(id) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN001.php',
        async: true,
        data: {
            id,
        }, success: function (data) {
            modal(data);
        }
    });
}

function fecharmodalPerguntas(data) {
    $('#ModalDialog').html(data);
    //$("#ahrefmodalpadrao").click();
    $('#ModalDialog').modal({
        backdrop: 'static'
        //keyboard: false
    });
    $('#ModalDialog').modal('hide');
}

function puxarJsonPerguntasBanco(idrp) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasC001.php',
        async: true,
        data: {
            id: idrp
        },
        success: function (data) {
            if (data != '') {
                return data;
            } else {
                Swal.fire({
                    title: "Ops..!",
                    text: "Não foi possível buscar o json do relatório de perguntas!",
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

function arrayQuestoesJson(idrp) {
    var infojson = puxarJsonPerguntasBanco(idrp);

    const arrayaux = infojson.split(",");
    let arrayquestoes = arrayaux[1];
}

function salvarPergunta(id) {
    //verificação da checkbox zero
    var zeroCheckbox = document.getElementById("zero");
    if (zeroCheckbox) {
        var zero0;
        if (zeroCheckbox.checked) {
            // A checkbox está marcada
            zero0 = 1;
            console.log("Checkbox está marcada!");
        } else {
            // A checkbox não está marcada
            zero0 = 0;
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
            $('#buttoninserirpergunta').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'relatorioperguntas/relatorioperguntasI002.php',
                async: true,
                data: {
                    id: id,
                    titulo: $('#titulopergunta').val(),
                    tipopergunta: $('#tipopergunta').val(),
                    zero: zero0
                },
                success: function (data) {
                    if (data != '') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Pergunta cadastrada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(id);
                                $('#formRelatorioPerguntas').submit();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar a pergunta!",
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

function modalAlterarPergunta(id, ordem) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN002.php',
        async: true,
        data: {
            id: id,
            ordem: ordem
        }, success: function (data) {
            modal(data);
        }
    });
}

function alterarPergunta(id, ordem) {

    //verificação da checkbox zero
    var zeroCheckbox = document.getElementById("zero");
    if (zeroCheckbox) {
        var zero0;
        if (zeroCheckbox.checked) {
            // A checkbox está marcada
            zero0 = 1;
            console.log("Checkbox está marcada!");
        } else {
            // A checkbox não está marcada
            zero0 = 0;
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
            $('#buttoninserirpergunta').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'relatorioperguntas/relatorioperguntasA002.php',
                async: true,
                data: {
                    id: id,
                    ordem: ordem,
                    titulo: $('#titulopergunta').val(),
                    tipopergunta: $('#tipopergunta').val(),
                    zero: zero0
                },
                success: function (data) {
                    if (data != '') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Pergunta alterada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(id);
                                $('#formRelatorioPerguntas').submit()
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar a pergunta!",
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

function modalNovoColaboradorP(id) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN003.php',
        async: true,
        data: {
            id: id
        }, success: function (data) {
            modal(data);
        }
    });
}

function salvarColaboradorP(id, auxdata) {
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
        $('#buttoninserirpergunta').prop('disabled', false);
    } else {
        if ($('#conectcol').val() === '0') {

            colaux = '0';

        } else {
            var colaux = [];

            const dataaux = String(auxdata).split(",");
            //colaux.push($('#' + element).val())
            dataaux.forEach((element) => {
                var zeroCheckbox = document.getElementById(element);
                if (zeroCheckbox.checked) {
                    // A checkbox está marcada
                    colaux.push(element);
                } else {
                    // A checkbox não está marcada
                }
            });
        }


        $.ajax({
            type: "POST",
            url: 'relatorioperguntas/relatorioperguntasI003.php',
            async: true,
            data: {
                id: id,
                colaux: colaux
            },
            success: function (data) {
                if (data != '') {
                    Swal.fire({
                        title: "Bom trabalho!",
                        text: "Colaborador(es) adicionado(s) com sucesso.",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#idrp').val(id);
                            $('#formRelatorioPerguntas').submit()
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Ops..!",
                        text: "Não foi possível coligar colaborador a relatório de perguntas!",
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
}

function excluirColaboradorP(id, idrp) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir colaborador do relatório de perguntas?",
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
                url: 'relatorioperguntas/relatorioperguntasE003.php',
                async: true,
                data: {
                    id: id
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Colaborador desconectado com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(idrp);
                                $('#formRelatorioPerguntas').submit()
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
                text: "Colaborador não desconectado",
                icon: "error"
            });
        }
    });
}

function excluirPergunta(id, ordem) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir pergunta do relatório de perguntas?",
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
                url: 'relatorioperguntas/relatorioperguntasE002.php',
                async: true,
                data: {
                    id: id,
                    ordem: ordem
                },
                success: function (data) {
                    if (data != '') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Pergunta desconectado com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(id);
                                $('#formRelatorioPerguntas').submit()
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
                text: "Pergunta não excluida",
                icon: "error"
            });
        }
    });
}

function modalVisualizarRespostas(idrr, idrp) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN004.php',
        async: true,
        data: {
            idrr: idrr,
            idrp: idrp
        }, success: function (data) {
            modal(data);
        }
    });
}

function modalVisualizarReferencia(id, titulo) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN006.php',
        async: true,
        data: {
            id: id,
            titulo: titulo
        }, success: function (data) {
            modal(data);
        }
    });
}

function salvarReferencia(id, aux, auxpro) {
    console.log(id);
    console.log(aux);
    console.log(auxpro);
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
    } else {

        var tiporeferencia = $('#tiporeferencia').val();
        var arrayaux = [];
        var revaux = [];
        var proaux = [];
        var auxrevendas = '';
        var auxoprodutos = '';

        if (tiporeferencia === 'produto') {
            var selectprod = String($('#refmultprod').val());

            arrayaux.push(selectprod);

            if (selectprod === 'prodet') {
                arrayaux.push($('#referenciacategoria').val());
                arrayaux.push($('#referenciafamilia1').val());
                arrayaux.push($('#referenciafamilia2').val());
                arrayaux.push($('#referenciaembalagem').val());

            } else if (selectprod === 'protodos') {


            } else if (selectprod === 'promult') {

                auxoprodutos = String(auxpro).split(",");
                auxoprodutos.forEach((element) => {
                    var zeroCheckbox = document.getElementById(element+'p');
                    if (zeroCheckbox.checked) {
                        // A checkbox está marcada
                        proaux.push(element);
                    } else {
                        // A checkbox não está marcada
                    }
                });
            }

        } else if (tiporeferencia === 'revenda') {

            var selectrev = String($('#refmultrev').val());

            arrayaux.push(selectrev);

            if (selectrev === 'revuni') {

                arrayaux.push($('#referenciarevenda').val());

            } else if (selectrev === 'revest') {

                arrayaux.push($('#referenciaestado').val());

            } else if (selectrev === 'revendas') {

                auxrevendas = String(aux).split(",");
                auxrevendas.forEach((element) => {
                    var revCheckbox = document.getElementById(element+'r');
                    console.log(revCheckbox);
                    console.log(element);
                    if (revCheckbox.checked) {
                        // A checkbox está marcada
                        revaux.push(element);
                    } else {
                        // A checkbox não está marcada
                    }
                });
                console.log(revaux);

                // auxrevendas.forEach((element) => { revaux.push($('#' + element).val()) });

            }else if (selectrev === 'revtodas'){

            }

        } else {
            arrayaux = '';
        }

        $.ajax({
            type: "POST",
            url: 'relatorioperguntas/relatorioperguntasI004.php',
            async: true,
            data: {
                id: id,
                tiporeferencia: tiporeferencia,
                arrayaux: arrayaux,
                revaux: revaux,
                proaux: proaux
            },
            success: function (data) {
                if (data != '') {
                    Swal.fire({
                        title: "Bom trabalho!",
                        text: "Referência adicionada com sucesso.",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#idrp').val(id);
                            $('#formRelatorioPerguntas').submit()
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Ops..!",
                        text: "Não foi possível adicionar referência ao relatório de perguntas!",
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
}

function excluirReferencia(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir referência do relatório de perguntas?",
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
                url: 'relatorioperguntas/relatorioperguntasE004.php',
                async: true,
                data: {
                    id: id
                },
                success: function (data) {
                    if (data != '') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Referência deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#idrp').val(id);
                                $('#formRelatorioPerguntas').submit()
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
                text: "Pergunta não excluida",
                icon: "error"
            });
        }
    });
}

function exportarRelatorio(idrp, idrr) {
    $.ajax({
        type: "POST",
        url: 'exportarrelatorio.php',
        async: true,
        data: {
            idrp: idrp,
            idrr: idrr,
            tipo: 'relatorio'
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
            // const path = "../"+data;
            // window.open(path);
            // // window.location = path;
            // window.focus();
            // if (data.trim() === "") {
            // } else {
            // }
        }
    });
}

function modalReferenciaP(id) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN005.php',
        async: true,
        data: {
            id: id
        }, success: function (data) {
            modal(data);
        }
    });
}


function modalTodasRespostas(idrp) {
    $.ajax({
        type: "POST",
        url: 'relatorioperguntas/relatorioperguntasN007.php',
        async: true,
        data: {
            idrp: idrp
        }, success: function (data) {
            modal(data);
        }
    });
}

function exportarRelatorioCompleto(idrp) {
    $.ajax({
        type: "POST",
        url: 'exportarrcompleto.php',
        async: true,
        data: {
            idrp: idrp,
            tipo: 'relatorio'
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