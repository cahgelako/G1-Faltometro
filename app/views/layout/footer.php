<style>
    .bg-primary-custom {
        background-color: #ADD8E6 ; /* Cor do Header (Azul Claro) */
    }
</style>
...

<footer class="py-3 fixed-bottom w-100 bg-primary-custom shadow-lg">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between">
            
            <div class="col-md-4 text-center text-md-start mb-1 mb-md-0">
                <div class="small text-dark">
                    <i class="fas fa-code me-1"></i> Desenvolvido pelo Grupo 1
                    <div class="d-none d-sm-inline">| Outubro/2025</div>
                </div>
            </div>
            

            <div class="col-md-4 text-center text-md-end">
                <div class="small text-dark">
                    Copyright &copy; Faltômetro 2025
                </div>
            </div>

        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="assets/jquery-3.7.1.min.js"></script>
<script src="assets/select2/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#idtabela').DataTable({
            language: {
                url: "js/pt_br.json"
            }
        });
    });
</script>