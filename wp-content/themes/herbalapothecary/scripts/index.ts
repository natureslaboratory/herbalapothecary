import "./search";
// import "./customizer";

const nav = document.getElementById("primary-menu");
const subMenus = Array.from((nav.getElementsByClassName("sub-menu") as HTMLCollectionOf<HTMLElement>));

class SubMenu {
    node: HTMLElement;
    innerWrapper: HTMLElement;
    arrowWrapper: HTMLElement;
    arrow: Arrow;
    get isOpen() {
        return this.innerWrapper.style.maxHeight ? true : false;
    }
    get isMobile() {
        return window.innerWidth < 993 ? true : false;
    }

    /** Pass in the sub-menu element */
    constructor(subMenuNode: HTMLElement) {
        this.node = subMenuNode;

        this.arrangeNodes();

        if (!this.arrowWrapper) {
            return;
        }

        this.arrowWrapper.addEventListener("click", () => {
            if (this.isOpen) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        })
    }

    arrangeNodes() {
        const subMenuParent = this.node.parentElement;
        const outerWrapper = document.createElement("div");
        outerWrapper.className = "sub-menu-outer-wrapper";
        this.innerWrapper = document.createElement("div");
        this.innerWrapper.className = "sub-menu-inner-wrapper";

        const arrow = document.createElement("i");
        arrow.className = "fas fa-chevron-down";

        this.arrowWrapper = document.createElement("div");
        this.arrowWrapper.className = "arrow-wrapper";
        this.arrowWrapper.appendChild(arrow)

        const linkWrapper = document.createElement("div");
        linkWrapper.className = "link-wrapper";
        const link = subMenuParent.firstChild;
        linkWrapper.appendChild(link);
        linkWrapper.appendChild(this.arrowWrapper);
        subMenuParent.appendChild(linkWrapper);

        subMenuParent.appendChild(outerWrapper);
        outerWrapper.appendChild(this.innerWrapper);
        this.innerWrapper.appendChild(this.node);

        this.arrow = new Arrow(arrow);
    }

    openMenu() {
        if (this.innerWrapper && this.isMobile) {
            this.innerWrapper.style.maxHeight = `${this.node.offsetHeight}px`;
            this.arrow.spin()
        }
    }

    closeMenu() {
        if (this.innerWrapper) {
            this.innerWrapper.style.maxHeight = null;
            this.arrow.unspin();
        }
    }
}

class Arrow {
    node: HTMLElement;

    constructor(node: HTMLElement) {
        this.node = node;
    }

    spin() {
        this.node.style.transform = "rotate(180deg)";
    }

    unspin() {
        this.node.style.transform = null;
    }
}

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




