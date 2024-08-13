const inputs = document.querySelectorAll("input"),
      button = document.querySelector("button");

inputs.forEach((input, indexOne) => {
    input.addEventListener("keyup", (e) => {
        const currentInput = input,
        nextInput = input.nextElementSibling,
        prevInput = input.previousElementSibling;

        if(currentInput.value.length > 1){
            currentInput.value = "";
            return;
        }

        if(nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== ""){
            nextInput.removeAttribute("disabled");
            nextInput.focus();
        }

        if(e.key === "Backspace"){
            inputs.forEach((input, indexTwo) => {
                if(indexOne <= indexTwo && prevInput){
                    input.setAttribute("disabled", true);
                    currentInput.value = "";
                    prevInput.focus();
                }
            })
        }

        if(!inputs[0].disabled && inputs[5].value !== ""){
            button.classList.add("active");
            return;
        }
        button.classList.remove("active");
    })
});

window.addEventListener("load", () => inputs[0].focus());