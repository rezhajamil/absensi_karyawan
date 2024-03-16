<style media="screen">
    .btn-md {
        padding: 1rem 2.4rem;
        font-size: .94rem;
        display: none;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }

    .absen-card {
        width: 30%;
        height: fit-content;
        padding: 16px;
        margin: auto;
        display: flex;
        flex-direction: column;
        color: #052e16;
    }

    .absen-card div {
        display: flex;
        align-items: center;
        column-gap: 4px;
    }

    .absen-card p {
        margin: 6px 0;
        font-weight: 600;
    }

    .absen-card p span {
        font-weight: 300;
    }
</style>
<section class='content' id="demo-content">
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'></div>
                <div class='box-body'>
                    <input type="hidden" name="absen" id="absen" value="<? echo $this->session->flashdata('absen') ?>">
                    <?php
                    // var_dump(json_decode($this->session->flashdata('absen')));
                    $attributes = array('id' => 'button');
                    echo form_open('scan/cek_id', $attributes); ?>
                    <div id="sourceSelectPanel" style="display:none">
                        <label for="sourceSelect">Change video source:</label>
                        <select id="sourceSelect" style="max-width:400px"></select>
                    </div>
                    <div id="video-container" style="display: flex;">
                        <video id="video" width="500" height="400" style="border: 1px solid gray"></video>

                    </div>
                    <textarea hidden="" name="id_karyawan" id="result" readonly></textarea>
                    <span> <input type="submit" id="button" class="btn btn-success btn-md" value="Cek Kehadiran"></span>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/zxing/zxing.min.js"></script>
<script type="text/javascript">
    window.addEventListener('load', function() {
        // let absen = $('#absen').val()
        let absen = <?= $this->session->flashdata('absen') ? $this->session->flashdata('absen') : 'null' ?>;
        // absen = absen ? JSON.parse(absen) : 'null'
        console.log('absen', absen);

        let selectedDeviceId;
        let audio = new Audio("assets/audio/beep.mp3");
        const codeReader = new ZXing.BrowserQRCodeReader()
        console.log('ZXing code reader initialized')
        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        sourceSelect.appendChild(sourceOption)
                    })
                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };
                    const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                    sourceSelectPanel.style.display = 'block'
                }
                codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
                    console.log({
                        result
                    })
                    document.getElementById('result').textContent = result.text
                    if (result != null) {
                        audio.play();
                    }
                    $('#button').submit();
                }).catch((err) => {
                    console.error(err)
                    document.getElementById('result').textContent = err
                })
                console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
            })
            .catch((err) => {
                console.error(err)
            })

        if (absen) {
            console.log('status', absen.status);
            if (absen.status == 1) {
                console.log('1');
                $('#video-container').append(`
                    <div class="bg-success absen-card">
                            <div>
                                <p>Jenis Absen</p>
                                <p> : </p><span>Absen Masuk</span>
                            </div>
                            <div>
                                <p>ID Karyawan</p>
                                <p> : </p><span>${absen.id_karyawan}</span>
                            </div>
                            <div>
                                <p>Nama Karyawan</p>
                                <p> : </p><span>${absen.nama_karyawan}</span>
                            </div>
                            <div>
                                <p>Jabatan</p>
                                <p> : </p><span>${absen.nama_jabatan}</span>
                            </div>
                            <div>
                                <p>Tanggal</p>
                                <p> : </p><span>${absen.tgl}</span>
                            </div>
                            <div>
                                <p>Jam Masuk</p>
                                <p> : </p><span>${absen.jam_msk}</span>
                            </div>
                        </div>`)
            } else if (absen.status == 2) {
                console.log('2');
                $('#video-container').append(`
                    <div class="bg-success absen-card">
                            <div>
                                <p>Jenis Absen</p>
                                <p> : </p><span>Absen Pulang</span>
                            </div>
                            <div>
                                <p>ID Karyawan</p>
                                <p> : </p><span>${absen.id_karyawan}</span>
                            </div>
                            <div>
                                <p>Nama Karyawan</p>
                                <p> : </p><span>${absen.nama_karyawan}</span>
                            </div>
                            <div>
                                <p>Jabatan</p>
                                <p> : </p><span>${absen.nama_jabatan}</span>
                            </div>
                            <div>
                                <p>Tanggal</p>
                                <p> : </p><span>${absen.tgl}</span>
                            </div>
                            <div>
                                <p>Jam Masuk</p>
                                <p> : </p><span>${absen.jam_msk}</span>
                            </div>
                            <div>
                                <p>Jam Keluar</p>
                                <p> : </p><span>${absen.jam_klr}</span>
                            </div>
                        </div>`)
            }
        }
    })
</script>