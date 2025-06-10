import './bootstrap'

let countTickets = document.getElementById('countTickets')
if(countTickets !== null && countTickets !== 'undefined'){
    countTickets.addEventListener('input', (e) => {
        let price = parseFloat(document.getElementById('priceEvent').textContent)
        let sumPrice = parseInt(e.target.value)*price
        document.getElementById('sumPrice').textContent = sumPrice.toFixed(2)
    })
}

let reportButtons = document.querySelectorAll('.reportButton')
console.log(reportButtons.length)
if(reportButtons !== null && reportButtons !== 'undefined'){
    reportButtons.forEach(element => {
        element.addEventListener('click', (e) => {
            let registrationComment = document.getElementById('registrationComment')
            if(registrationComment !== null && registrationComment !== 'undefined'){
                registrationComment.classList.remove('d-none')
                document.getElementById('comment_id').value = e.target.value
            }
        })
    })
}

window.showErrorAlert = function(message) {
    let mainElement = document.querySelector('main')

    let alertDiv = document.createElement('div')
    alertDiv.className = 'alert alert-danger alert-dismissible fade show my-3'
    alertDiv.role = 'alert'
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `

    mainElement.insertBefore(alertDiv, mainElement.firstChild)
}
