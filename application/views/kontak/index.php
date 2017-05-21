<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kontak Page</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bower_component/bootstrap-3.3.7/css/bootstrap.min.css'); ?>"/>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/bower_component/bootstrap-3.3.7/js/bootstrap.min.js'); ?>"></script>
    </head>
    <body>
        <div class="container">

            <h1>Hello, world!</h1>
            <button type="button" class="btn btn-primary btn-lg" onclick="modal('add', '')">
                Tambah
            </button>
            <br/><br/>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($show) > 0) { ?>
                        <?php foreach ($show as $index => $row) { ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $row['kontak_nama']; ?></td>
                                <td><?php echo $row['kontak_phone']; ?></td>
                                <td class="text-center">
                                    <button onclick="modal('edit', '<?php echo $row['kontak_id']; ?>')" class="btn btn-sm btn-warning">Edit</button>
                                    <button onclick="delete_data('<?php echo $row['kontak_id']; ?>')" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">*Data masih kosong</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-modal" method="post" action="<?php echo base_url('kontak/save'); ?>" onsubmit="return false;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Judul Modal</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function modal(mode, param) {
                $('#myModal').modal('toggle');
                $('#myModal .modal-body').html('<p>Loading load content ... </p>');
                setTimeout(function () {
                    $('#myModal .modal-body').load('<?php echo base_url('kontak/editor'); ?>' + '/' + mode + '/' + param);
                }, 500);
            }
            function delete_data(param) {
                $.ajax({
                    url: "<?php echo base_url('kontak/delete'); ?>",
                    type: "POST",
                    data: 'kontak_id=' + param,
                    timeout: 5000,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status)
                        {
                            alert(data.pesan);
                        } else {
                            alert(data.pesan);
                        }
                        window.location.href = '<?php echo base_url('kontak'); ?>';
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Terjadi kesalahan saat menghubungkan ke server.');
                    }
                });
            }

            $(document).ready(function () {
                $('#form-modal').submit(function () {
                    var form = '#form-modal';
                    var modal = '#myModal';
                    $.ajax({
                        url: "<?php echo base_url('kontak/save'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        timeout: 5000,
                        dataType: "JSON",
                        success: function (data) {
                            if (data.status)
                            {
                                $(modal).modal('toggle');
                                $(form)[0].reset();
                                alert(data.pesan);
                            } else {
                                alert(data.pesan);
                            }
                            window.location.href = '<?php echo base_url('kontak'); ?>';
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('Terjadi kesalahan saat menghubungkan ke server.');
                        }
                    });
                });
            });
        </script>
    </body>
</html>