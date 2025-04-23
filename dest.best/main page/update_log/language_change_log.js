
const english = [
    "☉ ☉ ☉ dest.best update log: ☉ ☉ ☉",
    "2025 - Creation of a whole ecosystem centralised around main page. All previous projects done by Dest are put on the site. Web-site's purpose as a portfolio is put in place.<br>" +
    "2024 - Katheryne: minor bugs fixed. Bennet's image on team and task creation pages is now visible. Slight size inconveniences fixed.<br>" +
    "2023 - Katheryne site establishement. TEST project leaves the web-site<br>" +
    "2022 - Temporary TEST project's appearance. GTA World leaves the web-site.<br>" +
    "2022 - GTA World: iFrame fix #3 (Final result). Change of several images that fit to the div size.<br>" +
    "2022 - GTA World: iFrame fix #2. 404 Error bug fixed, now the iFrame is always shown on the page.<br>" +
    "2021 - GTA World: iFrame fix #1. Added new images that lacked to fill empty divs.<br>" +
    "2021 - GTA World establishement.",
    "- French -",
    "- Ukranian -"
];
const french = [
    "☉ ☉ ☉ journal des mises à jour de dest.best : ☉ ☉ ☉",
    "2025 - Création d’un écosystème centré autour de la page principale. Tous les projets précédents sont ajoutés. Le site devient un portfolio.<br>" +
    "2024 - Katheryne : bugs mineurs corrigés. L’image de Bennet est désormais visible. Légers ajustements de taille.<br>" +
    "2023 - Lancement du site Katheryne. Le projet TEST quitte le site.<br>" +
    "2022 - Apparition temporaire du projet TEST. GTA World quitte le site.<br>" +
    "2022 - GTA World : correctif iFrame #3 (résultat final). Changement de plusieurs images.<br>" +
    "2022 - GTA World : correctif iFrame #2. Bug 404 corrigé. L’iFrame s’affiche correctement.<br>" +
    "2021 - GTA World : correctif iFrame #1. Nouvelles images ajoutées.<br>" +
    "2021 - Création de GTA World.",
    "- Anglais -",
    "- Ukrainien -"
];
const ukranian = [
    "☉ ☉ ☉ журнал оновлень dest.best: ☉ ☉ ☉",
    "2025 — Створення екосистеми навколо головної сторінки. Усі попередні проєкти додані на сайт. Портфоліо активоване.<br>" +
    "2024 — Katheryne: виправлено дрібні помилки. Зображення Беннета тепер видно. Покращено відображення.<br>" +
    "2023 — Сайт Katheryne створено. Проєкт TEST залишає сайт.<br>" +
    "2022 — Тимчасова поява проєкту TEST. GTA World залишає сайт.<br>" +
    "2022 — GTA World: виправлення iFrame #3. Зміна кількох зображень.<br>" +
    "2022 — GTA World: виправлення iFrame #2. Помилку 404 виправлено.<br>" +
    "2021 — GTA World: виправлення iFrame #1. Додано зображення.<br>" +
    "2021 — Створення GTA World.",
    "- Французька -",
    "- Англійська -"
];
const classPathArray = [
    ".log-title",    // title
    ".log-entry",    // log content
    ".lang1",        // first language button
    ".lang2"         // second language button
];
function setLogEnglish() {
    for (let i = 0; i < classPathArray.length; i++) {
        $(classPathArray[i]).text(english[i]);
    }
}
function setLogFrench() {
    for (let i = 0; i < classPathArray.length; i++) {
        $(classPathArray[i]).text(french[i]);
    }
}
function setLogUkranian() {
    for (let i = 0; i < classPathArray.length; i++) {
        $(classPathArray[i]).text(ukranian[i]);
    }
}