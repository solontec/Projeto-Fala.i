setInterval(() => {
  fetch('../Controller/TempoController.php', { method: 'POST' })
    .then(res => res.json())
    .then(data => console.log('Pontos adicionados:', data))
    .catch(err => console.error('Erro ao registrar tempo:', err));
}, 10000); // 10 segundos só pra testar
