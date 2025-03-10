<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ config('services.stripe.key') }}", {
        locale: 'pl'
    })

    async function setupStripe(){
        const response = await fetch("{{ route('ticket.create-payment-intent') }}")
        const { clientSecret } = await response.json()

        const elements = stripe.elements({ clientSecret})
        const cardNumber = elements.create("cardNumber")
        const cardExpiry = elements.create("cardExpiry")
        const cardCvc = elements.create("cardCvc")


        cardNumber.mount('#card-number')
        cardExpiry.mount('#card-expiry')
        cardCvc.mount('#card-cvc')
        document.getElementById("payment-form").addEventListener("submit", async function(event){
            event.preventDefault();
            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: { return_url: "{{ route('ticket.payment.status') }}" },
            });

            if (error) alert(error.message)
        });
    }
    setupStripe()
</script>