const stripeKeys = JSON.parse(document.getElementById("stripe-keys").innerText);
const stripe = Stripe(stripeKeys.stripe_pub_key);

const stripeElements = stripe.elements({
    clientSecret: stripeKeys.setup_intent_secret,
});

const paymentElement = stripeElements.create("payment");
paymentElement.mount("#setup-element");

const form = document.querySelector("#setup-form");
const submitButton = form.querySelector("button[type=submit]");
submitButton.addEventListener("click", handleSubmit);

async function handleSubmit(e) {
    e.preventDefault();
    e.stopPropagation();
    submitButton.setAttribute("disabled", true);

    const { setupIntent, error } = await stripe
        .confirmSetup({
            elements: stripeElements,
            redirect: "if_required",
            confirmParams: {
                return_url:
                    "https://example.com/account/payments/setup-complete",
            },
        })
        .finally(() => {
            submitButton.removeAttribute("disabled");
        });

    if (error) {
        // This point will only be reached if there is an immediate error when
        // confirming the payment. Show error to your customer (for example, payment
        // details incomplete)
        return alert(error.message);
    }
    console.log("confirmSetup return:", setupIntent);

    const pmInput = document.createElement("input");
    pmInput.type = "hidden";
    pmInput.name = "new_pm_id";
    pmInput.value = setupIntent.payment_method;
    form.append(pmInput);
    form.submit();
}
