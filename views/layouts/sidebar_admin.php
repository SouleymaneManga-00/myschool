<div class="sidebar">

    <div class="logo">
        <h2>MySchool</h2>
    </div>

    <ul>

        <li>
            <a href="dashboard.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="etudiants.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'etudiants.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-user-graduate"></i>
                Étudiants
            </a>
        </li>

        <li>
            <a href="enseignants.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'enseignants.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-chalkboard-user"></i>
                Enseignants
            </a>
        </li>

        <li>
            <a href="classes.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'classes.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-school"></i>
                Classes
            </a>
        </li>

        <li>
            <a href="matieres.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'matieres.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-book"></i>
                Matières
            </a>
        </li>

        <li>
            <a href="emploi_temps.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'emploi_temps.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-calendar-days"></i>
                Emploi du temps
            </a>
        </li>

        <li>
            <a href="../../logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Déconnexion
            </a>
        </li>

        <li>
            <a href="profil.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-user"></i>
                Mon Profil
            </a>
        </li>

    </ul>

</div>