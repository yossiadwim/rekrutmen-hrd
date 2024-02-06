
document.addEventListener('trix-file-accept', function (e) {
    e.preventDefault();
});

function hapusData() {
    document.getElementById("formDeskripsiDiri").reset();
    document.getElementById("formPengalamanKerja").reset();
    document.getElementById("formPendidikan").reset();
    document.getElementById("formReferensi").reset();
    document.getElementById("formEditProfil").reset();
    $('#kabupaten').html("");
    $('#kabupaten').append($('<option>', {
        class: 'kabupaten-list',
        value: "",
        text: "Kabupaten/Kota"
    }));


}

var button_check_reference = document.getElementById('button-check-reference');

button_check_reference.addEventListener("click", function () {
    if (button_check_reference.checked) {
        document.getElementById('div-posisi').hidden = false;

    } else {
        document.getElementById('div-posisi').hidden = true;
    }
})


window.addEventListener("load", function () {
    const loader = document.querySelector(".loader-wrapper");
    const content = document.querySelector(".content");

    // Hide the loader
    loader.style.display = "none";

    // Show the content
    // content.style.display = "block";
});

document.getElementById('submit-form').addEventListener('click', function () {
    const loader = document.getElementById('loader');
    const form = document.getElementById('formEditProfil');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

        // Close the modal
        $('#editProfil').modal('hide');

        // Reset the form (optional)
        form.reset();
    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});

document.getElementById('submit-form-deskripsi').addEventListener('click', function () {
    const loader = document.getElementById('loader');
    const form = document.getElementById('formDeskripsiDiri');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

        // Close the modal
        $('#deskripsiModal').modal('hide');

        // Reset the form (optional)
        form.reset();
    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});

document.getElementById('submit-button-pengalaman-kerja').addEventListener('click', function () {
    const loader = document.getElementById('loader');
    const form = document.getElementById('formPengalamanKerja');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

        // Close the modal
        $('#pengalamanKerja').modal('hide');

        // Reset the form (optional)
        form.reset();
    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});



document.addEventListener('DOMContentLoaded', function () {
    // Replace 'your_id_here' with the dynamic ID you want to use
    const elements_edit = document.getElementsByClassName("btn-edit");
    const elements_delete = document.getElementsByClassName("btn-delete");


    for (let index = 0; index < elements_edit.length; index++) {
        const edit = elements_edit[index].value;
        getID(edit);
    }

    for (let index = 0; index < elements_delete.length; index++) {
        const deletes = elements_delete[index].value;
    
        getID(deletes);
    }


});

function getID(id) {
    // Use the 'id' parameter to create the dynamic button ID
    var button = document.getElementById('submit-button-edit-pengalaman-kerja-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');
            const form = document.getElementById('formPengalamanKerja');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

                form.reset();
            }, 2500);
        });
    }

    var button = document.getElementById('submit-button-delete-pengalaman-kerja-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');
            const form = document.getElementById('formPengalamanKerja');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

                // Close the modal
                // $('#pengalamanKerja').modal('hide');

                // Reset the form (optional)
                form.reset();
            }, 2500);
        });
    }

    var button = document.getElementById('submit-button-edit-pendidikan-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

            }, 2500);
        });
    }

    var button = document.getElementById('submit-button-delete-pendidikan-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

            }, 2500);
        });
    }

    var button = document.getElementById('submit-button-edit-referensi-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

            }, 2500);
        });
    }

    var button = document.getElementById('submit-button-delete-referensi-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

            }, 2500);
        });
    }

}

document.getElementById('submit-button-pendidikan').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});

document.getElementById('submit-button-referensi').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});





var jenjang_pendidikan = document.getElementById('jenjangPendidikan')
jenjang_pendidikan.addEventListener("click", function () {
    console.log(jenjang_pendidikan.checked)

})

