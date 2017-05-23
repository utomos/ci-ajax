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