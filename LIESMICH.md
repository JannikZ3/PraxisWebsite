# Praxis-Webseite – Kurzanleitung

## Dateien
- `index.html`, `ueber-mich.html`, `therapieangebot.html`, `ablauf-kosten.html`, `kontakt.html` – die Seiten
- `impressum.html`, `datenschutz.html` – **Vorlagen**, unbedingt vollständig prüfen/ergänzen
- `kontakt.php` – verschickt das Kontaktformular per E-Mail (oben die zwei Adressen eintragen)
- `assets/css/style.css` – Gestaltung (Farben ganz oben unter `:root`)
- `assets/fonts/` – Schriften lokal (keine Google-Verbindung, DSGVO-freundlich)
- `assets/img/` – hier Fotos ablegen

## Platzhalter ersetzen
Alles, was im Browser **gelb markiert** ist, steht im Code als `<span class="ph">[...]</span>`.
Text ersetzen und das `<span class="ph">`-Drumherum entfernen. Suche nach `class="ph"` findet alle Stellen.
Telefon/E-Mail auch in den Links ändern: `tel:+49000000000` und `mailto:kontakt@example.de`.
Kopf und Fuß stehen in jeder Seite einzeln – Änderungen dort in allen Dateien machen
(Editor mit „In Dateien ersetzen“, z. B. VS Code, hilft).

## Fotos einsetzen
Suche nach `<!-- FOTO:` und ersetze den folgenden `<div class="linse__platzhalter">…</div>` durch z. B.
`<img src="assets/img/portrait.jpg" alt="Porträt von …" width="800" height="1000">`.
Fotos vorher auf ca. 1200 px Breite verkleinern (z. B. squoosh.app).

## Lokal ansehen
Einfach `index.html` im Browser öffnen. Das Formular funktioniert erst auf dem Server (PHP).

## Hochladen zu IONOS (Webhosting)
0. **Vorher** in allen HTML-Dateien die Zeile `<meta name="robots" content="noindex, nofollow">` (Testphase) löschen, sonst findet Google die Seite nicht.
1. Im IONOS-Kundenbereich unter *Hosting → SFTP & SSH* einen SFTP-Zugang anlegen.
2. Mit FileZilla verbinden und **den gesamten Ordnerinhalt** (ohne `LIESMICH.md`) in das Webspace-Verzeichnis hochladen.
3. Unter *Domains & SSL* die Domain auf dieses Verzeichnis zeigen lassen und das SSL-Zertifikat aktivieren.
4. Formular einmal testen.
