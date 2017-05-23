<div id="pesan-modal"></div>
<input type="hidden" name="mode" value="<?php echo $mode; ?>"/>
<input type="hidden" name="kontak_id" value="<?php echo (isset($show)) ? $show['kontak_id'] : ''; ?>"/>
<div class="form-group">
    <label>Nama Kontak</label>
    <input type="text" class="form-control" name="kontak_nama" value="<?php echo (isset($show)) ? $show['kontak_nama'] : ''; ?>" placeholder="Nama Kontak"/>
</div>
<div class="form-group">
    <label>Phone Kontak</label>
    <input type="text" class="form-control" name="kontak_phone" value="<?php echo (isset($show)) ? $show['kontak_phone'] : ''; ?>" placeholder="Phone Kontak"/>
</div>