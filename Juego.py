# Importamos las librerías
import cv2
import random
import SeguimientoManos as sm  # Clase manos
import os
import imutils
import mysql.connector


# Función para guardar el puntaje en la base de datos
def guardar_puntaje(jugador, ia):
    try:
        conexion = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="sesiones202"
        )
        cursor = conexion.cursor()
        consulta = "INSERT INTO puntajes (jugador_puntos, ia_puntos) VALUES (%s, %s)"
        valores = (jugador, ia)
        cursor.execute(consulta, valores)
        conexion.commit()
        print("Puntaje guardado exitosamente.")
    except mysql.connector.Error as err:
        print(f"Error: {err}")
    finally:
        if conexion.is_connected():
            cursor.close()
            conexion.close()


# Declaración de variables
fs = False  # Bandera inicio
fu = False  # Bandera movimiento hacia arriba
fj = False  # Bandera juego
fr = False  # Bandera reset
conteo = 0
puntos_ia = 0
puntos_jugador = 0

# Accedemos a la carpeta de imágenes
path = 'Imagenes'
images = []
clases = []
lista = os.listdir(path)

# Cargamos las imágenes y clases
for lis in lista:
    imgdb = cv2.imread(f'{path}/{lis}')
    images.append(imgdb)
    clases.append(os.path.splitext(lis)[0])

print(clases)

# Lectura de la cámara
cap = cv2.VideoCapture(0)

# Declaramos el detector
detector = sm.detectormanos(Confdeteccion=0.9)

# Bucle principal
while True:
    # Lectura de la videocaptura
    ret, frame = cap.read()

    # Leemos entrada del teclado
    t = cv2.waitKey(1)

    # Configuración del frame
    frame = cv2.flip(frame, 1)  # Espejo
    al, an, c = frame.shape
    cx = int(an / 2)
    cy = int(al / 2)

    # Mostramos el marcador
    cv2.putText(frame, f"Jugador: {puntos_jugador}", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 1.5, (0, 255, 0), 3)
    cv2.putText(frame, f"IA: {puntos_ia}", (10, 70), cv2.FONT_HERSHEY_SIMPLEX, 1.5, (0, 0, 255), 3)

    # Detección de manos
    frame = detector.encontrarmanos(frame, dibujar=True)
    lista1, bbox1, jug = detector.encontrarposicion(frame, ManoNum=0, dibujar=True, color=[0, 255, 0])

    if jug == 1:  # Cuando hay una mano detectada
        # Dividimos pantalla
        cv2.line(frame, (cx, 0), (cx, 480), (0, 255, 0), 2)

        # Mostramos jugadores
        cv2.rectangle(frame, (245, 25), (380, 60), (0, 0, 0), -1)
        cv2.putText(frame, '1 JUGADOR', (250, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.71, (0, 255, 0), 2)

        # Mensaje inicial
        cv2.rectangle(frame, (145, 425), (465, 460), (0, 0, 0), -1)
        cv2.putText(frame, 'PRESIONA S PARA EMPEZAR', (150, 450), cv2.FONT_HERSHEY_SIMPLEX, 0.71, (0, 255, 0), 2)

        if t == ord('s') or fs:  # Comenzar el juego
            fs = True
            if len(lista1) != 0:
                x1, y1 = lista1[9][1:]  # Coordenadas del dedo medio

                if conteo <= 2:  # Mostrar imágenes iniciales
                    img = images[conteo]
                    img = imutils.resize(img, width=240, height=240)
                    frame[130: 130 + img.shape[0], 350: 350 + img.shape[1]] = img

                    if y1 < cy - 40 and not fu:  # Umbral para detección de movimiento hacia arriba
                        fu = True
                    elif y1 > cy - 40 and fu:  # Movimiento hacia abajo detectado
                        conteo += 1
                        fu = False

                elif conteo == 3:  # Ronda de juego
                    if not fj:  # IA elige
                        juego = random.randint(3, 5)
                        fj = True

                    img = images[juego]
                    img = imutils.resize(img, width=240, height=240)
                    frame[130: 130 + img.shape[0], 350: 350 + img.shape[1]] = img

                    # Evaluación de ganador
                    x2, y2 = lista1[8][1:]
                    x3, y3 = lista1[12][1:]
                    x4, y4 = lista1[16][1:]

                    if x2 < x3 and x3 < x4:  # Piedra
                        if juego == 3:  # IA eligió papel
                            puntos_ia += 1
                        elif juego == 5:  # IA eligió tijera
                            puntos_jugador += 1
                    elif x2 > x3 and x3 > x4:  # Papel
                        if juego == 4:  # IA eligió piedra
                            puntos_jugador += 1
                        elif juego == 5:  # IA eligió tijera
                            puntos_ia += 1
                    elif x2 < x3 and x3 > x4:  # Tijera
                        if juego == 3:  # IA eligió papel
                            puntos_jugador += 1
                        elif juego == 4:  # IA eligió piedra
                            puntos_ia += 1

                    fr = True  # Juego completado

                if fr:  # Si la partida terminó
                    cv2.rectangle(frame, (100, 400), (540, 460), (0, 0, 0), -1)
                    cv2.putText(frame, 'Presione G para guardar el puntaje', (110, 440), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2)

                    if t == ord('g'):  # Guardar puntaje al presionar G
                        guardar_puntaje(puntos_jugador, puntos_ia)
                        fr = False  # Reinicia la bandera del final de la partida

                if fr and t == ord('r'):  # Reinicio
                    fs = fj = fr = False
                    conteo = 0
                    puntos_ia = 0
                    puntos_jugador = 0

    # Mostrar el frame
    cv2.imshow("JUEGO CON IA", frame)
    if t == 27:  # Salir con ESC
        break

cap.release()
cv2.destroyAllWindows()
