import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleButton");
    const dropdown = document.getElementById("dropdownWrapper");
    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener("click", function () {
            dropdown.classList.toggle("hidden");
        });
    }
    const submitBtn = document.getElementById("submitBtn");
    const selectCoach = document.getElementById("coach_id");
    if (selectCoach && submitBtn) {
        selectCoach.addEventListener("change", () => {
            if (selectCoach.value) {
                submitBtn.classList.remove("hidden");
            } else {
                submitBtn.classList.add("hidden");
            }
        });
    }
});

// Change entreprise
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtnEntreprise = document.getElementById(
        "toggleButtonEntreprise",
    );
    const dropdownEntreprise = document.getElementById(
        "dropdownWrapperEntreprise",
    );
    if (toggleBtnEntreprise && dropdownEntreprise) {
        toggleBtnEntreprise.addEventListener("click", function () {
            dropdownEntreprise.classList.toggle("hidden");
        });
    }
    const submitBtnEntreprise = document.getElementById("submitBtnEntreprise");
    const selectEntreprise = document.getElementById("entreprise_id");
    if (selectEntreprise && submitBtnEntreprise) {
        selectEntreprise.addEventListener("change", () => {
            if (selectEntreprise.value) {
                submitBtnEntreprise.classList.remove("hidden");
            } else {
                submitBtnEntreprise.classList.add("hidden");
            }
        });
    }
});

// Toggle between "Apprentis" and "Entreprises" sections on the homepage
document.addEventListener("DOMContentLoaded", function () {
    const btnApprentis = document.getElementById("btn-apprentis");
    const btnEntreprises = document.getElementById("btn-entreprises");
    const sectionApprentis = document.getElementById("section-apprentis");
    const sectionEntreprises = document.getElementById("section-entreprises");
    const filters = document.getElementById("filters");
    const sectionContainer = document.getElementById("section-container");
    const fullContainer = document.getElementById("full-container");
    if (btnEntreprises && btnApprentis) {
        btnApprentis.addEventListener("click", () => {
            sectionApprentis.classList.remove("hidden");
            sectionEntreprises.classList.add("hidden");
            filters.classList.remove("hidden");
            sectionContainer.classList.add("w-full", "lg:w-2/3");
            fullContainer.classList.add("lg:flex-row-reverse");

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
            sectionContainer.classList.remove("w-full", "lg:w-2/3");
            fullContainer.classList.remove("lg:flex-row-reverse");

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
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("#search");

    if (searchInput) {
        searchInput.addEventListener("input", function () {
            const searchText = this.value.toLowerCase();
            const EntreprisesSection = document.getElementById("section-entreprises")
            if (EntreprisesSection) {
                if (EntreprisesSection.classList.contains("hidden")) {
                    const entrepriseCards = document.querySelectorAll(".entreprises-item");
                    entrepriseCards.forEach((card) => {
                        const text = card.textContent.toLowerCase();
                        if (text.includes(searchText)) {
                            card.parentElement.style.display = "";
                        } else {
                            card.parentElement.style.display = "none";
                        }
                    });
                }
            } else {
                const apprentisCards = document.querySelectorAll(".search-card");
                apprentisCards.forEach((card) => {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(searchText)) {
                        card.parentElement.style.display = "";
                    } else {
                        card.parentElement.style.display = "none";
                    }
                });
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('profilForm');
    if (form) {
        const inputs = form.querySelectorAll('input');
        const submitButton = document.getElementById('submitButton');
        let changed = false;

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (!changed) {
                    submitButton.classList.remove('hidden');
                    changed = true;
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    window.toggleDropdown = function (id) {
        const dropdown = document.getElementById('dropdown-' + id);
        if (dropdown) dropdown.classList.toggle('hidden');
    };

    document.addEventListener('click', function (e) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            const button = document.querySelector(`button[onclick*="${dropdown.id.replace('dropdown-', '')}"]`);
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('global-search');
    const results = document.getElementById('search-results');
    const apprentisContainer = document.querySelector('.section-container');

    let timeout = null;

    input.addEventListener('input', () => {
        const entreprisesSection = document.getElementById("section-entreprises");
        const query = input.value.trim();

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            if (query.length < 2) return;

            // Определяем тип запроса
            const type = entreprisesSection && entreprisesSection.style.display !== 'none'
                ? 'Entreprises'
                : 'Users';

            console.log(type);
            fetch(`/searchUser?q=${encodeURIComponent(query)}&type=${$type}`, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            })
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        results.innerHTML = '<div class="p-3 text-sm text-gray-500">Aucun résultat</div>';
                    } else {
                        results.innerHTML = data.map(apprenti => `
                        <a href="/user-profile/${apprenti.id}" class="flex items-center gap-4 p-3 border-b hover:bg-gray-50 transition rounded">
                            <img src="${apprenti.photo}" alt="Photo de ${apprenti.name}" class="w-12 h-12 object-cover rounded-full border-2 border-green-100" />
                            <div>
                                <h3 class="text-sm font-semibold text-gray-800">${apprenti.name} ${apprenti.lastname}</h3>
                                <p class="text-xs text-gray-500">Formation : ${apprenti.roles}</p>
                            </div>
                        </a>
                    `).join('');
                    }
                })
                .catch(() => {
                    results.innerHTML = '<div class="p-3 text-sm text-red-500">Erreur de recherche</div>';
                    results.style.display = 'block';
                });
        }, 300);
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            input.value = '';
            results.style.display = 'none';
        }
    });
});
