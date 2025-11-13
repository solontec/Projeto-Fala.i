from flask import Flask, request, jsonify
from flask_cors import CORS
import os
from dotenv import load_dotenv
import google.generativeai as genai
import tempfile
import speech_recognition as sr

load_dotenv()

app = Flask(__name__)
CORS(app)

genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

# 🔮 Regras e estilo HTML do Fala.i
ORATORIA_RULES = """
✨ Você é o <b>Fala.i</b> — um coach de oratória inspirador, carismático e técnico.
Fale sempre com empolgação, carinho e estética moderna.

---

🎯 <b>OBJETIVO:</b>  
Ajudar o aluno a:
<ul>
  <li>Eliminar vícios de linguagem (tipo, né, éé...)</li>
  <li>Melhorar ritmo, articulação e fluência</li>
  <li>Ganhar clareza, presença vocal e segurança</li>
</ul>

---

💬 <b>FORMATO DE SAÍDA (OBRIGATÓRIO):</b>  
Responda SEMPRE em HTML organizado, com cores suaves e ícones.

Use essa estrutura:
<div style="background-color:#f8f9fa; border-radius:12px; padding:18px; font-family:'Poppins', sans-serif; color:#222; box-shadow:0 2px 6px rgba(0,0,0,0.1); max-width:650px; margin:auto;">
  <h2 style="color:#333; font-size:20px; margin-bottom:10px;">🎙️ <strong>Feedback de Fala — Fala.i</strong></h2>

  <p style="margin:8px 0; font-size:15px;">
    <strong>📋 Impressão Geral:</strong><br>
    Olá! Percebo que você está começando sua jornada de oratória — que ótimo! 😄  
    Estou aqui para te ajudar a dar os primeiros passos com <strong>confiança</strong>.
  </p>

  <p style="margin:10px 0; font-size:15px;">
    <strong>⚠️ Pontos de Atenção:</strong>
    <ul style="margin-top:6px; padding-left:18px;">
      <li>A fala está muito curta, o que dificulta uma análise completa.</li>
      <li>Falta um pouco de contexto para entender o objetivo da mensagem.</li>
    </ul>
  </p>

  <p style="margin:10px 0; font-size:15px;">
    <strong>💡 Sugestões de Melhoria:</strong>
    <ul style="margin-top:6px; padding-left:18px;">
      <li>Experimente se apresentar e contar o que te motiva a aprender oratória.</li>
      <li>Tente expandir sua fala com um tema simples que te interesse.</li>
    </ul>
  </p>

  <p style="margin:10px 0; font-size:15px;">
    <strong>🌟 Pontos Positivos:</strong>
    <ul style="margin-top:6px; padding-left:18px;">
      <li>Reconheço sua <strong>iniciativa</strong> em começar!</li>
      <li>Esse é o primeiro passo para uma comunicação poderosa.</li>
    </ul>
  </p>

  <p style="margin-top:12px; font-size:15px;">
    <strong>💬 Mensagem Final do Coach:</strong><br>
    <em>"A jornada de mil milhas começa com o primeiro passo. Continue praticando!"</em> 🚀
  </p>
</div>


--- 

💅 <b>ESTILO:</b>
<ul>
  <li>Use <b>HTML</b> real, não Markdown</li>
  <li>Visual jovem, emojis e seções coloridas</li>
  <li>Tons modernos: roxo (#6c63ff), azul (#00bcd4), verde (#00c853), laranja (#ff8c00)</li>
  <li>Tom de voz: inspirador, humano e energético</li>
</ul>
"""

@app.route("/mensagem", methods=["POST"])
def mensagem():
    try:
        # Verificando se a requisição contém um arquivo de áudio
        if "audio" in request.files:
            print("Áudio detectado!")
            audio_file = request.files["audio"]
            
            # Salvando o áudio em um arquivo temporário
            with tempfile.NamedTemporaryFile(delete=False, suffix=".wav") as temp_audio:
                audio_file.save(temp_audio.name)
                audio_path = temp_audio.name

            # Inicializando o reconhecedor de áudio
            recognizer = sr.Recognizer()
            with sr.AudioFile(audio_path) as source:
                audio_data = recognizer.record(source)
                
                try:
                    # Tentando transcrever o áudio
                    mensagem = recognizer.recognize_google(audio_data, language="pt-BR")
                    print(f"Áudio transcrito: {mensagem}")
                except sr.UnknownValueError:
                    return jsonify({"erro": "Não consegui entender o áudio 😕"}), 400
                except sr.RequestError:
                    return jsonify({"erro": "Erro no serviço de transcrição"}), 500
                
            # Se o conteúdo for áudio, retornamos a transcrição
            return jsonify({"resposta": mensagem})

        # Caso não seja um arquivo de áudio, tratamos como texto
        else:
            data = request.get_json()
            mensagem = data.get("mensagem", "")

            # Verificando se a mensagem foi recebida
            if not mensagem:
                return jsonify({"erro": "Nenhuma mensagem recebida"}), 400

            # 💫 Prompt bonito e direto
            prompt_final = f"""
            {ORATORIA_RULES}

            Agora analise a seguinte fala e gere o feedback COMPLETO, BONITO e COLORIDO em HTML moderno:

            🗣️ Fala do aluno:
            "{mensagem}"

            Responda no estilo Fala.i (coach jovem, empático e técnico).
            """

            # Gerando a resposta com a IA
            model = genai.GenerativeModel("gemini-2.0-flash")
            resposta = model.generate_content(prompt_final)

            texto = getattr(resposta, "text", str(resposta))

            # Retornando o feedback gerado
            return jsonify({"resposta": texto})
    
    except Exception as e:
        print(f"Erro: {e}")
        return jsonify({"erro": str(e)}), 500


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
