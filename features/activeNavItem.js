const HREF = window.location.href;
const PAGE = HREF.substr(HREF.lastIndexOf("/") + 1);
if (PAGE) {
  const NAV_ITEM_ACTIVE = document.querySelector(
    `.custom-navbar-nav li .nav-link[href="${PAGE}"]`
  );
  NAV_ITEM_ACTIVE?.parentNode.classList.add("active");
} else {
  const NAV_ITEM_ACTIVE = document.querySelector(
    `.custom-navbar-nav .nav-item`
  );
  NAV_ITEM_ACTIVE.classList.add("active");
}

const HEADER = document.querySelector("nav");
const CONTENT = document.querySelector(".content");
const HEADER_HEIGHT = HEADER.clientHeight;
CONTENT.style.marginTop = HEADER_HEIGHT + "px";
