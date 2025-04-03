let isHidden = false;

export function toggleBtn() {
    const contain = document.querySelector('.inner-container');
    const container = document.querySelector('.container');
    const mediaQuery = window.matchMedia("(orientation: portrait)");

    function updateButton(e){
        if (e.matches){
            if (isHidden) {
                contain.style.transform = 'translateY(-400px)';
                container.style.height = "80%";
                
            } else {
                contain.style.transform = 'translateY(0)';
                container.style.height = "450px";
            }
        }else{
            if (isHidden) {
                contain.style.transform = 'translate(550px, -6px)';
                //container.style.height = "80%";
                
            } else {
                contain.style.transform = 'translate(131px, -6px)';
                container.style.height = "450px";
            }
        }
    }

    isHidden = !isHidden;
    updateButton(mediaQuery);
    mediaQuery.addEventListener("change", updateButton);
}

