let targetForm = null

document.querySelectorAll('.button-delete-user').forEach(button => {
    button.addEventListener('click', function () {
        targetForm = this.closest('form')
    })
})

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (targetForm) targetForm.submit()
})