<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pdo = getDB();

// Récupération des données
$competences = $pdo->query("SELECT * FROM competences ORDER BY ordre, nom")->fetchAll();
$formations  = $pdo->query("SELECT * FROM formations WHERE type_entree='formation' ORDER BY ordre")->fetchAll();
$experiences = $pdo->query("SELECT * FROM formations WHERE type_entree='experience' ORDER BY ordre")->fetchAll();
$langues     = $pdo->query("SELECT * FROM langues ORDER BY ordre")->fetchAll();

// Données de fallback si la DB est vide
if (empty($competences)) {
    $competences = [
        ['nom'=>'HTML / CSS','niveau'=>85,'categorie'=>'frontend'],
        ['nom'=>'JavaScript','niveau'=>65,'categorie'=>'frontend'],
        ['nom'=>'Python',    'niveau'=>60,'categorie'=>'backend'],
        ['nom'=>'Django',    'niveau'=>55,'categorie'=>'backend'],
        ['nom'=>'PHP',       'niveau'=>65,'categorie'=>'backend'],
        ['nom'=>'MySQL',     'niveau'=>65,'categorie'=>'database'],
    ];
}
if (empty($formations)) {
    $formations = [['titre'=>'Niveau 3 — Génie Logiciel','etablissement'=>"Institut National de Science et Technique d'Abéché",'date_debut'=>'2023-2024','date_fin'=>'2025-2026','description'=>'']];
}
if (empty($experiences)) {
    $experiences = [['titre'=>'Stagiaire — Gestion & Réseaux','etablissement'=>'Expérience Tech, Abéché','date_debut'=>'45 jours','date_fin'=>'','description'=>"Participation aux réunions et suivi de projets, gestion de la relation client, rédaction de comptes rendus, observation et découverte du fonctionnement de l'entreprise. Assistance à la configuration réseau."]];
}
if (empty($langues)) {
    $langues = [
        ['nom'=>'Français','niveau'=>'Courant',      'pct'=>90],
        ['nom'=>'Arabe',   'niveau'=>'Courant',       'pct'=>90],
        ['nom'=>'Anglais', 'niveau'=>'Intermédiaire', 'pct'=>55],
    ];
}

$pageTitle  = 'Mariam Abakar Adoum Mahamat — Portfolio';
$activePage = 'home';
require_once 'includes/header.php';
?>

<!-- ░░ HERO ░░ -->
<section id="accueil" class="hero">
  <div class="hero-bg">
    <div class="hero-orb hero-orb--1"></div>
    <div class="hero-orb hero-orb--2"></div>
    <div class="hero-grid"></div>
  </div>
  <div class="hero-inner">
    <div class="hero-tag reveal">
      <span class="dot"></span> Disponible pour des projets &amp; stages
    </div>
    <h1 class="hero-title">
      <span class="hero-line reveal" style="animation-delay:.1s">Mariam</span>
      <em class="hero-line hero-line--italic reveal" style="animation-delay:.2s">Abakar Adoum Mahamat</em>
    </h1>
    <p class="hero-role reveal" style="animation-delay:.3s">
      Étudiante en <strong>Génie Logiciel</strong>
    </p>
    <p class="hero-meta reveal" style="animation-delay:.35s">
      Niveau 2 &nbsp;·&nbsp; Institut National de Science et Technique d'Abéché &nbsp;·&nbsp; Tchad
    </p>
    <div class="hero-actions reveal" style="animation-delay:.45s">
      <a href="#cv"            class="btn btn--gold">Voir mon CV <i class="fas fa-arrow-down"></i></a>
      <a href="contact.php"    class="btn btn--outline">Me contacter</a>
    </div>
    <div class="hero-scroll reveal" style="animation-delay:.6s">
      <div class="scroll-line"></div><span>Défiler</span>
    </div>
  </div>
</section>

<!-- ░░ À PROPOS ░░ -->
<section id="apropos" class="section about">
  <div class="container">
    <p class="section-label reveal">01 · À Propos</p>
    <div class="about-grid">
      <div class="about-photo-col reveal">
        <div class="about-photo-frame">
          <img src="assets/images/profile.jpg" alt="Mariam Abakar Adoum Mahamat"
               onerror="this.parentElement.querySelector('.photo-placeholder').style.display='flex';this.style.display='none'">
          <div class="photo-placeholder">
            <i class="fas fa-user"></i>
            <span>Ajoutez votre photo dans<br><code>assets/images/profile.jpg</code></span>
          </div>
        </div>
        <div class="about-badge">
          <span class="badge-n">3</span>
          <span class="badge-l">ans<br>d'études</span>
        </div>
      </div>
      <div class="about-text reveal" style="animation-delay:.15s">
        <h2 class="section-title">Passionnée par<br><em>la technologie</em></h2>
        <p>Je suis une étudiante en informatique, actuellement en niveau 3 à l'Institut National de Science et Technique d'Abéché, spécialisée en Génie Logiciel. Curieuse, rigoureuse et motivée, je cherche constamment à relever de nouveaux défis.</p>
        <p>Ma passion pour la technologie et la programmation m'anime au quotidien. J'aime explorer de nouvelles technologies et développer des solutions innovantes.</p>
        <div class="skill-pills">
          <?php foreach ($competences as $c): ?>
            <span class="pill"><?= e($c['nom']) ?></span>
          <?php endforeach; ?>
        </div>
        <div class="about-stats">
          <div class="astat"><span class="an">6</span><span class="al">Compétences</span></div>
          <div class="astat"><span class="an">3</span><span class="al">Langues</span></div>
          <div class="astat"><span class="an">1</span><span class="al">Stage</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ░░ CV ░░ -->
<section id="cv" class="section cv-sec">
  <div class="container">
    <p class="section-label reveal">02 · Curriculum Vitae</p>
    <h2 class="section-title reveal">Mon <em>Parcours</em></h2>
    <p class="section-sub reveal">Étudiante passionnée, je cherche à contribuer à des projets numériques innovants.</p>

    <div class="cv-grid">

      <!-- Formation -->
      <div class="cv-card reveal">
        <div class="cv-card-head">
          <div class="cv-icon"><i class="fas fa-graduation-cap"></i></div>
          <h3>Formation</h3>
        </div>
        <div class="cv-timeline">
          <?php foreach ($formations as $f): ?>
          <div class="cv-entry">
            <div class="cv-dot"></div>
            <div>
              <span class="cv-date"><?= e($f['date_debut']) ?><?= !empty($f['date_fin']) ? ' — '.e($f['date_fin']) : '' ?></span>
              <h4><?= e($f['titre']) ?></h4>
              <p><?= e($f['etablissement']) ?></p>
              <?php if (!empty($f['description'])): ?>
                <p class="cv-desc"><?= e($f['description']) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Expérience -->
      <div class="cv-card reveal" style="animation-delay:.1s">
        <div class="cv-card-head">
          <div class="cv-icon"><i class="fas fa-briefcase"></i></div>
          <h3>Expérience</h3>
        </div>
        <div class="cv-timeline">
          <?php foreach ($experiences as $exp): ?>
          <div class="cv-entry">
            <div class="cv-dot"></div>
            <div>
              <span class="cv-date"><?= e($exp['date_debut']) ?></span>
              <h4><?= e($exp['titre']) ?></h4>
              <p><?= e($exp['etablissement']) ?></p>
              <?php if (!empty($exp['description'])): ?>
                <p class="cv-desc"><?= e($exp['description']) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Compétences -->
      <div class="cv-card cv-card--wide reveal" style="animation-delay:.15s">
        <div class="cv-card-head">
          <div class="cv-icon"><i class="fas fa-code"></i></div>
          <h3>Compétences Techniques</h3>
        </div>
        <div class="skills-bars">
          <?php foreach ($competences as $c): ?>
          <div class="sbar-item">
            <div class="sbar-info">
              <span><?= e($c['nom']) ?></span>
              <span><?= (int)$c['niveau'] ?>%</span>
            </div>
            <div class="sbar-track">
              <div class="sbar-fill" data-w="<?= (int)$c['niveau'] ?>%"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Langues -->
      <div class="cv-card reveal" style="animation-delay:.2s">
        <div class="cv-card-head">
          <div class="cv-icon"><i class="fas fa-globe"></i></div>
          <h3>Langues</h3>
        </div>
        <div class="lang-list">
          <?php foreach ($langues as $l): ?>
          <div class="lang-item">
            <div class="lang-head">
              <span><?= e($l['nom']) ?></span>
              <span class="lang-lvl"><?= e($l['niveau']) ?></span>
            </div>
            <div class="lang-track">
              <div class="lang-fill" data-w="<?= (int)$l['pct'] ?>%"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <div class="cv-dl reveal">
      <a href="assets/images/cv-mariam.pdf" download class="btn btn--gold">
        <i class="fas fa-download"></i> Télécharger le CV (PDF)
      </a>
    </div>
  </div>
</section>

<!-- ░░ CTA ░░ -->
<section class="cta-band">
  <div class="container">
    <div class="cta-inner reveal">
      <h2>Travaillons <em>ensemble</em></h2>
      <p>Vous avez un projet ou une opportunité ? N'hésitez pas à me contacter.</p>
      <a href="contact.php" class="btn btn--light">
        Démarrer une conversation <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
