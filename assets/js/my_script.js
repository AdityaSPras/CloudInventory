const userFlashSuccess = $('.user-flash-success').data('flashdata');
const userFlashWarning = $('.user-flash-warning').data('flashdata');
const userFlashError = $('.user-flash-error').data('flashdata');

if (userFlashSuccess) {
    Swal.fire({
        icon: 'success',
        title: userFlashSuccess,
        showConfirmButton: true,
      })
}

if (userFlashWarning) {
    Swal.fire({
        icon: 'warning',
        title: userFlashWarning,
        showConfirmButton: true,
      })
}

if (userFlashError) {
    Swal.fire({
        icon: 'error',
        title: userFlashError,
        showConfirmButton: true,
      })
}

function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}


function fileIsValid(fileName) {
    var ext = fileName.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    var isValid = true;
    switch (ext) {
        case 'png':
        case 'jpeg':
        case 'jpg':

            break;
        default:
            this.value = '';
            isValid = false;
    }
    return isValid;
}

function VerifyFileNameAndFileSize() {
    var file = document.getElementById('GetFile').files[0];


    if (file != null) {
        var fileName = file.name;
        if (fileIsValid(fileName) == false) {
            validasi('Format File Bukan Gambar!', 'warning');
            document.getElementById('GetFile').value = null;
            return false;
        }
        var ext = fileName.match(/\.([^\.]+)$/)[1];
        ext = ext.toLowerCase();
        $(".custom-file-label").addClass("selected").html(file.name);
        document.getElementById('outputImg').src = window.URL.createObjectURL(file);
        return true;

    } else
        return false;
}