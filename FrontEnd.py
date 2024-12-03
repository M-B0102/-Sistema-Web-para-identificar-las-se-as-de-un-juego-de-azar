from flask import Flask, jsonify
import subprocess

app = Flask(__name__)

@app.route('/iniciar_juego', methods=['POST'])
def iniciar_juego():
    try:
        # Ruta al archivo de Python a ejecutar
        script_path = "Juego.py"  # Cambia esto a la ruta de tu script si está en otra carpeta
        
        # Ejecutar el script de Python
        subprocess.Popen(['python', script_path])  # Usa 'python3' si estás en Linux/Mac
        return jsonify({"mensaje": "El programa se está ejecutando."})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
