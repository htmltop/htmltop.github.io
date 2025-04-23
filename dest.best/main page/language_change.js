const english = [
    "Dest's Projects",
    "Site Projects",
    "Other Projects",
    "Hi, I'm Dest! Welcome to my site, where I showcase all my web projects. Coding is one of my greatest passions, but it's not my only one! I have a wide range of interests beyond programming, which you can explore on my personal Instagram. Feel free to check it out—I’d love to share more with you!",
    "Message me here for more information",
    "My latest project",
    "Katheryne",
    "All mine projects",
    "Previous Projects",
    "See what I post about my code!",
    "Dev. Instagram",
    "See what I have been doing recently",
    "Personal Instagram",
    "All projects were made by one person - Dest, including this page you see right now.",
    "- French -",
    "- Ukranian -",
    "- Main Page -",
    "- Website Projects -",
    "- Other Projects -"
];
const french = [
    "Projets de Dest",
    "Projets de site",
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
    "Проєкти сайту",
    "Інші проєкти",
    "Привіт, я Дест! Ласкаво просимо на мій сайт, де я демонструю всі свої веб-проєкти. Програмування – одна з моїх найбільших пристрастей, але не єдина! У мене є багато інших інтересів поза програмуванням, які ви можете дослідити на моєму особистому Instagram. Не соромтеся переглянути — мені б дуже хотілося поділитися з вами ще більше!",
    "Напишіть мені тут, щоб отримати більше інформації",
    "Мій останній проєкт",
    "Katheryne",
    "Всі мої проєкти",
    "Попередні проєкти",
    "Дізнайтеся, що я публікую про свій код!",
    "Дев. Instagram",
    "Дізнайтеся, чим я займався останнім часом",
    "Особистий Instagram",
    "Усі проєкти були створені однією людиною – Дестом, включаючи цю сторінку, яку ви зараз бачите.",
    "- Французька -",
    "- Англійська -",
    "- Головна сторінка -",
    "- Проєкти сайту -",
    "- Інші проєкти -"
];
const classPathArray = [
    ".h-1", // "Dest's Projects"
    ".m .btn:nth-of-type(1)", // "Site Projects"
    ".m .btn:nth-of-type(2)", // "Other Projects"
    ".info", // Intro text
    ".more-info", // "Message me here for more information"
    "#first-one .card-members", // "My latest project"
    "#first-one .card-etablish", // "Katheryne"
    ".card:nth-of-type(2) .card-members", // "All mine projects"
    ".card:nth-of-type(2) .card-etablish", // "Previous Projects"
    ".card:nth-of-type(3) .card-members", // "See what I post about my code!"
    ".card:nth-of-type(3) .card-etablish", // "Dev. Instagram"
    ".card:nth-of-type(4) .card-members", // "See what I have been doing recently"
    ".card:nth-of-type(4) .card-etablish", // "Personal Instagram"
    ".footer-1 .text", // "All projects were made by one person - Dest, including this page you see right now."
    ".language:nth-of-type(1)", // "- French -"
    ".language:nth-of-type(2)", // "- Ukranian -"
    ".links .page:nth-of-type(1)", // "- Main Page -"
    ".links .page:nth-of-type(2)", // "- Website Projects -"
    ".links .page:nth-of-type(3)" // "- Other Projects -"
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