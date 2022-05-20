export 

class Alert {

    constructor(message, type, element) {
        this.message = message;
        this.type = type;
        this.element = element;
    }

    showAlert() {

        const alert = () => {

            const containerAlert = document.createElement('div');
            containerAlert.classList.add('alert', `alert-${this.type}`, 'fade', 'show', 'my-3');
            containerAlert.innerHTML = `
                <button type="button" id="close-alert" class="btn-close float-end"></button>
                <strong>¡${this.type}!</strong> ${this.message} 
            `;
            containerAlert.onclick = function(e) {
                if (e.target.id == 'close-alert')
                    e.target.parentElement.remove();
            }

            return containerAlert;

        };

        this.element.appendChild( alert() );

    }
    
}

export default Alert;