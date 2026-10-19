// Titulo dos cards das tarefas
function ajustarTitulos() {
    // pega a classe 'card-head' e percorre
    document.querySelectorAll('.card-head p:first-child').forEach(p => {
        const span = p.querySelector('span');
        if (!span) return;

        // quanto o texto passa da largura disponível
        const excesso = span.offsetWidth - p.clientWidth;

        p.classList.toggle('rola', excesso > 0);

        // animaçção 
        if (excesso > 0) {
            p.style.setProperty('--deslocamento', `-${excesso}px`);
            p.style.setProperty('--duracao', `${Math.max(excesso / 40, 0.6)}s`);
        }
    });
}

window.addEventListener('load', ajustarTitulos);
window.addEventListener('resize', ajustarTitulos);

// Pop up | Modal
let form = null;
let idExcluir = null;
const modal = document.getElementById('modal-confirmar');
const botoesDelete = document.querySelectorAll('[name="delete"]');
botoesDelete.forEach((botao) => {
    botao.addEventListener('click', (event) => { // pega o event do click 
        event.preventDefault(); // impede o envio do submit
        
        form = botao.closest('form');
        idExcluir = botao.value;
        modal.showModal();

    });
});

const modal_confirmar = document.querySelector('.modal-confirmar');
modal_confirmar.addEventListener('click', async () => {
    const data = new FormData(form);
    data.append('delete', idExcluir); // adiciona o 'delete'

    // realiza requisiçao
    const response = await fetch('/src/config/service/serviceTask.php', {
        method: form.method,
        body: data
    });

    // veriica se deu certo
    const mensagem = await response.json();
    console.log(mensagem['message']);

    // fecha o modal e atualiza a pagian
    if (response.ok && mensagem.message) {
        modal.close();
        window.location.reload();
    }
});

const modal_cancelar = document.querySelector('.modal-cancelar');
modal_cancelar.addEventListener('click', () => {
    modal.close();
});