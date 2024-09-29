
function generateCalendar() {
    const calendar = document.getElementById('calendar');
    const monthDisplay = document.getElementById('month');
    const daysContainer = document.getElementById('days');

    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth();

    // Set month name
    monthDisplay.textContent = date.toLocaleString('default', { month: 'long', year: 'numeric' });

    // Clear previous days
    daysContainer.innerHTML = '';

    // Get the first day of the month and the total number of days
    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    // Add empty cells for days of the previous month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement('div');
        daysContainer.appendChild(emptyCell);
    }

    // Add the days of the current month
    for (let day = 1; day <= totalDays; day++) {
        const dayCell = document.createElement('div');
        dayCell.className = 'day';
        dayCell.textContent = day;

        // Highlight current day
        if (day === date.getDate() && month === date.getMonth() && year === date.getFullYear()) {
            dayCell.classList.add('current-day');
        }

        daysContainer.appendChild(dayCell);
    }
}

// Generate the calendar on page load
window.onload = generateCalendar;