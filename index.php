<?php
$products = [
    [
        'name' => 'Starter',
        'price' => '29€/mois',
        'desc' => 'Pour les petites équipes qui souhaitent lancer leur commande rapide.',
    ],
    [
        'name' => 'Pro',
        'price' => '79€/mois',
        'desc' => 'Pour les marques qui veulent automatiser les envois et les relances.',
    ],
    [
        'name' => 'Business',
        'price' => '149€/mois',
        'desc' => 'Pour les opérations avec volumes élevés et gestion multi-sites.',
    ],
];

$name = $email = $company = $message = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $company = trim((string) ($_POST['company'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));

    if ($name !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $message !== '') {
        $successMessage = 'Merci ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ' ! Votre demande a bien été reçue. Un conseiller Bolducbox vous répondra très prochainement.';
        $name = $email = $company = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolducbox | Boîtes en ligne pour les marques qui livrent vite</title>
    <meta name="description" content="Bolducbox est un faux site de démonstration pour une plateforme de préparation et de livraison de boîtes.">
    <style>
        :root {
            --bg: #f5f1ea;
            --card: #fffaf4;
            --primary: #174e3d;
            --primary-dark: #103c30;
            --accent: #d4a15f;
            --text: #1d1d1d;
            --muted: #6c6a66;
            --line: rgba(22, 28, 25, 0.08);
            --success: #2e7d32;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        img { max-width: 100%; display: block; }
        a { color: inherit; text-decoration: none; }
        .container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            padding: 20px 0 40px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            color: rgba(255,255,255,0.85);
            font-size: 0.95rem;
        }

        .cta {
            background: var(--accent);
            color: #1a1a1a;
            border: none;
            border-radius: 999px;
            padding: 14px 22px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .cta:hover { transform: translateY(-1px); }

        .hero {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 36px;
            padding-top: 52px;
        }

        .eyebrow {
            display: inline-block;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #f6e8d2;
            border-radius: 999px;
            font-size: 0.75rem;
            padding: 8px 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        h1 {
            font-size: clamp(2.4rem, 5vw, 4.2rem);
            line-height: 1.08;
            margin: 18px 0 20px;
        }

        .hero p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.82);
            max-width: 620px;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .secondary {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.35);
            color: white;
            border-radius: 999px;
            padding: 14px 22px;
            font-weight: 700;
            cursor: pointer;
        }

        .badge-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.18);
        }

        .mini-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .metric {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 18px 12px;
            border-radius: 16px;
            text-align: center;
        }

        .metric strong {
            display: block;
            font-size: 1.6rem;
        }

        section {
            padding: 86px 0;
        }

        .section-header {
            max-width: 720px;
            margin-bottom: 32px;
        }

        .section-header h2 {
            margin: 0 0 14px;
            font-size: clamp(2rem, 3vw, 3rem);
        }

        .section-header p {
            margin: 0;
            color: var(--muted);
            font-size: 1.08rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .feature-card, .pricing-card, .contact-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 14px 30px rgba(20, 20, 20, 0.04);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(23, 78, 61, 0.08);
            font-size: 1.5rem;
            margin-bottom: 16px;
        }

        .feature-card h3, .pricing-card h3 {
            margin: 0 0 12px;
            font-size: 1.35rem;
        }

        .feature-card p, .pricing-card p {
            margin: 0;
            color: var(--muted);
        }

        .pricing {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .pricing-card {
            position: relative;
        }

        .pricing-card.popular {
            border-color: rgba(212, 161, 95, 0.6);
            background: linear-gradient(180deg, #fffaf4, #fff3df);
        }

        .popular-tag {
            position: absolute;
            top: 16px;
            right: 16px;
            background: var(--accent);
            color: #1d1b1a;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 999px;
        }

        .price {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin: 18px 0 16px;
        }

        .price strong {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .pricing-card ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px;
            color: var(--muted);
        }

        .pricing-card li {
            padding: 8px 0;
            border-bottom: 1px solid var(--line);
        }

        .contact-wrap {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 22px;
        }

        .contact-card {
            background: #ffffff;
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 22px 0 0;
        }

        .contact-list li {
            margin-bottom: 12px;
            color: var(--muted);
        }

        form {
            display: grid;
            gap: 16px;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        label {
            display: block;
            font-size: 0.86rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(20, 28, 25, 0.12);
            background: #fff;
            font-size: 1rem;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .success {
            color: var(--success);
            font-weight: 700;
            margin-top: 8px;
        }

        footer {
            background: #111a18;
            color: rgba(255,255,255,0.8);
            padding: 26px 0;
            text-align: center;
        }

        @media (max-width: 860px) {
            .hero, .contact-wrap, .features, .pricing {
                grid-template-columns: 1fr;
            }

            .field-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="brand">Bolducbox</div>
                <div class="nav-links">
                    <a href="#solutions">Solutions</a>
                    <a href="#tarifs">Tarifs</a>
                    <a href="#contact">Contact</a>
                </div>
                <button class="cta">Demander un devis</button>
            </nav>

            <div class="hero">
                <div>
                    <span class="eyebrow">Préparation • Expédition • Suivi</span>
                    <h1>Des boîtes prêtes à partir, sans friction.</h1>
                    <p>
                        Bolducbox aide les marques à centraliser l’emballage, la préparation des commandes
                        et la livraison finale avec une expérience fluide pour l’équipe et le client.
                    </p>
                    <div class="hero-actions">
                        <button class="cta">Essayer Bolducbox</button>
                        <button class="secondary">Voir les tarifs</button>
                    </div>
                </div>

                <div class="badge-card">
                    <div style="font-size: 0.8rem; letter-spacing: 0.08em; text-transform: uppercase; color: rgba(255,255,255,0.75);">Performance mensuelle</div>
                    <div class="mini-metrics">
                        <div class="metric">
                            <strong>18k</strong>
                            <span>boîtes livrées</span>
                        </div>
                        <div class="metric">
                            <strong>96%</strong>
                            <span>de satisfaction</span>
                        </div>
                        <div class="metric">
                            <strong>2.4j</strong>
                            <span>pour expédier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="solutions" class="container">
            <div class="section-header">
                <h2>Une plateforme pensée pour les marques à croissance rapide</h2>
                <p>
                    Que vous vendiez des packs cadeaux, des boxes saisonnières ou des produits personnalisés,
                    Bolducbox simplifie chaque étape entre le stock et la livraison finale.
                </p>
            </div>

            <div class="features">
                <article class="feature-card">
                    <div class="feature-icon">📦</div>
                    <h3>Préparation automatisée</h3>
                    <p>Créez des règles de tri pour optimiser l’emballage et la préparation des commandes.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">📍</div>
                    <h3>Suivi en temps réel</h3>
                    <p>Suivez chaque expédition depuis la préparation jusqu’à la livraison finale de votre client.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">⚙️</div>
                    <h3>Workflow connecté</h3>
                    <p>Connectez vos outils e-commerce, votre ERP et vos opérateurs logistiques sans friction.</p>
                </article>
            </div>
        </section>

        <section id="tarifs" class="container">
            <div class="section-header">
                <h2>Des offres qui grandissent avec votre volume</h2>
                <p>Choisissez le plan adapté à votre rythme de commande et à votre niveau d’automatisation.</p>
            </div>

            <div class="pricing">
                <?php foreach ($products as $index => $product): ?>
                    <article class="pricing-card <?= $index === 1 ? 'popular' : '' ?>">
                        <?php if ($index === 1): ?>
                            <span class="popular-tag">Le plus vendu</span>
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($product['desc'], ENT_QUOTES, 'UTF-8') ?></p>
                        <div class="price">
                            <strong><?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?></strong>
                        </div>
                        <ul>
                            <li>✓ Gestion de base</li>
                            <li>✓ Automatisation simple</li>
                            <li>✓ Support standard</li>
                        </ul>
                        <button class="cta">Choisir ce plan</button>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="contact" class="container">
            <div class="contact-wrap">
                <div class="contact-card">
                    <h2>Parlons de votre projet</h2>
                    <p>Notre équipe analyse vos besoins de préparation, expédition et suivi pour proposer la solution la plus adaptée.</p>
                    <ul class="contact-list">
                        <li>📧 contact@bolducbox.com</li>
                        <li>📞 +33 1 84 00 76 25</li>
                        <li>📍 12 rue de l’Industrie, Paris</li>
                    </ul>
                </div>

                <div class="contact-card">
                    <form method="post" action="#contact">
                        <div class="field-row">
                            <div>
                                <label for="name">Nom</label>
                                <input id="name" name="name" type="text" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" placeholder="Votre nom" required>
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" placeholder="vous@entreprise.com" required>
                            </div>
                        </div>

                        <div>
                            <label for="company">Entreprise</label>
                            <input id="company" name="company" type="text" value="<?= htmlspecialchars($company, ENT_QUOTES, 'UTF-8') ?>" placeholder="Nom de votre entreprise">
                        </div>

                        <div>
                            <label for="message">Votre besoin</label>
                            <textarea id="message" name="message" placeholder="Décrivez votre projet..." required><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="submit-row">
                            <button type="submit" class="cta">Envoyer ma demande</button>
                            <?php if ($successMessage !== ''): ?>
                                <div class="success"><?= $successMessage ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        © <?= htmlspecialchars((string) date('Y'), ENT_QUOTES, 'UTF-8') ?> Bolducbox — Site de démonstration pour un projet fictif.
    </footer>
</body>
</html>
