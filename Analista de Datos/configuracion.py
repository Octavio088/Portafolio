import requests
import os
from dotenv import load_dotenv

#Carga las key desde el archivo .env
load_dotenv()

#Configuracion de credenciales y tiempos de espera
CONFIGURACION = {
    "X-Riot-Token": os.getenv("CLAVE"), #API Key de Riot
    "sleep": 2 #Segundos de espera entre peticiones
}

REGION = {
    "ruta": "americas", #partidas y PUUID
    "plataforma": "la1" #nivel, iconos y maestrias
}

#Construccion automatica de las URLs base de la API segun la region elegida
URL_API_PLATAFORMA = f"https://{REGION['plataforma']}.api.riotgames.com/lol"
URL_API_REGION = f"https://{REGION['ruta']}.api.riotgames.com/lol"
URL_CUENTAS = f"https://{REGION['ruta']}.api.riotgames.com/riot"

def conexion_riot(url):
    """
    Realiza una petición GET a la API de Riot de forma segura.
    Devuelve los datos en JSON si todo sale bien, o None si hay error.
    """
    #Prepara la cabecera con la API Key para autenticarse
    datos = {
        "X-Riot-Token": CONFIGURACION["X-Riot-Token"]
    }

    try:
        #Hace la peticion HTTP
        respuesta = requests.get(url, headers=datos)

        #Control de respuestas según el codigo de estado HTTP
        if respuesta.status_code == 200:
            return respuesta.json() #devuelve la info
        elif respuesta.status_code == 429:
            print("Error. Demasiadas peticiones")
        else:
            print(f"Error {respuesta.status_code} en la URL {url}")
        return None
    except Exception as e:
        print(f"Error de conexión {e}")
        return None