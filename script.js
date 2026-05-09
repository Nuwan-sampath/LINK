function handleSearch() {
    const service = document.querySelector('.search-input input[placeholder="Plumbing"]').value;
    const city = document.querySelector('.search-input input[placeholder="City"]').value;

    if(city === "") {
        alert("Please enter a city to find services!");
    } else {
        console.log(`Searching for ${service || 'General Services'} in ${city}...`);
        alert(`Searching for experts in ${city}!`);
    }
}


// Toggle Mobile Menu
const menuToggle = document.getElementById('mobile-menu');
const navList = document.getElementById('nav-list');

menuToggle.addEventListener('click', () => {
    navList.classList.toggle('active');
    
    // Optional: Switch icon between bars and 'X'
    const icon = menuToggle.querySelector('i');
    if (navList.classList.contains('active')) {
        icon.classList.replace('fa-bars', 'fa-times');
    } else {
        icon.classList.replace('fa-times', 'fa-bars');
    }
});

// Close menu when a link is clicked
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navList.classList.remove('active');
    });
});

// Existing Search Logic
function handleSearch() {
    const city = document.querySelector('.search-input input[placeholder="City"]').value;
    if(!city) {
        alert("Please enter a city!");
    } else {
        alert("Searching in " + city);
    }
}