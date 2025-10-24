from flask import Flask, request, jsonify
from flask_cors import CORS
import os
from dotenv import load_dotenv
import google.generativeai as genai

# Carrega variáveis do .env
load_dotenv()

# Configuração do Flask
app = Flask(__name__)
CORS(app)  # permite o PHP acessar via HTTP

# Configura a API do Gemini
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

@app.route("/mensagem", methods=["POST"])
def mensagem():
    try:
        data = request.get_json()
        mensagem = data.get("mensagem", "")

        if not mensagem:
            return jsonify({"erro": "Nenhuma mensagem recebida"}), 400

        model = genai.GenerativeModel("gemini-2.5-flash")
        resposta = model.generate_content(mensagem)

        return jsonify({"resposta": resposta.text})
    except Exception as e:
        return jsonify({"erro": str(e)}), 500


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
