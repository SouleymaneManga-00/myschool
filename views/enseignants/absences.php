<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'enseignant'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_enseignants.php';
?>

<div class="main-content">

    <div class="topbar">

        <h2>Gestion des Absences</h2>

        <div class="user">
            Bonjour <?= $_SESSION['prenom']; ?>
        </div>

    </div>

    <div class="absence-page">
        <div class="page-header">
            <div>
                <p class="eyebrow">Tableau de bord enseignant</p>
                <h2>Suivi des absences</h2>
                <p>Consultez les absences, les retard et les justificatifs des étudiants.</p>
            </div>
            <button class="primary-btn" id="openAbsenceModal" type="button"><i class="fa-solid fa-plus"></i> Nouvelle absence</button>
        </div>

        <div class="stats-grid">
            <div class="stat-card blue">
                <div>
                    <h3>24</h3>
                    <span>Absences aujourd’hui</span>
                </div>
                <div class="icon"><i class="fa-solid fa-user-slash"></i></div>
            </div>
            <div class="stat-card red">
                <div>
                    <h3>8</h3>
                    <span>Non justifiées</span>
                </div>
                <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            </div>
            <div class="stat-card gold">
                <div>
                    <h3>5</h3>
                    <span>Retards</span>
                </div>
                <div class="icon"><i class="fa-solid fa-clock"></i></div>
            </div>
            <div class="stat-card green">
                <div>
                    <h3>12</h3>
                    <span>Justifiées</span>
                </div>
                <div class="icon"><i class="fa-solid fa-check-circle"></i></div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-toolbar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un étudiant ou une matière">
                </div>
                <select class="filter-select">
                    <option>Toutes les classes</option>
                    <option>Licence 1</option>
                    <option>Licence 2</option>
                    <option>Master 1</option>
                </select>
            </div>

            <div class="table-responsive">
                <table id="absenceTable">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Classe</th>
                            <th>Matière</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Amina Diop</td>
                            <td>Licence 2</td>
                            <td>Mathématiques</td>
                            <td>30 juin 2026</td>
                            <td>08:00</td>
                            <td><span class="badge danger">Non justifiée</span></td>
                        </tr>
                        <tr>
                            <td>Yassine Benali</td>
                            <td>Master 1</td>
                            <td>Informatique</td>
                            <td>29 juin 2026</td>
                            <td>09:30</td>
                            <td><span class="badge warning">Retard</span></td>
                        </tr>
                        <tr>
                            <td>Sara Kone</td>
                            <td>Licence 1</td>
                            <td>Anglais</td>
                            <td>28 juin 2026</td>
                            <td>10:15</td>
                            <td><span class="badge success">Justifiée</span></td>
                        </tr>
                        <tr>
                            <td>Mohamed Traoré</td>
                            <td>Licence 2</td>
                            <td>Physique</td>
                            <td>27 juin 2026</td>
                            <td>07:45</td>
                            <td><span class="badge danger">Non justifiée</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="absenceModal" aria-hidden="true">
        <div class="modal-card">
            <div class="modal-header">
                <div>
                    <p class="eyebrow">Nouvelle saisie</p>
                    <h3>Ajouter une absence</h3>
                </div>
                <button class="close-btn" id="closeAbsenceModal" type="button" aria-label="Fermer le formulaire">&times;</button>
            </div>

            <form class="absence-form" id="absenceForm">
                <div class="form-grid">
                    <label>
                        <span>Étudiant</span>
                        <select required>
                            <option value="">Sélectionner</option>
                            <option>Amina Diop</option>
                            <option>Yassine Benali</option>
                            <option>Sara Kone</option>
                            <option>Mohamed Traoré</option>
                        </select>
                    </label>
                    <label>
                        <span>Classe</span>
                        <select required>
                            <option value="">Sélectionner</option>
                            <option>Licence 1</option>
                            <option>Licence 2</option>
                            <option>Master 1</option>
                        </select>
                    </label>
                    <label>
                        <span>Matière</span>
                        <select required>
                            <option value="">Sélectionner</option>
                            <option>Mathématiques</option>
                            <option>Informatique</option>
                            <option>Anglais</option>
                            <option>Physique</option>
                        </select>
                    </label>
                    <label>
                        <span>Date</span>
                        <input type="date" required>
                    </label>
                    <label>
                        <span>Heure</span>
                        <input type="time" required>
                    </label>
                    <label>
                        <span>Statut</span>
                        <select required>
                            <option value="">Sélectionner</option>
                            <option>Absence</option>
                            <option>Retard</option>
                            <option>Justifiée</option>
                        </select>
                    </label>
                </div>

                <label>
                    <span>Motif / Observation</span>
                    <textarea rows="4" placeholder="Ajoutez une remarque si nécessaire"></textarea>
                </label>

                <div class="form-actions">
                    <button class="secondary-btn" id="cancelAbsenceModal" type="button">Annuler</button>
                    <button class="primary-btn" type="submit">Enregistrer</button>
                </div>

                <p class="form-message" id="formMessage"></p>
            </form>
        </div>
    </div>

</div>

<style>
    .absence-page {
        background: transparent;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .eyebrow {
        color: #4FA3E3;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .page-header h2 {
        font-size: 1.7rem;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .page-header p {
        color: #6b7280;
    }

    .primary-btn {
        border: none;
        background: linear-gradient(135deg, #4FA3E3, #2563eb);
        color: white;
        padding: 12px 16px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(79, 163, 227, 0.25);
    }

    .secondary-btn {
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        padding: 12px 16px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.45);
        display: none;
        justify-content: center;
        align-items: center;
        padding: 20px;
        z-index: 1000;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-card {
        background: white;
        width: min(700px, 100%);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .close-btn {
        border: none;
        background: transparent;
        font-size: 1.8rem;
        cursor: pointer;
        color: #6b7280;
    }

    .absence-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .absence-form label {
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 0.95rem;
        color: #374151;
    }

    .absence-form input,
    .absence-form select,
    .absence-form textarea {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 11px 12px;
        outline: none;
        font-size: 0.95rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 8px;
    }

    .form-message {
        min-height: 20px;
        margin-top: 4px;
        color: #0f766e;
        font-weight: 600;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .stat-card h3 {
        font-size: 1.6rem;
        color: #111827;
        margin-bottom: 4px;
    }

    .stat-card span {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .stat-card .icon {
        font-size: 1.4rem;
        padding: 10px;
        border-radius: 50%;
        color: white;
    }

    .stat-card.blue {
        border-left: 5px solid #4FA3E3;
    }

    .stat-card.blue .icon {
        background: #4FA3E3;
    }

    .stat-card.red {
        border-left: 5px solid #ef4444;
    }

    .stat-card.red .icon {
        background: #ef4444;
    }

    .stat-card.gold {
        border-left: 5px solid #f59e0b;
    }

    .stat-card.gold .icon {
        background: #f59e0b;
    }

    .stat-card.green {
        border-left: 5px solid #10b981;
    }

    .stat-card.green .icon {
        background: #10b981;
    }

    .panel {
        background: white;
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .panel-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 260px;
    }

    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .search-box input {
        width: 100%;
        padding: 12px 14px 12px 42px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        outline: none;
        font-size: 0.95rem;
    }

    .filter-select {
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        outline: none;
        background: white;
    }

    .table-responsive {
        overflow-x: auto;
    }

    #absenceTable {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    #absenceTable th {
        background: #f8fafc;
        color: #374151;
        text-align: left;
        padding: 12px 10px;
        font-size: 0.95rem;
    }

    #absenceTable td {
        padding: 12px 10px;
        border-bottom: 1px solid #f1f5f9;
        color: #4b5563;
    }

    #absenceTable tr:hover {
        background: #f9fbff;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .badge.success {
        background: #dcfce7;
        color: #15803d;
    }

    .badge.danger {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge.warning {
        background: #fef3c7;
        color: #92400e;
    }

    @media (max-width: 768px) {
        .page-header {
            align-items: flex-start;
        }

        .panel-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<script>
    const searchInput = document.getElementById('searchInput');
    const openModalBtn = document.getElementById('openAbsenceModal');
    const closeModalBtn = document.getElementById('closeAbsenceModal');
    const cancelModalBtn = document.getElementById('cancelAbsenceModal');
    const modal = document.getElementById('absenceModal');
    const absenceForm = document.getElementById('absenceForm');
    const formMessage = document.getElementById('formMessage');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const value = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#absenceTable tbody tr');

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    }

    function openModal() {
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    function closeModal() {
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            if (absenceForm) {
                absenceForm.reset();
            }
            if (formMessage) {
                formMessage.textContent = '';
            }
        }
    }

    if (openModalBtn) {
        openModalBtn.addEventListener('click', openModal);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    if (cancelModalBtn) {
        cancelModalBtn.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    if (absenceForm) {
        absenceForm.addEventListener('submit', function (event) {
            event.preventDefault();
            if (formMessage) {
                formMessage.textContent = 'Formulaire prêt à être envoyé côté interface.';
            }
        });
    }
</script>

<?php include '../layouts/footer.php'; ?>