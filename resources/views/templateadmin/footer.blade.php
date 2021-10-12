<footer class="main-footer">
    <div class="footer-right">
        Copyright &copy; 2018
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>

<!-- Page Specific JS File -->
<script src="../assets/js/page/index.js"></script>
<!-- JS Properti -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
<script type="text/javascript">
    $('#mySelect').on('change', function() {
        var value = $(this).val();
        if (value == "Polri") {
            $("#pol").show();
            $("#jenis_penghargaan").show();
            $("#jenis_surat").show();
            $("#jenissuratadmin").show();
            $("#nonpol").hide();
            $("#seldat").hide();
        } else if (value == "Non Polri") {
            $("#pol").hide();
            $("#jenis_penghargaan").hide();
            $("#jenis_surat").show();
            $("#jenissuratadmin").show();
            $("#nonpol").hide();
            $("#seldat").hide();
        } else if (value == "Seluruh Data") {
            $("#seldat").show();
            $("#pol").hide();
            $("#jenis_penghargaan").hide();
            $("#jenis_surat").hide();
            $("#jenissuratadmin").hide();
            $("#nonpol").hide();
        }
    });

    $(document).ready(function() {
        $("#pol").hide();
        $("#nonpol").hide();
            $("#jenis_surat").show();
            $("#jenissuratadmin").show();
        $("#jenis_penghargaan").hide();
            $("#seldat").hide();
    });
</script>
<script type="text/javascript">
    $('#SelectPengajuan').on('change', function() {
        var value = $(this).val();
        if (value == "1") {
            $("#catatan_validasi").hide();
        } else if (value == "2") {
            $("#catatan_validasi").show();
        }
    });

    $(document).ready(function() {
        $("#catatan_validasi").hide();

    });
</script>
<script>
            $(document).ready(function() {
                $('#isi').summernote({
                    placeholder: "Ketikan sesuatu disini . . .",
                    height: '400',
                });
            });
        </script>
            <script>
            $(document).ready(function() {
                $('#info').summernote({
                    placeholder: "Ketikan sesuatu disini . . .",
                    height: '400',
                });
            });
            // $('#deskripsi').summernote('fontSize', 12);
        </script>
</html>
