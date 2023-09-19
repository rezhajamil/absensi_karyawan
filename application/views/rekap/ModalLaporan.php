<style>
    .modal {
        overflow: auto !important;
    }

    @media print {
        .tr {
            -webkit-print-color-adjust: exact !important;
        }
    }

    table,
    th,
    td,
    tr {
        text-align: center;
    }
</style>
<?php
$segment = $this->uri->segment(3);
$kar = $this->kar->get_by_id($segment);
$gedung = $this->gedung->get_by_id($segment);
$gedung = $this->gedung->get_by_id($segment = $this->uri->segment(3));

$start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
$end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');
?>

<input type="hidden" name="" id="kar" value="<?= json_encode($kar) ?>">
<input type="hidden" name="" id="get" value="<?= json_encode($start) ?>">
<script>
    // console.log(document.getElementById('kar').value);
</script>
<div class="box" style='max-width:80.5%;margin-left:125px'>
    <div class="box-header with-border">
        <h3 class="box-title">Data Laporan Karyawan</h3>
        <div class="container">
            <div class="alert"></div>
            <div class="row clearfix">
                <div id='msg'></div>
                <div class="input-daterange" style="display: flex; align-items:center;">
                    <div class="" style="margin: 0 4px;">
                        <input type="date" name="start" id="start" value="<?= $_GET['start'] ?>" class="form-control" required />
                    </div>
                    <div class="" style="margin: 0 4px;">
                        <span class="font-bold">s/d</span>
                    </div>
                    <div class="" style="margin: 0 4px;">
                        <input type="date" name="end" id="end" value="<?= $_GET['end'] ?>" class="form-control" required />
                    </div>
                    <div class="" style="margin: 0 4px;">
                        <select name="divisi" id="divisi" class="form-control">
                            <option value="">Semua Divisi</option>
                            <?php
                            foreach ($this->rekap->divisi() as $key => $divisi) {
                                if ($_GET['divisi'] == $divisi->id_divisi) {
                                    echo "<option value='$divisi->id_divisi' selected>$divisi->nama_divisi</option>";
                                } else {
                                    echo "<option value='$divisi->id_divisi'>$divisi->nama_divisi</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="" style="margin: 0 4px;">
                        <button name="search" id="search" value="Search" class="btn btn-info">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <button onclick="printDiv('print-area')" class='pull-right'><i class='fa fa-print'></i> Print</button>
    </div>
    <div class="box-body">
        <div class="modal-content" style="min-width: 1000px;">
            <div class="modal-header" style='text-align:center'>
                <div class='pull-right'> </div>
                <span id="print-area">
                    <table style='border-bottom: #000 4px solid; width:100%;'>
                        <tr style="padding: 0px 10px;">
                            <td style='padding:10px 0px;width: fit-content;'>
                                <img src="<?php echo base_url(); ?>assets/images/logo.jpeg" width='120px'></img>
                            </td>
                            <td>
                                <br>
                                <p style='text-align: center;font-size:20px; width:100%'><b>
                                        <span style="display:block;font-size: 24px; margin-bottom: 0px;">PT. MERBAUJAYA INDAHRAYA</span>
                                        <span style="display:block;font-size: 18px;">PERKEBUNAN PABRIK PENGOLAHAN KELAPA SAWIT</span>
                                        <span style="display:block;font-weight: 500;font-size: 14px;">Kebun: Desa Aek Korsik, Kec. Aek Kuo, Kab.Labuhanbatu Utara, Sumatera Utara</span>
                                        <span style="display:block;font-weight: 500;font-size: 14px;">PKS: Desa Pulo Jantan, Kec. Na IX-X, Kab.Labuhanbatu Utara, Sumatera Utara</span>
                                    </b></p>
                            </td>
                            <td>
                                <span style="width: 100px;display: inline-block;"></span>
                            </td>
                        </tr>
                    </table>
                    <table style='text-align:left;font-weight:bold;margin-left:40px;'>
                        <tr>
                            <td width='200px' class='tr'>Lokasi</td>
                            <td>:&nbsp;</td>
                            <td class='tr' style="white-space: nowrap;"> <?php echo $gedung->nama_gedung; ?></td>
                            <!-- <td width='200px' rowspan='3'>&nbsp;</td> -->
                            <td width='200px' class='tr'>Periode</td>
                            <td>:&nbsp;</td>
                            <td class='tr'>
                                <?php
                                $data = $this->rekap->resultHadir2($segment, $start, $end);
                                // $start = $_GET['start'];
                                $st = date('Y-m-d', strtotime($start));
                                $t = explode('-', $st);
                                $bulan = $this->tanggal->bulan($t[1]);
                                // echo $bulan . '&nbsp' . $t[0];
                                echo date('d M Y', strtotime($start)) . ' s/d ' . date('d M Y', strtotime($end));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width='200px' class='tr'>Alamat </td>
                            <td class='tr text-left'>:&nbsp;</td>
                            <td class='tr text-left'><?php echo $gedung->alamat; ?> </td>
                            <td width='200px' class='tr'>Operator </td>
                            <td class='tr text-left'>:&nbsp;</td>
                            <td class='tr text-left'><?= $user->first_name ?></td>
                        </tr>
                    </table> <br><br><br>
                    <table style='text-align: center;margin-top:-20px;' border="2" cellspacing="0" width="100%">
                        <thead>
                            <tr style='background-color:#00ccff !important'>
                                <th width='50px' rowspan="2" align='top'>No</th>
                                <th width='200px' rowspan="2">NAMA</th>
                                <th width='150px' rowspan="2">DIVISI </th>
                                <th width='70px' rowspan="2">Total Kehadiran </th>
                                <th width='130px' colspan="3">Total Ketidakhadiran </th>
                            </tr>
                            <tr style='background-color:#00ccff !important'>
                                <th width='80px'>&nbsp; Sakit</th>
                                <th width='80px'>&nbsp; Ijin </th>
                                <th width='80px'>&nbsp; Alpha </th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        // $start = $_GET['start'];
                        // $end = $_GET['end'];
                        // $divisi = $_GET['divisi'];
                        // var_export($start, true);
                        foreach ($this->rekap->karyawan($segment, $divisi) as $row) {
                            $no++;
                            $hadir = $this->rekap->totalHadir_bak($segment, $row->id_karyawan, $start, $end);
                            $sakit = $this->rekap->totalHadir2($segment, $row->id_karyawan, $start, $end);
                            $ijin = $this->rekap->totalHadir3($segment, $row->id_karyawan, $start, $end);
                            $alpha = $this->rekap->totalHadir4($segment, $row->id_karyawan, $start, $end);
                            echo "<tr>
                            <td>" . $no . "</td>
                            <td>" . $row->nama_karyawan . "</td>
                            <td>" . $row->nama_divisi . "</td>
                            <td>" . $hadir . "</td>
                            <td>" . $sakit . "</td>
                            <td>" . $ijin . "</td>
                            <td>" . $alpha . "</td>
                            </tr>  ";
                        } ?>
                    </table>
            </div>
            <div class="modal-body" id="dataLaporan" style='margin-top:10px'></div>
            </span>
        </div><!-- /.modal-content -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn3d" data-dismiss="modal">Close</button>
        </div>
        <script src="<?php echo base_url() ?>assets/app/core/ModalLaporan.js" charset="utf-8"></script>
        <script src="<?php echo base_url() ?>assets/app/core/print.js" charset="utf-8"></script>
        <script type="text/javascript">
            function LoadDateL() {
                var start = $('#start').val();
                var end = $('#end').val();
                var divisi = $('#divisi').val();
                var url = "rekap/ajax_list_laporan/<?php echo $this->uri->segment(3); ?>/";
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        start: start,
                        end: end,
                        divisi: divisi,
                    },
                    datatype: 'text',
                    success: function(data) {
                        // console.log(data);
                        $('#dataLap').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // alert('ggl')
                        alert('Error adding / update data');
                    }
                });
            }

            $("#search").click(function() {
                // console.log($('#start').val());
                let id = $("#id-lokasi").val()
                let start = $("#start").val();
                let end = $("#end").val();
                let divisi = $("#divisi").val();
                loadLap(id, start, end, divisi);
            })

            $("#start").click((e) => e.preventDefault())
            $("#end").click((e) => e.preventDefault())

            // console.log({
            //     get: $('#get').val()
            // });
        </script>