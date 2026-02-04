
const stripe = Stripe(document.head.querySelector('meta[name="stripe-key"]').content);
const cardElements = {};

function pagarGasto(gastoId) {

    if(!cardElements[gastoId]) {
        const style = {
            base: {
                color: '#2E6C6F',
                fontSize: '16px',
                fontFamily: 'Inter, system-ui, sans-serif',
                '::placeholder': { color: '#c0a0aa' },
                padding: '10px 12px'
            },
            invalid: { color: '#E53E3E' }
        };

        const elements = stripe.elements();
        const card = elements.create("card", { style });
        card.mount(`#card-element-${gastoId}`);
        cardElements[gastoId] = card;
    }

    const card = cardElements[gastoId];

    fetch(`/pago/iniciar/${gastoId}`, {
        method: 'POST',
        headers: { 
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(async data => {
        const { clientSecret } = data;

        const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: { card }
        });

        if(error) {
            alert(error.message);
        } else if(paymentIntent.status === 'succeeded') {
            fetch(`/marcar-pagado/${gastoId}`, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                alert('Pago completado!');
                location.reload();
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[id^="card-element-"]').forEach(el => {
        const gastoId = el.id.split('-').pop();
        
        if(!cardElements[gastoId]) {
            const style = {
                base: {
                    color: '#2E6C6F',
                    fontSize: '16px',
                    fontFamily: 'Inter, system-ui, sans-serif',
                    '::placeholder': { color: '#A0AEC0' },
                    padding: '10px 12px'
                },
                invalid: { color: '#E53E3E' }
            };
            const elements = stripe.elements();
            const card = elements.create("card", { style });
            card.mount(`#card-element-${gastoId}`);
            cardElements[gastoId] = card;
        }
    });
});
