// const alert = document.querySelector('.alert');
// setTimeout(() => {
//     alert.classList.add("d-none");
// }, 1300);

const success = $('.flash-success').data('success');
const wrong = $('.flash-wrong').data('wrong');
const warning = $('.flash-warning').data('warning');

let Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

if (success) {
    Toast.fire({
        title: success,
        icon: 'success'
    });
}
if (wrong) {
    Toast.fire({
        title: wrong,
        icon: 'error'
    });
}
if (warning) {

    Toast.fire({
        title: warning,
        icon: 'warning'
    });
}