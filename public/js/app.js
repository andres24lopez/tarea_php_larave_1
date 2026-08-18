document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmationMessage = form.dataset.confirm || '¿Está seguro de continuar?';

            if (!window.confirm(confirmationMessage)) {
                event.preventDefault();
            }
        });
    });
});
