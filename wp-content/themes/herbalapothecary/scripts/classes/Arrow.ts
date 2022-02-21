export default class Arrow {
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