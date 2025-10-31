<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Calendário - PostIts 2025</title>

<style>
:root{
  --bg:#f4f4f6;
  --sidebar:#111315;
  --accent:#ffd84f;
}

/* Reset */
*{box-sizing:border-box}
body{
  margin:0;
  font-family: "Inter", "Segoe UI", Roboto, Arial, sans-serif;
  background:var(--bg);
  display:flex;
  min-height:100vh;
  color:#111;
}

/* SIDEBAR */
.sidebar{
  width:200px;
  background:var(--sidebar);
  color:#fff;
  padding:18px 14px;
  display:flex;
  flex-direction:column;
  gap:10px;
  align-items:flex-start;
}
.logo{
  display:flex;align-items:center;gap:10px;margin-bottom:6px;
}
.logo h2{margin:0;font-size:18px}
.month-btn{
  width:100%;
  background:transparent;
  color:#ddd;
  border-radius:8px;
  padding:10px;
  text-align:left;
  border:none;
  cursor:pointer;
  transition:.12s;
}
.month-btn:hover{background:#222;padding-left:14px;color:#fff}
.month-btn.active{background:#ffd84f;color:#111;font-weight:700}

/* MAIN */
#calendar-container{
  flex:1;
  padding:26px;
  overflow:auto;
}

/* Table */
.calendar-table{
  width:100%;
  border-collapse:collapse;
  background:#fff;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 6px 30px rgba(0,0,0,0.06);
}
.calendar-table th{
  background:var(--accent);
  padding:14px;
  font-weight:700;
  text-align:center;
}
.calendar-table td{
  width:14.285%;
  height:120px;
  vertical-align:top;
  border:1px solid #eee;
  padding:10px;
  position:relative;
}

/* day number */
.daynum{
  position:absolute;
  left:8px;
  top:6px;
  font-size:13px;
  color:#222;
  font-weight:700;
}

/* POST-IT style - top visual */
.postit {
  display:block;
  margin-top:18px;
  width:110px;
  height:110px;
  min-height:70px;
  max-height:110px;
  padding:10px 8px;
  box-shadow:
     0 8px 18px rgba(0,0,0,0.18),  /* sombra grande */
     inset 0 -12px 20px rgba(0,0,0,0.06); /* leve sombra interna */
  border-radius:8px;
  color:#111;
  font-weight:700;
  font-size:13px;
  line-height:1.05;
  overflow:hidden;
  text-overflow:ellipsis;
  word-break:break-word;
  white-space:normal;
  cursor:pointer;
  transform-origin:50% 50%;
  position:relative;
  transition:transform .14s ease, box-shadow .14s;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding-left:12px;
  padding-right:12px;
}

/* folded corner */
.postit::after{
  content:'';
  position:absolute;
  right:8px;
  top:6px;
  width:18px;
  height:18px;
  background:rgba(255,255,255,0.2);
  transform:rotate(45deg);
  box-shadow: -2px 2px 2px rgba(0,0,0,0.06);
  border-radius:2px;
  pointer-events:none;
}

/* hover */
.postit:hover{
  transform:translateY(-4px) scale(1.03);
  box-shadow:0 12px 28px rgba(0,0,0,0.22);
}

/* colors (sticky note palette) */
.pt-yellow{ background: ; }
.pt-orange{ background:#ffb07c; }
.pt-green{ background:#cbeaa5; }
.pt-blue{ background:#9fe8ff; }
.pt-pink{ background:#f6c1f6; }
.pt-cyan{ background:#c9f0ff; }

/* ensure text doesn't overflow calendar visually */
.postit p{ margin:0; font-size:13px; }

/* MODAL base */
.modal {
  position:fixed;
  left:0;top:0;right:0;bottom:0;
  display:none;
  background:rgba(0,0,0,0.45);
  align-items:center;
  justify-content:center;
  z-index:30;
}
.modal .box{
  background:#fff;
  padding:20px 22px;
  border-radius:12px;
  width:420px;
  max-width:94%;
  box-shadow:0 10px 30px rgba(0,0,0,0.28);
  font-family:inherit;
}

/* titles & inputs */
.modal h3{ margin:0 0 10px; font-size:18px; font-weight:700}
.modal input[type="text"], .modal textarea{
  width:100%;
  padding:10px 12px;
  border-radius:8px;
  border:1px solid #ddd;
  background:#fafafa;
  font-size:14px;
  resize:vertical;
  min-height:40px;
}
.modal textarea{ min-height:84px; max-height:160px }

/* buttons */
.row{ display:flex; gap:10px; margin-top:12px }
.btn{ flex:1; padding:10px; border-radius:8px; border:0; cursor:pointer; font-weight:700 }
.save{ background:#27ae60; color:#fff }
.close{ background:#8a8d90; color:#fff }
.danger{ background:#e74c3c; color:#fff }

/* small helper text */
.small{ font-size:12px; color:#666; margin-top:8px }

/* responsive */
@media(max-width:900px){
  .sidebar{ display:none }
  .postit{ width:100px; height:100px }
  .modal .box{ width:92% }
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <div class="logo"><img src="assets/img/logo.png" alt="" style="width:26px;height:26px;border-radius:4px;background:#fff;"><h2 style="margin-left:6px">2025</h2></div>
  <!-- months added by JS -->
</div>

<!-- CALENDÁRIO -->
<div id="calendar-container"></div>

<!-- MODALS -->
<!-- Add -->
<div class="modal" id="modalAdd">
  <div class="box" id="modalAddBox" role="dialog" aria-modal="true">
    <h3>Novo lembrete</h3>
    <input type="text" id="inputTitulo" placeholder="Título (máx 80 chars)" maxlength="80">
    <textarea id="inputDesc" placeholder="Descrição (opcional) - máx 200 chars" maxlength="200"></textarea>
    <div class="small">Limite visual: texto será cortado se exceder; clique em editar para ver tudo.</div>
    <div class="row">
      <button class="btn close" id="btnCancelAdd">Cancelar</button>
      <button class="btn save" id="btnSaveAdd">Salvar</button>
    </div>
  </div>
</div>

<!-- View/Edit -->
<div class="modal" id="modalView">
  <div class="box" id="modalViewBox" role="dialog" aria-modal="true">
    <h3>Editar / Visualizar lembrete</h3>
    <input type="text" id="viewTitulo" maxlength="120">
    <textarea id="viewDesc" maxlength="600"></textarea>
    <div class="row">
      <button class="btn close" id="btnCloseView">Fechar</button>
      <button class="btn danger" id="btnDelete">Excluir</button>
      <button class="btn save" id="btnSaveEdit">Salvar</button>
    </div>
    <div class="small" id="viewInfo"></div>
  </div>
</div>

<script>
/* ========== Dados e utilitários =========== */
const ANO = 2025;
const MESES = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
const colors = ["pt-yellow","pt-orange","pt-green","pt-blue","pt-pink","pt-cyan"];

let selectedMonthIndex = new Date().getMonth(); // load current month
let selectedDate = null; // "YYYY-MM-DD"
let selectedIndex = null; // index of note in date array

/* sidebar render */
const sidebar = document.getElementById('sidebar');
MESES.forEach((m,i)=>{
  const btn = document.createElement('button');
  btn.className = 'month-btn' + (i===selectedMonthIndex ? ' active' : '');
  btn.innerText = m;
  btn.onclick = ()=>{
    document.querySelectorAll('.month-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    selectedMonthIndex = i;
    renderCalendar(i);
  };
  sidebar.appendChild(btn);
});

/* calendar render */
function renderCalendar(monthIndex){
  const container = document.getElementById('calendar-container');
  container.innerHTML = ''; // clear

  // header + table
  const firstDay = new Date(ANO, monthIndex, 1).getDay(); // 0..6 (Sun..Sat)
  const lastDay = new Date(ANO, monthIndex+1, 0).getDate();

  let html = `<table class="calendar-table"><tr><th colspan="7">${MESES[monthIndex].toUpperCase()} - ${ANO}</th></tr>`;
  html += `<tr><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th><th>Dom</th></tr>`;
  html += `<tr>`;

  // calculate offset (we want Mon..Sun in that order)
  let offset = firstDay === 0 ? 6 : firstDay - 1;
  for(let i=0;i<offset;i++) html += '<td></td>';

  for(let d=1; d<= lastDay; d++){
    const iso = `${ANO}-${String(monthIndex+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    html += `<td onclick="openAddModal('${iso}')"><div class="daynum">${d}</div>`;

    const notes = JSON.parse(localStorage.getItem(iso) || '[]');
    notes.forEach((n, idx) => {
  // cor aleatória
  const color = colors[Math.floor(Math.random() * colors.length)];

  // rotação aleatória (-6 a +6 deg)
  const rotate = Math.floor(Math.random() * 12) - 6;

  // posicionamento aleatório dentro da célula
  const offsetX = Math.floor(Math.random() * 15); // até 15px pro lado
  const offsetY = Math.floor(Math.random() * 10); // até 10px pra baixo

  html += `
  <div class="postit ${color}"
       style="transform: rotate(${rotate}deg); margin-left:${offsetX}px; margin-top:${offsetY}px;"
       onclick="openViewModal(event,'${iso}',${idx})">
       <p>${escapeHtml(n.titulo)}</p>
  </div>`;
});


    html += `</td>`;
    // row wrap
    if ((d + offset) % 7 === 0) html += '</tr><tr>';
  }

  html += '</tr></table>';
  container.innerHTML = html;
}

/* escape to avoid HTML injection */
function escapeHtml(s){
  if(!s) return '';
  return s.replace(/[&<>"'`]/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;',"`":'&#96;'}[m]));
}

/* ========== MODAL: ADD ========== */
const modalAdd = document.getElementById('modalAdd');
const inputTitulo = document.getElementById('inputTitulo');
const inputDesc = document.getElementById('inputDesc');
document.getElementById('btnCancelAdd').onclick = closeAdd;
document.getElementById('btnSaveAdd').onclick = saveAdd;

function openAddModal(isoDate){
  selectedDate = isoDate;
  inputTitulo.value = '';
  inputDesc.value = '';
  modalAdd.style.display = 'flex';
  // prevent clicks inside from closing
  document.getElementById('modalAddBox').addEventListener('click', e=> e.stopPropagation());
  modalAdd.onclick = () => closeAdd(); // click outside
  inputTitulo.focus();
}

function closeAdd(){
  modalAdd.style.display = 'none';
}

/* Save add */
function saveAdd(){
  const t = inputTitulo.value.trim();
  const d = inputDesc.value.trim();
  if(!t){ alert('Digite um título para o lembrete'); inputTitulo.focus(); return; }
  const arr = JSON.parse(localStorage.getItem(selectedDate) || '[]');
  arr.push({titulo:t, descricao:d});
  localStorage.setItem(selectedDate, JSON.stringify(arr));
  modalAdd.style.display = 'none';
  renderCalendar(selectedMonthIndex); // show immediately
}

/* ========== MODAL: VIEW / EDIT ========== */
const modalView = document.getElementById('modalView');
const viewTitulo = document.getElementById('viewTitulo');
const viewDesc = document.getElementById('viewDesc');
const viewInfo = document.getElementById('viewInfo');
document.getElementById('btnCloseView').onclick = ()=> modalView.style.display='none';
document.getElementById('btnSaveEdit').onclick = saveEdit;
document.getElementById('btnDelete').onclick = deleteNote;

function openViewModal(e, isoDate, idx){
  e.stopPropagation();
  selectedDate = isoDate;
  selectedIndex = idx;
  const arr = JSON.parse(localStorage.getItem(isoDate) || '[]');
  const note = arr[idx];
  viewTitulo.value = note.titulo;
  viewDesc.value  = note.descricao || '';
  viewInfo.innerText = `Data: ${isoDate}`;
  modalView.style.display = 'flex';
  // prevent clicks inside from closing
  document.getElementById('modalViewBox').addEventListener('click', ev=> ev.stopPropagation());
  modalView.onclick = ()=> modalView.style.display='none';
}

function saveEdit(){
  const t = viewTitulo.value.trim();
  const d = viewDesc.value.trim();
  if(!t){ alert('Título vazio!'); viewTitulo.focus(); return; }
  const arr = JSON.parse(localStorage.getItem(selectedDate) || '[]');
  arr[selectedIndex] = { titulo:t, descricao:d };
  localStorage.setItem(selectedDate, JSON.stringify(arr));
  modalView.style.display = 'none';
  renderCalendar(selectedMonthIndex);
}

function deleteNote(){
  if(!confirm('Excluir este lembrete?')) return;
  const arr = JSON.parse(localStorage.getItem(selectedDate) || '[]');
  arr.splice(selectedIndex,1);
  localStorage.setItem(selectedDate, JSON.stringify(arr));
  modalView.style.display = 'none';
  renderCalendar(selectedMonthIndex);
}

/* on load */
renderCalendar(selectedMonthIndex);
</script>
</body>
</html>
