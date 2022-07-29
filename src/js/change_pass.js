import Alert from "./alerts.js";

const changePassForm = document.querySelector("#change-password");
const newPassword = document.querySelector("#f-new-password");
const confirmPassword = document.querySelector("#f-confirm-password");

eventListener();
function eventListener() {
	changePassForm.addEventListener("submit", changePass);
	newPassword.addEventListener("input", securityPass);
	newPassword.addEventListener("paste", securityPass);
	newPassword.addEventListener("blur", securityPass);

	confirmPassword.addEventListener("input", confirmPass);
	confirmPassword.addEventListener("paste", confirmPass);
	confirmPassword.addEventListener("blur", confirmPass);
}

function changePass(e) {
	e.preventDefault();

	const resetData = new FormData(changePassForm);

	const pwd = resetData.get("f-new-password");
	const confirmPwd = resetData.get("f-confirm-password");

	if (!newPassword.classList.contains("success-pass")) {
		const alert = new Alert(
			"Debes cumplir los requerimientos",
			"danger",
			changePassForm
		);
		alert.showAlert();
		return;
	}
	if (pwd !== confirmPwd) {
		const alert = new Alert(
			"Las contraseñas no coinciden",
			"danger",
			changePassForm
		);
		alert.showAlert();
		return;
	}

	const url = "API/sessions/reset_pwd.php";
	const options = {
		method: "POST",
		body: resetData,
	};

	fetch(url, options)
		.then((response) => response.json())
		.then((data) => {
			console.log(data);
			redirectIndex(data);
		})
		.catch((err) => console.log(err));
}

function redirectIndex(data) {
	const { status, code, message } = data;

	if (
		code === 201 &&
		status === "success" &&
		message === "Contraseña actualizada"
	) {
		window.location.replace("index.php");
	} else if (
		code === 300 &&
		status === "success" &&
		message === "Las contraseñas no coinciden"
	) {
		const alert = new Alert(message, "danger", loginForm);
		alert.showAlert();
	} else {
		const alert = new Alert("Error, pasó algo inesperado", "danger", loginForm);
		alert.showAlert();
	}
}

function securityPass(e) {
	const value = e.target.value;

	const strongRegex =
		/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\\$%\^&\*])(?=.{8,})/;

	if (!strongRegex.test(value)) {
		if (newPassword.classList.contains("success-pass"))
			newPassword.classList.remove("success-pass");

		newPassword.classList.add("error-pass");

		return false;
	}

	if (newPassword.classList.contains("error-pass")) {
		newPassword.classList.remove("error-pass");
		newPassword.classList.add("success-pass");
	}

	return true;
}

function confirmPass(e) {
	const value = e.target.value;
	const password = newPassword.value;

	if (value !== password) {
		if (confirmPassword.classList.contains("success-pass"))
			confirmPassword.classList.remove("success-pass");

		confirmPassword.classList.add("error-pass");

		return false;
	}

	if (confirmPassword.classList.contains("error-pass")) {
		confirmPassword.classList.remove("error-pass");
		confirmPassword.classList.add("success-pass");
	}

	return true;
}
