</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<div id="ajax-wait">
    <div class="spinner-border text-info"></div>
</div>

<style>
    #ajax-wait {
        display: none;
        position: fixed;
        z-index: 1999;
    }
</style>
<script>
    $(document).ready(function() {
        loading();
    });

    //Fungsi untuk efek loading
    function loading() {
        $(document).ajaxStart(function() {
            $("#ajax-wait").css({
                left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
                top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
                display: "block"
            })
        }).ajaxComplete(function() {
            $("#ajax-wait").fadeOut();
        });
    }
</script>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('/assets'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('/assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('/assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('/assets'); ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('/assets'); ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('/assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('/assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('/assets'); ?>/js/demo/datatables-demo.js"></script>


<!-- Page level custom scripts -->
<script src="<?= base_url('/assets'); ?>/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('/assets'); ?>/js/demo/chart-pie-demo.js"></script>
<script src="<?= base_url('/assets'); ?>/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('/assets'); ?>/js/javascript.js"></script>
<!-- Script -->
<?= $this->include('layout/script'); ?>

</body>

</html>