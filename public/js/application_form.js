
function declarationCheck() {
    const checkbox_pernyataan = document.getElementById("checkbox-pernyataan");
    const button_pernyataan = document.getElementById("submit-pernyataan");

    checkbox_pernyataan.addEventListener("change", function () {
        button_pernyataan.disabled = !checkbox_pernyataan.checked;
    });

}

function validationNik() {
    const input_nik = document.getElementById("nik");
    const invalidFeedback = document.getElementById("validation_nik");
    input_nik.addEventListener("input", function () {
        const input_nik_value = input_nik.value;

        if (isNaN(input_nik_value)) {
            input_nik.classList.add("is-invalid");
            invalidFeedback.textContent = "NIK harus berupa 16 digit angka";
        } else if (input_nik_value == "") {
            input_nik.classList.add("is-invalid");
            invalidFeedback.textContent = "NIK tidak boleh kosong";
        } else {
            input_nik.classList.remove("is-invalid");
            if (!isNaN(input_nik_value) && input_nik_value.length == 16 && input_nik_value != "") {
                input_nik.classList.add("is-valid");
            }
        }
    })

}

function checkNullValue() {
    //Check field nama pelamar
    const nama_pelamar = document.getElementById("nama_pelamar");
    const invalidFeedbackNamaPelamar = document.getElementById("validation_nama_pelamar");
    nama_pelamar.addEventListener("input", function () {

        if (nama_pelamar.value == "") {
            nama_pelamar.classList.add("is-invalid");
            invalidFeedbackNamaPelamar.textContent = "Field tidak boleh kosong";
        }
        else {
            nama_pelamar.classList.remove("is-invalid");
            nama_pelamar.classList.add("is-valid");
        }
    });

    //check field alamat pelamar
    const alamat_pelamar = document.getElementById("alamat");
    const invalidFeedbackAlamat = document.getElementById("validation-alamat");
    alamat_pelamar.addEventListener("input", function () {

        if (alamat_pelamar.value == "") {
            alamat_pelamar.classList.add("is-invalid");
            invalidFeedbackAlamat.textContent = "Field tidak boleh kosong";
        }
        else {
            alamat_pelamar.classList.remove("is-invalid");
            alamat_pelamar.classList.add("is-valid");
        }
    });
    alamat_pelamar.addEventListener("change", function () {

        if (alamat_pelamar.value == "") {
            alamat_pelamar.classList.add("is-invalid");
            invalidFeedbackAlamat.textContent = "Field tidak boleh kosong";
        }
        else {
            alamat_pelamar.classList.remove("is-invalid");
            alamat_pelamar.classList.add("is-valid");
        }
    });

    const alamat_tetap_pelamar = document.getElementById("alamat_tetap");
    const invalidFeedbackAlamatTetap = document.getElementById("validation-alamat-tetap");
    alamat_tetap_pelamar.addEventListener("input", function () {

        if (alamat_tetap_pelamar.value == "") {
            alamat_tetap_pelamar.classList.add("is-invalid");
            invalidFeedbackAlamatTetap.textContent = "Field tidak boleh kosong";

        }
        else {

            alamat_tetap_pelamar.classList.remove("is-invalid");
            alamat_tetap_pelamar.classList.add("is-valid");
        }
    });
    alamat_tetap_pelamar.addEventListener("change", function () {

        if (alamat_tetap_pelamar.value == "") {
            alamat_tetap_pelamar.classList.add("is-invalid");
            invalidFeedbackAlamatTetap.textContent = "Field tidak boleh kosong";
        }
        else {


            alamat_tetap_pelamar.classList.remove("is-invalid");
            alamat_tetap_pelamar.classList.add("is-valid");
        }
    });



    //check field telepon rumah
    const telepon_rumah = document.getElementById("telepon_rumah");
    const invalidFeedbackTeleponRumah = document.getElementById("validation_telepon_rumah");
    telepon_rumah.addEventListener("input", function () {

        if (telepon_rumah.value == "") {
            telepon_rumah.classList.add("is-invalid");
            invalidFeedbackTeleponRumah.textContent = "Field tidak boleh kosong";
        }
        else {
            telepon_rumah.classList.remove("is-invalid");
            telepon_rumah.classList.add("is-valid");
        }
    });
    telepon_rumah.addEventListener("keyup", function () {

        if (telepon_rumah.value == "") {
            telepon_rumah.classList.add("is-invalid");
            invalidFeedbackTeleponRumah.textContent = "Field tidak boleh kosong";
        }
        else {
            telepon_rumah.classList.remove("is-invalid");
            telepon_rumah.classList.add("is-valid");
        }
    });

    //check field telepon kantor
    const telepon_kantor = document.getElementById("telepon_kantor");
    const invalidFeedbackTeleponKantor = document.getElementById("validation_telepon_kantor");
    telepon_kantor.addEventListener("input", function () {

        if (telepon_kantor.value == "") {
            telepon_kantor.classList.add("is-invalid");
            invalidFeedbackTeleponKantor.textContent = "Field tidak boleh kosong";
        }
        else {
            telepon_kantor.classList.remove("is-invalid");
            telepon_kantor.classList.add("is-valid");
        }
    });
    telepon_kantor.addEventListener("keyup", function () {

        if (telepon_kantor.value == "") {
            telepon_kantor.classList.add("is-invalid");
            invalidFeedbackTeleponKantor.textContent = "Field tidak boleh kosong";
        }
        else {
            telepon_kantor.classList.remove("is-invalid");
            telepon_kantor.classList.add("is-valid");
        }
    });

    //check field tempat lahir
    const tempat_lahir = document.getElementById("tempat_lahir");
    const invalidFeedbacktempatLahir = document.getElementById("validation_tempat_lahir");
    tempat_lahir.addEventListener("input", function () {

        if (tempat_lahir.value == "") {
            tempat_lahir.classList.add("is-invalid");
            invalidFeedbacktempatLahir.textContent = "Field tidak boleh kosong";
        }
        else {
            tempat_lahir.classList.remove("is-invalid");
            tempat_lahir.classList.add("is-valid");
        }
    });

    //check field tinggi badan
    const input_tinggi_badan = document.getElementById("tinggi_badan");
    const invalidFeedbackTinggiBadan = document.getElementById("validation_tinggi badan");
    input_tinggi_badan.addEventListener("input", function () {
        const input_tinggi_badan_value = input_tinggi_badan.value;

        if (isNaN(input_tinggi_badan_value)) {
            input_tinggi_badan.classList.add("is-invalid");
            invalidFeedbackTinggiBadan.textContent = "Input harus berupa angka";
        } else if (input_tinggi_badan_value == "") {
            input_tinggi_badan.classList.add("is-invalid");
            invalidFeedbackTinggiBadan.textContent = "Field tidak boleh kosong";
        } else {
            input_tinggi_badan.classList.remove("is-invalid");
            if (!isNaN(input_tinggi_badan_value) && input_tinggi_badan_value.length == 3 && input_tinggi_badan_value != "") {
                input_tinggi_badan.classList.add("is-valid");
            }
        }
    })

    //check field berat badan
    const input_berat_badan = document.getElementById("berat_badan");
    const invalidFeedbackBeratBadan = document.getElementById("validation_berat badan");
    input_berat_badan.addEventListener("input", function () {
        const input_berat_badan_value = input_berat_badan.value;

        if (isNaN(input_berat_badan_value)) {
            input_berat_badan.classList.add("is-invalid");
            invalidFeedbackBeratBadan.textContent = "Input harus berupa angka";
        } else if (input_berat_badan_value == "") {
            input_berat_badan.classList.add("is-invalid");
            invalidFeedbackBeratBadan.textContent = "Field tidak boleh kosong";
        } else {
            input_berat_badan.classList.remove("is-invalid");
            if (!isNaN(input_berat_badan_value) && input_berat_badan_value.length == 3 && input_berat_badan_value != "") {
                input_berat_badan.classList.add("is-valid");
            }
        }
    })

    //check field status kawin
    const status_kawin = document.getElementById("status_kawin");
    const invalidFeedbackstatusKawin = document.getElementById("validation_status_kawin");
    status_kawin.addEventListener("change", function () {

        if (status_kawin.value == "") {
            status_kawin.classList.add("is-invalid");
            invalidFeedbackstatusKawin.textContent = "Pilih Salah Satu";
        }
        else {
            status_kawin.classList.remove("is-invalid");
            status_kawin.classList.add("is-valid");
        }
    });
}

function checkNullSelectOption() {
    //check field agama
    const agama = document.getElementById("id_agama");
    const invalidFeedbackAgama = document.getElementById("validation_agama");
    agama.addEventListener("change", function () {

        if (agama.value == "") {
            agama.classList.add("is-invalid");
            invalidFeedbackAgama.textContent = "Pilih Salah Satu";
        }
        else {
            agama.classList.remove("is-invalid");
            agama.classList.add("is-valid");
        }
    });

}


function formatCurrency(input) {

    // Get input value and remove non-numeric characters
    let value = input.value.replace(/[^\d]/g, '');

    // Format the value with IDR currency format
    let formattedValue = formatIDRCurrency(value);

    // Update the input value with the formatted currency value
    input.value = formattedValue;

    input_gaji.addEventListener("input", function () {
        if (input_gaji.value != "") {
            input_gaji.classList.add("is-valid");
        } else {
            input_gaji.classList.add("is-invalid");
        }
    })

}

function formatIDRCurrency(value) {
    const input_gaji = document.getElementById("gaji");
    const feedback_validation_gaji = document.getElementById("validation-gaji");

    // Check if value is empty or not a number
    if (value === '' || isNaN(value)) {
        input_gaji.classList.add("is-invalid");
        feedback_validation_gaji.textContent = "Field tidak boleh kosong dan harus berupa angka";
        return '';
    }
    else {
        input_gaji.classList.remove("is-invalid");
        input_gaji.classList.add("is-valid");

    }

    // Convert the value to a number and apply currency formatting
    let formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    return formatter.format(Number(value));
}

$(document).ready(function () {

    var total_row_anak = document.getElementById("counter_row_anak");
    var total_row_keluarga = document.getElementById("counter_row_keluarga");
    var total_row_organisasi = document.getElementById("counter_row_organisasi");
    var total_row_kontak_darurat = document.getElementById("counter_row_kontak_darurat");
    var total_row_pendidikan = document.getElementById("counter_row_riwayat_pendidikan");
    var total_row_riwayat_pekerjaan = document.getElementById("counter_row_riwayat_pekerjaan");
    var total_row_referensi = document.getElementById("counter_row_referensi");
    var total_referensi_satunama = document.getElementById("counter_row_referensi_from_satunama");

    $('#add-children-row').click(function (e) {
        var row_children = $('<tr>');
        col_children = "";
        col_children += ` 
        
                        <td >
                        <input type="text" class="form-control" id="nama_anak" name="nama_anak[]" placeholder="Nama Anak" required>
                    </td>
                    <td>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin_anak[]"
                            aria-label="Floating label select example" required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>

                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="umur_anak[]" id="umur" placeholder="Umur" min="0" required >
                    </td>
                    <td id="col-4">
                        <button type="button" class="btn btn-danger" id="remove-children-row">Hapus</button>
                    </td>
        `;

        row_children.append(col_children);
        $("#tableAnak").append(row_children);
        total_row_anak.value++;
        console.log("row anak " + total_row_anak.value);
    })

    $(document).on("click", "#remove-children-row", function () {
        $(this).closest("tr").remove();
        total_row_anak.value--;
        console.log("row anak " + total_row_anak.value);
    });


    $('#add-family-row').click(function (e) {
        var row_family = $('<tr>')
        var col_family = "";

        col_family += `<td>

                <select class="form-select" id="hubungan" name="hubungan_keluarga[]" aria-label="Floating label select example" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="ayah">Ayah</option>
                    <option value="ibu">Ibu</option>
                    <option value="kakak">Kakak</option>
                    <option value="adik">Adik</option>
                    <option value="paman">Paman</option>
                    <option value="bibi">Bibi</option>
                    <option value="kakek">Kakek</option>
                    <option value="nenek">Nenek</option>

                </select>
        

                </td>

                <td>
    
                <input type="text" class="form-control" id="nama" name="nama_anggota_keluarga[]"  required>
    
                </td>

                <td>
        
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin_anggota_keluarga[]"
                    aria-label="Floating label select example" required>
                    <option value="" selected disabled>Pilih</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>

                </select>
        
                </td>

                <td>
        
                <input type="text" class="form-control" id="umur" name="umur_anggota_keluarga[]" min="0" required>
    

            </td>

            <td>
            
                <select class="form-select" aria-label="Default select example" id="jenjangPendidikan"
                    name="jenjang_pendidikan_anggota_keluarga[]" required>
                    <option selected disabled>Pilih Jenjang Pendidikan</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="SMK">SMK</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
        
            </td>

            <td>
    
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan_anggota_keluarga[]" required>
        
            </td>

            <td>
    
                <input type="text" class="form-control" id="perusahaan" name="perusahaan_tempat_bekerja[]"  required>


            </td>
            
            <td> <button type="button" class="btn btn-danger" id="remove-family-row"></i> Hapus</button></td>
            
            `

        row_family.append(col_family);
        $("#tableFamily").append(row_family);
        total_row_keluarga.value++;
        console.log("row keluarga " + total_row_keluarga.value);
    })

    $(document).on("click", "#remove-family-row", function () {
        $(this).closest("tr").remove();
        total_row_keluarga.value--;
        console.log("row keluarga " + total_row_keluarga.value);
    });



    $('#add-organization-row').click(function (e) {
        var row_organization = $('<tr>')
        var col_organization = "";

        col_organization += ` <td> <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi[]" placeholder="Nama Organisasi" required>
        </td>
        <td >
            <input type="text" class="form-control" id="posisi" name="posisi_di_organisasi[]" placeholder="Posisi" required>
        </td>
        <td> <button type="button" class="btn btn-danger" id="remove-organization-row"></i> Hapus</button></td>`
        row_organization.append(col_organization);
        $("#table-pengalaman-organisasi").append(row_organization);
        total_row_organisasi.value++;  
        console.log("row keluarga " + total_row_organisasi.value);


    });

    $(document).on("click", "#remove-organization-row", function () {
        $(this).closest("tr").remove();
        total_row_organisasi.value--;
    });




    $('#add-emergency-contact-row').click(function (e) {
        var row_contact = $('<tr>')
        var col_contact = "";

        col_contact += `<td >
                <input type="text" class="form-control" id="nama" name="nama_kontak[]" placeholder="Nama" required>
            </td>
            <td >
                <input type="text" class="form-control" id="hubungan" name="hubungan_kontak[]" placeholder="Hubungan" required>
            </td>
            <td >
                <input type="text" class="form-control" id="telepon" name="telepon_kontak[]" maxlength= "12" minlength="11" placeholder="Telepon" required>
            </td>
            <td >
                <input type="text" class="form-control" id="alamat" name="alamat_kontak[]" placeholder="Alamat" required>
            </td>
    <td> <button type="button" class="btn btn-danger" id="remove-contact-row"></i> Hapus</button></td>
    `
        row_contact.append(col_contact);
        $("#table-kontak-darurat").append(row_contact);
        total_row_kontak_darurat.value++;


    });

    $(document).on("click", "#remove-contact-row", function () {
        $(this).closest("tr").remove();
        total_row_kontak_darurat.value--;
    });

    $('#add-education-row').click(function (e) {
        var row_education = $('<tr>')
        var col_education = "";

        col_education += ` 
        <td >
            <select class="form-select" aria-label="Default select example" id="jenjangPendidikan"
                            name="jenjang_pendidikan[]" required>
                            <option disabled selected>Pilih
                                </option>
                                <option value="SD">SD (Sekolah Dasar)
                                </option>
                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                </option>
                                <option value="SMA">SMA (Sekolah Menengah Atas)
                                </option>
                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                </option>
                                <option value="D3">D3
                                </option>
                                <option value="D4">D4
                                </option>
                                <option value="S1">S1
                                </option>
                                <option value="S2">S2
                                </option>
                                <option value="S3">S3
                                </option>
            
            </select>
        </td>
        <td>
                <input type="text" class="form-control" id="nama_institusi" name="nama_institusi[]" placeholder="" required>
            </td>
            <td>
                <input type="text" class="form-control" id="jurusan" name="jurusan[]" placeholder="" required>
            </td>
            <td>
                <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus[]" placeholder="" required>
            </td>
            <td>
                <input type="text" class="form-control" id="ipk" name="ipk[]" placeholder="" required>
            </td>
            <td> <button type="button" class="btn btn-danger" id="remove-education-row"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button></td>`



        row_education.append(col_education);
        $("#table-riwayat-pendidikan-2").append(row_education);
        $("#table-body-riwayat-pendidikan").append(row_education);


        total_row_pendidikan.value++;

    });

    $(document).on("click", "#remove-education-row", function () {
        $(this).closest("tr").remove();
        total_row_pendidikan.value--;
    });

    $('#add-work-row').click(function (e) {
        var row_work = $('<tr>')
        var col_work = "";

        col_work += ` 
        <td>
        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan[]"
            "
            required>
    
    </td>
    <td>
    <input type="email" class="form-control" id="email_instansi" name="email_instansi[]"
        "
        max-length= "12" min-length="11"
        required>

</td>
<td>
    <input type="text" class="form-control" id="telepon" name="telepon[]"
       
        maxlength = "12" minlength="11"
        required>

</td>
    <td>
        <input type="text" class="form-control" id="posisi" name="posisi[]" "
        required>
    </td>
    <td>
        <input type="text" class="form-control" id="periode" name="periode[]" 
        required >
    </td>
    <td>
        <input type="text" class="form-control" id="gaji" name="gaji[]" 
        oninput="formatCurrency(this)" required>
    </td>
    <td>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="alasan_mengundurkan_diri[]"
                style="height: 200px" required></textarea>
            <label for="floatingTextarea2"></label>
        </div>
    </td>
            <td> <button type="button" class="btn btn-danger" id="remove-work-row"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button></td>`



        row_work.append(col_work);
        $("#table-body-riwayat-pekerjaan-2").append(row_work);
        $("#table-body-riwayat-pekerjaan").append(row_work);
        total_row_riwayat_pekerjaan.value++;

    });

    $(document).on("click", "#remove-work-row", function () {
        $(this).closest("tr").remove();
        total_row_riwayat_pekerjaan.value--;
    });

    $('#add-reference-not-satunama-row').click(function (e) {
        var row_reference_not_satunama = $('<tr>')
        var col_reference_not_satunama = "";

        col_reference_not_satunama += ` 
        <td>
                    <input type="text" class="form-control" id="nama_referensi" name="nama_referensi[]"
                        placeholder="Nama Referensi" required>

                </td>
                <td>
                    <input type="text" class="form-control" id="alamat_referensi" name="alamat_referensi[]" placeholder="Alamat" required>
                </td>
                <td>
                    <input type="text" class="form-control" id="telepon_referensi" name="telepon_referensi[]" placeholder="Telepon"  maxlength="12" required>
                </td>
                <td>
                <input type="email" class="form-control" id="email_referensi"
                    name="email_referensi[]" placeholder="Email"
                    required>
            </td>
                <td>
                    <input type="text" class="form-control" id="hubungan_referensi" name="hubungan_referensi[]" placeholder="Hubungan" required>
                </td>
                <td hidden>
                                    <input type="text" class="form-control" id="posisi_referensi"
                                        name="posisi_referensi[]" placeholder="Posisi"
                                        value=""
                                        >
                                </td>
            <td> <button type="button" class="btn btn-danger" id="remove-reference-not-satunama-row"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button></td>`



        row_reference_not_satunama.append(col_reference_not_satunama);
        $("#table-body-referensi-2").append(row_reference_not_satunama);
        total_row_referensi.value++;


    });

    $(document).on("click", "#remove-reference-not-satunama-row", function () {
        $(this).closest("tr").remove();
        total_row_referensi.value--;
    });


    $('#add-reference-from-satunama').click(function (e) {
        var row_reference_from_satunama = $('<tr>')
        var col_reference_from_satunama = "";

        col_reference_from_satunama += ` 
       <td>
            <input type="text" class="form-control" id="nama_referensi" name="nama_referensi[]"
                placeholder="Nama Referensi"
                required>

        </td>
        <td>
        <input type="email" class="form-control" id="email_referensi"
            name="email_referensi[]" placeholder="Email" required
            >
    </td>
    <td>
                    <input type="text" class="form-control" id="telepon_referensi" name="telepon_referensi[]" placeholder="Telepon" maxlength="12" required>
                </td>
                
        <td>
            <input type="text" class="form-control" id="posisi_referensi"
                name="posisi_referensi[]" placeholder="Posisi" required>
        </td>
        <td>
                    <input type="text" class="form-control" id="alamat_referensi" name="alamat_referensi[]" placeholder="Alamat" required>
                </td>
        <td>
            <input type="text" class="form-control" id="hubungan_referensi"
                name="hubungan_referensi[]" placeholder="Hubungan" required
                >
        </td>
            <td> <button type="button" class="btn btn-danger" id="remove-reference-from-satunama-row"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button></td>`



        row_reference_from_satunama.append(col_reference_from_satunama);
        $("#table-body-referensi-satunama-2").append(row_reference_from_satunama);
        total_referensi_satunama.value++;

    });

    $(document).on("click", "#remove-reference-from-satunama-row", function () {
        $(this).closest("tr").remove();
        total_referensi_satunama.value--;
    });



})


// function addRowTableWorkExperience() {
//     var jumlah_riwayat_pekerjaan = document.getElementById('jumlah_riwayat_pekerjaan');

//     const table_body = document.getElementById('table-body-riwayat-pekerjaan-2');

//     table_body.innerHTML = '';

//     for (var i = 1; i <= jumlah_riwayat_pekerjaan.value; i++) {
//         var tr = document.createElement('tr');
//         tr.innerHTML = `
//         <td>
//     <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan[]"
//         placeholder="Nama Perusahaan"
//         >

// </td>
// <td>
//     <input type="text" class="form-control" id="posisi" name="posisi[]" placeholder="Posisi"
//         >
// </td>
// <td>
//     <input type="text" class="form-control" id="periode" name="periode[]" placeholder="Periode"
//       >
// </td>
// <td>
//     <input type="text" class="form-control" id="gaji" name="gaji[]" placeholder="Gaji"
//     oninput="formatCurrency(this)" >
// </td>
// <td>
//     <div class="form-floating">
//         <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="alasan_mengundurkan_diri[]"
//             style="height: 200px"></textarea>
//         <label for="floatingTextarea2">Alasan mengundurkan diri</label>
//     </div>
// </td>

//         `;

//         table_body.appendChild(tr);
//     }
// }

// function addRowTableReferences() {
//     var jumlah_referensi = document.getElementById('jumlah_referensi');

//     const table_body = document.getElementById('table-body-referensi-2');

//     table_body.innerHTML = '';

//     for (var i = 1; i <= jumlah_referensi.value; i++) {
//         var tr = document.createElement('tr');
//         tr.innerHTML = `

//             <tr id="table-row-referensi">
//                 <td>
//                     <input type="text" class="form-control" id="nama_referensi" name="nama_referensi[]"
//                         placeholder="Nama Referensi">

//                 </td>
//                 <td>
//                     <input type="text" class="form-control" id="alamat_referensi" name="alamat_referensi[]" placeholder="Alamat"
//                 </td>
//                 <td>
//                     <input type="text" class="form-control" id="telepon_referensi" name="telepon_referensi[]" placeholder="Telepon"
//                 </td>
//                 <td>
//                 <input type="text" class="form-control" id="email_referensi"
//                     name="email_referensi[]" placeholder="Email"
//                     >
//             </td>
//                 <td>
//                     <input type="text" class="form-control" id="hubungan_referensi" name="hubungan_referensi[]" placeholder="Hubungan"
//                 </td>
//                 <td hidden>
//                                     <input type="text" class="form-control" id="posisi_referensi"
//                                         name="posisi_referensi[]" placeholder="Posisi"
//                                         value=""
//                                         >
//                                 </td>
//             </tr>

//         `;

//         table_body.appendChild(tr);
//     }
// }

// function addRowTableReferencesinSatunama() {
//     var jumlah_referensi_satunama = document.getElementById('jumlah_referensi_di_satunama');

//     const table_body = document.getElementById('table-body-referensi-satunama-2');

//     table_body.innerHTML = '';

//     for (var i = 1; i <= jumlah_referensi_satunama.value; i++) {
//         var tr = document.createElement('tr');
//         tr.innerHTML = `

//         <td>
//             <input type="text" class="form-control" id="nama_referensi" name="nama_referensi[]"
//                 placeholder="Nama Referensi"
//                 >

//         </td>
//         <td>
//         <input type="text" class="form-control" id="email_referensi"
//             name="email_referensi[]" placeholder="Email"
//             >
//     </td>
//     <td>
//                     <input type="text" class="form-control" id="telepon_referensi" name="telepon_referensi[]" placeholder="Telepon"
//                 </td>

//         <td>
//             <input type="text" class="form-control" id="posisi_referensi"
//                 name="posisi_referensi[]" placeholder="Posisi"
//                 >
//         </td>
//         <td>
//                     <input type="text" class="form-control" id="alamat_referensi" name="alamat_referensi[]" placeholder="Alamat"
//                 </td>
//         <td>
//             <input type="text" class="form-control" id="hubungan_referensi"
//                 name="hubungan_referensi[]" placeholder="Hubungan"
//                 >
//         </td>

//         `;

//         table_body.appendChild(tr);
//     }
// }

// function addRowTableTraining() {
//     var jumlah_pelatihan = document.getElementById('jumlah_pelatihan');

//     const table_body = document.getElementById('table-body-pelatihan');

//     table_body.innerHTML = '';

//     for (var i = 1; i <= jumlah_pelatihan.value; i++) {
//         var tr = document.createElement('tr');
//         tr.innerHTML = `

//         <td class="col-6">
//             <input type="text" class="form-control" id="subjek_pelatihan" name="subjek_pelatihan[]" placeholder="Subjek Pelatihan">
//         </td>
//         <td class="col-1">
//             <select name="tahun_pelatihan[]" id="tahun_pelatihan" class="form-select" aria-label="Default select example">
//             <?php 
//             $currentYear = \Carbon\Carbon::now()->format('Y');
//             $startYear = 1950; // Change this to your desired start year

//             for ($year=$currentYear; $year >= $startYear ; $year--) { 
//                 echo '<option value="' . $year . '">' . $year . '</option>';

//             }

//         ?>
//             </select>
//         </td>
//         <td class="col-5">
//             <input type="text" class="form-control" name="nama_mentor[]" id="nama_mentor" placeholder="Nama Mentor">
//         </td>

//         `;

//         table_body.appendChild(tr);
//     }
// }


function showInputAnotherIll(){
    const checkbox = document.getElementById('kondisi_kesehatan_lainnya');
    const input_penyakit_lainnya = document.getElementById('input_penyakit_lainnya');

    checkbox.addEventListener('change', () => {
        if(checkbox.checked){
            input_penyakit_lainnya.style.display = 'block';
        }
        else{
            input_penyakit_lainnya.style.display = 'none';
        }
    });

}

function showHideInputSeriousIll() {
    const showRadio = document.getElementById('radioYa');
    const hideRadio = document.getElementById('radioTidak');
    const input_penyakit_lainnya = document.getElementById('group_input_penyakit_serius_lainnya');

    showRadio.addEventListener('change', () => {
        if (showRadio.checked) {
            input_penyakit_lainnya.style.display = 'block';
        }

    });

    hideRadio.addEventListener('change', () => {
        if (hideRadio.checked) {
            input_penyakit_lainnya.style.display = 'none';
        }
    });

}

function showHideInputCederaOperation() {
    const showRadio = document.getElementById('radioButtonYa');
    const hideRadio = document.getElementById('radioButtonTidak');
    const input_pernah_cedera_atau_operasi = document.getElementById('group_input_pernah_cedera_atau_operasi');

    showRadio.addEventListener('change', () => {
        if (showRadio.checked) {
            input_pernah_cedera_atau_operasi.style.display = 'block';
        }
    });

    hideRadio.addEventListener('change', () => {
        if (hideRadio.checked) {
            input_pernah_cedera_atau_operasi.style.display = 'none';
        }
    });

}

function showInputAnotherComputerSkill(){
    const checkbox = document.getElementById('skillKomputerLainnya');
    const input_kemampuan_komputer = document.getElementById('input_skill_komputer_lainnya');

    checkbox.addEventListener('change', () => {
        if(checkbox.checked){
            input_kemampuan_komputer.style.display = 'block';

        }
        else{
            input_kemampuan_komputer.style.display = 'none';
        }
    })
}

function showInputAnotherSoftware(){
    const checkbox = document.getElementById('softwareLainnya');
    const input_software = document.getElementById('input_software_lainnya');

    checkbox.addEventListener('change', () =>{
        if(checkbox.checked){
            input_software.style.display = 'block';
        }
        else{
            input_software.style.display = 'none';
        }
    })
}

document.getElementById('submit-pernyataan').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';
    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});





