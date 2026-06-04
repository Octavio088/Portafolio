import tkinter as tk
from tkinter import messagebox, ttk
from PIL import Image, ImageTk
import requests
from io import BytesIO
import threading

import perfil_jugador
import maestrias
import data_dragon
import datos_partida

# --- VARIABLES GLOBALES ---
imagenes_guardadas = [] #Retiene as referencias en memoria de las imagenes de Tkinter
pila_navegacion = [] #Almacena el historial de busqueda del usuario para permitir un buen funcionamiento en el boton "volver"
puuid_actual = None
parche_actual = ""
diccionario_champs = {}

def descargar_imagen_tk(url, tamaño):
    try:
        #Descarga una imagen de internet de forma segura con un limite de tiempo
        respuesta = requests.get(url, timeout=5)
        if respuesta.status_code == 200:
            #Abre la imagen, cambia su tamaño y la convierte al formato que acepta Tkinter
            img = Image.open(BytesIO(respuesta.content))
            img = img.resize(tamaño, Image.Resampling.LANCZOS)
            img_tk = ImageTk.PhotoImage(img)
            imagenes_guardadas.append(img_tk) #Guarda la imagen en memoria para que no se borre de la pantalla
            return img_tk
    except:
        pass #Si la descarga falla por cualquier motivo, simplemente continua sin romper el programa
    return None

def crear_placeholder(entry, texto):
    #Coloca un texto gris de guia dentro de una caja de entrada
    entry.insert(0, texto)
    entry.config(fg="gray")

    def al_entrar(event):
        #Borra el texto de guia y cambia el color a negro cuando el usuario hace clic para escribir
        if entry.get() == texto:
            entry.delete(0, tk.END)
            entry.config(fg="black")

    def al_salir(event):
        #Devuelve el texto gris de guia si el usuario deja la caja vacia al salir de ella
        if entry.get() == "":
            entry.insert(0, texto)
            entry.config(fg="gray")

    #Conecta las funciones con los eventos de hacer clic y salir de la caja
    entry.bind("<FocusIn>", al_entrar)
    entry.bind("<FocusOut>", al_salir)

# Logica de navegacion y busqueda
def buscar_jugador(guardar_en_historial=True):
    nombre = entrada_nombre.get()
    etiqueta = entrada_etiqueta.get()
    
    # Validamos que no intenten buscar usando el texto del placeholder
    if not nombre or not etiqueta or nombre == "Nombre de Invocador" or etiqueta == "Tag":
        messagebox.showwarning("Atención", "Por favor ingresa un nombre y etiqueta válidos.")
        return

    #Guarda la busqueda actual en la pila para poder regresar despues
    if guardar_en_historial:
        pila_navegacion.append((nombre, etiqueta))

    #Desactiva el boton de busqueda para evitar que el usuario haga multiples clics
    boton_buscar.config(text="Buscando...", state="disabled")
    #Crea y arranca un hilo secundario para hacer las descargas de datos sin congelar la ventana grafica
    hilo = threading.Thread(target=tarea_busqueda_fondo, args=(nombre, etiqueta))
    hilo.start()

def tarea_busqueda_fondo(nombre, etiqueta):
    global puuid_actual, parche_actual, diccionario_champs
    try:
        #Obtiene el identificador unico del jugador (PUUID)
        puuid_actual = perfil_jugador.obtener_puuid(nombre, etiqueta)
        if not puuid_actual:
            #Si no encuentra al jugador, muestra un error en la ventana principal y detiene la funcion
            ventana.after(0, lambda: messagebox.showerror("Error", "Jugador no encontrado."))
            return

        #Descarga toda la informacion necesaria desde los otros modulos en segundo plano   
        perfil = perfil_jugador.obtener_perfil_basico(puuid_actual)
        top_champs = maestrias.obtener_mejores_campeones(puuid_actual, 3)
        parche_actual = data_dragon.obtener_version_actual()
        diccionario_champs = data_dragon.obtener_diccionario_campeones(parche_actual)
        lista_ids = datos_partida.obtener_idPartidas(puuid_actual, 5)
        historial = datos_partida.obtener_datosPartidas(puuid_actual, lista_ids)

        #Le ordena a la ventana principal dibujar el perfil con los datos obtenidos
        ventana.after(0, mostrar_vista_perfil, perfil, top_champs, historial)
    finally:
        #Vuelve a activar el boton de busqueda pase lo que pase
        ventana.after(0, lambda: boton_buscar.config(text="Buscar", state="normal"))

def ir_atras():
    #Controla el funcionamiento del boton para regresar a la busqueda anterior
    if len(pila_navegacion) > 1:
        pila_navegacion.pop() #Saca la busqueda actual de la pila
        anterior = pila_navegacion.pop() #Obtiene los datos de la busqueda anterior
        
        # Llenamos las cajas y les ponemos color negro para que no parezca placeholder
        entrada_nombre.delete(0, tk.END)
        entrada_nombre.insert(0, anterior[0])
        entrada_nombre.config(fg="black")
        
        entrada_etiqueta.delete(0, tk.END)
        entrada_etiqueta.insert(0, anterior[1])
        entrada_etiqueta.config(fg="black")
        
        #Ejecuta la busqueda del jugador anterior y lo vuelve a meter al historial
        buscar_jugador(guardar_en_historial=True)

# Perfil (Diseño visual)
def mostrar_vista_perfil(perfil, top_champs, historial):
    #Borra lo que sea que este en pantalla para dibujar la interfaz del perfil
    limpiar_contenedor()
    
    #Crea la barra superior del perfil
    header_perfil = tk.Frame(contenedor_principal, bg="#010A13")
    header_perfil.pack(fill="x", padx=20, pady=10)
    
    #Dibuja el boton de volver si hay un historial de busquedas registrado
    if len(pila_navegacion) > 1:
        tk.Button(header_perfil, text="← Volver", bg="#010A13", fg="#C8AA6E", command=ir_atras, bd=0, font=("Helvetica", 11, "bold"), cursor="hand2").pack(side="left")

    #Descarga y muestra la foto de perfil del jugador y su nivel de cuenta
    url_ico = data_dragon.obtener_url_icono_perfil(perfil['icono_id'], parche_actual)
    img_ico = descargar_imagen_tk(url_ico, (90, 90))
    if img_ico: tk.Label(contenedor_principal, image=img_ico, bg="#010A13").pack()
    tk.Label(contenedor_principal, text=f"Nivel {perfil['nivel']}", fg="white", bg="#010A13", font=("Helvetica", 14, "bold")).pack()

    #Seccion para mostrar los 3 campeones con mas puntos de maestria del usuario
    tk.Label(contenedor_principal, text="MEJORES CAMPEONES", fg="#C8AA6E", bg="#010A13", font=("Helvetica", 10, "bold")).pack(pady=15)
    frame_m = tk.Frame(contenedor_principal, bg="#010A13")
    frame_m.pack()
    for champ in top_champs:
        nombre, cod = data_dragon.traducir_id_a_campeon(champ['id_campeon'], diccionario_champs)
        col = tk.Frame(frame_m, bg="#010A13")
        col.pack(side="left", padx=15)
        img_c = descargar_imagen_tk(data_dragon.obtener_url_imagen_campeon(cod, parche_actual), (60, 60))
        if img_c: tk.Label(col, image=img_c, bg="#010A13").pack()
        tk.Label(col, text=nombre, fg="white", bg="#010A13", font=("Helvetica", 9, "bold")).pack()

    #Seccion para listar las ultimas 5 partidas jugadas
    tk.Label(contenedor_principal, text="HISTORIAL RECIENTE", fg="#C8AA6E", bg="#010A13", font=("Helvetica", 10, "bold")).pack(pady=20)
    for p in historial.values():
        res = "VICTORIA" if p['win'] else "DERROTA"
        col_res = "#00FF00" if p['win'] else "#FF0000" #Verde para victoria, rojo para derrota
        card = tk.Frame(contenedor_principal, bg="#1E2328", pady=10)
        #Muestra texto con el modo de juego, el resultado y el campeon usado
        card.pack(fill="x", padx=40, pady=3)
        tk.Label(card, text=f"[{p['modo_juego']}] {res} | {p['championName']}", fg=col_res, bg="#1E2328", font=("Helvetica", 10, "bold")).pack(side="left", padx=15)
        #Boton para abrir la pantalla con los detalles de esta partida en especifico
        tk.Button(card, text="Detalles", bg="#C8AA6E", command=lambda pi=p: mostrar_vista_detalles(pi)).pack(side="right", padx=15)

# Detalles (Scoreboard con campeones)
def mostrar_vista_detalles(partida_info):
    #Borra la pantalla para dibujar la tabla de detalles de la partida seleccionada
    limpiar_contenedor()
    
    #Boton para regresar a la vista del perfil actual sin volver a gastar internet en recargarlo
    tk.Button(contenedor_principal, text="← Regresar al Perfil", bg="#010A13", fg="#C8AA6E", command=lambda: buscar_jugador(False), bd=0, font=("Helvetica", 11, "bold")).pack(anchor="nw", padx=20, pady=10)
    
    #Titulo que muestra el modo de juego y el resultado obtenido
    res_text = "VICTORIA" if partida_info['win'] else "DERROTA"
    res_col = "#00FF00" if partida_info['win'] else "#FF0000"
    tk.Label(contenedor_principal, text=f"{partida_info['modo_juego']} - {res_text}", fg=res_col, bg="#010A13", font=("Helvetica", 15, "bold")).pack()

    #Obtiene la lista de los 10 jugadores presentes en esa partida
    participantes = partida_info['participantes_completos']
    
    #Contenedor para la tabla de jugadores
    cols = tk.Frame(contenedor_principal, bg="#010A13")
    cols.pack(fill="both", expand=True, padx=10, pady=10)

    #Recorre a los 10 jugadores y los dibuja uno por uno en la tabla
    for i, p in enumerate(participantes):
        equipo_col = "#00A3FF" if i < 5 else "#EE3D30" #Azul para los primeros 5 (Equipo 1), rojo para los demas (Equipo 2)
        
        fila = tk.Frame(cols, bg="#1E2328", pady=5)
        fila.pack(fill="x", pady=2, padx=5)

        #Muestra la imagen del campeon que uso ese jugador
        url_c = data_dragon.obtener_url_imagen_campeon(p['championName'], parche_actual)
        img_c = descargar_imagen_tk(url_c, (35, 35))
        if img_c: tk.Label(fila, image=img_c, bg="#1E2328").pack(side="left", padx=5)

        #Nombre del jugador transformado en un boton interactivo. Si haces clic, te lleva a ver su perfil
        btn_user = tk.Button(fila, text=p['riotIdGameName'], bg="#1E2328", fg=equipo_col, bd=0, font=("Helvetica", 10, "bold", "underline"), cursor="hand2", 
                             command=lambda n=p['riotIdGameName'], t=p['riotIdTagline']: buscar_nuevo_perfil(n, t))
        btn_user.pack(side="left", padx=5)

        #Muestra las estadisticas de asesinatos, muertes, asistencias y daño total del participante
        txt_stats = f"{p['kills']}/{p['deaths']}/{p['assists']} | Daño: {p['totalDamageDealtToChampions']:,}"
        tk.Label(fila, text=txt_stats, fg="white", bg="#1E2328", font=("Helvetica", 9)).pack(side="right", padx=10)

def buscar_nuevo_perfil(n, t):
    #Escribe automaticamente el nombre y la etiqueta de un jugador clickeado y lanza la busqueda
    entrada_nombre.delete(0, tk.END); entrada_nombre.insert(0, n)
    entrada_nombre.config(fg="black")
    entrada_etiqueta.delete(0, tk.END); entrada_etiqueta.insert(0, t)
    entrada_etiqueta.config(fg="black")
    buscar_jugador(True)

def limpiar_contenedor():
    #Destruye todos los elementos visuales que esten dentro del contenedor principal para dejarlo vacio
    for w in contenedor_principal.winfo_children(): w.destroy()

# Estructura base de la ventana
ventana = tk.Tk()
ventana.title("LoL Stats Pro")
ventana.geometry("650x850")
ventana.config(bg="#010A13")

# ------- Diseño centrado del buscador ---------
nav = tk.Frame(ventana, bg="#1E2328", pady=15)
nav.pack(fill="x")

# Este sub-contenedor es el que permite que todo quede justo en medio
nav_center = tk.Frame(nav, bg="#1E2328")
nav_center.pack(expand=True) 

#Caja de texto para el nombre del jugador
entrada_nombre = tk.Entry(nav_center, font=("Helvetica", 12), width=18)
entrada_nombre.pack(side="left", padx=5)
crear_placeholder(entrada_nombre, "Nombre de Invocador") # Activamos el texto gris

#Separador visual entre el nombre y la etiqueta
tk.Label(nav_center, text="#", fg="#C8AA6E", bg="#1E2328", font=("Helvetica", 14, "bold")).pack(side="left")

#Caja de texto para la etiqueta del jugador
entrada_etiqueta = tk.Entry(nav_center, font=("Helvetica", 12), width=7)
entrada_etiqueta.pack(side="left", padx=5)
crear_placeholder(entrada_etiqueta, "Tag") # Activamos el texto gris

#Boton principal para iniciar las busquedas
boton_buscar = tk.Button(nav_center, text="Buscar", bg="#C8AA6E", font=("Helvetica", 10, "bold"), cursor="hand2", command=lambda: buscar_jugador(True))
boton_buscar.pack(side="left", padx=15)

#Contenedor donde cambia todo el contenido de la aplicacion
contenedor_principal = tk.Frame(ventana, bg="#010A13")
contenedor_principal.pack(fill="both", expand=True)

# Mensaje inicial
tk.Label(contenedor_principal, text="Ingrese un jugador para comenzar", fg="gray", bg="#010A13", font=("Helvetica", 12, "italic")).pack(expand=True)

ventana.focus() 

#Mantiene la ventana abierta escuchando las acciones del usuari
ventana.mainloop()