const headerLogo = document.querySelector("#headerLogo");

const handleHeaderLogoClick = () => {
    window.location.href = "/";
};

const pageStart = () => {
    console.debug("pageStart1");

    headerLogo.addEventListener("click", handleHeaderLogoClick);
};

window.onload = (event) => {
    pageStart();
};
