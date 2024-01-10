// Todas as funções js com CaseSensitive
function redirecionarFamilia1() {
    location.href = "../familia1.php";
};


function salvarFamilia1() {
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
            $('#buttoninserirfamilia1').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: 'familia1/familia1I001.php',
                async: true,
                data: {
                    titulo: $('#titulo').val(),
                    status: status0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Familia 1 cadastrada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia1.php';
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

function alterarFamilia1(id0) {
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
            $('#buttonalterarfamilia1').prop('disabled', false);
        } else {
            console.log(id0, status0);
            $.ajax({
                type: "POST",
                url: 'familia1/familia1A001.php',
                async: true,
                data: {
                    id: id0,
                    titulo: $('#titulo').val(),
                    status: status0
                }, success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Bom trabalho!",
                            text: "Familia 1 atualizada com sucesso!",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia1.php';
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

function excluirFamilia1(id0) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Excluir Familia 1?",
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
                url: 'familia1/familia1E001.php',
                async: true,
                data: {
                    id: id0
                },
                success: function (data) {
                    if (data == '1') {
                        Swal.fire({
                            title: "Excluído!",
                            text: "Familia 1 deletada com sucesso.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = 'familia1.php';
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
                text: "Familia 1 não excluida",
                icon: "error"
            });
        }
    });
}