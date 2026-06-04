import configuracion as conf

def obtener_mejores_campeones(puuid, cantidad_a_mostrar=3):
    url = f"{conf.URL_API_PLATAFORMA}/champion-mastery/v4/champion-masteries/by-puuid/{puuid}"
    
    #Usamos el .env para la conexion la cual esta en la configuracion.py
    respuesta_json = conf.conexion_riot(url)
    
    if respuesta_json:
        top_campeones = respuesta_json[:cantidad_a_mostrar]
        resultados_limpios = []
        for campeon in top_campeones:
            resultados_limpios.append({
                "id_campeon": campeon['championId'],
                "nivel_maestria": campeon['championLevel'],
                "puntos": campeon['championPoints']
            })
        return resultados_limpios
    
    return []

# --- Zona de Pruebas ---
if __name__ == "__main__":
    puuid_prueba = "PEGA_AQUI_UN_PUUID_REAL"
    print(obtener_mejores_campeones(puuid_prueba, 3))