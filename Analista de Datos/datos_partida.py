import time
import configuracion as conf
import perfil_jugador #Importante para usar la funcion de PUUID

# --- DICCIONARIO DE MODOS DE JUEGO ---
# Aqui es donde se agrega un nuevo codigo de juego cuando se detecte
TIPO_COLA = {
    420: "Clasificatoria Solo/Duo",
    440: "Clasificatoria Flex",
    400: "Normal Reclutamiento",
    430: "Normal Selección Oculta",
    450: "ARAM",
    1700: "Arena",
    1900: "URF"
}

def obtener_idPartidas(puuid, cantidad):
    url_idPartidas = f"{conf.URL_API_REGION}/match/v5/matches/by-puuid/{puuid}/ids?start=0&count={cantidad}"
    return conf.conexion_riot(url_idPartidas) or []

def obtener_datosPartidas(puuid, idPartidas):
    datos_partidas = {}

    for i, partidas in enumerate(idPartidas):
        #Regresamos al print de descarga
        print(f"Descargando datos de la partida {i+1}: {partidas}...")

        url_infoPartidas = f"{conf.URL_API_REGION}/match/v5/matches/{partidas}"
        datos_infoPartidas = conf.conexion_riot(url_infoPartidas)

        if not datos_infoPartidas:
            continue

        #Identificamos el modo de juego
        queue_id = datos_infoPartidas["info"]["queueId"]
        
        if queue_id not in TIPO_COLA:
            print(f"\n ¡NUEVO MODO DETECTADO! El código secreto es: {queue_id}\n")
            
        modo_juego = TIPO_COLA.get(queue_id, f"Modo Especial ({queue_id})")

        #Guardamos a TODOS los jugadores intactos para la ventana de detalles
        lista_jugadores_completa = datos_infoPartidas["info"]["participants"]
        
        #Buscamos al jugador principal para la tarjeta resumen
        jugador_principal = None
        for jugador in lista_jugadores_completa:
            if jugador["puuid"] == puuid:
                jugador_principal = jugador
                break

        if jugador_principal:
            datos_partidas[f"partida_{i}"] = {
                "modo_juego": modo_juego, 
                "championName": jugador_principal['championName'],
                "win": jugador_principal['win'],
                "kills": jugador_principal['kills'],
                "deaths": jugador_principal['deaths'],
                "assists": jugador_principal['assists'],
                "totalMinionsKilled": jugador_principal['totalMinionsKilled'],
                "neutralMinionsKilled": jugador_principal['neutralMinionsKilled'],
                "gameDuration": datos_infoPartidas["info"]["gameDuration"],
                "totalDamageDealtToChampions" : jugador_principal['totalDamageDealtToChampions'],
                "goldEarned" : jugador_principal['goldEarned'],
                "visionScore" : jugador_principal['visionScore'],
                "damageDealtToObjectives" : jugador_principal['damageDealtToObjectives'],
                "turretKills" : jugador_principal['turretKills'],
                #Aquí enviamos a los 10 jugadores al main.py
                "participantes_completos": lista_jugadores_completa 
            }

        #Respetamos el tiempo de espera configurado
        time.sleep(conf.CONFIGURACION["sleep"])
    
    return datos_partidas

# --- ZONA DE PRUEBAS ---
if __name__ == "__main__":
    nombre = input("Nombre: ")
    tag = input("Tag: ")
    p_id = perfil_jugador.obtener_puuid(nombre, tag)
    if p_id:
        ids = obtener_idPartidas(p_id, 1)
        info = obtener_datosPartidas(p_id, ids)
        print(info)