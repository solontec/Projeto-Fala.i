from flask import Flask, request, jsonify
from flask_cors import CORS
import os
from dotenv import load_dotenv
import google.generativeai as genai

# Carrega variáveis do .env
load_dotenv()

app = Flask(__name__)
CORS(app)

# Configuração da API do Gemini
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

# 🎙️ REGRAS DO COACH DE ORATÓRIA
ORATORIA_RULES = """
Você é o Fala.i — um coach de oratória especializado em ajudar pessoas a falarem melhor em público.
Seu objetivo é desenvolver clareza, confiança e expressão nos alunos.

Siga SEMPRE estas regras:

1. quando uma pessoa falar e gaguejar vc tem que identificar  se a pesso aguaguejou em todos os audios que enviar, ele vai enviar trasncrito, ai vc ve vicio de linguuagem, e da o feedback

seja mais sensivel a gagueira e vicios de linguagem, qualquer coisinha.
"""

@app.route("/mensagem", methods=["POST"])
def mensagem():
    try:
        data = request.get_json()
        mensagem = data.get("mensagem", "")

        if not mensagem:
            return jsonify({"erro": "Nenhuma mensagem recebida"}), 400

        model = genai.GenerativeModel("gemini-2.0-flash")

        # 🧠 Prompt completo com personalidade fixa
        prompt_final = f"{ORATORIA_RULES}\n\nAluno: {mensagem}\nFala.i:"

        resposta = model.generate_content(prompt_final)

        return jsonify({"resposta": resposta.text})

    except Exception as e:
        return jsonify({"erro": str(e)}), 500


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
