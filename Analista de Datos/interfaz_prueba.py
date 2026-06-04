
import streamlit as st
import requests
import pandas as pd
from PIL import Image
from io import BytesIO

#CONFIGURACION Y CLAVES
RGAPI_KEY = "RGAPI-fc96294a-9410-443b-ae94-d6bb6324dfbd"

REGIONS = {"ruta": "americas", "plataforma": "la1"}
URL_API_PLATAFORMA = f"https://{REGIONS['plataforma']}.api.riotgames.com/lol"
URL_API_REGION = f"https://{REGIONS['ruta']}.api.riotgames.com/lol"
URL_CUENTAS = f"https://{REGIONS['ruta']}.api.riotgames.com/riot"

#FUNCIONES DE LOGICA
def conexion_riot(url):
    #Realiza peticiones HTTP GET a la API de Riot usando la clave de acceso
    headers = {"X-Riot-Token": RGAPI_KEY}
    try:
        res = requests.get(url, headers=headers)
        return res.json() if res.status_code == 200 else None
    except:
        return None

def obtener_version():
    #Obtiene la ultima version activa del juego desde los servidores de Data Dragon
    try:
        res = requests.get("https://ddragon.leagueoflegends.com/api/versions.json").json()
        return res[0]
    except:
        return "14.10.1" #Version de respaldo en caso de error de conexion

def procesar_datos_completos(nombre, tag, num_partidas=10):
    #Busca y procesa toda la informacion del jugador, sus partidas y maestrias
    version = obtener_version()

    #Obtenemos la cuenta para conseguir el PUUID unico del jugador
    cuenta = conexion_riot(f"{URL_CUENTAS}/account/v1/accounts/by-riot-id/{nombre}/{tag}")
    if not cuenta: return None
    
    puuid_buscado = cuenta['puuid']

    #Obtenemos datos basicos del perfil como el nivel de cuenta
    perfil = conexion_riot(f"{URL_API_PLATAFORMA}/summoner/v4/summoners/by-puuid/{puuid_buscado}")
    
    #Obtenemos la lista de IDs de las ultimas partidas jugadas
    ids_partidas = conexion_riot(f"{URL_API_REGION}/match/v5/matches/by-puuid/{puuid_buscado}/ids?start=0&count={num_partidas}")
    if not ids_partidas: ids_partidas = []
    
    lista_analisis = []
    #Recorrer cada partida para extraer las estadisticas detalladas
    for id_p in ids_partidas:
        p_data = conexion_riot(f"{URL_API_REGION}/match/v5/matches/{id_p}")
        if p_data:
            #Extraemos a TODOS los participantes para esta partida
            todos_los_jugadores = []
            info_jugador_buscado = {}
            
            for part in p_data['info']['participants']:
                #Guardamos datos basicos de cada uno de los 10 jugadores
                todos_los_jugadores.append({
                    "nombre": part.get('riotIdGameName', part.get('summonerName', 'Desconocido')),
                    "tag": part.get('riotIdTagline', ''),
                    "campeon": part['championName'],
                    "kda": f"{part['kills']}/{part['deaths']}/{part['assists']}",
                    "equipo": part['teamId'] # 100 es el Equipo Azul, 200 es el Equipo Rojo
                })
                
                #Identificamos los datos especificos del jugador que estamos analizando
                if part['puuid'] == puuid_buscado:
                    info_jugador_buscado = {
                        "Campeón": part['championName'],
                        "Resultado": "Victoria" if part['win'] else "Derrota",
                        "Kills": part['kills'],
                        "Deaths": part['deaths'],
                        "Assists": part['assists'],
                        "KDA": round((part['kills'] + part['assists']) / (part['deaths'] if part['deaths'] > 0 else 1), 2),
                        "Daño": part['totalDamageDealtToChampions'],
                        "Oro": part['goldEarned'],
                        "Visión": part['visionScore'],
                        "CS": part['totalMinionsKilled'] + part['neutralMinionsKilled'],
                        "Modo": p_data['info']['gameMode'],
                        "Nivel_Champ": part['champLevel']
                    }
            
            #Agregamos la lista de los 10 jugadores al diccionario de la partida
            info_jugador_buscado["Participantes"] = todos_los_jugadores
            lista_analisis.append(info_jugador_buscado)
    
    #Obtenemos los 5 campeones con mayor puntaje de maestria
    maestrias = conexion_riot(f"{URL_API_PLATAFORMA}/champion-mastery/v4/champion-masteries/by-puuid/{puuid_buscado}")
    maestrias = maestrias[:5] if maestrias else []
    
    #Regresamos todos los paquetes de informacion estructurados
    return {
        "perfil": perfil,
        "version": version,
        "analisis": lista_analisis,
        "maestrias": maestrias
    }

#INTERFAZ DE USUARIO (STREAMLIT)
#Configura el diseño de la pagina web para que use todo el ancho de la pantalla
st.set_page_config(layout="wide", page_title="LoL Data Analytics", page_icon="⚔️")

#Aplica estilos CSS personalizados para cambiar los colores y tamaños de los componentes visuales
st.markdown("""
    <style>
    [data-testid="stMetricValue"] { font-size: 26px; color: #C8AA6E; }
    .stTabs [data-baseweb="tab-list"] { gap: 8px; }
    .stTabs [data-baseweb="tab"] { 
        background-color: #1e2328; 
        border-radius: 4px 4px 0px 0px; 
        color: #f0e6d2; 
        padding: 10px 25px; 
    }
    .stTabs [aria-selected="true"] { 
        background-color: #C8AA6E !important; 
        color: black !important; 
        font-weight: bold;
    }
    </style>
""", unsafe_allow_html=True)

#Crea la barra lateral izquierda con el formulario de busqueda
st.sidebar.title("🔍 LoL Data Analytics")
with st.sidebar.form("form_busqueda"):
    nombre_input = st.text_input("Nombre de Invocador", value="zAxeNzo")
    tag_input = st.text_input("Tag", value="zzz")
    submit = st.form_submit_button("Analizar Jugador")

#Se ejecuta toda la logica cuando el usuario presiona el boton de buscar
if submit:
    with st.spinner('Accediendo a los registros de la Grieta...'):
        #Llama a la funcion logica para descargar y procesar los datos
        data = procesar_datos_completos(nombre_input, tag_input)
        
        if data:
            #Convierte las partidas en un DataFrame de Pandas para facilitar el manejo de las graficas
            df = pd.DataFrame(data['analisis'])
            
            #Dibuja el encabezado del perfil con la foto, nombre y nivel de cuenta
            col_header1, col_header2 = st.columns([1, 6])
            with col_header1:
                url_ico = f"https://ddragon.leagueoflegends.com/cdn/{data['version']}/img/profileicon/{data['perfil']['profileIconId']}.png"
                st.image(url_ico, width=120)
            with col_header2:
                st.title(f"{nombre_input} #{tag_input}")
                st.subheader(f"Nivel {data['perfil']['summonerLevel']}")
                st.caption(f"Análisis basado en las últimas {len(df)} partidas")

            st.divider()

            #Crea las 3 pestañas de navegacion principales en la web
            tab_dash, tab_hist, tab_maes = st.tabs(["📈 DASHBOARD DE DATOS", "📜 HISTORIAL DETALLADO", "🏆 MAESTRÍAS"])

            #Primer pestaña: Graficas de rendimiento y estadisticas calculadas
            with tab_dash:
                st.write("### Desempeño General")
                m1, m2, m3, m4 = st.columns(4)
                #Calcula el porcentaje de victorias promedio
                wr = (df['Resultado'] == 'Victoria').mean() * 100
                m1.metric("Winrate", f"{wr:.0f}%")
                m2.metric("KDA Global", f"{df['KDA'].mean():.2f}")
                m3.metric("Oro Promedio", f"{df['Oro'].mean():,.0f}")
                m4.metric("Visión (Score)", f"{df['Visión'].mean():.1f}")
                st.write("---")

                #Muestra los bloques de graficas de barras, lineas y areas
                g_col1, g_col2 = st.columns(2)
                with g_col1:
                    st.write("**Eficiencia Económica (Daño vs Oro)**")
                    st.area_chart(df.set_index("Campeón")[["Daño", "Oro"]])
                    st.write("**Participación en Combates (K/D/A)**")
                    st.bar_chart(df.set_index("Campeón")[["Kills", "Deaths", "Assists"]])
                with g_col2:
                    st.write("**Estabilidad de KDA por Partida**")
                    st.line_chart(df["KDA"], color="#C8AA6E")
                    st.write("**Consistencia de Farmeo (CS)**")
                    st.bar_chart(df.set_index("Campeón")["CS"], color="#00A3FF")
                st.write("---")
                st.write("**Impacto Global: Daño, Oro y Resultado**")
                st.scatter_chart(df, x="Oro", y="Daño", color="Resultado")

            #Segunda Pestaña: Historial con menus desplegables para cada partida
            with tab_hist:
                st.write("### Historial Reciente (Haz clic para ver detalles)")
                for idx, row in df.iterrows():
                    color_status = "Victoria" if row['Resultado'] == "Victoria" else "Derrota"
                    etiqueta = f"{color_status.upper()} | {row['Campeón']} - {row['Kills']}/{row['Deaths']}/{row['Assists']} (KDA: {row['KDA']})"
                    
                    #Crea un contenedor expandible para mostrar los detalles al hacer clic
                    with st.expander(etiqueta):
                        st.write(f"**Modo de Juego:** {row['Modo']}")
                        d1, d2, d3 = st.columns(3)
                        with d1:
                            st.metric("Daño Total", f"{row['Daño']:,}")
                            st.progress(min(row['Daño']/55000, 1.0))
                        with d2:
                            st.metric("Oro Obtenido", f"{row['Oro']:,}")
                            st.write(f"Nivel de Campeón: {row['Nivel_Champ']}")
                        with d3:
                            st.metric("Súbditos (CS)", row['CS'])
                            st.metric("Visión", row['Visión'])
                        
                        st.write("---")
                        #Listado de Jugadores con los equipos participantes
                        st.write("**Compañeros y Rivales:**")
                        col_equipo1, col_equipo2 = st.columns(2)
                        
                        #Filtramos por ID de equipo (100: Azul, 200: Rojo)
                        equipo_azul = [p for p in row['Participantes'] if p['equipo'] == 100]
                        equipo_rojo = [p for p in row['Participantes'] if p['equipo'] == 200]
                        
                        with col_equipo1:
                            st.markdown("<b style='color: #00A3FF;'>EQUIPO AZUL</b>", unsafe_allow_html=True)
                            for p in equipo_azul:
                                st.caption(f"{p['campeon']} — **{p['nombre']}#{p['tag']}** ({p['kda']})")
                                
                        with col_equipo2:
                            st.markdown("<b style='color: #EE3D30;'>EQUIPO ROJO</b>", unsafe_allow_html=True)
                            for p in equipo_rojo:
                                st.caption(f"{p['campeon']} — **{p['nombre']}#{p['tag']}** ({p['kda']})")

            #Tercer Pestaña: Muestra las fotos y los puntos de maestria de tus mejores 5 campeones
            with tab_maes:
                st.write("### Top 5 Campeones")
                #Descarga el archivo maestro con los nombres oficiales de los campeones
                c_data = requests.get(f"https://ddragon.leagueoflegends.com/cdn/{data['version']}/data/es_MX/champion.json").json()['data']
                cols_maes = st.columns(5)
                for i, m in enumerate(data['maestrias']):
                    cid = str(m['championId'])
                    #Cruza el ID numerico para conseguir el nombre textual del campeon
                    cname = next((n for n, info in c_data.items() if info['key'] == cid), "Desconocido")
                    with cols_maes[i]:
                        st.image(f"https://ddragon.leagueoflegends.com/cdn/{data['version']}/img/champion/{cname}.png")
                        st.write(f"**{cname}**")
                        st.caption(f"{m['championPoints']:,} pts")
        else:
            st.error("No se pudo encontrar al jugador. Verifica el Nombre y el Tag.")

else:
    #Muestra la pantalla de inicio informativa si todavia no se ha buscado ningun jugador
    st.info("👋 Bienvenido al Analizador de Datos de LoL. Ingresa un Riot ID a la izquierda para comenzar.")
    st.markdown("""
    ### 🚀 Domina la Grieta del Invocador
    Lleva tu análisis al siguiente nivel con nuestro Dashboard profesional:
    * 📈 **Métricas Avanzadas:** Analiza tu KDA, Oro y Visión de las últimas 10 partidas.
    * ⚔️ **Gráficas de Eficiencia:** Compara tu capacidad de daño frente al oro obtenido.
    * 🏆 **Panel de Maestrías:** Visualiza tus campeones más experimentados con arte oficial.
    * 🔍 **Historial Interactivo:** Explora cada partida y conoce a tus aliados y rivales.
    """)
    st.write("---")