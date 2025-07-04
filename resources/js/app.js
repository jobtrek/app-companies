import "./bootstrap";

//Change coach
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleButton');
    const dropdown = document.getElementById('dropdownWrapper');
    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener('click', function () {
            dropdown.classList.toggle('hidden');
        });
    }
    const submitBtn = document.getElementById('submitBtn');
    const selectCoach = document.getElementById('coach_id');
    if (selectCoach && submitBtn) {
        selectCoach.addEventListener('change', () => {
            if (selectCoach.value) {
                submitBtn.classList.remove('hidden');
            } else {
                submitBtn.classList.add('hidden');
            }
        });
    }
});

//Change entreprise
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtnEntreprise = document.getElementById('toggleButtonEntreprise');
    const dropdownEntreprise = document.getElementById('dropdownWrapperEntreprise');
    if (toggleBtnEntreprise && dropdownEntreprise) {
        toggleBtnEntreprise.addEventListener('click', function () {
            dropdownEntreprise.classList.toggle('hidden');
        });
    }
    const submitBtnEntreprise = document.getElementById('submitBtnEntreprise');
    const selectEntreprise = document.getElementById('entreprise_id');
    if (selectEntreprise && submitBtnEntreprise) {
        selectEntreprise.addEventListener('change', () => {
            if (selectEntreprise.value) {
                submitBtnEntreprise.classList.remove('hidden');
            } else {
                submitBtnEntreprise.classList.add('hidden');
            }
        });
    }
});

//Change app to entr at homepage
document.addEventListener("DOMContentLoaded", function () {
    const btnApprentis = document.getElementById("btn-apprentis");
    const btnEntreprises = document.getElementById("btn-entreprises");
    const sectionApprentis = document.getElementById("section-apprentis");
    const sectionEntreprises = document.getElementById("section-entreprises");
    const filters = document.getElementById("filters");

    btnApprentis.addEventListener("click", () => {
        sectionApprentis.classList.remove("hidden");
        sectionEntreprises.classList.add("hidden");
        filters.classList.remove("hidden");

        btnApprentis.classList.add(
            "border-blue-500",
            "text-blue-500",
            "bg-blue-100",
        );
        btnApprentis.classList.remove("border-gray-300", "text-gray-600");

        btnEntreprises.classList.add("border-gray-300", "text-gray-600");
        btnEntreprises.classList.remove(
            "border-blue-500",
            "text-blue-500",
            "bg-blue-100",
        );
    });

    btnEntreprises.addEventListener("click", () => {
        sectionEntreprises.classList.remove("hidden");
        sectionApprentis.classList.add("hidden");
        filters.classList.add("hidden");

        btnEntreprises.classList.add(
            "border-blue-500",
            "text-blue-500",
            "bg-blue-100",
        );
        btnEntreprises.classList.remove("border-gray-300", "text-gray-600");

        btnApprentis.classList.add("border-gray-300", "text-gray-600");
        btnApprentis.classList.remove(
            "border-blue-500",
            "text-blue-500",
            "bg-blue-100",
        );
    });
});

//Search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('#search');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const cards = document.querySelectorAll('.search-card');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchText)) {
                    card.parentElement.style.display = '';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    }
});
