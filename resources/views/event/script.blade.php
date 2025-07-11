<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}", {
        locale: 'pl'
    })

    async function setupStripe(){
        const elements = stripe.elements()
        const cardNumber = elements.create('cardNumber')
        const cardExpiry = elements.create('cardExpiry')
        const cardCvc = elements.create('cardCvc')

        cardNumber.mount('#card-number')
        cardExpiry.mount('#card-expiry')
        cardCvc.mount('#card-cvc')

        const form = document.getElementById('payment-form')
        const submitButton = form.querySelector('button[type='submit']')

        form.addEventListener('submit', async function(event) {
            event.preventDefault()

            submitButton.disabled = true
            const originalText = submitButton.innerHTML
            submitButton.innerHTML = @json(__('stripe.processing_payment'))

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: "card",
                card: cardNumber,
            })

            if (error) {
                showErrorAlert(error.message)
                submitButton.disabled = false
                submitButton.innerHTML = originalText
                return
            }

            let formData = new FormData(form)
            formData.append("payment_method", paymentMethod.id)

            fetch("{{ route('ticket.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('ticket.payment.status') }}"
                } else {
                    showErrorAlert(data.error)
                }
            })
            .catch(error => {
                showErrorAlert(error.message)
                submitButton.disabled = false
                submitButton.innerHTML = originalText
            })
        })
    }
    setupStripe()
</script>