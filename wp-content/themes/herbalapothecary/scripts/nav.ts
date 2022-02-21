import SubMenu from "./classes/SubMenu";

const nav = document.getElementById("primary-menu");
const subMenus = Array.from((nav.getElementsByClassName("sub-menu") as HTMLCollectionOf<HTMLElement>));

const subMenuInstances = subMenus.map(m => new SubMenu(m));

window.addEventListener("resize", () => {
    subMenuInstances.forEach(m => m.closeMenu());
})

const siteNav = document.getElementById("site-navigation");
const button = siteNav.getElementsByClassName("menu-toggle")[0];
const menu = siteNav.getElementsByClassName("c-navigation__menu")[0];
const overlay = siteNav.getElementsByClassName("c-navigation__overlay")[0];

button.addEventListener("click", () => {
    if (menu.classList.contains("show")) {
        siteNav.classList.remove("show");
        siteNav.tabIndex = -1;
    } else {
        siteNav.classList.add("show");
        siteNav.tabIndex = 1;
    }
})

overlay.addEventListener("click", () => {
    siteNav.classList.remove("show");
    subMenuInstances.forEach(m => m.closeMenu());
})
