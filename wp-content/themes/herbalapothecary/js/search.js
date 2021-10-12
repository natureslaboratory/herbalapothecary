const search = Array.from(document.getElementsByClassName("c-search"));
console.log(search);

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
        console.log("hello");
        let categoryText = category && category.value ? "&product_cat=" + category.value : "";
        let query = `?s=${text.value}&post_type=product${categoryText}`;
        window.location.href = window.location.protocol + "//" + window.location.host + "/" + query;
    })
});


const nav = document.getElementById("site-navigation");
const button = nav.getElementsByClassName("menu-toggle")[0];
const menu = nav.getElementsByClassName("c-navigation__menu")[0];
const overlay = nav.getElementsByClassName("c-navigation__overlay")[0];

button.addEventListener("click", () => {
    console.log("click")
    if (menu.classList.contains("show")) {
        nav.classList.remove("show");
    } else {
        nav.classList.add("show");
    }
})

overlay.addEventListener("click", () => {
    nav.classList.remove("show");
})