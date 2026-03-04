// deal of the day products timer script

document.addEventListener("DOMContentLoaded", function () {
  const countdowns = document.querySelectorAll("[data-countdown]");

  countdowns.forEach(function (countdown) {
    const targetDate = new Date(countdown.getAttribute("data-date")).getTime();

    const daysEl = countdown.querySelector("[data-days]");
    const hoursEl = countdown.querySelector("[data-hours]");
    const minutesEl = countdown.querySelector("[data-minutes]");
    const secondsEl = countdown.querySelector("[data-seconds]");

    if (!targetDate) return;

    const interval = setInterval(function () {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance <= 0) {
        clearInterval(interval);

        daysEl.textContent = "0";
        hoursEl.textContent = "0";
        minutesEl.textContent = "0";
        secondsEl.textContent = "0";

        // Optional: show expired message
        countdown.innerHTML = "<strong>Deal Expired</strong>";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((distance / (1000 * 60)) % 60);
      const seconds = Math.floor((distance / 1000) % 60);

      daysEl.textContent = days;
      hoursEl.textContent = hours;
      minutesEl.textContent = minutes;
      secondsEl.textContent = seconds;
    }, 1000);
  });
});
