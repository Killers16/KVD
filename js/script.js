function changeMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
}
function change() {
    var elem = document.getElementById("Mode");
    if (elem.value == "Night Mode") elem.value = "Light Mode";
    else elem.value = "Night Mode";
}
function Validation_certificate() {
    if (document.getElementById("ce_name").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ievadīti dati par izglitību!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("ce_code").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ievadīts kods!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    const textarea = document.querySelector('textarea')
    textarea.onchange = (e) => {
    if (document.getElementById("ce_items").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ievadīts priekšmets!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }}
    if (document.getElementById("ce_years").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ievadīts iestāšanas gads!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
}
function Validation_remark() {
    const textarea = document.querySelector('textarea')
    textarea.onchange = (e) => {
    if (document.getElementById("r_stud").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav izvelēts Students!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }}
    if (document.getElementById("r_name").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīta piezīme!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
}
function Validation_students() {
    if (document.getElementById("fname").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts Vārds!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("lname").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts Uzvārds!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("code").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts Personas kods!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("course").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav izvelēts Kurss!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("profession").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav izvelēta Professija !',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("year").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts iestāšanas gads!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }

    if (document.getElementById("phones").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts telefona numurs!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
    if (document.getElementById("lastSchools").value.trim() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Kļūda!',
            html: 'Nav ierakstīts iepriekšejā macību vieta!',
            showCloseButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
        return false;
    }
}
function passcode (element) {
 code = document.getElementById("code");
    code = code.value.split(' - ').join('');

    let finalVal = code.match(/.{1,6}/g).join(' - ');
    document.getElementById("code").value = finalVal;
}
function c_code (element) {
    $(document).ready(function() {
        $("#ce_code").keyup(function(){
            if ($(this).val().length == 4){
                $(this).val($(this).val() + "/");
            }
        });
    });

}
