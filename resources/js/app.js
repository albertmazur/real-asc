import './bootstrap'

let countTickets = document.getElementById('countTickets')
if(countTickets !== null && countTickets !== 'undefined'){
    countTickets.addEventListener('input', (e) => {
        let price = parseFloat(document.getElementById('priceEvent').textContent)
        let sumPrice = parseInt(e.target.value)*price
        document.getElementById('sumPrice').textContent = sumPrice.toFixed(2)
    })
}

let reportButton = document.querySelectorAll('.reportButton')
if(reportButton !== null && reportButton !== 'undefined'){
    reportButton.forEach(element => {
        element.addEventListener('click', (e) => {
            document.getElementById('registrationComment').style.display = 'block'
            document.getElementById('comment_id').value = e.target.value
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