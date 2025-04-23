const english = [
    "Dest's Projects",
    "Main Page",
    "Other Projects",
    "All projects were made by one person - Dest, including this page you see right now.",
    "- French -",
    "- Ukranian -",
    "- Main Page -",
    "- Website Projects -",
    "- Other Projects -"
];
const french = [
    "Projets de Dest",
    "Page principale",
    "Autres projets",
    "Salut, je suis Dest ! Bienvenue sur mon site, où je présente tous mes projets web. Le codage est l'une de mes plus grandes passions, mais ce n'est pas la seule ! J'ai de nombreux autres centres d'intérêt en dehors de la programmation, que vous pouvez découvrir sur mon Instagram personnel. N'hésitez pas à y jeter un œil, j'aimerais partager davantage avec vous !",
    "Envoyez-moi un message ici pour plus d'informations",
    "Mon dernier projet",
    "Katheryne",
    "Tous mes projets",
    "Projets précédents",
    "Découvrez ce que je publie sur mon code !",
    "Instagram Dév.",
    "Découvrez ce que j'ai fait récemment",
    "Instagram personnel",
    "Tous les projets ont été réalisés par une seule personne - Dest, y compris cette page que vous voyez actuellement.",
    "- Anglais -",
    "- Ukrainien -",
    "- Page principale -",
    "- Projets de site -",
    "- Autres projets -"
];
const ukranian = [
    "Проєкти Деста",
    "Головна сторінка",
    "Інші проєкти",
    "Усі проєкти були створені однією людиною – Дестом, включаючи цю сторінку, яку ви зараз бачите.",
    "- Французька -",
    "- Англійська -",
    "- Головна сторінка -",
    "- Проєкти сайту -",
    "- Інші проєкти -"
];
const projectTitlesEnglish = [
    "Project: Katheryne",
    "Brawl Up - Account Upgrade",
    "Snake Game",
    "Division 2",
    "Gta V Main Site",
    "Gta V Info Site",
    "Palyanytsa RP (Closed)",
    "Fortnite",
    "Guess The Word JS Game"
];
const projectTitlesFrench = [
    "Projet : Katheryne",
    "Brawl Up - Amelioration du compte",
    "Jeu du serpent",
    "Division 2",
    "Site principal de Gta V",
    "Site d'infos de Gta V",
    "Palyanytsa RP (Fermé)",
    "Fortnite",
    "Jeu JS: Devine le mot"
];
const projectTitlesUkrainian = [
    "Проєкт: Катерина",
    "Brawl Up – Покрачка акаунту",
    "Гра Змійка",
    "Division 2",
    "Основний сайт Gta V",
    "Інфо сайт Gta V",
    "Паляниця РП (Закрито)",
    "Fortnite",
    "Гра JS: Вгадай слово"
];
const classPathArray = [
    ".h-1", // "Dest's Projects"
    ".m .btn:nth-of-type(1)", // "Site Projects"
    ".m .btn:nth-of-type(2)", // "Other Projects"
    ".footer-1 .text", // "All projects were made by one person - Dest, including this page you see right now."
    ".language:nth-of-type(1)", // "- French -"
    ".language:nth-of-type(2)", // "- Ukranian -"
    ".links .page:nth-of-type(1)", // "- Main Page -"
    ".links .page:nth-of-type(2)", // "- Website Projects -"
    ".links .page:nth-of-type(3)" // "- Other Projects -"
];
const gallerySelectorArray = [
    "#gallery .img1",
    "#gallery .img2",
    "#gallery .img3",
    "#gallery .img4",
    "#gallery .img5",
    "#gallery .img6",
    "#gallery .img7",
    "#gallery .img8",
    "#gallery .img9"
];
function setEnglish(){
	for (let i = 0; i < classPathArray.length; i++) {
		$(classPathArray[i]).text(english[i]);
		$(".language:nth-of-type(1)").attr("onclick","setFrench()");
		$(".language:nth-of-type(2)").attr("onclick","setUkranian()");
	}
}
function setFrench(){
	for (let i = 0; i < classPathArray.length; i++) {
		$(classPathArray[i]).text(french[i]);
		$(".language:nth-of-type(1)").attr("onclick","setEnglish()");
		$(".language:nth-of-type(2)").attr("onclick","setUkranian()");
	}	
}
function setUkranian(){
    for (let i = 0; i < classPathArray.length; i++) {
        $(classPathArray[i]).text(ukranian[i]);
        $(".language:nth-of-type(1)").attr("onclick","setFrench()");
        $(".language:nth-of-type(2)").attr("onclick","setEnglish()");
    }   
}