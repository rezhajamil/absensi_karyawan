<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-<?= $box ?>'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>FORMULIR DIVISI</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <div class="form-group has-feedback">
                            <label for="nama_divisi"> Nama Divisi <?php echo form_error('nama_divisi') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-error="Nama Divisi harus diisi" name="nama_divisi" id="nama_divisi" placeholder="Nama Divisi" value="<?php echo $nama_divisi; ?>" required />
                                <span class="input-group-addon">
                                    <span class="fas fa-briefcase"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="id_divisi" value="<?php echo $id_divisi; ?>" />
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn3d"><?php echo $button ?></button>
                            <a href="<?php echo site_url('divisi') ?>" class="btn btn-default btn-lg btn3d">Cancel</a>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->