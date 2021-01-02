<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Cloud Inventory <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik Tombol "Keluar" Untuk Keluar Dari Sistem</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets'); ?>/jquery/jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets'); ?>/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets'); ?>/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets'); ?>/sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Sweet Alert 2-->
<script src="<?= base_url(); ?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets'); ?>/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/datatables/dataTables.bootstrap4.min.js"></script>

<!-- My JavaScript -->
<script src="<?= base_url('assets'); ?>/js/my_script.js"></script>
<script src="<?= base_url('assets'); ?>/js/super_admin.js"></script>
<script src="<?= base_url('assets'); ?>/js/admin.js"></script>

<!-- Pagination Tabel -->
<script>
    $(document).ready(function() {
        $('#pagination').DataTable();
    });
</script>

<!-- Input File Custom -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<!-- Tampilkan & Sembunyikan Passoword Lama -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#show-pass1").click(function() {
            $("#icon1").toggleClass('fa-eye-slash');

            var input = $("#passwordlama");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

<!-- Tampilkan & Sembunyikan Passoword Baru -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#show-pass2").click(function() {
            $("#icon2").toggleClass('fa-eye-slash');

            var input = $("#passwordbaru");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

<!-- Tampilkan & Sembunyikan Konfirmasi Password -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#show-pass3").click(function() {
            $("#icon3").toggleClass('fa-eye-slash');

            var input = $("#konfirmasipassword");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

<!-- Tampilkan & Sembunyikan Password -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#show-pass4").click(function() {
            $("#icon4").toggleClass('fa-eye-slash');

            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

</body>

</html>