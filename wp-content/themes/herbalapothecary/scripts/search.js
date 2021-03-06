const search = Array.from(document.getElementsByClassName("c-search"));

search.forEach(s => {
    const submit = s.getElementsByClassName("search-submit")[0];
    const category = s.getElementsByClassName("search-category")[0];
    const text = s.getElementsByClassName("search-text")[0];

    let params = new URLSearchParams(window.location.search);
    for (const [key, value] of params.entries()) {
        if (key == "s") {
            text.value = value;
        }
    }


    submit.addEventListener("click", (e) => {
        e.preventDefault();
        let categoryText = category && category.value ? "&product_cat=" + category.value : "";
        let query = `?s=${text.value}&post_type=product${categoryText}`;
        window.location.href = window.location.protocol + "//" + window.location.host + "/" + query;
    })
});

document.addEventListener("keydown", (e) => {
    if (e.key == "Enter") {
        e.target.click();
    }
})

let searchButtons = Array.from(document.getElementsByClassName("wc-block-product-search__button"));
searchButtons.forEach(b => {
    console.log(b);
    b.setAttribute("aria-label", "Search");
});


const quantities = Array.from(document.getElementsByClassName("c-quantity"));

quantities.forEach(q => {
    const minus = q.getElementsByClassName("minus")[0];
    const plus = q.getElementsByClassName("plus")[0];
    const input = q.getElementsByClassName("input-text")[0];

    function increment() {
        let currentValue = parseInt(input.value);
        if (!currentValue || currentValue == "NaN") {
            input.value = 1;
            currentValue = 1;
        } else {
            // input.value = currentValue + 1;
        }
        console.log("Max:", typeof parseInt(input.max), parseInt(input.max));
        if (typeof parseInt(input.max) == "number" && parseInt(input.max) > 0) {
            if (currentValue < parseInt(input.max)) {
                input.value = currentValue + 1;
            }
        } else {
            input.value = currentValue + 1;
        }
    }

    function decrement() {
        let currentValue = parseInt(input.value);
        if (currentValue > parseInt(input.min) && currentValue > 0) {
            input.value = parseInt(input.value) - 1;
        }
    }

    minus.addEventListener("click", decrement);
    plus.addEventListener("click", increment);
})
