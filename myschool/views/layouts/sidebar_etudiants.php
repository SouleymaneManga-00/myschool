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
            <a href="notes.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'notes.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i>
                Mes Notes
            </a>
        </li>

        <li>
            <a href="absences.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'absences.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-xmark"></i>
                Mes Absences
            </a>
        </li>

        <li>
            <a href="emploi_temps.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'emploi_temps.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-days"></i>
                Emploi du Temps
            </a>
        </li>

        <li>
            <a href="profil.php"
            class="<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-user"></i>
                Mon Profil
            </a>
        </li>

        <li>
            <a href="../../logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Déconnexion
            </a>
        </li>


    </ul>

</div>