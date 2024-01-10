// Todas as funções js com Caps sensitive
function redirecionarFamilia2() {
    location.href = "../familia2.php";
};


function salvarFamilia2() {
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
            $('#buttoninserirfamilia2').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'familia2/familia2I001.php',
                async: true,
                data: {
                    titulo: $('#titulo').val(),
                    status: status0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Família 2 cadastrada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia2.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível criar a familia 1!",
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

function alterarFamilia2(id0) {
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
            $('#buttonalterarfamilia2').prop('disabled', false);
        } else {
            console.log(id0, status0);
            $.ajax({
                type: "POST",
                url: 'familia2/familia2A001.php',
                async: true,
                data: {
                    id: id0,
                    titulo: $('#titulo').val(),
                    status: status0
                }, success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Família 2 atualizada com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia2.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Ops..!",
                            text: "Não foi possível alterar a familia 1!",
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

function excluirFamilia2(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir Família 2?",
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
                url: 'familia2/familia2E001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Família 2 deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia2.php';
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
                text: "Família 2 não excluida",
                icon: "error"
            });
        }
    });
}