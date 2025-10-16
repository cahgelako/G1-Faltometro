function mostrarDecisao() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Você tem certeza?",
        text: "Não será possível reverter isso depois!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, pode deletar!",
        cancelButtonText: "Não, cancele!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deletado com Sucesso!",
                text: "Seu arquivo foi deletado",
                icon: "success"
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "Seu arquivo está em segurança",
                icon: "error"
            });
        }
    });

}


document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("deletar").addEventListener("click", mostrarDecisao);
});