<footer class="py-4 mt-auto position-fixed bottom-0 w-100" style="background-color: #F0F8FF;">
    <div class="container px-5">
        <div class="row align-items-center justify-content-center flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0 text-black">Copyright &copy; Grupo 1 - Outubro/2025</div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="assets/jquery-3.7.1.min.js"></script>
<script src="assets/select2/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<!--Tabela-->
<script>
    $(document).ready(function() {
        $('#idtabela').DataTable({
            language: {
                url: "js/pt_br.json"
            }
        });
    });
</script>