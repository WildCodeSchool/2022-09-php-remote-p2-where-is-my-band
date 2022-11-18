const form = document.getElementById('form-search');

const selects = form.querySelectorAll('select');
for (select of selects) {
    select.addEventListener('change', () => {
        form.submit();
    });
}
