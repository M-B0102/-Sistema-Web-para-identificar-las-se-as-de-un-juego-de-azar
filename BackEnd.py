from flask import Flask, request, jsonify

app = Flask(__name__)

# Variable para almacenar la dificultad seleccionada
dificultad_actual = "normal"

@app.route('/set_dificultad', methods=['POST'])
def set_dificultad():
    global dificultad_actual
    data = request.json
    dificultad_actual = data.get('dificultad', 'normal')  # Valor predeterminado: normal
    return jsonify({"mensaje": f"Dificultad cambiada a {dificultad_actual}."})

@app.route('/get_dificultad', methods=['GET'])
def get_dificultad():
    return jsonify({"dificultad_actual": dificultad_actual})

if __name__ == '__main__':
    app.run(debug=True)
