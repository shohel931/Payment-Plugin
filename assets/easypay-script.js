   function copyNumber() {
        const number = document.getElementById("bkashNumber").textContent.trim();
        navigator.clipboard.writeText(number).then(() => {
            alert("Number Copied: " + number);
        })
    }

// Time 
let timeLeft = 15 * 60;

function startCountdown() {
    const timer = setInterval(() => {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("timeBox").innerText = `${minutes} : ${seconds} min`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.replace("https://shohelrana.top/");
        }

        timeLeft--;
    }, 1000);
}

startCountdown();