document.getElementById("loginForm").addEventListener('submit', async function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    try {
        let response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error("Erro ao conectar ao servidor.");
        }

        let data = await response.json();

        alert(data.mensagem);
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro na requisição: ' + error.message);
    }
});
