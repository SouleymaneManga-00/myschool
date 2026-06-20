<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_admin.php';

$niveau = $_GET['niveau'] ?? 'L1';
?>

<link rel="stylesheet" href="../../assets/css/emploi_temps.css">

<div class="main-content">

    <div class="edt-header">

        <div>
            <h2>
                Gestion de l'Emploi du Temps
                (<?= htmlspecialchars($niveau); ?>)
            </h2>
        </div>

        <div class="edt-user">
            Bonjour <?= htmlspecialchars($_SESSION['prenom']); ?>
        </div>

    </div>

    <div class="edt-toolbar">

        <div class="edt-filtres">

            <select
                id="select-classe"
                class="edt-select"
                onchange="window.location.href='?niveau=' + this.value;"
            >

                <option
                    value="L1"
                    <?= $niveau === 'L1' ? 'selected' : ''; ?>
                >
                    Licence 1 (L1)
                </option>

                <option
                    value="L2"
                    <?= $niveau === 'L2' ? 'selected' : ''; ?>
                >
                    Licence 2 (L2)
                </option>

            </select>

            <input
                type="text"
                id="edt-search"
                class="edt-search"
                placeholder="Rechercher un cours..."
            >

        </div>

        <button
            class="edt-btn-ajouter"
            onclick="ouvrirFormulaireCours()"
        >
            + Ajouter un cours
        </button>

    </div>

    <div class="edt-table-container">

<?php if ($niveau === 'L1'): ?>

        <table class="emploi-table">

            <thead>

                <tr>
                    <th>Heure</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td><strong>08h00 - 10h00</strong></td>
                    <td>Algorithmique L1<br><small>Amphi A</small></td>
                    <td>Architecture L1<br><small>Salle 102</small></td>
                    <td>Base de Données L1<br><small>Amphi B</small></td>
                    <td>Systèmes d’Exploitation<br><small>Labo Info</small></td>
                    <td>Développement Web<br><small>Salle 204</small></td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>10h15 - 12h15</strong></td>
                    <td>Mathématiques</td>
                    <td>Algorithmique TD</td>
                    <td>Réseaux</td>
                    <td>Anglais</td>
                    <td>Base de Données TP</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>13h00 - 15h00</strong></td>
                    <td>Programmation Web</td>
                    <td>Maths Appliquées</td>
                    <td>Analyse Algo</td>
                    <td>Réseaux</td>
                    <td>Projet Tutoré</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>15h15 - 17h15</strong></td>
                    <td>Développement Mobile</td>
                    <td>BDD TD</td>
                    <td>Culture Numérique</td>
                    <td>Linux</td>
                    <td>TP Général</td>
                    <td>-</td>
                </tr>

            </tbody>

        </table>

<?php else: ?>

        <table class="emploi-table">

            <thead>

                <tr>
                    <th>Heure</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td><strong>08h00 - 10h00</strong></td>
                    <td>Java Avancé</td>
                    <td>Graphes</td>
                    <td>Systèmes Info</td>
                    <td>Génie Logiciel</td>
                    <td>Applications Mobiles</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>10h15 - 12h15</strong></td>
                    <td>Routage IP</td>
                    <td>Java TP</td>
                    <td>SQL Avancé</td>
                    <td>Management</td>
                    <td>Sécurité</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>13h00 - 15h00</strong></td>
                    <td>Web Avancé</td>
                    <td>Réseaux</td>
                    <td>UML</td>
                    <td>Gestion Projet</td>
                    <td>Cloud</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td><strong>15h15 - 17h15</strong></td>
                    <td>Framework Java</td>
                    <td>Projet Groupe</td>
                    <td>Big Data</td>
                    <td>Cybersécurité</td>
                    <td>Veille Tech</td>
                    <td>-</td>
                </tr>

            </tbody>

        </table>

<?php endif; ?>

    </div>

    <div class="edt-pagination">

        <button>
            <i class="fa-solid fa-angle-left"></i>
        </button>

        <button class="active">1</button>
        <button>2</button>
        <button>3</button>

        <button>
            <i class="fa-solid fa-angle-right"></i>
        </button>

    </div>

</div>

<!-- ================= MODAL AJOUT COURS ================= -->

<div id="modalCours" class="edt-modal">

    <div class="edt-modal-content">

        <div class="edt-modal-header">

            <button
                type="button"
                class="edt-close"
                onclick="fermerModal()"
            >
                ×
            </button>

            <h3>Ajouter un cours</h3>

        </div>

        <div class="edt-modal-body">

            <div class="edt-form-group">

                <label>Matière</label>

                <input
                    type="text"
                    id="matiere"
                    placeholder="Ex : Développement Web"
                >

            </div>

            <div class="edt-form-group">

                <label>Salle</label>

                <input
                    type="text"
                    id="salle"
                    placeholder="Ex : Salle 204"
                >

            </div>

            <div class="edt-form-group">

                <label>Jour</label>

                <select id="jour">

                    <option value="">
                        Choisir un jour
                    </option>

                    <option>Lundi</option>
                    <option>Mardi</option>
                    <option>Mercredi</option>
                    <option>Jeudi</option>
                    <option>Vendredi</option>
                    <option>Samedi</option>

                </select>

            </div>

            <div class="edt-form-group">

                <label>Horaire</label>

                <input
                    type="text"
                    id="heure"
                    placeholder="08h00 - 10h00"
                >

            </div>

        </div>

        <div class="edt-modal-footer">

            <button
                type="button"
                class="edt-btn-cancel"
                onclick="fermerModal()"
            >
                Annuler
            </button>

            <button
                type="button"
                class="edt-btn-save"
                onclick="ajouterCoursModal()"
            >
                Ajouter
            </button>

        </div>

    </div>

</div>

<script src="../../assets/js/emploi_temps.js"></script>


<?php include '../layouts/footer.php'; ?>