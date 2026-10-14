{{-- resources/views/partials/cookie-banner.blade.php --}}
{{-- À inclure UNE fois dans layouts/app.blade.php, juste avant </body> : @include('partials.cookie-banner') --}}

<style>
    .ck-banner {
        position: fixed;
        left: 16px;
        right: 16px;
        bottom: 16px;
        max-width: 920px;
        margin: 0 auto;
        background: #ffffff;
        color: #1f2937;
        border: 1px solid #dbe1f3;
        border-left: 5px solid #1e3a8a;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(30, 58, 138, .18);
        padding: 20px 22px;
        z-index: 99999;
        display: none;
        font-size: 15px;
        line-height: 1.5;
    }

    .ck-banner.ck-show { display: block; }

    .ck-banner h2 {
        font-size: 18px;
        font-weight: 800;
        color: #1e3a8a;
        margin: 0 0 6px 0;
    }

    .ck-banner p { margin: 0 0 14px 0; }

    .ck-banner a { color: #1e3a8a; text-decoration: underline; }

    .ck-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .ck-btn {
        font: inherit;
        font-weight: 600;
        padding: 11px 20px;
        border-radius: 8px;
        border: 2px solid #1e3a8a;
        cursor: pointer;
        background: #fff;
        color: #1e3a8a;
        flex: 1 1 140px;
    }

    /* Accepter et Refuser ont le même poids visuel (exigence CNIL) */
    .ck-btn.ck-main { background: #1e3a8a; color: #fff; }
    .ck-btn.ck-link {
        border-color: transparent;
        text-decoration: underline;
        flex: 0 1 auto;
    }

    .ck-btn:focus-visible,
    .ck-switch input:focus-visible + .ck-slider {
        outline: 3px solid #f59e0b;
        outline-offset: 2px;
    }

    /* Panneau de personnalisation */
    .ck-panel { display: none; margin: 4px 0 16px 0; }
    .ck-banner.ck-custom .ck-panel { display: block; }
    .ck-banner.ck-custom .ck-intro { display: none; }

    .ck-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .ck-row:last-child { border-bottom: 0; }
    .ck-row strong { color: #1e3a8a; display: block; }
    .ck-row span.ck-desc { font-size: 13.5px; color: #4b5563; }

    .ck-switch { position: relative; width: 46px; height: 26px; flex-shrink: 0; }
    .ck-switch input { opacity: 0; width: 100%; height: 100%; position: absolute; margin: 0; cursor: pointer; }
    .ck-slider {
        position: absolute; inset: 0;
        background: #cbd5e1;
        border-radius: 26px;
        transition: background .2s;
        pointer-events: none;
    }
    .ck-slider::before {
        content: "";
        position: absolute;
        width: 20px; height: 20px;
        left: 3px; top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: transform .2s;
    }
    .ck-switch input:checked + .ck-slider { background: #1e3a8a; }
    .ck-switch input:checked + .ck-slider::before { transform: translateX(20px); }
    .ck-switch input:disabled + .ck-slider { opacity: .6; }

    @media (max-width: 600px) {
        .ck-banner { left: 8px; right: 8px; bottom: 8px; padding: 16px; max-height: 90vh; overflow-y: auto; }
        .ck-btn { flex: 1 1 100%; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ck-slider, .ck-slider::before { transition: none; }
    }
</style>

<div id="ck-banner" class="ck-banner" role="dialog" aria-live="polite" aria-labelledby="ck-title">
    <h2 id="ck-title">Vos choix concernant les cookies</h2>

    <p class="ck-intro">
        Infortom utilise des cookies indispensables au fonctionnement du site. Avec votre accord,
        nous utilisons aussi des cookies de mesure d'audience et de contenus tiers (Facebook).
        Vous pouvez accepter, refuser ou choisir cookie par cookie. Votre choix est conservé 6 mois.
        <a href="{{ route('confidentialite') }}">En savoir plus</a>
    </p>

    <div class="ck-panel">
        <div class="ck-row">
            <div>
                <strong>Cookies nécessaires</strong>
                <span class="ck-desc">Sécurité, session, mémorisation de votre choix. Toujours actifs.</span>
            </div>
            <label class="ck-switch">
                <input type="checkbox" checked disabled aria-label="Cookies nécessaires">
                <span class="ck-slider"></span>
            </label>
        </div>

        <div class="ck-row">
            <div>
                <strong>Mesure d'audience</strong>
                <span class="ck-desc">Statistiques de fréquentation pour améliorer le site.</span>
            </div>
            <label class="ck-switch">
                <input type="checkbox" id="ck-stats" aria-label="Mesure d'audience">
                <span class="ck-slider"></span>
            </label>
        </div>

        <div class="ck-row">
            <div>
                <strong>Contenus tiers et réseaux sociaux</strong>
                <span class="ck-desc">Facebook et autres services externes.</span>
            </div>
            <label class="ck-switch">
                <input type="checkbox" id="ck-social" aria-label="Contenus tiers et réseaux sociaux">
                <span class="ck-slider"></span>
            </label>
        </div>
    </div>

    <div class="ck-actions">
        <button type="button" class="ck-btn ck-main" id="ck-accept">Tout accepter</button>
        <button type="button" class="ck-btn ck-main" id="ck-refuse">Tout refuser</button>
        <button type="button" class="ck-btn ck-link" id="ck-customize">Personnaliser</button>
        <button type="button" class="ck-btn" id="ck-save" style="display:none;">Enregistrer mes choix</button>
    </div>
</div>

<script>
(function () {
    var KEY = 'infortom_cookie_consent';
    var DURATION_MS = 6 * 30 * 24 * 60 * 60 * 1000; // 6 mois

    var banner = document.getElementById('ck-banner');
    var stats = document.getElementById('ck-stats');
    var social = document.getElementById('ck-social');
    var btnSave = document.getElementById('ck-save');
    var btnCustomize = document.getElementById('ck-customize');

    function read() {
        try {
            var data = JSON.parse(localStorage.getItem(KEY));
            if (data && data.expires && data.expires > Date.now()) return data;
        } catch (e) {}
        return null;
    }

    function save(choice) {
        var data = {
            necessary: true,
            stats: !!choice.stats,
            social: !!choice.social,
            date: new Date().toISOString(),
            expires: Date.now() + DURATION_MS
        };
        try { localStorage.setItem(KEY, JSON.stringify(data)); } catch (e) {}
        document.cookie = KEY + '=' + (data.stats ? 's' : '') + (data.social ? 'm' : '') +
            '; max-age=' + Math.floor(DURATION_MS / 1000) + '; path=/; SameSite=Lax';
        hide();
        apply(data);
    }

    function show(custom) {
        var c = read();
        stats.checked = c ? c.stats : false;
        social.checked = c ? c.social : false;
        banner.classList.toggle('ck-custom', !!custom);
        btnSave.style.display = custom ? '' : 'none';
        btnCustomize.style.display = custom ? 'none' : '';
        banner.classList.add('ck-show');
    }

    function hide() {
        banner.classList.remove('ck-show', 'ck-custom');
    }

    // Charger ici les scripts qui dépendent du consentement
    function apply(consent) {
        if (consent.stats) {
            // Exemple : charger Google Analytics / Matomo ici
        }
        if (consent.social) {
            // Exemple : charger les scripts Facebook ici
        }
        document.dispatchEvent(new CustomEvent('cookie-consent', { detail: consent }));
    }

    document.getElementById('ck-accept').addEventListener('click', function () {
        save({ stats: true, social: true });
    });
    document.getElementById('ck-refuse').addEventListener('click', function () {
        save({ stats: false, social: false });
    });
    btnCustomize.addEventListener('click', function () { show(true); });
    btnSave.addEventListener('click', function () {
        save({ stats: stats.checked, social: social.checked });
    });

    // Appelée par le lien "Gérer les cookies" du pied de page
    window.openCookieSettings = function () { show(true); };

    var existing = read();
    if (existing) { apply(existing); } else { show(false); }
})();
</script>
