import "./search";
// import "./customizer";

const nav = document.getElementById("primary-menu");
const subMenus = Array.from(nav.getElementsByClassName("sub-menu"));

subMenus.forEach(m => {
    const subMenuParent = m.parentElement;
    const outerWrapper = document.createElement("div");
    outerWrapper.classList = "sub-menu-outer-wrapper";
    const innerWrapper = document.createElement("div");
    innerWrapper.classList = "sub-menu-inner-wrapper";
    subMenuParent.appendChild(outerWrapper);
    outerWrapper.appendChild(innerWrapper);
    innerWrapper.appendChild(m);
})