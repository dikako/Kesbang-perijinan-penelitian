<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('template/header');?>
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('template/sidebar')?>
    <!--sidebar-->
    <div id="page-wrapper" style="background: #e7e7e7;">
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view($content);?>
                <!--content-->
            </div>
        </div>
        <?php $this->load->view('template/footer');?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control" style="width: 100%" name=""><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });
    });
    $(function(){
        $('#pesan-flash').delay(4000).fadeOut();
        $('#pesan-error-flash').delay(5000).fadeOut();
    });
    $('[data-toggle="tooltip"]').tooltip();
</script>
</body>
</html>
