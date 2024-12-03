import mysql.connector

def guardar_puntaje(jugador_puntos, ia_puntos):
    try:
        conexion = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="sesiones2023"
        )
        cursor = conexion.cursor()
        consulta = "INSERT INTO puntajes (jugador_puntos, ia_puntos) VALUES (%s, %s)"
        valores = (jugador_puntos, ia_puntos)
        cursor.execute(consulta, valores)
        conexion.commit()
        print("Puntaje guardado exitosamente.")
    except mysql.connector.Error as err:
        print(f"Error: {err}")
    finally:
        if conexion.is_connected():
            cursor.close()
            conexion.close()
