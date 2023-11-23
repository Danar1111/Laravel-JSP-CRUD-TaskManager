document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#due_date", {
        enableTime: true, // Mengaktifkan pilihan waktu
        dateFormat: "Y-m-d H:i:S", // Format tanggal dan waktu (format 24 jam)
    });
});

function getCurrentDate() {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date();
    return today.toLocaleDateString(undefined, options);
}

$(document).ready(function() {
    const currentDate = getCurrentDate();
    $('.date-container').text(currentDate);
});

const calendarBody = document.getElementById('calendar-body');
const currentDate = new Date();
const currentMonth = currentDate.getMonth();
const currentYear = currentDate.getFullYear();
const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

// Mengisi sel-sel kosong sebelum tanggal 1
for (let i = 0; i < firstDayOfMonth; i++) {
    const emptyCell = document.createElement('td');
    calendarBody.appendChild(emptyCell);
}

for (let day = 1; day <= daysInMonth; day++) {
    const date = new Date(currentYear, currentMonth, day);
    const cell = document.createElement('td');
    cell.textContent = day;

    if (date.getDate() === currentDate.getDate() && date.getMonth() === currentDate.getMonth() && date.getFullYear() === currentDate.getFullYear()) {
        cell.classList.add('highlight');
    }

    calendarBody.appendChild(cell);

    if (date.getDay() === 6) {
        const newRow = document.createElement('tr');
        calendarBody.appendChild(newRow);
    }
}

// Mengisi sel-sel kosong di akhir tabel (jika diperlukan)
const remainingEmptyCells = 6 - (new Date(currentYear, currentMonth, daysInMonth).getDay());
for (let i = 0; i < remainingEmptyCells; i++) {
    const emptyCell = document.createElement('td');
    calendarBody.appendChild(emptyCell);
}


const quotes = [
    "Success is not final, failure is not fatal: It is the courage to continue that counts. - Winston Churchill",
    "Don't watch the clock; do what it does. Keep going. - Sam Levenson",
    "Believe you can and you're halfway there. - Theodore Roosevelt",
    "Your attitude, not your aptitude, will determine your altitude. - Zig Ziglar",
    "The way to get started is to quit talking and begin doing. - Walt Disney",
    "Don't let yesterday take up too much of today. - Will Rogers",
    "The future belongs to those who believe in the beauty of their dreams. - Eleanor Roosevelt",
    "It's not whether you get knocked down, it's whether you get up. - Vince Lombardi",
    "Believe in yourself and all that you are. Know that there is something inside you that is greater than any obstacle. - Christian D. Larson",
    "Success is to be measured not so much by the position that one has reached in life as by the obstacles which he has overcome. - Booker T. Washington",
    "The only limit to our realization of tomorrow will be our doubts of today. - Franklin D. Roosevelt",
    "Do not wait to strike till the iron is hot, but make it hot by striking. - William Butler Yeats",
    "Don’t be afraid to give up the good to go for the great. - John D. Rockefeller",
    "Your time is limited, don't waste it living someone else's life. - Steve Jobs",
    "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful. - Albert Schweitzer",
    "The only way to achieve the impossible is to believe it is possible. - Charles Kingsleigh",
    "Act as if what you do makes a difference. It does. - William James",
    "Life is 10% what happens to us and 90% how we react to it. - Charles R. Swindoll",
    "The best way to predict the future is to invent it. - Alan Kay",
    "I find that the harder I work, the more luck I seem to have. - Thomas Jefferson",
    "Set your goals high, and don't stop till you get there. - Bo Jackson",
    "Don’t watch the clock; do what it does. Keep going. - Sam Levenson",
    "Do not wait for leaders; do it alone, person to person. - Mother Teresa",
    "Education is the passport to the future, for tomorrow belongs to those who prepare for it today. - Malcolm X",
    "The only way to do great work is to love what you do. - Steve Jobs",
    "Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work. - Steve Jobs",
    "Start where you are. Use what you have. Do what you can. - Arthur Ashe",
    "It does not matter how slowly you go as long as you do not stop. - Confucius",
    "Success is not in what you have, but who you are. - Bo Bennett",
    "Your positive action combined with positive thinking results in success. - Shiv Khera",
    "Believe in yourself, take on your challenges, dig deep within yourself to conquer fears. - Chantal Sutherland",
    "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful. - Albert Schweitzer",
    "I am not a product of my circumstances. I am a product of my decisions. - Stephen R. Covey",
    "Your life does not get better by chance, it gets better by change. - Jim Rohn",
    "The only way to achieve the impossible is to believe it is possible. - Charles Kingsleigh",
    "Don’t be pushed around by the fears in your mind. Be led by the dreams in your heart. - Roy T. Bennett",
    "You are never too old to set another goal or to dream a new dream. - C.S. Lewis",
    "Success is not final, failure is not fatal: It is the courage to continue that counts. - Winston Churchill",
    "Do not wait to strike till the iron is hot, but make it hot by striking. - William Butler Yeats",
    "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful. - Albert Schweitzer",
    "The only limit to our realization of tomorrow will be our doubts of today. - Franklin D. Roosevelt",
    "The only way to do great work is to love what you do. - Steve Jobs",
    "Don’t watch the clock; do what it does. Keep going. - Sam Levenson",
    "Do not wait for leaders; do it alone, person to person. - Mother Teresa",
    "Education is the passport to the future, for tomorrow belongs to those who prepare for it today. - Malcolm X",
    "Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work. - Steve Jobs",
    "Start where you are. Use what you have. Do what you can. - Arthur Ashe",
    "It does not matter how slowly you go as long as you do not stop. - Confucius",
    "Success is not in what you have, but who you are. - Bo Bennett",
    "Your positive action combined with positive thinking results in success. - Shiv Khera",
    "Believe in yourself, take on your challenges, dig deep within yourself to conquer fears. - Chantal Sutherland",
    "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful. - Albert Schweitzer",
    "I am not a product of my circumstances. I am a product of my decisions. - Stephen R. Covey",
    "Your life does not get better by chance, it gets better by change. - Jim Rohn",
    "The only way to achieve the impossible is to believe it is possible. - Charles Kingsleigh",
    "Don’t be pushed around by the fears in your mind. Be led by the dreams in your heart. - Roy T. Bennett",
    "You are never too old to set another goal or to dream a new dream. - C.S. Lewis"
];


const quoteElement = document.getElementById('quote');
const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
quoteElement.textContent = randomQuote;