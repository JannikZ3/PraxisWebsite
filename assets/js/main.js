/* Praxis-Webseite – kleine Helfer (Menü, Kopfzeile, Formularmeldungen) */
(function () {
  "use strict";

  // Mobiles Menü
  var knopf = document.querySelector(".menu-knopf");
  var nav = document.getElementById("hauptnavigation");
  if (knopf && nav) {
    var setzen = function (offen) {
      knopf.setAttribute("aria-expanded", String(offen));
      knopf.querySelector(".menu-knopf__text").textContent = offen ? "Schließen" : "Menü";
      nav.classList.toggle("ist-offen", offen);
    };
    knopf.addEventListener("click", function () {
      setzen(knopf.getAttribute("aria-expanded") !== "true");
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("ist-offen")) {
        setzen(false);
        knopf.focus();
      }
    });
    window.matchMedia("(min-width: 961px)").addEventListener("change", function (m) {
      if (m.matches) setzen(false);
    });
  }

  // Linie unter der Kopfzeile beim Scrollen
  var kopf = document.querySelector(".kopf");
  if (kopf) {
    var pruefen = function () { kopf.classList.toggle("ist-gescrollt", window.scrollY > 8); };
    pruefen();
    window.addEventListener("scroll", pruefen, { passive: true });
  }

  // Rückmeldung nach dem Absenden des Kontaktformulars (kontakt.html?status=...)
  var status = new URLSearchParams(window.location.search).get("status");
  if (status) {
    var meldung = document.getElementById("meldung-" + (status === "ok" ? "ok" : "fehler"));
    if (meldung) {
      meldung.hidden = false;
      meldung.setAttribute("tabindex", "-1");
      meldung.focus();
    }
  }

  // Jahreszahl im Fuß
  var jahr = document.getElementById("jahr");
  if (jahr) jahr.textContent = new Date().getFullYear();
})();
