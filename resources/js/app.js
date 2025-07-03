import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleButton');
    const dropdown = document.getElementById('dropdownWrapper');

    toggleBtn.addEventListener('click', function () {
        dropdown.classList.toggle('hidden');
    });
});
const toggleButton = document.getElementById('toggleButton');
const dropdownWrapper = document.getElementById('dropdownWrapper');
const submitBtn = document.getElementById('submitBtn');
const selectCoach = document.getElementById('coach_id');


selectCoach.addEventListener('change', () => {
    if (selectCoach.value) {
        submitBtn.classList.remove('hidden');
    } else {
        submitBtn.classList.add('hidden');
    }
});
