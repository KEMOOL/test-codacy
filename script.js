var csrf_name = "token";
var url = window.location.pathname.split("/");
var _URL = window.URL || window.webkitURL;
moment.locale("id");

$().ready(function () {
  // tambah kelas "active" pada sidebar
  $(`a[href="/admin/${url[2]}"]`).addClass("active");
  if (url[2] == "pengaturan-tunjangan") {
    $('a[href="/admin/pengaturan-tunjangan"]')
      .addClass("active")
      .parents(".nav-sidebar>.nav-item")
      .addClass("menu-open")
      .children(":first")
      .addClass("active");
  } else {
    $(`a[href="/admin/${url[2]}/${url[3]}"]`)
      .addClass("active")
      .parents(".nav-sidebar>.nav-item")
      .addClass("menu-open")
      .children(":first")
      .addClass("active");
  }
  //
  // notofikasi dokumen belum ada
  if (url[2] == "pegawai" && !isNaN(url[3])) {
    $.ajax({
      url: "/dokumen/getDokumen",
      type: "POST",
      datatype: "JSON",
      data: {
        token: $(`input[name=${csrf_name}]`).val(),
        id: "dokumen_kosong",
      },
      beforeSend: function () {},
      success: function (data) {
        $(`input[name=${csrf_name}]`).val(data[csrf_name]);
        toastr.options = {
          newestOnTop: false,
          progressBar: true,
        };

        $.each(data.isi, function (key, value) {
          toastr.warning(value);
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      },
    });
  }
  //
});

// init datatables
var formatDatatables = (function datatables() {
  $("#example1").DataTable({
    responsive: true,
    autoWidth: false,
    columnDefs: [
      {
        targets: [4],
        orderable: false,
      },
      {
        width: "10px",
        targets: 0,
      },
      {
        width: "200px",
        targets: 4,
      },
    ],
  });
  return datatables;
})();

var formatPayroll = (function tabelPayroll() {
  $("#tabel_payroll").DataTable({
    autoWidth: false,
    columnDefs: [
      {
        targets: [4],
        orderable: false,
      },
      {
        width: "10px",
        targets: 0,
      },
    ],
  });
  return tabelPayroll;
})();
//
// init daterangepicker
$("#tanggal_pelatihan").daterangepicker({
  autoUpdateInput: false,
});
//
// notifikasi setelah aksi
if ($("#flash_data").val()) {
  Swal.fire({
    icon: "success",
    title: $("#flash_data").val(),
  });
}

if ($("#error_flash_data").val()) {
  Swal.fire({
    icon: "error",
    title: $("#error_flash_data").val(),
  });
}
//
// konfirmasi ketika hapus data
var deleteDataTabel = (function konfirmasiDelete() {
  $(".form_delete button").click(function () {
    swal
      .fire({
        title: "Anda yakin ingin menghapus data",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        reverseButtons: true,
        dangerMode: true,
        focusCancel: true,
        confirmButtonColor: "#dc3545",
      })
      .then((result) => {
        if (result.value) {
          $(this).parent().submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          return false;
        }
      });
  });

  return konfirmasiDelete;
})();

$(".single").select2({
  minimumResultsForSearch: Infinity,
});
//
// tambah isian jumlah anak
$("#status_pernikahan").change(function () {
  if ($(this).val() == "Menikah") {
    anak = 0;
    if ($("#jumlah_anak").length === 0) {
      isi =
        '<div class="form-group"> <label for="jumlah_anak">Jumlah Anak <sup style="color: red;">*</sup> </label> <select class="form-control select2 single" id="jumlah_anak" name="jumlah_anak" data-placeholder="Pilih Jumlah Anak" style="width: 100%;"> <option></option> <option value="0"' +
        (anak == 0 ? " selected" : "") +
        '>0</option> <option value="1"' +
        (anak == 1 ? " selected" : "") +
        '>1</option>  <option value="2"' +
        (anak == 2 ? " selected" : "") +
        ">2</option> </select> </div>";

      $(isi).insertAfter($("#status_pernikahan").parent().parent());

      $(".single").select2({
        minimumResultsForSearch: Infinity,
      });
    }
  } else {
    if ($("#jumlah_anak").length) {
      $("#jumlah_anak").parent().remove();
    }
  }
});
//
// tambah isian jurusan
$("#tingkat_pendidikan").change(function () {
  if (
    $(this).val() != "SD atau Setingkat" &&
    $(this).val() != "SMP atau Setingkat"
  ) {
    if ($("#jurusan").length === 0) {
      isi =
        "<div class='form-group'> <label for='jurusan'> Jurusan <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control' id='jurusan' name='jurusan' placeholder='Masukkan Jurusan' required> <div class='invalid-feedback'></div> </div>";

      $($("#modal_pendidikan .col-lg-6:last-child")).prepend(isi);
    }
  } else {
    if ($("#jurusan").length) {
      $("#jurusan").parent().remove();
    }
  }
});
// tambah isian pangkat, gaji
if (
  $("form #status_pegawai").val() != undefined &&
  $("form #status_pegawai").val() != ""
) {
  displayFormGaji($("form #status_pegawai"));
}

$("#status_pegawai").change(function () {
  displayFormGaji($(this));
});

function displayFormGaji(elemen) {
  if (
    elemen.val() == "Pegawai Kontrak" ||
    elemen.val() == "Pegawai Alih Daya"
  ) {
    if ($("#gol_ruang_masa_kerja").length) {
      $("#gol_ruang_masa_kerja").parents(".form-group").remove();
      $("#iterasi").parents(".form-group").remove();
    }
    if ($("#gaji_berkala").length === 0) {
      isi =
        '<div class="form-group"> <label for="gaji_berkala"> Gaji Berkala <sup style="color: red;">*</sup> </label> <div class="input-group"> <input type="text" class="form-control" id="gaji_berkala" name="gaji_berkala" placeholder="Masukkan Gaj Berkala" required><span class="input-group-append"> <button type="button" class="btn btn-info btn-flat btn-file"> pilih file <input type="file" id="file_gaji_berkala" name="file_gaji_berkala"> </button> </span> </div> <div class="invalid-feedback"> </div> </div>';

      $(isi).insertAfter($("#tahun_pengangkatan").parent());
    }
  } else {
    if ($("#gaji_berkala").length) {
      $("#gaji_berkala").parents(".form-group").remove();
    }
    if ($("#gol_ruang_masa_kerja").length === 0) {
      isi =
        '<div class="form-group"> <label for="gol_ruang_masa_kerja"> Golongan/Ruang/Masa Kerja <sup style="color: red;">*</sup> </label> <div class="input-group">            <input type="text" class="form-control" id="gol_ruang_masa_kerja" name="gol_ruang_masa_kerja" placeholder="Contoh: C/IV/24" value="" required> <span class="input-group-append"> <button type="button" class="btn btn-info btn-flat btn-file"> pilih file <input type="file" id="file_gol_ruang_masa_kerja" name="file_gol_ruang_masa_kerja">     </button> </span>        </div>        <div class="invalid-feedback"> </div>    </div>    <div class="form-group">        <label for="iterasi">Iterasi dalam 4 Tahun <sup style="color: red;">*</sup></label>        <input type="text" id="iterasi" name="iterasi" class="form-control" value="" required>        <div class="invalid-feedback">  </div>    </div>';

      $(isi).insertAfter($("#tahun_pengangkatan").parent());
    }
  }
}
//
// cek setiap input form
$("form :input:not(:button)").each(function () {
  if ($(this).attr("type") == "file") {
    $(this).focusout(function () {
      if ($(this).val() == "") {
        $(this).parent().addClass("btn-info").removeClass("btn-success");
      } else {
        $(this).parent().addClass("btn-success").removeClass("btn-info");
      }
    });
  }
  if ($(this).attr("required") != undefined) {
    if ($(this).attr("type") == "file") {
      $(this).focusout(function () {
        if ($(this).val() == "") {
          $(this)
            .parent()
            .addClass("btn-danger")
            .removeClass("btn-info")
            .removeClass("btn-success");
        } else {
          $(this)
            .parent()
            .addClass("btn-success")
            .removeClass("btn-danger")
            .removeClass("btn-info");
        }
      });
    } else if ($(this).attr("type") != undefined) {
      $(this).focusout(function () {
        if ($(this).val() == "") {
          $(this)
            .addClass("is-invalid")
            .parents(".form-group")
            .find(".invalid-feedback")
            .html("Bagian ini harus diisi");
          if ($(this).parent().hasClass("input-group"))
            $(this).parent().addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
          if ($(this).parent().hasClass("input-group"))
            $(this).parent().removeClass("is-invalid");
        }
      });
    } else {
      $(this).on("select2:closing", function (e) {
        if ($(this).val() == "") {
          $(this)
            .addClass("is-invalid")
            .parents(".form-group")
            .find(".invalid-feedback")
            .html("Bagian ini harus diisi");
          if ($(this).parent().hasClass("input-group"))
            $(this).parent().addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
          if ($(this).parent().hasClass("input-group"))
            $(this).parent().removeClass("is-invalid");
        }
      });
    }
  }
});
//
// validasi form sebelum submit
$("form button[type=submit]").click(function () {
  flag = 0;
  parentId = $(this).parents("form").attr("id");

  $("#" + parentId + " :input:not(:button)").each(function () {
    if ($(this).attr("required") != undefined && $(this).val() == "") {
      if (
        $(this).attr("type") == "file" &&
        !$(this).hasClass("custom-file-input")
      ) {
        $(this).parent().addClass("btn-danger").removeClass("btn-info");
      } else {
        $(this)
          .addClass("is-invalid")
          .parents(".form-group")
          .find(".invalid-feedback")
          .html("Bagian ini harus diisi");
        if ($(this).parent().hasClass("input-group"))
          $(this).parent().addClass("is-invalid");
      }
      flag = 1;
    }
    if (
      $(this).attr("id") == "gol_ruang_masa_kerja" &&
      $(this).val() != "" &&
      !/^([ABCD])\/(IV?I{0,2})\/([1-3]?[0-9])$/.test($(this).val())
    ) {
      $(this)
        .addClass("is-invalid")
        .parent()
        .addClass("is-invalid")
        .parent()
        .find(".invalid-feedback")
        .html("Mohon isi sesuai format yang diberikan");
      flag = 1;
    }
  });

  if (flag == 1) {
    return false;
  }

  if (parentId == "form_ganti_password") {
    if (
      !/(?=.{8,}$)([A-Za-z].*\d|\d.*[A-Za-z])/.test($("#password_baru").val())
    ) {
      $("#password_baru")
        .addClass("is-invalid")
        .parents(".form-group")
        .find(".invalid-feedback")
        .html("Password Minimal 8 Karakter dengan Huruf dan Angka");
      return false;
    }
    if ($("#password_baru").val() != $("#konfirmasi_password").val()) {
      $("#konfirmasi_password")
        .addClass("is-invalid")
        .parents(".form-group")
        .find(".invalid-feedback")
        .html("Konfirmasi password tidak sama");
      return false;
    }
  }

  data = new FormData($(this).parents("form")[0]);
  $.ajax({
    url: $(this).parents("form").attr("action"),
    type: "POST",
    datatype: "JSON",
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function () {},
    success: function (data) {
      $(`input[name=${csrf_name}]`).val(data[csrf_name]);

      if (Object.keys(data.error).length > 0) {
        flag = false;
        $.each(data.error, function (key, value) {
          if (key.includes("file")) {
            if (!$("#" + key).hasClass("custom-file-input")) {
              flag = true;
              $("#" + key)
                .val("")
                .parent()
                .addClass("btn-danger");
            }
          } else {
            if (
              $("#" + key)
                .parent()
                .hasClass("input-group")
            ) {
              $("#" + key)
                .addClass("is-invalid")
                .parent()
                .addClass("is-invalid")
                .parent()
                .find(".invalid-feedback")
                .html(value);
            } else {
              $("#" + key)
                .addClass("is-invalid")
                .parents(".form-group")
                .find(".invalid-feedback")
                .html(value);
            }
          }
        });
        if (flag)
          Swal.fire({
            icon: "error",
            title: "Mohon unggah file JPG, JPEG, PNG, PDF kurang dari 2MB",
          });
        return false;
      }

      window.location.href = data.redirect;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
    },
  });

  return false;
});
//
// validasi input file
$(":input:file").on("change", function () {
  var ext = $(this).val().split(".").pop();
  var name = $(this).attr("id");

  if (
    $(this).attr("class") != undefined &&
    $(this).attr("class").includes("custom-file-input")
  ) {
    var file = this.files[0];
    var fileSize = file.size;
    var img = new Image();

    if ($(this).hasClass("pdf") && ext == "pdf") {
      if (fileSize >= 2097152) {
        $("#" + name).val("");
        $("#" + name)
          .addClass("is-invalid")
          .next(".custom-file-label")
          .removeClass("selected")
          .html("Choose file");
        Swal.fire({
          icon: "error",
          title: "Mohon unggah file kurang dari 2MB",
        });
        return false;
      }
      let filename = $("#" + name)
        .val()
        .split("\\")
        .pop();
      console.log(filename);
      $("#" + name)
        .removeClass("is-invalid")
        .next(".custom-file-label")
        .addClass("selected")
        .html(filename);
      return false;
    }
    img.onload = function () {
      if (fileSize >= 2097152) {
        $("#" + name).val("");
        $("#" + name)
          .addClass("is-invalid")
          .next(".custom-file-label")
          .removeClass("selected")
          .html("Choose file");
        Swal.fire({
          icon: "error",
          title: "Mohon unggah file kurang dari 2MB",
        });
        return false;
      }
      let filename = $("#" + name)
        .val()
        .split("\\")
        .pop();
      console.log(filename);
      $("#" + name)
        .removeClass("is-invalid")
        .next(".custom-file-label")
        .addClass("selected")
        .html(filename);
    };
    img.onerror = function () {
      $("#" + name).val("");
      $("#" + name)
        .addClass("is-invalid")
        .next(".custom-file-label")
        .removeClass("selected")
        .html("Choose file");
      Swal.fire({
        icon: "error",
        title: "Mohon unggah file JPG, JPEG, PNG",
      });
    };
    img.src = _URL.createObjectURL(file);
    return false;
  }

  if (ext == "pdf") {
    if (this.files[0].size >= 2097152) {
      $("#" + name).val("");
      Swal.fire({
        icon: "error",
        title: "Mohon unggah file kurang dari 2MB",
      });
    }
    return false;
  }

  var file = this.files[0];
  var fileSize = file.size;
  var img = new Image();

  img.onload = function () {
    if (fileSize >= 2097152) {
      $("#" + name).val("");
      Swal.fire({
        icon: "error",
        title: "Mohon unggah file kurang dari 2MB",
      });
    }
  };
  img.onerror = function () {
    $("#" + name).val("");
    Swal.fire({
      icon: "error",
      title: "Mohon unggah file JPG, JPEG, PNG, PDF",
    });
  };
  img.src = _URL.createObjectURL(file);
});
//
// menampilkan form tambah data
$(".btn-tambah-data").click(function () {
  nama = $(this).attr("id").replace("tambah_", "");
  if (nama == "pasangan") nama == "Suami/ Istri";

  $(".is-invalid").removeClass("is-invalid");
  $("#modal_" + nama + " h4.modal-title").html(
    '<i class="icon fas fa-plus"></i> Form Tambah ' + nama.replace("_", " ")
  );
  $("#modal_" + nama + " form").attr(
    "action",
    "/admin/" + nama.replace("_", "/") + "/tambah"
  );
  $("#modal_" + nama + " form").trigger("reset");

  $("#modal_" + nama + " form :input:file").each(function () {
    $(this).attr("required", true);
  });

  $(".single").select2({
    minimumResultsForSearch: Infinity,
  });

  if (nama == "penilaian") {
    isi =
      "<div class='row'><div class='col-9'> <div class='form-group'> <label for='indikator'> Indikator <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control indikator' id='indikator1' name='indikator[]' placeholder='Masukkan Indikator' required> <div class='invalid-feedback'></div> </div> </div> <div class='col-3'> <div class='form-group'> <label for='nilai'> Nilai <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control nilai' id='nilai1' name='nilai[]' placeholder='Nilai' required> <div class='invalid-feedback'></div> </div> </div> </div>  <button class='btn btn-sm btn-primary' id='tambah_indikator'>Tambah Indikator</button>";

    $("#modal_penilaian .modal-body .col-lg-7").html(isi);

    $("#tambah_indikator").click(function () {
      count = $("#modal_penilaian .indikator").length + 1;
      isi =
        "<div class='col-9'> <div class='form-group'> <label for='indikator'> Indikator <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control indikator' id='indikator" +
        count +
        "' name='indikator[]' placeholder='Masukkan Indikator' required> <div class='invalid-feedback'></div> </div></div><div class='col-3'> <div class='form-group'> <label for='nilai'> Nilai <sup style='color: red;'>*</sup> </label>  <input type='text' class='form-control nilai' id='nilai" +
        count +
        "' name='nilai[]' placeholder='Nilai' required> <div class='invalid-feedback'></div> </div></div>";

      $(isi).insertAfter("#modal_penilaian .col-lg-7 .col-3:last-child");
      return false;
    });
  }
  $("#modal_" + nama).modal("show");
});
//
// tampil modal edit data
var editDataTabel = (function tampilDataEdit() {
  $(".btn-edit-tabel").click(function () {
    e = $(this);
    kelas = $(this).parents("tr").attr("class");
    flag = false;

    if (kelas.match(/tunjangan-/g) != null) {
      kelas = kelas
        .match(/(?:^|\s)tunjangan-(.*?)(?:\s|$)/g)[0]
        .trim()
        .split("-");
      url = "/admin/" + kelas[0] + "/" + kelas[1] + "/get";
      flag = true;
      kelas = kelas[1];
    } else if (kelas.match(/potongan-/g) != null) {
      kelas = kelas
        .match(/(?:^|\s)potongan-(.*?)(?:\s|$)/g)[0]
        .trim()
        .split("-");
      url = "/admin/" + kelas[0] + "/" + kelas[1] + "/get";
      flag = true;
      kelas = kelas[1];
    } else url = "/admin/" + kelas + "/get";

    $.ajax({
      url: url,
      type: "POST",
      datatype: "JSON",
      data: {
        token: $(`input[name=${csrf_name}]`).val(),
        id: $(this).parents("tr").attr("id"),
      },
      beforeSend: function () {},
      success: function (data) {
        $(`input[name=${csrf_name}]`).val(data[csrf_name]);

        if (Object.keys(data[kelas]).length == 0) {
          console.log("data kosong");
          return false;
        }

        if (flag) {
          if (kelas == "pengaturan") {
            $("#modal_tunjangan h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form ' +
                e.parents(".card").find(".card-header h4").html()
            );
            $("#modal_tunjangan form").attr(
              "action",
              "/admin/tunjangan/pengaturan/edit"
            );
            $("#modal_tunjangan #jabatan").val(data.pengaturan["jabatan"]);
            $("#modal_tunjangan #nominal").val(data.pengaturan["nominal"]);

            $("#modal_tunjangan").modal("show");
          } else if (kelas == "kinerja") {
            $("#modal_tunjangan_kinerja h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Kinerja'
            );
            $("#modal_tunjangan_kinerja form").attr(
              "action",
              "/admin/tunjangan/kinerja/edit"
            );
            $("#modal_tunjangan_kinerja #nik").val(data.kinerja["nik"]);
            $("#modal_tunjangan_kinerja #nominal").val(data.kinerja["nominal"]);

            $("#modal_tunjangan_kinerja").modal("show");
          } else if (kelas == "lembur") {
            $("#modal_tunjangan_lembur h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Lembur'
            );
            $("#modal_tunjangan_lembur form").attr(
              "action",
              "/admin/tunjangan/lembur/edit"
            );
            $("#modal_tunjangan_lembur #nik").val(data.lembur["nik"]);
            $("#modal_tunjangan_lembur #nominal").val(data.lembur["nominal"]);

            $("#modal_tunjangan_lembur").modal("show");
          } else if (kelas == "teller") {
            $("#modal_tunjangan_teller h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Teller'
            );
            $("#modal_tunjangan_teller form").attr(
              "action",
              "/admin/tunjangan/teller/edit"
            );
            $("#modal_tunjangan_teller #nik").val(data.teller["nik"]);

            $("#modal_tunjangan_teller").modal("show");
          } else if (kelas == "auditor") {
            $("#modal_tunjangan_auditor h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Auditor'
            );
            $("#modal_tunjangan_auditor form").attr(
              "action",
              "/admin/tunjangan/auditor/edit"
            );
            $("#modal_tunjangan_auditor #nik").val(data.auditor["nik"]);
            $("#modal_tunjangan_auditor #jabatan").val(data.auditor["jabatan"]);

            $(".single").select2({
              minimumResultsForSearch: Infinity,
            });

            $("#modal_tunjangan_auditor").modal("show");
          } else if (kelas == "hariraya") {
            $("#modal_tunjangan_hariraya h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Hari Raya'
            );
            $("#modal_tunjangan_hariraya form").attr(
              "action",
              "/admin/tunjangan/hariraya/edit"
            );
            $("#modal_tunjangan_hariraya #nik").val(data.hariraya["nik"]);
            $("#modal_tunjangan_hariraya #nominal").val(
              data.hariraya["nominal"]
            );

            $("#modal_tunjangan_hariraya").modal("show");
          } else if (kelas == "prestasi") {
            $("#modal_tunjangan_prestasi h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Hari Raya'
            );
            $("#modal_tunjangan_prestasi form").attr(
              "action",
              "/admin/tunjangan/prestasi/edit"
            );
            $("#modal_tunjangan_prestasi #nik").val(data.prestasi["nik"]);
            $("#modal_tunjangan_prestasi #nominal").val(
              data.prestasi["nominal"]
            );

            $("#modal_tunjangan_prestasi").modal("show");
          } else if (kelas == "pendidikan") {
            $("#modal_tunjangan_pendidikan h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Hari Raya'
            );
            $("#modal_tunjangan_pendidikan form").attr(
              "action",
              "/admin/tunjangan/pendidikan/edit"
            );
            $("#modal_tunjangan_pendidikan #nik").val(data.pendidikan["nik"]);
            $("#modal_tunjangan_pendidikan #nominal").val(
              data.pendidikan["nominal"]
            );

            $("#modal_tunjangan_pendidikan").modal("show");
          } else if (kelas == "tantiem") {
            $("#modal_tunjangan_tantiem h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Tunjangan Hari Raya'
            );
            $("#modal_tunjangan_tantiem form").attr(
              "action",
              "/admin/tunjangan/tantiem/edit"
            );
            $("#modal_tunjangan_tantiem #nik").val(data.tantiem["nik"]);
            $("#modal_tunjangan_tantiem #nominal").val(data.tantiem["nominal"]);

            $("#modal_tunjangan_tantiem").modal("show");
          } else if (kelas == "angsuran") {
            $("#modal_potongan_angsuran h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Potongan Angsuran'
            );
            $("#modal_potongan_angsuran form").attr(
              "action",
              "/admin/potongan/angsuran/edit"
            );
            $("#modal_potongan_angsuran #nik").val(data.angsuran["nik"]);
            $("#modal_potongan_angsuran #nominal").val(
              data.angsuran["nominal"]
            );

            $("#modal_potongan_angsuran").modal("show");
          } else if (kelas == "lainlain") {
            $("#modal_potongan_lainlain h4.modal-title").html(
              '<i class="icon fas fa-edit"></i> Form Potongan Lain-lain'
            );
            $("#modal_potongan_lainlain form").attr(
              "action",
              "/admin/potongan/lainlain/edit"
            );
            $("#modal_potongan_lainlain #nik").val(data.lainlain["nik"]);
            $("#modal_potongan_lainlain #nominal").val(
              data.lainlain["nominal"]
            );

            $("#modal_potongan_lainlain").modal("show");
          }
        } else if (kelas == "pasangan") {
          $("#modal_pasangan h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Suami / Istri'
          );
          $("#modal_pasangan #nama_pasangan").val(data.pasangan["nama"]);
          $("#modal_pasangan #nik_pasangan").val(data.pasangan["nik"]);
          $("#modal_pasangan #ttl_pasangan").val(data.pasangan["ttl"]);
          $("#modal_pasangan #no_telp").val(data.pasangan["no_telp"]);
          $("#modal_pasangan #pekerjaan_pasangan").val(
            data.pasangan["pekerjaan"]
          );
          $("#modal_pasangan #pendidikan_pasangan").val(
            data.pasangan["pendidikan"]
          );
          $(
            "#modal_pasangan #hubungan_pasangan option[value=" +
              data.pasangan["hubungan"] +
              "]"
          ).prop("selected", true);
          $("#modal_pasangan form").attr("action", "/admin/pasangan/edit");

          $(".single").select2({
            minimumResultsForSearch: Infinity,
          });

          $("#modal_pasangan").modal("show");
        } else if (kelas == "anak") {
          $("#modal_anak h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Anak'
          );
          $("#modal_anak #nama_anak").val(data.anak["nama"]);
          $("#modal_anak #nik_anak").val(data.anak["nik"]);
          $("#modal_anak #ttl_anak").val(data.anak["ttl"]);
          $("#modal_anak #no_telp").val(data.anak["no_telp"]);
          $("#modal_anak #pekerjaan_anak").val(data.anak["pekerjaan"]);
          $("#modal_anak #pendidikan_anak").val(data.anak["pendidikan"]);
          $("#modal_anak #hubungan_anak").val(data.anak["hubungan"]);
          $("#modal_anak #jenis_kelamin").val(data.anak["jenis_kelamin"]);
          $("#modal_anak form").attr("action", "/admin/anak/edit");

          $(".single").select2({
            minimumResultsForSearch: Infinity,
          });

          $("#modal_anak").modal("show");
        } else if (kelas == "pendidikan") {
          $("#modal_pendidikan h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Pendidikan'
          );
          $("#modal_pendidikan #nama_sekolah").val(data.pendidikan["nama"]);
          $("#modal_pendidikan #tahun_lulus").val(
            data.pendidikan["tahun_lulus"]
          );
          $("#modal_pendidikan #tingkat_pendidikan").val(
            data.pendidikan["tingkat"]
          );
          $("#modal_pendidikan #jurusan").val(data.pendidikan["jurusan"]);
          $("#modal_pendidikan #alamat_sekolah").val(data.pendidikan["alamat"]);
          $("#modal_pendidikan #dokumen_ijasah").removeAttr("required");
          $("#modal_pendidikan form").attr("action", "/admin/pendidikan/edit");

          $(".single").select2({
            minimumResultsForSearch: Infinity,
          });

          $("#modal_pendidikan").modal("show");
        } else if (kelas == "pelatihan") {
          $("#modal_pelatihan h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Pelatihan'
          );
          $("#modal_pelatihan #judul_pelatihan").val(data.pelatihan["judul"]);
          $("#modal_pelatihan #penyelenggara").val(
            data.pelatihan["penyelenggara"]
          );
          $("#modal_pelatihan #tanggal_pelatihan").val(
            data.pelatihan["tanggal"]
          );
          $("#modal_pelatihan #lokasi").val(data.pelatihan["lokasi"]);
          $("#modal_pelatihan #dokumen_pelatihan").removeAttr("required");
          $("#modal_pelatihan form").attr("action", "/admin/pelatihan/edit");

          $("#modal_pelatihan").modal("show");
        } else if (kelas == "pelanggaran") {
          $("#modal_pelanggaran h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form pelanggaran'
          );
          $("#modal_pelanggaran #catatan").val(data.pelanggaran["catatan"]);
          $("#modal_pelanggaran #dokumen_pelanggaran").removeAttr("required");
          $("#modal_pelanggaran form").attr(
            "action",
            "/admin/pelanggaran/edit"
          );

          $("#modal_pelanggaran").modal("show");
        } else if (kelas == "cuti") {
          $("#modal_cuti h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Cuti'
          );
          $("#modal_cuti #tanggal_cuti").val(data.cuti["tanggal"]);
          $("#modal_cuti #jenis_cuti").val(data.cuti["jenis_cuti"]);
          $("#modal_cuti #alasan").val(data.cuti["alasan"]);
          $("#modal_cuti #lama_cuti").val(data.cuti["lama"]);
          $("#modal_cuti #dokumen_cuti").removeAttr("required");
          $("#modal_cuti form").attr("action", "/admin/cuti/edit");

          $(".single").select2({
            minimumResultsForSearch: Infinity,
          });

          $("#modal_cuti").modal("show");
        } else if (kelas == "penilaian") {
          $("#modal_penilaian h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form Penilaian'
          );
          $("#modal_penilaian #dokumen_penilaian").removeAttr("required");
          $("#modal_penilaian form").attr("action", "/admin/penilaian/edit");
          $("#modal_penilaian .modal-body .col-lg-7 .row").remove();

          isi =
            "<div class='row'><div class='col-9'> <div class='form-group'> <label for='indikator'> Indikator <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control indikator' id='indikator' name='indikator' placeholder='Masukkan Indikator' value='" +
            data.penilaian["indikator"] +
            "' required> <div class='invalid-feedback'></div> </div> </div> <div class='col-3'> <div class='form-group'> <label for='nilai'> Nilai <sup style='color: red;'>*</sup> </label> <input type='text' class='form-control nilai' id='nilai' name='nilai' placeholder='Nilai' value='" +
            data.penilaian["nilai"] +
            "' required> <div class='invalid-feedback'></div> </div> </div> </div>";

          $("#modal_penilaian .modal-body .col-lg-7").html(isi);

          $("#modal_penilaian").modal("show");
        } else if (kelas == "rumus") {
          $("#modal_rumus h4.modal-title").html(
            '<i class="icon fas fa-edit"></i> Form ' +
              e.parents(".card").find(".card-header h4").html() +
              " " +
              (data.nama == "pasangan" ? "Suami/Istri" : data.nama)
          );
          $("#modal_rumus form").attr("action", "/admin/rumus/edit");
          $("#modal_rumus #persentase")
            .val(data.rumus["rumus"])
            .next()
            .children()
            .html(
              "% dari gaji pokok" + (data.nama == "anak" ? " per anak" : "")
            );
          $("#modal_rumus .modal-body #nominal")
            .parents(".form-group")
            .remove();

          if (data.nama == "pangan") {
            $("#modal_rumus .modal-body").append(
              "<div class='form-group'> <label for='nominal'> Nominal <sup style='color: red;'>*</sup> </label> <div class='input-group'> <input type='number' class='form-control' id='nominal' name='nominal' placeholder='Masukkan Nominal' min='0' max='2147483647' value='" +
                data.rumus["nominal"] +
                "' required> <div class='input-group-append'><span class='input-group-text'>* jumlah anggota keluarga</span> </div> <div class='invalid-feedback'> </div> </div> </div>"
            );
          }

          $("#modal_rumus").modal("show");
        }

        return false;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      },
      async: false,
    });
  });

  return tampilDataEdit;
})();
//
// tampil modal daftar dokumen pegawai
$(".btn-dokumen").click(function () {
  id = $(this).attr("id");
  nama = $(this).attr("id").split("_").join(" ");

  $.ajax({
    url: "/dokumen/getDokumen",
    type: "POST",
    datatype: "JSON",
    data: {
      token: $(`input[name=${csrf_name}]`).val(),
      id: id,
    },
    beforeSend: function () {},
    success: function (data) {
      $(`input[name=${csrf_name}]`).val(data[csrf_name]);

      $("#modal_dokumen h4.modal-title").html(nama);
      $("#modal_dokumen #tabel_dokumen tbody").html(data.isi);

      $("#modal_dokumen").modal("show");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
    },
  });
});
//
// download dokumen
function downloadDokumen(event) {
  if ($(event.target).prev().attr("data-type") != "iframe") {
    link = $(event.target).prev().attr("href");
  } else {
    link = $(event.target).prev().attr("data-src");
  }

  nama =
    $(event.target).parents("tr").find(".nama").html() +
    " " +
    $("#nama").html();
  if (nama == "undefined " + $("#nama").html()) {
    if ($(event.target).parents("tr").hasClass("pasangan"))
      nama =
        "NIK " +
        $(event.target).parents("tr").find("#hubungan_pasangan").html() +
        " " +
        $("#nama").html();
    else if ($(event.target).parents("tr").hasClass("penilaian"))
      nama =
        "Dokumen Penilaian " +
        $(event.target).parents("tr").find("td:first-child").html() +
        " " +
        $("#nama").html();
    else
      nama =
        "Dokumen " +
        $(event.target).parents("tr").attr("class").charAt(0).toUpperCase() +
        $(event.target).parents("tr").attr("class").slice(1) +
        " " +
        $(event.target).parents("tr").find("td:first-child").html() +
        " " +
        $("#nama").html();
  }
  var ext = link.split(".").pop();

  $.ajax({
    url: link,
    method: "GET",
    xhrFields: {
      responseType: "blob",
    },
    success: function (data) {
      var a = document.createElement("a");
      var url = window.URL.createObjectURL(data);
      a.href = url;
      a.download = nama + "." + ext;
      document.body.append(a);
      a.click();
      a.remove();
      window.URL.revokeObjectURL(url);
    },
  });
}
//
// validasi tanggal pelatihan
$("#tanggal_pelatihan").on("apply.daterangepicker", function (ev, picker) {
  if (picker.endDate.format("L") > moment().format("L"))
    $(this)
      .val("")
      .addClass("is-invalid")
      .parents(".form-group")
      .find(".invalid-feedback")
      .html("Mohon tidak memilih tanggal lebih dari hari ini");
  else
    $(this)
      .removeClass("is-invalid")
      .val(picker.startDate.format("L") + " - " + picker.endDate.format("L"));
});

$("#tanggal_pelatihan").on("cancel.daterangepicker", function (ev, picker) {
  $(this).val("");
});
//
// display tanggal pelatihan tabel
$("#tabel_pelatihan .tanggal_pelatihan").each(function () {
  tanggal = $(this).html().split(" - ");
  if (
    moment(tanggal[0], "DD/MM/YYYY").format("LL") !=
    moment(tanggal[1], "DD/MM/YYYY").format("LL")
  )
    $(this).html(
      moment(tanggal[0], "DD/MM/YYYY").format("LL") +
        " - " +
        moment(tanggal[1], "DD/MM/YYYY").format("LL")
    );
  else $(this).html(moment(tanggal[0], "DD/MM/YYYY").format("LL"));
});
//
// konfirmasi naik pangkat
$("#naik_pangkat").click(function (e) {
  e.preventDefault();

  swal
    .fire({
      title: "Anda yakin ingin menaikkan pangkat si " + $("#nama").html(),
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Iya",
      cancelButtonText: "Tidak",
      reverseButtons: true,
      // dangerMode: true,
      focusCancel: true,
      confirmButtonColor: "#28a745",
    })
    .then((result) => {
      if (result.value) {
        window.location.href = $(this).parent().attr("href");
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        return false;
      }
    });
});
//
// Disable increment decrement input number
$("input[type=number]").on("focus", function () {
  $(this).on("keydown", function (event) {
    if (
      event.keyCode === 190 ||
      event.keyCode === 69 ||
      event.keyCode === 189 ||
      event.keyCode === 38 ||
      event.keyCode === 40
    ) {
      event.preventDefault();
    }
    // console.log($(this).val());
    // console.log($(this).val() > $(this).attr("max"));
    // console.log($(this).attr("max"));
    // if ($(this).val() > $(this).attr("max")) event.preventDefault();
    console.log(!$(this).val());
    // if (
    //   !$(this).val() ||
    //   (parseInt($(this).val()) <= 11 && parseInt($(this).val()) >= 0)
    // )
    //   $(this).data("old", $(this).val());
  });
  $(this).on("keyup", function (event) {
    console.log($(this).val());
    // if (
    //   !$(this).val() ||
    //   (parseInt($(this).val()) <= 11 && parseInt($(this).val()) >= 0)
    // );
    // else $(this).val($(this).data("old"));
  });
});
//
// format nominal rupiah
var formatNominal = (function nominal() {
  $(".nominal").each(function () {
    if ($(this).html() == 0) $(this).html("-");
    else
      $(this).html(
        "Rp" +
          $(this)
            .html()
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") +
          ",00"
      );
  });

  return nominal;
})();
//
// tampil data tabel
$("#tampil_data").click(function () {
  id = $(this).parents(".card-body").attr("id");
  url = "/admin/" + id.replace("_", "/") + "/tampil";
  $.ajax({
    url: url,
    type: "POST",
    datatype: "JSON",
    data: {
      token: $(`input[name=${csrf_name}]`).val(),
      bulan: $("#bulan").val(),
      tahun: $("#tahun").val(),
    },
    beforeSend: function () {},
    success: function (data) {
      $(`input[name=${csrf_name}]`).val(data[csrf_name]);

      if (id == "payroll") {
        if (Object.keys(data.payroll).length == 0) {
          $(".dataTables_wrapper").remove();
          $("#payroll .table-responsive").append(
            "<table class='table table-bordered datatables' id='tabel_payroll'> <thead class='bg-gray-dark'> <tr> <th rowspan='2'>No.</th> <th rowspan='2'>Nama</th> <th rowspan='2'>Unit Kerja</th> <th rowspan='2'>Pangkat</th> <th rowspan='2'>Status Martial</th> <th rowspan='2'>Jumlah Anak</th> <th rowspan='2'>Jabatan</th> <th rowspan='2'>Gaji Pokok</th> <th rowspan='2'>Tunjangan Suami/Istri</th> <th rowspan='2'>Tunjangan ANak</th> <th rowspan='2'>Lembur</th> <th rowspan='2'>Tunjangan Pangan</th> <th rowspan='2'>Tunjangan Jabatan</th> <th rowspan='2'>Tunjangan Operasional</th> <th rowspan='2'>Tunjangan Kinerja</th> <th rowspan='2'>Tunjangan Teller</th> <th rowspan='2'>Tunjangan Auditor</th> <th rowspan='2'>Jumlah</th> <th rowspan='2'>BPJS Kesehatan</th> <th colspan='2'>BPJS Ketenagakerjaan</th> <th rowspan='2'>Angsuran Pinjaman</th> <th rowspan='2'>Lain-lain Potongan</th> <th rowspan='2'>Jumlah Potongan</th> <th rowspan='2'>Gaji Bersih</th> <th rowspan='2'>THR</th> <th rowspan='2'>Tunjangan Prestasi</th> <th rowspan='2'>Tunjangan Pendidikan</th> <th rowspan='2'>Jaspro/Tantiem</th> </tr> <tr> <th>J. Hari Tua</th> <th>J. Pensiun</th> </tr> </thead> <tbody> </table>"
          );

          formatPayroll();

          return false;
        }
        $(".dataTables_wrapper").remove();

        isi =
          "<table class='table table-bordered datatables' id='tabel_payroll'> <thead class='bg-gray-dark'> <tr> <th rowspan='2'>No.</th> <th rowspan='2'>Nama</th> <th rowspan='2'>Unit Kerja</th> <th rowspan='2'>Pangkat</th> <th rowspan='2'>Status Martial</th> <th rowspan='2'>Jumlah Anak</th> <th rowspan='2'>Jabatan</th> <th rowspan='2'>Gaji Pokok</th> <th rowspan='2'>Tunjangan Suami/Istri</th> <th rowspan='2'>Tunjangan ANak</th> <th rowspan='2'>Lembur</th> <th rowspan='2'>Tunjangan Pangan</th> <th rowspan='2'>Tunjangan Jabatan</th> <th rowspan='2'>Tunjangan Operasional</th> <th rowspan='2'>Tunjangan Kinerja</th> <th rowspan='2'>Tunjangan Teller</th> <th rowspan='2'>Tunjangan Auditor</th> <th rowspan='2'>Jumlah</th> <th rowspan='2'>BPJS Kesehatan</th> <th colspan='2'>BPJS Ketenagakerjaan</th> <th rowspan='2'>Angsuran Pinjaman</th> <th rowspan='2'>Lain-lain Potongan</th> <th rowspan='2'>Jumlah Potongan</th> <th rowspan='2'>Gaji Bersih</th> <th rowspan='2'>THR</th> <th rowspan='2'>Tunjangan Prestasi</th> <th rowspan='2'>Tunjangan Pendidikan</th> <th rowspan='2'>Jaspro/Tantiem</th> </tr> <tr> <th>J. Hari Tua</th> <th>J. Pensiun</th> </tr> </thead> <tbody>";

        $.each(data.payroll, function (key, value, index) {
          isi +=
            "<tr> <td>" +
            ++key +
            "</td> <td>" +
            value["nama"] +
            "</td> <td>" +
            value["unit_kerja"] +
            "</td> <td>" +
            value["pangkat"] +
            "</td> <td>" +
            value["status_marital"] +
            "</td> <td>" +
            value["jumlah_anak"] +
            "</td> <td>" +
            value["jabatan"] +
            "</td> <td class='nominal'>" +
            value["gaji_pokok"] +
            "</td> <td class='nominal'>" +
            value["t_pasangan"] +
            "</td> <td class='nominal'>" +
            value["t_anak"] +
            "</td> <td class='nominal'>" +
            value["lembur"] +
            "</td> <td class='nominal'>" +
            value["t_pangan"] +
            "</td> <td class='nominal'>" +
            value["t_jabatan"] +
            "</td> <td class='nominal'>" +
            value["t_operasional"] +
            "</td> <td class='nominal'>" +
            value["t_kinerja"] +
            "</td> <td class='nominal'>" +
            value["t_teller"] +
            "</td> <td class='nominal'>" +
            value["t_auditor"] +
            "</td> <td class='nominal'>" +
            value["jumlah"] +
            "</td> <td class='nominal'>" +
            value["bpjs_kes"] +
            "</td> <td class='nominal'>" +
            value["j_hari_tua"] +
            "</td> <td class='nominal'>" +
            value["j_pensiun"] +
            "</td> <td class='nominal'>" +
            value["p_angsuran"] +
            "</td> <td class='nominal'>" +
            value["p_lainlain"] +
            "</td> <td class='nominal'>" +
            value["jumlah_potongan"] +
            "</td> <td class='nominal'>" +
            value["gaji_bersih"] +
            "</td> <td class='nominal'>" +
            value["thr"] +
            "</td> <td class='nominal'>" +
            value["t_prestasi"] +
            "</td> <td class='nominal'>" +
            value["t_pendidikan"] +
            "</td> <td class='nominal'>" +
            value["tantiem"] +
            "</td> </tr>";
        });
        isi += "</tbody> </table>";

        $("#payroll .table-responsive").append(isi);

        formatNominal();
        formatPayroll();

        return false;
      }

      if (Object.keys(data.pegawai).length == 0) {
        $(".dataTables_wrapper").remove();
        $("#" + id).append(
          "<table id='example1' class='table table-bordered table-hover'> <thead class='bg-gray-dark'> <tr> <th>No.</th> <th>Nama</th> <th>NIK</th> <th>Nominal</th>  <th>Aksi</th></tr> </thead> <tbody> </tbody> </table>"
        );

        formatDatatables();
        return false;
      }

      $(".dataTables_wrapper").remove();

      isi =
        "<table id='example1' class='table table-bordered table-hover'> <thead class='bg-gray-dark'> <tr> <th>No.</th> <th>Nama</th> <th>NIK</th> <th>Nominal</th>  <th>Aksi</th></tr> </thead> <tbody>";

      splitId = id.split("_");

      $.each(data.pegawai, function (key, value, index) {
        isi +=
          "<tr class='" +
          splitId[0] +
          "-" +
          splitId[1] +
          "' id='" +
          value["id"] +
          "'> <td>" +
          ++key +
          "</td> <td>" +
          value["nama"] +
          "</td> <td>" +
          value["nik"] +
          "</td> <td class='nominal'>" +
          value["nominal"] +
          "</td> <td> <button type='button' class='btn btn-sm btn-warning btn-edit-tabel'> <i class='fas fa-fw fa-edit'></i> Edit </button> <form action='/admin/" +
          id.replace("_", "/") +
          "/" +
          value["id"] +
          "' class='d-inline form_delete' method='post'> <input type='hidden' name='_method' value='DELETE'> <button type='button' class='btn btn-sm  btn-danger'> <i class='fas fa-fw fa-trash'></i> Delete </button> </form> </td> </tr>";
      });

      isi += "</tbody> </table>";

      $("#" + id).append(isi);

      formatNominal();
      formatDatatables();
      editDataTabel();
      deleteDataTabel();

      return false;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
    },
    async: false,
  });
});
//
// export payroll
$(".export").click(function () {
  id = $(this).attr("id");

  if (id == "Gaji") {
    $.ajax({
      url: "/admin/payroll/exportGaji",
      type: "POST",
      datatype: "JSON",
      data: {
        token: $(`input[name=${csrf_name}]`).val(),
        bulan: $("#bulan").val(),
        tahun: $("#tahun").val(),
      },
      beforeSend: function () {},
      success: function (data) {
        $(`input[name=${csrf_name}]`).val(data[csrf_name]);

        $.ajax({
          url: "/DaftarGaji.xlsx",
          method: "GET",
          xhrFields: {
            responseType: "blob",
          },
          success: function (data) {
            var a = document.createElement("a");
            var url = window.URL.createObjectURL(data);
            a.href = url;
            a.download = "Data Payroll xxx" + ".xlsx";
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
          },
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      },
      async: false,
    });
  } else {
    $.ajax({
      url: "/admin/payroll/exportPajak",
      type: "POST",
      datatype: "JSON",
      data: {
        token: $(`input[name=${csrf_name}]`).val(),
      },
      beforeSend: function () {},
      success: function (data) {
        $(`input[name=${csrf_name}]`).val(data[csrf_name]);

        $.ajax({
          url: "/DataPajak.xlsx",
          method: "GET",
          xhrFields: {
            responseType: "blob",
          },
          success: function (data) {
            var a = document.createElement("a");
            var url = window.URL.createObjectURL(data);
            a.href = url;
            a.download = "Pajak PPH" + ".xlsx";
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
          },
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      },
      async: false,
    });
  }
});
//
