const route = (event) => {
	event = event || window.event;
	event.preventDefault();
	window.history.pushState({}, "", event.target.href);
	handleLocation();
};

const routes = {
	404: "/pages/==404.html",
	"/almacen/": "pages/index.php",
	"/almacen/history": "pages/history.php",
	users: "pages/users.php",
	data: "pages/data.php",
	settings: "pages/settings.php",
};

const handleLocation = async () => {
	const path = window.location.pathname;
	const route = routes[path] || routes[404];
	const html = await fetch(route).then((data) => data.text());
	document.getElementById("main-page").innerHTML = html;
};

window.onpopstate = handleLocation;
window.route = route;

handleLocation();
