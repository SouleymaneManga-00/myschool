<?php
session_start();

if (
    !isset($_SESSION['id']) ||
    $_SESSION['role'] !== 'etudiant'
) {
    header('Location: ../../index.php');
    exit();
}

include '../layouts/header.php';
include '../layouts/sidebar_etudiants.php';
?>


<div class="main-content">

    <div class="table-container">

        <div class="table-header">
            <h3>Mes Notes</h3>

            <input type="text"
                id="searchInput"
                placeholder="Rechercher une matière">
        </div>

        <div class="table-responsive">

            <table class="notes-table">

                <thead>
                    <tr>
                        <th>Matière</th>
                        <th>Professeur</th>
                        <th>Coefficient</th>
                        <th>Note</th>
                        <th>Mention</th>
                        <th>Statut</th>
                    </tr>
                </thead>

                <tbody id="notesTable">

                    <?php

                    $notes = [
                        [
                            "matiere" => "Mathématiques",
                            "prof" => "M. Diallo",
                            "coef" => 4,
                            "note" => 16
                        ],
                        [
                            "matiere" => "Programmation Web",
                            "prof" => "M. Ndiaye",
                            "coef" => 5,
                            "note" => 18
                        ],
                        [
                            "matiere" => "Base de Données",
                            "prof" => "Mme Fall",
                            "coef" => 3,
                            "note" => 14
                        ],
                        [
                            "matiere" => "Réseaux",
                            "prof" => "M. Kane",
                            "coef" => 2,
                            "note" => 9
                        ]
                    ];

                    foreach ($notes as $note):

                        $statut =
                        $note['note'] >= 10
                        ? "Validé"
                        : "Échec";

                        $class =
                        $note['note'] >= 10
                        ? "success"
                        : "danger";

                        if ($note['note'] >= 16) {
                            $mention = "Très Bien";
                        } elseif ($note['note'] >= 14) {
                            $mention = "Bien";
                        } elseif ($note['note'] >= 12) {
                            $mention = "Assez Bien";
                        } elseif ($note['note'] >= 10) {
                            $mention = "Passable";
                        } else {
                            $mention = "Insuffisant";
                        }
                    ?>

                    <tr>
                        <td><?= $note['matiere']; ?></td>
                        <td><?= $note['prof']; ?></td>
                        <td><?= $note['coef']; ?></td>
                        <td><?= $note['note']; ?>/20</td>
                        <td><?= $mention; ?></td>

                        <td>
                            <span class="status <?= $class ?>">
                                <?= $statut ?>
                            </span>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="pagination">

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

</div>


<?php include '../layouts/footer.php'; ?>