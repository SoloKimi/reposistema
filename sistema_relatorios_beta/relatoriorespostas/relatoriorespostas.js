//Todas as funções js com Caps Sensitive

function redirecionarRelatorioRespostas() {
    location.href = "../relatoriorespostas.php";
};

// function handle_resposta(idrp, qtdr){
//     var dataaux;
//     for (var n = 0; n < qtdr; n++) {
//         Array();
//     dataaux = 'resposta'+n+':' +$+('#resposta'+n).val();
//       }
//       salvarResposta(idrp, dataaux, qtdr);
// }

function handle_resposta(data) {
    var logaux = [];

    const dataaux = String(data).split(",");

    dataaux.forEach((element) => {logaux.push($('#' + element).val())} );
    return logaux;
}



function salvarResposta(dataaux, idrr) {
    console.log(dataaux);
    console.log(idrr);
    var respostasaux = handle_resposta(dataaux);
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
        $('#buttoninserirresposta').prop('disabled', false);
    } else {
        $.ajax({
            type: "POST",
            url: 'relatoriorespostas/relatoriorespostasI001.php',
            async: true,
            data: {
                respostasaux: respostasaux,
                idrr: idrr
            },
            success: function (data) {
                console.log(data);
                if (data != '') {
                    Swal.fire({
                        title: "Bom trabalho!",
                        text: "Respostas cadastradas com sucesso.",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = '../relatoriorespostas.php';
                        }
                    });
                } else {
                    alert('nao deu sucess');
                    Swal.fire({
                        title: "Ops..!",
                        text: "Não foi possível responder ao formulario!",
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


function excluirResposta(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir resposta?",
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
                url: 'relatoriorespostas/relatoriorespostasE001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Resposta deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../relatoriorespostas.php';
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