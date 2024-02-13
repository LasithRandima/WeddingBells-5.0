    const progress = document.querySelector(".progress-done");
    const inputs = document.querySelector(".inputs");
    const maxInput=document.querySelector(".maxInput");
    let finalValue = 0;
    let max = 0;


    function changeWidth(){
        progress.style.width = `${(finalValue / max) * 100}% `;
        progress.innerText = `${Math.ceil((finalValue / max) * 100)}%`;
    }

    inputs.addEventListener("keyup", function () {
        finalValue = parseInt(inputs.value, 10);
        changeWidth();
    });

    maxInput.addEventListener("keyup", function () {
        max = parseInt(maxInput.value, 10);
    });