!function(){"use strict";Array.from(document.getElementsByClassName("c-search")).forEach((e=>{const t=e.getElementsByClassName("search-submit")[0],a=e.getElementsByClassName("search-category")[0],s=e.getElementsByClassName("search-text")[0];let n=new URLSearchParams(window.location.search);for(const[e,t]of n.entries())"s"==e&&(s.value=t);t.addEventListener("click",(e=>{e.preventDefault();let t=a&&a.value?"&product_cat="+a.value:"",n=`?s=${s.value}&post_type=product${t}`;window.location.href=window.location.protocol+"//"+window.location.host+"/"+n}))}));const e=document.getElementById("site-navigation"),t=e.getElementsByClassName("menu-toggle")[0],a=e.getElementsByClassName("c-navigation__menu")[0],s=e.getElementsByClassName("c-navigation__overlay")[0];t.addEventListener("click",(()=>{a.classList.contains("show")?(e.classList.remove("show"),e.tabIndex=-1):(e.classList.add("show"),e.tabIndex=1)})),s.addEventListener("click",(()=>{e.classList.remove("show")})),document.addEventListener("keydown",(e=>{"Enter"==e.key&&e.target.click()})),Array.from(document.getElementsByClassName("wc-block-product-search__button")).forEach((e=>{console.log(e),e.setAttribute("aria-label","Search")}));Array.from(document.getElementsByClassName("c-quantity")).forEach((e=>{const t=e.getElementsByClassName("minus")[0],a=e.getElementsByClassName("plus")[0],s=e.getElementsByClassName("input-text")[0];t.addEventListener("click",(function(){let e=parseInt(s.value);e>parseInt(s.min)&&e>0&&(s.value=parseInt(s.value)-1)})),a.addEventListener("click",(function(){let e=parseInt(s.value);e&&"NaN"!=e||(s.value=1,e=1),console.log("Max: ",typeof parseInt(s.max),parseInt(s.max)),"number"==typeof parseInt(s.max)&&parseInt(s.max)>0?e<parseInt(s.max)&&(s.value=e+1):s.value=e+1}))}))}();
