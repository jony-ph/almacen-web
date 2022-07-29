import Alert from "./alerts.js";

const resetForm = document.querySelector("#reset-pass-form");
const inputEmail = document.querySelector("#email-reset");

eventListener();
function eventListener() {
	document.addEventListener("DOMContentLoaded", () => {
		inputEmail.focus();
	});
	resetForm.addEventListener("submit", reset);
}

function reset(e) {
	e.preventDefault();

	const resetData = new FormData(resetForm);

	const url = "API/sessions/token.php";
	const options = {
		method: "POST",
		body: resetData,
	};

	fetch(url, options)
		.then((response) => response.json())
		.then((data) => {
			showMessage(data);
		})
		.catch((err) => console.log(err));
}

function showMessage(data) {
	const { status, code, message } = data;

	if (
		code === 200 &&
		status === "success" &&
		message === "Correo enviado con éxito"
	) {
		const alert = new Alert(
			message + `<a href="index.html"> Volver</a>`,
			"success",
			resetForm
		);
		alert.showAlert();
	} else {
		const alert = new Alert(message, "danger", resetForm);
		alert.showAlert();
	}
}
